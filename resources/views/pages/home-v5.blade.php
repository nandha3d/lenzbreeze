@extends('layouts.app')
@section('title', 'Lenz Breeze - Premium Optical Lenses | Home')
@section('meta_description', 'Lenz Breeze - India\'s trusted manufacturer of premium optical lenses since 2005. Advanced Blue Cut, Anti-Glare, Photochromic and Polarized technologies. 500+ partners nationwide.')

@section('content')

{{-- ============================================================
     SECTION 1: HERO — Interactive Lens Reveal + Animated Split
     ============================================================ --}}
<section class="hero-section relative min-h-[92vh] flex items-center gradient-hero overflow-hidden" x-data="heroCarousel()">

    {{-- Lens blur panes (existing JS handles these) --}}
    <div id="lens-pane-top" class="hero-blur-pane" style="position:absolute;left:0;right:0;z-index:50;backdrop-filter:blur(5px);-webkit-backdrop-filter:blur(5px);background:rgba(0,0,0,0.3);-webkit-mask-image:linear-gradient(to bottom,black calc(100% - 50px),transparent 100%);mask-image:linear-gradient(to bottom,black calc(100% - 50px),transparent 100%);"></div>
    <div id="lens-pane-bottom" class="hero-blur-pane" style="position:absolute;left:0;right:0;z-index:50;backdrop-filter:blur(5px);-webkit-backdrop-filter:blur(5px);background:rgba(0,0,0,0.3);-webkit-mask-image:linear-gradient(to top,black calc(100% - 50px),transparent 100%);mask-image:linear-gradient(to top,black calc(100% - 50px),transparent 100%);"></div>
    <div class="hero-lens-cursor"></div>

    {{-- Ambient blobs --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="glass-ball w-40 h-40 top-16 left-8 animate-float" data-parallax="-0.15" style="opacity:0.4"></div>
        <div class="glass-ball w-24 h-24 bottom-28 right-1/4 animate-float-delayed" data-parallax="-0.25" style="opacity:0.3"></div>
        <div class="glass-ball w-16 h-16 top-1/3 right-12 animate-float" style="animation-duration:7s;opacity:0.25" data-parallax="-0.35"></div>
        <div class="absolute top-1/4 right-1/4 w-80 h-80 rounded-full bg-accent-500/10 blur-[100px]" data-parallax="-0.1"></div>
        <div class="absolute bottom-1/4 left-1/3 w-64 h-64 rounded-full bg-brand-300/10 blur-[80px]" data-parallax="-0.2"></div>
    </div>

    <div class="container-custom relative z-10 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center min-h-[80vh]">

            {{-- Left: Text Content (slides) --}}
            <div class="relative">
                {{-- Slide 1 --}}
                <div x-show="slide === 0" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-400" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-8">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white/80 text-xs font-semibold tracking-widest uppercase mb-6">
                        <span class="w-2 h-2 rounded-full bg-accent-400 animate-pulse"></span>
                        Premium Optical Solutions Since 2005
                    </div>
                    <h1 class="font-display text-5xl md:text-6xl lg:text-[4.5rem] font-bold text-white leading-[1.1] mb-6">
                        See the World with <br><span class="text-accent-300">Crystal Clarity</span>
                    </h1>
                    <p class="text-lg text-white/65 max-w-lg leading-relaxed mb-8">
                        India's trusted manufacturer of premium optical lenses. Advanced technologies, meticulous craftsmanship, and a commitment to perfection.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('products') }}" class="btn-primary shimmer-hover text-base !px-8 !py-4">
                            Explore Products
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="{{ route('contact') }}" class="btn-outline-white text-base !px-8 !py-4">Get in Touch</a>
                    </div>
                </div>

                {{-- Slide 2 --}}
                <div x-show="slide === 1" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-400" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-8">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-accent-500/20 border border-accent-400/30 text-accent-300 text-xs font-bold tracking-widest uppercase mb-6">
                        <span class="w-2 h-2 rounded-full bg-accent-400"></span>
                        Eye Mek Progressive Series
                    </div>
                    <h1 class="font-display text-5xl md:text-6xl lg:text-[4.5rem] font-bold text-white leading-[1.1] mb-6">
                        No Lines. <br><span class="text-accent-300">No Limits.</span><br>Just Perfect Vision.
                    </h1>
                    <p class="text-lg text-white/65 max-w-lg leading-relaxed mb-8">
                        Our Eye Mek Progressive RX lenses offer seamless transitions from distance to near — engineered with HD Digital technology for uncompromising clarity.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('products.show', 'premium-progressive-rx') }}" class="btn-primary shimmer-hover text-base !px-8 !py-4">
                            View Progressive Range
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="{{ route('technologies') }}" class="btn-outline-white text-base !px-8 !py-4">Our Technologies</a>
                    </div>
                </div>

                {{-- Slide 3 --}}
                <div x-show="slide === 2" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-400" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-8">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-white/80 text-xs font-bold tracking-widest uppercase mb-6">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-ping"></span>
                        500+ Partners Nationwide
                    </div>
                    <h1 class="font-display text-5xl md:text-6xl lg:text-[4.5rem] font-bold text-white leading-[1.1] mb-6">
                        Your Trusted <br><span class="text-accent-300">Lens Partner</span><br>Across India.
                    </h1>
                    <p class="text-lg text-white/65 max-w-lg leading-relaxed mb-8">
                        With 4 state-of-the-art manufacturing facilities and 20+ years of expertise, we power optical stores from Kerala to Kashmir.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('partners') }}" class="btn-primary shimmer-hover text-base !px-8 !py-4">
                            Become a Partner
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="{{ route('about') }}" class="btn-outline-white text-base !px-8 !py-4">Our Story</a>
                    </div>
                </div>

                {{-- Slide dots --}}
                <div class="flex items-center gap-3 mt-10">
                    <template x-for="i in 3" :key="i">
                        <button @click="goTo(i-1)" :class="slide === i-1 ? 'w-8 bg-accent-400' : 'w-2 bg-white/30 hover:bg-white/60'" class="h-2 rounded-full transition-all duration-300"></button>
                    </template>
                    <span class="ml-3 text-white/40 text-xs font-mono" x-text="(slide+1) + ' / 3'"></span>
                    {{-- Pause/play --}}
                    <button @click="paused = !paused" class="ml-auto w-8 h-8 rounded-full bg-white/10 border border-white/20 flex items-center justify-center text-white/60 hover:bg-white/20 transition-all">
                        <svg x-show="!paused" class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
                        <svg x-show="paused" class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                </div>
            </div>

            {{-- Right: Product/Visual --}}
            <div class="hidden lg:flex items-center justify-center relative">
                <div class="absolute -inset-10 bg-accent-500/15 blur-[80px] rounded-full pointer-events-none"></div>

                {{-- Slide 0 image --}}
                <div x-show="slide === 0" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" class="relative">
                    <img src="https://images.unsplash.com/photo-1574258495973-f010dfbb5371?w=600&h=600&fit=crop&auto=format" alt="Premium Spectacles" class="w-[400px] h-[400px] object-cover rounded-full ring-4 ring-white/20 shadow-2xl relative z-10">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-[460px] h-[460px] rounded-full border-[1.5px] border-white/15 animate-[spin_25s_linear_infinite]"></div>
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-[510px] h-[510px] rounded-full border-[1px] border-accent-500/20 animate-[spin_35s_linear_infinite_reverse]"></div>
                    </div>
                    {{-- Floating badge --}}
                    <div class="absolute -bottom-4 -right-4 bg-white rounded-2xl shadow-xl p-4 z-20 max-w-[180px]">
                        <div class="flex items-center gap-2 mb-1">
                            <img src="{{ asset('images/logo-icon.avif') }}" class="w-7 h-7 object-contain" alt="Lenz Breeze">
                            <span class="font-display font-bold text-brand-500 text-sm">Eye Mek</span>
                        </div>
                        <div class="text-[10px] text-warm-400 font-semibold uppercase tracking-wider">Premium Collections · Est. 2005</div>
                    </div>
                </div>

                {{-- Slide 1 image --}}
                <div x-show="slide === 1" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" class="relative">
                    <img src="{{ asset('images/products/premium-progressive-rx.avif') }}" alt="Progressive RX" class="w-[380px] h-[380px] object-contain drop-shadow-2xl relative z-10" onerror="this.src='https://images.unsplash.com/photo-1591076482161-42ce6da69f67?w=600&h=600&fit=crop&auto=format';this.classList.add('rounded-full','object-cover')">
                    <div class="absolute -top-6 -left-6 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-4 z-20">
                        <div class="text-white/50 text-[10px] font-bold uppercase tracking-widest">Eye Mek</div>
                        <div class="text-white font-display font-bold text-sm">Premium Progressive RX</div>
                        <div class="flex gap-1 mt-2">
                            <span class="px-2 py-0.5 rounded-md bg-accent-500/20 text-accent-300 text-[10px] font-semibold">Progressive</span>
                            <span class="px-2 py-0.5 rounded-md bg-accent-500/20 text-accent-300 text-[10px] font-semibold">HD Digital</span>
                        </div>
                    </div>
                </div>

                {{-- Slide 2 image --}}
                <div x-show="slide === 2" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" class="relative">
                    <div class="w-[380px] h-[380px] rounded-3xl bg-white/5 border border-white/10 backdrop-blur-sm flex flex-col items-center justify-center gap-6 p-8 z-10 relative">
                        <div class="grid grid-cols-2 gap-4 w-full">
                            @php $mapStats = [['num'=>'4','lab'=>'Facilities','icon'=>'🏭'],['num'=>'500+','lab'=>'Partners','icon'=>'🤝'],['num'=>'20+','lab'=>'Years','icon'=>'⭐'],['num'=>'ISO','lab'=>'Certified','icon'=>'🏆']]; @endphp
                            @foreach($mapStats as $s)
                            <div class="bg-white/8 border border-white/10 rounded-2xl p-4 text-center">
                                <div class="text-2xl mb-1">{{ $s['icon'] }}</div>
                                <div class="font-display font-bold text-white text-xl">{{ $s['num'] }}</div>
                                <div class="text-white/50 text-xs font-medium">{{ $s['lab'] }}</div>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <div class="text-white/40 text-xs font-bold uppercase tracking-widest mb-1">Manufacturing Excellence</div>
                            <div class="text-white font-display font-semibold text-lg">Trivandrum, Kerala</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom gradient blend --}}
    <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-warm-50 to-transparent pointer-events-none z-20"></div>

    {{-- Prev / Next arrows --}}
    <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 z-30 w-10 h-10 rounded-full bg-white/10 border border-white/20 flex items-center justify-center text-white hover:bg-white/20 transition-all hidden lg:flex">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 z-30 w-10 h-10 rounded-full bg-white/10 border border-white/20 flex items-center justify-center text-white hover:bg-white/20 transition-all hidden lg:flex">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>
