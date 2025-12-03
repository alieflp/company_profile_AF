@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900">Settings</h2>
    <p class="text-sm text-slate-600 mt-1">Configure your website, company info, and email settings</p>
</div>

{{-- Tabs --}}
<div class="mb-6">
    <div class="border-b border-slate-200">
        <nav class="-mb-px flex gap-6 overflow-x-auto">
            <button type="button" onclick="switchTab('company')" id="tab-company" class="tab-button border-b-2 border-blue-600 py-3 px-1 text-sm font-semibold text-blue-600 transition whitespace-nowrap">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Company Info</span>
                </div>
            </button>
            <button type="button" onclick="switchTab('contact')" id="tab-contact" class="tab-button border-b-2 border-transparent py-3 px-1 text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300 transition whitespace-nowrap">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span>Contact</span>
                </div>
            </button>
            <button type="button" onclick="switchTab('social')" id="tab-social" class="tab-button border-b-2 border-transparent py-3 px-1 text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300 transition whitespace-nowrap">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                    <span>Social Media</span>
                </div>
            </button>
            <button type="button" onclick="switchTab('hero')" id="tab-hero" class="tab-button border-b-2 border-transparent py-3 px-1 text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300 transition whitespace-nowrap">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Homepage Hero</span>
                </div>
            </button>
            <button type="button" onclick="switchTab('stats')" id="tab-stats" class="tab-button border-b-2 border-transparent py-3 px-1 text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300 transition whitespace-nowrap">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span>Statistics</span>
                </div>
            </button>
            <button type="button" onclick="switchTab('footer')" id="tab-footer" class="tab-button border-b-2 border-transparent py-3 px-1 text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300 transition whitespace-nowrap">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                    <span>Footer & SEO</span>
                </div>
            </button>
            <button type="button" onclick="switchTab('email')" id="tab-email" class="tab-button border-b-2 border-transparent py-3 px-1 text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300 transition whitespace-nowrap">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>Email Config</span>
                </div>
            </button>
        </nav>
    </div>
</div>

{{-- Company Info Tab --}}
<div id="content-company" class="tab-content">
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="max-w-4xl">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
            {{-- Logo Upload --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Company Logo</label>
                <div class="flex items-start gap-4">
                    @if($settingsGrouped['company']['company_logo'] ?? '')
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $settingsGrouped['company']['company_logo']) }}" alt="Logo" class="h-20 w-20 object-contain rounded-lg border-2 border-slate-200">
                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition rounded-lg flex items-center justify-center">
                                <span class="text-white text-xs">Current Logo</span>
                            </div>
                        </div>
                    @else
                        <div class="h-20 w-20 rounded-lg border-2 border-dashed border-slate-300 flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" name="logo" id="logo" accept="image/png,image/jpeg,image/jpg,image/svg+xml" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition">
                        <p class="text-xs text-slate-500 mt-1">Upload logo perusahaan (PNG, JPG, SVG, max 2MB)</p>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Company Name</label>
                <input type="text" name="settings[company_name]" value="{{ $settingsGrouped['company']['company_name'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="AF Web Design">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Tagline</label>
                <input type="text" name="settings[company_tagline]" value="{{ $settingsGrouped['company']['company_tagline'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="Transforming Ideas Into Digital Reality">
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Save Changes</span>
                </div>
            </button>
        </div>
    </form>
</div>

{{-- Contact Info Tab --}}
<div id="content-contact" class="tab-content hidden">
    <form method="POST" action="{{ route('admin.settings.update') }}" class="max-w-4xl">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                    <input type="email" name="settings[contact_email]" value="{{ $settingsGrouped['contact']['contact_email'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="info@company.com">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Phone Number</label>
                    <input type="text" name="settings[contact_phone]" value="{{ $settingsGrouped['contact']['contact_phone'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="+62 812-3456-7890">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">WhatsApp Number</label>
                <input type="text" name="settings[contact_whatsapp]" value="{{ $settingsGrouped['contact']['contact_whatsapp'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="+6281234567890">
                <p class="mt-1 text-xs text-slate-500">Format: +62 followed by number without spaces or dashes</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Address</label>
                <textarea name="settings[contact_address]" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition resize-none" placeholder="Office address">{{ $settingsGrouped['contact']['contact_address'] ?? '' }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Office Hours</label>
                <input type="text" name="settings[office_hours]" value="{{ $settingsGrouped['contact']['office_hours'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="Monday - Friday, 9:00 AM - 6:00 PM">
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Save Changes</span>
                </div>
            </button>
        </div>
    </form>
