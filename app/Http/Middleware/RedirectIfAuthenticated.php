<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SystemRole;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $admin = SystemRole::where('title', 'Admin')->first();
                $member = SystemRole::where('title', 'Member')->first();
                if(Auth::user()){
                    if(Auth::user()->system_role_id == $admin->id){
                        return redirect()->route('admin.dashboard');
                    }
                    if (Auth::user()->system_role_id == $member->id)  {
                        return redirect()->route('member.dashboard');
                    }
                }else{
                    return redirect()->route('login');
                }
            }
        }

        return $next($request);
    }
}
