<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $products = Product::all();

        foreach ($users as $user) {
            $user->image()->create([
                'image_url' => Storage::url('default_user.png'),
            ]);
        }

        foreach ($products as $product) {
            $product->images()->create([
                'image_url' => Storage::url('default_product.png'),
            ]);
        }
    }
}