</div>

{{-- Social Media Tab --}}
<div id="content-social" class="tab-content hidden">
    <form method="POST" action="{{ route('admin.settings.update') }}" class="max-w-4xl">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        Facebook
                    </label>
                    <input type="url" name="settings[social_facebook]" value="{{ $settingsGrouped['social']['social_facebook'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="https://facebook.com/yourpage">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-pink-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        Instagram
                    </label>
                    <input type="url" name="settings[social_instagram]" value="{{ $settingsGrouped['social']['social_instagram'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="https://instagram.com/yourprofile">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-pink-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                        Instagram
                    </label>
                    <input type="url" name="settings[social_instagram]" value="{{ $settingsGrouped['social']['social_instagram'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="https://instagram.com/yourprofile">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        YouTube
                    </label>
                    <input type="url" name="settings[social_youtube]" value="{{ $settingsGrouped['social']['social_youtube'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="https://youtube.com/@yourchannel">
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Save Changes</span>
                </div>
            </button>
        </div>
    </form>
</div>

{{-- Homepage Hero Tab --}}
<div id="content-hero" class="tab-content hidden">
    <form method="POST" action="{{ route('admin.settings.update') }}" class="max-w-4xl">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Hero Title</label>
                <input type="text" name="settings[hero_title]" value="{{ $settingsGrouped['hero']['hero_title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="Transformasi Digital Dimulai dari Sini">
                <p class="mt-1 text-xs text-slate-500">Main headline on homepage</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Hero Subtitle</label>
                <textarea name="settings[hero_subtitle]" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition resize-none" placeholder="Brief description of your services">{{ $settingsGrouped['hero']['hero_subtitle'] ?? '' }}</textarea>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Save Changes</span>
                </div>
            </button>
        </div>
    </form>
</div>

{{-- Statistics Tab --}}
<div id="content-stats" class="tab-content hidden">
    <form method="POST" action="{{ route('admin.settings.update') }}" class="max-w-4xl">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Hero Section Stats</h3>
            <div class="grid grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Projects Delivered</label>
                    <input type="text" name="settings[stat_projects]" value="{{ $settingsGrouped['stats']['stat_projects'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="50+">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Client Satisfaction</label>
                    <input type="text" name="settings[stat_satisfaction]" value="{{ $settingsGrouped['stats']['stat_satisfaction'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="98%">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Support Available</label>
                    <input type="text" name="settings[stat_support]" value="{{ $settingsGrouped['stats']['stat_support'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="24/7">
                </div>
            </div>

            <hr class="border-slate-200 my-6">

            <h3 class="text-lg font-semibold text-slate-900 mb-4">CTA Section Stats</h3>
            <div class="grid grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Years Experience</label>
                    <input type="text" name="settings[stat_experience]" value="{{ $settingsGrouped['stats']['stat_experience'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="15+">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Happy Clients</label>
                    <input type="text" name="settings[stat_clients]" value="{{ $settingsGrouped['stats']['stat_clients'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="200+">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Total Projects</label>
                    <input type="text" name="settings[stat_total_projects]" value="{{ $settingsGrouped['stats']['stat_total_projects'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="500+">
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Save Changes</span>
                </div>
            </button>
        </div>
    </form>
</div>

