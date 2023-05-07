<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    const allroles=[
        "role1"=>"admin",
        "role2"=>"student",
    ];
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$role)
    {
        $roles=explode('|',$role);
        if(!in_array( Auth::user()->role,$roles)){
            return redirect(asset("/". self::allroles['role'.Auth::user()->role] ."/dashboard"));
        }
        return $next($request);
    }
}
