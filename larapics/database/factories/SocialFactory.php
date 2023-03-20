<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SocialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'instagram' => rand(0,1) == 1 ? $this->faker->url() : null,
            'facebook' => rand(0,1) == 1 ? $this->faker->url() : null,
            'twitter' => rand(0,1) == 1 ? $this->faker->url() : null,
            'website' => rand(0,1) == 1 ? $this->faker->url() : null,

        ];
    }
}
