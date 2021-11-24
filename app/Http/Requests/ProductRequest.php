<?php

namespace App\Http\Requests;

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
            'name' => 'required|min:3',
            'title' => 'required|min:5',
            'slug' => 'required|min:3',
            'descriptions' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:1024',
            'category_id' => 'required',
            'brand_id' => 'required',
            'summary' => 'required|min:3',
            'sku' => 'required|numeric',
            'price' => 'required|numeric',
            'sales' => 'nullable|numeric',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'The name field must be at least 3 characters and required.',
            'title.required' => 'The title must be at least 5 characters and required.',
            'slug.required' => 'The slug must be at least 3 characters required.',
            'image.required' => 'The Image must be jpeg,jpg,png and Max size 1MB.',
            'descriptions.required' => 'post tags must be 3 characters and required',
            'category_id.required' => 'select one category',
            'brand_id.required' => 'select one brand',
            'summary.required' => 'please fill the one summary from product',
            'sku.required' => 'The sku field must be number and required.',
            'price.required' => 'The price field must be decimal and required.',
            'sales.numeric' => 'The sales field must be decimal and required.',
        ];
    }
}