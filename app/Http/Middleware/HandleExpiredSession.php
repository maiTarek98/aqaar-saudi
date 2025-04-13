<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleExpiredSession
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the request has a session expired status
        if ($request->session()->has('url.intended')) {
            // return redirect()->route('dashboard.login')->with('message', 'Your session has expired. Please log in again.');
        }

        return $next($request);
    }
}

?>