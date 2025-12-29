<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class TestimonialPublicController extends Controller
{
    public function create()
    {
        return view('pages.testimonials.submit');
    }

    public function store(Request $request)
    {
        // Check rate limit PERTAMA sebelum proses apapun
        $key = 'testimonial:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 3)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Too many submissions'], 429);
            }
            return redirect()->route('testimonials.submit.form')->with('too_many_requests', 'Terlalu banyak kiriman, coba lagi nanti.');
        }
        
        // Hit rate limiter SEBELUM simpan data (increment counter)
        RateLimiter::hit($key, 60); // 60 detik decay time
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);
        
        $data['is_approved'] = false; // pending moderation
        
        $testimonial = Testimonial::create($data);
        
        if ($request->expectsJson()) {
            return $testimonial;
        }
        
        return redirect()->route('testimonials.submit.form')->with('success', 'Terima kasih! Testimoni Anda akan ditinjau admin.');
    }
}
