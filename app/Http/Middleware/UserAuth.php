<?php

namespace App\Http\Middleware;

use App\Http\Models\User;
use Closure, Session;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
//    public function handle($request, Closure $next)
//    {
//        return $next($request);
//    }
    
    /**
     * Check Admin Has Permission To Access Requested Page OR Not
     *
     * @var array
     */
    public function handle($request, Closure $next)
    {
        if(isset($request->header()['token']))
        {
            $token = $request->header()['token'];
            $user = User::where('api_token', $token)->first();
            if($user)
            {
                app()->instance('userSession', $user);
                return $next($request);
            } else {
                return response()->json([
                    'result' => 'error',
                    'message' => 'UNAUTHRIZED_ACCESS',
                    'error' => 'UNAUTHRIZED_ACCESS'
                ],401);
            }
        } else {
            return response()->json([
                'result' => 'error',
                'message' => 'UNAUTHRIZED_ACCESS',
                'error' => 'UNAUTHRIZED_ACCESS'
            ],401);
        }
    }
}
