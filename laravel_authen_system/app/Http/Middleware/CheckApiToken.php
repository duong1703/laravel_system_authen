<?php

namespace App\Http\Middleware;

use App\Models\api\v1\token;
use App\Models\api\v1\user;
use Closure;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tokenString = $request->bearerToken();

       
        if (!$tokenString) {
            return response()->json([
                'status' => false,
                'message' => 'Token not provided',
            ], 401);
        }

      
        $token = token::where('token', $tokenString)->first();
        $user = user::find($token->userId);
     
        if (!$token) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token',
            ], 401);
        }
        $request->merge(['user' => $user]);
        return $next($request);
    }
}
