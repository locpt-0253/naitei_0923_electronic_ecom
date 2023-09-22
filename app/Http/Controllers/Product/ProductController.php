<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(ProductRequest $request)
    {
        $request->validated();
        
        $categoryId = $request->categoryId;
        $sortBy = $request->input('sortBy', 'name');
        $sort = $request->input('sort', 'desc');
        $ratingFilter = $request->ratingFilter;
        $minPrice = $request->input('minPrice', 0);
        $maxPrice = $request->maxPrice;

        $allCategories = Category::all();
        $currentCategory = $categoryId ? Category::find($categoryId) : null;

        $products = Product::with('reviews')
            ->when($minPrice, function ($query) use ($minPrice) {
                return $query->where('price', '>=', $minPrice);
            })
            ->when($maxPrice, function ($query) use ($maxPrice) {
                return $query->where('price', '<=', $maxPrice);
            })
            ->when($sortBy, function ($query) use ($sortBy, $sort) {
                return $query->orderBy($sortBy, $sort);
            })
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->paginate(20);

        return view('product.index', [
            'products' => $products,
            'allCategories' => $allCategories,
            'currentCategory' => $currentCategory,
        ]);
    }

    public function show($productId)
    {
        $product = Product::with('reviews.user', 'category')->find($productId);

        return view('product.show', [
            'product' => $product,
        ]);
    }
}
