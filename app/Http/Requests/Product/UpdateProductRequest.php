<?php

namespace App\Http\Requests\Product;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sold_quantity' => 'required|integer|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'status' => [
                'required',
                Rule::in(array_values(config('app.product_status')))
            ],
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
