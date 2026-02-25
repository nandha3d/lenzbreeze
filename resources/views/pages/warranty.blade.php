@extends('layouts.app')

@section('title', 'Product Warranty Verification')

@section('content')
<div class="min-h-[70vh] py-20 bg-warm-50">
    <div class="container-custom max-w-2xl">
        {{-- Header Section --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-display font-bold text-warm-800 mb-4">Warranty Verification</h1>
            <p class="text-warm-500">Scan your QR code or enter your serial number below to verify your product's authenticity and warranty status.</p>
        </div>

        {{-- Verification Box --}}
        <div class="bg-white rounded-3xl shadow-xl shadow-warm-200/50 border border-warm-200 overflow-hidden">
            <div class="p-8 md:p-12">
                <form action="{{ route('warranty') }}" method="GET" class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-warm-700 mb-2">Serial Number</label>
                        <div class="relative">
                            <input type="text" name="serial" value="{{ request('serial') }}" 
                                   placeholder="e.g. LB-XXXXXXXX" required
                                   class="w-full pl-12 pr-4 py-4 rounded-2xl border-2 border-warm-100 focus:border-accent-500 focus:ring-4 focus:ring-accent-500/10 outline-none transition-all font-mono text-lg uppercase tracking-wider">
                            <div class="absolute left-4 top-4.5 text-accent-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 8h12m4 0h2M4 4h12m4 0h2M4 16h4m12 0h2M4 20h12m4 0h2"/></svg>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full btn-primary !py-4 text-lg shadow-lg shadow-accent-500/20">Check Warranty Status</button>
                </form>

                @if(session('error'))
                    <div class="mt-6 p-4 bg-red-50 border border-red-100 rounded-2xl flex items-center gap-3 text-red-700 animate-shake">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                @endif
            </div>

            {{-- Result Area --}}
            @if(isset($warranty))
                <div class="bg-warm-50 border-t border-warm-200 p-8 md:p-12 animate-fade-in">
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        {{-- Status Badge --}}
                        <div class="flex-shrink-0 text-center">
                            @if($warranty->isValid())
                                <div class="w-24 h-24 rounded-full bg-green-100 flex items-center justify-center text-green-600 mb-3 mx-auto">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                                <span class="bg-green-600 text-white text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full">Validated</span>
                            @else
                                <div class="w-24 h-24 rounded-full bg-red-100 flex items-center justify-center text-red-600 mb-3 mx-auto">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <span class="bg-red-600 text-white text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full text-center">{{ ucfirst($warranty->status) }}</span>
                            @endif
                        </div>

                        {{-- Info Grid --}}
                        <div class="flex-1 grid grid-cols-2 gap-y-6 gap-x-4">
                            <div class="col-span-2">
                                <p class="text-[10px] uppercase tracking-wider text-warm-400 font-bold mb-1">Product</p>
                                <h3 class="text-xl font-bold text-warm-800">{{ $warranty->product_name }}</h3>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-wider text-warm-400 font-bold mb-1">Customer</p>
                                <p class="font-semibold text-warm-700">{{ $warranty->customer_name }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-wider text-warm-400 font-bold mb-1">Serial Number</p>
                                <p class="font-mono font-bold text-accent-700">{{ $warranty->serial_number }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-wider text-warm-400 font-bold mb-1">Purchase Date</p>
                                <p class="text-warm-600">{{ $warranty->purchase_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-wider text-warm-400 font-bold mb-1">Expiry Date</p>
                                <p class="font-semibold {{ $warranty->expiry_date->isPast() ? 'text-red-500' : 'text-green-600' }}">
                                    {{ $warranty->expiry_date->format('M d, Y') }}
                                </p>
                            </div>
                            @if($warranty->retailer_name)
                                <div class="col-span-2">
                                    <p class="text-[10px] uppercase tracking-wider text-warm-400 font-bold mb-1">Retailer</p>
                                    <p class="text-warm-600">{{ $warranty->retailer_name }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Help Text --}}
        <div class="mt-8 text-center text-warm-400 text-sm">
            <p>Having trouble? Contact our support at <a href="mailto:support@lenzbreeze.com" class="text-accent-600 font-semibold hover:underline">support@lenzbreeze.com</a></p>
        </div>
    </div>
</div>

@endsection
