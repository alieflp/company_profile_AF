@extends('layouts.admin')
@section('content')
<h1 class="text-xl font-bold text-slate-900 mb-4">Detail Pesan Kontak</h1>
<div class="rounded-xl border border-slate-200 bg-white p-6 space-y-3">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <p class="text-xs text-slate-500">Nama</p>
            <p class="text-sm font-medium text-slate-900">{{ $message->name }}</p>
        </div>
        <div>
            <p class="text-xs text-slate-500">Email</p>
            <p class="text-sm font-medium text-slate-900">{{ $message->email }}</p>
        </div>
        @if($message->phone)
        <div>
            <p class="text-xs text-slate-500">Telepon</p>
            <p class="text-sm font-medium text-slate-900">{{ $message->phone }}</p>
        </div>
        @endif
        <div>
            <p class="text-xs text-slate-500">Waktu</p>
            <p class="text-sm font-medium text-slate-900">{{ $message->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>
    <div>
        <p class="text-xs text-slate-500">Subjek</p>
        <p class="text-sm font-medium text-slate-900">{{ $message->subject ?? '-' }}</p>
    </div>
    <div>
        <p class="text-xs text-slate-500">Pesan</p>
        <div class="text-sm text-slate-800 whitespace-pre-line">{{ $message->message }}</div>
    </div>
    <div class="flex justify-between items-center pt-4 border-t border-slate-100">
        <a href="{{ route('admin.contacts.index') }}" class="text-xs font-medium text-slate-600 hover:text-slate-800">← Kembali</a>
        <span class="text-[11px] text-slate-400">Status: {{ $message->is_read ? 'Dibaca' : 'Baru' }}</span>
    </div>
</div>
@endsection