@extends('layouts.app')
@section('title', isset($category) ? $category->name . ' - Products - Lenz Breeze' : 'Products - Lenz Breeze')
@section('meta_description', 'Explore our range of premium optical lenses. Blue Cut, Anti-Glare, Photochromic, Progressive, and Polarized lenses by Lenz Breeze and EYE MEK.')

@section('content')
{{-- Page Hero --}}
<section class="gradient-brand py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 right-10 w-64 h-64 rounded-full bg-white/20 blur-3xl"></div>
        <div class="absolute bottom-0 left-1/4 w-80 h-80 rounded-full bg-white/10 blur-3xl"></div>
    </div>
    {{-- Floating lens rings --}}
    <div class="absolute top-8 right-32 w-20 h-20 rounded-full border border-white/20 animate-lens-float" style="animation-delay: 0s;"></div>
    <div class="absolute top-16 right-48 w-10 h-10 rounded-full border border-white/15 animate-lens-float" style="animation-delay: 0.8s;"></div>
    <div class="absolute bottom-8 right-20 w-14 h-14 rounded-full border border-white/10 animate-lens-float" style="animation-delay: 1.5s;"></div>
    <div class="container-custom relative z-10">
        <div class="max-w-2xl">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/15 backdrop-blur-sm text-white/80 text-xs font-bold uppercase tracking-widest mb-4">
                <span class="w-1.5 h-1.5 rounded-full bg-accent-300 animate-pulse"></span>
                EYE MEK Premium Lenses
            </div>
            <h1 class="font-display text-4xl md:text-5xl font-black text-white leading-tight">{{ isset($category) ? $category->name : 'Our Products' }}</h1>
            <p class="text-white/70 text-lg mt-4 leading-relaxed">{{ isset($category) ? $category->description : 'Discover our comprehensive range of premium optical lenses designed for every vision need.' }}</p>
            @if(!isset($category))
                <p class="text-white/50 text-sm mt-3 font-semibold">{{ $products->count() }} Premium Lens Collections Available</p>
            @endif
        </div>
    </div>
</section>

{{-- Category Filter --}}
<section class="bg-white border-b border-warm-200/50 sticky top-18 z-30">
    <div class="container-custom">
        <div class="flex items-center gap-2 py-4 overflow-x-auto no-scrollbar">
            <a href="{{ route('products') }}"
                class="px-4 py-2 rounded-full text-sm font-bold whitespace-nowrap transition-all duration-200 {{ !isset($category) ? 'bg-brand-500 text-white shadow-md' : 'bg-warm-100 text-warm-600 hover:bg-warm-200 hover:scale-105' }}">
                All Products
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('products.category', $cat->slug) }}"
                    class="px-4 py-2 rounded-full text-sm font-bold whitespace-nowrap transition-all duration-200 {{ isset($category) && $category->id === $cat->id ? 'bg-brand-500 text-white shadow-md' : 'bg-warm-100 text-warm-600 hover:bg-warm-200 hover:scale-105' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Products Grid --}}
<section class="section-padding bg-warm-50">
    <div class="container-custom">
        @if($products->isEmpty())
            <div class="text-center py-16">
                <div class="w-20 h-20 rounded-full bg-warm-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-warm-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-warm-400 text-lg font-medium">No products found in this category.</p>
                <a href="{{ route('products') }}" class="btn-primary mt-6">View All Products</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 animate-fade-in-up">
                @foreach($products as $product)
                    @php
                        $variantCount = count($product->specifications['variants'] ?? []);
                        $lifestyleTags = [
                            'single-vision-rx' => ['Everyday Use', 'Digital Work', 'Driving'],
                            'premium-progressive-rx' => ['Multi-Distance', 'Driving', 'Professionals'],
                            'kryptok-bifocals' => ['Reading', 'Near + Far Vision', 'High Rx'],
                            'drive-ease' => ['Reading', 'Wide View', 'First-time BF'],
                            'd-bifocal-lens' => ['Reading', 'Wide View', 'First-time BF'],
                        ];
                        $tags = $lifestyleTags[$product->slug] ?? [];
                    @endphp
                    <a href="{{ route('products.show', $product->slug) }}" class="card group shimmer-hover flex flex-col h-full border border-warm-200/50">
                        {{-- Image Area --}}
                        <div class="aspect-[4/3] bg-gradient-to-br from-brand-50 to-accent-50 flex items-center justify-center relative overflow-hidden shrink-0">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain p-4 transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div class="text-7xl opacity-15 font-display font-bold text-brand-300 transition-transform duration-500 group-hover:scale-110">{{ substr($product->name, 0, 2) }}</div>
                            @endif

                            {{-- Top badges --}}
                            <div class="absolute top-3 left-3 flex gap-2">
                                <span class="inline-block px-2.5 py-1 rounded-full text-xs font-bold shadow {{ $product->brand === 'Lenz Breeze' ? 'bg-brand-500 text-white' : 'bg-warm-900 text-white' }}">{{ $product->brand }}</span>
                                @if($product->is_featured)
                                    <span class="inline-block px-2.5 py-1 rounded-full text-xs font-bold bg-accent-500 text-white shadow">⭐ Premium</span>
                                @endif
                            </div>

                            {{-- Variant count badge --}}
                            @if($variantCount > 0)
                                <span class="variant-count-badge">{{ $variantCount }} Variants</span>
                            @endif

                            {{-- Hover overlay --}}
                            <div class="absolute inset-0 bg-brand-500/0 group-hover:bg-brand-500/5 transition-colors duration-300"></div>
                        </div>

                        {{-- Content --}}
                        <div class="p-6 flex flex-col flex-1">
                            <div class="text-xs text-warm-400 font-bold uppercase tracking-widest mb-1.5">{{ $product->category?->name }}</div>
                            <h3 class="font-display font-black text-xl text-brand-500 group-hover:text-accent-600 transition-colors mb-1.5 leading-tight">{{ $product->name }}</h3>
                            <p class="text-sm text-accent-700 font-semibold mb-3 italic">{{ $product->tagline }}</p>
                            <div class="text-sm text-warm-500 line-clamp-2 mb-4 leading-relaxed flex-1">
                                {!! Str::limit(strip_tags($product->description), 110) !!}
                            </div>

                            {{-- Technology tags --}}
                            @if($product->technologies)
                                <div class="flex flex-wrap gap-1.5 mb-3">
                                    @foreach(array_slice($product->technologies, 0, 3) as $tech)
                                        <span class="px-2 py-0.5 rounded-md bg-accent-50 text-accent-700 text-[10px] font-black uppercase tracking-tighter border border-accent-100">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Best For lifestyle tags --}}
                            @if(!empty($tags))
                                <div class="flex flex-wrap gap-1.5 mb-4">
                                    @foreach($tags as $tag)
                                        <span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-brand-50 text-brand-600 border border-brand-100">
                                            <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Footer --}}
                            <div class="mt-auto pt-4 border-t border-warm-100 flex items-center justify-between">
                                <span class="text-sm font-black text-accent-600 group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                                    Explore Details
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </span>
                                @if($variantCount > 0)
                                    <span class="text-xs text-warm-400 font-semibold">{{ $variantCount }} options</span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection