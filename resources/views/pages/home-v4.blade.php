@extends('layouts.app')
@section('title', 'Lenz Breeze - Premium Eyewear Solutions (Titan Style)')
@section('meta_description', 'Experience precision and style with Lenz Breeze. Browse our collection of premium lenses and eyewear designed for clarity and comfort.')

@section('content')
{{-- Clean White Hero --}}
{{-- Premium Immersive Hero --}}
<section class="relative min-h-[85vh] flex items-center overflow-hidden bg-midnight">
    {{-- Background Motion --}}
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1591076482161-42ce6da69f67?w=1600&h=800&fit=crop&auto=format" alt="Lifestyle Eyewear" class="absolute inset-0 w-full h-full object-cover opacity-60 scale-105 animate-pulse-slow">
        <div class="absolute inset-0 bg-gradient-to-r from-midnight via-midnight/60 to-transparent"></div>
    </div>

    <div class="container-custom relative z-10 py-20">
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-6 animate-fade-in">
                <span class="w-12 h-[2px] bg-gold"></span>
                <h2 class="text-gold text-sm font-black tracking-[0.3em] uppercase">Lenz Breeze Precision 2024</h2>
            </div>
            
            <h1 class="text-5xl md:text-8xl font-display font-black text-white leading-[0.9] mb-8 animate-fade-in-up">
                Perfect <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold to-tech-cyan">Vision.</span><br>
                Superior Style.
            </h1>
            
            <p class="text-white/70 text-lg md:text-xl max-w-xl mb-10 leading-relaxed animate-fade-in-up delay-100">
                Experience the world in ultra-high definition with Lenz Breeze's advanced optical engineering. Crafted for those who demand excellence.
            </p>

            <div class="flex flex-wrap gap-6 animate-fade-in-up delay-200">
                <a href="{{ route('products') }}" class="px-10 py-4 bg-gold text-midnight font-black rounded-full hover:bg-white hover:shadow-[0_0_30px_rgba(212,175,55,0.4)] transition-all duration-500 transform hover:-translate-y-1">
                    Explore Collection
                </a>
                <a href="{{ route('technologies') }}" class="px-10 py-4 bg-white/10 backdrop-blur-md border border-white/20 text-white font-black rounded-full hover:bg-white/20 transition-all duration-500">
                    Our Technology
                </a>
            </div>
        </div>
    </div>

    {{-- Floating HUD Element --}}
    <div class="absolute bottom-12 right-12 hidden lg:block animate-float">
        <div class="glass-premium p-6 rounded-3xl border-white/30 max-w-xs">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-10 h-10 rounded-full bg-tech-cyan/20 flex items-center justify-center">
                    <span class="text-tech-cyan text-xl">🛡️</span>
                </div>
                <h4 class="text-midnight font-black text-sm uppercase tracking-wider">Blue-Cut Tech</h4>
            </div>
            <p class="text-midnight/60 text-xs font-bold leading-relaxed">
                Integrated molecular filtering for total digital eye protection.
            </p>
        </div>
    </div>
</section>

{{-- Category Story-Line (Instagram Style) --}}
<section class="py-12 bg-white relative z-20 -mt-10 mb-10">
    <div class="container-custom">
        <div class="glass-premium p-8 rounded-[3rem] border-white shadow-2xl flex flex-wrap justify-center gap-8 md:gap-14">
            @php
                $categories = [
                    ['name' => 'Men', 'icon' => '👨', 'color' => 'bg-blue-100'],
                    ['name' => 'Women', 'icon' => '👩', 'color' => 'bg-pink-100'],
                    ['name' => 'Blue Lenses', 'icon' => '🛡️', 'color' => 'bg-cyan-100'],
                    ['name' => 'Polarized', 'icon' => '🕶️', 'color' => 'bg-slate-100'],
                    ['name' => 'Photochromic', 'icon' => '🌤️', 'color' => 'bg-amber-100'],
                ];
            @endphp
            @foreach($categories as $cat)
                <a href="{{ route('products') }}" class="group flex flex-col items-center">
                    <div class="relative p-1 rounded-full bg-gradient-to-tr from-gold to-tech-cyan group-hover:scale-110 transition-transform duration-500">
                        <div class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-white flex items-center justify-center text-3xl md:text-4xl border-4 border-white">
                            {{ $cat['icon'] }}
                        </div>
                    </div>
                    <span class="mt-3 text-xs md:text-sm font-black text-midnight uppercase tracking-widest group-hover:text-gold transition-colors">{{ $cat['name'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Premium Product Showcase --}}
<section class="py-24 bg-warm-50">
    <div class="container-custom">
        <div class="flex flex-col md:flex-row items-end justify-between mb-16 gap-6">
            <div class="max-w-xl">
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-8 h-1 bg-gold rounded-full"></span>
                    <span class="text-gold font-black uppercase text-xs tracking-[0.2em]">Exclusives</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-display font-black text-midnight">Curated Collections</h2>
            </div>
            <a href="{{ route('products') }}" class="group flex items-center gap-3 text-midnight font-black uppercase text-sm tracking-widest">
                View All Masterpieces 
                <span class="w-10 h-10 rounded-full bg-white flex items-center justify-center group-hover:bg-gold transition-all duration-500 shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            @foreach($featuredProducts ?? [] as $product)
                <div class="group relative">
                    <div class="aspect-[4/5] rounded-[2.5rem] bg-white overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.03)] border border-white transition-all duration-700 group-hover:shadow-[0_20px_60px_rgba(0,0,0,0.08)] group-hover:-translate-y-2">
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-contain p-10 transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center text-6xl font-black text-warm-100">EYE</div>
                        @endif
                        
                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-midnight/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                            <h4 class="text-white font-black text-xl mb-2">{{ $product->name }}</h4>
                            <p class="text-white/60 text-xs mb-6 font-bold uppercase tracking-tight">{{ $product->tagline }}</p>
                            <a href="{{ route('products.show', $product->slug) }}" class="w-full py-4 bg-gold text-midnight text-center font-black rounded-2xl hover:bg-white transition-colors">
                                View Details
                            </a>
                        </div>

                        <div class="absolute top-6 left-6">
                            <span class="glass-premium px-4 py-1.5 rounded-full text-[10px] uppercase font-black tracking-widest text-midnight">Premium</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Technology Blueprint (Neo-Bento) --}}
