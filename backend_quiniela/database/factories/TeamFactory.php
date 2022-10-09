<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'logo_url' => 'https://img2.freepng.es/20180527/utr/kisspng-real-betis-la-liga-spain-atltico-madrid-real-mad-escudos-de-futbol-5b0a5bc2b97437.2741859115274055067596.jpg'
        ];
    }
}
