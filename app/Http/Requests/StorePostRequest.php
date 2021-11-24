<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|min:5|unique:posts,title',
            'subtitle' => 'required|min:5 The',
            'slug' => 'required',
            'tags' => 'required',
            'body' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|required|max:1024',
            'category' => 'required',
            'meta_description' => 'required|min:3',
            'meta_keywords' => 'required|min:3',
            'seo_title' => 'required|min:3',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'The title must be 8 characters and unique title.',
            'subtitle.required' => ' subtitle is required',
            'slug.required' => 'the slug is required.',
            'tags.required' => 'oost tags must be 3 characters and required',
            'body.required' => 'The body or content post is required.',
            'image.required' => 'The Image must be jpeg,jpg,png and 2mb',
            'category.required' => 'the category is required.',
            'meta_description.required' => 'meta description must be at least 3 characters.',
            'meta_keywords.required' => 'meta keywords must be at least 3 characters.',
            'seo_title.required' => 'seo title is required.',
        ];
    }
}
