@extends('layouts.app')
@section('content')
{{-- Hero Section with Split Layout --}}
<section class="relative bg-gradient-to-br from-slate-900 to-blue-900 text-white overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMyMTk2RjMiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE2YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0em0wIDI0YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0ek0xMiAxNmMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHptMCAyNGMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-20"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
        <div class="max-w-3xl">
            <p class="text-sm font-semibold text-blue-400 uppercase tracking-wide mb-4">About Us</p>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6">{{ $about->headline ?? 'Transforming Ideas Into Digital Reality' }}</h1>
            <p class="text-xl text-slate-300 mb-8">{{ $about->description ?? 'We are a team of passionate technologists dedicated to delivering exceptional IT solutions that drive business growth.' }}</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-8 py-4 text-base font-semibold text-blue-700 shadow-xl hover:bg-slate-50 transition">
                <span>Work With Us</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

@if($about)
{{-- Vision & Mission Section --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12">
            @if(!empty($about->vision))
            <div class="relative scroll-animate-left">
                <div class="absolute -left-4 top-0 w-1 h-24 bg-gradient-to-b from-blue-600 to-cyan-600 rounded-full"></div>
                <div class="pl-8">
                    <div class="inline-flex items-center gap-2 mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <h2 class="text-2xl font-bold text-slate-900">Our Vision</h2>
                    </div>
                    <p class="text-lg text-slate-700 leading-relaxed">{{ $about->vision }}</p>
                </div>
            </div>
            @endif
            @php
                $mission = is_array($about->mission ?? null)
                    ? $about->mission
                    : (!empty($about->mission) ? [$about->mission] : []);
            @endphp
            @if(!empty($mission))
            <div class="relative scroll-animate-right">
                <div class="absolute -left-4 top-0 w-1 h-24 bg-gradient-to-b from-cyan-600 to-blue-600 rounded-full"></div>
                <div class="pl-8">
                    <div class="inline-flex items-center gap-2 mb-4">
                        <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        <h2 class="text-2xl font-bold text-slate-900">Our Mission</h2>
                    </div>
                    <ul class="space-y-3">
                        @foreach($mission as $m)
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-cyan-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-slate-700">{{ $m }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

{{-- Company Values Grid --}}
<section class="py-20 bg-gradient-to-b from-slate-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 scroll-animate">
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide mb-2">Core Values</p>
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900">What Drives Us</h2>
        </div>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
            @php
                $meta = $about->meta ?? [];
                $coreValues = $meta['core_values'] ?? [
                    ['title' => 'Innovation', 'description' => 'Constantly exploring new technologies and methodologies', 'icon' => 'lightning'],
                    ['title' => 'Quality', 'description' => 'Delivering excellence in every line of code', 'icon' => 'shield'],
                    ['title' => 'Collaboration', 'description' => 'Working together to achieve remarkable results', 'icon' => 'users'],
                    ['title' => 'Growth', 'description' => 'Continuous improvement and learning mindset', 'icon' => 'chart']
                ];
                
                $iconMap = [
                    'lightning' => 'M13 10V3L4 14h7v7l9-11h-7z',
                    'shield' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                    'users' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                    'chart' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6',
                    'star' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                    'heart' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                    'rocket' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z',
                    'target' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
                ];
                
                $gradients = [
                    'from-blue-600 to-cyan-600',
                    'from-cyan-600 to-blue-600',
                    'from-blue-600 to-cyan-600',
                    'from-cyan-600 to-blue-600'
                ];
            @endphp
            @foreach($coreValues as $index => $value)
                @if(!empty($value['title']))
                    <div class="text-center scroll-animate-scale">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br {{ $gradients[$index % 4] }} text-white mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconMap[$value['icon']] ?? $iconMap['lightning'] }}"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $value['title'] }}</h3>
                        <p class="text-sm text-slate-600">{{ $value['description'] }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@else
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <svg class="w-20 h-20 mx-auto mb-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
        <h2 class="text-2xl font-bold text-slate-900 mb-2">Content Coming Soon</h2>
        <p class="text-slate-600">We're working on our story. Check back soon!</p>
    </div>
</section>
@endif
@endsection