@extends('layouts.admin')
@section('title', 'Products')
@section('page_title', 'Products')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-warm-400 text-sm">Manage your product catalog</p>
    <a href="{{ route('admin.products.create') }}" class="btn-primary text-sm">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Product
    </a>
</div>

<div class="card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-warm-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Product</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Brand</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Category</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Featured</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-warm-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-warm-100">
            @foreach($products as $product)
                <tr class="hover:bg-warm-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-brand-50 to-accent-50 flex items-center justify-center shrink-0">
                                <span class="font-display font-bold text-brand-400 text-xs">{{ substr($product->name, 0, 2) }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-warm-700">{{ $product->name }}</p>
                                <p class="text-xs text-warm-400">{{ $product->tagline }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $product->brand === 'Lenz Breeze' ? 'bg-brand-100 text-brand-700' : 'bg-warm-200 text-warm-700' }}">{{ $product->brand }}</span>
                    </td>
                    <td class="px-6 py-4 text-warm-500">{{ $product->category?->name ?? '—' }}</td>
                    <td class="px-6 py-4">
                        @if($product->is_featured)
                            <span class="text-accent-500">★</span>
                        @else
                            <span class="text-warm-300">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-warm-200 text-warm-500' }}">{{ $product->is_active ? 'Active' : 'Draft' }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="p-1.5 rounded-lg text-warm-400 hover:text-brand-500 hover:bg-brand-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.products.delete', $product) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                @csrf @method('DELETE')
                                <button class="p-1.5 rounded-lg text-warm-400 hover:text-red-500 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if($products->isEmpty())
        <div class="py-12 text-center text-warm-400">No products yet. <a href="{{ route('admin.products.create') }}" class="text-accent-600 hover:underline">Add your first product</a>.</div>
    @endif
</div>
@endsection
