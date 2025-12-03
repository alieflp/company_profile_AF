<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $q = Portfolio::query();
        if ($search = request('search')) {
            $q->where(function ($w) use ($search) {
                $w->where('title', 'like', "%$search%")
                  ->orWhere('excerpt', 'like', "%$search%")
                  ->orWhere('category', 'like', "%$search%");
            });
        }
        if (!is_null(request('published'))) {
            $q->where('is_published', filter_var(request('published'), FILTER_VALIDATE_BOOL));
        }
        if ($sort = request('sort')) {
            [$col, $dir] = array_pad(explode(':', $sort, 2), 2, 'asc');
            $q->orderBy($col, $dir === 'desc' ? 'desc' : 'asc');
        } else {
            $q->orderByDesc('id');
        }
        return $q->paginate(20)->withQueryString();
    }

    public function store(StorePortfolioRequest $request)
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title'].'-'.Str::uuid());
        }
        
        // Handle main image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'portfolio-' . time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('portfolios', $imageName, 'public');
            $data['image'] = 'storage/' . $imagePath;
        }
        
        // Handle gallery uploads
        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $galleryImage) {
                $galleryName = 'gallery-' . time() . '-' . Str::random(10) . '.' . $galleryImage->getClientOriginalExtension();
                $galleryPath = $galleryImage->storeAs('portfolios/gallery', $galleryName, 'public');
                $galleryPaths[] = 'storage/' . $galleryPath;
            }
            $data['gallery'] = $galleryPaths;
        }
        
        $portfolio = Portfolio::create($data);
        if ($request->expectsJson()) {
            return $portfolio;
        }
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio berhasil ditambahkan');
    }

    public function show(Portfolio $portfolio)
    {
        return $portfolio;
    }

    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio)
    {
        $data = $request->validated();
        
        // Handle main image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($portfolio->image && file_exists(public_path($portfolio->image))) {
                unlink(public_path($portfolio->image));
            }
            
            $image = $request->file('image');
            $imageName = 'portfolio-' . time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('portfolios', $imageName, 'public');
            $data['image'] = 'storage/' . $imagePath;
        }
        
        // Handle gallery images
        $existingGallery = $portfolio->gallery ?? [];
        $galleryChanged = false;
        
        // Remove images marked for deletion
        if (!empty($data['removed_images'])) {
            foreach ($data['removed_images'] as $removedPath) {
                // Remove from array
                $existingGallery = array_filter($existingGallery, fn($path) => $path !== $removedPath);
                // Delete file
                if (file_exists(public_path($removedPath))) {
                    unlink(public_path($removedPath));
                }
            }
            $galleryChanged = true;
        }
        
        // Add new gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $galleryImage) {
                $galleryName = 'gallery-' . time() . '-' . Str::random(10) . '.' . $galleryImage->getClientOriginalExtension();
                $galleryPath = $galleryImage->storeAs('portfolios/gallery', $galleryName, 'public');
                $existingGallery[] = 'storage/' . $galleryPath;
            }
            $galleryChanged = true;
        }
        
        // Update gallery in data if changed
        if ($galleryChanged) {
            $data['gallery'] = array_values($existingGallery); // Re-index array
        }
        
        // Remove removed_images from data before update
        unset($data['removed_images']);
        
        $portfolio->update($data);
        if ($request->expectsJson()) {
            return $portfolio->refresh();
        }
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio berhasil diperbarui');
    }

    public function destroy(Portfolio $portfolio)
    {
        // Delete main image if exists
        if ($portfolio->image && file_exists(public_path($portfolio->image))) {
            unlink(public_path($portfolio->image));
        }
        
        // Delete gallery images if exist
        if (!empty($portfolio->gallery) && is_array($portfolio->gallery)) {
            foreach ($portfolio->gallery as $imagePath) {
                if (file_exists(public_path($imagePath))) {
                    unlink(public_path($imagePath));
                }
            }
        }
        
        $portfolio->delete();
        if (request()->expectsJson()) {
            return response()->json(['deleted' => true]);
        }
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio dihapus');
    }
}
