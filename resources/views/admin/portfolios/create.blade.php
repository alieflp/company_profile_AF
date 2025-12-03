@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900">Add New Portfolio</h2>
    <p class="text-sm text-slate-600 mt-1">Showcase a new project</p>
</div>

<form method="POST" action="{{ route('admin.portfolios.store') }}" enctype="multipart/form-data" class="max-w-3xl">
    @csrf
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
        {{-- Title Field --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Project Title <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                name="title" 
                value="{{ old('title') }}"
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
                value="{{ old('client') }}"
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
            >{{ old('excerpt') }}</textarea>
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
                value="{{ old('link') }}"
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
                value="{{ old('category') }}"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                placeholder="e.g. Web Development, Mobile App, UI/UX Design"
            />
            @error('category')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Optional: Project type or category</p>
        </div>

        {{-- Main Image Upload --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Portfolio Image <span class="text-red-500">*</span>
            </label>
            <input 
                type="file" 
                name="image" 
                accept="image/*"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                onchange="previewImage(event)"
                required
            />
            @error('image')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Upload main project image (JPG, PNG, WEBP - Max 2MB)</p>
            <div id="image-preview" class="mt-3 hidden">
                <img id="preview-img" class="w-full max-w-md rounded-lg border border-slate-200" alt="Preview">
            </div>
        </div>

        {{-- Gallery Upload --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Gallery Images
            </label>
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
                    <p class="text-xs text-slate-500 mt-1">JPG, PNG, WEBP - Max 2MB each - Max 20 images</p>
                </label>
            </div>
            <div id="gallery-preview" class="mt-3 grid grid-cols-3 gap-3 hidden"></div>
            @error('gallery')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            @error('gallery.*')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-500 mt-1">Optional: Upload multiple images for gallery</p>
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
            >{{ old('description') }}</textarea>
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
                value="{{ old('completed_at') }}"
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
                value="{{ old('tech_stack') }}"
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
                    {{ old('is_published', true) ? 'checked' : '' }}
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
                <span>Create Portfolio</span>
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