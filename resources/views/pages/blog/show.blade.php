@extends('layouts.app')
@section('content')
@if(!config('features.blog'))
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">
                <svg class="w-20 h-20 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <p class="text-lg font-semibold text-slate-700 mb-1">Blog Feature Disabled</p>
                <p class="text-slate-500">The blog feature is currently not enabled.</p>
            </div>
        </div>
    </section>
@else
    @if(isset($post))
        {{-- Hero Section --}}
        <section class="relative bg-gradient-to-br from-slate-900 to-blue-900 text-white py-20">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMyMTk2RjMiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE2YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0em0wIDI0YzAgMi4yMSAxLjc5IDQgNCA0czQtMS43OSA0LTQtMS43OS00LTQtNC00IDEuNzktNCA0ek0xMiAxNmMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHptMCAyNGMwIDIuMjEgMS43OSA0IDQgNHM0LTEuNzkgNC00LTEuNzktNC00LTQtNCAxLjc5LTQgNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-20"></div>
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <a href="{{ route('blog.index.public') }}" class="inline-flex items-center gap-2 text-blue-300 hover:text-white transition mb-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    <span class="text-sm font-medium">Back to Blog</span>
                </a>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $post->title }}</h1>
                <div class="flex items-center gap-4 text-slate-300">
                    <time class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $post->published_at?->format('F d, Y') ?? 'Draft' }}
                    </time>
                    @if($post->author ?? false)
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ $post->author }}
                        </span>
                    @endif
                </div>
            </div>
        </section>

        {{-- Article Content --}}
        <section class="py-16 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Cover Image --}}
                @if(!empty($post->cover_image))
                    <div class="rounded-2xl overflow-hidden shadow-2xl mb-12 bg-slate-100">
                        <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-auto">
                    </div>
                @endif

                {{-- Article Body --}}
                <article class="prose prose-slate prose-lg max-w-none">
                    {!! nl2br(e($post->content ?? 'Konten artikel belum tersedia.')) !!}
                </article>

                {{-- Gallery Images --}}
                @if(!empty($post->gallery) && is_array($post->gallery) && count($post->gallery) > 0)
                    <div class="mt-12 pt-8 border-t border-slate-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($post->gallery as $index => $imagePath)
                                <div class="rounded-xl overflow-hidden bg-slate-50 shadow-lg border border-slate-200">
                                    <img 
                                        src="{{ asset($imagePath) }}" 
                                        alt="Gallery image {{ $index + 1 }}" 
                                        class="w-full h-auto"
                                    >
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Tags --}}
                @if(!empty($post->tags))
                    <div class="mt-12 pt-8 border-t border-slate-200">
                        <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-3">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                                <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-blue-700 text-sm font-medium transition">
                                    <span>#{{ $tag }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif


                {{-- Back to Blog CTA --}}
                <div class="mt-12">
                    <a href="{{ route('blog.index.public') }}" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:from-blue-700 hover:to-cyan-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        View More Articles
                    </a>
                </div>
            </div>
        </section>
    @else
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">
                    <svg class="w-20 h-20 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-lg font-semibold text-slate-700 mb-1">Article Not Found</p>
                    <p class="text-slate-500 mb-6">The article you're looking for doesn't exist or has been removed.</p>
                    <a href="{{ route('blog.index.public') }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Back to Blog
                    </a>
                </div>
            </div>
        </section>
    @endif
@endif
@endsection