<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalAccessToken;

class ApiMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $tokenModel = PersonalAccessToken::where('token', $token)->first();

        if (!$tokenModel) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        $userAbility = 'api.' . $tokenModel->abilities;

        $routePermission = $request->route()->middleware();

        if (!in_array($userAbility, $routePermission)) {
            return response()->json(['message' => 'Insufficient privileges'], 403);
        }

        $request->merge(['user_token' => $tokenModel]);

        return $next($request);
    }
}
