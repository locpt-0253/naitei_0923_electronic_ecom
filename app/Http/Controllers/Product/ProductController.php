<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(20);

        return response()->json([
            "data" => $products,
        ]);
    }

    public function show($productId)
    {
        $product = Product::with('reviews.user', 'category')->find($productId);

        return response()->json([
            "data" => $product,
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        $product = Product::create($validatedData);

        return response()->json([
            "data" => $product,
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validate();

        $product->update($validatedData);

        return response()->json([
            "data" => $product,
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            "message" => "Product deleted successfully!",
        ]);
    }
}
