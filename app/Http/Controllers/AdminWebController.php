<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\BlogPost;
use App\Models\AboutUs;
use App\Models\Setting;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class AdminWebController extends Controller
{
    public function dashboard(): View
    {
        $metrics = [
            'services' => Service::count(),
            'portfolios' => Portfolio::count(),
            'testimonials' => Testimonial::count(),
            'testimonials_pending' => Testimonial::where('is_approved', false)->count(),
            'contacts_unread' => ContactMessage::where('is_read', false)->count(),
        ];
        return view('admin.dashboard', compact('metrics'));
    }

    public function settingsIndex(): View
    {
        $settingsGrouped = Setting::getAllGrouped();
        return view('admin.settings.index', compact('settingsGrouped'));
    }

    public function aboutEdit(): View
    {
        $about = AboutUs::latest()->first();
        return view('admin.about.edit', compact('about'));
    }

    public function servicesIndex(): View
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function servicesCreate(): View
    {
        return view('admin.services.create');
    }

    public function servicesEdit(int $id): View
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function portfoliosIndex(): View
    {
        $portfolios = Portfolio::latest()->get();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function portfoliosCreate(): View
    {
        return view('admin.portfolios.create');
    }

    public function portfoliosEdit(int $id): View
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function testimonialsIndex(): View
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function testimonialsEdit(int $id): View
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function blogIndex(): View
    {
        if (!Config::get('features.blog')) {
            return view('admin.blog.index');
        }
        $posts = BlogPost::latest('published_at')->get();
        return view('admin.blog.index', compact('posts'));
    }

    public function blogCreate(): View
    {
        return view('admin.blog.create');
    }

    public function blogEdit(int $id): View
    {
        $post = BlogPost::findOrFail($id);
        return view('admin.blog.edit', compact('post'));
    }

    public function contactsIndex(): View
    {
        $messages = ContactMessage::latest()->get();
        return view('admin.contacts.index', compact('messages'));
    }

    public function contactsShow(int $id): View
    {
        $msg = ContactMessage::findOrFail($id);
        if (!$msg->is_read) {
            $msg->is_read = true;
            $msg->read_at = now();
            $msg->save();
        }
        return view('admin.contacts.show', ['message' => $msg]);
    }
}
