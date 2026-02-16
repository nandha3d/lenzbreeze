@extends('layouts.app')
@section('title', $product->meta_title ?? $product->name . ' - Lenz Breeze')
@section('meta_description', $product->meta_description ?? Str::limit($product->description, 160))

@section('content')
{{-- Breadcrumb --}}
<div class="bg-white border-b border-warm-200/50">
    <div class="container-custom py-4">
        <nav class="flex items-center gap-2 text-sm text-warm-400">
            <a href="{{ route('home') }}" class="hover:text-brand-500 transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('products') }}" class="hover:text-brand-500 transition-colors">Products</a>
            @if($product->category)
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('products.category', $product->category->slug) }}" class="hover:text-brand-500 transition-colors">{{ $product->category->name }}</a>
            @endif
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-brand-500 font-medium">{{ $product->name }}</span>
        </nav>
    </div>
</div>

{{-- Product Detail --}}
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- Product Image --}}
            <div>
                <div class="aspect-square rounded-2xl bg-gradient-to-br from-brand-50 to-accent-50 flex items-center justify-center relative overflow-hidden">
                    <div class="text-[120px] opacity-10 font-display font-bold text-brand-300">{{ substr($product->name, 0, 2) }}</div>
                    <div class="absolute top-4 left-4 flex gap-2">
                        <span class="px-3 py-1.5 rounded-full text-sm font-semibold {{ $product->brand === 'Lenz Breeze' ? 'bg-brand-500 text-white' : 'bg-warm-800 text-white' }}">{{ $product->brand }}</span>
                    </div>
                </div>
            </div>

            {{-- Product Info --}}
            <div>
                <div class="text-xs text-warm-400 font-medium uppercase tracking-wider">{{ $product->category?->name }}</div>
                <h1 class="font-display text-3xl md:text-4xl font-bold text-brand-500 mt-2">{{ $product->name }}</h1>
                <p class="text-lg text-accent-600 font-medium mt-1">{{ $product->tagline }}</p>
                <p class="text-warm-600 mt-6 leading-relaxed">{{ $product->description }}</p>

                {{-- Technologies --}}
                @if($product->technologies)
                    <div class="mt-6">
                        <h3 class="font-semibold text-warm-700 text-sm uppercase tracking-wider mb-2">Technologies</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($product->technologies as $tech)
                                <span class="px-3 py-1.5 rounded-lg bg-accent-50 text-accent-700 text-sm font-medium">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- CTA --}}
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('contact') }}" class="btn-primary">
                        Inquire About This Product
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    @if($product->brochure_pdf)
                        <a href="{{ asset('storage/' . $product->brochure_pdf) }}" class="btn-secondary" download>
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download Brochure
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Features & Specifications --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-16" data-animate>
            @if($product->features)
                <div class="card p-8">
                    <h2 class="font-display text-xl font-bold text-brand-500 mb-5">Key Features</h2>
                    <ul class="space-y-3">
                        @foreach($product->features as $feature)
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-accent-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-warm-600">{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($product->specifications)
                <div class="card p-8">
                    <h2 class="font-display text-xl font-bold text-brand-500 mb-5">Specifications</h2>
                    <div class="space-y-3">
                        @foreach($product->specifications as $key => $value)
                            <div class="flex justify-between items-center py-2 border-b border-warm-100 last:border-0">
                                <span class="text-warm-500 text-sm font-medium">{{ $key }}</span>
                                <span class="text-warm-700 text-sm font-semibold">{{ $value }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- Related Products --}}
@if($relatedProducts->isNotEmpty())
<section class="section-padding bg-warm-50" data-animate>
    <div class="container-custom">
        <h2 class="section-title mb-8">Related Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @foreach($relatedProducts as $related)
                <a href="{{ route('products.show', $related->slug) }}" class="card group">
                    <div class="aspect-[4/3] bg-gradient-to-br from-brand-50 to-accent-50 flex items-center justify-center relative">
                        <div class="text-6xl opacity-15 font-display font-bold text-brand-300">{{ substr($related->name, 0, 2) }}</div>
                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-xs font-semibold {{ $related->brand === 'Lenz Breeze' ? 'bg-brand-500 text-white' : 'bg-warm-800 text-white' }}">{{ $related->brand }}</span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-display font-bold text-brand-500 group-hover:text-accent-600 transition-colors">{{ $related->name }}</h3>
                        <p class="text-sm text-warm-400 mt-0.5">{{ $related->tagline }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
