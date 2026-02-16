@extends('layouts.admin')
@section('title', isset($product) ? 'Edit Product' : 'Add Product')
@section('page_title', isset($product) ? 'Edit: ' . $product->name : 'Add New Product')

@section('content')
<div class="max-w-3xl">
    <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($product)) @method('PUT') @endif

        <div class="card p-6 space-y-5">
            <h2 class="font-display font-semibold text-warm-700 border-b border-warm-100 pb-3">Basic Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-warm-700 mb-1.5">Product Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none transition-all" required>
                    @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-warm-700 mb-1.5">Tagline</label>
                    <input type="text" name="tagline" value="{{ old('tagline', $product->tagline ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none transition-all" placeholder="Short product tagline">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-warm-700 mb-1.5">Description</label>
                <textarea name="description" rows="4" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none transition-all resize-none">{{ old('description', $product->description ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-warm-700 mb-1.5">Brand <span class="text-red-500">*</span></label>
                    <select name="brand" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none transition-all bg-white" required>
                        <option value="Lenz Breeze" {{ old('brand', $product->brand ?? '') === 'Lenz Breeze' ? 'selected' : '' }}>Lenz Breeze</option>
                        <option value="EYE MEK" {{ old('brand', $product->brand ?? '') === 'EYE MEK' ? 'selected' : '' }}>EYE MEK</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-warm-700 mb-1.5">Category</label>
                    <select name="category_id" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none transition-all bg-white">
                        <option value="">— Select Category —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="card p-6 space-y-5">
            <h2 class="font-display font-semibold text-warm-700 border-b border-warm-100 pb-3">Details</h2>

            <div>
                <label class="block text-sm font-medium text-warm-700 mb-1.5">Technologies (comma-separated)</label>
                <input type="text" name="technologies" value="{{ old('technologies', isset($product) && $product->technologies ? implode(', ', $product->technologies) : '') }}" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none transition-all" placeholder="Blue Cut, Anti-Glare, Photochromic">
            </div>

            <div>
                <label class="block text-sm font-medium text-warm-700 mb-1.5">Features (one per line)</label>
                <textarea name="features" rows="4" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none transition-all resize-none" placeholder="One feature per line">{{ old('features', isset($product) && $product->features ? implode("\n", $product->features) : '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-warm-700 mb-1.5">Specifications (key:value, one per line)</label>
                <textarea name="specifications" rows="4" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none transition-all resize-none" placeholder="Material: CR-39&#10;Index: 1.56">{{ old('specifications', isset($product) && $product->specifications ? collect($product->specifications)->map(fn($v, $k) => "$k: $v")->implode("\n") : '') }}</textarea>
            </div>
        </div>

        <div class="card p-6 space-y-5">
            <h2 class="font-display font-semibold text-warm-700 border-b border-warm-100 pb-3">Settings</h2>
            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }} class="rounded border-warm-300 text-accent-500 focus:ring-accent-500">
                    <span class="text-sm text-warm-700">Featured Product</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }} class="rounded border-warm-300 text-green-500 focus:ring-green-500">
                    <span class="text-sm text-warm-700">Active (Published)</span>
                </label>
            </div>
        </div>

        <div class="card p-6 space-y-5">
            <h2 class="font-display font-semibold text-warm-700 border-b border-warm-100 pb-3">SEO</h2>
            <div>
                <label class="block text-sm font-medium text-warm-700 mb-1.5">Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $product->meta_title ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-warm-700 mb-1.5">Meta Description</label>
                <textarea name="meta_description" rows="2" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none transition-all resize-none">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary">{{ isset($product) ? 'Update Product' : 'Create Product' }}</button>
            <a href="{{ route('admin.products') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
