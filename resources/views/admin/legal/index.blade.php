@extends('layouts.admin')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-2xl font-bold text-slate-900">Legal Pages Management</h2>
        <p class="text-sm text-slate-600 mt-1">Manage Privacy Policy and Terms of Service</p>
    </div>
</div>

<div class="grid gap-6 md:grid-cols-2">
    @foreach(['privacy-policy' => 'Privacy Policy', 'terms-of-service' => 'Terms of Service'] as $type => $name)
        @php
            $page = \App\Models\LegalPage::where('type', $type)->first();
        @endphp
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <div class="flex items-start gap-4 mb-4">
                <div class="p-3 rounded-lg bg-blue-50">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-slate-900">{{ $name }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        @if($page)
                            Last updated: {{ $page->last_updated_at?->format('M d, Y H:i') ?? 'Never' }}
                        @else
                            Not created yet
                        @endif
                    </p>
                </div>
            </div>
            
            <div class="flex gap-2">
                <a href="{{ route('admin.legal.edit', $type) }}" class="flex-1 inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    {{ $page ? 'Edit' : 'Create' }}
                </a>
                @if($page)
                    <a href="{{ route('legal.show', $type) }}" target="_blank" class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
