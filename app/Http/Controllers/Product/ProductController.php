<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'categoryId' => ['numeric', 'nullable', 'exists:categories,id'],
            'sortBy' => ['string', Rule::in(config('app.available_sort_by')), 'nullable'],
            'sort' => ['string', Rule::in(config('app.available_sort')), 'nullable'],
            'ratingFilter' => ['numeric', 'nullable', 'max:'.config('constants.max_ratings')],
            'minPrice' => ['numeric', 'min:0', 'nullable'],
            'maxPrice' => ['numeric', 'min:0', 'nullable'],
        ]);
        
        $categoryId = $request->categoryId;
        $sortBy = $request->input('sortBy', 'name');
        $sort = $request->input('sort', 'desc');
        $ratingFilter = $request->ratingFilter;
        $minPrice = $request->input('minPrice', 0);
        $maxPrice = $request->maxPrice;

        $allCategories = Category::all();
        $currentCategory = $categoryId ? Category::find($categoryId) : null ;

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
