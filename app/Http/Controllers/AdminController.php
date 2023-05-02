<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;
use App\Models\Refferal;
use App\Models\Deal;
use App\Models\ConnectionLog;
use App\Models\SystemRole;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\CommissionRatio;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
     protected function unsetItems($array, $itemsToUnset){
        foreach ($itemsToUnset as $item) {
            unset($array[$item]);
        }
        return $array;
    }

    protected function processDate($array){
        foreach ($array as $key => $value) {
            if($key == "created_at" || $key == "updated_at"){
                $value = Str::replaceArray('T', [' '], $value);
                $array[$key] = Str::replaceArray('.000000Z', [''], $value);
            }
        }
        return $array;
    }

    protected function uploadFile($file, $storagePath) {
      return $file->store($storagePath);
    }

    protected function deleteFile($path){
        if(\Storage::exists($path)){
            \Storage::delete($path);
        }
    }

    protected function sortCollection($collection){
        $items = $collection->all();
        ksort($items);
        return collect($items);
    }

    protected function memberList()
    {
        $members = Member::all();
        $list = [];
        foreach ($members as $member) {
            $invitation_code = $member->refferal->invit_code;
            $tasks = $member->tasks;
            $user = $member->user; 
            $member = collect($member);
            $member['invitation_code'] = $invitation_code;
            $member['username'] = $user->username; 
            $member['email'] = $user->email; 
            $member = $this->unsetItems($member, ["user_id", "refferal", "user", "tasks"]);
            $member = $this->processDate($member);
            $member = $this->sortCollection($member);
            $list[] = $member;
        }
        return $list;
    }

    protected function refferalsList()
    {
        $reff = Refferal::all();
        return $reff;
    }

    protected function connectionLogsList()
    {
        $logs = ConnectionLog::all();
        $list = [];
        foreach ($logs as $log) {
            $username = $log->user->username;
            $log = collect($log);
            $log['username'] = $username;
            $log = $this->unsetItems($log, ["user"]);
            $log = $this->processDate($log);
            $list[] = $log;
        }
        return $list;
    }

    protected function systemUsersList()
    {
        $adminRole = SystemRole::where('title', 'Admin')->first(); 
        $users = User::where('system_role_id', $adminRole->id)->get();
        $list = [];
        foreach ($users as $user) {
            $user = $this->unsetItems($user, ["system_role_id",  "email_verified_at", "password", "remember_token"]);
            $user = $this->processDate(collect($user));
            $list[] = $user;
        }
        return $list;
    }

    protected function systemRolesList()
    {
        $list = SystemRole::all();
        return $list;
    }

    protected function dealsList()
    {
        $list = Deal::all();
        return $list;
    }

    protected function customerServicesList()
    {
        $list = DB::table('customer_services')->get();
        return $list;
    }

    protected function getMember($id)
    {
        $member = Member::find($id);
        $user =  $member->user;
        $member = collect($member);
        $member['username'] = $user->username; 
        $member['email'] = $user->email; 
        $member = $this->unsetItems($member, ["user", "created_at", "updated_at", "status"]);
        return $member;
    }

    protected function getSystemUser($id)
    {
        $user = User::find($id);
        $user = $this->unsetItems($user, ["id", "system_role_id", "email_verified_at", "password", "remember_token", "created_at", "updated_at", "status"]);
        return $user;
    }

    protected function getCustomerService($id)
    {
        $item =  DB::table('customer_services')->where('id','=', $id)->first();
        $item = $this->unsetItems(collect($item), [ "id","created_at", "updated_at"]);
        return $item;
    }

     protected function storeMember($request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|unique:members',
            'balance' => 'required|numeric',
            'parent_id' => 'required|integer',
            'task_cost' => 'required|numeric',
        ]);
        if ($validator->fails()) {    
            return ['status' => false, 'errors' => $validator->messages(), 'message' => 'Please check the following errors'];
        }
        $user_data = ["username"=>$request['username'], "email"=>$request['email'], "parent_id"=>$request['parent_id'], "password"=>Hash::make($request['password'])];
        $user = User::create($user_data);
        if($user){
            $member_data = [
                "balance"=>$request['balance'],
                "user_id"=>$user->id,
                "phone"=>$request['phone'],
                "parent_id"=>$request['parent_id'],
            ];
            $member = Member::create($member_data);
            $deals = Deal::all()->random(40)->unique();
            if($member)
                for($i = 0; $i < 40; $i++){
                    $deal = $deals[$i];
                    Task::create([
                        'member_id' => $member->id,
                        'deal_id' => $deal->id,
                        'task_number' => $i+1,
                        'task_cost' => $request->task_cost,
                    ]);
                }
                $ref = Refferal::create([
                    'member_id' => $member->id,
                    'invit_code' => Str::upper(Str::substr(Str::uuid(), 0, 8)),
                ]);
                $com = CommissionRatio::create([
                    'member_id'=> $member->id,
                    'value'=> $member->commission_ratio1,
                ]);
                if($ref && $com)
                    return ['status' => true, 'message' => 'Member successfully created'];
        }
        return ['status' => false, 'message' => 'Oops, something\'s wrong'];
    }

    protected function storeSystemUser($request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
        ]);
        if ($validator->fails()) {    
            return ['status' => false, 'errors' => $validator->messages(), 'message' => 'Please check the following errors'];
        }

        $adminRole = SystemRole::where('title', 'Admin')->first();
        $user_data = ["username"=>$request['username'], "email"=>$request['email'], "system_role_id"=>$adminRole->id, "password"=>Hash::make($request['password'])];
        $user = User::create($user_data);
        if($user){
            return ['status' => true, 'message' => 'System user successfully created'];
        }
        return ['status' => false, 'message' => 'Oops, something\'s wrong'];
    }

    protected function storeCustomerService($request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:customer_services',
            'phone' => 'required|string|unique:customer_services',
        ]);
        if ($validator->fails()) {    
            return ['status' => false, 'errors' => $validator->messages(), 'message' => 'Please check the following errors'];
        }
        $request['created_at'] = now();
        $request['updated_at'] = now();
        if(DB::table('customer_services')->insert($request->all()))
            return ['status' => true, 'message' => 'Customer service successfully created'];
        return ['status' => false, 'message' => 'Oops, something\'s wrong'];
    }

    protected function updateSystemUser($id, $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
        if ($validator->fails()) {    
            return ['status' => false, 'errors' => $validator->messages(), 'message' => 'Please check the following errors'];
        }

        $user = User::find($id);

        if($user->update($request->all()))
            return ['status' => true, 'message' => 'System user successfully updated'];
        else return ['status' => false, 'message' => 'Oops, something\'s wrong'];
    }

    protected function updateMember($id, $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users,username,'.$request->user_id,
            'email' => 'required|email|unique:users,email,'.$request->user_id,
            'phone' => 'required|string|unique:members,phone,'.$id,
            'balance' => 'required|numeric',
            'commission_ratio1' => 'required|decimal:2',
            'commission_ratio2' => 'required|decimal:2',
            'min_balance' => 'required|numeric',
            'min_withdrawal' => 'required|numeric',
            'max_withdrawal' => 'required|numeric',
            'parent_id' => 'required|integer',
        ]);
        if ($validator->fails()) {    
            return ['status' => false, 'errors' => $validator->messages(), 'message' => 'Please check the following errors'];
        }
        $user_data = ["username"=>$request['username'], "email"=>$request['email']];
        $member_data = $this->unsetItems($request->all(), [ "username", "email", "user_id"]);

        $member = Member::find($id);
        $user =  $member->user;

        if($user->update($user_data) && $member->update($member_data))
            return ['status' => true, 'message' => 'Member successfully updated'];
        else return ['status' => false, 'message' => 'Oops, something\'s wrong'];
    }

    protected function updateCustomerService($id, $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:customer_services,email,'.$id,            'phone' => 'required|string|unique:customer_services,phone,'.$id,
        ]);
        if ($validator->fails()) {    
            return ['status' => false, 'errors' => $validator->messages(), 'message' => 'Please check the following errors'];
        }
        $request['updated_at'] = now();
        if(DB::table('customer_services')->where('id', '=',$id)->update($request->all())) return ['status' => true, 'message' => 'Customer service successfully updated'];
        else return ['status' => false, 'message' => 'Oops, something\'s wrong'];
    }

    protected function deleteMember($id){
        $user = User::find($id);
        if($user && $user->delete($id)) return ['status' => true, 'message' => 'Member successfully deleted'];
        else return ['status' => false, 'message' => 'Oops, something\'s wrong'];
    }

    protected function deleteSystemUser($id){
        $user = User::find($id);
        if($user && $user->delete($id)) return ['status' => true, 'message' => 'System user successfully deleted'];
        else return ['status' => false, 'message' => 'Oops, something\'s wrong'];
    }

    protected function deleteCustomerService($id){
        if(DB::table('customer_services')->where('id','=', $id)->delete()) return ['status' => true, 'message' => 'Customers Service successfully deleted'];
        else return ['status' => false, 'message' => 'Oops, something\'s wrong'];
    }

    protected function deleteDeal($id){
        $deal = Deal::find($id);
        if($deal->duplicated) return ['status' => false, 'message' => 'Oops, something\'s wrong'];
        $path = $deal->image_path;
        if($deal->delete($id)){
            $this->deleteFile('public'.$path);
            return ['status' => true, 'message' => 'Deal successfully deleted'];
        } 
        else return ['status' => false, 'message' => 'Oops, something\'s wrong'];
    }


    public function index()
    {
        $total_members = Member::all();
        $yesterday_members = Member::whereDate('created_at', '=', date('Y-m-d', strtotime("yesterday")))->get();
        $today_members = Member::whereDate('created_at', '=', date('Y-m-d'))->get();
        $members = [
            "total_count" => $total_members->count(),
            "yesterday_count" => $yesterday_members->count(),
            "today_count" => $today_members->count(),
        ];

        $total_deals = Deal::all();
        $yesterday_deals = Deal::whereDate('created_at', '=', date('Y-m-d', strtotime("yesterday")))->get();
        $today_deals = Deal::whereDate('created_at', '=', date('Y-m-d'))->get();
        $deals = [
            "total_count" => $total_deals->count(),
            "yesterday_count" => $yesterday_deals->count(),
            "today_count" => $today_deals->count(),
        ];

        $total_com = Member::where('total_commission', '>', 0)->sum('total_commission');
        $yesterday_com = Member::whereDate('updated_at', '=', date('Y-m-d', strtotime("yesterday")))->where('total_commission', '>', 0)->sum('total_commission');
        $today_com = Member::whereDate('updated_at', '=', date('Y-m-d'))->where('total_commission', '>', 0)->sum('total_commission');
        $com = [
            "total_com" => $total_com,
            "yesterday_com" => $yesterday_com,
            "today_com" => $today_com,
        ];

        $total_balance = Member::sum('balance');
        $today_balance = Member::whereDate('created_at', '=', date('Y-m-d'))->sum('balance');
        $balance = [
            "today" => $today_balance,
            "total" => $total_balance,
        ];

        $total_frozen_balance = Member::where('status', '=', 0)->sum('balance');
        $total_frozen_members = Member::where('status', '=', 0)->count();
        $frozen = [
            "balance" => $total_frozen_balance,
            "members" => $total_frozen_members,
        ];

        $completed_tasks = Task::whereDate('updated_at', '=', date('Y-m-d'))->where('task_status',1)->count();
        return view('admin.dashboard', compact('members', 'deals', 'com', 'balance', 'frozen', 'completed_tasks'));
    }

    public function create($param)
    {
        $dealCount = Deal::count();
        return view('admin.create', compact('param', 'dealCount'));
    }

    public function store($param, Request $request)
    {
        $response = [];
        if($param == 'member'){
            $response = $this->storeMember($request);
        }
        if($param == 'customer-service'){
            $response = $this->storeCustomerService($request);
        }
        if($param == 'system-user'){
            $response = $this->storeSystemUser($request);
        }
        if($param == 'deal'){
            Validator::make($request->all(), [
                'title' => 'required|string|unique:deals',
                'description' => 'required|string|max:500',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ])->validate();
            $deal = Deal::create([
                'title' => $request->title,
                'description' => $request->description,
                'image_path' => Str::replaceArray('public', [''], $this->uploadFile($request->file('image'), 'public/deals')),
            ]);
            if($deal) return redirect('/admin/deals/all');
        }
        return response()->json(['res' => $response], Response::HTTP_OK);
    }

    public function showTasks($member_id){
        $tasks = Task::where('member_id',$member_id)->paginate(10);
        return view('admin.tasks', compact('tasks'));
    }

    public function edit($param, $id)
    {
        if($param == 'deal'){
            $deal = Deal::find($id);
            return view('admin.edit', compact('param', 'deal'));
        }
        if($param == 'task'){
            $task = Deal::find($id);
            return view('admin.edit', compact('param', 'task'));
        }
        return view('admin.edit', compact('param', 'id'));
    }

    public function update($param, $id, Request $request)
    {
        $response = [];
        if($param == 'member'){
            $response = $this->updateMember($id, $request);
        }
        if($param == 'customer-service'){
            $response = $this->updateCustomerService($id, $request);
        }
        if($param == 'system-user'){
            $response = $this->updateSystemUser($id, $request);
        }
        if($param == 'deal'){
             Validator::make($request->all(), [
                'title' => 'required|string|unique:deals,title,'.$id,
                'description' => 'required|string|max:500',
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ])->validate();
            $deal = Deal::find($id);
            $deal->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            if($request->file('image')){
                $this->deleteFile('public'.$deal->image_path);
                $deal->update([
                    'image_path' => Str::replaceArray('public/', ['/'], $this->uploadFile($request->file('image'), 'public/deals')),
                ]);
            }
            return redirect('/admin/deals/all');
        }
        if($param = 'task'){
            $task = Task::find($id);
            $task->update(['task_cost' => $request->cost]);
            return redirect()->back();
        }
        
        return response()->json(['res' => $response], Response::HTTP_OK);
    }
    
    public function destroy($param, $id)
    {
        $response = [];
        if($param == 'member'){
            $response = $this->deleteMember($id);
        }
        if($param == 'customer-service'){
            $response = $this->deleteCustomerService($id);
        }
        if($param == 'system-user'){
            $response = $this->deleteSystemUser($id);
        }
        if($param == 'deal'){
            $response = $this->deleteDeal($id);
        }
        
        return response()->json(['res' => $response], Response::HTTP_OK);
    }

    public function changePassword($id, Request $request)
    {
        $new_password = ['password' => Hash::make($request['password'])];

        $user = User::find($id);

        if($user->update($new_password))
            $response = ['status' => true, 'message' => 'Password successfully changed'];
        else $response = ['status' => false, 'message' => 'Oops, something\'s wrong'];
        return response()->json(['res' => $response], Response::HTTP_OK);
    }
    public function changeCustomerServiceStatus($id, Request $request)
    {
        $cs = DB::table('customer_services')->where('id','=', $id)->first();
        $others = DB::table('customer_services')->where('id', '<>', $id)->get();
        $err = '';
        if($cs->status == $request->status && $request->status == 0){
            if(DB::table('customer_services')->where('id','=', $id)->update(['status' => 1, 'updated_at' => now()])){
                foreach ($others as $other) {
                   DB::table('customer_services')->where('id','=', $other->id)->update(['status' => 0]);
                }
                return response()->json(['status' => true], Response::HTTP_OK);
            
            }$err = 'error on update';
        }$err = 'error on status'.$cs->status;
        return response()->json(['status' => false, 'error' => $err], Response::HTTP_OK);
    }
    public function changeMemberStatus($id, Request $request)
    {
        $member = Member::where('user_id',$id)->first();
        if($member && $member->status == $request->status){
            if($member->update(['status' => !($request->status)])){
                return response()->json(['status' => true], Response::HTTP_OK);
            }
            $err = "update impossible";
        }
        $err = "member not found";
        return response()->json(['status' => false, 'err' => $err], Response::HTTP_OK);
    }
    public function duplicateDeal(Request $request)
    {
       $deal = Deal::create([
                'title' => $request->title.'_'.Str::upper(Str::substr(Str::uuid(), 0, 8)),
                'description' => $request->description,
                'duplicated' => 1,
                'image_path' => $request->image_path,
            ]);
            if(!!!($deal)) return response()->json(['status' => false, 'err' => 'Impossible to duplicate'], Response::HTTP_OK);
            else return response()->json(['status' => true], Response::HTTP_OK);
    }

    public function system($param)
    {
        return view('admin.system')->with('param', $param);
    }
    
    public function deals($param)
    {
        return view('admin.deals')->with('param', $param);
    }

    public function members($param)
    {
        // $list = [];
        // if($param == 'list'){
        //     $list = $this->memberList();
        // }

        return view('admin.members', compact('param'));
    }

    public function getList($param)
    {
        $list = [];
        if($param == 'members'){
            $list = $this->memberList();
        }
        if($param == 'connection-logs'){
            $list = $this->connectionLogsList();
        }
        if($param == 'refferals'){
            $list = $this->refferalsList();
        }
        if($param == 'customer-services'){
            $list = $this->customerServicesList();
        }
        if($param == 'system-roles'){
            $list = $this->systemRolesList();
        }
        if($param == 'system-users'){
            $list = $this->systemUsersList();
        }
        if($param == 'deals'){
            $list = $this->dealsList();
        }
            return response()->json(['list' => $list], Response::HTTP_OK);
    }

    public function getItem($param, $id)
    {
        $item = [];
        if($param == 'member'){
            $item = $this->getMember($id);
        }
        if($param == 'customer-service'){
            $item = $this->getCustomerService($id);
        }
        if($param == 'system-user'){
            $item = $this->getSystemUser($id);
        }
        
        return response()->json(['item' => $item], Response::HTTP_OK);
    }

    public function makeWithdrawal($id, Request $request)
    {
        $member = Member::find($id);
        if($member && $member->balance > $request->amount){
            $member->update(['balance' => $member->balance - $request->amount]);
            Transaction::create([
                'member_id' => $member->id,
                'type' => 0,
                'title' => 'Withdrawal '.Str::upper(Str::substr(Str::uuid(), 0, 8)),
                'amount' => $request->amount,
            ]);
        }
    }
}
