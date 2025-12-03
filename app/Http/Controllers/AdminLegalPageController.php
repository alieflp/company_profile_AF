<?php

namespace App\Http\Controllers;

use App\Models\LegalPage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminLegalPageController extends Controller
{
    /**
     * Display listing of legal pages
     */
    public function index(): View
    {
        return view('admin.legal.index');
    }

    /**
     * Show edit form
     */
    public function edit(string $type): View
    {
        $page = LegalPage::where('type', $type)->first();
        
        $titles = [
            'privacy-policy' => 'Privacy Policy',
            'terms-of-service' => 'Terms of Service',
        ];
        
        $title = $titles[$type] ?? 'Legal Page';
        
        return view('admin.legal.edit', compact('page', 'type', 'title'));
    }

    /**
     * Update legal page
     */
    public function update(Request $request, string $type): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'update_timestamp' => 'nullable|boolean',
        ]);

        $data = [
            'type' => $type,
            'title' => $validated['title'],
            'content' => $validated['content'],
        ];

        if ($request->input('update_timestamp')) {
            $data['last_updated_at'] = now();
        }

        LegalPage::updateOrCreate(
            ['type' => $type],
            $data
        );

        return redirect()
            ->route('admin.legal.index')
            ->with('success', 'Legal page updated successfully');
    }
}
