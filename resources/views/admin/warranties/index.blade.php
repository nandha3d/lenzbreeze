@extends('layouts.admin')

@section('title', 'Warranty Management')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Warranty Management</h1>
    <a href="{{ route('admin.warranties.create') }}" class="btn-primary">Generate New Warranty</a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-warm-200">
    <div class="p-4 border-b border-warm-200 flex flex-col md:flex-row gap-4 justify-between">
        <form action="{{ route('admin.warranties') }}" method="GET" class="flex-1 max-w-md">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Serial or Customer..." 
                       class="w-full pl-10 pr-4 py-2 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 outline-none">
                <div class="absolute left-3 top-2.5 text-warm-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-warm-50 text-warm-600 text-sm uppercase">
                <tr>
                    <th class="px-6 py-4 font-semibold">Serial Number</th>
                    <th class="px-6 py-4 font-semibold">Customer</th>
                    <th class="px-6 py-4 font-semibold">Product</th>
                    <th class="px-6 py-4 font-semibold">Expiry</th>
                    <th class="px-6 py-4 font-semibold">Status</th>
                    <th class="px-6 py-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-warm-100">
                @forelse($warranties as $warranty)
                <tr class="hover:bg-warm-50/50 transition-colors">
                    <td class="px-6 py-4 font-mono text-sm font-bold text-accent-700">{{ $warranty->serial_number }}</td>
                    <td class="px-6 py-4 text-warm-700">{{ $warranty->customer_name }}</td>
                    <td class="px-6 py-4 text-warm-600">{{ $warranty->product_name }}</td>
                    <td class="px-6 py-4 text-sm {{ $warranty->expiry_date->isPast() ? 'text-red-500 font-bold' : 'text-warm-500' }}">
                        {{ $warranty->expiry_date->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium 
                            @if($warranty->status === 'active') bg-green-100 text-green-700 
                            @elseif($warranty->status === 'expired') bg-red-100 text-red-700 
                            @else bg-warm-100 text-warm-700 @endif">
                            {{ ucfirst($warranty->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <button onclick="showQR('{{ $warranty->serial_number }}', '{{ $warranty->getVerificationUrl() }}')" 
                                class="p-2 text-accent-600 hover:bg-accent-50 rounded-lg transition-colors" title="View QR Code">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 8h12m4 0h2M4 4h12m4 0h2M4 16h4m12 0h2M4 20h12m4 0h2"/></svg>
                        </button>
                        <a href="{{ route('admin.warranties.edit', $warranty) }}" class="p-2 text-warm-600 hover:bg-warm-100 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form action="{{ route('admin.warranties.delete', $warranty) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this warranty?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-warm-500">No warranties found. Generate one to get started!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($warranties->hasPages())
    <div class="px-6 py-4 border-t border-warm-200">
        {{ $warranties->links() }}
    </div>
    @endif
</div>

{{-- QR Modal --}}
<div id="qrModal" class="hidden fixed inset-0 z-[1001] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeQR()"></div>
    <div class="relative bg-white rounded-2xl p-8 max-w-sm w-full shadow-2xl text-center">
        <h3 class="text-xl font-bold mb-2">Product Warranty QR</h3>
        <p class="text-warm-500 text-sm mb-6" id="qrText"></p>
        
        <div id="qrcode" class="flex justify-center mb-6 bg-warm-50 p-4 rounded-xl border border-warm-200"></div>
        
        <div class="space-y-3">
            <button onclick="downloadQR()" class="w-full btn-primary !py-2.5">Download QR Code</button>
            <button onclick="closeQR()" class="w-full text-warm-600 hover:text-warm-900 font-medium py-2">Close</button>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    let qrcode = new QRCode(document.getElementById("qrcode"), {
        width: 256,
        height: 256,
        colorDark : "#003b3c",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });

    function showQR(serial, url) {
        document.getElementById('qrText').innerText = "Serial: " + serial;
        qrcode.clear();
        qrcode.makeCode(url);
        document.getElementById('qrModal').classList.remove('hidden');
    }

    function closeQR() {
        document.getElementById('qrModal').classList.add('hidden');
    }

    function downloadQR() {
        const img = document.querySelector("#qrcode img");
        const link = document.createElement("a");
        link.href = img.src;
        link.download = "warranty-qr-" + document.getElementById('qrText').innerText.split(': ')[1] + ".png";
        link.click();
    }
</script>
@endpush
@endsection
