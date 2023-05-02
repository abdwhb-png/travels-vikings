<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SystemRole;

class SystemRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'title'=>'Member',
            ],
            [
                'title'=>'Admin',
            ],
        ];

        foreach ($roles as $role) {
            SystemRole::create($role);
        }
    }
}
