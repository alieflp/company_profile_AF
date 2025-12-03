@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-16">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-slate-900 mb-3">Share Your Experience</h1>
        <p class="text-slate-600">Kami sangat menghargai feedback Anda. Testimoni Anda akan membantu klien lain membuat keputusan yang lebih baik.</p>
    </div>
    @include('partials.alerts')
    <div class="bg-white rounded-2xl border-2 border-slate-200 shadow-lg p-8">
        <form method="POST" action="{{ route('testimonials.submit') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="Contoh: John Doe" />
                <p class="text-xs text-slate-500 mt-1">Nama Anda yang akan ditampilkan di website</p>
                @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Perusahaan <span class="text-slate-400 font-normal">(opsional)</span></label>
                <input type="text" name="company" value="{{ old('company') }}" class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition" placeholder="Contoh: PT. Teknologi Indonesia" />
                <p class="text-xs text-slate-500 mt-1">Nama perusahaan tempat Anda bekerja</p>
                @error('company')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Pesan Testimoni *</label>
                <textarea name="message" rows="6" required class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition resize-none" placeholder="Contoh: Pelayanan sangat memuaskan! Tim profesional dan hasil pekerjaan melebihi ekspektasi. Sangat direkomendasikan untuk project web development.">{{ old('message') }}</textarea>
                <p class="text-xs text-slate-500 mt-1">Ceritakan pengalaman Anda bekerja dengan kami (minimal 20 karakter)</p>
                @error('message')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Rating <span class="text-slate-400 font-normal">(opsional)</span></label>
                <select name="rating" class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition">
                    <option value="">-- Pilih rating --</option>
                    <option value="5" @selected(old('rating') == 5)>⭐⭐⭐⭐⭐ Sangat Memuaskan (5)</option>
                    <option value="4" @selected(old('rating') == 4)>⭐⭐⭐⭐ Memuaskan (4)</option>
                    <option value="3" @selected(old('rating') == 3)>⭐⭐⭐ Cukup (3)</option>
                    <option value="2" @selected(old('rating') == 2)>⭐⭐ Kurang (2)</option>
                    <option value="1" @selected(old('rating') == 1)>⭐ Tidak Memuaskan (1)</option>
                </select>
                <p class="text-xs text-slate-500 mt-1">Berikan rating untuk layanan kami</p>
                @error('rating')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="pt-4 border-t border-slate-200">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div>
                            <p class="text-sm font-semibold text-blue-900 mb-1">Informasi Penting</p>
                            <p class="text-xs text-blue-700">Testimoni Anda akan ditinjau oleh admin terlebih dahulu sebelum dipublikasikan di website. Kami akan menghubungi Anda jika ada pertanyaan.</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <a href="{{ route('testimonials.index.public') }}" class="text-sm text-slate-600 hover:text-slate-900 font-medium transition">← Kembali</a>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-cyan-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Kirim Testimoni</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
