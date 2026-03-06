@extends('layouts.app')
@section('title', isset($category) ? $category->name . ' - Products - EYE MEK' : 'Products - EYE MEK')
@section('meta_description', 'Explore our range of premium optical lenses. Blue Cut, Anti-Glare, Photochromic, Progressive, and Polarized lenses by EYE MEK.')

@section('content')
<div class="theme-product">
{{-- Page Hero --}}
{{-- Hero Slider --}}
<section x-data="{ 
    activeSlide: 1, 
    totalSlides: 3, 
    interval: null,
    leaving: false,
    nextSlide() {
        if (this.leaving) return;
        this.leaving = true;
        setTimeout(() => {
            this.activeSlide = this.activeSlide === this.totalSlides ? 1 : this.activeSlide + 1;
            this.leaving = false;
        }, 700);
    },
    startAutoScroll() {
        this.interval = setInterval(() => this.nextSlide(), 8000);
    },
    stopAutoScroll() {
        clearInterval(this.interval);
    }
}" x-init="startAutoScroll()" @mouseenter="stopAutoScroll()" @mouseleave="startAutoScroll()"
class="relative h-[70vh] min-h-[600px] overflow-hidden bg-brand-950 group">
    
    {{-- Slide 1: Premium Progressive (Drive X) --}}
    <div x-show="activeSlide === 1" 
         :class="{'active-slide': activeSlide === 1, 'leaving-slide': leaving && activeSlide === 1}"
         class="absolute inset-0 z-10 transition-opacity duration-1000">
        {{-- Stripe Transition Background --}}
        <div class="stripe-container absolute inset-0">
            @for($i=0; $i<5; $i++)
            <div class="stripe-item" style="background-image: url('{{ asset('images/progressive-lens1.jpeg') }}');"></div>
            @endfor
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-brand-950 via-brand-950/40 to-transparent z-[11]"></div>
        
        <div class="scifi-scan-line"></div>
        <div class="absolute inset-0 hud-grid-bg opacity-10"></div>

        <div class="container-custom relative h-full flex items-center z-20">
            <div class="max-w-2xl text-white relative">
                <div class="absolute -top-10 -left-10 w-20 h-20 border-t-2 border-l-2 border-logo-yellow/30"></div>
                <h2 class="inline-block px-4 py-1.5 rounded-sm bg-logo-yellow/10 border-l-4 border-logo-yellow text-logo-yellow text-[10px] font-black uppercase tracking-[0.3em] mb-8 animate-slide-up">
                    EYE MEK PROGRESSIVE SERIES
                </h2>
                <div class="space-y-6">
                    <h1 class="font-display text-4xl md:text-6xl font-black leading-[1.1] animate-slide-up" style="animation-delay: 0.2s">
                        Master Every Distance. <br/> Conquer Every Drive.
                    </h1>
                    <p class="text-xl md:text-2xl font-bold text-warm-100/90 leading-tight animate-slide-up" style="animation-delay: 0.4s">
                        Introducing EYE MEK Progressive—engineered for those who never slow down.
                    </p>
                    <div class="pt-4 animate-slide-up" style="animation-delay: 0.6s">
                        <a href="{{ route('products.show', 'premium-progressive-rx') }}" class="btn-primary">Explore Details</a>
                        <span class="ml-6 text-logo-yellow font-black uppercase tracking-[0.2em] text-xs">Drive X Technology</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Slide 2: Single Vision (Precision) --}}
    <div x-show="activeSlide === 2" 
         :class="{'active-slide': activeSlide === 2, 'leaving-slide': leaving && activeSlide === 2}"
         class="absolute inset-0 z-10 transition-opacity duration-1000" style="display: none;">
        {{-- Stripe Transition Background --}}
        <div class="stripe-container absolute inset-0">
            @for($i=0; $i<5; $i++)
            <div class="stripe-item" style="background-image: url('{{ asset('images/single-vision-banner1.jpeg') }}');"></div>
            @endfor
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-brand-950 via-brand-950/40 to-transparent z-[11]"></div>
        
        <div class="scifi-scan-line"></div>
        <div class="absolute inset-0 hud-grid-bg opacity-10"></div>

        <div class="container-custom relative h-full flex items-center z-20">
            <div class="max-w-2xl text-white relative">
                <div class="absolute -top-10 -left-10 w-20 h-20 border-t-2 border-l-2 border-logo-yellow/30"></div>
                <h2 class="inline-block px-4 py-1.5 rounded-sm bg-logo-yellow/10 border-l-4 border-logo-yellow text-logo-yellow text-[10px] font-black uppercase tracking-[0.3em] mb-8">
                    EYE MEK SV Collection
                </h2>
                <div class="space-y-6">
                    <h1 class="font-display text-4xl md:text-6xl font-black leading-[1.1]">
                        Precision in every pulse.
                    </h1>
                    <p class="text-xl md:text-2xl font-bold text-warm-100/90 leading-tight">
                        Where advanced HD Digital technology meets premium protection.
                    </p>
                    <div class="pt-4">
                        <a href="{{ route('products.show', 'single-vision-rx') }}" class="btn-primary">Explore Details</a>
                        <span class="ml-6 text-logo-yellow font-black uppercase tracking-[0.2em] text-xs">HD Digital Clarity</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Slide 3: D-Bifocal (HUD Precision) --}}
    <div x-show="activeSlide === 3" 
         :class="{'active-slide': activeSlide === 3, 'leaving-slide': leaving && activeSlide === 3}"
         class="absolute inset-0 z-10 transition-opacity duration-1000" style="display: none;">
        <div class="stripe-container absolute inset-0">
            @for($i=0; $i<5; $i++)
            <div class="stripe-item" style="background-image: url('{{ asset('images/bifocal-lens.jpeg') }}');"></div>
            @endfor
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-brand-950 via-brand-950/20 to-transparent z-[11]"></div>
        
        <div class="scifi-scan-line"></div>
        <div class="absolute inset-0 hud-grid-bg opacity-10"></div>

        <div class="container-custom relative h-full flex items-center z-20">
            <div class="max-w-2xl text-white relative group">
                <div class="absolute -top-10 -left-10 w-20 h-20 border-t-2 border-l-2 border-logo-yellow/30"></div>
                <h2 class="inline-block px-4 py-1.5 rounded-sm bg-logo-yellow/10 border-l-4 border-logo-yellow text-logo-yellow text-[10px] font-black uppercase tracking-[0.3em] mb-8">
                    ADVANCED // DBF_FLAT_TOP
                </h2>
                <div class="space-y-6">
                    <h1 class="font-display text-4xl md:text-6xl font-black leading-[1.1]">
                        D-Bifocal. <br/> (DBF) Precision.
                    </h1>
                    <p class="text-lg text-warm-200 leading-relaxed max-w-xl">
                        Tired of narrow reading zones? Step into the wide-angle view of EYE MEK DBF. The classic bifocal, perfected by EYE MEK.
                    </p>
                    <div class="pt-4">
                        <a href="{{ route('products.show', 'd-bifocal-lens') }}" class="btn-primary">Explore Details</a>
                        <span class="ml-6 text-logo-yellow font-black uppercase tracking-[0.2em] text-xs italic">Flat Top. Wider View.</span>
                    </div>
                </div>
            </div>

            {{-- Precision HUD Callout --}}
            <div class="absolute top-[56%] right-[21.5%] hidden lg:block translate-y-1">
                <div class="relative">
                    <div class="absolute -inset-4 border border-logo-yellow/50 rounded-full animate-ping opacity-75"></div>
                    <div class="w-3 h-3 rounded-full bg-logo-yellow shadow-[0_0_15px_#f8b803] z-10 relative"></div>
                    <div class="absolute top-1/2 left-full w-20 h-px bg-gradient-to-r from-logo-yellow to-transparent ml-2"></div>
                    <div class="absolute -top-10 left-24 whitespace-nowrap bg-brand-900/60 backdrop-blur-xl px-5 py-3 border-l-2 border-logo-yellow shadow-2xl skew-x-[-12deg]">
                        <div class="flex flex-col items-start translate-x-[2px] skew-x-[12deg]">
                            <span class="text-[9px] font-black uppercase tracking-[0.2em] text-logo-yellow/80">Segment Type</span>
                            <span class="text-lg font-black text-white tracking-wide">D-BIFOCAL (DBF)</span>
                            <div class="w-full h-[1px] bg-logo-yellow/30 mt-1"></div>
                            <span class="text-[8px] font-bold text-warm-300 uppercase mt-1">Wide-Angle Near Vision</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Slider Navigation Indicators (Yellow Theme with Progress) --}}
    <div class="absolute bottom-12 left-0 w-full z-30 pointer-events-none">
        <div class="container-custom flex justify-between items-end">
            <div class="flex gap-3 pointer-events-auto">
                <template x-for="i in totalSlides">
                    <button @click="if(activeSlide !== i) { leaving = true; setTimeout(() => { activeSlide = i; leaving = false; }, 700); }"
                            class="group relative h-1.5 transition-all duration-500 overflow-hidden rounded-full"
                            :class="activeSlide === i ? 'w-12 bg-logo-yellow shadow-[0_0_15px_rgba(248,184,3,0.5)]' : 'w-6 bg-white/20 hover:bg-white/40'">
                        <div x-show="activeSlide === i" 
                             class="absolute inset-0 bg-transparent animate-[progress_8s_linear_infinite]"
                             style="background: rgba(255,255,255,0.3)"></div>
                    </button>
                </template>
            </div>
            <div class="text-white/40 font-mono text-[10px] tracking-[0.3em] uppercase">
                Collection <span class="text-logo-yellow font-black" x-text="activeSlide"></span> <span class="mx-1">/</span> <span x-text="totalSlides"></span>
            </div>
        </div>
    </div>

    {{-- Interactive Background Accent --}}
    <div class="absolute bottom-0 right-0 w-1/3 h-1/2 bg-gradient-to-tl from-logo-yellow/10 to-transparent blur-3xl pointer-events-none"></div>
</section>

<style>
    @keyframes progress { 
        from { width: 0; } 
        to { width: 100%; } 
    }
    @keyframes slide-up {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-up {
        animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>

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
                    <a href="{{ $product->slug ? route('products.show', $product->slug) : '#' }}" class="card group shimmer-hover flex flex-col h-full border border-warm-200/50">
                        {{-- Image Area --}}
                        <div class="aspect-[4/3] bg-gradient-to-br from-brand-50 to-accent-50 flex items-center justify-center relative overflow-hidden shrink-0">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain p-4 transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div class="text-7xl opacity-15 font-display font-bold text-brand-300 transition-transform duration-500 group-hover:scale-110">{{ substr($product->name, 0, 2) }}</div>
                            @endif

                            {{-- Top badges --}}
                            <div class="absolute top-3 left-3 flex gap-2">
                                <span class="inline-block px-2.5 py-1 rounded-full text-xs font-bold shadow bg-warm-900 text-white">{{ $product->brand }}</span>
                                @if($product->is_featured)
                                    <span class="inline-block px-2.5 py-1 rounded-full text-xs font-bold bg-accent-500 text-white shadow">⭐ Featured</span>
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
</div>
@endsection