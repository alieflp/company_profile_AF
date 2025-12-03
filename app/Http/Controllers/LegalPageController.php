<?php

namespace App\Http\Controllers;

use App\Models\LegalPage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LegalPageController extends Controller
{
    /**
     * Show legal page to public
     */
    public function show(string $type): View
    {
        $page = LegalPage::where('type', $type)->firstOrFail();
        
        return view('pages.legal.show', compact('page'));
    }
}
