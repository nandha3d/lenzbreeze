@extends('layouts.admin')
@section('title', isset($retailer) ? 'Edit Retailer' : 'Add Retailer')
@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.retailers') }}" class="p-2 text-warm-500 hover:bg-warm-100 rounded-lg"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg></a>
        <h1 class="text-2xl font-bold">{{ isset($retailer) ? 'Edit Retailer' : 'Add New Retailer' }}</h1>
        @if(isset($retailer))
            <span class="ml-auto font-mono text-accent-600 text-sm bg-accent-50 px-3 py-1 rounded-lg">{{ $retailer->retailer_code }}</span>
        @endif
    </div>
    <form action="{{ isset($retailer) ? route('admin.retailers.update', $retailer) : route('admin.retailers.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($retailer)) @method('PUT') @endif
        <div class="bg-white rounded-xl shadow-sm border border-warm-200 p-6 space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Shop / Retailer Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $retailer->name ?? '') }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Owner / Contact Name <span class="text-red-500">*</span></label>
                    <input type="text" name="owner_name" value="{{ old('owner_name', $retailer->owner_name ?? '') }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                    @error('owner_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Phone <span class="text-red-500">*</span></label>
                    <input type="tel" name="phone" value="{{ old('phone', $retailer->phone ?? '') }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">City <span class="text-red-500">*</span></label>
                    <input type="text" name="city" value="{{ old('city', $retailer->city ?? '') }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                    @error('city') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">State <span class="text-red-500">*</span></label>
                    <input type="text" name="state" value="{{ old('state', $retailer->state ?? '') }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                    @error('state') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Active</label>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $retailer->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded border-warm-300 text-accent-600 focus:ring-accent-500">
                        <span class="text-sm text-warm-600">Retailer is active and can be assigned warranties</span>
                    </label>
                </div>
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-warm-700">Address <span class="text-red-500">*</span></label>
                <textarea name="address" rows="2" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">{{ old('address', $retailer->address ?? '') }}</textarea>
                @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.retailers') }}" class="btn-secondary">Cancel</a>
            <button type="submit" class="btn-primary min-w-[150px]">{{ isset($retailer) ? 'Update Retailer' : 'Add Retailer' }}</button>
        </div>
    </form>
</div>
@endsection
