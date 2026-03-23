@extends('layouts.admin')

@section('title', 'Warranty Management')

@section('content')
{{-- Statistics Bar --}}
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl border border-warm-200 p-4">
        <p class="text-xs font-semibold uppercase tracking-wider text-warm-400">Active</p>
        <p class="text-2xl font-bold text-green-600 mt-1">{{ $stats['total_active'] }}</p>
    </div>
    <div class="bg-white rounded-xl border border-warm-200 p-4">
        <p class="text-xs font-semibold uppercase tracking-wider text-warm-400">Expiring (30d)</p>
        <p class="text-2xl font-bold text-amber-600 mt-1">{{ $stats['expiring_soon'] }}</p>
    </div>
    <div class="bg-white rounded-xl border border-warm-200 p-4">
        <p class="text-xs font-semibold uppercase tracking-wider text-warm-400">Open Claims</p>
        <p class="text-2xl font-bold text-blue-600 mt-1">{{ $stats['total_claims'] }}</p>
    </div>
    <div class="bg-white rounded-xl border border-warm-200 p-4">
        <p class="text-xs font-semibold uppercase tracking-wider text-warm-400">Resolved</p>
        <p class="text-2xl font-bold text-teal-600 mt-1">{{ $stats['resolved'] }}</p>
    </div>
</div>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <h1 class="text-2xl font-bold">Warranty Management</h1>
    <a href="{{ route('admin.warranties.create') }}" class="btn-primary">+ Register New Warranty</a>
</div>

{{-- Filters --}}
<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-warm-200">
    <form action="{{ route('admin.warranties') }}" method="GET" class="p-4 border-b border-warm-200">
        <div class="flex flex-col md:flex-row gap-3">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Serial, Name, or Phone..."
                       class="w-full pl-10 pr-4 py-2 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 outline-none"
                       style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke=%22%239ca3af%22 stroke-width=%222%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z%22/%3E%3C/svg%3E'); background-size: 20px; background-position: 10px center; background-repeat: no-repeat;">
            </div>
            <select name="status" onchange="this.form.submit()" class="px-3 py-2 rounded-lg border border-warm-300 text-sm focus:ring-2 focus:ring-accent-500 outline-none">
                <option value="all">All Status</option>
                @foreach(\App\Models\Warranty::STATUSES as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucwords(str_replace('_', ' ', $s)) }}</option>
                @endforeach
            </select>
            <select name="store_id" onchange="this.form.submit()" class="px-3 py-2 rounded-lg border border-warm-300 text-sm focus:ring-2 focus:ring-accent-500 outline-none">
                <option value="">All Retail Stores</option>
                @foreach($stores as $store)
                    <option value="{{ $store->id }}" {{ request('store_id') == $store->id ? 'selected' : '' }}>{{ $store->name }}</option>
                @endforeach
            </select>
            <input type="date" name="date_from" onchange="this.form.submit()" value="{{ request('date_from') }}" class="px-3 py-2 rounded-lg border border-warm-300 text-sm focus:ring-2 focus:ring-accent-500 outline-none" placeholder="From">
            <input type="date" name="date_to" onchange="this.form.submit()" value="{{ request('date_to') }}" class="px-3 py-2 rounded-lg border border-warm-300 text-sm focus:ring-2 focus:ring-accent-500 outline-none" placeholder="To">
            <button type="submit" class="btn-primary !py-2 !px-4 text-sm">Filter</button>
            @if(request()->hasAny(['search', 'status', 'store_id', 'date_from', 'date_to']))
                <a href="{{ route('admin.warranties') }}" class="text-warm-500 hover:text-warm-700 font-medium text-sm py-2">Clear</a>
            @endif
        </div>
    </form>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-warm-50 text-warm-600 text-xs uppercase">
                <tr>
                    <th class="px-6 py-3 font-semibold">Serial</th>
                    <th class="px-6 py-3 font-semibold">End User</th>
                    <th class="px-6 py-3 font-semibold">Retail Store</th>
                    <th class="px-6 py-3 font-semibold">Product</th>
                    <th class="px-6 py-3 font-semibold">Purchase</th>
                    <th class="px-6 py-3 font-semibold">Expiry</th>
                    <th class="px-6 py-3 font-semibold">Status</th>
                    <th class="px-6 py-3 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-warm-100">
                @forelse($warranties as $warranty)
                <tr class="hover:bg-warm-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.warranties.show', $warranty) }}" class="font-mono text-sm font-bold text-accent-700 hover:text-accent-900 hover:underline">
                            {{ $warranty->serial_number }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-warm-700 font-medium text-sm">{{ $warranty->customer_name }}</p>
                        @if($warranty->customer_phone)
                            <p class="text-warm-400 text-xs">{{ $warranty->customer_phone }}</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-warm-500">
                        @if($warranty->store && !empty($warranty->store->name))
                            {{ $warranty->store->name }}
                        @elseif(!empty($warranty->retailer_name))
                            {{ $warranty->retailer_name }}
                        @else
                            —
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-warm-600">{{ Str::limit($warranty->product_name, 30) }}</td>
                    <td class="px-6 py-4 text-sm text-warm-500">{{ $warranty->purchase_date->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-sm {{ $warranty->expiry_date->isPast() ? 'text-red-500 font-bold' : 'text-warm-500' }}">
                        {{ $warranty->expiry_date->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4">
                        @php $color = $warranty->status_color; @endphp
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium
                            {{ $color === 'green' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $color === 'red' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $color === 'amber' ? 'bg-amber-100 text-amber-700' : '' }}
                            {{ $color === 'blue' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $color === 'teal' ? 'bg-teal-100 text-teal-700' : '' }}
                            {{ $color === 'gray' ? 'bg-warm-100 text-warm-700' : '' }}">
                            {{ $warranty->status_label }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-1">
                            <button onclick="showQR('{{ $warranty->serial_number }}', '{{ $warranty->getVerificationUrl() }}')"
                                    class="p-2 text-accent-600 hover:bg-accent-50 rounded-lg transition-colors" title="View QR Code">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 8h12m4 0h2M4 4h12m4 0h2M4 16h4m12 0h2M4 20h12m4 0h2"/></svg>
                            </button>
                            <a href="{{ route('admin.warranties.show', $warranty) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="View Details">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            <a href="{{ route('admin.warranties.edit', $warranty) }}" class="p-2 text-warm-600 hover:bg-warm-100 rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center text-warm-500">No warranties found. <a href="{{ route('admin.warranties.create') }}" class="text-accent-600 hover:underline font-medium">Register one to get started!</a></td>
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
        width: 256, height: 256,
        colorDark : "#003b3c", colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
    function showQR(serial, url) {
        document.getElementById('qrText').innerText = "Serial: " + serial;
        qrcode.clear();
        qrcode.makeCode(url);
        document.getElementById('qrModal').classList.remove('hidden');
    }
    function closeQR() { document.getElementById('qrModal').classList.add('hidden'); }
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
