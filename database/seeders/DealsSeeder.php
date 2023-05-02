<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Deal;

class DealsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=5;$i++){
             Deal::create([
                'title'=> 'Default Deal'. $i,
                'description'=> 'Default Description',
                'image_path'=> '/deals/default.jpg',
            ]);
        }
    }
}
