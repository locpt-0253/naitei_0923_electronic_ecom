<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images', 'category')->paginate(config('app.admin_page_pagination_size'));

        return view('admin.products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('admin.products.create', ['categories' => Category::all()]);
    }

    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::create($request->validated());

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    if ($image && $image->isValid()) {
                        $imageContent = file_get_contents($image->path());
                        $fileName = 'public/products/' . $image->hashName();
                        Storage::put($fileName, $imageContent);

                        $imageModel = new Image();
                        $imageModel->image_url = Storage::url($fileName);
                        $imageModel->imageable_id = $product->id;
                        $imageModel->imageable_type = Product::class;
                        $imageModel->save();
                    }
                }
            }

            DB::commit();
            return back()->with('success', __('Create :resource :status', [
                'resource' => __('Product'),
                'status' => __('Success')
            ]));
        } catch (\Exception $e) {
            DB::rollback();

            return back()->withErrors(__('Error when :action the :resource', [
                'action' => __('Creating'),
                'resource' => __('Product')
            ]));
        }
    }

    public function edit($id)
    {
        $product = Product::with('category')->findOrFail($id);

        return view('admin.products.edit', ['product' => $product, 'categories' => Category::all()]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $product->update($request->validated());

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    if ($image && $image->isValid()) {
                        $imageContent = file_get_contents($image->path());
                        $fileName = 'public/products/' . $image->hashName();
                        Storage::put($fileName, $imageContent);

                        $imageModel = new Image();
                        $imageModel->image_url = Storage::url($fileName);
                        $imageModel->imageable_id = $product->id;
                        $imageModel->imageable_type = Product::class;
                        $imageModel->save();
                    }
                }
            }

            if ($request->has('delete_images')) {
                $deleteImages = $request->input('delete_images');
                $images = Image::where('imageable_id', $product->id)
                    ->where('imageable_type', Product::class)
                    ->whereIn('id', $deleteImages)
                    ->get();

                foreach ($images as $image) {
                    Storage::delete(str_replace('/storage', 'public', $image->image_url));
                    $image->delete();
                }
            }

            DB::commit();
            return back()->with('success', __('Update :resource :status', [
                'resource' => __('Product'),
                'status' => __('Success')
            ]));
        } catch (\Exception $e) {
            DB::rollback();

            return back()->withErrors(__('Error when :action the :resource', [
                'action' => __('Updating'),
                'resource' => __('Product')
            ]));
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $product = Product::with('reviews', 'images', 'carts')->find($id);

            if ($product) {
                $product->reviews()->delete();
                $product->carts()->delete();

                foreach ($product->images()->get() as $image) {
                    Storage::delete(str_replace('/storage', 'public', $image->image_url));
                    $image->delete();
                }

                $product->delete();

                DB::commit();
                return back()->with('success', __('Delete :resource :status', [
                    'resource' => __('Product'),
                    'status' => __('Success')
                ]));
            } else {
                return back()->with('error', __(':resource not found', [
                    'resource' => __('Product')
                ]));
            }
        } catch (\Exception $e) {
            DB::rollback();

            return back()->withErrors(__('Error when :action the :resource', [
                'action' => __('Deleting'),
                'resource' => __('Product')
            ]));
        }
    }
}
