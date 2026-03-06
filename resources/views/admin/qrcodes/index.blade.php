@extends('layouts.admin')
@section('title', 'QR Codes')
@section('page_title', 'QR Code Manager')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <p class="text-warm-400 text-sm mt-0.5">Generate &amp; manage scannable QR codes for products, URLs, or any content.</p>
    </div>
    <a href="{{ route('admin.qrcodes.create') }}" class="btn-primary flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New QR Code
    </a>
</div>

{{-- Search --}}
<div class="mb-6">
    <form action="{{ route('admin.qrcodes') }}" method="GET" class="flex gap-3">
        <div class="relative flex-1 max-w-md">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search by label or content…"
                   class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 outline-none text-sm">
            <div class="absolute left-3 top-2.5 text-warm-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </div>
        <button type="submit" class="btn-secondary px-5">Search</button>
        @if(request('search'))
            <a href="{{ route('admin.qrcodes') }}" class="btn-secondary px-5">Clear</a>
        @endif
    </form>
</div>

@forelse($qrCodes as $qr)
{{-- Grid --}}
@if($loop->first)
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
@endif

<div class="bg-white rounded-2xl border border-warm-200 shadow-sm overflow-hidden hover:shadow-md transition-shadow group">
    {{-- QR Preview area --}}
    <div class="bg-warm-50 flex items-center justify-center p-6 border-b border-warm-100 relative">
        <div id="qr-{{ $qr->id }}" class="w-[128px] h-[128px]"></div>
        {{-- Hover overlay --}}
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors"></div>
    </div>

    {{-- Info --}}
    <div class="p-4">
        <p class="font-semibold text-warm-800 text-sm truncate" title="{{ $qr->label }}">{{ $qr->label }}</p>
        <p class="text-xs text-warm-400 truncate mt-0.5" title="{{ $qr->content }}">{{ $qr->content }}</p>

        <div class="flex items-center gap-2 mt-3">
            <span class="inline-flex items-center gap-1.5 text-xs text-warm-400">
                <span class="w-3 h-3 rounded-full border border-warm-200 shrink-0" style="background-color: {{ $qr->fg_color }}"></span>
                {{ $qr->size }}px
            </span>
            <span class="ml-auto text-xs text-warm-300">{{ $qr->created_at->format('M d, Y') }}</span>
        </div>

        <div class="flex gap-2 mt-4">
            <a href="{{ route('admin.qrcodes.show', $qr) }}"
               class="flex-1 text-center text-xs font-medium py-2 rounded-lg bg-accent-50 text-accent-700 hover:bg-accent-100 transition-colors">
                View
            </a>
            <a href="{{ route('admin.qrcodes.edit', $qr) }}"
               class="flex-1 text-center text-xs font-medium py-2 rounded-lg bg-warm-100 text-warm-700 hover:bg-warm-200 transition-colors">
                Edit
            </a>
            <form action="{{ route('admin.qrcodes.destroy', $qr) }}" method="POST"
                  onsubmit="return confirm('Delete this QR code?')">
                @csrf @method('DELETE')
                <button type="submit"
                        class="p-2 rounded-lg text-red-500 hover:bg-red-50 transition-colors" title="Delete">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </form>
        </div>
    </div>
</div>

@if($loop->last)
</div>
@endif

@empty
<div class="bg-white rounded-2xl border border-warm-200 p-16 text-center">
    <div class="w-20 h-20 rounded-2xl bg-warm-100 flex items-center justify-center mx-auto mb-4">
        <svg class="w-10 h-10 text-warm-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 8h12m4 0h2M4 4h12m4 0h2M4 16h4m12 0h2M4 20h12m4 0h2"/>
        </svg>
    </div>
    <p class="text-warm-500 font-medium">No QR codes yet.</p>
    <p class="text-warm-400 text-sm mt-1">Create your first QR code to get started.</p>
    <a href="{{ route('admin.qrcodes.create') }}" class="btn-primary inline-flex mt-5">Generate QR Code</a>
</div>
@endforelse

@if($qrCodes->hasPages())
<div class="mt-6">{{ $qrCodes->links() }}</div>
@endif

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    @foreach($qrCodes as $qr)
    new QRCode(document.getElementById('qr-{{ $qr->id }}'), {
        text: @json($qr->content),
        width: 128,
        height: 128,
        colorDark: @json($qr->fg_color),
        colorLight: '#ffffff',
        correctLevel: QRCode.CorrectLevel.M,
    });
    @endforeach
});
</script>
@endpush
@endsection
