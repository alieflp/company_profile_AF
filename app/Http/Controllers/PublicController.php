<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\AboutUs;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;

class PublicController extends Controller
{
    public function settings()
    {
        return Cache::remember('public:settings', 1800, fn () => Setting::orderBy('key')->get());
    }

    public function aboutUs()
    {
        return Cache::remember('public:about_us', 1800, fn () => AboutUs::first());
    }

    public function services()
    {
        return Service::query()->where('is_active', true)->orderBy('sort_order')->orderBy('id')->get();
    }

    public function portfolios()
    {
        $q = Portfolio::query()->where('is_published', true)->orderByDesc('completed_at')->orderByDesc('id');
        if ($category = request('category')) {
            $q->where('category', $category);
        }
        return $q->paginate(12)->withQueryString();
    }

    public function testimonials()
    {
        return Testimonial::query()->where('is_approved', true)->orderByDesc('id')->get();
    }

    public function blogPosts()
    {
        if (!config('features.blog')) {
            return response()->json([], 200);
        }
        $q = BlogPost::query()->where('is_published', true)->orderByDesc('published_at');
        if ($tag = request('tag')) {
            $q->whereJsonContains('tags', $tag);
        }
        return $q->paginate(10)->withQueryString();
    }

    public function submitContact(Request $request)
    {
        // Check rate limit PERTAMA sebelum proses apapun
        $key = 'contact:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 3)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Too many submissions'], 429);
            }
            return redirect()->route('contact')->with('too_many_requests', 'Terlalu banyak kiriman, coba lagi nanti.');
        }
        
        // Hit rate limiter SEBELUM simpan data (increment counter)
        RateLimiter::hit($key, 60); // 60 detik decay time
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);
        
        $data['status'] = 'new';
        $data['ip_address'] = $request->ip();
        $data['user_agent'] = $request->userAgent();
        
        $created = ContactMessage::create($data);
        
        if ($request->expectsJson()) {
            return $created;
        }
        
        return redirect()->route('contact')->with('success', 'Pesan berhasil dikirim. Kami akan menghubungi Anda segera!');
    }
}
