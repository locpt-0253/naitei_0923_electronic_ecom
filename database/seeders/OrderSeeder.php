<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::factory(100)->create();
        foreach($orders as $order) {
            $products = Product::inRandomOrder()->limit(5)->get();
            foreach($products as $product) {
                $order->products()->attach($product->id, ['quantity' => rand(1, 3)]);
            }
        }
    }
}
