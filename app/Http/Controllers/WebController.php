<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\BlogPost;
use App\Models\AboutUs;
use Illuminate\View\View;

class WebController extends Controller
{
    public function home(): View
    {
        $services = Service::query()->where('is_active', true)->orderBy('sort_order')->take(6)->get();
        $portfolios = Portfolio::query()->where('is_published', true)->latest('completed_at')->take(6)->get();
        $testimonials = Testimonial::query()->where('is_approved', true)->latest()->take(6)->get();
        $posts = [];
        if (Config::get('features.blog')) {
            $posts = BlogPost::query()->where('is_published', true)->latest('published_at')->take(6)->get();
        }
        return view('pages.home', compact('services','portfolios','testimonials','posts'));
    }

    public function about(): View
    {
        $about = AboutUs::query()->latest()->first();
        if ($about) {
            $about->headline = $about->title;
            $about->description = $about->content;
            $meta = $about->meta ?? [];
            $about->vision = $meta['vision'] ?? null;
            $about->mission = (array)($meta['mission'] ?? []);
        }
        return view('pages.about', compact('about'));
    }

    public function servicesIndex(): View
    {
        $services = Service::query()->where('is_active', true)->orderBy('sort_order')->get();
        return view('pages.services.index', compact('services'));
    }

    public function portfoliosIndex(): View
    {
        $portfolios = Portfolio::query()->where('is_published', true)->latest('completed_at')->paginate(12);
        return view('pages.portfolios.index', compact('portfolios'));
    }

    public function portfoliosShow(Portfolio $portfolio): View
    {
        // Only show published portfolios
        if (!$portfolio->is_published) {
            abort(404);
        }
        return view('pages.portfolios.show', compact('portfolio'));
    }

    public function testimonialsIndex(): View
    {
        $testimonials = Testimonial::query()->where('is_approved', true)->latest()->paginate(12);
        return view('pages.testimonials.index', compact('testimonials'));
    }

    public function blogIndex(): View
    {
        if (!Config::get('features.blog')) {
            return view('pages.blog.index');
        }
        $posts = BlogPost::query()->where('is_published', true)->latest('published_at')->paginate(12);
        return view('pages.blog.index', compact('posts'));
    }

    public function blogShow(BlogPost $blogPost): View
    {
        if (!Config::get('features.blog')) {
            return view('pages.blog.show');
        }
        return view('pages.blog.show', ['post' => $blogPost]);
    }

    public function contact(): View
    {
        return view('pages.contact');
    }
}
