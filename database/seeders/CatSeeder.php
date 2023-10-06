<?php

namespace Database\Seeders;

use App\Lib\CatImageUploader;
use App\Models\Breed;
use App\Models\Cat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cat::factory(10)->create();
    }
}
