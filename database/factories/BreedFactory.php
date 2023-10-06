<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Breed>
 */
class BreedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected static $i = 0;

    public function definition()
    {
        $breeds = collect([
            'Мейн-кун', 
            'Шотландская вислоухая', 
            'Британская короткошерстная', 
            'Бенгальская', 
            'Сиамская', 
            'Абиссинская', 
            'Сибирская',
            'Саванна',
            'Корниш-рекс',
            'Бурманская',
        ]);

        return [
            'title' => $breeds[(self::$i++)%10], //fake()->name(),
            'description' => $this->faker->text(300),
            'average_age' => rand(8, 15),
        ];
    }
}
