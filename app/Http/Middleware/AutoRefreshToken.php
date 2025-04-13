<?php
namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class AutoRefreshToken
{
    public function handle($request, Closure $next)
    {
        try {
            // التأكد من أن التوكن صالح
            JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            try {
                // تحديث التوكن وإعادة تعيينه في الهيدر
                $newToken = JWTAuth::refresh(JWTAuth::getToken());
                $request->headers->set('Authorization', 'Bearer ' . $newToken);
                
                // إضافة التوكن الجديد في الاستجابة
                $response = $next($request);
                return $response->header('Authorization', 'Bearer ' . $newToken);
            } catch (JWTException $e) {
                return response()->json(['message' => 'Token expired, please login again'], 401);
            }
        }

        return $next($request);
    }
}
