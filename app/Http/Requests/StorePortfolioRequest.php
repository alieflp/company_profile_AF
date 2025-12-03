<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StorePortfolioRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    protected function prepareForValidation(): void
    {
        if (!$this->slug && $this->title) {
            $this->merge(['slug' => Str::slug($this->title.'-'.Str::uuid())]);
        }
    }
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:portfolios,slug',
            'excerpt' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
            'link' => 'nullable|url|max:255',
            'tech_stack' => 'nullable|string|max:500',
            'category' => 'nullable|string|max:100',
            'client' => 'nullable|string|max:255',
            'completed_at' => 'nullable|date',
            'is_published' => 'boolean',
        ];
    }
}
