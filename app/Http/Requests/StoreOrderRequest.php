<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Change to true if you want to allow the request
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'customer_id' => [
                'required',
                'integer',
                'exists:customers,id',
            ],
            'products' => [
                'required',
                'array',
                'min:1',
            ],
            'products.*.id' => [
                'required',
                'integer',
                'exists:products,id',
            ],
            'products.*.amount' => [
                'sometimes',
                'integer',
                'min:1',
            ],
        ];
    }

    /**
     * Customize validation error messages.
     */
    public function messages(): array
    {
        return [
            'customer_id.required' => 'Customer ID is required.',
            'customer_id.exists' => 'Customer not found.',
            'products.required' => 'You must provide at least one product.',
            'products.array' => 'Products must be an array.',
            'products.*.id.required' => 'Each product must have an ID.',
            'products.*.id.exists' => 'Product not found.',
            'products.*.amount.integer' => 'Amount must be an integer.',
            'products.*.amount.min' => 'Amount must be at least 1.',
        ];
    }
}
