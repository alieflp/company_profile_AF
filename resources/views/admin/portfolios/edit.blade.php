@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900">Edit Portfolio</h2>
    <p class="text-sm text-slate-600 mt-1">Update project information</p>
</div>

<form method="POST" action="{{ route('admin.portfolios.update', $portfolio->id ?? 0) }}" enctype="multipart/form-data" class="max-w-3xl">
    @csrf
    @method('PUT')
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
        {{-- Title Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Project Title <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                name="title" 
                value="{{ old('title', $portfolio->title ?? '') }}"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                placeholder="e.g. E-Commerce Platform for Retail Company"
                required
            />
            @error('title')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">The name of the project</p>
        </div>

        {{-- Client Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Client Name
            </label>
            <input 
                type="text" 
                name="client" 
                value="{{ old('client', $portfolio->client ?? '') }}"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                placeholder="e.g. ABC Company, XYZ Corporation"
            />
            @error('client')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Optional: Who this project was created for</p>
        </div>

        {{-- Excerpt Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Excerpt / Short Description
            </label>
            <textarea 
                name="excerpt" 
                rows="2" 
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Brief summary of the project (shown on cards)..."
            >{{ old('excerpt', $portfolio->excerpt ?? '') }}</textarea>
            @error('excerpt')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Optional: Short description for portfolio cards (max 500 chars)</p>
        </div>

        {{-- Project Link Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Project URL / Live Link
            </label>
            <input 
                type="url" 
                name="link" 
                value="{{ old('link', $portfolio->link ?? '') }}"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                placeholder="https://example.com"
            />
            @error('link')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Optional: Link to live project or demo</p>
        </div>

        {{-- Category Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Category
            </label>
            <input 
                type="text" 
                name="category" 
                value="{{ old('category', $portfolio->category ?? '') }}"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                placeholder="e.g. Web Development, Mobile App, UI/UX Design"
            />
            @error('category')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Optional: Project type or category</p>
        </div>

        {{-- Main Image Upload --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Portfolio Image
            </label>
            @if(isset($portfolio->image) && $portfolio->image)
            <div class="mb-3">
                <p class="text-xs text-slate-500 mb-2">Current Image:</p>
                <img src="{{ asset($portfolio->image) }}" alt="Current" class="w-full max-w-md rounded-lg border border-slate-200">
            </div>
            @endif
            <input 
                type="file" 
                name="image" 
                accept="image/*"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                onchange="previewImage(event)"
            />
            @error('image')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Upload new image to replace current (JPG, PNG, WEBP - Max 2MB)</p>
            <div id="image-preview" class="mt-3 hidden">
                <p class="text-xs text-slate-500 mb-2">New Preview:</p>
                <img id="preview-img" class="w-full max-w-md rounded-lg border border-slate-200" alt="Preview">
            </div>
        </div>

        {{-- Gallery Upload --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Gallery Images
            </label>
            
            {{-- Existing Gallery --}}
            @if(isset($portfolio->gallery) && is_array($portfolio->gallery) && count($portfolio->gallery) > 0)
            <div class="mb-4">
                <p class="text-xs text-slate-500 mb-2">Current Gallery ({{ count($portfolio->gallery) }} images):</p>
                <div id="existing-gallery-container" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($portfolio->gallery as $index => $galleryImage)
                    <div class="existing-image-item relative group" data-image-path="{{ $galleryImage }}">
                        <img src="{{ asset($galleryImage) }}" alt="Gallery {{ $index + 1 }}" class="w-full h-auto rounded-lg border-2 border-slate-200">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                            <button type="button" onclick="removeExistingImage('{{ $galleryImage }}', this, 'galleryUploader')" 
                                    class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            
            {{-- New Gallery Upload --}}
            <div class="border-2 border-dashed border-slate-300 rounded-lg p-4 text-center hover:border-blue-400 transition">
                <input 
                    type="file" 
                    id="gallery-input"
                    name="gallery[]" 
                    accept="image/*"
                    multiple
                    class="hidden"
                />
                <label for="gallery-input" class="cursor-pointer">
                    <svg class="w-12 h-12 mx-auto text-slate-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <p class="text-sm font-semibold text-slate-700">Click to browse or drag & drop images</p>
                    <p class="text-xs text-slate-500 mt-1">JPG, PNG, WEBP - Max 2MB each</p>
                </label>
            </div>
            
            {{-- New Images Preview --}}
            <div id="gallery-preview" class="mt-3 grid grid-cols-3 gap-3 hidden"></div>
            
            @error('gallery')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            @error('gallery.*')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">
                <strong>Tip:</strong> Existing images will be kept. New images will be added to gallery.
            </p>
        </div>

        {{-- Description Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Project Description <span class="text-red-500">*</span>
            </label>
            <textarea 
                name="description" 
                rows="6" 
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Describe the project, its goals, challenges solved, technologies used, and outcomes achieved..."
                required
            >{{ old('description', $portfolio->description ?? '') }}</textarea>
            @error('description')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Detailed information about the project</p>
        </div>

        {{-- Completed Date --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Completion Date
            </label>
            <input 
                type="date" 
                name="completed_at" 
                value="{{ old('completed_at', $portfolio->completed_at?->format('Y-m-d') ?? '') }}"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
            />
            @error('completed_at')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Optional: When was this project completed</p>
        </div>

        {{-- Tech Stack --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Technologies Used
            </label>
            <input 
                type="text" 
                name="tech_stack" 
                value="{{ old('tech_stack', $portfolio->tech_stack ?? '') }}"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                placeholder="e.g. Laravel, Vue.js, MySQL, Tailwind CSS"
            />
            @error('tech_stack')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Optional: Comma-separated list of technologies</p>
        </div>

        {{-- Publish Status --}}
        <div>
            <label class="flex items-center gap-3 cursor-pointer group">
                <input 
                    type="checkbox" 
                    name="is_published" 
                    value="1"
                    {{ old('is_published', $portfolio->is_published ?? true) ? 'checked' : '' }}
                    class="w-5 h-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                />
                <div>
                    <span class="text-sm font-semibold text-slate-700 group-hover:text-blue-600 transition">Publish Portfolio</span>
                    <p class="text-xs text-slate-500">Make this portfolio visible on the public website</p>
                </div>
            </label>
            @error('is_published')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
            <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:from-blue-700 hover:to-cyan-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>Update Portfolio</span>
            </button>
            <a href="{{ route('admin.portfolios.index') }}" class="inline-flex items-center gap-2 px-6 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">
                <span>Cancel</span>
            </a>
        </div>
    </div>
</form>

<script src="{{ asset('js/advanced-image-upload.js') }}"></script>
<script>
// Initialize advanced gallery uploader
window.galleryUploader = new AdvancedImageUpload({
    inputId: 'gallery-input',
    previewContainerId: 'gallery-preview',
    existingImagesContainerId: 'existing-gallery-container',
    maxFiles: 20,
    maxSizeMB: 2
});

// Old image preview function (for main image)
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection