@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900">Edit About Us</h2>
    <p class="text-sm text-slate-600 mt-1">Update your company information</p>
</div>

<form method="POST" action="{{ isset($about) ? route('admin.about.update', $about->id) : route('admin.about.store') }}" class="max-w-4xl">
    @csrf
    @if(isset($about))
        @method('PUT')
    @endif
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
        {{-- Title Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                About Page Title <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                name="title" 
                value="{{ old('title', $about->title ?? $about->headline ?? '') }}"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                placeholder="e.g. About AF Web Design & Technology Needs"
                required
            />
            @error('title')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Main headline for the About Us page</p>
        </div>

        {{-- Content Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Company Overview <span class="text-red-500">*</span>
            </label>
            <textarea 
                name="content" 
                rows="6" 
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Write about your company, history, values, and what makes you unique..."
                required
            >{{ old('content', $about->content ?? $about->description ?? '') }}</textarea>
            @error('content')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Detailed description of your company</p>
        </div>

        @php
            $meta = $about->meta ?? [];
            $vision = old('vision', $meta['vision'] ?? '');
            $missionLines = old('mission', isset($meta['mission']) && is_array($meta['mission']) ? implode("\n", $meta['mission']) : '');
            
            $coreValues = old('core_values', $meta['core_values'] ?? [
                ['title' => 'Innovation', 'description' => 'Constantly exploring new technologies and methodologies', 'icon' => 'lightning'],
                ['title' => 'Quality', 'description' => 'Delivering excellence in every line of code', 'icon' => 'shield'],
                ['title' => 'Collaboration', 'description' => 'Working together to achieve remarkable results', 'icon' => 'users'],
                ['title' => 'Growth', 'description' => 'Continuous improvement and learning mindset', 'icon' => 'chart']
            ]);
        @endphp

        {{-- Vision & Mission --}}
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Our Vision
                </label>
                <textarea 
                    name="vision" 
                    rows="4" 
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Your company's vision for the future..."
                >{{ $vision }}</textarea>
                @error('vision')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                <p class="text-xs text-slate-500 mt-1">Optional: Brief vision statement (1-3 sentences)</p>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Our Mission
                </label>
                <textarea 
                    name="mission" 
                    rows="4" 
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="One mission point per line, e.g.:
Deliver quality solutions
Provide excellent service
Continuous innovation"
                >{{ $missionLines }}</textarea>
                @error('mission')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                <p class="text-xs text-slate-500 mt-1">Optional: One mission point per line</p>
            </div>
        </div>

        {{-- Core Values Section --}}
        <div class="border-t border-slate-200 pt-6">
            <div class="mb-4">
                <h3 class="text-lg font-bold text-slate-900 mb-1">Core Values</h3>
                <p class="text-sm text-slate-600">Define up to 4 core values that represent your company</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6">
                @for($i = 0; $i < 4; $i++)
                    @php $value = $coreValues[$i] ?? ['title' => '', 'description' => '', 'icon' => 'lightning']; @endphp
                    <div class="p-4 border-2 border-dashed border-slate-200 rounded-lg hover:border-blue-300 transition">
                        <div class="mb-3">
                            <label class="block text-xs font-semibold text-slate-600 mb-2">Value #{{ $i + 1 }} - Icon</label>
                            <select name="core_values[{{ $i }}][icon]" class="w-full px-3 py-2 text-sm rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                                <option value="lightning" @selected(($value['icon'] ?? '') === 'lightning')>⚡ Lightning (Innovation)</option>
                                <option value="shield" @selected(($value['icon'] ?? '') === 'shield')>🛡️ Shield (Quality/Security)</option>
                                <option value="users" @selected(($value['icon'] ?? '') === 'users')>👥 Users (Collaboration)</option>
                                <option value="chart" @selected(($value['icon'] ?? '') === 'chart')>📈 Chart (Growth)</option>
                                <option value="star" @selected(($value['icon'] ?? '') === 'star')>⭐ Star (Excellence)</option>
                                <option value="heart" @selected(($value['icon'] ?? '') === 'heart')>❤️ Heart (Passion)</option>
                                <option value="rocket" @selected(($value['icon'] ?? '') === 'rocket')>🚀 Rocket (Speed)</option>
                                <option value="target" @selected(($value['icon'] ?? '') === 'target')>🎯 Target (Focus)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="block text-xs font-semibold text-slate-600 mb-2">Title</label>
                            <input type="text" name="core_values[{{ $i }}][title]" value="{{ $value['title'] ?? '' }}" class="w-full px-3 py-2 text-sm rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500" placeholder="e.g., Innovation" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-2">Description</label>
                            <textarea name="core_values[{{ $i }}][description]" rows="2" class="w-full px-3 py-2 text-sm rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 resize-none" placeholder="Brief description...">{{ $value['description'] ?? '' }}</textarea>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
            <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:from-blue-700 hover:to-cyan-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>Save Changes</span>
            </button>
        </div>
    </div>
</form>
@endsection