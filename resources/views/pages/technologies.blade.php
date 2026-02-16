@extends('layouts.app')
@section('title', 'Technologies - Lenz Breeze')
@section('meta_description', 'Explore Lenz Breeze\'s advanced lens technologies — Blue Cut, Anti-Glare, Photochromic, and Polarized. Learn how our innovations protect and enhance your vision.')

@section('content')
{{-- Page Hero --}}
<section class="gradient-brand py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10"><div class="absolute top-10 right-10 w-64 h-64 rounded-full bg-white/20 blur-3xl"></div></div>
    <div class="container-custom relative z-10">
        <div class="max-w-2xl">
            <h1 class="font-display text-4xl md:text-5xl font-bold text-white">Our Technologies</h1>
            <p class="text-white/70 text-lg mt-4">Cutting-edge lens technologies designed to protect, enhance, and optimize your vision for every lifestyle.</p>
        </div>
    </div>
</section>

{{-- Technologies --}}
@php
    $technologies = [
        [
            'name' => 'Blue Cut Technology', 'emoji' => '🛡️',
            'tagline' => 'Shield Your Eyes from Digital Strain',
            'gradient' => 'from-blue-500 to-indigo-600',
            'bg' => 'bg-blue-50',
            'demo_type' => 'blue-cut',
            'description' => 'In today\'s digital world, our eyes are exposed to harmful blue-violet light (380-455nm) from screens, LED lighting, and sunlight. Blue Cut lenses filter this high-energy visible light while allowing beneficial blue-turquoise light to pass through.',
            'benefits' => ['Reduces digital eye strain and fatigue', 'Improves sleep quality by filtering sleep-disrupting blue light', 'Maintains true color perception (no yellow tint)', 'Protects retinal cells from long-term HEV damage', 'Available in all lens types: SV, Progressive, Bifocal'],
            'specs' => ['Blue Light Block' => '38-42%', 'Wavelength Range' => '380-455nm', 'Color Distortion' => 'Less than 3%', 'Base Coating' => 'Multi-Layer AR'],
        ],
        [
            'name' => 'Anti-Glare Coating', 'emoji' => '✨',
            'tagline' => 'Crystal Clear Vision in Every Light',
            'gradient' => 'from-teal-500 to-emerald-600',
            'bg' => 'bg-teal-50',
            'demo_type' => 'anti-glare',
            'description' => 'Our multi-layer anti-reflective (AR) coating system eliminates surface reflections that cause glare, ghost images, and halos. Using vacuum deposition technology, we apply 7+ layers of precision-engineered coatings for maximum clarity.',
            'benefits' => ['Eliminates up to 99.5% of lens surface reflections', 'Reduces halos and ghost images while driving at night', 'Makes lenses virtually invisible for better cosmetic appearance', 'Hydrophobic and oleophobic top coat repels water and smudges', 'Enhanced durability with DuraGuard hardcoat protection'],
            'specs' => ['AR Layers' => '7+ Layers', 'Residual Reflection' => 'Less than 0.5%', 'Hardcoat Level' => '5H Pencil Test', 'Water Contact Angle' => '110°+'],
        ],
        [
            'name' => 'Photochromic Lenses', 'emoji' => '🌤️',
            'tagline' => 'One Lens for Every Condition',
            'gradient' => 'from-amber-500 to-orange-600',
            'bg' => 'bg-amber-50',
            'demo_type' => 'photochromic',
            'description' => 'Photochromic lenses contain specialized molecules that respond to UV light. When exposed to sunlight, the molecules change structure and darken the lens. When UV exposure decreases, they return to their clear state. Our Gen-8 photochromic molecules offer the fastest, most consistent performance available.',
            'benefits' => ['Activates in under 30 seconds for quick outdoor adaptation', 'Returns to clear in under 5 minutes for indoor comfort', 'Works behind car windshields (dual UV + visible light activation)', 'Consistent performance across temperature ranges', 'Available in gray, brown, and green tint options'],
            'specs' => ['Activation Speed' => 'Less than 30 seconds', 'Fade-Back Time' => 'Less than 5 minutes', 'Max Darkness' => 'Category 3 (85%)', 'Indoor Clarity' => '95% Transmission'],
        ],
        [
            'name' => 'Polarized Lenses', 'emoji' => '🕶️',
            'tagline' => 'Ultimate Glare Elimination',
            'gradient' => 'from-purple-500 to-violet-600',
            'bg' => 'bg-purple-50',
            'demo_type' => 'polarized',
            'description' => 'Polarized lenses contain a precision-aligned polarizing filter that blocks horizontally-oriented reflected light — the type of glare that bounces off roads, water, snow, and flat surfaces. This dramatically improves visual comfort, contrast, and clarity in bright conditions.',
            'benefits' => ['Eliminates 99.9% of reflected glare from surfaces', 'Enhances color contrast and visual clarity outdoors', 'Reduces eye strain during prolonged outdoor activities', 'Essential for driving, fishing, skiing, and water sports', 'Available with prescription correction in SV and Progressive'],
            'specs' => ['Polarizing Efficiency' => '99.9%', 'Impact Resistance' => 'ANSI Z87.1', 'Tint Options' => 'Gray / Brown / Green', 'Available Formats' => 'SV / Progressive'],
        ],
    ];
