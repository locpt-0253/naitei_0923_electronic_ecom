<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(15),
            'description' => $this->faker->text(100),
            'price' => $this->faker->numberBetween(10000, 500000),
            'sold_quantity' => $this->faker->numberBetween(0, 5000),
            'status' => $this->faker->numberBetween(1, 5),
            'stock_quantity' => $this->faker->numberBetween(0, 3000),
            'category_id' => DB::table('categories')->inRandomOrder()->first()->id,
        ];
    }
}
