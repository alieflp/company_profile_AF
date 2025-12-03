<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateBlogPostRequest extends FormRequest
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
            'title' => 'sometimes|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'gallery' => 'nullable|array|max:20',
            'gallery.*' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
            'removed_images' => 'nullable|array',
            'removed_images.*' => 'string',
            'remove_cover_image' => 'nullable|boolean',
            'author' => 'nullable|string|max:255',
            'is_published' => 'nullable|boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
        ];
    }
}
