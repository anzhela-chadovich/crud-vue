<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string',
            'description' => 'required|string',
            'image'=>'required',
            'category' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|integer'
        ];
    }

    public function messages():array
    {
        return [
            'name.required' => 'Name is required',
            'description.required' => 'Description is required',
            'image.required' => 'Image is required',
            'category.required' => 'Category is required',
            'quantity.required' => 'Quantity is required',
            'price.required' => 'Price is required'
        ];
    }
}
