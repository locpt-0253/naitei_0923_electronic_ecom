<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address_id' => ['required', 'integer' ,'exists:addresses,id'],
            'payment_method' => ['required', 'string', Rule::in(config('app.payment_methods'))]
        ];
    }
}
