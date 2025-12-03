<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdatePortfolioRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    
    protected function prepareForValidation(): void
    {
        if (!$this->slug && $this->title) {
            $this->merge(['slug' => Str::slug($this->title.'-'.Str::uuid())]);
        }
        
        // Handle checkbox - if not present, set to false
        if (!$this->has('is_published')) {
            $this->merge(['is_published' => false]);
        }
    }
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
            'removed_images' => 'nullable|array',
            'removed_images.*' => 'string',
            'link' => 'nullable|url|max:255',
            'tech_stack' => 'nullable|string|max:500',
            'category' => 'nullable|string|max:100',
            'client' => 'nullable|string|max:255',
            'completed_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
        ];
    }
}
