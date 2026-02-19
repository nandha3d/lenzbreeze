@extends('layouts.admin')

@section('title', isset($warranty) ? 'Edit Warranty' : 'Generate Warranty')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.warranties') }}" class="p-2 text-warm-500 hover:bg-warm-100 rounded-lg transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <h1 class="text-2xl font-bold">{{ isset($warranty) ? 'Edit Warranty' : 'Generate New Warranty' }}</h1>
    </div>

    <form action="{{ isset($warranty) ? route('admin.warranties.update', $warranty) : route('admin.warranties.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($warranty)) @method('PUT') @endif

        <div class="bg-white rounded-xl shadow-sm border border-warm-200 p-6 sm:p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Product Name --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Product Name <span class="text-red-500">*</span></label>
                    <input type="text" name="product_name" value="{{ old('product_name', $warranty->product_name ?? '') }}" 
                           placeholder="e.g. EYE MEK Polarized Single Vision" required
                           class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 outline-none transition-all">
                    @error('product_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Customer Name --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Customer Name <span class="text-red-500">*</span></label>
                    <input type="text" name="customer_name" value="{{ old('customer_name', $warranty->customer_name ?? '') }}" 
                           placeholder="Full Name" required
                           class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 outline-none transition-all">
                    @error('customer_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Retailer --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Retailer / Lab Name</label>
                    <input type="text" name="retailer_name" value="{{ old('retailer_name', $warranty->retailer_name ?? '') }}" 
                           placeholder="Store location or partner name"
                           class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 outline-none transition-all">
                </div>

                {{-- Status --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 outline-none transition-all">
                        <option value="active" {{ old('status', $warranty->status ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="expired" {{ old('status', $warranty->status ?? '') === 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="void" {{ old('status', $warranty->status ?? '') === 'void' ? 'selected' : '' }}>Void / Canceled</option>
                    </select>
                </div>

                {{-- Purchase Date --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Purchase Date <span class="text-red-500">*</span></label>
                    <input type="date" name="purchase_date" value="{{ old('purchase_date', isset($warranty) ? $warranty->purchase_date->format('Y-m-d') : date('Y-m-d')) }}" 
                           required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 outline-none transition-all">
                </div>

                {{-- Expiry Date --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Expiry Date <span class="text-red-500">*</span></label>
                    <input type="date" name="expiry_date" value="{{ old('expiry_date', isset($warranty) ? $warranty->expiry_date->format('Y-m-d') : date('Y-m-d', strtotime('+1 year'))) }}" 
                           required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 outline-none transition-all">
                    @error('expiry_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Notes --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-warm-700">Additional Notes</label>
                <textarea name="notes" rows="3" placeholder="Batch number, special terms, etc." 
                          class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 outline-none transition-all">{{ old('notes', $warranty->notes ?? '') }}</textarea>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.warranties') }}" class="btn-secondary">Cancel</a>
            <button type="submit" class="btn-primary min-w-[150px]">
                {{ isset($warranty) ? 'Update Warranty' : 'Generate & Save' }}
            </button>
        </div>
    </form>
</div>
@endsection
