<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => DB::table('users')->inRandomOrder()->first()->id,
            'product_id' => DB::table('products')->inRandomOrder()->first()->id,
            'content' => $this->faker->text(50),
            'star' => $this->faker->numberBetween(1, 5),
        ];
    }
}
