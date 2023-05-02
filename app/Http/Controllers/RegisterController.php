<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Refferal;
use App\Models\SystemRole;
use App\Models\Deal;
use App\Models\Task;
use App\Models\CommissionRatio;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request) 
    {
        if($request->validated()){
            $refferal = Refferal::where('invit_code', $request['invitation_code'])->first();
            $memberRole = SystemRole::where('title', 'Member')->first();

            $user = User::create([
                'system_role_id' => $memberRole->id,
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            $member = Member::create([
                "user_id"=>$user->id,
                "phone"=>$request['phone_number'],
                "parent_id"=>$refferal->member_id
            ]);

            Refferal::create([
                'member_id' => $member->id,
                'invit_code' => Str::upper(Str::substr(Str::uuid(), 0, 8)),
            ]);

            $member = Member::find($member->id);

            $com = CommissionRatio::create([
                'member_id'=> $member->id,
                'value'=> $member->commission_ratio1,
            ]);

            $deals = Deal::all()->random(40)->unique();
            for($i = 0; $i < 40; $i++){
                $deal = $deals[$i];
                Task::create([
                    'member_id' => $member->id,
                    'deal_id' => $deal->id,
                    'task_number' => $i+1,
                ]);
            }

            auth()->login($user);

            return redirect()->route('member.dashboard')->with('registrationSuccess', "Welcome to you ".$user->username);
        }
    }
}
