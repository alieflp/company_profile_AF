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
        if (RateLimiter::tooManyAttempts('testimonial:'.$request->ip(), 10)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Too many submissions'], 429);
            }
            return redirect()->route('testimonials.submit.form')->with('too_many_requests', 'Terlalu banyak kiriman, coba lagi nanti.');
        }
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);
        $data['is_approved'] = false; // pending moderation
        $testimonial = Testimonial::create($data);
        RateLimiter::hit('testimonial:'.$request->ip());
        if ($request->expectsJson()) {
            return $testimonial;
        }
        return redirect()->route('testimonials.submit.form')->with('success', 'Terima kasih! Testimoni Anda akan ditinjau admin.');
    }
}
