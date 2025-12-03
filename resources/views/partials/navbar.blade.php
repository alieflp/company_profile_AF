<header class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            {{-- Logo & Brand --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                @php
                    $companyLogo = \App\Models\Setting::get('company_logo');
                    $companyName = \App\Models\Setting::get('company_name', 'AF Web Design & Technology Needs');
                    $companyTagline = \App\Models\Setting::get('company_tagline', 'Transforming Ideas Into Digital Reality');
                @endphp
                
                <div class="relative">
                    @if($companyLogo && file_exists(public_path('storage/' . $companyLogo)))
                        <img src="{{ asset('storage/' . $companyLogo) }}" alt="{{ $companyName }}" class="h-12 w-12 object-contain">
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-cyan-600 rounded-lg blur opacity-25 group-hover:opacity-40 transition"></div>
                        <div class="relative h-12 w-12 rounded-lg bg-gradient-to-br from-blue-600 to-cyan-600 flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-xl">{{ substr($companyName, 0, 2) }}</span>
                        </div>
                    @endif
                </div>
                <div class="hidden sm:block">
                    <p class="text-lg font-bold text-slate-900 leading-tight">{{ $companyName }}</p>
                    <p class="text-xs text-slate-500 leading-tight truncate max-w-xs">{{ $companyTagline }}</p>
                </div>
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden lg:flex items-center gap-1">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">Home</a>
                <a href="{{ route('about') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">About</a>
                <a href="{{ route('services.index.public') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('services.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">Services</a>
                <a href="{{ route('portfolios.index.public') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('portfolios.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">Portfolio</a>
                <a href="{{ route('testimonials.index.public') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('testimonials.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">Testimonials</a>
                @if(config('features.blog'))
                    <a href="{{ route('blog.index.public') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('blog.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">Blog</a>
                @endif
                <a href="{{ route('contact') }}" class="ml-2 px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 shadow-lg shadow-blue-500/30 transition">Contact Us</a>
            </nav>

            {{-- Mobile Menu Button --}}
            <button id="mobileMenuButton" class="lg:hidden inline-flex items-center justify-center rounded-lg p-2 text-slate-700 hover:bg-slate-100">
                <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Mobile Navigation Menu --}}
        <nav id="mobileMenu" class="hidden lg:hidden pb-4">
            <div class="space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Home</span>
                    </div>
                </a>
                <a href="{{ route('about') }}" class="block px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>About</span>
                    </div>
                </a>
                <a href="{{ route('services.index.public') }}" class="block px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->routeIs('services.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Services</span>
                    </div>
                </a>
                <a href="{{ route('portfolios.index.public') }}" class="block px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->routeIs('portfolios.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Portfolio</span>
                    </div>
                </a>
                <a href="{{ route('testimonials.index.public') }}" class="block px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->routeIs('testimonials.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                        <span>Testimonials</span>
                    </div>
                </a>
                @if(config('features.blog'))
                    <a href="{{ route('blog.index.public') }}" class="block px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->routeIs('blog.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            <span>Blog</span>
                        </div>
                    </a>
                @endif
                <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 shadow-lg shadow-blue-500/30 transition mt-2">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Contact Us</span>
                    </div>
                </a>
            </div>
        </nav>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuIcon = document.getElementById('menuIcon');
    const closeIcon = document.getElementById('closeIcon');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    }
});
</script>