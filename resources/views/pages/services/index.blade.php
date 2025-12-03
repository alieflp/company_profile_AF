@extends('layouts.app')
@section('content')
{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-slate-900 to-blue-900 text-white overflow-hidden py-16">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMyMTk2RjMiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE2YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0em0wIDI0YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0ek0xMiAxNmMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHptMCAyNGMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-20"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto">
            <p class="text-sm font-semibold text-blue-400 uppercase tracking-wide mb-3">Our Services</p>
            <h1 class="text-4xl sm:text-5xl font-bold mb-4">Technology Solutions for Your Business</h1>
            <p class="text-lg text-slate-300 mb-8">Kami menyediakan berbagai layanan IT profesional untuk membantu bisnis Anda berkembang di era digital.</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-8 py-4 text-base font-semibold text-blue-700 shadow-xl hover:bg-slate-50 transition">
                <span>Konsultasi Gratis</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- Services Grid --}}
<section class="py-20 bg-gradient-to-b from-slate-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($services ?? [] as $service)
                @php
                    $iconType = $service->icon_type ?? 'code';
                    $iconColor = $service->icon_color ?? 'blue';
                    $colorMap = [
                        'blue' => 'from-blue-500 to-blue-600',
                        'purple' => 'from-purple-500 to-purple-600',
                        'green' => 'from-green-500 to-green-600',
                        'orange' => 'from-orange-500 to-orange-600',
                        'red' => 'from-red-500 to-red-600',
                        'cyan' => 'from-cyan-500 to-cyan-600',
                        'pink' => 'from-pink-500 to-pink-600',
                        'indigo' => 'from-indigo-500 to-indigo-600',
                    ];
                    $gradientClass = $colorMap[$iconColor] ?? $colorMap['blue'];
                @endphp
                <article class="scroll-animate group relative rounded-2xl border border-slate-200 bg-white hover:shadow-2xl hover:border-transparent transition-all duration-300 overflow-hidden">
                    {{-- Gradient Background on Hover --}}
                    <div class="absolute inset-0 bg-gradient-to-br {{ $gradientClass }} opacity-0 group-hover:opacity-5 transition-opacity duration-300"></div>
                    
                    <div class="relative p-8">
                        {{-- Icon --}}
                        <div class="mb-6 inline-flex h-16 w-16 items-center justify-center rounded-xl bg-gradient-to-br {{ $gradientClass }} shadow-lg group-hover:scale-110 transition-transform duration-300">
                            @include('partials.service-icon', ['type' => $iconType])
                        </div>
                        
                        {{-- Title --}}
                        <h2 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r {{ $gradientClass }} transition-all duration-300">
                            {{ $service->title }}
                        </h2>
                        
                        {{-- Excerpt --}}
                        @if($service->excerpt)
                            <p class="text-sm text-slate-500 mb-4 font-medium">{{ $service->excerpt }}</p>
                        @endif
                        
                        {{-- Description --}}
                        <p class="text-sm text-slate-600 mb-6 line-clamp-3 leading-relaxed">
                            {{ Str::limit(strip_tags($service->description ?? 'Penjelasan layanan secara detail.'), 120) }}
                        </p>
                        
                        {{-- Footer --}}
                        <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                            @if($service->is_active)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-green-50 text-green-700 text-xs font-semibold">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    Available
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-100 text-slate-600 text-xs font-semibold">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                                    Coming Soon
                                </span>
                            @endif
                            <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-600 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r {{ $gradientClass }} group-hover:gap-2.5 transition-all">
                                <span>Learn More</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
            @if(empty($services) || count($services) === 0)
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center text-slate-500 md:col-span-3">
                    <svg class="w-20 h-20 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <p class="text-lg font-semibold text-slate-700 mb-1">No Services Available</p>
                    <p>We're preparing our service offerings. Check back soon!</p>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-16 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-600 p-12 text-center shadow-2xl">
            <h2 class="text-3xl font-bold text-white mb-4">Need a Custom Solution?</h2>
            <p class="text-lg text-blue-100 mb-8 max-w-2xl mx-auto">Setiap bisnis memiliki kebutuhan unik. Mari diskusikan bagaimana kami dapat membantu mencapai tujuan Anda.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-8 py-4 text-base font-semibold text-blue-700 shadow-xl hover:bg-slate-50 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    <span>Start a Conversation</span>
                </a>
                <a href="{{ route('portfolios.index.public') }}" class="inline-flex items-center gap-2 rounded-xl border-2 border-white px-8 py-4 text-base font-semibold text-white hover:bg-white hover:text-blue-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>View Our Work</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection