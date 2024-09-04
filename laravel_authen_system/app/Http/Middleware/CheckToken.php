<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\api\v1\token;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tokenString = $request->bearerToken();

        // Nếu không có token, trả về lỗi
        if (!$tokenString) {
            return response()->json([
                'status' => false,
                'message' => 'Token not provided',
            ], 401);
        }

        // Tìm token trong cơ sở dữ liệu
        $token = token::where('token', $tokenString)->first();

        // Nếu token không hợp lệ, trả về lỗi
        if (!$token) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token',
            ], 401);
        }
        return $next($request);
    }
}
