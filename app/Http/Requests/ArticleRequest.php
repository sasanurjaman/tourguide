<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public ?int $id = null;
    public function rules(): array
    {
        return [
            'article_title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('articles', 'article_title')->ignore($this->id),
            ],
            'article_slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('articles', 'article_slug')->ignore($this->id)
            ],
            'article_description' => 'required|string',
            'article_image' => 'nullable|image|max:2048', // Max 2MB
        ];
    }
}
