@extends('layouts.admin')
@section('title', 'Warranty — ' . $warranty->serial_number)
@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.warranties') }}" class="p-2 text-warm-500 hover:bg-warm-100 rounded-lg"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg></a>
        <h1 class="text-2xl font-bold">Warranty Details</h1>
        <span class="ml-auto font-mono text-accent-600 text-sm bg-accent-50 px-3 py-1 rounded-lg">{{ $warranty->serial_number }}</span>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-medium">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Info --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Customer Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-warm-200 p-6">
                <div class="flex items-start gap-5">
                    @if($warranty->customer_photo)
                        <img src="{{ $warranty->customer_photo_url }}" class="w-20 h-20 rounded-full object-cover border-3 border-warm-200 flex-shrink-0">
                    @else
                        <div class="w-20 h-20 rounded-full bg-accent-100 flex items-center justify-center text-accent-600 text-2xl font-bold flex-shrink-0">{{ strtoupper(substr($warranty->customer_name, 0, 1)) }}</div>
                    @endif
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-warm-800">{{ $warranty->customer_name }}</h2>
                        <div class="flex flex-wrap gap-x-6 gap-y-1 mt-2 text-sm text-warm-500">
                            @if($warranty->customer_phone)<span>📞 {{ $warranty->customer_phone }}</span>@endif
                            @if($warranty->customer_email)<span>✉️ {{ $warranty->customer_email }}</span>@endif
                        </div>
                        @if($warranty->customer_address)<p class="text-sm text-warm-400 mt-1">📍 {{ $warranty->customer_address }}</p>@endif
                    </div>
                    @php $color = $warranty->status_color; @endphp
                    <span class="px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider
                        {{ $color === 'green' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $color === 'red' ? 'bg-red-100 text-red-700' : '' }}
                        {{ $color === 'amber' ? 'bg-amber-100 text-amber-700' : '' }}
                        {{ $color === 'blue' ? 'bg-blue-100 text-blue-700' : '' }}
                        {{ $color === 'teal' ? 'bg-teal-100 text-teal-700' : '' }}
                        {{ $color === 'gray' ? 'bg-warm-100 text-warm-700' : '' }}">
                        {{ $warranty->status_label }}
                    </span>
                </div>
            </div>

            {{-- Eye Prescription --}}
            <div class="bg-white rounded-xl shadow-sm border border-warm-200 p-6">
                <h3 class="font-bold text-warm-800 mb-4">👁️ Eye Prescription</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-warm-50 text-warm-600 text-xs uppercase">
                            <tr><th class="px-4 py-3 text-left">Eye</th><th class="px-4 py-3 text-center">SPH</th><th class="px-4 py-3 text-center">CYL</th><th class="px-4 py-3 text-center">AXIS</th><th class="px-4 py-3 text-center">ADD</th></tr>
                        </thead>
                        <tbody class="divide-y divide-warm-100">
                            <tr>
                                <td class="px-4 py-3 font-semibold"><span class="w-5 h-5 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-700 text-xs font-bold mr-1">R</span> Right (OD)</td>
                                <td class="px-4 py-3 text-center font-mono">{{ $warranty->right_eye_sph ?? '—' }}</td>
                                <td class="px-4 py-3 text-center font-mono">{{ $warranty->right_eye_cyl ?? '—' }}</td>
                                <td class="px-4 py-3 text-center font-mono">{{ $warranty->right_eye_axis ?? '—' }}°</td>
                                <td class="px-4 py-3 text-center font-mono">{{ $warranty->right_eye_add ?? '—' }}</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 font-semibold"><span class="w-5 h-5 inline-flex items-center justify-center rounded-full bg-green-100 text-green-700 text-xs font-bold mr-1">L</span> Left (OS)</td>
                                <td class="px-4 py-3 text-center font-mono">{{ $warranty->left_eye_sph ?? '—' }}</td>
                                <td class="px-4 py-3 text-center font-mono">{{ $warranty->left_eye_cyl ?? '—' }}</td>
                                <td class="px-4 py-3 text-center font-mono">{{ $warranty->left_eye_axis ?? '—' }}°</td>
                                <td class="px-4 py-3 text-center font-mono">{{ $warranty->left_eye_add ?? '—' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if($warranty->pupillary_distance)
                    <p class="mt-3 text-sm text-warm-500">PD: <span class="font-mono font-bold text-warm-700">{{ $warranty->pupillary_distance }} mm</span></p>
                @endif
            </div>

            {{-- Claims --}}
            @if($warranty->isUnderClaim() || $warranty->claim_notes)
            <div class="bg-white rounded-xl shadow-sm border border-amber-200 p-6">
                <h3 class="font-bold text-warm-800 mb-3">📋 Claim Information</h3>
                @if($warranty->claim_date)<p class="text-sm text-warm-500 mb-2">Claim raised: <span class="font-semibold">{{ $warranty->claim_date->format('M d, Y') }}</span></p>@endif
                @if($warranty->claim_notes)<div class="p-3 bg-warm-50 rounded-lg text-sm text-warm-600">{{ $warranty->claim_notes }}</div>@endif
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Product & Lens --}}
            <div class="bg-white rounded-xl shadow-sm border border-warm-200 p-6">
                <h3 class="font-bold text-warm-800 mb-4">📦 Product & Lens</h3>
                <dl class="space-y-3 text-sm">
                    <div><dt class="text-warm-400 text-xs uppercase tracking-wider">Product</dt><dd class="font-semibold text-warm-700">{{ $warranty->product_name }}</dd></div>
                    @if($warranty->lens_type)<div><dt class="text-warm-400 text-xs uppercase tracking-wider">Lens Type</dt><dd class="text-warm-700">{{ $warranty->lens_type }}</dd></div>@endif
                    @if($warranty->lens_coating)<div><dt class="text-warm-400 text-xs uppercase tracking-wider">Coating</dt><dd class="text-warm-700">{{ $warranty->lens_coating }}</dd></div>@endif
                    @if($warranty->lens_index)<div><dt class="text-warm-400 text-xs uppercase tracking-wider">Index</dt><dd class="text-warm-700">{{ $warranty->lens_index }}</dd></div>@endif
                    @if($warranty->manufacturing_date)<div><dt class="text-warm-400 text-xs uppercase tracking-wider">Manufactured</dt><dd class="text-warm-700">{{ $warranty->manufacturing_date->format('M d, Y') }}</dd></div>@endif
                    @if($warranty->batch_number)<div><dt class="text-warm-400 text-xs uppercase tracking-wider">Batch</dt><dd class="font-mono text-warm-700">{{ $warranty->batch_number }}</dd></div>@endif
                </dl>
            </div>

            {{-- Warranty Info --}}
            <div class="bg-white rounded-xl shadow-sm border border-warm-200 p-6">
                <h3 class="font-bold text-warm-800 mb-4">🛡️ Warranty</h3>
                <dl class="space-y-3 text-sm">
                    <div><dt class="text-warm-400 text-xs uppercase tracking-wider">Purchase Date</dt><dd class="text-warm-700">{{ $warranty->purchase_date->format('M d, Y') }}</dd></div>
                    <div><dt class="text-warm-400 text-xs uppercase tracking-wider">Duration</dt><dd class="text-warm-700">{{ $warranty->warranty_months ?? 12 }} months</dd></div>
                    <div><dt class="text-warm-400 text-xs uppercase tracking-wider">Expires</dt><dd class="font-bold {{ $warranty->expiry_date->isPast() ? 'text-red-600' : 'text-green-600' }}">{{ $warranty->expiry_date->format('M d, Y') }}</dd></div>
                    @if($warranty->retailer)<div><dt class="text-warm-400 text-xs uppercase tracking-wider">Retailer</dt><dd class="text-warm-700">{{ $warranty->retailer->name }}<br><span class="text-xs text-warm-400">{{ $warranty->retailer->city }}, {{ $warranty->retailer->state }}</span></dd></div>@endif
                </dl>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col gap-2">
                <a href="{{ route('admin.warranties.edit', $warranty) }}" class="btn-primary text-center w-full">Edit Warranty</a>
                <a href="{{ $warranty->getVerificationUrl() }}" target="_blank" class="btn-secondary text-center w-full">View Public Card ↗</a>
                <form action="{{ route('admin.warranties.delete', $warranty) }}" method="POST" onsubmit="return confirm('Permanently delete this warranty?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-2.5 text-red-600 hover:bg-red-50 rounded-xl border border-red-200 font-medium text-sm transition-colors">Delete Warranty</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
