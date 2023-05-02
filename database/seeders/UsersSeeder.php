<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SystemRole;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = SystemRole::where('title', 'Admin')->first();
        $memberRole = SystemRole::where('title', 'Member')->first();
        $users = [
            [
                'system_role_id'=> $memberRole->id,
                'username'=> 'test user1',
                'email'=> 'test1@gmail.com',
                'email_verified_at'=> now(),
                'password' => Hash::make('password'),
            ],
            [
                'system_role_id'=> $memberRole->id,
                'username'=> 'test user2',
                'email'=> 'test2@gmail.com',
                'email_verified_at'=> now(),
                'password' => Hash::make('password'),
            ],
            [
                'system_role_id'=> $adminRole->id,
                'username'=> 'admin',
                'email'=> 'admin@travels-vikings.com',
                'email_verified_at'=> now(),
                'password' => Hash::make('password'),
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
