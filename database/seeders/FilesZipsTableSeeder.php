<?php

namespace Database\Seeders;

use App\Models\FileZip;
use Illuminate\Database\Seeder;

class FilesZipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FileZip::truncate();

        $faker = \Faker\Factory::create();

        for ($i=0; $i < 5; $i++) { 
            FileZip::create(['name' => $faker->word.'.doc', 'user_id' => 1]);
        }
        for ($j=0; $j < 5; $j++) { 
            FileZip::create(['name' => $faker->word.'.txt' , 'user_id' => 1]);
        }
    }
}
