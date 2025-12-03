<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreBlogPostRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    
    protected function prepareForValidation(): void
    {
        if (!$this->slug && $this->title) {
            $this->merge(['slug' => Str::slug($this->title.'-'.Str::uuid())]);
        }
        
        // Handle tags if it's a string (from form input)
        if ($this->has('tags') && is_string($this->input('tags'))) {
            $tags = collect(explode(',', $this->input('tags')))
                ->map(fn($t) => trim($t))
                ->filter()
                ->values()
                ->all();
            $this->merge(['tags' => $tags]);
        }
    }
    
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'gallery' => 'nullable|array|max:20',
            'gallery.*' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
            'author' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
        ];
    }
}
