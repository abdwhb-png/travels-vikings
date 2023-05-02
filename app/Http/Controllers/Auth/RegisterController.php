<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Member;
use App\Models\Refferal;
use App\Models\SystemRole;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => 'required|string|unique:members,phone',
            'invitation_code' => 'required|string|exists:refferals,invit_code',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $refferal = Refferal::where('invit_code', $data['invitation_code'])->first();
        $memberRole = SystemRole::where('title', 'Member')->first();
        $bacicMember = MemberGrade::where('title', 'Basic Member')->first();
        $user = User::create([
            'system_role_id' => $memberRole->id,
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        if($user && $refferal){
            $member = Member::create([
                "balance"=>0,
                "user_id"=>$user->id,
                "phone"=>$data['phone_number'],
                "parent_id"=>$refferal->member_id,
                'commission_ratio'=> $bacicMember->commission_ratio,
                'daily_task'=> $bacicMember->daily_task,
                'min_balance'=> $bacicMember->min_balance,
                'min_withdrawal'=> $bacicMember->min_withdrawal,
                'max_withdrawal'=> $bacicMember->max_withdrawal,
                'available_withdrawal'=> $bacicMember->available_withdrawal,
            ]);
            if($member){
                $ref = Refferal::create([
                    'member_id' => $member->id,
                    'invit_code' => Str::upper(Str::substr(Str::uuid(), 0, 8)),
                ]);
                if($ref)
                    return $user;
            }
        }
    }
}
