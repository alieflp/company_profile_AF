@extends('layouts.app')
@section('content')
    @php
        // Expect: $services, $portfolios, $testimonials, $posts (optional)
    @endphp
    {{-- Hero Section with Gradient --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMyMTk2RjMiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE2YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0em0wIDI0YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0ek0xMiAxNmMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHptMCAyNGMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="text-white">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/20 backdrop-blur-sm border border-blue-400/30 mb-6">
                    <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.802 2.035a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.802-2.035a1 1 0 00-1.176 0l-2.802 2.035c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <span class="text-sm font-medium text-blue-200">Trusted IT Solutions Partner</span>
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    {{ \App\Models\Setting::get('hero_title', 'Transformasi Digital Dimulai dari Sini') }}
                </h1>
                <p class="text-lg text-slate-300 mb-8 max-w-xl">{{ \App\Models\Setting::get('hero_subtitle', 'Solusi IT terintegrasi untuk mengakselerasi bisnis Anda. Dari web development, cloud infrastructure, hingga digital transformation consulting.') }}</p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-8 py-4 text-base font-semibold text-white shadow-lg shadow-blue-500/50 hover:shadow-xl hover:shadow-blue-500/60 transition-all">
                        <span>Mulai Konsultasi</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ route('portfolios.index.public') }}" class="inline-flex items-center gap-2 rounded-xl border-2 border-white/20 bg-white/10 backdrop-blur-sm px-8 py-4 text-base font-semibold text-white hover:bg-white/20 transition">Lihat Portfolio</a>
                </div>
                <div class="mt-10 flex items-center gap-8">
                    <div>
                        <p class="text-3xl font-bold text-white">{{ \App\Models\Setting::get('stat_projects', '50+') }}</p>
                        <p class="text-sm text-slate-400">Projects Delivered</p>
                    </div>
                    <div class="h-12 w-px bg-white/20"></div>
                    <div>
                        <p class="text-3xl font-bold text-white">{{ \App\Models\Setting::get('stat_satisfaction', '98%') }}</p>
                        <p class="text-sm text-slate-400">Client Satisfaction</p>
                    </div>
                    <div class="h-12 w-px bg-white/20"></div>
                    <div>
                        <p class="text-3xl font-bold text-white">{{ \App\Models\Setting::get('stat_support', '24/7') }}</p>
                        <p class="text-sm text-slate-400">Support Available</p>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="relative rounded-2xl bg-gradient-to-br from-blue-500/20 to-cyan-500/20 backdrop-blur-xl border border-white/20 p-8 shadow-2xl">
                    <div class="aspect-square rounded-xl bg-gradient-to-br from-white/10 to-white/5 backdrop-blur flex items-center justify-center">
                        <svg class="w-32 h-32 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="absolute -top-4 -right-4 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-2xl px-5 py-3 shadow-xl">
                        <p class="text-xs font-medium text-white/80">Latest Tech Stack</p>
                        <p class="text-lg font-bold text-white">Laravel • React • AWS</p>
                    </div>
                    <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl px-5 py-3 shadow-xl">
                        <p class="text-xs font-medium text-slate-500">Response Time</p>
                        <p class="text-lg font-bold text-slate-900">&lt; 24 Hours</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Services Section with Icons --}}
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 scroll-animate">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide mb-2">Our Expertise</p>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Solusi IT Komprehensif</h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">Layanan end-to-end yang dirancang untuk mengoptimalkan infrastruktur digital perusahaan Anda</p>
            </div>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @php
                    $colorMap = [
                        'blue' => ['from' => 'from-blue-500', 'to' => 'to-blue-600'],
                        'purple' => ['from' => 'from-purple-500', 'to' => 'to-purple-600'],
                        'green' => ['from' => 'from-green-500', 'to' => 'to-green-600'],
                        'orange' => ['from' => 'from-orange-500', 'to' => 'to-orange-600'],
                        'red' => ['from' => 'from-red-500', 'to' => 'to-red-600'],
                        'cyan' => ['from' => 'from-cyan-500', 'to' => 'to-cyan-600'],
                        'pink' => ['from' => 'from-pink-500', 'to' => 'to-pink-600'],
                        'indigo' => ['from' => 'from-indigo-500', 'to' => 'to-indigo-600'],
                    ];
                @endphp
                @foreach ($services ?? [] as $service)
                    @php
                        $iconColor = $service->icon_color ?? 'blue';
                        $gradientFrom = $colorMap[$iconColor]['from'] ?? 'from-blue-500';
                        $gradientTo = $colorMap[$iconColor]['to'] ?? 'to-blue-600';
                        $iconType = $service->icon_type ?? 'code';
                    @endphp
                    <article class="scroll-animate group relative rounded-2xl bg-white border border-slate-200 p-8 hover:shadow-xl hover:border-blue-300 transition-all duration-300">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/5 to-cyan-500/5 rounded-bl-full -z-10"></div>
                        <div class="mb-6 inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br {{ $gradientFrom }} {{ $gradientTo }} text-white shadow-lg group-hover:scale-110 transition-transform">
                            @include('partials.service-icon', ['type' => $iconType])
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition">{{ $service->name }}</h3>
                        <p class="text-slate-600 mb-4 line-clamp-3">{{ $service->short_description ?? 'Deskripsi singkat layanan.' }}</p>
                        <a href="{{ route('services.index.public') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 group-hover:gap-3 transition-all">
                            <span>Learn More</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </article>
                @endforeach
                @if(empty($services) || count($services) === 0)
                    @for ($i = 0; $i < 3; $i++)
                        <article class="rounded-2xl border border-slate-200 bg-white p-8 animate-pulse">
                            <div class="h-16 w-16 rounded-2xl bg-slate-200 mb-6"></div>
                            <div class="h-6 bg-slate-200 rounded w-2/3 mb-3"></div>
                            <div class="h-4 bg-slate-200 rounded w-full mb-2"></div>
                            <div class="h-4 bg-slate-200 rounded w-5/6"></div>
                        </article>
                    @endfor
                @endif
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('services.index.public') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-8 py-4 text-base font-semibold text-white shadow-lg hover:bg-blue-700 transition">View All Services</a>
            </div>
        </div>
    </section>
    {{-- Portfolio Section with Masonry Style --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12 scroll-animate">
                <div>
                    <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide mb-2">Success Stories</p>
                    <h2 class="text-3xl sm:text-4xl font-bold text-slate-900">Featured Projects</h2>
                </div>
                <a href="{{ route('portfolios.index.public') }}" class="hidden md:inline-flex items-center gap-2 text-blue-600 font-semibold hover:gap-3 transition-all">
                    <span>Explore All Projects</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($portfolios ?? [] as $portfolio)
                    <article class="scroll-animate-scale group relative bg-white rounded-2xl shadow-md border border-slate-200 overflow-hidden hover:shadow-2xl transition-all duration-300">
                        <div class="aspect-video bg-gradient-to-br from-slate-100 to-slate-200 relative overflow-hidden">
                            @if($portfolio->thumbnail_url ?? false)
                                <img src="{{ $portfolio->thumbnail_url }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <div class="absolute top-3 left-3 flex gap-2">
                                <span class="inline-flex items-center rounded-lg bg-white/90 backdrop-blur px-3 py-1 text-xs font-semibold text-slate-900">{{ $portfolio->category ?? 'Web' }}</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-start justify-between gap-3 mb-3">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition line-clamp-2">{{ $portfolio->title }}</h3>
                                @if($portfolio->completed_at)
                                    <span class="text-xs text-slate-500 whitespace-nowrap">{{ $portfolio->completed_at->format('M Y') }}</span>
                                @endif
                            </div>
                            @if($portfolio->excerpt)
                                <p class="text-sm text-slate-600 mb-3 line-clamp-2">{{ $portfolio->excerpt }}</p>
                            @elseif($portfolio->client)
                                <p class="text-sm text-slate-600 mb-3">{{ $portfolio->client }}</p>
                            @endif
                            @if($portfolio->tech_stack)
                                <div class="flex flex-wrap gap-1 mb-4">
                                    @foreach(array_slice(explode(',', $portfolio->tech_stack), 0, 3) as $tech)
                                        <span class="inline-block px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700">{{ trim($tech) }}</span>
                                    @endforeach
                                </div>
                            @endif
                            <div class="flex items-center gap-3">
                                <a href="{{ route('portfolios.show.public', $portfolio->slug) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 group-hover:gap-3 transition-all">
                                    <span>View Case Study</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                                @if($portfolio->link)
                                    <a href="{{ $portfolio->link }}" target="_blank" rel="noopener noreferrer" class="group/live inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-50/50 hover:bg-blue-100/70 border border-blue-200/50 transition-all" title="View Live Project">
                                        <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        <span class="text-xs font-medium text-blue-600">Live</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
                @if(empty($portfolios) || count($portfolios) === 0)
                    <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-6 text-sm text-slate-500 flex items-center justify-center md:col-span-3">Belum ada data portfolio.</div>
                @endif
            </div>
        </div>
    </section>
    {{-- Testimonials Section with Cards --}}
    <section class="py-20 bg-gradient-to-b from-slate-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 scroll-animate">
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide mb-2">Client Testimonials</p>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Apa Kata Klien Kami</h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">Kepercayaan dan kepuasan klien adalah prioritas utama kami</p>
            </div>
            <div class="grid gap-8 md:grid-cols-3">
                @foreach ($testimonials ?? [] as $testimonial)
                    <figure class="scroll-animate rounded-2xl border border-slate-100 bg-slate-50 px-5 py-6">
                        @if(!empty($testimonial->rating))
                            <div class="mb-3 flex items-center" aria-label="Rating {{ $testimonial->rating }} dari 5">
                                @for($i=1; $i<=5; $i++)
                                    @php $filled = $i <= (int) $testimonial->rating; @endphp
                                    <svg class="h-4 w-4 mr-1 {{ $filled ? 'text-amber-400' : 'text-slate-300' }}" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.802 2.035a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.802-2.035a1 1 0 00-1.176 0l-2.802 2.035c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                        @endif
                        <blockquote class="text-sm text-slate-600 mb-4 line-clamp-4">“{{ $testimonial->content ?? 'Isi testimoni.' }}”</blockquote>
                        <figcaption class="text-sm">
                            <p class="font-semibold text-slate-900">{{ $testimonial->name ?? 'Nama Klien' }}</p>
                            <p class="text-xs text-slate-500">{{ $testimonial->position ?? '' }} @if($testimonial->company) · {{ $testimonial->company }} @endif</p>
                        </figcaption>
                    </figure>
                @endforeach
                @if(empty($testimonials) || count($testimonials) === 0)
                    <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-8 text-center text-slate-500 md:col-span-3">
                        <svg class="w-16 h-16 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                        <p>Belum ada testimoni yang disetujui.</p>
                    </div>
                @endif
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('testimonials.index.public') }}" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:gap-3 transition-all">
                    <span>Read All Testimonials</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>
    @if(config('features.blog'))
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide mb-2">Latest Insights</p>
                        <h2 class="text-3xl sm:text-4xl font-bold text-slate-900">From Our Blog</h2>
                    </div>
                    <a href="{{ route('blog.index.public') }}" class="hidden md:inline-flex items-center gap-2 text-blue-600 font-semibold hover:gap-3 transition-all">
                        <span>View All Articles</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div class="grid gap-8 md:grid-cols-3">
                    @foreach ($posts ?? [] as $post)
                        <article class="group rounded-2xl border border-slate-200 bg-white overflow-hidden hover:shadow-xl transition-all duration-300">
                            {{-- Cover Image --}}
                            <div class="aspect-video bg-gradient-to-br from-blue-50 to-cyan-50 overflow-hidden">
                                @if(!empty($post->cover_image))
                                    <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-16 h-16 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="text-xs text-slate-500">{{ $post->published_at?->format('d M Y') ?? 'Coming Soon' }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition">{{ $post->title }}</h3>
                                <p class="text-sm text-slate-600 mb-4 line-clamp-3">{{ $post->excerpt ?? 'Ringkasan artikel akan tampil di sini.' }}</p>
                                <a href="{{ route('blog.show.public', $post->slug) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 group-hover:gap-3 transition-all">
                                    <span>Read Article</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                    @if(empty($posts) || count($posts) === 0)
                        <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-8 text-center text-slate-500 md:col-span-3">
                            <svg class="w-16 h-16 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            <p>Blog feature is active, but no articles published yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif
    {{-- CTA Section with Gradient --}}
    <section class="relative py-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-cyan-600 to-blue-700"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE2YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0em0wIDI0YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0ek0xMiAxNmMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHptMCAyNGMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-30"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-white scroll-animate-left">
                    <h2 class="text-3xl sm:text-4xl font-bold mb-4">Ready to Transform Your Business?</h2>
                    <p class="text-lg text-blue-100 mb-8">Mari diskusikan kebutuhan IT Anda. Tim expert kami siap memberikan solusi terbaik yang disesuaikan dengan goals bisnis Anda.</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-8 py-4 text-base font-semibold text-blue-700 shadow-xl hover:bg-slate-50 transition">
                            <span>Start a Project</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="{{ route('about') }}" class="inline-flex items-center gap-2 rounded-xl border-2 border-white/30 bg-white/10 backdrop-blur px-8 py-4 text-base font-semibold text-white hover:bg-white/20 transition">Learn About Us</a>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="rounded-2xl bg-white/10 backdrop-blur border border-white/20 p-6">
                        <p class="text-4xl font-bold text-white mb-2">{{ \App\Models\Setting::get('stat_experience', '15+') }}</p>
                        <p class="text-blue-100">Years Experience</p>
                    </div>
                    <div class="rounded-2xl bg-white/10 backdrop-blur border border-white/20 p-6">
                        <p class="text-4xl font-bold text-white mb-2">{{ \App\Models\Setting::get('stat_clients', '200+') }}</p>
                        <p class="text-blue-100">Happy Clients</p>
                    </div>
                    <div class="rounded-2xl bg-white/10 backdrop-blur border border-white/20 p-6">
                        <p class="text-4xl font-bold text-white mb-2">{{ \App\Models\Setting::get('stat_total_projects', '500+') }}</p>
                        <p class="text-blue-100">Projects Done</p>
                    </div>
                    <div class="rounded-2xl bg-white/10 backdrop-blur border border-white/20 p-6">
                        <p class="text-4xl font-bold text-white mb-2">{{ \App\Models\Setting::get('stat_support', '24/7') }}</p>
                        <p class="text-blue-100">Support</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection