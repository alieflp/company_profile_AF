<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug',
            'excerpt' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'icon_type' => 'required|string|in:code,mobile,cloud,database,ui-ux,security,ai,consulting,devops,analytics,api,ecommerce,support,network,blockchain,automation',
            'icon_color' => 'required|string|in:blue,purple,green,orange,red,cyan,pink,indigo',
            'image' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ];
    }
}
