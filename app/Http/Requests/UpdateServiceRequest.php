<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'icon_type' => 'sometimes|string|in:code,mobile,cloud,database,ui-ux,security,ai,consulting,devops,analytics,api,ecommerce,support,network,blockchain,automation',
            'icon_color' => 'sometimes|string|in:blue,purple,green,orange,red,cyan,pink,indigo',
            'image' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ];
    }
}