@endphp

@foreach($technologies as $index => $tech)
<section class="section-padding {{ $index % 2 === 0 ? 'bg-white' : 'bg-warm-50' }}" data-animate>
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center {{ $index % 2 !== 0 ? 'lg:flex-row-reverse' : '' }}">
            <div class="{{ $index % 2 !== 0 ? 'lg:order-2' : '' }}">
                <div class="flex items-center gap-3 mb-3">
                    <span class="text-3xl">{{ $tech['emoji'] }}</span>
                    <span class="text-sm font-semibold text-accent-600 tracking-wider uppercase">Technology</span>
                </div>
                <h2 class="font-display text-3xl font-bold text-brand-500">{{ $tech['name'] }}</h2>
                <p class="text-lg text-accent-600 font-medium mt-1">{{ $tech['tagline'] }}</p>
                <p class="text-warm-600 mt-4 leading-relaxed">{{ $tech['description'] }}</p>

                <div class="mt-6">
                    <h3 class="font-semibold text-warm-700 text-sm uppercase tracking-wider mb-3">Key Benefits</h3>
                    <ul class="space-y-2">
                        @foreach($tech['benefits'] as $benefit)
                            <li class="flex items-start gap-2 text-sm text-warm-600">
                                <svg class="w-4 h-4 text-accent-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                {{ $benefit }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="{{ $index % 2 !== 0 ? 'lg:order-1' : '' }}">
                {{-- Interactive Demo Slider --}}
                <div x-data="{ position: 50, dragging: false }" 
                     class="slider-container mb-6 shadow-2xl border-4 border-white"
                     @mouseup.window="dragging = false" 
                     @mousemove.window="if(dragging) { const rect = $el.getBoundingClientRect(); position = Math.max(0, Math.min(100, (($event.clientX - rect.left) / rect.width) * 100)); }">
                    
                    {{-- Standard/After Image (Base Layer - Full Width) --}}
                    <div class="absolute inset-0 w-full h-full overflow-hidden bg-gray-200">
                        <img src="https://picsum.photos/seed/{{ $tech['demo_type'] }}/800/450" alt="Standard View" class="w-full h-full object-cover">
                        {{-- Effects applied to 'After' (Standard Lens) --}}
                        @if($tech['demo_type'] === 'photochromic')
                            <div class="absolute inset-0 bg-black/60 transition-colors duration-300"></div> {{-- Darkened --}}
                            <div class="absolute top-4 right-4 bg-black/50 text-white px-3 py-1 rounded-full text-xs font-bold backdrop-blur">Outdoor (Sun)</div>
                        @elseif($tech['demo_type'] === 'polarized')
                            <div class="absolute inset-0"></div> {{-- Clear --}}
                            <div class="absolute top-4 right-4 bg-black/50 text-white px-3 py-1 rounded-full text-xs font-bold backdrop-blur">With Polarized</div>
                        @elseif($tech['demo_type'] === 'blue-cut')
                             <div class="absolute top-4 right-4 bg-blue-900/50 text-white px-3 py-1 rounded-full text-xs font-bold backdrop-blur">Blue Cut Protected</div>
                        @elseif($tech['demo_type'] === 'anti-glare')
                             <div class="absolute top-4 right-4 bg-teal-900/50 text-white px-3 py-1 rounded-full text-xs font-bold backdrop-blur">Anti-Glare</div>
                        @endif
                    </div>

                    {{-- Modified/Before Image (Overlay Layer - Clipped) --}}
                    <div class="absolute inset-0 w-full h-full overflow-hidden" 
                         :style="`clip-path: inset(0 ${100 - position}% 0 0)`">
                        <img src="https://picsum.photos/seed/{{ $tech['demo_type'] }}/800/450" alt="Without Technology" class="w-full h-full object-cover">
                        {{-- Effects applied to 'Before' (Without Lens) --}}
                        @if($tech['demo_type'] === 'photochromic')
                            <div class="absolute inset-0"></div> {{-- Clear/Light --}}
                            <div class="absolute top-4 left-4 bg-white/50 text-black px-3 py-1 rounded-full text-xs font-bold backdrop-blur">Indoor (Clear)</div>
                        @elseif($tech['demo_type'] === 'polarized')
                            <div class="absolute inset-0 bg-white/40 mix-blend-overlay"></div> {{-- Glare --}}
                            <div class="absolute inset-0 bg-gradient-to-tr from-white/30 to-transparent"></div>
                            <div class="absolute top-4 left-4 bg-white/50 text-black px-3 py-1 rounded-full text-xs font-bold backdrop-blur">Without Polarized</div>
                        @elseif($tech['demo_type'] === 'blue-cut')
                            <div class="absolute inset-0 bg-blue-400/20 mix-blend-color-burn"></div> {{-- Harsh Blue Light --}}
                            <div class="absolute top-4 left-4 bg-white/50 text-black px-3 py-1 rounded-full text-xs font-bold backdrop-blur">Standard Lens</div>
                        @elseif($tech['demo_type'] === 'anti-glare')
                            <div class="absolute inset-0 bg-gradient-to-br from-white/40 via-transparent to-white/10"></div> {{-- Glare Reflections --}}
                            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-white/40 blur-2xl rounded-full"></div> {{-- Halo --}}
                            <div class="absolute top-4 left-4 bg-white/50 text-black px-3 py-1 rounded-full text-xs font-bold backdrop-blur">Standard Lens</div>
                        @endif
                    </div>

                    {{-- Slider Handle --}}
                    <div class="slider-handle" :style="`left: ${position}%`" @mousedown.prevent="dragging = true">
                        <div class="slider-circle text-brand-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l-3 3 3 3m8-6l3 3-3 3"/></svg>
                        </div>
                    </div>
                </div>

                <div class="card p-8 {{ $tech['bg'] }}">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-display font-bold text-brand-500">Technical Specifications</h3>
                        <span class="text-xs font-bold uppercase tracking-wider text-warm-400">Specs</span>
                    </div>
                    <div class="space-y-3">
                        @foreach($tech['specs'] as $key => $value)
                            <div class="flex justify-between items-center py-2 border-b border-warm-200/50 last:border-0">
                                <span class="text-warm-500 text-sm">{{ $key }}</span>
                                <span class="text-warm-700 text-sm font-semibold">{{ $value }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('products') }}" class="btn-secondary text-sm w-full md:w-auto">View Products with {{ explode(' ', $tech['name'])[0] }} Technology →</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach

{{-- CTA --}}
<section class="gradient-hero py-20">
    <div class="container-custom text-center">
        <h2 class="font-display text-3xl font-bold text-white">Need Help Choosing the Right Technology?</h2>
        <p class="text-white/70 mt-4 max-w-xl mx-auto">Our team can help you select the perfect lens technology for your customers. Get in touch today.</p>
        <a href="{{ route('contact') }}" class="btn-primary !bg-white !text-brand-500 mt-8">Contact Our Team</a>
    </div>
</section>
@endsection
