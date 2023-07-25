<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\LogoutFormRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function revokeToken(LogoutFormRequest $request)
    {
        try {
            $validated = $request->validated();
        } catch (ValidationException $exception) {
            return response()->json(['error' => 'Validation failed', 'message' => $exception->errors()], 422);
        }

        $user = User::find($validated['id']);

        if (!$user) {
            return response()->json(['ERROR' => 'USER_NOT_FOUND'], 404);
        }

        Auth::login($user);

        $user->tokens()->delete();

        return response()->json(['SUCCESS' => 'TOKEN_REVOKED'], 200);
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
            return response()->json(['ERROR' => 'EMAIL_NOT_EXISTS'], 403);
        }

        if (!$user->email_verified_at) {
            return response()->json(['ERROR' => 'EMAIL_NOT_VERIFIED'], 403);
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json(['ERROR' => 'WRONG_PASSWORD'], 403);
        }

        return response()->json(['user' => $user, 'authToken' => $user->createToken($validated['device_name'])->plainTextToken]);
    }
}
