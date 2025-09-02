<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PackageRequest extends FormRequest
{
    public ?int $id = null; // ID paket yang sedang diedit

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'package_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('packages', 'package_name')->ignore($this->id),
            ],
            'package_description' => 'required|string',
            'package_price' => 'required|numeric|min:0',
            'package_image' => 'nullable|image|max:2048',
        ];
    }
}
