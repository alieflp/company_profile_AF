@extends('layouts.app')
@section('content')
{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-slate-900 to-blue-900 text-white overflow-hidden py-16">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMyMTk2RjMiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE2YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0em0wIDI0YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0ek0xMiAxNmMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHptMCAyNGMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-20"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto">
            <p class="text-sm font-semibold text-blue-400 uppercase tracking-wide mb-3">Client Testimonials</p>
            <h1 class="text-4xl sm:text-5xl font-bold mb-4">What Our Clients Say</h1>
            <p class="text-lg text-slate-300 mb-8">Kepercayaan dan kepuasan klien adalah prioritas utama kami. Dengar langsung dari mereka yang telah bekerja sama dengan kami.</p>
            <a href="{{ route('testimonials.submit.form') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-8 py-4 text-base font-semibold text-blue-700 shadow-xl hover:bg-slate-50 transition">
                <span>Share Your Experience</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- Testimonials Grid --}}
<section class="py-16 bg-gradient-to-b from-slate-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($testimonials ?? [] as $testimonial)
                <figure class="scroll-animate relative rounded-2xl border border-slate-200 bg-white p-8 shadow-sm hover:shadow-xl transition-all duration-300">
                    <svg class="absolute top-6 right-6 w-12 h-12 text-blue-100" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    @if(!empty($testimonial->rating))
                        <div class="mb-4 flex items-center">
                            @for($i=1; $i<=5; $i++)
                                @php $filled = $i <= (int) $testimonial->rating; @endphp
                                <svg class="h-5 w-5 mr-1 {{ $filled ? 'text-amber-400' : 'text-slate-300' }}" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.802 2.035a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.802-2.035a1 1 0 00-1.176 0l-2.802 2.035c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                    @endif
                    <blockquote class="text-slate-700 mb-6 line-clamp-6 relative z-10 leading-relaxed">"{{ $testimonial->content ?? 'Testimoni klien.' }}"</blockquote>
                    <figcaption class="flex items-center gap-3">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-600 to-cyan-600 flex items-center justify-center text-white font-bold text-lg shrink-0">
                            {{ strtoupper(substr($testimonial->name ?? 'A', 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">{{ $testimonial->name ?? 'Client Name' }}</p>
                            <p class="text-sm text-slate-500">
                                {{ $testimonial->position ?? 'Position' }}
                                @if($testimonial->company) · {{ $testimonial->company }} @endif
                            </p>
                        </div>
                    </figcaption>
                </figure>
            @endforeach
            @if(empty($testimonials) || count($testimonials) === 0)
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center text-slate-500 md:col-span-3">
                    <svg class="w-20 h-20 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                    <p class="text-lg font-semibold text-slate-700 mb-1">No Testimonials Yet</p>
                    <p>Be the first to share your experience!</p>
                </div>
            @endif
        </div>
        
        @if(isset($testimonials) && method_exists($testimonials, 'links'))
            <div class="mt-12">
                {{ $testimonials->links() }}
            </div>
        @endif
    </div>
</section>

{{-- Trust Badges Section --}}
<section class="py-16 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold text-slate-900 mb-2">Trusted By Leading Organizations</h2>
            <p class="text-slate-600">Join hundreds of satisfied clients who chose us</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="flex items-center justify-center p-6 rounded-xl bg-slate-50 border border-slate-200">
                <div class="text-center">
                    <p class="text-3xl font-bold text-blue-600">98%</p>
                    <p class="text-xs text-slate-600 mt-1">Satisfaction Rate</p>
                </div>
            </div>
            <div class="flex items-center justify-center p-6 rounded-xl bg-slate-50 border border-slate-200">
                <div class="text-center">
                    <p class="text-3xl font-bold text-cyan-600">200+</p>
                    <p class="text-xs text-slate-600 mt-1">Happy Clients</p>
                </div>
            </div>
            <div class="flex items-center justify-center p-6 rounded-xl bg-slate-50 border border-slate-200">
                <div class="text-center">
                    <p class="text-3xl font-bold text-blue-600">500+</p>
                    <p class="text-xs text-slate-600 mt-1">Projects Done</p>
                </div>
            </div>
            <div class="flex items-center justify-center p-6 rounded-xl bg-slate-50 border border-slate-200">
                <div class="text-center">
                    <p class="text-3xl font-bold text-cyan-600">15+</p>
                    <p class="text-xs text-slate-600 mt-1">Years Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
