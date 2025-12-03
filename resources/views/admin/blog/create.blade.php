@extends('layouts.admin')
@section('content')
@if(!config('features.blog'))
    <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">
        <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        <p class="text-lg font-semibold text-slate-700 mb-1">Blog Feature Disabled</p>
        <p class="text-sm text-slate-500">Enable the blog feature in your configuration</p>
    </div>
@else
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Create New Blog Post</h2>
        <p class="text-sm text-slate-600 mt-1">Write and publish a new article</p>
    </div>

    <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data" class="max-w-4xl">
        @csrf
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
            {{-- Title Field --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Post Title <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="title" 
                    value="{{ old('title') }}"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                    placeholder="e.g. 10 Best Practices for Modern Web Development"
                    required
                />
                @error('title')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                <p class="text-xs text-slate-500 mt-1">Compelling headline for your blog post</p>
            </div>

            {{-- Excerpt Field --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Excerpt / Summary
                </label>
                <textarea 
                    name="excerpt" 
                    rows="3" 
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Brief summary of the article that appears in previews and search results..."
                >{{ old('excerpt') }}</textarea>
                @error('excerpt')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                <p class="text-xs text-slate-500 mt-1">Optional: Short preview text (recommended 150-160 characters)</p>
            </div>

            {{-- Cover Image Upload --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Cover Image
                </label>
                <div class="space-y-3">
                    <input 
                        type="file" 
                        name="cover_image" 
                        id="blog-cover-input"
                        accept="image/jpeg,image/jpg,image/png,image/webp"
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                    />
                    @error('cover_image')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                    <div id="blog-cover-preview" class="hidden">
                        <div class="relative inline-block">
                            <img id="blog-cover-preview-img" class="h-48 rounded-lg border-2 border-slate-200 object-cover" alt="Cover preview">
                            <button type="button" id="blog-cover-remove" class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-500 text-white flex items-center justify-center hover:bg-red-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
                <p class="text-xs text-slate-500 mt-1">Main image for the blog post (JPG, PNG, WebP - max 2MB)</p>
            </div>

            {{-- Content Field --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Article Content <span class="text-red-500">*</span>
                </label>
                <textarea 
                    name="content" 
                    rows="12" 
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Write your blog post content here. You can use Markdown formatting..."
                    required
                >{{ old('content') }}</textarea>
                @error('content')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                <p class="text-xs text-slate-500 mt-1">Full article content (supports Markdown)</p>
            </div>

            {{-- Gallery Upload --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Gallery Images
                </label>
                <div class="space-y-3">
                    {{-- Drag & Drop Zone --}}
                    <label for="blog-gallery-input" class="block cursor-pointer">
                        <div class="border-2 border-dashed border-slate-300 rounded-lg p-8 text-center hover:border-blue-400 hover:bg-blue-50/30 transition">
                            <svg class="w-12 h-12 mx-auto mb-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm font-medium text-slate-700 mb-1">Click to browse or drag & drop</p>
                            <p class="text-xs text-slate-500">Support multiple image files (max 20 files)</p>
                        </div>
                    </label>
                    <input 
                        type="file" 
                        name="gallery[]" 
                        id="blog-gallery-input"
                        accept="image/jpeg,image/jpg,image/png,image/webp"
                        multiple
                        class="hidden"
                    />
                    @error('gallery')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                    @error('gallery.*')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                    
                    {{-- Gallery Preview Grid --}}
                    <div id="blog-gallery-preview" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 hidden"></div>
                </div>
                <p class="text-xs text-slate-500 mt-1">Additional images for the article (JPG, PNG, WebP - max 2MB each)</p>
            </div>

            {{-- Tags Field --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Tags
                </label>
                <input 
                    type="text" 
                    name="tags" 
                    value="{{ old('tags') }}"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                    placeholder="e.g. Laravel, PHP, Tailwind CSS (comma-separated)"
                />
                @error('tags')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                <p class="text-xs text-slate-500 mt-1">Optional: Comma-separated tags for better discoverability</p>
            </div>

            {{-- Publish Checkbox --}}
            <div class="flex items-start gap-3 p-4 rounded-lg bg-slate-50 border border-slate-200">
                <input 
                    type="checkbox" 
                    name="is_published" 
                    value="1" 
                    id="is_published" 
                    class="mt-1 rounded border-slate-300 text-blue-600 focus:ring-blue-500" 
                />
                <label for="is_published" class="flex-1">
                    <span class="block text-sm font-semibold text-slate-700">Publish Immediately</span>
                    <span class="text-xs text-slate-500">Make this post visible to the public right away</span>
                </label>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:from-blue-700 hover:to-cyan-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Publish Post</span>
                </button>
                <a href="{{ route('admin.blog.index') }}" class="inline-flex items-center gap-2 px-6 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">
                    <span>Cancel</span>
                </a>
            </div>
        </div>
    </form>

    {{-- Cover Image Preview Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const coverInput = document.getElementById('blog-cover-input');
            const coverPreview = document.getElementById('blog-cover-preview');
            const coverPreviewImg = document.getElementById('blog-cover-preview-img');
            const coverRemoveBtn = document.getElementById('blog-cover-remove');

            coverInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        coverPreviewImg.src = e.target.result;
                        coverPreview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });

            coverRemoveBtn.addEventListener('click', function() {
                coverInput.value = '';
                coverPreview.classList.add('hidden');
                coverPreviewImg.src = '';
            });
        });
    </script>

    {{-- Gallery Upload Script --}}
    <script src="{{ asset('js/advanced-image-upload.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.blogGalleryUploader = new AdvancedImageUpload({
                inputId: 'blog-gallery-input',
                previewContainerId: 'blog-gallery-preview',
                maxFiles: 20,
                maxSizeMB: 2
            });
        });
    </script>
@endif
@endsection