<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutUsRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'meta' => 'nullable|array',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'core_values' => 'nullable|array|max:4',
            'core_values.*.title' => 'nullable|string|max:100',
            'core_values.*.description' => 'nullable|string|max:255',
            'core_values.*.icon' => 'nullable|string|max:50',
        ];
    }
}
