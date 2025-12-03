@props(['status' => 'draft'])
@php
    $map = [
        'draft' => 'bg-slate-100 text-slate-600',
        'active' => 'bg-emerald-100 text-emerald-700',
        'inactive' => 'bg-amber-100 text-amber-700',
        'published' => 'bg-blue-100 text-blue-700',
        'archived' => 'bg-red-100 text-red-700',
    ];
@endphp
<span class="inline-flex items-center rounded-full px-3 py-1 text-[11px] font-medium {{ $map[$status] ?? 'bg-slate-100 text-slate-600' }}">{{ ucfirst($status) }}</span>