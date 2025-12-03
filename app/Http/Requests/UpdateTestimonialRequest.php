<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'position' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'avatar' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:5',
            'is_approved' => 'boolean',
        ];
    }
}
