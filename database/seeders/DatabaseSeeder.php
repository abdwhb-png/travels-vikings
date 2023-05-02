<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SystemRolesSeeder::class,
            CustomerServiceSeeder::class,
            DealsSeeder::class,
            UsersSeeder::class,
            MembersSeeder::class,
        ]);
    }
}
