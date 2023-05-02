<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'email'=>'customer-service1@gmail.com',
                'phone'=>'+916 123456789',
                'status'=>1,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'email'=>'customer-service2@gmail.com',
                'phone'=>'+916 987654321',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ];

        foreach ($services as $key => $service) {
            DB::table('customer_services')->insert($service);
        }
    }
}
