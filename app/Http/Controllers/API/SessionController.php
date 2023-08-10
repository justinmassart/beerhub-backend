<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\LogoutFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\VerifyPhoneFormRequest;
use App\Models\PersonalAccessToken;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPhoneVerification;
use App\Models\UserPreference;
use Error;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

use Twilio\Rest\Client;

class SessionController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'update']);
    }

    public function register(RegisterFormRequest $request)
    {

        $validated = $request->safe()->only(
            'firstname',
            'lastname',
            'username',
            'email',
            'phoneNumber',
            'callingCode',
            'country',
            'password',
        );

        if ($validated) {
            try {
                DB::beginTransaction();

                $userPref = UserPreference::factory()->create();

                $phoneNumber = $validated['callingCode'] . $validated['phoneNumber'];

                $user = User::create([
                    'firstname' => $validated['firstname'],
                    'lastname' => $validated['lastname'],
                    'username' => $validated['username'],
                    'email' => $validated['email'],
                    'phone' => $phoneNumber,
                    'password' => bcrypt($validated['password']),
                    'DOB' => '2000-11-09',
                    'country' => $validated['country'],
                    'user_preferences_id' => $userPref->id,
                ]);

                Role::create([
                    'access_rights' => 'user',
                    'user_id' => $user->id,
                ]);

                $verificationCode = mt_rand(100000, 999999);

                UserPhoneVerification::create([
                    'user_id' => $user->id,
                    'user_phone' => $phoneNumber,
                    'code' => $verificationCode,
                ]);

                $sid = env("TWILIO_ACCOUNT_SID");
                $token = env("TWILIO_AUTH_TOKEN");
                $messagingServiceSid = env("TWILIO_MESSAGING_SERVICE_SID");

                $twilio = new Client($sid, $token);

                $message = $twilio->messages
                    ->create(
                        $phoneNumber,
                        array(
                            "messagingServiceSid" => $messagingServiceSid,
                            "body" => "Hello ! Your verification code for Beerhub is : {$verificationCode}"
                        )
                    );

                DB::commit();

                return response()->json(['SUCCESS' => 'ACCOUNT_CREATED', 'user' => $user, 'status' => $message->status], 200);
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json(['ERROR' => $e->getMessage()], 401);
            }
        }
    }

    public function verifyPhone(VerifyPhoneFormRequest $request)
    {

        $validated = $request->safe()->only('code', 'phone');

        if ($validated) {
            try {
                $user = User::where('phone', $validated['phone'])->first();

                $userVerification = UserPhoneVerification::where('user_id', $user->id)->first();

                if (intval($validated['code']) === $userVerification->code && $validated['phone'] === $userVerification->user_phone) {

                    DB::beginTransaction();

                    $user->phone_verified_at = now();

                    $userVerification->delete();

                    $user->save();

                    DB::commit();

                    return response()->json(['SUCCESS' => 'PHONE_VERIFIED'], 200);
                } else {
                    return response()->json(['ERROR' => 'WRONG_CODE'], 404);
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['ERROR' => $e->getMessage()], 401);
            }
        }
    }

    public function login(LoginFormRequest $request)
    {

        $validated = $request->safe()->only(
            'callingCode',
            'phoneNumber',
            'password',
            'device_name',
        );

        $phoneNumber = $validated['callingCode'] . $validated['phoneNumber'];

        $user = User::where('phone', $phoneNumber)->first();

        if (!$user) {
            return response()->json(['ERROR' => 'PHONE_NOT_EXISTS'], 401);
        }

        if (!$user->phone_verified_at) {
            return response()->json(['ERROR' => 'PHONE_NOT_VERIFIED'], 401);
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json(['ERROR' => 'WRONG_PASSWORD'], 401);
        }

        try {
            DB::beginTransaction();

            $token = PersonalAccessToken::where('user_id', $user->id)->first();

            if ($token && $token->name === $validated['device_name']) {
                $token->delete();
            }

            $authToken = PersonalAccessToken::create([
                'user_id' => $user->id,
                'name' => $validated['device_name'],
                'abilities' => 'user',
                'platform' => 'app',
            ]);

            DB::commit();

            $role = Role::where('user_id', $user->id)->first();

            if (!$role) {
                return response()->json(['ERROR' => 'NO_ACCESS_RIGHTS_SET_FOR_USER'], 404);
            }

            return response()->json(['user' => $user, 'authToken' => $authToken->token, 'accessRights' => $role->access_rights], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['ERROR' => $e->getMessage()], 401);
        }
    }

    public function logout(LogoutFormRequest $request)
    {
        $validated = $request->safe()->only('id');

        if ($validated) {
            $user = User::where('id', $validated['id'])->first();

            if (!$user) {
                return response()->json(['ERROR' => 'USER_NOT_FOUND'], 404);
            }

            $personalAccessToken = PersonalAccessToken::where('user_id', $user->id)->first();

            $personalAccessToken->delete();

            return response()->json(['SUCCESS' => 'TOKEN_REVOKED'], 200);
        } else {
            return response()->json(['ERROR' => 'COULD_NOT_VALIDATE'], 404);
        }
    }

    public function update()
    {

        //

    }
};