{{-- Footer & SEO Tab --}}
<div id="content-footer" class="tab-content hidden">
    <form method="POST" action="{{ route('admin.settings.update') }}" class="max-w-4xl">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Footer About Text</label>
                <textarea name="settings[footer_about]" rows="4" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition resize-none" placeholder="Brief description about your company for footer">{{ $settingsGrouped['footer']['footer_about'] ?? '' }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Copyright Text</label>
                <input type="text" name="settings[footer_copyright]" value="{{ $settingsGrouped['footer']['footer_copyright'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="© 2025 Your Company. All rights reserved.">
            </div>

            <hr class="border-slate-200">

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Meta Keywords</label>
                <input type="text" name="settings[meta_keywords]" value="{{ $settingsGrouped['seo']['meta_keywords'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="web development, IT solutions, etc.">
                <p class="mt-1 text-xs text-slate-500">Separate keywords with commas</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Meta Description</label>
                <textarea name="settings[meta_description]" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition resize-none" placeholder="Brief description for search engines">{{ $settingsGrouped['seo']['meta_description'] ?? '' }}</textarea>
                <p class="mt-1 text-xs text-slate-500">Max 160 characters for best SEO results</p>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Save Changes</span>
                </div>
            </button>
        </div>
    </form>
</div>


