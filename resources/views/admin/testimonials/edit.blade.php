@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900">Edit Testimonial</h2>
    <p class="text-sm text-slate-600 mt-1">Review and update testimonial details</p>
</div>

<form method="POST" action="{{ route('admin.testimonials.update', $testimonial->id ?? 0) }}" class="max-w-3xl">
    @csrf
    @method('PUT')
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
        {{-- Name Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Client Name <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                name="name" 
                value="{{ old('name', $testimonial->name ?? '') }}"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                placeholder="e.g. John Doe"
                required
            />
            @error('name')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Full name of the person providing testimonial</p>
        </div>

        {{-- Position Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Position / Title
            </label>
            <input 
                type="text" 
                name="position" 
                value="{{ old('position', $testimonial->position ?? '') }}"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                placeholder="e.g. CEO, Marketing Manager"
            />
            @error('position')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Optional: Job title or position</p>
        </div>

        {{-- Company Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Company Name
            </label>
            <input 
                type="text" 
                name="company" 
                value="{{ old('company', $testimonial->company ?? '') }}"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                placeholder="e.g. ABC Corporation"
            />
            @error('company')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Optional: Company or organization name</p>
        </div>

        {{-- Rating Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Rating
            </label>
            <select 
                name="rating" 
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            >
                @for($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? 5) == $i ? 'selected' : '' }}>
                        {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                    </option>
                @endfor
            </select>
            @error('rating')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Optional: Star rating (1-5)</p>
        </div>

        {{-- Message Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Testimonial Message <span class="text-red-500">*</span>
            </label>
            <textarea 
                name="message" 
                rows="5" 
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Enter the client's testimonial message here..."
                required
            >{{ old('message', $testimonial->message ?? $testimonial->content ?? '') }}</textarea>
            @error('message')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">The testimonial text from the client</p>
        </div>

        {{-- Approved Checkbox --}}
        <div class="flex items-start gap-3 p-4 rounded-lg bg-slate-50 border border-slate-200">
            <input 
                type="checkbox" 
                name="is_approved" 
                value="1" 
                id="is_approved" 
                {{ ($testimonial->is_approved ?? $testimonial->approved ?? false) ? 'checked' : '' }}
                class="mt-1 rounded border-slate-300 text-blue-600 focus:ring-blue-500" 
            />
            <label for="is_approved" class="flex-1">
                <span class="block text-sm font-semibold text-slate-700">Approved for Display</span>
                <span class="text-xs text-slate-500">Show this testimonial on the public website</span>
            </label>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
            <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:from-blue-700 hover:to-cyan-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>Update Testimonial</span>
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center gap-2 px-6 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">
                <span>Cancel</span>
            </a>
        </div>
    </div>
</form>
@endsection