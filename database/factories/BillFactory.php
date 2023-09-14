<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => DB::table('orders')->inRandomOrder()->first()->id,
            'payment_method' => $this->faker->randomElement(config('app.payment_methods')),
            'total' => $this->faker->numberBetween(10000, 900000),
        ];
    }
}