</section>


{{-- ============================================================
     SECTION 2: ANIMATED STATS TICKER
     ============================================================ --}}
<section class="bg-white border-b border-warm-100" data-animate>
    <div class="container-custom">
        <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-warm-100">
            @php
            $stats = [
                ['number' => 4,    'suffix' => '',  'label' => 'Manufacturing Facilities', 'desc' => 'Across India', 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>'],
                ['number' => 500,  'suffix' => '+', 'label' => 'Partner Optical Stores', 'desc' => 'Nationwide', 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>'],
                ['number' => 20,   'suffix' => '+', 'label' => 'Years of Excellence', 'desc' => 'Est. 2005', 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>'],
                ['number' => 0,    'suffix' => 'ISO', 'label' => 'Quality Certified', 'desc' => 'ISO 9001:2015', 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z"/></svg>'],
            ];
            @endphp
            @foreach($stats as $i => $stat)
            <div class="py-8 px-6 md:px-10 text-center group" x-data="countUp({{ $stat['number'] }}, '{{ $stat['suffix'] }}')" x-intersect.once="start()">
                <div class="w-12 h-12 rounded-xl bg-accent-50 text-accent-600 flex items-center justify-center mx-auto mb-3 group-hover:bg-accent-500 group-hover:text-white transition-colors duration-300">
                    {!! $stat['icon'] !!}
                </div>
                <div class="font-display font-black text-3xl md:text-4xl text-brand-500">
                    @if($stat['number'] === 0)
                        <span>ISO</span>
                    @else
                        <span x-text="display + '{{ $stat['suffix'] }}'">0{{ $stat['suffix'] }}</span>
                    @endif
                </div>
                <div class="text-sm font-bold text-warm-700 mt-1">{{ $stat['label'] }}</div>
                <div class="text-xs text-warm-400 mt-0.5">{{ $stat['desc'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 3: TWO BRANDS — Interactive Split Cards
     ============================================================ --}}
<section class="section-padding bg-warm-50" data-animate>
    <div class="container-custom">
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1 rounded-full bg-accent-50 text-accent-700 text-xs font-bold uppercase tracking-widest mb-4">Our Collections</span>
            <h2 class="section-title">One Brand. One Standard of Excellence.</h2>
            <p class="section-subtitle mx-auto">Eye Mek precision engineering across all segments — from our flagship premium range to our accessible value line.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Lenz Breeze Premium Card --}}
            <div class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-brand-600 via-brand-700 to-brand-900 p-8 md:p-10 min-h-[380px] flex flex-col justify-between cursor-pointer transition-all duration-500 hover:shadow-2xl" style="box-shadow: 0 20px 60px rgba(14,53,88,0.25);">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-10 transition-opacity duration-500 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
                <div class="absolute -bottom-20 -right-20 w-72 h-72 rounded-full bg-accent-500/10 blur-3xl group-hover:bg-accent-500/20 transition-all duration-700"></div>
                <div class="absolute top-8 right-8">
                    <img src="{{ asset('images/logo-icon.avif') }}" alt="Lenz Breeze" class="w-12 h-12 object-contain opacity-60 group-hover:opacity-90 transition-opacity group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="relative z-10">
                    <div class="inline-block px-3 py-1 rounded-full bg-white/10 border border-white/20 text-accent-300 text-xs font-bold uppercase tracking-widest mb-6">Eye Mek Premium Range</div>
                    <h3 class="font-display text-4xl font-bold text-white mb-3">High Performance</h3>
                    <p class="text-white/60 text-sm leading-relaxed max-w-sm">Advanced free-form digital surfacing and multi-layer AR coatings for discerning optical professionals who demand nothing but the best.</p>
                </div>
                <div class="relative z-10">
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach(['Progressive', 'Photochromic', 'Polarized', 'Anti-Glare'] as $tag)
                        <span class="px-3 py-1 rounded-full bg-white/10 border border-white/15 text-white/70 text-xs font-semibold">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <a href="{{ route('products') }}" class="inline-flex items-center gap-2 text-accent-300 font-bold text-sm hover:gap-3 transition-all group-hover:text-white">
                        View Premium Collections
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>

            {{-- Lenz Breeze Value Card --}}
            <div class="group relative overflow-hidden rounded-3xl p-8 md:p-10 min-h-[380px] flex flex-col justify-between cursor-pointer transition-all duration-500 hover:shadow-2xl" style="background: linear-gradient(135deg, #2D2D2D 0%, #1A1A1A 50%, #111111 100%); box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-20 transition-opacity duration-500" style="background: linear-gradient(135deg, #f0b61a22, transparent)"></div>
                <div class="absolute -bottom-20 -right-20 w-72 h-72 rounded-full blur-3xl transition-all duration-700" style="background: rgba(240,182,26,0.08); group-hover:background: rgba(240,182,26,0.18)"></div>
                <div class="absolute top-8 right-8">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center font-display font-black text-xl opacity-70 group-hover:opacity-100 group-hover:scale-110 transition-all duration-500" style="background: #f0b61a; color: #0e3558;">EM</div>
                </div>
                <div class="relative z-10">
                    <div class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-6 border" style="background: rgba(240,182,26,0.15); border-color: rgba(240,182,26,0.3); color: #f0b61a;">Eye Mek Value Range</div>
                    <h3 class="font-display text-4xl font-bold text-white mb-3">Everyday Quality</h3>
                    <p class="text-white/60 text-sm leading-relaxed max-w-sm">Quality optical lenses engineered for everyday value without compromise. The trusted choice for high-volume optical retailers across India.</p>
                </div>
                <div class="relative z-10">
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach(['Single Vision', 'Bifocal', 'Blue Cut', 'Anti-Glare'] as $tag)
                        <span class="px-3 py-1 rounded-full text-xs font-semibold border" style="background: rgba(240,182,26,0.1); border-color: rgba(240,182,26,0.2); color: rgba(255,255,255,0.7);">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <a href="{{ route('products') }}" class="inline-flex items-center gap-2 font-bold text-sm hover:gap-3 transition-all" style="color: #f0b61a;">
                        View Value Collections
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 4: FEATURED PRODUCTS — Hover-rich cards
     ============================================================ --}}
@if(isset($featuredProducts) && $featuredProducts->count() > 0)
<section class="section-padding bg-white" data-animate>
    <div class="container-custom">
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="inline-block px-4 py-1 rounded-full bg-brand-50 text-brand-600 text-xs font-bold uppercase tracking-widest mb-4">Featured Products</span>
                <h2 class="section-title">Trusted by Optical Professionals</h2>
                <p class="section-subtitle">Our most popular lenses, used by 500+ stores across India.</p>
            </div>
            <a href="{{ route('products') }}" class="btn-secondary text-sm !py-2.5 shrink-0">
                View All Products
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
            <a href="{{ route('products.show', $product->slug ?? '#') }}" class="card group flex flex-col">
                <div class="aspect-[4/3] bg-gradient-to-br from-brand-50 to-accent-50 relative overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-contain p-4 transition-transform duration-500 group-hover:scale-110">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="lens-placeholder w-24 h-24 relative"></div>
                        </div>
                    @endif
                    {{-- Brand badge --}}
                    <div class="absolute top-3 left-3">
                        <span class="inline-block px-2.5 py-1 rounded-full text-xs font-bold {{ ($product->brand ?? '') === 'Lenz Breeze' ? 'bg-brand-500 text-white' : 'bg-warm-800 text-white' }}">
                            {{ $product->brand ?? 'Premium' }}
                        </span>
                    </div>
                    {{-- Hover overlay --}}
                    <div class="absolute inset-0 bg-brand-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="px-5 py-2 rounded-full bg-white text-brand-500 text-sm font-bold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">View Details →</span>
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col">
                    <h3 class="font-display font-bold text-base text-brand-500 group-hover:text-accent-600 transition-colors leading-tight">{{ $product->name }}</h3>
                    <p class="text-xs text-warm-400 mt-1 italic">{{ $product->tagline ?? '' }}</p>
                    <div class="flex flex-wrap gap-1.5 mt-3 flex-1 items-end">
                        @if(isset($product->technologies) && is_array($product->technologies))
                            @foreach(array_slice($product->technologies, 0, 3) as $tech)
                                <span class="px-2 py-0.5 rounded-md bg-accent-50 text-accent-700 text-[10px] font-bold uppercase tracking-wide">{{ $tech }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ============================================================
     SECTION 5: PROMO / INNOVATION BANNER (full-width dark)
     ============================================================ --}}
