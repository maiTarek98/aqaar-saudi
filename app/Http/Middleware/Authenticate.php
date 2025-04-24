<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(auth('admin')->check()){
                return route('dashboard');
            }else{
                return route('login');
            }
        }else{
            try {
                $user = JWTAuth::parseToken()->authenticate();
            } catch (TokenBlacklistedException $e) {
                return response()->json(['message' => 'Token has been blacklisted. Please log in again.'], 401);
            } catch (TokenExpiredException $e) {
                return response()->json(['message' => 'Token expired. Refresh the token.'], 401);
            } catch (JWTException $e) {
                return response()->json(['message' => 'Token is invalid.'], 401);
            }

            return $next($request);
        }
    }
}
