<?php

namespace Database\Factories;

use App\Lib\CatImageUploader;
use App\Models\Breed;
use Illuminate\Database\Eloquent\Factories\Factory;
use GuzzleHttp\Client;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cat>
 */
class CatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $breeds = Breed::all();

        $imageUploader = new CatImageUploader();
        $url = $imageUploader->uploadImageToStorageFolder('images');

        return [
            'name' => fake()->name(),
            'age' => rand(1, 25),
            'breed_id' => $breeds->random()->id,
            'image' => $url,
        ];
    }
}
