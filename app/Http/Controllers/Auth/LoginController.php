<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo(){
        $admin = SystemRole::where('title', 'Admin')->first();
        $member = SystemRole::where('title', 'Member')->first();
        if(Auth::user()){
            if(Auth::user()->system_role_id == $admin->id){
                return redirect()->route('admin.index');
            }
            if (Auth::user()->system_role_id == $member->id)  {
                return redirect()->route('member.index');
            }
        }else{
            return redirect()->route('login');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
