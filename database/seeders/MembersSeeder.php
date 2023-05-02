<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SystemRole;
use App\Models\Member;
use App\Models\Refferal;
use App\Models\Task;
use App\Models\Deal;
use Illuminate\Support\Str;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $memberRole = SystemRole::where('title', 'Member')->first();
        $users = User::where('system_role_id', $memberRole->id)->get();
        $members = [];
        foreach($users as $user){
            $member = Member::create([
                'user_id' => $user->id,
                'phone' => '+916 1234678'.$user->id,
            ]);
            Refferal::create([
                'member_id' => $member->id,
                'invit_code' => Str::upper(Str::substr(Str::uuid(), 0, 8)),
            ]);
        }
    }
}
