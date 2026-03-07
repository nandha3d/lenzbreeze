@extends('layouts.app')
@section('title', 'Lenz Breeze - India\'s Premier Optical Lens Manufacturer')
@section('meta_description', 'Lenz Breeze offers high-performance Eye Mek premium optical lenses. Explore our advanced lens technologies, including Blue Cut, Photochromic, and custom tinting.')

@section('content')
<div class="lb-emergency-recovery-test flex lg:block text-brand-500"></div>

{{-- Hero Section --}}
<section class="hero-section relative min-h-screen flex items-center justify-center overflow-hidden" 
    x-data="{ 
        activeSlide: 0, 
        slides: [
            { 
                title: 'See the World with <span class=\'text-accent-300\'>Blue Cut Clarity</span>', 
                tagline: 'Ultimate protection for the digital age. Our high-performance blue cut lenses shield your eyes from harmful digital strain.',
                image: '{{ asset('images/bluecut.jpeg') }}',
                badge: 'Digital Protection'
            },
            { 
                title: 'Precision <span class=\'text-accent-300\'>D-Bifocal Vision</span>', 
                tagline: 'Seamlessly transition between near and distant vision with our premium flat-top segment bifocals.',
                image: '{{ asset('images/d-bifocal.jpeg') }}',
                badge: 'Multi-Distance Vision'
            },
            { 
                title: 'Refined <span class=\'text-accent-300\'>Single Vision</span>', 
                tagline: 'Experience sharp, distortion-free vision tailored exactly to your prescription using advanced manufacturing.',
                image: '{{ asset('images/single-vision.jpeg') }}',
                badge: 'Custom Precision',
                alt: 'Lenz Breeze Single Vision Optical Lens'
            }
        ],
        next() { this.activeSlide = (this.activeSlide + 1) % this.slides.length },
        init() { setInterval(() => this.next(), 7000) }
    }">
    
    {{-- Dynamic Background --}}
    <div class="absolute inset-0 z-0">
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index" 
                x-transition:enter="transition duration-1000 ease-out"
                x-transition:enter-start="opacity-0 scale-110"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition duration-1000 ease-in absolute inset-0"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                :style="`background-image: url('${slide.image}')`"
            >
                {{-- Lightened overlay for text readability --}}
                <div class="absolute inset-0 bg-gradient-to-r from-brand-900/40 via-brand-900/10 to-transparent"></div>
            </div>
        </template>
    </div>

    {{-- Cinematic Elements --}}
    <div class="absolute inset-0 z-10 pointer-events-none">
        {{-- Circular Lens Mask Overlay --}}
        <div class="hero-lens-overlay absolute inset-0 backdrop-blur-[12px] bg-black/10" 
             style="mask-image: radial-gradient(circle var(--lens-radius, 500px) at var(--lens-x, 50%) var(--lens-y, 50%), transparent 0%, transparent 80%, black 100%); 
                    -webkit-mask-image: radial-gradient(circle var(--lens-radius, 500px) at var(--lens-x, 50%) var(--lens-y, 50%), transparent 0%, transparent 80%, black 100%);">
        </div>
        
        {{-- Lens Edge Detail --}}
        <div class="hero-lens-cursor absolute border border-white/30 rounded-full shadow-[0_0_80px_rgba(255,255,255,0.15)]"
             style="width: calc(var(--lens-radius, 500px) * 2); height: calc(var(--lens-radius, 500px) * 2); 
                    left: var(--lens-x, 50%); top: var(--lens-y, 50%); transform: translate(-50%, -50%); opacity: 0;">
            <div class="absolute inset-0 rounded-full border border-white/10"></div>
        </div>
    </div>

    <div class="container-custom relative z-20">
        <div class="max-w-3xl">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === index" 
                    x-transition:enter="transition ease-out duration-1000 delay-300"
                    x-transition:enter-start="opacity-0 translate-x-12"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-500 absolute inset-y-0 flex flex-col justify-center"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0 -translate-x-12"
                    class="py-20"
                >
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-accent-400/20 backdrop-blur-md border border-accent-400/30 text-accent-100 text-sm mb-8">
                        <span class="w-2 h-2 rounded-full bg-accent-400 animate-pulse"></span>
                        <span x-text="slide.badge" class="font-bold uppercase tracking-wider"></span>
                    </div>
                    <h1 class="font-display text-5xl md:text-7xl font-bold text-white leading-tight drop-shadow-2xl" x-html="slide.title"></h1>
                    <p class="text-xl md:text-2xl text-white/80 mt-8 max-w-2xl leading-relaxed drop-shadow-md" x-text="slide.tagline"></p>
                    
                    <div class="flex flex-wrap gap-6 mt-12">
                        <a href="{{ route('products') }}" class="btn-primary shimmer-hover text-lg !px-10 !py-5 shadow-2xl">
                            Explore Collections
                            <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="{{ route('contact') }}" class="btn-outline-white shimmer-hover text-lg !px-10 !py-5 backdrop-blur-md">Contact Sales</a>
                    </div>
                </div>
            </template>
        </div>

        {{-- Cinematic Navigation Indicators --}}
        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 flex items-center justify-center gap-6 z-50">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index" 
                    class="group flex items-center gap-3 transition-all duration-500"
                >
                    <div class="h-[2px] rounded-full transition-all duration-500"
                        :class="activeSlide === index ? 'w-16 bg-accent-400' : 'w-8 bg-white/20 group-hover:bg-white/40'"></div>
                    <span class="text-[10px] font-bold uppercase tracking-widest transition-colors duration-500"
                        :class="activeSlide === index ? 'text-accent-300' : 'text-white/40 group-hover:text-white/60'"
                        x-text="`0${index + 1}`"></span>
                </button>
            </template>
        </div>
    </div>

    {{-- Floating Decorative Elements --}}
    <div class="absolute top-1/2 right-0 -translate-y-1/2 hidden xl:block z-30 pointer-events-none opacity-20">
        <div class="w-[600px] h-[600px] rounded-full border border-white/10 animate-[spin_60s_linear_infinite]"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-[400px] h-[400px] rounded-full border border-white/5 animate-[spin_40s_linear_infinite_reverse]"></div>
        </div>
    </div>
