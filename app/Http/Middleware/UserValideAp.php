<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserValideAp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if(!Auth::user()->email_verified_at){
                 
                 return response()->json([
                    'status' => false,
                    'message' => 'notemailverfied',
                    ], 401);
            }
            // if(!Auth::user()->is_mobile_verified){
                 
            //      return response()->json([
            //         'status' => false,
            //         'message' => 'notmobileverfied',
            //         ], 401);
            // }
            
        }
        return $next($request);
    }
}