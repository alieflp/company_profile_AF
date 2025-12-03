<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAboutUsRequest;
use App\Http\Requests\UpdateAboutUsRequest;

class AboutUsController extends Controller
{
    public function index()
    {
        return cache()->remember('about_us:index', 3600, function () {
            return AboutUs::all();
        });
    }

    public function store(StoreAboutUsRequest $request)
    {
        $data = $request->validated();
        $meta = $data['meta'] ?? [];
        
        // Handle vision
        if (array_key_exists('vision', $data)) {
            $vision = trim((string)($data['vision'] ?? ''));
            $meta['vision'] = $vision !== '' ? $vision : null;
            unset($data['vision']);
        }
        
        // Handle mission
        if (array_key_exists('mission', $data)) {
            $missionRaw = (string)($data['mission'] ?? '');
            $lines = array_filter(array_map(fn($s) => trim($s), preg_split("/(\r\n|\n|,)/", $missionRaw) ?: []), fn($s) => $s !== '');
            $meta['mission'] = array_values($lines);
            unset($data['mission']);
        }
        
        // Handle core values
        if (array_key_exists('core_values', $data) && is_array($data['core_values'])) {
            $coreValues = [];
            foreach ($data['core_values'] as $value) {
                if (!empty($value['title'])) {
                    $coreValues[] = [
                        'title' => $value['title'],
                        'description' => $value['description'] ?? '',
                        'icon' => $value['icon'] ?? 'lightning'
                    ];
                }
            }
            $meta['core_values'] = $coreValues;
            unset($data['core_values']);
        }
        
        $data['meta'] = $meta;
        $created = AboutUs::create($data);
        cache()->forget('about_us:index');
        if ($request->expectsJson()) {
            return $created;
        }
        return redirect()->route('admin.about.edit')->with('success', 'About Us dibuat');
    }

    public function show(AboutUs $aboutUs)
    {
        return $aboutUs;
    }

    public function update(UpdateAboutUsRequest $request, AboutUs $aboutUs)
    {
        $data = $request->validated();
        $meta = $data['meta'] ?? ($aboutUs->meta ?? []);
        
        // Handle vision
        if (array_key_exists('vision', $data)) {
            $vision = trim((string)($data['vision'] ?? ''));
            $meta['vision'] = $vision !== '' ? $vision : null;
            unset($data['vision']);
        }
        
        // Handle mission
        if (array_key_exists('mission', $data)) {
            $missionRaw = (string)($data['mission'] ?? '');
            $lines = array_filter(array_map(fn($s) => trim($s), preg_split("/(\r\n|\n|,)/", $missionRaw) ?: []), fn($s) => $s !== '');
            $meta['mission'] = array_values($lines);
            unset($data['mission']);
        }
        
        // Handle core values
        if (array_key_exists('core_values', $data) && is_array($data['core_values'])) {
            $coreValues = [];
            foreach ($data['core_values'] as $value) {
                if (!empty($value['title'])) {
                    $coreValues[] = [
                        'title' => $value['title'],
                        'description' => $value['description'] ?? '',
                        'icon' => $value['icon'] ?? 'lightning'
                    ];
                }
            }
            $meta['core_values'] = $coreValues;
            unset($data['core_values']);
        }
        
        $data['meta'] = $meta;
        $aboutUs->update($data);
        cache()->forget('about_us:index');
        if ($request->expectsJson()) {
            return $aboutUs->refresh();
        }
        return redirect()->route('admin.about.edit')->with('success', 'About Us diperbarui');
    }

    public function destroy(AboutUs $aboutUs)
    {
        $aboutUs->delete();
        cache()->forget('about_us:index');
        if (request()->expectsJson()) {
            return response()->json(['deleted' => true]);
        }
        return redirect()->route('admin.about.edit')->with('success', 'About Us dihapus');
    }
}