</section>

{{-- Collections Bar --}}
<section class="bg-white border-b border-warm-200/50">
    <div class="container-custom py-8">
        <div class="flex flex-col sm:flex-row items-center justify-center gap-8 md:gap-16">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/EYE-MEK-LOGO_YELLOW (1).png') }}" alt="Eye Mek Premium Optical Lens Logo" width="150" height="48" class="h-12 w-auto object-contain">
                <div class="pl-3 border-l border-warm-200">
                    <span class="font-display font-bold text-xl text-brand-500 uppercase tracking-tight">Eye Mek</span>
                    <span class="block text-xs text-warm-400">Premium Optical Lenses</span>
                </div>
            </div>
            <div class="w-px h-10 bg-warm-200 hidden sm:block"></div>
            <div class="flex items-center gap-3">
                <div class="flex flex-col">
                    <span class="font-display font-bold text-xl text-warm-800 uppercase tracking-tight">Quality & Precision</span>
                    <span class="block text-xs text-warm-400">Everyday Vision Solutions</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Key Highlights --}}
<section class="section-padding bg-white" data-animate>
    <div class="container-custom">
        <div class="text-center mb-14">
            <h2 class="section-title">Why Choose Lenz Breeze?</h2>
            <p class="section-subtitle mx-auto">Excellence in optical manufacturing, driven by cutting-edge technology and an unwavering commitment to quality vision for everyone.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $highlights = [
                    ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>', 'number' => '5000+', 'label' => 'Happy Customers', 'desc' => 'Across India and worldwide'],
                    ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>', 'number' => '2', 'label' => 'Branches', 'desc' => 'Cochin & Trivandrum'],
                    ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>', 'number' => 'ISO', 'label' => 'Certified', 'desc' => 'International quality standards'],
                    ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>', 'number' => '2024', 'label' => 'Established', 'desc' => 'Optical manufacturing excellence'],
                ];
            @endphp
            @foreach($highlights as $item)
                <div class="card p-6 text-center group">
                    <div class="w-14 h-14 rounded-xl bg-accent-50 text-accent-600 flex items-center justify-center mx-auto mb-4 group-hover:bg-accent-500 group-hover:text-white transition-colors">
                        {!! $item['icon'] !!}
                    </div>
                    <div class="text-3xl font-display font-bold text-brand-500">{{ $item['number'] }}</div>
                    <div class="text-sm font-semibold text-warm-700 mt-1">{{ $item['label'] }}</div>
                    <p class="text-xs text-warm-400 mt-1">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Seamless Sight Section --}}
