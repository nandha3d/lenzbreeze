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
            <span class="text-accent-500 font-medium">{{ $product->name }}</span>
        </nav>
    </div>
</div>

{{-- Product Hero Slider (Specific to Single Vision) --}}
@if($product->slug === 'single-vision-rx')
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
        this.interval = setInterval(() => this.nextSlide(), 7000);
    },
    stopAutoScroll() {
        clearInterval(this.interval);
    }
}" x-init="startAutoScroll()" @mouseenter="stopAutoScroll()" @mouseleave="startAutoScroll()"
class="relative h-[65vh] min-h-[550px] overflow-hidden bg-warm-900 group">
    
    {{-- Slide 1: Technical Precision --}}
    <div x-show="activeSlide === 1" 
         :class="{'active-slide': activeSlide === 1, 'leaving-slide': leaving && activeSlide === 1}"
         class="absolute inset-0 z-10 transition-opacity duration-1000">
        {{-- Stripe Transition Background --}}
        <div class="stripe-container absolute inset-0">
            @for($i=0; $i<5; $i++)
            <div class="stripe-item" style="background-image: url('{{ asset('images/single-vision-banner1.jpeg') }}');"></div>
            @endfor
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/40 to-transparent z-[11]"></div>
        
        {{-- Sci-Fi Overlays --}}
        <div class="scifi-scan-line"></div>
        <div class="absolute inset-0 hud-grid-bg opacity-10"></div>

        <div class="max-w-[1600px] mx-auto px-6 lg:px-12 relative h-full flex items-center z-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center w-full">
                {{-- Left Side: Text --}}
                <div class="max-w-2xl text-white relative ml-4 lg:ml-12">
                    {{-- HUD Accent: Top Left Corner --}}
                    <div class="absolute -top-10 -left-10 w-20 h-20 border-t-2 border-l-2 border-logo-yellow/30"></div>
                    
                    <h2 class="inline-block px-4 py-1.5 rounded-sm bg-logo-yellow/10 border-l-4 border-logo-yellow text-logo-yellow text-[10px] font-black uppercase tracking-[0.3em] mb-8 animate-slide-up">
                        EYE MEK SV Collection
                    </h2>
                    <div class="space-y-6">
                        <h1 class="font-display text-4xl md:text-6xl font-black leading-[1.1] animate-slide-up" style="animation-delay: 0.2s">
                            Precision in every pulse.
                        </h1>
                        <p class="text-xl md:text-2xl font-bold text-warm-100/90 leading-tight animate-slide-up" style="animation-delay: 0.4s">
                            Introducing EYE MEK SV—where advanced HD Digital technology meets premium protection.
                        </p>
                        <p class="text-lg text-warm-200/80 leading-relaxed max-w-xl animate-slide-up" style="animation-delay: 0.6s">
                            From the boardroom to the Great Outdoors, our Blue Cut and Photochromic lenses adapt to your world.
                            <span class="block mt-4 text-logo-yellow font-black">See sharper. Live better.</span>
                        </p>
                    </div>
                </div>

                {{-- Removed distracting HUD metadata to clear view of subjects --}}
            </div>
        </div>
    </div>

    {{-- Slide 2: Lifestyle Variety --}}
    <div x-show="activeSlide === 2" 
         :class="{'active-slide': activeSlide === 2, 'leaving-slide': leaving && activeSlide === 2}"
         class="absolute inset-0 z-10 transition-opacity duration-1000" style="display: none;">
        {{-- Stripe Transition Background --}}
        <div class="stripe-container absolute inset-0">
            @for($i=0; $i<5; $i++)
            <div class="stripe-item" style="background-image: url('{{ asset('images/single-vision-banner2.jpeg') }}');"></div>
            @endfor
        </div>
        <div class="absolute inset-0 bg-gradient-to-l from-black/95 via-black/60 to-black/20 z-[11]"></div>
        
        {{-- Sci-Fi Overlays --}}
        <div class="scifi-scan-line opacity-50"></div>

        <div class="max-w-[1600px] mx-auto px-6 lg:px-12 relative h-full flex items-center z-20">
            <div class="flex justify-end items-center w-full">
                {{-- Swapped Layout: Text on Far Right --}}
                <div class="max-w-xl text-white text-right relative group mr-4 lg:mr-12">
                    {{-- HUD Accent: Bottom Right Corner --}}
                    <div class="absolute -bottom-10 -right-10 w-24 h-24 border-b-2 border-r-2 border-logo-yellow/30 transition-transform duration-700 group-hover:scale-110"></div>
                    
                    <h2 class="inline-block px-4 py-1.5 rounded-sm bg-logo-yellow/10 border-r-4 border-logo-yellow text-logo-yellow text-[10px] font-black uppercase tracking-[0.3em] mb-8">
                        The Lifestyle Enthusiast
                    </h2>
                    <div class="space-y-6">
                        <h1 class="font-display text-4xl md:text-6xl font-black leading-[1.1]">
                            Your eyes, your signature.
                        </h1>
                        <p class="text-xl md:text-2xl font-bold text-warm-100/90 leading-tight">
                            Experience the sleek tint of Grey & Brown Photochromic or the vibrant Blue and Green HMC coatings.
                        </p>
                        <p class="text-lg text-warm-200/80 leading-relaxed max-w-xl ml-auto">
                            EYE MEK offers a lens for every outlook. Experience the ultimate fusion of CR-39 lightness and Polarized precision.
                        </p>
                    </div>
                </div>
            </div>
            
            {{-- Floating HUD Line --}}
            <div class="absolute left-10 top-1/2 -translate-y-1/2 w-[1px] h-32 bg-gradient-to-b from-transparent via-logo-yellow/20 to-transparent"></div>
        </div>
    </div>

    {{-- Slide 3: Punchy Social Ready --}}
    <div x-show="activeSlide === 3" 
         :class="{'active-slide': activeSlide === 3, 'leaving-slide': leaving && activeSlide === 3}"
         class="absolute inset-0 z-10 transition-opacity duration-1000" style="display: none;">
        {{-- Stripe Transition Background --}}
        <div class="stripe-container absolute inset-0">
            @for($i=0; $i<5; $i++)
            <div class="stripe-item" style="background-image: url('{{ asset('images/single-vision-banner3.jpeg') }}');"></div>
            @endfor
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-black/95 via-black/40 to-transparent z-[11]"></div>

        <div class="max-w-[1600px] mx-auto px-6 lg:px-12 relative h-full flex items-center z-20">
            <div class="max-w-2xl text-white relative ml-4 lg:ml-12">
                {{-- HUD Accent: Top Left Corner --}}
                <div class="absolute -top-10 -left-10 w-20 h-20 border-t-2 border-l-2 border-logo-yellow/30"></div>
                
                <h2 class="inline-block px-4 py-1.5 rounded-sm bg-logo-yellow/10 border-l-4 border-logo-yellow text-logo-yellow text-[10px] font-black uppercase tracking-[0.3em] mb-8">
                    SOCIAL // PUNCHY_PACK
                </h2>
                
                <div class="space-y-6">
                    <h1 class="font-display text-4xl md:text-6xl font-black leading-[1.1]">
                        Upgrade your view with <br/> EYE MEK Premium SV Lenses.
                    </h1>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-logo-yellow animate-pulse"></div>
                            <span class="text-lg font-bold">HD Digital Clarity</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-logo-yellow animate-pulse"></div>
                            <span class="text-lg font-bold">Advanced Blue Cut Tech</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-logo-yellow animate-pulse"></div>
                            <span class="text-lg font-bold">Adaptive Photochromic Tints</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-logo-yellow animate-pulse"></div>
                            <span class="text-lg font-bold">Premium HMC Anti-Glare</span>
                        </div>
                    </div>
                    
                    <div class="mt-8 p-4 border-l-2 border-logo-yellow/50 bg-white/5 backdrop-blur-sm inline-block">
                        <span class="text-logo-yellow font-black uppercase tracking-[0.3em] text-sm italic">EYE MEK: THE ART OF VISION.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Slider Controls (Yellow Theme) --}}
    <div class="absolute bottom-10 left-0 w-full z-30">
        <div class="max-w-[1600px] mx-auto px-6 lg:px-12 flex items-center gap-6">
            <div class="flex gap-2">
                <template x-for="i in totalSlides" :key="i">
                    <button @click="activeSlide = i" 
                            class="h-1.5 transition-all duration-500 rounded-full"
                            :class="activeSlide === i ? 'w-12 bg-logo-yellow shadow-[0_0_15px_rgba(248,184,3,0.5)]' : 'w-3 bg-white/30 hover:bg-white/50'"></button>
                </template>
            </div>
            <div class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em]">
                Slide <span class="text-logo-yellow font-black" x-text="activeSlide"></span> of 3
            </div>
        </div>
    </div>

    {{-- Interactive Background Accent --}}
    <div class="absolute bottom-0 right-0 w-1/3 h-1/2 bg-gradient-to-tl from-logo-yellow/10 to-transparent blur-3xl pointer-events-none"></div>