<section class="section-padding bg-gradient-to-br from-brand-900 via-brand-800 to-brand-900 relative overflow-hidden" data-animate>
    <div class="absolute inset-0 opacity-5 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
    <div class="absolute top-0 right-0 w-1/3 h-full bg-accent-500/5 blur-[120px]"></div>
    <div class="container-custom relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-accent-500/20 border border-accent-500/30 text-accent-300 text-xs font-bold uppercase tracking-widest mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-accent-400 animate-ping"></span>
                    Lenz Breeze Innovation
                </div>
                <h2 class="font-display text-4xl md:text-5xl font-bold text-white leading-tight mb-6">
                    {{ $promoProduct->tagline ?? 'Seamless Sight. Absolute Protection.' }}
                </h2>
                <p class="text-white/65 text-lg leading-relaxed mb-8">
                    {{ Str::limit(strip_tags($promoProduct->description ?? 'Advanced progressive lens technology that moves with you — from the boardroom to the outdoors. HD Digital processing for unmatched edge-to-edge clarity.'), 200) }}
                </p>
                <div class="space-y-4 mb-10">
                    @php $features = [['icon'=>'🛡️','title'=>'Blue Cut & Anti-Glare','desc'=>'Relaxed, flicker-free vision for your digital workspace.'],['icon'=>'🌤️','title'=>'Photochromic Tech','desc'=>'Lenses that intuitively darken the moment you step outside.'],['icon'=>'🕶️','title'=>'Polarized Precision','desc'=>'Maximum clarity and glare-blocking for driving and travel.']]; @endphp
                    @foreach($features as $f)
                    <div class="flex items-start gap-4 group">
                        <div class="w-10 h-10 rounded-xl bg-white/8 border border-white/15 flex items-center justify-center shrink-0 group-hover:bg-accent-500/20 transition-colors">
                            <span class="text-lg">{{ $f['icon'] }}</span>
                        </div>
                        <div>
                            <div class="font-bold text-white text-sm">{{ $f['title'] }}</div>
                            <div class="text-white/55 text-xs mt-0.5">{{ $f['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10 inline-block">
                    <p class="text-accent-400 font-display font-medium text-sm italic">"No lines. No limits. Just perfect vision."</p>
                </div>
            </div>
            <div class="order-1 lg:order-2 flex justify-center">
                <div class="relative w-full max-w-md">
                    <div class="absolute -inset-8 bg-accent-500/15 blur-3xl rounded-full"></div>
                    <div class="glass-card overflow-hidden ring-1 ring-white/20 shadow-2xl rounded-2xl relative">
                        <img src="https://images.unsplash.com/photo-1591076482161-42ce6da69f67?w=800&h=800&fit=crop&auto=format" alt="Premium Optical Lenses" class="w-full h-[340px] object-cover grayscale hover:grayscale-0 transition-all duration-700">
                        <div class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-black/80 to-transparent">
                            <div class="text-white/50 text-[10px] font-bold uppercase tracking-widest">{{ $promoProduct->brand ?? 'Eye Mek' }}</div>
                            <div class="text-white font-display text-xl font-bold">{{ $promoProduct->name ?? 'Premium Progressive RX' }}</div>
                            <a href="{{ route('products.show', $promoProduct->slug ?? 'premium-progressive-rx') }}" class="inline-flex items-center gap-1 text-accent-300 text-sm font-semibold mt-2 hover:gap-2 transition-all">
                                View Product Details
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 6: TECHNOLOGIES — Interactive Tab Switcher
     ============================================================ --}}
<section class="section-padding bg-white" data-animate x-data="{ active: 0 }">
    <div class="container-custom">
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1 rounded-full bg-accent-50 text-accent-700 text-xs font-bold uppercase tracking-widest mb-4">Technology</span>
            <h2 class="section-title">Engineered for Every Lifestyle</h2>
            <p class="section-subtitle mx-auto">Cutting-edge lens technologies for every visual need.</p>
        </div>

        @php
        $techs = [
            ['name'=>'Blue Cut','short'=>'Digital Eye Strain Protection','icon'=>'🛡️','color'=>'from-blue-500 to-blue-700','desc'=>'Our proprietary Blue Cut technology filters harmful high-energy blue light emitted from digital screens — reducing eye strain, preventing retinal damage, and improving sleep quality for the modern professional.','benefits'=>['Reduces digital eye strain by up to 40%','Improves contrast and visual comfort','Enhances sleep quality','Available in all Eye Mek Premium and Eye Mek Value ranges']],
            ['name'=>'Anti-Glare','short'=>'Multi-Layer Reflection Control','icon'=>'✨','color'=>'from-teal-500 to-teal-700','desc'=>'Our 7-layer anti-reflective coating eliminates distracting reflections from both sides of the lens. Crystal-clear vision in all lighting conditions — indoors, outdoors, and while driving at night.','benefits'=>['7+ vacuum-deposited AR layers','Reduces reflections by up to 99%','Water and dust repellent top coat','Scratch-resistant hard coating']],
            ['name'=>'Photochromic','short'=>'Intelligent Light-Adaptive Lenses','icon'=>'🌤️','color'=>'from-amber-500 to-orange-600','desc'=>'Eye Mek Photochromic lenses automatically darken in sunlight and return to clear indoors. One pair for every environment — no switching between glasses needed.','benefits'=>['Full clear to dark in 60 seconds','100% UV-A and UV-B protection','Temperature-stable performance','Compatible with all frame styles']],
            ['name'=>'Polarized','short'=>'Superior Glare Elimination','icon'=>'🕶️','color'=>'from-purple-500 to-purple-700','desc'=>'Polarized lenses eliminate blinding horizontal glare from roads, water, and reflective surfaces. Engineered for drivers, outdoor enthusiasts, and anyone who demands maximum visual precision.','benefits'=>['Eliminates horizontal glare 100%','Enhanced contrast and depth perception','Reduces driver fatigue significantly','Premium optical clarity in all conditions']],
        ];
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            {{-- Tab Buttons --}}
            <div class="flex flex-row lg:flex-col gap-3">
                @foreach($techs as $i => $tech)
                <button @click="active = {{ $i }}"
                    :class="active === {{ $i }} ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/20 border-brand-500' : 'bg-white text-warm-600 border-warm-200 hover:border-brand-300 hover:text-brand-500'"
                    class="flex items-center gap-3 px-5 py-4 rounded-2xl border text-left transition-all duration-300 w-full">
                    <span class="text-2xl shrink-0">{{ $tech['icon'] }}</span>
                    <div class="hidden sm:block">
                        <div class="font-bold text-sm">{{ $tech['name'] }}</div>
                        <div :class="active === {{ $i }} ? 'text-white/70' : 'text-warm-400'" class="text-xs mt-0.5 transition-colors">{{ $tech['short'] }}</div>
                    </div>
                    <div class="block sm:hidden">
                        <div class="font-bold text-xs">{{ $tech['name'] }}</div>
                    </div>
                </button>
                @endforeach
            </div>

            {{-- Tab Content --}}
            <div class="lg:col-span-2">
                @foreach($techs as $i => $tech)
                <div x-show="active === {{ $i }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="bg-gradient-to-br {{ $tech['color'] }} rounded-3xl p-8 md:p-10 text-white mb-6">
                        <div class="text-5xl mb-4">{{ $tech['icon'] }}</div>
                        <h3 class="font-display text-3xl font-bold mb-3">{{ $tech['name'] }}</h3>
                        <p class="text-white/75 leading-relaxed">{{ $tech['desc'] }}</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($tech['benefits'] as $benefit)
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-warm-50 border border-warm-100">
                            <div class="w-5 h-5 rounded-full bg-accent-500 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-sm text-warm-700 font-medium">{{ $benefit }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('technologies') }}" class="btn-secondary text-sm !py-2.5">
                            Explore {{ $tech['name'] }} Technology
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 7: MANUFACTURING / FACILITIES PREVIEW
     ============================================================ --}}