<section class="section-padding bg-gradient-to-r from-brand-900 to-brand-800 relative overflow-hidden" data-animate>
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
    </div>
    <div class="container-custom relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-accent-500/20 border border-accent-500/30 text-accent-300 text-xs font-bold uppercase tracking-widest mb-6">
                    Eye Mek Innovation
                </div>
                <h2 class="font-display text-4xl md:text-5xl font-bold text-white leading-tight">
                    {{ $promoProduct->tagline ?? 'Seamless Sight. Absolute Protection.' }}
                </h2>
                <p class="text-white/70 text-lg mt-6 leading-relaxed">
                    {{ Str::limit(strip_tags($promoProduct->description ?? 'Move through your day with zero interruptions. Our Premium Progressive RX Lenses offer a smooth transition from far to near.'), 180) }}
                </p>
                
                <div class="mt-8 space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center shrink-0 border border-white/20">
                            <span class="text-xl">🛡️</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-white">Blue Cut & Anti-Glare</h3>
                            <p class="text-white/60 text-sm">Relaxed, flicker-free vision for your digital workspace.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center shrink-0 border border-white/20">
                            <span class="text-xl">🌤️</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-white">Photochromic Tech</h3>
                            <p class="text-white/60 text-sm">Lenses that intuitively darken the moment you step outside.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center shrink-0 border border-white/20">
                            <span class="text-xl">🕶️</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-white">Polarized Precision</h3>
                            <p class="text-white/60 text-sm">Maximum clarity and glare-blocking for driving and travel.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-10 p-4 rounded-xl bg-white/5 border border-white/10 inline-block">
                    <p class="text-accent-400 font-display font-medium"><span class="text-white italic">No lines. No limits. Just perfect vision.</span></p>
                </div>
            </div>
            
            <div class="order-1 lg:order-2">
                <div class="relative">
                    <div class="absolute -inset-4 bg-accent-500/20 blur-3xl rounded-full"></div>
                    <div class="glass-card overflow-hidden ring-1 ring-white/20 shadow-2xl rounded-2xl">
                        <img src="https://images.unsplash.com/photo-1591076482161-42ce6da69f67?w=800&h=800&fit=crop&auto=format" alt="Premium Eye Mek Progressive Optical Lens" width="800" height="800" class="w-full h-auto grayscale hover:grayscale-0 transition-all duration-700">
                        <div class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-black/80 to-transparent">
                            <div class="text-white/50 text-xs font-bold uppercase tracking-widest">{{ $promoProduct->brand ?? 'Eye Mek Series' }}</div>
                            <div class="text-white font-display text-xl font-bold">{{ $promoProduct->name ?? 'Premium Progressive RX' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if(isset($featuredProducts) && $featuredProducts->count() > 0)
<section class="section-padding bg-warm-50" data-animate>
    <div class="container-custom">
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between mb-12 gap-4">
            <div>
                <h2 class="section-title">Featured Products</h2>
                <p class="section-subtitle">Our most popular lenses, trusted by optical professionals across India.</p>
            </div>
            <a href="{{ route('products') }}" class="btn-secondary text-sm !py-2.5">
                View All Products
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts ?? [] as $product)
                @if($product)
                <a href="{{ route('products.show', $product->slug ?? '#') }}" class="card group">
                    <div class="aspect-[4/3] bg-gradient-to-br from-brand-50 to-accent-50 flex items-center justify-center relative overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-contain p-4 transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="text-6xl opacity-20 font-display font-bold text-brand-300 relative z-10">{{ substr($product->name ?? 'LB', 0, 2) }}</div>
                        @endif
                        <div class="absolute top-3 left-3 z-10">
                            <span class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold {{ ($product->brand ?? '') === 'Eye Mek' ? 'bg-brand-500 text-white' : 'bg-warm-800 text-white' }}">{{ $product->brand ?? 'Eye Mek' }}</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-display font-bold text-lg text-brand-500 group-hover:text-accent-600 transition-colors">{{ $product->name ?? 'Unnamed Product' }}</h3>
                        <p class="text-sm text-warm-400 mt-0.5">{{ $product->tagline ?? '' }}</p>
                        <div class="flex flex-wrap gap-1.5 mt-3">
                            @if(isset($product->technologies) && is_array($product->technologies))
                                @foreach(array_slice($product->technologies, 0, 2) as $tech)
                                    <span class="px-2 py-0.5 rounded-md bg-accent-50 text-accent-700 text-xs font-medium">{{ $tech }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </a>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Technologies Overview --}}
