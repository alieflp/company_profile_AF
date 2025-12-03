{{-- Modern Toast Notifications - Fixed Position --}}
@if (session('success'))
<div class="fixed top-4 right-4 z-50 animate-slide-in-right max-w-md">
    <div class="rounded-xl bg-white shadow-2xl border-l-4 border-emerald-500 p-4">
        <div class="flex items-start gap-3">
            <div class="shrink-0">
                <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1 pt-0.5">
                <p class="text-sm font-bold text-slate-900">Berhasil!</p>
                <p class="text-sm text-slate-600 mt-1">{{ session('success') }}</p>
            </div>
            <button onclick="this.closest('.animate-slide-in-right').remove()" class="shrink-0 text-slate-400 hover:text-slate-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
</div>
@endif

@if (session('error'))
<div class="fixed top-4 right-4 z-50 animate-slide-in-right max-w-md">
    <div class="rounded-xl bg-white shadow-2xl border-l-4 border-red-500 p-4">
        <div class="flex items-start gap-3">
            <div class="shrink-0">
                <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1 pt-0.5">
                <p class="text-sm font-bold text-slate-900">Error!</p>
                <p class="text-sm text-slate-600 mt-1">{{ session('error') }}</p>
            </div>
            <button onclick="this.closest('.animate-slide-in-right').remove()" class="shrink-0 text-slate-400 hover:text-slate-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
</div>
@endif

@if (session('too_many_requests'))
<div class="fixed top-4 right-4 z-50 animate-slide-in-right max-w-md">
    <div class="rounded-xl bg-white shadow-2xl border-l-4 border-amber-500 p-4">
        <div class="flex items-start gap-3">
            <div class="shrink-0">
                <div class="h-10 w-10 rounded-full bg-amber-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1 pt-0.5">
                <p class="text-sm font-bold text-slate-900">Peringatan</p>
                <p class="text-sm text-slate-600 mt-1">{{ session('too_many_requests') }}</p>
            </div>
            <button onclick="this.closest('.animate-slide-in-right').remove()" class="shrink-0 text-slate-400 hover:text-slate-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
</div>
@endif