</section>

<style>
    @keyframes slide-up {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-up {
        animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>
@endif

{{-- Product Detail --}}
<section class="theme-eyemek" id="variants">
<section class="section-padding bg-white bg-geometric bg-geometric-circles">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            {{-- Product Gallery --}}
            <div x-data="{
                activeImage: '{{ $product->image ? asset($product->image) : '' }}',
                lightboxOpen: false,
                images: [
                    @if($product->image) '{{ asset($product->image) }}', @endif
                    @if($product->gallery)
                        @foreach($product->gallery as $image) '{{ asset($image) }}', @endforeach
                    @endif
                ]
            }">
                {{-- Main Image --}}
                <div class="aspect-square rounded-3xl bg-gradient-to-br from-brand-50 via-accent-50 to-brand-100 flex items-center justify-center relative overflow-hidden group cursor-zoom-in border border-warm-200/50 shadow-xl" @click="lightboxOpen = true">
                    @if($product->image)
                        <img :src="activeImage" alt="{{ $product->name }}" class="w-full h-full object-contain p-6 transition-transform duration-700 group-hover:scale-105">
                    @else
                        {{-- Animated lens placeholder --}}
                        <div class="relative flex items-center justify-center">
                            <div class="lens-placeholder"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="font-display font-bold text-5xl text-brand-300/40 select-none">{{ substr($product->name, 0, 2) }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- Brand badge --}}
                    <div class="absolute top-4 left-4 flex gap-2">
                        <span class="px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-md {{ $product->brand === 'Lenz Breeze' ? 'bg-brand-500 text-white' : 'bg-warm-900 text-white' }}">{{ $product->brand }}</span>
                    </div>

                    {{-- Zoom hint --}}
                    <div class="absolute bottom-4 right-4 w-9 h-9 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center shadow-md opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                    </div>
                </div>

                {{-- Thumbnails --}}
                @if($product->gallery && count($product->gallery) > 0)
                <div class="grid grid-cols-4 gap-3 mt-4">
                    @if($product->image)
                    <button @click="activeImage = '{{ asset($product->image) }}'"
                        class="aspect-square rounded-xl overflow-hidden border-2 transition-all duration-300 shadow-sm"
                        :class="activeImage === '{{ asset($product->image) }}' ? 'border-accent-500 ring-2 ring-accent-200 scale-95' : 'border-transparent hover:border-brand-300 hover:scale-95'">
                        <img src="{{ asset($product->image) }}" class="w-full h-full object-cover">
                    </button>
                    @endif
                    @foreach($product->gallery as $image)
                        @if($image !== $product->image)
                        <button @click="activeImage = '{{ asset($image) }}'"
                            class="aspect-square rounded-xl overflow-hidden border-2 transition-all duration-300 shadow-sm"
                            :class="activeImage === '{{ asset($image) }}' ? 'border-accent-500 ring-2 ring-accent-200 scale-95' : 'border-transparent hover:border-brand-300 hover:scale-95'">
                            <img src="{{ asset($image) }}" class="w-full h-full object-cover">
                        </button>
                        @endif
                    @endforeach
                </div>
                @endif

                {{-- Lightbox --}}
                <div x-show="lightboxOpen"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-sm p-4"
                    @keydown.escape.window="lightboxOpen = false"
                    style="display: none;">
                    <div class="relative w-full max-w-5xl h-full flex flex-col items-center justify-center" @click.outside="lightboxOpen = false">
                        <button @click="lightboxOpen = false" class="absolute top-4 right-4 text-white hover:text-accent-300 transition-colors z-50 w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                        <img :src="activeImage" class="max-w-full max-h-[85vh] object-contain rounded-2xl shadow-2xl">
                        <div class="flex gap-2 mt-4 overflow-x-auto max-w-full pb-2">
                            <template x-for="img in images" :key="img">
                                <button @click="activeImage = img"
                                    class="w-16 h-16 rounded-lg overflow-hidden border-2 transition-all flex-shrink-0"
                                    :class="activeImage === img ? 'border-accent-500' : 'border-transparent opacity-70 hover:opacity-100'">
                                    <img :src="img" class="w-full h-full object-cover">
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Product Info --}}
            <div x-data="{
                selectedVariant: null,
                selectedSubVariant: null,
                showPopup: false,
                openPopup(variant, subVariant) {
                    this.selectedVariant = variant;
                    this.selectedSubVariant = subVariant || (variant.sub_variants ? variant.sub_variants[0] : null);
                    this.showPopup = true;
                    document.body.style.overflow = 'hidden';
                },
                closePopup() {
                    this.showPopup = false;
                    document.body.style.overflow = '';
                }
            }">
                {{-- Category & Brand --}}
                <div class="flex items-center gap-3 mb-3">
                    <span class="text-xs text-warm-400 font-bold uppercase tracking-widest">{{ $product->category?->name }}</span>
                    @if($product->is_featured)
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-accent-500 text-white shadow-sm">⭐ Premium Choice</span>
                    @endif
                </div>

                <h1 class="font-display text-3xl md:text-4xl font-black text-brand-500 leading-tight">{{ $product->name }}</h1>
                <p class="text-lg text-accent-600 font-semibold mt-2 italic">{{ $product->tagline }}</p>

                {{-- Divider --}}
                <div class="flex items-center gap-3 mt-5 mb-6">
                    <div class="h-0.5 w-12 bg-accent-500 rounded-full"></div>
                    <div class="h-0.5 flex-1 bg-warm-100 rounded-full"></div>
                </div>

                <div class="text-warm-600 leading-relaxed">{!! $product->description !!}</div>

                {{-- Technologies --}}
                @if($product->technologies)
                    <div class="mt-5">
                        <div class="flex flex-wrap gap-2">
                            @foreach($product->technologies as $tech)
                                <span class="px-3 py-1.5 rounded-lg bg-accent-50 text-accent-700 text-xs font-bold uppercase tracking-wider border border-accent-100">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Best For Lifestyle Tags --}}
                @php
                    $lifestyleTags = [
                        'single-vision-rx' => ['Everyday Use', 'Digital Work', 'Gaming', 'Active Lifestyle', 'Driving', 'Outdoor Sports'],
                        'premium-progressive-rx' => ['Multi-Distance Vision', 'Driving', 'Digital Work', 'Travel', 'Professionals'],
                        'kryptok-bifocals' => ['Reading', 'Near + Far Vision', 'Classic Bifocal Wearers', 'High Prescriptions'],
                        'drive-ease' => ['Reading', 'Crafting', 'First-time Bifocal Wearers', 'Books & Tablets'],
                        'd-bifocal-lens' => ['Reading', 'Wide View', 'First-time Bifocal Wearers', 'Books & Tablets'],
                    ];
                    $tags = $lifestyleTags[$product->slug] ?? [];
                @endphp
                @if(!empty($tags))
                <div class="mt-5">
                    <p class="text-xs font-black uppercase tracking-widest text-warm-400 mb-2">Best For</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <span class="lifestyle-tag">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- ============================================ --}}
                {{-- VARIANT SELECTOR — HORIZONTAL SCROLL ROW --}}
                {{-- ============================================ --}}
                @if(isset($product->specifications['variants']))
                    <div class="mt-10">
                        <div class="flex items-center justify-between mb-5">
                            <div>
                                <h3 class="font-display text-base font-black text-brand-500 uppercase tracking-widest">Choose Your Lens Variant</h3>
                                <p class="text-xs text-warm-400 mt-0.5">{{ count($product->specifications['variants']) }} options available — scroll & click to learn more</p>
                            </div>
                            {{-- Scroll hint --}}
                            <div class="hidden sm:flex items-center gap-1 text-warm-300">
                                <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                <span class="text-[10px] font-bold uppercase tracking-wider">Scroll</span>
                            </div>
                        </div>

                        <div class="variant-scroll-wrap">
                            <div class="variant-scroll-row">
                                @foreach($product->specifications['variants'] as $variant)
                                    <div
                                        class="variant-scroll-card"
                                        @click="openPopup({{ json_encode($variant) }})"
                                        role="button"
                                        tabindex="0"
                                        aria-label="View {{ $variant['name'] }} variant details"
                                        @keydown.enter="openPopup({{ json_encode($variant) }})"
                                    >
                                        {{-- Variant Image --}}
                                        <div class="variant-img">
                                            @if(isset($variant['image']))
                                                <img src="{{ asset($variant['image']) }}" alt="{{ $variant['name'] }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full variant-image-box icon-{{ $variant['icon_type'] ?? 'clear' }}"></div>
                                            @endif
                                        </div>

                                        {{-- Name --}}
                                        <p class="variant-scroll-card-name">{{ $variant['name'] }}</p>

                                        {{-- Learn more --}}
                                        <span class="variant-scroll-card-cta">
                                            Details
                                            <svg class="w-2.5 h-2.5 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- ============================================ --}}
                {{-- VARIANT INFO POPUP (MODAL) --}}
                {{-- ============================================ --}}
                <div
                    x-show="showPopup"
                    x-cloak
                    class="info-popup"
                    @keydown.escape.window="closePopup()"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                >
                    <div
                        class="info-popup-content !max-w-5xl !w-[95vw] max-h-[95vh] flex flex-col rounded-[2.5rem] shadow-2xl border-none overflow-hidden"
                        @click.stop
                        x-show="showPopup"
                        x-transition:enter="transition ease-out duration-500 transform"
                        x-transition:enter-start="scale-95 translate-y-8 opacity-0 blur-sm"
                        x-transition:enter-end="scale-100 translate-y-0 opacity-100 blur-0"
                        x-transition:leave="transition ease-in duration-300 transform"
                        x-transition:leave-start="scale-100 translate-y-0 opacity-100 blur-0"
                        x-transition:leave-end="scale-95 translate-y-8 opacity-0 blur-sm"
                    >
                        {{-- Close --}}
                        <button @click="closePopup()" class="absolute top-6 right-6 text-warm-400 hover:text-brand-500 transition-all w-12 h-12 rounded-full hover:bg-warm-100 flex items-center justify-center z-50 bg-white/90 backdrop-blur-md shadow-lg border border-warm-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>

                        <div class="overflow-y-auto lg:overflow-visible">
                            <div class="grid grid-cols-1 lg:grid-cols-12">
                                {{-- Left Side: Visual & Summary (Sticky-like on Desktop) --}}
                                <div class="lg:col-span-5 bg-gradient-to-br from-brand-50 via-white to-accent-50/30 p-8 lg:p-12 flex flex-col items-center justify-center text-center border-b lg:border-b-0 lg:border-r border-warm-100 relative overflow-hidden">
                                    {{-- Decorative elements --}}
                                    <div class="absolute -top-24 -left-24 w-64 h-64 bg-brand-200/20 blur-[100px] rounded-full"></div>
                                    <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-accent-200/20 blur-[100px] rounded-full"></div>

                                    {{-- Large Lens Visualizer --}}
                                    <div class="relative w-48 h-48 lg:w-56 lg:h-56 mb-8 group">
                                        <div class="absolute inset-0 bg-white/80 backdrop-blur-sm rounded-full shadow-2xl overflow-hidden border border-warm-100/50 flex items-center justify-center p-3">
                                            <div class="relative w-full h-full rounded-full bg-gradient-to-br from-white via-brand-50 to-accent-100/20 flex items-center justify-center overflow-hidden">
                                                {{-- Glass Shimmer --}}
                                                <div class="glass-shimmer absolute inset-0 opacity-40"></div>
                                                
                                                <template x-if="selectedVariant?.image">
                                                    <img :src="'/' + selectedVariant.image" :alt="selectedVariant?.name" class="relative z-10 w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-700">
                                                </template>
                                                <template x-if="!selectedVariant?.image">
                                                    <div class="relative z-10 w-24 h-24 flex items-center justify-center text-brand-200 opacity-40">
                                                        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 9l-6 6m0-6l6 6"/></svg>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                        {{-- Outer orbital ring --}}
                                        <div class="absolute -inset-4 border-2 border-dashed border-brand-200/40 rounded-full animate-[spin_30s_linear_infinite]"></div>
                                    </div>

                                    <h3 class="text-4xl font-display font-black text-brand-500 mb-2 leading-tight" x-text="selectedVariant?.name"></h3>
                                    <div class="h-1.5 w-16 bg-accent-500 rounded-full mb-6 mx-auto"></div>
                                    
                                    <p class="text-warm-700 text-lg leading-relaxed font-medium" 
                                       x-text="selectedVariant?.details?.summary || selectedVariant?.description"></p>
                                </div>

                                {{-- Right Side: Tech Specs & Benefits --}}
                                <div class="lg:col-span-7 p-8 lg:p-12 space-y-12">
                                    {{-- Benefit Cards Grid --}}
                                    <template x-if="selectedVariant?.details?.benefits">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <template x-for="benefit in selectedVariant.details.benefits" :key="benefit">
                                                <div class="p-4 rounded-2xl bg-white border border-warm-100 shadow-sm hover:shadow-md hover:border-accent-200 transition-all flex gap-3">
                                                    <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center shrink-0">
                                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                    </div>
                                                    <div class="text-sm">
                                                        <p class="font-bold text-warm-900" x-text="benefit.includes(':') ? benefit.split(':')[0] : 'Feature'"></p>
                                                        <p class="text-warm-600 leading-tight mt-0.5" x-text="benefit.includes(':') ? benefit.split(':')[1] : benefit"></p>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </template>

                                    {{-- Technical Specs - Side-by-Side with Highlight --}}
                                    <div class="grid grid-cols-1 xl:grid-cols-5 gap-8">
                                        {{-- Laboratory Specs Table --}}
                                        <template x-if="selectedVariant?.details?.specs">
                                            <div class="xl:col-span-3">
                                                <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-warm-400 mb-4 px-1">Laboratory Data</h4>
                                                <div class="bg-warm-50/50 rounded-2xl border border-warm-100 overflow-hidden">
                                                    <table class="w-full text-xs">
                                                        <tbody>
                                                            <template x-for="spec in selectedVariant.details.specs" :key="spec.label">
                                                                <tr class="border-b border-warm-100 last:border-0">
                                                                    <td class="py-3 px-5 font-bold text-warm-500 bg-warm-100/30" x-text="spec.label"></td>
                                                                    <td class="py-3 px-5 text-brand-600 font-black text-right" x-text="spec.value"></td>
                                                                </tr>
                                                            </template>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </template>

                                        {{-- Core Innovation Highlight --}}
                                        <template x-if="selectedVariant?.details?.highlight_title">
                                            <div class="xl:col-span-2 flex flex-col">
                                                <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-warm-400 mb-4 px-1">Core Innovation</h4>
                                                <div class="flex-1 bg-brand-900 text-white rounded-2xl p-6 relative overflow-hidden group shadow-lg">
                                                    <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-accent-500/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                                                    <p class="text-accent-400 text-xs font-black uppercase tracking-widest mb-2" x-text="selectedVariant.details.highlight_title"></p>
                                                    <p class="text-white/80 text-xs leading-relaxed" x-text="selectedVariant.details.highlight_desc"></p>
                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                    {{-- Available Tints --}}
                                    <template x-if="selectedVariant?.sub_variants && selectedVariant.sub_variants.length > 0">
                                        <div class="pt-8 border-t border-warm-100">
                                            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-brand-500/50 mb-4 text-center">Available Premium Tints & Configurations</p>
                                            <div class="flex gap-2 justify-center flex-wrap">
                                                <template x-for="sub in selectedVariant.sub_variants" :key="sub">
                                                    <button
                                                        @click="selectedSubVariant = sub"
                                                        class="px-6 py-3 rounded-xl text-xs font-bold transition-all duration-300 border-2"
                                                        :class="selectedSubVariant === sub ? 'bg-brand-500 border-brand-500 text-white shadow-xl scale-105' : 'bg-white border-warm-200 text-warm-600 hover:border-brand-300'"
                                                        @click.stop
                                                        x-text="sub">
                                                    </button>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>

                        {{-- Final CTA --}}
                        <div class="p-8 bg-white border-t border-warm-100 flex justify-center">
                            <button @click="closePopup()" class="btn-primary px-12 py-4 text-lg rounded-2xl shadow-xl hover:shadow-accent-500/20 transition-all transform active:scale-[0.97]">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                Standard Acknowledgment
                            </button>
                        </div>
                    </div>

                    {{-- Backdrop click to close --}}
                    <div class="absolute inset-0 -z-10" @click="closePopup()"></div>
                </div>

                {{-- Care Package Highlights --}}
                <div class="mt-8 p-5 rounded-2xl bg-accent-50/60 border border-accent-100">
                    <h4 class="text-xs font-black text-accent-700 uppercase tracking-widest mb-3">✨ Professional Care Package Included</h4>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex flex-col items-center gap-1.5 text-center">
                            <div class="w-9 h-9 rounded-xl bg-white flex items-center justify-center text-accent-600 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <span class="text-[10px] font-bold text-warm-700 leading-tight">1 Year<br>Warranty</span>
                        </div>
                        <div class="flex flex-col items-center gap-1.5 text-center">
                            <div class="w-9 h-9 rounded-xl bg-white flex items-center justify-center text-accent-600 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            </div>
                            <span class="text-[10px] font-bold text-warm-700 leading-tight">Microfiber<br>Cloth</span>
                        </div>
                        <div class="flex flex-col items-center gap-1.5 text-center">
                            <div class="w-9 h-9 rounded-xl bg-white flex items-center justify-center text-accent-600 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a2 2 0 00-1.96 1.414l-.727 2.903a2 2 0 01-3.568 0l-.727-2.903a2 2 0 00-1.96-1.414l-2.387.477a2 2 0 00-1.022.547l-2.359 2.359a2 2 0 01-3.414-1.414V6.414a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-3.414 1.414l-2.359-2.359z"/></svg>
                            </div>
                            <span class="text-[10px] font-bold text-warm-700 leading-tight">Cleaning<br>Solution</span>
                        </div>
                    </div>
                </div>

                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('contact') }}" class="btn-primary flex-1 sm:flex-none">
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
                    <h2 class="font-display text-xl font-bold text-brand-500 mb-5 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-accent-500 flex items-center justify-center text-white shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        Key Features
                    </h2>
                    <ul class="space-y-3">
                        @foreach($product->features as $feature)
                            <li class="flex items-start gap-3">
                                <span class="w-5 h-5 rounded-full bg-accent-50 flex items-center justify-center mt-0.5 shrink-0">
                                    <span class="w-1.5 h-1.5 rounded-full bg-accent-500"></span>
                                </span>
                                <span class="text-warm-600 font-medium">{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($product->specifications)
                <div class="card p-8">
                    <h2 class="font-display text-xl font-bold text-brand-500 mb-5 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-accent-500 flex items-center justify-center text-white shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                        </span>
                        Specifications
                    </h2>
                    <div class="space-y-2">
                        @foreach($product->specifications as $key => $value)
                            @if(!is_array($value))
                                <div class="flex justify-between items-center py-2.5 border-b border-warm-100 last:border-0">
                                    <span class="text-warm-500 text-sm font-medium">{{ ucfirst($key) }}</span>
                                    <span class="text-brand-500 text-sm font-bold text-right max-w-[60%]">{{ $value }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- Lifestyle Focused Banner (Specific to Single Vision) --}}
        @if($product->slug === 'single-vision-rx')
        </div> {{-- End container-custom from previous section --}}
        
        <section class="relative h-[55vh] min-h-[450px] overflow-hidden bg-warm-900 group my-20">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[12s] group-hover:scale-105" 
                 style="background-image: url('{{ asset('images/single-vision-banner2.jpeg') }}');">
            </div>
            
            {{-- Dark Overlay for Readability --}}
            <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/40 to-transparent"></div>

            <div class="container-custom relative h-full flex items-center z-10">
                <div class="max-w-2xl text-white">
                    <h3 class="text-accent-400 text-xs font-black uppercase tracking-[0.3em] mb-4 opacity-0" 
                        data-animate-class="animate-fade-in-down" style="animation-delay: 0.1s">
                        The Lifestyle Enthusiast
                    </h3>
                    
                    <div class="space-y-6">
                        <h2 class="font-display text-4xl md:text-5xl font-black leading-tight opacity-0"
                            data-animate-class="animate-slide-up" style="animation-delay: 0.3s">
                            Your eyes, your signature.
                        </h2>
                        
                        <p class="text-lg md:text-xl text-warm-100/90 leading-relaxed font-medium opacity-0"
                           data-animate-class="animate-slide-up" style="animation-delay: 0.5s">
                            Whether it's the sleek tint of our Grey & Brown Photochromic or the vibrant protection of our Blue and Green HMC coatings, EYE MEK offers a lens for every outlook.
                        </p>

                        <div class="pt-4 opacity-0" data-animate-class="animate-slide-up" style="animation-delay: 0.7s">
                            <span class="inline-flex items-center px-5 py-2 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 text-sm font-bold">
                                Experience the ultimate fusion of CR-39 lightness and Polarized precision.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Professional Accent --}}
            <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-brand-500/5 to-transparent"></div>
        </section>

        <div class="container-custom"> {{-- Re-open container-custom for following content --}}
        @endif

        {{-- Warranty & Care --}}
        <div class="mt-16 featured-section-card" data-animate>
            <div class="grid grid-cols-1 lg:grid-cols-3">
                <div class="p-8 lg:p-12 lg:col-span-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-6 card-highlight">
                        Eye Mek Protection Plan
                    </div>
                    <h2 class="font-display text-3xl font-bold mb-4">Limited Warranty & Care Package</h2>
                    <p class="text-muted leading-relaxed mb-8 font-medium">At Eye Mek, we stand behind the precision and quality of our premium lens collection. Every pair is backed by our comprehensive protection plan and professional maintenance kit.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                                <span class="w-8 h-8 rounded-lg bg-brand-500 text-white flex items-center justify-center text-sm shadow-sm">1</span>
                                One-Year Warranty
                            </h3>
                            <p class="text-muted text-sm mb-4 leading-relaxed">Guaranteed against manufacturing defects and specific coating failures from the date of purchase.</p>
                            <ul class="space-y-2 text-sm font-semibold">
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    Coating Integrity (ARC, Blue Cut)
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    Material Flaws & Internal Bubbles
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    Photochromic Performance
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                                <span class="w-8 h-8 rounded-lg bg-brand-500 text-white flex items-center justify-center text-sm shadow-sm">2</span>
                                Lens Care Best Practices
                            </h3>
                            <ul class="space-y-3 text-sm text-muted font-medium">
                                <li class="flex gap-2"><span>•</span> <span>Always use the provided cleaning solution and microfiber cloth.</span></li>
                                <li class="flex gap-2"><span>•</span> <span>Avoid household detergents or paper towels.</span></li>
                                <li class="flex gap-2"><span>•</span> <span>Store in its protective case when not in use.</span></li>
                                <li class="flex gap-2"><span>•</span> <span>Keep away from extreme heat (e.g. car dashboards).</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="p-8 lg:p-12 flex flex-col justify-center border-l border-default card-highlight">
                    <div class="font-display font-bold text-sm mb-4 uppercase tracking-wider">Professional Maintenance Kit</div>
                    <div class="space-y-4">
                        <div class="p-4 rounded-xl bg-white/20 border border-default flex items-center gap-4 shadow-sm">
                            <div class="text-2xl">✨</div>
                            <div>
                                <div class="font-bold text-sm">1 Year Warranty</div>
                                <div class="text-muted text-xs font-semibold">Full Coverage</div>
                            </div>
                        </div>
                        <div class="p-4 rounded-xl bg-white/20 border border-default flex items-center gap-4 shadow-sm">
                            <div class="text-2xl">🧤</div>
                            <div>
                                <div class="font-bold text-sm">Ultra-Soft Cloth</div>
                                <div class="text-muted text-xs font-semibold">Anti-Scratch Microfiber</div>
                            </div>
                        </div>
                        <div class="p-4 rounded-xl bg-white/20 border border-default flex items-center gap-4 shadow-sm">
                            <div class="text-2xl">🧪</div>
                            <div>
                                <div class="font-bold text-sm">Premium Solution</div>
                                <div class="text-muted text-xs font-semibold">Lens-Safe Formula</div>
                            </div>
                        </div>
                    </div>
                    <p class="mt-8 text-[11px] font-bold opacity-60 uppercase tracking-widest leading-relaxed">Note: Does not cover accidental damage, scratches from improper cleaning, or prescription changes.</p>
                </div>
            </div>
        </div>
    </div>