<section class="section-padding bg-white" data-animate>
    <div class="container-custom">
        <div class="text-center mb-14">
            <h2 class="section-title">Our Technologies</h2>
            <p class="section-subtitle mx-auto">Cutting-edge lens technologies for every lifestyle and visual need.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $techs = [
                    ['name' => 'Blue Cut', 'desc' => 'Filters harmful blue light from digital screens, reducing eye strain and improving sleep quality.', 'color' => 'from-blue-500 to-blue-700', 'icon' => '🛡️'],
                    ['name' => 'Anti-Glare', 'desc' => 'Multi-layer coating eliminates reflections for crystal-clear vision in all lighting conditions.', 'color' => 'from-teal-500 to-teal-700', 'icon' => '✨'],
                    ['name' => 'Photochromic', 'desc' => 'Intelligent lenses that darken in sunlight and clear indoors — one pair for everywhere.', 'color' => 'from-amber-500 to-orange-600', 'icon' => '🌤️'],
                    ['name' => 'Polarized', 'desc' => 'Superior glare elimination for driving, water sports, and outdoor activities.', 'color' => 'from-purple-500 to-purple-700', 'icon' => '🕶️'],
                ];
            @endphp
            @foreach($techs as $tech)
                <div class="card p-6 group cursor-pointer">
                    <div class="text-3xl mb-3">{{ $tech['icon'] ?? 'ℹ️' }}</div>
                    <h3 class="font-display font-bold text-lg text-brand-500">{{ $tech['name'] ?? 'Technology' }}</h3>
                    <p class="text-sm text-warm-500 mt-2 leading-relaxed">{{ $tech['desc'] ?? '' }}</p>
                    <div class="mt-4 text-accent-600 text-sm font-medium flex items-center gap-1 group-hover:gap-2 transition-all">
                        Learn More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('technologies') }}" class="btn-secondary">Explore All Technologies</a>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="relative gradient-hero overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-20 -left-20 w-80 h-80 rounded-full bg-white/20 blur-3xl"></div>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 rounded-full bg-accent-400/20 blur-3xl"></div>
    </div>
    <div class="container-custom py-20 relative z-10">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="font-display text-3xl md:text-4xl font-bold text-white">Ready to Partner with Us?</h2>
            <p class="text-white/70 mt-4 text-lg">Whether you're an optical retailer, distributor, or industry professional, we'd love to hear from you.</p>
            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <a href="{{ route('contact') }}" class="btn-primary text-base !px-8 !py-4 !bg-white !text-brand-500 hover:!bg-warm-100">Contact Us</a>
                <a href="{{ route('partners') }}" class="btn-outline-white text-base !px-8 !py-4">Partnership Info</a>
            </div>
        </div>
    </div>
</section>
@endsection
