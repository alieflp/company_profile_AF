@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900">Edit {{ $title }}</h2>
    <p class="text-sm text-slate-600 mt-1">Update legal page content</p>
</div>

<form method="POST" action="{{ route('admin.legal.update', $type) }}" class="max-w-5xl">
    @csrf
    @method('PUT')
    
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
        {{-- Title --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Page Title <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                name="title" 
                value="{{ old('title', $page->title ?? $title) }}"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                required
            />
            @error('title')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Content --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Content <span class="text-red-500">*</span>
            </label>
            <textarea 
                name="content" 
                rows="20" 
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 font-mono text-sm"
                required
            >{{ old('content', $page->content ?? '') }}</textarea>
            @error('content')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">
                You can use **bold** and basic markdown formatting. Line breaks will be preserved.
            </p>
        </div>

        {{-- Last Updated --}}
        <div class="pt-4 border-t border-slate-200">
            <label class="flex items-center gap-2">
                <input 
                    type="checkbox" 
                    name="update_timestamp" 
                    value="1"
                    checked
                    class="rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                />
                <span class="text-sm font-medium text-slate-700">Update "Last Updated" timestamp</span>
            </label>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
            <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:from-blue-700 hover:to-cyan-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>Save Changes</span>
            </button>
            <a href="{{ route('admin.legal.index') }}" class="inline-flex items-center gap-2 px-6 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">
                <span>Cancel</span>
            </a>
            <a href="{{ route('legal.show', $type) }}" target="_blank" class="ml-auto inline-flex items-center gap-2 px-6 py-3 text-sm font-medium text-blue-600 hover:bg-blue-50 rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span>Preview</span>
            </a>
        </div>
    </div>
</form>
@endsection