<section class="section-padding bg-warm-50" data-animate>
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="inline-block px-4 py-1 rounded-full bg-brand-50 text-brand-600 text-xs font-bold uppercase tracking-widest mb-6">Our Story</span>
                <h2 class="font-display text-4xl md:text-5xl font-bold text-brand-500 leading-tight mb-6">
                    Crafting Vision <br>Since <span class="text-accent-600">2005</span>
                </h2>
                <p class="text-warm-600 leading-relaxed mb-6">
                    Founded in Trivandrum, Kerala, Lenz Breeze began with a simple mission — to make premium optical lenses accessible to everyone. What started as a small workshop has grown into one of India's most trusted lens manufacturers.
                </p>
                <p class="text-warm-600 leading-relaxed mb-8">
                    Today, with four state-of-the-art manufacturing facilities, we produce millions of lenses annually under two brands. Every lens reflects our commitment to precision engineering and uncompromising quality.
                </p>
                <div class="flex flex-wrap gap-3 mb-8">
                    @foreach(['ISO 9001:2015','ISO 14001','CE Marking','FDA Registered'] as $cert)
                    <div class="px-4 py-2 rounded-xl bg-white border border-warm-200 shadow-sm">
                        <span class="font-bold text-brand-500 text-sm">{{ $cert }}</span>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('about') }}" class="btn-primary">
                    Read Our Full Story
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            {{-- Facilities grid --}}
            <div class="grid grid-cols-2 gap-4">
                @php
                $facilities = [
                    ['title'=>'Free-Form Surfacing','desc'=>'CNC-controlled generators with ±0.01D accuracy','icon'=>'⚙️','bg'=>'bg-brand-500'],
                    ['title'=>'Multi-Layer Coating','desc'=>'7+ AR layers via vacuum deposition','icon'=>'🔬','bg'=>'bg-accent-600'],
                    ['title'=>'Quality Control','desc'=>'12-point inspection per lens','icon'=>'✅','bg'=>'bg-green-600'],
                    ['title'=>'Blue Cut Lab','desc'=>'Proprietary substrate technology','icon'=>'🛡️','bg'=>'bg-blue-600'],
                    ['title'=>'Photochromic Unit','desc'=>'Spin coating & imbibing systems','icon'=>'🌤️','bg'=>'bg-amber-600'],
                    ['title'=>'Eco Manufacturing','desc'=>'Water recycling & zero waste','icon'=>'🌿','bg'=>'bg-emerald-600'],
                ];
                @endphp
                @foreach($facilities as $f)
                <div class="card p-5 group hover:border-brand-200 border border-transparent">
                    <div class="w-10 h-10 rounded-xl {{ $f['bg'] }} flex items-center justify-center text-lg mb-3 group-hover:scale-110 transition-transform">
                        {{ $f['icon'] }}
                    </div>
                    <h4 class="font-bold text-brand-500 text-sm mb-1">{{ $f['title'] }}</h4>
                    <p class="text-warm-400 text-xs leading-relaxed">{{ $f['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 8: PARTNER CTA — Full-width gradient
     ============================================================ --}}
<section class="relative gradient-hero overflow-hidden" data-animate>
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-20 -left-20 w-80 h-80 rounded-full bg-white/20 blur-3xl"></div>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 rounded-full bg-accent-400/20 blur-3xl"></div>
    </div>
    <div class="container-custom py-20 md:py-28 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-white/70 text-xs font-bold uppercase tracking-widest mb-8">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Join 500+ Optical Partners
            </div>
            <h2 class="font-display text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                Ready to Partner with Us?
            </h2>
            <p class="text-white/70 text-lg leading-relaxed mb-10 max-w-xl mx-auto">
                Whether you're an optical retailer, distributor, or industry professional — we have the lenses, the support, and the partnership model that works for you.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('contact') }}" class="btn-primary text-base !px-10 !py-4 !bg-white !text-brand-600 hover:!bg-warm-100 !shadow-none">
                    Contact Us
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('partners') }}" class="btn-outline-white text-base !px-10 !py-4">Partnership Info</a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function heroCarousel() {
    return {
        slide: 0,
        paused: false,
        timer: null,
        init() {
            this.startTimer();
        },
        startTimer() {
            this.timer = setInterval(() => {
                if (!this.paused) this.next();
            }, 5000);
        },
        next() { this.slide = (this.slide + 1) % 3; },
        prev() { this.slide = (this.slide + 2) % 3; },
        goTo(i) { this.slide = i; }
    }
}

function countUp(target, suffix) {
    return {
        display: 0,
        started: false,
        start() {
            if (this.started || target === 0) return;
            this.started = true;
            const duration = 1800;
            const step = target / (duration / 16);
            let current = 0;
            const tick = () => {
                current = Math.min(current + step, target);
                this.display = Math.floor(current);
                if (current < target) requestAnimationFrame(tick);
                else this.display = target;
            };
            requestAnimationFrame(tick);
        }
    }
}
</script>
@endpush
