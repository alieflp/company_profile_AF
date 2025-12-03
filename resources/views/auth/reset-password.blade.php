@extends('layouts.app')
@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-900 to-blue-900">
    <div class="max-w-md w-full">
        {{-- Logo/Brand --}}
        <div class="text-center mb-8">
            <div class="inline-flex h-16 w-16 rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-600 items-center justify-center shadow-2xl mb-4">
                <span class="text-white font-bold text-2xl">AF</span>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Reset Password</h1>
            <p class="text-blue-200">Masukkan password baru Anda</p>
        </div>

        {{-- Reset Password Form --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            @if($errors->any())
                <div class="mb-6 rounded-lg bg-red-50 border-l-4 border-red-500 p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="flex-1">
                            @foreach($errors->all() as $error)
                                <p class="text-sm font-medium text-red-900">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email', $email) }}" 
                        class="w-full rounded-lg border-slate-300 bg-slate-50 focus:border-blue-500 focus:ring-blue-500" 
                        readonly 
                    />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Password Baru <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 @error('password') border-red-500 @enderror" 
                        placeholder="••••••••" 
                        required 
                        autofocus
                    />
                    <p class="text-xs text-slate-500 mt-1">Minimal 8 karakter</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500" 
                        placeholder="••••••••" 
                        required 
                    />
                    <p class="text-xs text-slate-500 mt-1">Ketik ulang password baru Anda</p>
                </div>

                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 text-base font-semibold text-white shadow-lg hover:from-blue-700 hover:to-cyan-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    <span>Reset Password</span>
                </button>
            </form>
        </div>

        {{-- Back to Login --}}
        <div class="mt-6 text-center">
            <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-2 text-sm text-blue-200 hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Back to Login</span>
            </a>
        </div>
    </div>
</div>
@endsection
