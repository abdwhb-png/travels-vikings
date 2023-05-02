<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;
use App\Models\Task;
use App\Models\Deal;
use App\Models\Transaction;
use App\Models\FundInfo;
use App\Models\CommissionRatio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class MemberController extends Controller
{
    protected $daily_task = 40;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daily_task = $this->daily_task;
        
        $user = Auth::user();
        $member =  $user->member;

        $tasks = $member->tasks;

        $transactions = Transaction::where('member_id', Auth::user()->member->id)->orderBy('created_at', 'DESC')->get();

        return view('member.dashboard', compact('member', 'daily_task', 'transactions'));
    }

    public function journey($error=false, $msg='')
    {        
        if(Auth::user()->member->completed_tasks == $this->daily_task){
            $tasks = Auth::user()->member->tasks;
            $deals = Deal::all()->random(40)->unique();
            $i = 0;
            foreach ($tasks as $task) {
                $deal = $deals[$i];
                $task->update([
                    'deal_id' => $deal->id,
                    'task_status' => 0,
                ]);
                $i++;
            }
        }
        $tasks = Task::where('member_id',Auth::user()->member->id)->where('task_status', 0)->paginate(10);
        $actualTask = Task::where('member_id',Auth::user()->member->id)->where('task_status', 0)->first();
        return view('member.journey', compact('tasks', 'actualTask', 'error', 'msg'));
    }

    public function completeTask($id)
    {        
        $tasks = Auth::user()->member->tasks;
        $task=null;
        $previous=null;
        foreach ($tasks as $key => $value) {
            if($value->id == $id){
                $task = $value;
                if($key>0)
                $previous = $tasks[$key-1];
            }
        }
        if($task){
            if($previous && !$previous->task_status) return $this->journey(true, 'Please complete the previous task (TASK '.$previous->task_number.') !');
            else return view('member.completition')->with(['task' => $task]);
        }else return redirect();
    }

    public function submitTask($id)
    {        
        $task = Task::find($id);
        if(!!!$task) return response()->json(['frozen' => true], Response::HTTP_OK);

        if($task->task_cost > Auth::user()->member->balance){
            $m = Auth::user()->member->update(['status'=>0]);
            $c =Auth::user()->member->commissionRatio->update(['value'=> Auth::user()->member->commission_ratio2]);

            if($m && $c) return response()->json(['frozen' => true], Response::HTTP_OK);
        }

        $task->update(['task_status'=>1]);

        $amount =  (Auth::user()->member->commissionRatio->value * $task->task_cost) / 100;
        $m = Auth::user()->member->update([
            'balance' => Auth::user()->member->balance + $amount,
            'total_commission' => Auth::user()->member->total_commission + $amount,
            'completed_tasks' => Auth::user()->member->completed_tasks + 1,
        ]);
        $t = Transaction::create([
            'member_id' => Auth::user()->member->id,
            'type' => 1,
            'title' => 'Commission for Task '.$task->task_number.' completition',
            'amount' => $amount,
        ]);
        
        if($m && $t) return response()->json(['status' => true], Response::HTTP_OK);
        else return response()->json(['status' => false], Response::HTTP_OK);
    }

    public function register()
    {
        return view('member.register');
    }

    public function addFundInfo(Request $request){
        Validator::make($request->all(), [
            'network' => 'required|string|in:ERC-20,TRC-20',
            'wallet_address' => 'required|string',
        ])->validate();
        $request['member_id'] = Auth::user()->member->id;
        if(FundInfo::create($request->all()))
            return redirect()->route('member.fund-info');
    }

    public function accountSettings(){
        return view('member.account-settings');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username,'.Auth::user()->id,
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'phone_number' => 'required|string|unique:members,phone,'.Auth::user()->member->id,
        ]);
        $user = Auth::user();
        User::where('id',Auth::user()->id)->first()->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);
        Member::whereId(Auth::user()->member->id)->update([
            'phone' => $request->phone_number,
        ]);
        return back()->with("status", "Account settings updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
