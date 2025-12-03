@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900">Edit Service</h2>
    <p class="text-sm text-slate-600 mt-1">Update service information</p>
</div>

<form method="POST" action="{{ route('admin.services.update', $service->id ?? 0) }}" class="max-w-3xl">
    @csrf
    @method('PUT')
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
        {{-- Title Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Service Name <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                name="title" 
                value="{{ old('title', $service->title ?? $service->name ?? '') }}"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                placeholder="e.g. Web Development, Mobile App Development"
                required
            />
            @error('title')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">The main title of your service</p>
        </div>

        {{-- Icon Type Selection --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Service Icon <span class="text-red-500">*</span>
            </label>
            <div class="grid grid-cols-4 md:grid-cols-8 gap-3">
                @php
                $iconTypes = [
                    'code' => 'Web Dev',
                    'mobile' => 'Mobile App',
                    'cloud' => 'Cloud',
                    'database' => 'Database',
                    'ui-ux' => 'UI/UX',
                    'security' => 'Security',
                    'ai' => 'AI/ML',
                    'consulting' => 'Consulting',
                    'devops' => 'DevOps',
                    'analytics' => 'Analytics',
                    'api' => 'API',
                    'ecommerce' => 'E-commerce',
                    'support' => 'Support',
                    'network' => 'Network',
                    'blockchain' => 'Blockchain',
                    'automation' => 'Automation'
                ];
                @endphp
                @foreach($iconTypes as $type => $label)
                <label class="relative flex flex-col items-center gap-2 p-3 rounded-lg border-2 border-slate-200 cursor-pointer hover:border-blue-500 transition group">
                    <input 
                        type="radio" 
                        name="icon_type" 
                        value="{{ $type }}"
                        {{ old('icon_type', $service->icon_type ?? 'code') === $type ? 'checked' : '' }}
                        class="sr-only peer"
                        required
                    />
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center peer-checked:from-blue-600 peer-checked:to-cyan-600 peer-checked:shadow-lg transition">
                        @include('partials.service-icon', ['type' => $type])
                    </div>
                    <span class="text-xs font-medium text-slate-600 peer-checked:text-blue-600 text-center">{{ $label }}</span>
                    <div class="absolute inset-0 rounded-lg border-2 border-blue-600 opacity-0 peer-checked:opacity-100 transition"></div>
                </label>
                @endforeach
            </div>
            @error('icon_type')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-2">Select an icon that best represents this service</p>
        </div>

        {{-- Icon Color Selection --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Icon Color Scheme <span class="text-red-500">*</span>
            </label>
            <div class="grid grid-cols-4 md:grid-cols-8 gap-3">
                @php
                $colorSchemes = [
                    'blue' => ['from' => 'from-blue-500', 'to' => 'to-blue-600', 'name' => 'Blue'],
                    'purple' => ['from' => 'from-purple-500', 'to' => 'to-purple-600', 'name' => 'Purple'],
                    'green' => ['from' => 'from-green-500', 'to' => 'to-green-600', 'name' => 'Green'],
                    'orange' => ['from' => 'from-orange-500', 'to' => 'to-orange-600', 'name' => 'Orange'],
                    'red' => ['from' => 'from-red-500', 'to' => 'to-red-600', 'name' => 'Red'],
                    'cyan' => ['from' => 'from-cyan-500', 'to' => 'to-cyan-600', 'name' => 'Cyan'],
                    'pink' => ['from' => 'from-pink-500', 'to' => 'to-pink-600', 'name' => 'Pink'],
                    'indigo' => ['from' => 'from-indigo-500', 'to' => 'to-indigo-600', 'name' => 'Indigo']
                ];
                @endphp
                @foreach($colorSchemes as $color => $scheme)
                <label class="relative flex flex-col items-center gap-2 p-3 rounded-lg border-2 border-slate-200 cursor-pointer hover:border-{{ $color }}-500 transition">
                    <input 
                        type="radio" 
                        name="icon_color" 
                        value="{{ $color }}"
                        {{ old('icon_color', $service->icon_color ?? 'blue') === $color ? 'checked' : '' }}
                        class="sr-only peer"
                        required
                    />
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br {{ $scheme['from'] }} {{ $scheme['to'] }} peer-checked:shadow-lg transition"></div>
                    <span class="text-xs font-medium text-slate-600 peer-checked:text-{{ $color }}-600">{{ $scheme['name'] }}</span>
                    <div class="absolute inset-0 rounded-lg border-2 border-{{ $color }}-600 opacity-0 peer-checked:opacity-100 transition"></div>
                </label>
                @endforeach
            </div>
            @error('icon_color')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-2">Choose a color scheme for the service icon</p>
        </div>

        {{-- Short Description --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Short Description
            </label>
            <input 
                type="text" 
                name="short_description" 
                value="{{ old('short_description', $service->short_description ?? $service->excerpt ?? '') }}"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                placeholder="Brief one-line summary of the service"
                maxlength="100"
            />
            @error('short_description')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Optional: A brief tagline (max 100 characters)</p>
        </div>

        {{-- Description Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Full Description <span class="text-red-500">*</span>
            </label>
            <textarea 
                name="description" 
                rows="6" 
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Provide detailed information about this service"
                required
            >{{ old('description', $service->description ?? '') }}</textarea>
            @error('description')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Detailed explanation of what this service offers</p>
        </div>

        {{-- Active Checkbox --}}
        <div class="flex items-start gap-3 p-4 rounded-lg bg-slate-50 border border-slate-200">
            <input 
                type="checkbox" 
                name="active" 
                value="1" 
                id="active" 
                {{ ($service->is_active ?? $service->active ?? false) ? 'checked' : '' }}
                class="mt-1 rounded border-slate-300 text-blue-600 focus:ring-blue-500" 
            />
            <label for="active" class="flex-1">
                <span class="block text-sm font-semibold text-slate-700">Active Service</span>
                <span class="text-xs text-slate-500">Make this service visible on the public website</span>
            </label>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
            <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:from-blue-700 hover:to-cyan-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>Update Service</span>
            </button>
            <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-2 px-6 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">
                <span>Cancel</span>
            </a>
        </div>
    </div>
</form>
@endsection