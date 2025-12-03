<footer class="bg-gradient-to-br from-slate-900 to-slate-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
            {{-- Brand Column --}}
            <div class="lg:col-span-1">
                @php
                    $companyLogo = \App\Models\Setting::get('company_logo');
                    $companyName = \App\Models\Setting::get('company_name', 'AF Web Design');
                    $companyTagline = \App\Models\Setting::get('company_tagline', '& Technology Needs');
                @endphp
                
                <div class="flex items-center gap-3 mb-4">
                    @if($companyLogo && file_exists(public_path('storage/' . $companyLogo)))
                        <div class="h-12 w-12 rounded-lg bg-white p-1.5 flex items-center justify-center">
                            <img src="{{ asset('storage/' . $companyLogo) }}" alt="{{ $companyName }}" class="h-full w-full object-contain">
                        </div>
                    @else
                        <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-blue-600 to-cyan-600 flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-xl">{{ strtoupper(substr($companyName, 0, 2)) }}</span>
                        </div>
                    @endif
                    <div>
                        <p class="text-base font-bold leading-tight">{{ $companyName }}</p>
                        <p class="text-xs text-slate-400 leading-tight">{{ $companyTagline }}</p>
                    </div>
                </div>
                <p class="text-sm text-slate-400 mb-4">{{ \App\Models\Setting::get('footer_about', 'Solusi teknologi terpercaya untuk mengembangkan bisnis digital Anda dengan inovasi dan kualitas terbaik.') }}</p>
                <div class="flex items-center gap-3">
                    @if(\App\Models\Setting::get('social_facebook'))
                    <a href="{{ \App\Models\Setting::get('social_facebook') }}" target="_blank" class="h-10 w-10 rounded-lg bg-slate-800 hover:bg-gradient-to-br hover:from-blue-600 hover:to-cyan-600 flex items-center justify-center transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    @endif
                    
                    @if(\App\Models\Setting::get('social_youtube'))
                    <a href="{{ \App\Models\Setting::get('social_youtube') }}" target="_blank" class="h-10 w-10 rounded-lg bg-slate-800 hover:bg-gradient-to-br hover:from-red-600 hover:to-red-500 flex items-center justify-center transition">
                        <svg class="w-5 h-5 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    @endif
                    
                    @if(\App\Models\Setting::get('social_instagram'))
                    <a href="{{ \App\Models\Setting::get('social_instagram') }}" target="_blank" class="h-10 w-10 rounded-lg bg-slate-800 hover:bg-gradient-to-br hover:from-pink-600 hover:to-purple-600 flex items-center justify-center transition">
                        <svg class="w-5 h-5 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-sm text-slate-400 hover:text-cyan-400 transition">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-sm text-slate-400 hover:text-cyan-400 transition">About Us</a></li>
                    <li><a href="{{ route('services.index.public') }}" class="text-sm text-slate-400 hover:text-cyan-400 transition">Our Services</a></li>
                    <li><a href="{{ route('portfolios.index.public') }}" class="text-sm text-slate-400 hover:text-cyan-400 transition">Portfolio</a></li>
                    <li><a href="{{ route('testimonials.index.public') }}" class="text-sm text-slate-400 hover:text-cyan-400 transition">Testimonials</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Services</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-sm text-slate-400 hover:text-cyan-400 transition">Web Development</a></li>
                    <li><a href="#" class="text-sm text-slate-400 hover:text-cyan-400 transition">Mobile Apps</a></li>
                    <li><a href="#" class="text-sm text-slate-400 hover:text-cyan-400 transition">Cloud Solutions</a></li>
                    <li><a href="#" class="text-sm text-slate-400 hover:text-cyan-400 transition">UI/UX Design</a></li>
                    <li><a href="#" class="text-sm text-slate-400 hover:text-cyan-400 transition">IT Consulting</a></li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Contact</h3>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-cyan-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span class="text-sm text-slate-400">{{ \App\Models\Setting::get('contact_email', 'info@afwebdesign.com') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-cyan-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span class="text-sm text-slate-400">{{ \App\Models\Setting::get('contact_phone', '+62 812-3456-7890') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-cyan-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-sm text-slate-400">{{ \App\Models\Setting::get('contact_address', 'Jakarta, Indonesia') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="mt-8 pt-6 border-t border-slate-700">
            <div class="flex flex-col md:flex-row items-center justify-between gap-2">
                <p class="text-sm text-slate-400">{{ \App\Models\Setting::get('footer_copyright', '© ' . date('Y') . ' AF Web Design & Technology Needs. All rights reserved.') }}</p>
                <div class="flex items-center gap-6 text-sm text-slate-400">
                    <a href="{{ route('legal.show.privacy') }}" class="hover:text-cyan-400 transition">Privacy Policy</a>
                    <a href="{{ route('legal.show.terms') }}" class="hover:text-cyan-400 transition">Terms of Service</a>
                    <a href="{{ route('admin.login') }}" class="hover:text-cyan-400 transition">Admin</a>
                </div>
            </div>
        </div>
    </div>
</footer>