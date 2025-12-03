@extends('layouts.app')
@section('content')
{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-slate-900 to-blue-900 text-white overflow-hidden py-16">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMyMTk2RjMiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE2YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0em0wIDI0YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0ek0xMiAxNmMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHptMCAyNGMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-20"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-sm font-semibold text-blue-400 uppercase tracking-wide mb-3">Our Work</p>
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Project Portfolio</h1>
        <p class="text-lg text-slate-300 max-w-2xl mx-auto">Explore our successful projects spanning web development, mobile apps, and enterprise systems</p>
    </div>
</section>

{{-- Portfolio Grid --}}
<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($portfolios ?? [] as $portfolio)
                <article class="scroll-animate-scale group relative bg-white rounded-2xl shadow-md border border-slate-200 overflow-hidden hover:shadow-2xl transition-all duration-300 flex flex-col">
                    <div class="aspect-video bg-gradient-to-br from-slate-100 to-slate-200 relative overflow-hidden">
                        @if($portfolio->thumbnail_url ?? false)
                            <img src="{{ $portfolio->thumbnail_url }}" alt="{{ $portfolio->title }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                        <div class="absolute top-3 left-3 flex gap-2">
                            <span class="inline-flex items-center rounded-lg bg-white/90 backdrop-blur px-3 py-1.5 text-xs font-semibold text-slate-900">{{ $portfolio->category ?? 'Web' }}</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <h2 class="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition line-clamp-2">{{ $portfolio->title }}</h2>
                            @if($portfolio->completed_at)
                                <span class="text-xs text-slate-500 whitespace-nowrap">{{ $portfolio->completed_at->format('M Y') }}</span>
                            @endif
                        </div>
                        @if($portfolio->excerpt)
                            <p class="text-sm text-slate-600 mb-3 line-clamp-2">{{ $portfolio->excerpt }}</p>
                        @elseif($portfolio->description)
                            <p class="text-sm text-slate-600 mb-3 line-clamp-2">{{ $portfolio->description }}</p>
                        @endif
                        @if($portfolio->tech_stack)
                            <div class="flex flex-wrap gap-1 mb-3">
                                @foreach(array_slice(explode(',', $portfolio->tech_stack), 0, 3) as $tech)
                                    <span class="inline-block px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700">{{ trim($tech) }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="flex items-center justify-between gap-3 mt-auto pt-3">
                            <p class="text-xs text-slate-500">{{ $portfolio->client ?? 'Enterprise Client' }}</p>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('portfolios.show.public', $portfolio->slug) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 group-hover:gap-3 transition-all">
                                    <span>View</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                                @if($portfolio->link)
                                    <a href="{{ $portfolio->link }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50/50 hover:bg-blue-100/70 border border-blue-200/50 transition-all" title="View Live Project">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
            @if(empty($portfolios) || count($portfolios) === 0)
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center text-slate-500 md:col-span-3">
                    <svg class="w-20 h-20 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <p class="text-lg font-semibold text-slate-700 mb-1">No Projects Yet</p>
                    <p>Check back soon for our latest work!</p>
                </div>
            @endif
        </div>
        
        @if(isset($portfolios) && method_exists($portfolios, 'links'))
            <div class="mt-12">
                {{ $portfolios->links() }}
            </div>
        @endif
    </div>
</section>
@endsection