@extends('layouts.admin')
@section('title', $qrCode->label)
@section('page_title', 'QR Code Detail')

@section('content')
<div class="max-w-3xl mx-auto">

    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.qrcodes') }}"
           class="p-2 text-warm-500 hover:bg-warm-100 rounded-lg transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-bold text-warm-800 truncate">{{ $qrCode->label }}</h1>
            <p class="text-sm text-warm-400 mt-0.5 truncate">{{ $qrCode->content }}</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.qrcodes.edit', $qrCode) }}"
               class="flex items-center gap-2 px-4 py-2 bg-warm-100 text-warm-700 rounded-lg text-sm font-semibold hover:bg-warm-200 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- QR Display --}}
        <div class="bg-white rounded-2xl border border-warm-200 shadow-sm p-8 flex flex-col items-center gap-5">
            <div id="qrcode" class="rounded-xl overflow-hidden shadow-inner"></div>

            <div class="flex flex-col gap-3 w-full">
                <button onclick="downloadQR()"
                        class="btn-primary w-full flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download PNG
                </button>
                <button onclick="window.print()"
                        class="btn-secondary w-full flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    Print
                </button>
            </div>
        </div>

        {{-- Meta --}}
        <div class="space-y-4">
            <div class="bg-white rounded-2xl border border-warm-200 shadow-sm divide-y divide-warm-100">
                @php
                    $rows = [
                        ['label' => 'Label',   'value' => $qrCode->label],
                        ['label' => 'Content',  'value' => $qrCode->content],
                        ['label' => 'Color',    'value' => null, 'color' => $qrCode->fg_color],
                        ['label' => 'Size',     'value' => $qrCode->size . ' × ' . $qrCode->size . ' px'],
                        ['label' => 'Created',  'value' => $qrCode->created_at->format('M d, Y · g:i A')],
                        ['label' => 'Updated',  'value' => $qrCode->updated_at->diffForHumans()],
                    ];
                @endphp
                @foreach($rows as $row)
                <div class="flex items-start gap-3 px-5 py-3.5">
                    <span class="text-xs font-semibold text-warm-400 uppercase tracking-wide pt-0.5 w-20 shrink-0">{{ $row['label'] }}</span>
                    @if(isset($row['color']))
                        <span class="flex items-center gap-2 text-sm text-warm-700">
                            <span class="w-5 h-5 rounded-full border border-warm-200 shrink-0" style="background-color: {{ $row['color'] }}"></span>
                            <span class="font-mono">{{ $row['color'] }}</span>
                        </span>
                    @else
                        <span class="text-sm text-warm-700 break-all">{{ $row['value'] }}</span>
                    @endif
                </div>
                @endforeach
            </div>

            {{-- Danger zone --}}
            <div class="bg-white rounded-2xl border border-red-100 shadow-sm p-5">
                <p class="text-sm font-semibold text-red-600 mb-3">Danger Zone</p>
                <form action="{{ route('admin.qrcodes.destroy', $qrCode) }}" method="POST"
                      onsubmit="return confirm('Permanently delete this QR code?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-2.5 rounded-lg text-sm font-medium text-red-600 border border-red-200 hover:bg-red-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete QR Code
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Print styles --}}
<style>
@media print {
    header, aside, [class*="btn"], form { display: none !important; }
    body { background: white !important; }
    #qrcode { margin: auto; }
}
</style>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new QRCode(document.getElementById('qrcode'), {
        text: @json($qrCode->content),
        width: {{ $qrCode->size }},
        height: {{ $qrCode->size }},
        colorDark: @json($qrCode->fg_color),
        colorLight: '#ffffff',
        correctLevel: QRCode.CorrectLevel.H,
    });
});

function downloadQR() {
    const img = document.querySelector('#qrcode img');
    if (!img) return;
    const link = document.createElement('a');
    link.href = img.src;
    link.download = 'qr-{{ Str::slug($qrCode->label) }}.png';
    link.click();
}
</script>
@endpush
@endsection