<section class="py-24 bg-midnight relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 hud-grid-bg"></div>
    <div class="container-custom relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-5">
                <h2 class="text-gold font-black uppercase text-sm tracking-[0.3em] mb-6">The Science of Sight</h2>
                <h3 class="text-4xl md:text-6xl font-display font-black text-white leading-tight mb-8">
                    Beyond <br>
                    <span class="text-tech-cyan">Conventional</span> <br>
                    Optics.
                </h3>
                <p class="text-white/60 text-lg mb-10 leading-relaxed">
                    Our lenses integrate multiple layers of nano-technology to provide unrivaled clarity, durability, and protection.
                </p>
                <a href="{{ route('technologies') }}" class="inline-flex items-center gap-4 text-tech-cyan font-black uppercase text-sm tracking-widest group">
                    Explore Our Lab 
                    <span class="w-12 h-[2px] bg-tech-cyan group-hover:w-20 transition-all duration-500"></span>
                </a>
            </div>
            
            <div class="lg:col-span-7 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="glass-dark p-10 rounded-[2.5rem] border-white/10 hover:border-gold/30 transition-all duration-500">
                    <span class="text-4xl mb-6 block">🔬</span>
                    <h4 class="text-white font-black text-xl mb-4">Precision Molding</h4>
                    <p class="text-white/40 text-sm font-bold leading-relaxed">Cast with surgical precision using European machinery for zero-distortion vision.</p>
                </div>
                <div class="glass-dark p-10 rounded-[2.5rem] border-white/10 hover:border-tech-cyan/30 transition-all duration-500 mt-6 md:mt-12">
                    <span class="text-4xl mb-6 block">🛡️</span>
                    <h4 class="text-white font-black text-xl mb-4">Hybrid Coatings</h4>
                    <p class="text-white/40 text-sm font-bold leading-relaxed">9 layers of anti-reflective, anti-static, and hydrophobic protection.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Premium Ticker (Trust) --}}
<div class="py-16 bg-white overflow-hidden relative">
    <div class="absolute inset-0 bg-gradient-to-r from-white via-transparent to-white z-10 pointer-events-none"></div>
    <div class="flex whitespace-nowrap gap-24 animate-marquee items-center">
        @for($i = 0; $i < 6; $i++)
            <div class="flex items-center gap-4">
                <span class="w-2 h-2 rounded-full bg-gold"></span>
                <span class="text-xl font-display font-black text-midnight tracking-[0.2em] uppercase">Lenz Breeze OPTICS</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="w-2 h-2 rounded-full bg-tech-cyan"></span>
                <span class="text-xl font-display font-black text-midnight tracking-[0.2em] uppercase">PRECISION JAPAN TECH</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="w-2 h-2 rounded-full bg-gold"></span>
                <span class="text-xl font-display font-black text-midnight tracking-[0.2em] uppercase">GERMAN COATING SYSTEMS</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="w-2 h-2 rounded-full bg-tech-cyan"></span>
                <span class="text-xl font-display font-black text-midnight tracking-[0.2em] uppercase">BLUE CUT MASTER</span>
            </div>
        @endfor
    </div>
</div>

{{-- Final CTA --}}
<section class="py-32 bg-midnight relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gold/5 blur-[120px] rounded-full"></div>
    <div class="container-custom relative z-10 text-center">
        <h2 class="text-5xl md:text-7xl font-display font-black text-white leading-tight mb-8">Ready for a <span class="text-gold">Vision</span> Upgrade?</h2>
        <p class="text-white/50 text-xl max-w-2xl mx-auto mb-12 italic">Join the elite who refuse to compromise on clarity.</p>
        <div class="flex flex-wrap justify-center gap-6">
            <a href="{{ route('contact') }}" class="px-12 py-5 bg-gold text-midnight font-black rounded-2xl hover:scale-105 transition-all duration-500">Contact Expert</a>
            <a href="{{ route('partners') }}" class="px-12 py-5 bg-white/5 text-white border border-white/20 font-black rounded-2xl hover:bg-white/10 transition-all duration-500">Find Store</a>
        </div>
    </div>
</section>
@endsection