</section>
</section>

{{-- Related Products --}}
@if($relatedProducts->isNotEmpty())
<section class="section-padding bg-warm-50" data-animate>
    <div class="container-custom">
        <div class="flex items-center justify-between mb-8">
            <h2 class="section-title">Related Products</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @foreach($relatedProducts as $related)
                @php
                    $relatedVariantCount = count($related->specifications['variants'] ?? []);
                @endphp
                <a href="{{ route('products.show', $related->slug) }}" class="card group">
                    <div class="aspect-[4/3] bg-gradient-to-br from-brand-50 to-accent-50 flex items-center justify-center relative overflow-hidden">
                        @if($related->image)
                            <img src="{{ asset($related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-contain p-4 transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="text-6xl opacity-15 font-display font-bold text-brand-300">{{ substr($related->name, 0, 2) }}</div>
                        @endif
                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-xs font-semibold {{ $related->brand === 'Lenz Breeze' ? 'bg-brand-500 text-white' : 'bg-warm-800 text-white' }}">{{ $related->brand }}</span>
                        @if($relatedVariantCount > 0)
                            <span class="variant-count-badge">{{ $relatedVariantCount }} Variants</span>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-display font-bold text-brand-500 group-hover:text-accent-600 transition-colors">{{ $related->name }}</h3>
                        <p class="text-sm text-warm-400 mt-0.5">{{ $related->tagline }}</p>
                        <div class="mt-3 flex items-center text-xs font-bold text-accent-600 group-hover:translate-x-1 transition-transform">
                            Explore Details
                            <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection