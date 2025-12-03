@extends('layouts.app')
@section('content')
@if(isset($portfolio))
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-slate-900 to-blue-900 text-white py-20">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMyMTk2RjMiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE2YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0em0wIDI0YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0ek0xMiAxNmMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHptMCAyNGMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('portfolios.index.public') }}" class="inline-flex items-center gap-2 text-blue-300 hover:text-white transition mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    <span class="text-sm font-medium">Back to Portfolio</span>
                </a>
            </div>
            @if(!empty($portfolio->category))
                <span class="inline-block px-3 py-1 rounded-full bg-cyan-500/20 text-cyan-300 text-xs font-semibold uppercase tracking-wide mb-4">{{ $portfolio->category }}</span>
            @endif
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $portfolio->title }}</h1>
            @if($portfolio->excerpt)
                <p class="text-xl text-blue-100 mb-4 max-w-3xl">{{ $portfolio->excerpt }}</p>
            @endif
            <div class="flex flex-wrap items-center gap-4 text-slate-300">
                @if($portfolio->client)
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span class="font-medium">{{ $portfolio->client }}</span>
                    </div>
                @endif
                @if($portfolio->completed_at)
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ $portfolio->completed_at->format('F Y') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-12">
                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-8">
                    {{-- Featured Image --}}
                    <div class="aspect-video rounded-2xl overflow-hidden shadow-2xl bg-slate-100">
                        @if($portfolio->thumbnail_url ?? false)
                            <img src="{{ $portfolio->thumbnail_url }}" alt="{{ $portfolio->title }}" class="w-full h-full object-contain">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                                <svg class="w-24 h-24 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>

                    {{-- Overview --}}
                    @if($portfolio->excerpt)
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900 mb-4">Project Overview</h2>
                            <div class="prose prose-slate max-w-none">
                                <p class="text-lg text-slate-700 leading-relaxed">{{ $portfolio->excerpt }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Full Description --}}
                    @if($portfolio->description)
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900 mb-4">Project Details</h2>
                            <div class="prose prose-slate max-w-none">
                                {!! nl2br(e($portfolio->description)) !!}
                            </div>
                        </div>
                    @endif

                    {{-- Gallery --}}
                    @if(!empty($portfolio->gallery) && is_array($portfolio->gallery) && count($portfolio->gallery) > 0)
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900 mb-6">Project Gallery</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($portfolio->gallery as $index => $img)
                                    <div class="rounded-xl overflow-hidden bg-slate-50 shadow-lg border border-slate-200">
                                        <img src="{{ asset($img) }}" alt="Gallery Image {{ $index + 1 }}" class="w-full h-auto">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">
                        {{-- Project Info Card --}}
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-lg">
                            <h3 class="text-lg font-bold text-slate-900 mb-4">Project Details</h3>
                            <dl class="space-y-4">
                                @if($portfolio->client)
                                    <div>
                                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">Client</dt>
                                        <dd class="text-sm font-medium text-slate-900">{{ $portfolio->client }}</dd>
                                    </div>
                                @endif
                                @if($portfolio->completed_at)
                                    <div>
                                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">Completed</dt>
                                        <dd class="text-sm font-medium text-slate-900">{{ $portfolio->completed_at->format('F d, Y') }}</dd>
                                    </div>
                                @endif
                                @if($portfolio->category)
                                    <div>
                                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">Category</dt>
                                        <dd class="text-sm font-medium text-slate-900">{{ $portfolio->category }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>

                        {{-- Tech Stack --}}
                        @if(!empty($portfolio->tech_stack))
                            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-lg">
                                <h3 class="text-lg font-bold text-slate-900 mb-4">Technologies Used</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(',', $portfolio->tech_stack) as $tech)
                                        <span class="inline-block px-3 py-1.5 rounded-lg bg-gradient-to-r from-blue-50 to-cyan-50 text-blue-700 text-xs font-semibold border border-blue-200">{{ trim($tech) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Live Project Link --}}
                        @if($portfolio->link)
                            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-lg">
                                <h3 class="text-lg font-bold text-slate-900 mb-3">Live Project</h3>
                                <a href="{{ $portfolio->link }}" target="_blank" rel="noopener noreferrer" class="group/btn block w-full text-center rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-blue-500/50 hover:from-blue-700 hover:to-cyan-700 transition-all duration-300">
                                    <div class="flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        <span>Visit Live Site</span>
                                    </div>
                                </a>
                            </div>
                        @endif

                        {{-- CTA Card --}}
                        <div class="rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-600 p-6 shadow-xl">
                            <h3 class="text-lg font-bold text-white mb-2">Like This Project?</h3>
                            <p class="text-sm text-blue-100 mb-4">Let's discuss how we can create something amazing for your business too.</p>
                            <a href="{{ route('contact') }}" class="block w-full text-center rounded-lg bg-white px-6 py-3 text-sm font-semibold text-blue-600 shadow-lg hover:bg-slate-50 transition">
                                Start Your Project
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">
                <svg class="w-20 h-20 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-lg font-semibold text-slate-700 mb-1">Portfolio Not Found</p>
                <p class="text-slate-500 mb-6">The project you're looking for doesn't exist.</p>
                <a href="{{ route('portfolios.index.public') }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back to Portfolio
                </a>
            </div>
        </div>
    </section>
@endif
@endsection