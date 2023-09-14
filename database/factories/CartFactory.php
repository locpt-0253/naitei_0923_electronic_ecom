<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
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
            'quantity' => $this->faker->numberBetween(1, 3),
        ];
    }
}