{{-- Email Configuration Tab --}}
<div id="content-email" class="tab-content hidden">
    <form method="POST" action="{{ route('admin.settings.email.update') }}" class="max-w-4xl">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
            {{-- Info Alert --}}
            <div class="rounded-lg bg-blue-50 border-l-4 border-blue-500 p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-blue-900">Email Configuration</p>
                        <p class="text-xs text-blue-700 mt-1">Konfigurasi ini digunakan untuk mengirim email seperti reset password, notifikasi, dll.</p>
                    </div>
                </div>
            </div>

            {{-- Mail Driver --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Mail Driver <span class="text-red-500">*</span>
                </label>
                <select name="mail_mailer" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500" required>
                    <option value="smtp" {{ env('MAIL_MAILER') === 'smtp' ? 'selected' : '' }}>SMTP</option>
                    <option value="log" {{ env('MAIL_MAILER') === 'log' ? 'selected' : '' }}>Log (Development)</option>
                </select>
                <p class="text-xs text-slate-500 mt-1">Pilih metode pengiriman email</p>
            </div>

            {{-- SMTP Host --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    SMTP Host <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="mail_host" 
                    value="{{ old('mail_host', env('MAIL_HOST', 'smtp.gmail.com')) }}" 
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500" 
                    placeholder="smtp.gmail.com"
                    required
                />
                <p class="text-xs text-slate-500 mt-1">Contoh: smtp.gmail.com, smtp.sendgrid.net, smtp.mailtrap.io</p>
            </div>

            {{-- SMTP Port --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    SMTP Port <span class="text-red-500">*</span>
                </label>
                <input 
                    type="number" 
                    name="mail_port" 
                    value="{{ old('mail_port', env('MAIL_PORT', '587')) }}" 
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500" 
                    placeholder="587"
                    required
                />
                <p class="text-xs text-slate-500 mt-1">Port standar: 587 (TLS) atau 465 (SSL)</p>
            </div>

            {{-- SMTP Username --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    SMTP Username <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="mail_username" 
                    value="{{ old('mail_username', env('MAIL_USERNAME')) }}" 
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500" 
                    placeholder="your-email@gmail.com"
                    required
                />
                <p class="text-xs text-slate-500 mt-1">Email atau username SMTP Anda</p>
            </div>

            {{-- SMTP Password --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    SMTP Password <span class="text-red-500">*</span>
                </label>
                <input 
                    type="password" 
                    name="mail_password" 
                    value="{{ old('mail_password', env('MAIL_PASSWORD')) }}" 
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500" 
                    placeholder="••••••••"
                    required
                />
                <p class="text-xs text-slate-500 mt-1">Untuk Gmail gunakan App Password, bukan password akun biasa</p>
            </div>

            {{-- SMTP Encryption --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Encryption <span class="text-red-500">*</span>
                </label>
                <select name="mail_encryption" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500" required>
                    <option value="tls" {{ env('MAIL_ENCRYPTION') === 'tls' ? 'selected' : '' }}>TLS</option>
                    <option value="ssl" {{ env('MAIL_ENCRYPTION') === 'ssl' ? 'selected' : '' }}>SSL</option>
                </select>
                <p class="text-xs text-slate-500 mt-1">Umumnya TLS untuk port 587, SSL untuk port 465</p>
            </div>

            {{-- From Address --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    From Email <span class="text-red-500">*</span>
                </label>
                <input 
                    type="email" 
                    name="mail_from_address" 
                    value="{{ old('mail_from_address', env('MAIL_FROM_ADDRESS', 'noreply@afwebdesign.com')) }}" 
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500" 
                    placeholder="noreply@afwebdesign.com"
                    required
                />
                <p class="text-xs text-slate-500 mt-1">Email pengirim yang akan ditampilkan</p>
            </div>

            {{-- From Name --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    From Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="mail_from_name" 
                    value="{{ old('mail_from_name', env('MAIL_FROM_NAME', 'AF Web Design')) }}" 
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500" 
                    placeholder="AF Web Design"
                    required
                />
                <p class="text-xs text-slate-500 mt-1">Nama pengirim yang akan ditampilkan</p>
            </div>

            {{-- Gmail Help --}}
            <div class="rounded-lg bg-amber-50 border border-amber-200 p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-amber-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-amber-900 mb-1">Cara Setup Gmail SMTP</p>
                        <ol class="text-xs text-amber-800 space-y-1 list-decimal list-inside">
                            <li>Buka <a href="https://myaccount.google.com/security" target="_blank" class="underline hover:text-amber-900">Google Account Security</a></li>
                            <li>Aktifkan 2-Step Verification</li>
                            <li>Buka <a href="https://myaccount.google.com/apppasswords" target="_blank" class="underline hover:text-amber-900">App Passwords</a></li>
                            <li>Generate password baru untuk "Mail"</li>
                            <li>Copy password tersebut dan paste di field SMTP Password</li>
                        </ol>
                    </div>
                </div>
            </div>

            {{-- Test Email Button --}}
            <div class="rounded-lg bg-slate-50 border border-slate-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-700">Test Email Configuration</p>
                        <p class="text-xs text-slate-500 mt-1">Kirim test email untuk memastikan konfigurasi benar</p>
                    </div>
                    <button type="button" onclick="sendTestEmail()" class="inline-flex items-center gap-2 rounded-lg bg-slate-700 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>Send Test</span>
                    </button>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:from-blue-700 hover:to-cyan-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Save Email Configuration</span>
                </button>
                <p class="text-xs text-slate-500">Konfigurasi akan disimpan ke file .env</p>
            </div>
        </div>
    </form>
</div>

<script>
function switchTab(tab) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active state from all tab buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('border-blue-600', 'text-blue-600');
        button.classList.add('border-transparent', 'text-slate-500');
    });
    
    // Show selected tab content
    document.getElementById('content-' + tab).classList.remove('hidden');
    
    // Add active state to selected tab button
    const activeButton = document.getElementById('tab-' + tab);
    activeButton.classList.remove('border-transparent', 'text-slate-500');
    activeButton.classList.add('border-blue-600', 'text-blue-600');
}

function sendTestEmail() {
    if (!confirm('Kirim test email ke email admin?')) return;
    
    // Show loading state
    const button = event.target.closest('button');
    const originalContent = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Sending...';
    
    fetch('{{ route("admin.settings.email.test") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        button.disabled = false;
        button.innerHTML = originalContent;
        
        if (data.success) {
            alert('✓ Test email berhasil dikirim! Check inbox Anda.');
        } else {
            alert('✗ Gagal mengirim test email: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        button.disabled = false;
        button.innerHTML = originalContent;
        alert('✗ Error: ' + error.message);
    });
}
</script>
@endsection