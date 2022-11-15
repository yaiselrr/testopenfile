<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::truncate();

        $faker = \Faker\Factory::create();

        for ($i=0; $i < 5; $i++) { 
            File::create(['name' => $faker->word.'.doc', 'user_id' => 1]);
        }
        for ($j=0; $j < 5; $j++) { 
            File::create(['name' => $faker->word.'.doc', 'user_id' => 1]);
        }
    }
}
