<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'categoryId' => ['numeric', 'nullable', 'exists:categories,id'],
            'sortBy' => ['string', Rule::in(config('app.available_sort_by')), 'nullable'],
            'sort' => ['string', Rule::in(config('app.available_sort')), 'nullable'],
            'ratingFilter' => ['numeric', 'nullable', 'min:1', 'max:'.config('constants.max_ratings')],
            'minPrice' => ['numeric', 'min:0', 'nullable'],
            'maxPrice' => ['numeric', 'min:0', 'nullable'],
        ];
    }
}
