<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\LogoutFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPreference;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;


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
            'phone',
            'country',
            'password',
        );

        if ($validated) {
            try {
                DB::beginTransaction();

                $userPref = UserPreference::factory()->create();

                $user = User::create([
                    'firstname' => $validated['firstname'],
                    'lastname' => $validated['lastname'],
                    'username' => $validated['username'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'password' => bcrypt($validated['password']),
                    'DOB' => '2000-11-09',
                    'country' => $validated['country'],
                    'user_preferences_id' => $userPref->id,
                ]);

                Role::create([
                    'access_rights' => 'user',
                    'user_id' => $user->id,
                ]);

                // event(new Registered($user));

                DB::commit();

                return response()->json(['SUCCESS' => 'ACCOUNT_CREATED', 'user' => $user], 200);
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json(['ERROR' => $e->getMessage()], 401);
            }
        }
    }

    public function login(LoginFormRequest $request)
    {

        $validated = $request->safe()->only(
            'email',
            'password',
            'device_name',
        );

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return response()->json(['ERROR' => 'EMAIL_NOT_EXISTS'], 401);
        }

        if (!$user->email_verified_at) {
            return response()->json(['ERROR' => 'EMAIL_NOT_VERIFIED'], 401);
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json(['ERROR' => 'WRONG_PASSWORD'], 401);
        }

        Auth::login($user);

        return response()->json(['user' => $user, 'authToken' => $user->createToken($validated['device_name'])->plainTextToken]);
    }

    public function logout(LogoutFormRequest $request)
    {

        try {
            $validated = $request->validated();
        } catch (ValidationException $exception) {
            return response()->json(['ERROR' => 'Validation failed', 'message' => $exception->errors()], 422);
        }

        $user = User::where('id', $validated['id'])->first();

        if (!$user) {
            return response()->json(['ERROR' => 'USER_NOT_FOUND'], 404);
        }

        $user->tokens()->delete();

        Auth::logout($user);

        return response()->json(['SUCCESS' => 'TOKEN_REVOKED'], 200);
    }

    public function update()
    {

        //

    }
};
