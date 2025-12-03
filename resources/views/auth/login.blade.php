@extends('layouts.app')
@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-900 to-blue-900">
    <div class="max-w-md w-full">
        {{-- Logo/Brand --}}
        <div class="text-center mb-8">
            <div class="inline-flex h-16 w-16 rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-600 items-center justify-center shadow-2xl mb-4">
                <span class="text-white font-bold text-2xl">AF</span>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Admin Login</h1>
            <p class="text-blue-200">AF Web Design & Technology Needs</p>
        </div>

        {{-- Login Form --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <form method="POST" action="{{ url('/auth/login') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500" placeholder="admin@example.com" required autofocus />
                    @error('email')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500" placeholder="••••••••" required />
                    @error('password')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" />
                        <label for="remember" class="ml-2 text-sm text-slate-600">Remember me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                        Lupa Password?
                    </a>
                </div>
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 text-base font-semibold text-white shadow-lg hover:from-blue-700 hover:to-cyan-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    <span>Sign In</span>
                </button>
                <p class="text-xs text-center text-slate-500">Protected by rate limiting</p>
            </form>
        </div>

        {{-- Back to Website --}}
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm text-blue-200 hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Website</span>
            </a>
        </div>
    </div>
</div>
@endsection