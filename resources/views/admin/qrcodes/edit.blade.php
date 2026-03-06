@extends('layouts.admin')
@section('title', 'Edit QR Code')
@section('page_title', 'Edit QR Code')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.qrcodes.show', $qrCode) }}"
           class="p-2 text-warm-500 hover:bg-warm-100 rounded-lg transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-warm-800">Edit QR Code</h1>
            <p class="text-sm text-warm-400 mt-0.5">Modify the details — the preview updates live.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6" x-data="qrBuilder()" x-init="init()">

        {{-- Form --}}
        <div class="lg:col-span-3">
            <form id="qrForm" action="{{ route('admin.qrcodes.update', $qrCode) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="bg-white rounded-2xl border border-warm-200 shadow-sm p-6 sm:p-8 space-y-5">
                    {{-- Label --}}
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-warm-700">
                            Label <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="label" id="label"
                               placeholder="e.g. Product Warranty – EYE MEK UV420" required maxlength="255"
                               class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 outline-none transition-all text-sm"
                               x-model="label">
                        @error('label') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>

                    {{-- Content / URL --}}
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-warm-700">
                            URL / Content <span class="text-red-500">*</span>
                        </label>
                        <textarea name="content" id="content" rows="3" required maxlength="2048"
                                  placeholder="https://lenzbreeze.com/warranty?serial=LB-XXXXXXXX"
                                  class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 outline-none transition-all text-sm resize-none"
                                  x-model="content"></textarea>
                        @error('content') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>

                    {{-- Color + Size --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Foreground Color --}}
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-warm-700">Foreground Color</label>
                            <div class="flex items-center gap-3">
                                <input type="color" name="fg_color" id="fg_color"
                                       class="w-12 h-10 cursor-pointer rounded-lg border border-warm-300 p-1"
                                       x-model="fgColor">
                                <span class="text-sm text-warm-500 font-mono" x-text="fgColor"></span>
                            </div>
                            @error('fg_color') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>

                        {{-- Size --}}
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-warm-700">Output Size</label>
                            <select name="size" id="size"
                                    class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 outline-none transition-all text-sm"
                                    x-model="size">
                                <option value="256">256 × 256 px  (standard)</option>
                                <option value="512">512 × 512 px  (large)</option>
                                <option value="1024">1024 × 1024 px  (HD)</option>
                                <option value="2048">2048 × 2048 px  (2K / print)</option>
                            </select>
                            @error('size') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.qrcodes.show', $qrCode) }}" class="btn-secondary">Cancel</a>
                    <button type="submit" class="btn-primary min-w-[160px]">Update QR Code</button>
                </div>
            </form>
        </div>

        {{-- Live Preview --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-warm-200 shadow-sm p-6 sticky top-24">
                <p class="text-sm font-semibold text-warm-600 mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Live Preview
                </p>

                <div class="bg-warm-50 rounded-xl border border-warm-100 p-5 flex flex-col items-center gap-4">
                    <div id="liveQR" class="rounded-lg overflow-hidden"></div>

                    <div class="text-center">
                        <p class="font-semibold text-warm-800 text-sm break-all" x-text="label || 'Your label here'"></p>
                        <p class="text-warm-400 text-xs mt-0.5 break-all" x-text="content || 'Enter a URL or text above…'"></p>
                    </div>
                </div>

                <p class="text-xs text-warm-300 text-center mt-3">Scan with any camera app to test.</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
function qrBuilder() {
    return {
        label: @json(old('label', $qrCode->label)),
        content: @json(old('content', $qrCode->content)),
        fgColor: @json(old('fg_color', $qrCode->fg_color)),
        size: @json(old('size', (string)$qrCode->size)),
        qr: null,
        debounceTimer: null,

        init() {
            this.qr = new QRCode(document.getElementById('liveQR'), {
                text: this.content || ' ',
                width: 200,
                height: 200,
                colorDark: this.fgColor,
                colorLight: '#ffffff',
                correctLevel: QRCode.CorrectLevel.M,
            });
            this.$watch('content', () => this.refresh());
            this.$watch('fgColor', () => this.refresh());
        },

        refresh() {
            clearTimeout(this.debounceTimer);
            this.debounceTimer = setTimeout(() => {
                this.qr.clear();
                this.qr.makeCode(this.content || ' ');
                const el = document.getElementById('liveQR');
                el.innerHTML = '';
                this.qr = new QRCode(el, {
                    text: this.content || ' ',
                    width: 200,
                    height: 200,
                    colorDark: this.fgColor,
                    colorLight: '#ffffff',
                    correctLevel: QRCode.CorrectLevel.M,
                });
            }, 350);
        },
    };
}
</script>
@endpush
@endsection
