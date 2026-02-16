@extends('layouts.app')
@section('title', isset($category) ? $category->name . ' - Products - Lenz Breeze' : 'Products - Lenz Breeze')
@section('meta_description', 'Explore our range of premium optical lenses. Blue Cut, Anti-Glare, Photochromic, Progressive, and Polarized lenses by Lenz Breeze and EYE MEK.')

@section('content')
{{-- Page Hero --}}
<section class="gradient-brand py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 right-10 w-64 h-64 rounded-full bg-white/20 blur-3xl"></div>
    </div>
    <div class="container-custom relative z-10">
        <div class="max-w-2xl">
            <h1 class="font-display text-4xl md:text-5xl font-bold text-white">{{ isset($category) ? $category->name : 'Our Products' }}</h1>
            <p class="text-white/70 text-lg mt-4">{{ isset($category) ? $category->description : 'Discover our comprehensive range of premium optical lenses designed for every vision need.' }}</p>
        </div>
    </div>
</section>

{{-- Category Filter --}}
<section class="bg-white border-b border-warm-200/50 sticky top-18 z-30">
    <div class="container-custom">
        <div class="flex items-center gap-2 py-4 overflow-x-auto no-scrollbar">
            <a href="{{ route('products') }}" class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-colors {{ !isset($category) ? 'bg-brand-500 text-white' : 'bg-warm-100 text-warm-600 hover:bg-warm-200' }}">All Products</a>
            @foreach($categories as $cat)
                <a href="{{ route('products.category', $cat->slug) }}" class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-colors {{ isset($category) && $category->id === $cat->id ? 'bg-brand-500 text-white' : 'bg-warm-100 text-warm-600 hover:bg-warm-200' }}">{{ $cat->name }}</a>
            @endforeach
        </div>
    </div>
</section>

{{-- Products Grid --}}
<section class="section-padding bg-warm-50">
    <div class="container-custom">
        @if($products->isEmpty())
            <div class="text-center py-16">
                <p class="text-warm-400 text-lg">No products found in this category.</p>
                <a href="{{ route('products') }}" class="btn-primary mt-4">View All Products</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade-in-up">
                @foreach($products as $product)
                    <a href="{{ route('products.show', $product->slug) }}" class="card group shimmer-hover">
                        <div class="aspect-[4/3] bg-gradient-to-br from-brand-50 to-accent-50 flex items-center justify-center relative overflow-hidden">
                            <div class="text-7xl opacity-15 font-display font-bold text-brand-300">{{ substr($product->name, 0, 2) }}</div>
                            <div class="absolute top-3 left-3 flex gap-2">
                                <span class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold {{ $product->brand === 'Lenz Breeze' ? 'bg-brand-500 text-white' : 'bg-warm-800 text-white' }}">{{ $product->brand }}</span>
                                @if($product->is_featured)
                                    <span class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold bg-accent-500 text-white">Featured</span>
                                @endif
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="text-xs text-warm-400 font-medium uppercase tracking-wider">{{ $product->category?->name }}</div>
                            <h3 class="font-display font-bold text-lg text-brand-500 group-hover:text-accent-600 transition-colors mt-1">{{ $product->name }}</h3>
                            <p class="text-sm text-accent-600 font-medium">{{ $product->tagline }}</p>
                            <p class="text-sm text-warm-500 mt-2 line-clamp-2">{{ Str::limit($product->description, 120) }}</p>
                            <div class="flex flex-wrap gap-1.5 mt-3">
                                @if($product->technologies)
                                    @foreach(array_slice($product->technologies, 0, 3) as $tech)
                                        <span class="px-2 py-0.5 rounded-md bg-accent-50 text-accent-700 text-xs font-medium">{{ $tech }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <div class="mt-4 text-sm font-medium text-accent-600 flex items-center gap-1 group-hover:gap-2 transition-all">
                                View Details
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
