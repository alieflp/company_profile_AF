<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $q = Service::query();
        if ($search = request('search')) {
            $q->where(function ($w) use ($search) {
                $w->where('title', 'like', "%$search%")
                  ->orWhere('excerpt', 'like', "%$search%");
            });
        }
        if (!is_null(request('active'))) {
            $q->where('is_active', filter_var(request('active'), FILTER_VALIDATE_BOOL));
        }
        if ($sort = request('sort')) {
            [$col, $dir] = array_pad(explode(':', $sort, 2), 2, 'asc');
            $q->orderBy($col, $dir === 'desc' ? 'desc' : 'asc');
        } else {
            $q->orderByDesc('id');
        }
        return $q->paginate(20)->withQueryString();
    }

    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated();
        
        // Handle checkbox 'active' field
        $data['is_active'] = $request->has('active');
        
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title'].'-'.Str::uuid());
        }
        $service = Service::create($data);
        if ($request->expectsJson()) {
            return $service;
        }
        return redirect()->route('admin.services.index')->with('success', 'Service berhasil ditambahkan');
    }

    public function show(Service $service)
    {
        return $service;
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = $request->validated();
        
        // Handle checkbox 'active' field
        $data['is_active'] = $request->has('active');
        
        $service->update($data);
        if ($request->expectsJson()) {
            return $service->refresh();
        }
        return redirect()->route('admin.services.index')->with('success', 'Service berhasil diperbarui');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        if (request()->expectsJson()) {
            return response()->json(['deleted' => true]);
        }
        return redirect()->route('admin.services.index')->with('success', 'Service dihapus');
    }
}
