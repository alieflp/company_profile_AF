<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        return cache()->remember('settings:index', 3600, function () {
            return Setting::orderBy('key')->get();
        });
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string|max:255|unique:settings,key',
            'value' => 'nullable',
            'type' => 'nullable|string|max:50',
        ]);
        $created = Setting::create($data);
        cache()->forget('settings:index');
        return $created;
    }

    public function show(Setting $setting)
    {
        return $setting;
    }

    public function update(Request $request, Setting $setting)
    {
        $data = $request->validate([
            'value' => 'nullable',
            'type' => 'nullable|string|max:50',
        ]);
        $setting->update($data);
        cache()->forget('settings:index');
        return $setting->refresh();
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        cache()->forget('settings:index');
        return response()->json(['deleted' => true]);
    }
}
