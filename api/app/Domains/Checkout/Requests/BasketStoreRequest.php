<?php

namespace App\Domains\Checkout\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasketStoreRequest extends FormRequest
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
            'products' => [
                'required',
                'array',
            ],
            'products.*.id' => [
                'required',
                'exists:product_variations,id',
            ],
            'products.*.quantity' => [
                'numeric',
                'min:1',
            ]
        ];
    }
}
