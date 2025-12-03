<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactMessageStatusRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'status' => 'sometimes|required|string|in:new,read,responded,archived',
            'response_notes' => 'nullable|string',
        ];
    }
}
