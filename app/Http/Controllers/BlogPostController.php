<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogPostRequest;
use App\Http\Requests\UpdateBlogPostRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    public function index()
    {
        $q = BlogPost::query();
        if ($search = request('search')) {
            $q->where(function ($w) use ($search) {
                $w->where('title', 'like', "%$search%")
                  ->orWhere('excerpt', 'like', "%$search%")
                  ->orWhere('content', 'like', "%$search%");
            });
        }
        if (!is_null(request('published'))) {
            $q->where('is_published', filter_var(request('published'), FILTER_VALIDATE_BOOL));
        }
        if ($sort = request('sort')) {
            [$col, $dir] = array_pad(explode(':', $sort, 2), 2, 'desc');
            $q->orderBy($col, $dir === 'asc' ? 'asc' : 'desc');
        } else {
            $q->latest();
        }
        return $q->paginate(20)->withQueryString();
    }

    public function store(StoreBlogPostRequest $request)
    {
        $data = $request->validated();
        
        // Handle tags
        if (isset($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = collect(explode(',', $data['tags']))->map(fn($t) => trim($t))->filter()->values()->all();
        }
        
        // Generate slug
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title'].'-'.Str::uuid());
        }
        
        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
            $coverImageName = time() . '_' . uniqid() . '.' . $coverImage->getClientOriginalExtension();
            $coverPath = $coverImage->storeAs('blog/covers', $coverImageName, 'public');
            $data['cover_image'] = 'storage/' . $coverPath;
        }
        
        // Handle gallery images upload
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $galleryImage) {
                $galleryImageName = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
                $galleryPath = $galleryImage->storeAs('blog/gallery', $galleryImageName, 'public');
                $galleryPaths[] = 'storage/' . $galleryPath;
            }
        }
        if (!empty($galleryPaths)) {
            $data['gallery'] = $galleryPaths;
        }
        
        // Handle publish
        if (!empty($data['is_published'])) {
            $data['published_at'] = now();
        }
        
        $post = BlogPost::create($data);
        
        if ($request->expectsJson()) {
            return $post;
        }
        return redirect()->route('admin.blog.index')->with('success', 'Post berhasil dibuat');
    }

    public function show(BlogPost $blogPost)
    {
        return $blogPost;
    }

    public function update(UpdateBlogPostRequest $request, BlogPost $blogPost)
    {
        $data = $request->validated();
        
        // Handle tags
        if (isset($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = collect(explode(',', $data['tags']))->map(fn($t) => trim($t))->filter()->values()->all();
        }
        
        // Handle cover image removal
        if ($request->input('remove_cover_image') == '1' && !empty($blogPost->cover_image)) {
            if (file_exists(public_path($blogPost->cover_image))) {
                unlink(public_path($blogPost->cover_image));
            }
            $data['cover_image'] = null;
        }
        
        // Handle new cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old cover image
            if (!empty($blogPost->cover_image) && file_exists(public_path($blogPost->cover_image))) {
                unlink(public_path($blogPost->cover_image));
            }
            
            $coverImage = $request->file('cover_image');
            $coverImageName = time() . '_' . uniqid() . '.' . $coverImage->getClientOriginalExtension();
            $coverPath = $coverImage->storeAs('blog/covers', $coverImageName, 'public');
            $data['cover_image'] = 'storage/' . $coverPath;
        }
        
        // Handle gallery management (APPEND mode)
        $existingGallery = $blogPost->gallery ?? [];
        
        // Remove marked images
        if ($request->has('removed_images')) {
            $removedImages = $request->input('removed_images');
            foreach ($removedImages as $removedPath) {
                // Remove from array
                $existingGallery = array_filter($existingGallery, fn($path) => $path !== $removedPath);
                // Delete file
                if (file_exists(public_path($removedPath))) {
                    unlink(public_path($removedPath));
                }
            }
            $existingGallery = array_values($existingGallery); // Re-index
        }
        
        // Upload new gallery images and APPEND to existing
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $galleryImage) {
                $galleryImageName = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
                $galleryPath = $galleryImage->storeAs('blog/gallery', $galleryImageName, 'public');
                $galleryPaths[] = 'storage/' . $galleryPath;
            }
        }
        
        // Merge existing gallery with new uploads
        $data['gallery'] = array_merge($existingGallery, $galleryPaths);
        
        // Handle publish
        if (isset($data['is_published']) && $data['is_published'] && !$blogPost->published_at) {
            $data['published_at'] = now();
        }
        
        $blogPost->update($data);
        
        if ($request->expectsJson()) {
            return $blogPost->refresh();
        }
        return redirect()->route('admin.blog.index')->with('success', 'Post diperbarui');
    }

    public function destroy(BlogPost $blogPost)
    {
        // Delete cover image
        if (!empty($blogPost->cover_image) && file_exists(public_path($blogPost->cover_image))) {
            unlink(public_path($blogPost->cover_image));
        }
        
        // Delete gallery images
        if (!empty($blogPost->gallery) && is_array($blogPost->gallery)) {
            foreach ($blogPost->gallery as $imagePath) {
                if (file_exists(public_path($imagePath))) {
                    unlink(public_path($imagePath));
                }
            }
        }
        
        $blogPost->delete();
        
        if (request()->expectsJson()) {
            return response()->json(['deleted' => true]);
        }
        return redirect()->route('admin.blog.index')->with('success', 'Post dihapus');
    }
}
