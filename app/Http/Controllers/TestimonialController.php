<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;

class TestimonialController extends Controller
{
    public function index()
    {
        return Testimonial::query()->orderByDesc('id')->paginate(20);
    }

    public function store(StoreTestimonialRequest $request)
    {
        $data = $request->validated();
        $testimonial = Testimonial::create($data);
        if ($request->expectsJson()) {
            return $testimonial;
        }
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni ditambahkan');
    }

    public function show(Testimonial $testimonial)
    {
        return $testimonial;
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $data = $request->validated();
        $testimonial->update($data);
        if ($request->expectsJson()) {
            return $testimonial->refresh();
        }
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni diperbarui');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        if (request()->expectsJson()) {
            return response()->json(['deleted' => true]);
        }
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni dihapus');
    }
}
