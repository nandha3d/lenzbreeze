@extends('layouts.app')
@section('title', 'Lenz Breeze - Premium Optical Lenses | Home')
@section('meta_description', 'Lenz Breeze - India\'s premier optical lens manufacturer. Premium quality lenses with cutting-edge technology including Blue Cut, Anti-Glare, Photochromic and Polarized lenses.')

@section('content')
{{-- Hero Section --}}
<section class="hero-section relative min-h-[85vh] flex items-center gradient-hero overflow-hidden">
    {{-- Fresh Structural Blur — Inline High-Contrast + 50px Feather (Blur 5px, Lighter) --}}
    <div id="lens-pane-top" class="hero-blur-pane" style="position: absolute; left: 0; right: 0; z-index: 50; backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px); background: rgba(0, 0, 0, 0.3); -webkit-mask-image: linear-gradient(to bottom, black calc(100% - 50px), transparent 100%); mask-image: linear-gradient(to bottom, black calc(100% - 50px), transparent 100%);"></div>
    <div id="lens-pane-bottom" class="hero-blur-pane" style="position: absolute; left: 0; right: 0; z-index: 50; backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px); background: rgba(0, 0, 0, 0.3); -webkit-mask-image: linear-gradient(to top, black calc(100% - 50px), transparent 100%); mask-image: linear-gradient(to top, black calc(100% - 50px), transparent 100%);"></div>
    {{-- Lens cursor circle --}}
    <div class="hero-lens-cursor"></div>

    {{-- Floating Glass Elements (Parallax/Ambient) --}}
    <div class="glass-ball w-32 h-32 top-20 left-10 animate-float" data-parallax="-0.15"></div>
    <div class="glass-ball w-20 h-20 bottom-32 right-1/4 animate-float-delayed" data-parallax="-0.25"></div>
    <div class="glass-ball w-16 h-16 top-1/3 right-10 animate-float" style="animation-duration: 7s;" data-parallax="-0.35"></div>

    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 right-20 w-96 h-96 rounded-full bg-white/20 blur-3xl" data-parallax="-0.1"></div>
        <div class="absolute bottom-20 left-20 w-80 h-80 rounded-full bg-accent-400/20 blur-3xl" data-parallax="-0.2"></div>
    </div>
    <div class="container-custom relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white/80 text-sm mb-6 animate-fade-in">
                    <span class="w-2 h-2 rounded-full bg-accent-400 animate-pulse"></span>
                    Premium Optical Solutions Since 2005
                </div>
                <h1 class="font-display text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-tight animate-fade-in-up">
                    See the World with <span class="text-accent-300">Crystal Clarity</span>
                </h1>
                <p class="text-lg md:text-xl text-white/70 mt-6 max-w-xl animate-fade-in-up delay-200">
                    India's trusted manufacturer of premium optical lenses. Advanced technologies, meticulous craftsmanship, and a commitment to perfection.
                </p>
                <div class="flex flex-wrap gap-4 mt-8 animate-fade-in-up delay-300">
                    <a href="{{ route('products') }}" class="btn-primary shimmer-hover text-base !px-8 !py-4">
                        Explore Products
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ route('contact') }}" class="btn-outline-white shimmer-hover text-base !px-8 !py-4">Get in Touch</a>
                </div>
            </div>
            {{-- Spectacles hero image --}}
            <div class="hidden lg:flex items-center justify-center relative animate-fade-in delay-200">
                <div class="absolute -inset-8 bg-accent-400/10 blur-3xl rounded-full"></div>
                <img src="https://images.unsplash.com/photo-1574258495973-f010dfbb5371?w=600&h=600&fit=crop&auto=format" alt="Premium Spectacles" class="relative w-[420px] h-[420px] object-cover rounded-full ring-4 ring-white/20 shadow-2xl">
                {{-- Decorative spinning lens rings --}}
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-[480px] h-[480px] rounded-full border-[2px] border-white/15 animate-[spin_20s_linear_infinite]"></div>
                </div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-[520px] h-[520px] rounded-full border-[1px] border-white/10 animate-[spin_30s_linear_infinite_reverse]"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Collections Bar --}}
<section class="bg-white border-b border-warm-200/50">
    <div class="container-custom py-8">
        <div class="flex flex-col sm:flex-row items-center justify-center gap-8 md:gap-16">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/EYE-MEK-LOGO_YELLOW (1).avif') }}" alt="Eye Mek icon" class="w-14 h-14 object-contain">
                <div>
                    <span class="font-display font-bold text-lg text-brand-500 uppercase tracking-tight">Eye Mek Premium</span>
                    <span class="block text-xs text-warm-400">High-Performance Range</span>
                </div>
            </div>
            <div class="w-px h-10 bg-warm-200 hidden sm:block"></div>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-warm-800 flex items-center justify-center">
                    <span class="text-white font-bold text-xl font-display">EM</span>
                </div>
                <div>
                    <span class="font-display font-bold text-lg text-warm-800 uppercase tracking-tight">Eye Mek Value</span>
                    <span class="block text-xs text-warm-400">Everyday Quality Range</span>
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
            <p class="section-subtitle mx-auto">Two decades of excellence in optical manufacturing, backed by cutting-edge technology and an unwavering commitment to quality.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $highlights = [
                    ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>', 'number' => '4', 'label' => 'Facilities', 'desc' => 'Manufacturing units across India'],
                    ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>', 'number' => '500+', 'label' => 'Partners', 'desc' => 'Trusted optical partners nationwide'],
                    ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>', 'number' => 'ISO', 'label' => 'Certified', 'desc' => 'International quality standards'],
                    ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>', 'number' => '20+', 'label' => 'Years', 'desc' => 'Of optical manufacturing excellence'],
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
                    Lenz Breeze Innovation
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
                        <img src="https://images.unsplash.com/photo-1591076482161-42ce6da69f67?w=800&h=800&fit=crop&auto=format" alt="Premium Optical Lenses" class="w-full h-auto grayscale hover:grayscale-0 transition-all duration-700">
                        <div class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-black/80 to-transparent">
                            <div class="text-white/50 text-xs font-bold uppercase tracking-widest">{{ $promoProduct->brand ?? 'Lenz Breeze Series' }}</div>
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
                            <span class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold {{ ($product->brand ?? '') === 'Lenz Breeze' ? 'bg-brand-500 text-white' : 'bg-warm-800 text-white' }}">{{ $product->brand ?? 'Premium' }}</span>
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
