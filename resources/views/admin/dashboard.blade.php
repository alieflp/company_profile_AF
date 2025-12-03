@extends('layouts.admin')
@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-slate-900 mb-2">Welcome Back!</h2>
    <p class="text-slate-600">Here's what's happening with your website today.</p>
</div>

<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4 mb-8">
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-600 p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-blue-100 mb-1">Total Services</p>
                <p class="text-3xl font-bold text-white">{{ $metrics['services'] ?? 0 }}</p>
            </div>
            <div class="h-12 w-12 rounded-lg bg-white/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
        </div>
    </div>

    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-violet-600 to-purple-600 p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-purple-100 mb-1">Total Portfolios</p>
                <p class="text-3xl font-bold text-white">{{ $metrics['portfolios'] ?? 0 }}</p>
            </div>
            <div class="h-12 w-12 rounded-lg bg-white/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>
    </div>

    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-orange-100 mb-1">Testimonials</p>
                <p class="text-3xl font-bold text-white">{{ $metrics['testimonials'] ?? 0 }}</p>
            </div>
            <div class="h-12 w-12 rounded-lg bg-white/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
            </div>
        </div>
    </div>

    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-rose-500 to-pink-600 p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-pink-100 mb-1">Unread Messages</p>
                <p class="text-3xl font-bold text-white">{{ $metrics['contacts_unread'] ?? 0 }}</p>
            </div>
            <div class="h-12 w-12 rounded-lg bg-white/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
        </div>
    </div>
</div>

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm max-w-2xl">
    <h3 class="text-lg font-bold text-slate-900 mb-4">Quick Actions</h3>
    <div class="space-y-3">
        <a href="{{ route('admin.services.create') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition">
            <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-900">Add New Service</p>
                <p class="text-xs text-slate-500">Create a new service offering</p>
            </div>
        </a>
        <a href="{{ route('admin.portfolios.create') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition">
            <div class="h-10 w-10 rounded-lg bg-purple-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-900">Add New Portfolio</p>
                <p class="text-xs text-slate-500">Showcase your latest project</p>
            </div>
        </a>
        <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition">
            <div class="h-10 w-10 rounded-lg bg-rose-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-900">View Messages</p>
                <p class="text-xs text-slate-500">Check contact inquiries</p>
            </div>
        </a>
    </div>
</div>
@endsection