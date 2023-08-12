<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PersonalAccessToken;

class ApiMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['ERROR' => 'UNAUTHORIZE'], 401);
        }

        $authToken = PersonalAccessToken::where('token', $token)->first();

        if (!$authToken) {
            return response()->json(['ERROR' => 'INVALID_TOKEN'], 401);
        }

        $userAbility = 'api.' . $authToken->abilities;

        $routePermission = $request->route()->middleware();

        if (!in_array($userAbility, $routePermission)) {
            return response()->json(['ERROR' => 'NO_PERMISSION'], 403);
        }

        $request->merge(['user_token' => $authToken]);

        return $next($request);
    }
}
