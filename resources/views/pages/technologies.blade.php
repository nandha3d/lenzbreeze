@extends('layouts.app')
@section('title', 'Lens Technologies - Eye Mek Blue Cut, Photochromic & More')
@section('meta_description', 'Explore the science behind Lenz Breeze Eye Mek lenses. Featuring Blue Cut filters, Photochromic integration, and advanced multi-layer coatings. Learn how our innovations protect and enhance your vision.')

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
            'description' => 'In today\'s digital world, our eyes are exposed to harmful high-energy visible (HEV) blue light (380-455nm) from screens, LED lighting, and sunlight. Eye Mek Blue Cut lenses use advanced molecular filtering to shield your eyes, helping to maintain natural melatonin production for better sleep and protecting against long-term retinal conditions like cataracts and macular degeneration.',
            'benefits' => [
                'Cuts 99% of harmful HEV Blue Light while allowing beneficial turquoise light.',
                'Boosts melatonin production to help you fall asleep faster and wake up fresher.',
                'Reduces digital eye strain, puffiness, and screen-induced headaches.',
                'Super Hydrophobic Multi-Coating (SHMC) repels moisture, stains, and smudges.',
                'Protects the cornea from tissue growth (Eye Webs) caused by UV and HEV exposure.'
            ],
            'specs' => [
                'HEV Filtration' => 'Up to 99%',
                'Wavelength Range' => '380-455nm (Digital Focus)',
                'Melatonin Support' => 'Optimized (Zero Disruption)',
                'Surface Treatment' => 'Super Hydrophobic (SHMC)',
                'Impact Grade' => 'High-Durability Polymer',
            ],
            'detailed_symptoms' => [
                ['name' => 'Eye Strain', 'icon' => '👁️'],
                ['name' => 'Headaches', 'icon' => '🤕'],
                ['name' => 'Exhaustion', 'icon' => '😴'],
                ['name' => 'Puffiness', 'icon' => '🎈'],
                ['name' => 'Dizziness', 'icon' => '💫'],
                ['name' => 'Sleep Issues', 'icon' => '🌙'],
            ]
        ],
        [
            'name' => 'Anti-Glare Coating', 'emoji' => '✨',
            'tagline' => 'Crystal Clear Vision in Every Light',
            'gradient' => 'from-teal-500 to-emerald-600',
            'bg' => 'bg-teal-50',
            'demo_type' => 'anti-glare',
            'description' => 'Uncoated lenses reflect up to 10% of light, leading to ghost images and reduced clarity. Eye Mek Anti-Reflective (AR) coatings utilize advanced vacuum deposition technology to apply 7+ microscopic layers that neutralize reflections, allowing up to 99.9% of light to reach your eyes for maximum visual brilliance.',
            'benefits' => [
                'Transmits 99.9% of light for significantly sharper, more natural vision.',
                'Eliminates starbursts and halos from headlights during night driving.',
                'Reduces office-induced eye fatigue caused by overhead false lighting.',
                'Makes your lenses virtually invisible, allowing for direct, natural eye contact.',
                'Multi-layered structure provides superior scratch resistance and durability.'
            ],
            'specs' => [
                'Light Transmission' => '99.9% (Crystal Grade)',
                'Surface Reflection' => '< 0.5% (Non-Disturbing)',
                'Coating Process' => '7-Layer Vacuum Deposition',
                'Night Safety' => 'Halogen/LED Peak Reduction',
                'Lens Appearance' => 'Cosmetic Invisi-Shield',
            ],
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

                <div class="mt-6 font-display">
                    <h3 class="font-bold text-midnight text-sm uppercase tracking-widest mb-4">Key Benefits</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3">
                        @foreach($tech['benefits'] as $benefit)
                            <li class="flex items-start gap-3 text-sm text-warm-600 group">
                                <span class="w-5 h-5 rounded-full bg-accent-50 flex items-center justify-center mt-0.5 shrink-0 group-hover:bg-accent-500 transition-colors">
                                    <svg class="w-3 h-3 text-accent-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </span>
                                <span class="font-medium">{{ $benefit }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @if(isset($tech['detailed_symptoms']))
                <div class="mt-10 p-8 rounded-[2rem] bg-midnight text-white relative overflow-hidden group">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-gold/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                    <h3 class="font-bold text-gold text-[10px] uppercase tracking-[0.3em] mb-6 flex items-center gap-2">
                        <span class="animate-pulse">⚠️</span> Symptoms of Harmful Blue Light Exposure
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 relative z-10">
                        @foreach($tech['detailed_symptoms'] as $symptom)
                        <div class="flex flex-col items-center gap-3 text-center">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-2xl backdrop-blur-sm border border-white/10 group-hover:border-gold/30 transition-all">
                                {{ $symptom['icon'] }}
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-widest text-white/60 group-hover:text-white transition-colors">{{ $symptom['name'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
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

                @if($tech['demo_type'] === 'blue-cut')
                {{-- How It Works Visual Diagram --}}
                <div class="mt-8 p-10 rounded-[2.5rem] glass-premium border-white relative overflow-hidden group">
                    <div class="absolute inset-0 hud-grid-bg opacity-5"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-8">
                            <h4 class="text-xs font-black text-midnight uppercase tracking-widest">How Blue Cut Works</h4>
                            <span class="text-[9px] font-bold px-3 py-1 bg-midnight text-white rounded-full">LAB SIMULATION // v2.4</span>
                        </div>
                        
                        <div class="aspect-[21/9] bg-white/50 rounded-2xl relative flex items-center justify-center overflow-hidden border border-white/50">
                            {{-- Incoming Light Waves --}}
                            <div class="absolute left-0 top-0 bottom-0 w-1/2 flex flex-col justify-around py-8 px-8 overflow-hidden">
                                @foreach([1,2,3] as $i)
                                <div class="relative w-full h-8 animate-wave" style="animation-duration: {{ 2 + $i }}s; animation-delay: {{ $i * -0.5 }}s">
                                    <svg class="w-full h-full text-blue-500/30" viewBox="0 0 100 20" preserveAspectRatio="none">
                                        <path d="M0 10 Q 5 0, 10 10 T 20 10 T 30 10 T 40 10 T 50 10 T 60 10 T 70 10 T 80 10 T 90 10 T 100 10" fill="none" stroke="currentColor" stroke-width="2.5"></path>
                                    </svg>
                                </div>
                                @endforeach
                                <span class="absolute top-4 left-8 text-[8px] font-black text-blue-600 uppercase tracking-widest">HEV Blue Light (380-455nm)</span>
                            </div>

                            {{-- Lens Cross-Section --}}
                            <div class="w-12 h-4/5 bg-gradient-to-b from-blue-100 via-white to-blue-50 rounded-full border-4 border-white shadow-2xl relative z-20 flex items-center justify-center group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-blue-400/5 animate-pulse-slow rounded-full"></div>
                                <div class="text-[8px] font-black text-midnight/40 -rotate-90 whitespace-nowrap uppercase tracking-[0.2em]">Blue Shield Monomer</div>
                                
                                {{-- SHMC Coating Highlight --}}
                                <div class="absolute -right-1 top-10 bottom-10 w-1 bg-gold/50 rounded-full blur-[2px] animate-pulse"></div>
                            </div>

                            {{-- Beneficial Light Passing Through --}}
                            <div class="absolute right-0 top-0 bottom-0 w-5/12 flex flex-col justify-around py-8 px-8 overflow-hidden bg-gradient-to-r from-blue-500/5 to-transparent">
                                @foreach([1,2] as $i)
                                <div class="relative w-full h-8 animate-wave" style="animation-duration: 4s; animation-delay: {{ $i * -1 }}s">
                                    <svg class="w-full h-full text-tech-cyan/30" viewBox="0 0 100 20" preserveAspectRatio="none">
                                        <path d="M0 10 Q 25 5, 50 10 T 100 10" fill="none" stroke="currentColor" stroke-width="1.5"></path>
                                    </svg>
                                </div>
                                @endforeach
                                <span class="absolute bottom-4 left-8 text-[8px] font-black text-tech-cyan/60 uppercase tracking-widest">Beneficial Turquoise Light</span>
                            </div>

                            {{-- SHMC Repel Visual (Droplets) --}}
                            <div class="absolute right-12 top-1/4 w-2 h-2 bg-white rounded-full shadow-md animate-bounce"></div>
                            <div class="absolute right-16 bottom-1/4 w-1.5 h-1.5 bg-white/80 rounded-full shadow-md animate-ping"></div>
                            <div class="absolute right-8 top-1/3 text-[7px] font-bold text-midnight/40 uppercase">SHMC REPEL</div>
                        </div>

                        <p class="mt-6 text-[10px] text-midnight/60 font-medium leading-relaxed italic text-center">
                            Our molecular framework filters high-frequency energy while preserving natural color transmittance.
                        </p>
                    </div>
                </div>
                @endif

                @if($tech['demo_type'] === 'anti-glare')
                {{-- Anti-Glare How It Works Visual --}}
                <div class="mt-8 p-10 rounded-[2.5rem] glass-premium border-white relative overflow-hidden group">
                    <div class="absolute inset-0 hud-grid-bg opacity-5"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-8">
                            <h4 class="text-xs font-black text-midnight uppercase tracking-widest">AR Coating Simulation</h4>
                            <span class="text-[9px] font-bold px-3 py-1 bg-emerald-600 text-white rounded-full">CLARITY TEST // v1.2</span>
                        </div>
                        
                        <div class="aspect-[21/9] bg-warm-900 rounded-2xl relative flex items-center justify-center overflow-hidden border border-white/10">
                            {{-- SVG Simulation Layer --}}
                            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 400 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                                {{-- HUD Grid Lines --}}
                                <defs>
                                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5" stroke-opacity="0.05"/>
                                    </pattern>
                                </defs>
                                <rect width="100%" height="100%" fill="url(#grid)" />

                                {{-- Central Lens Surface --}}
                                <g transform="translate(195, 20)">
                                    <rect width="10" height="140" rx="5" fill="white" fill-opacity="0.1" stroke="white" stroke-opacity="0.2" stroke-width="1" />
                                    <rect x="0" y="20" width="2" height="100" rx="1" fill="#34D399" fill-opacity="0.6" class="animate-pulse" />
                                </g>

                                {{-- Simulation Rays --}}
                                @foreach([0, 1, 2] as $i)
                                <g style="animation-delay: {{ $i * 0.8 }}s">
                                    {{-- Incident Ray --}}
                                    <path d="M 40 40 L 195 90" stroke="#60A5FA" stroke-width="2" stroke-linecap="round" stroke-dasharray="200" stroke-dashoffset="200" class="animate-[dash_1.5s_linear_infinite]" style="animation-delay: {{ $i * 0.8 }}s" />
                                    
                                    {{-- Reflected Ray (Glare) --}}
                                    <path d="M 195 90 L 80 150" stroke="#F87171" stroke-width="1.5" stroke-linecap="round" stroke-dasharray="150" stroke-dashoffset="150" opacity="0.4" class="animate-[dash_1.5s_linear_infinite]" style="animation-delay: {{ $i * 0.8 + 0.6 }}s" />
                                    
                                    {{-- Transmitted Ray --}}
                                    <path d="M 205 90 L 360 90" stroke="#34D399" stroke-width="2.5" stroke-linecap="round" stroke-dasharray="160" stroke-dashoffset="160" class="animate-[dash_1.5s_linear_infinite]" style="animation-delay: {{ $i * 0.8 + 0.6 }}s" />
                                    
                                    {{-- Impact Point Glare --}}
                                    <circle cx="195" cy="90" r="4" fill="white" fill-opacity="0" class="animate-[ping_1.5s_linear_infinite]" style="animation-delay: {{ $i * 0.8 + 0.6 }}s" />
                                    <circle cx="195" cy="90" r="2" fill="white" fill-opacity="0" class="animate-[pulse_1.5s_linear_infinite]" style="animation-delay: {{ $i * 0.8 + 0.6 }}s" />
                                </g>
                                @endforeach

                                {{-- Annotations --}}
                                <text x="50" y="30" fill="white" fill-opacity="0.5" font-size="8" font-weight="900" class="uppercase tracking-widest">Incident Light</text>
                                <text x="70" y="160" fill="#F87171" fill-opacity="0.7" font-size="8" font-weight="900" class="uppercase tracking-widest">Reflected Glare < 0.1%</text>
                                <text x="250" y="80" fill="#34D399" font-size="8" font-weight="900" class="uppercase tracking-widest">99.9% Transmitted</text>
                            </svg>

                            <style>
                                @keyframes dash {
                                    0% { stroke-dashoffset: 200; opacity: 0; }
                                    10% { opacity: 1; }
                                    90% { opacity: 1; }
                                    100% { stroke-dashoffset: 0; opacity: 0; }
                                }
                            </style>

                            {{-- Aesthetic Badge --}}
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-4">
                                <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-[8px] font-bold text-white uppercase">Crystal Clarity</div>
                                <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-[8px] font-bold text-white uppercase">Glare Suppression</div>
                            </div>
                        </div>

                        <p class="mt-6 text-[10px] text-midnight/60 font-medium leading-relaxed italic text-center">
                            Our AR system uses destructive interference to cancel out light reflections across the visible spectrum.
                        </p>
                    </div>
                </div>
                @endif

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

        {{-- Expanded Blue Light Eye Impact Section (Full Width) --}}
        @if($tech['demo_type'] === 'blue-cut')
        <div class="mt-16 p-12 rounded-[3rem] bg-white border border-warm-200/60 shadow-2xl relative overflow-hidden group">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-4">
                    <h2 class="text-gold font-black uppercase text-xs tracking-[0.3em] mb-4">The Truth About HEV</h2>
                    <h3 class="text-3xl md:text-5xl font-display font-black text-midnight leading-tight mb-6">
                        Silent Threats to <br>
                        <span class="text-red-500">Your Retina.</span>
                    </h3>
                    <p class="text-warm-600 text-lg leading-relaxed mb-8">
                        Unlike other wavelengths, High-Energy Visible (HEV) blue light lacks the mechanical filtering in our eyes, passing directly through the cornea to the delicate retinal surface.
                    </p>
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-red-50 border-l-4 border-red-500">
                            <span class="text-2xl">🚨</span>
                            <span class="font-bold text-midnight text-sm uppercase tracking-wide">Macular Degeneration Risk</span>
                        </div>
                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-brand-50 border-l-4 border-brand-500">
                            <span class="text-2xl">🔬</span>
                            <span class="font-bold text-midnight text-sm uppercase tracking-wide">Oxidative Retinal Stress</span>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-8 relative rounded-[2rem] overflow-hidden shadow-inner bg-warm-50">
                    <img src="{{ asset('images/bluelight.png') }}" alt="Blue Light Effect on Eye Detailed" class="w-full h-auto object-cover filter brightness-95 contrast-105 transition-transform duration-1000 group-hover:scale-110">
                    <div class="absolute inset-x-0 bottom-0 h-1/4 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-warm-100 flex flex-wrap justify-between items-center gap-6">
                <p class="text-xs text-warm-400 font-medium italic max-w-2xl">
                    *Exposure to wavelengths between 415nm and 455nm is considered the most hazardous to RPE (Retinal Pigment Epithelium) cells, requiring advanced molecular shielding.
                </p>
                <div class="flex gap-4">
                    <div class="px-4 py-2 rounded-full glass-premium border-warm-200 text-[10px] font-black uppercase text-midnight tracking-widest">UV420 Filter</div>
                    <div class="px-4 py-2 rounded-full glass-premium border-warm-200 text-[10px] font-black uppercase text-midnight tracking-widest">Digital HD Optic</div>
                </div>
            </div>
        </div>
        @endif

        {{-- Expanded Anti-Glare Impact Section (Full Width) --}}
        @if($tech['demo_type'] === 'anti-glare')
        <div class="mt-16 p-12 rounded-[3rem] bg-white border border-warm-200/60 shadow-2xl relative overflow-hidden group">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-4">
                    <h2 class="text-emerald-600 font-black uppercase text-xs tracking-[0.3em] mb-4">Precision Optics</h2>
                    <h3 class="text-3xl md:text-5xl font-display font-black text-midnight leading-tight mb-6">
                        See Through <br>
                        <span class="text-emerald-500">The Glare.</span>
                    </h3>
                    <p class="text-warm-600 text-lg leading-relaxed mb-8">
                        Traditional lenses act like a mirror, bouncing light away from your eyes. Our vacuum-sealed AR coating ensures that light goes where it belongs—into your eyes for perfect clarity.
                    </p>
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-emerald-50 border-l-4 border-emerald-500">
                            <span class="text-2xl">🚗</span>
                            <span class="font-bold text-midnight text-sm uppercase tracking-wide">Safer Night Driving</span>
                        </div>
                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-teal-50 border-l-4 border-teal-500">
                            <span class="text-2xl">💻</span>
                            <span class="font-bold text-midnight text-sm uppercase tracking-wide">Digital Fatigue Shield</span>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-8 relative rounded-[2rem] overflow-hidden shadow-inner bg-warm-50 p-4">
                    {{-- Visual Comparison Placeholder/Mockup --}}
                    <div class="aspect-video bg-white rounded-xl shadow-2xl overflow-hidden relative border-8 border-white">
                         <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=1600&h=900&fit=crop" alt="Night Driving Glare Comparison" class="w-full h-full object-cover">
                         <div class="absolute inset-0 flex">
                             <div class="w-1/2 h-full bg-white/10 backdrop-blur-[1px] relative">
                                 <div class="absolute inset-0 flex flex-col items-center justify-center p-12">
                                     <div class="w-24 h-24 bg-white/60 rounded-full blur-2xl animate-pulse"></div>
                                     <span class="mt-4 text-[10px] font-black uppercase bg-white/50 px-4 py-2 rounded-full">Standard Reflection</span>
                                 </div>
                             </div>
                             <div class="w-1/2 h-full relative border-l-2 border-white/50">
                                 <div class="absolute inset-0 flex flex-col items-center justify-center p-12">
                                     <div class="w-2 h-2 bg-emerald-400 rounded-full shadow-[0_0_15px_rgba(52,211,153,0.8)]"></div>
                                     <span class="mt-4 text-[10px] font-black uppercase bg-emerald-500 text-white px-4 py-2 rounded-full">AR Enhanced</span>
                                 </div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-warm-100 flex flex-wrap justify-between items-center gap-6">
                <p class="text-xs text-warm-400 font-medium italic max-w-2xl">
                    *Our AR coating system transmits 99.9% of light, reaching the physical limit of optical performance for ophthalmic lenses.
                </p>
                <div class="flex gap-4">
                    <div class="px-4 py-2 rounded-full glass-premium border-warm-200 text-[10px] font-black uppercase text-midnight tracking-widest">7-Layer AR Stack</div>
                    <div class="px-4 py-2 rounded-full glass-premium border-warm-200 text-[10px] font-black uppercase text-midnight tracking-widest">Ultra-Durable</div>
                </div>
            </div>
        </div>
        @endif

        {{-- Polarized Tint Color Showcase --}}
        @if($tech['demo_type'] === 'polarized')
        <div class="mt-16 p-8 md:p-12 rounded-[3rem] bg-white border border-warm-200/60 shadow-2xl relative overflow-hidden"
             x-data="{
                activeColor: 'black',
                colors: [
                    { id: 'black', name: 'Gray / Black', swatch: '#1a1a1a', desc: 'Natural color perception with maximum glare reduction. Ideal for bright sunlight and driving.' },
                    { id: 'brown', name: 'Brown / Amber', swatch: '#7B4B2A', desc: 'Enhances contrast and depth perception. Perfect for variable light conditions and outdoor sports.' },
                    { id: 'green', name: 'Green', swatch: '#2D5A27', desc: 'Balances color accuracy with glare reduction. Classic choice for all-day outdoor comfort.' }
                ]
             }">
            {{-- Decorative background --}}
            <div class="absolute -top-20 -right-20 w-72 h-72 bg-purple-200/15 blur-[100px] rounded-full pointer-events-none"></div>
            <div class="absolute -bottom-16 -left-16 w-56 h-56 bg-violet-200/15 blur-[80px] rounded-full pointer-events-none"></div>

            <div class="relative z-10">
                {{-- Header --}}
                <div class="text-center mb-10">
                    <h2 class="text-purple-600 font-black uppercase text-xs tracking-[0.3em] mb-3">Available Tint Options</h2>
                    <h3 class="text-3xl md:text-5xl font-display font-black text-midnight leading-tight">
                        Choose Your <span class="text-purple-500">Tint.</span>
                    </h3>
                    <p class="text-warm-500 mt-3 text-lg max-w-xl mx-auto">See how each polarized tint looks on our lenses. Click a color to preview.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    {{-- Spectacles Display --}}
                    <div class="lg:col-span-7">
                        <div class="relative aspect-[4/3] max-w-2xl mx-auto bg-gradient-to-br from-warm-50 via-white to-purple-50/30 rounded-[2rem] border border-warm-100/50 shadow-xl overflow-hidden flex items-center justify-center p-8">
                            {{-- Glass shimmer --}}
                            <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/30 to-transparent opacity-60 pointer-events-none"></div>

                            {{-- Spectacles images with crossfade --}}
                            <img src="{{ asset('images/spectacles-black.png') }}"
                                 alt="Black tinted polarized spectacles"
                                 class="absolute inset-0 w-full h-full object-contain p-6 md:p-10 transition-opacity duration-700 ease-in-out"
                                 :class="activeColor === 'black' ? 'opacity-100' : 'opacity-0'">
                            <img src="{{ asset('images/spectacles-brown.png') }}"
                                 alt="Brown tinted polarized spectacles"
                                 class="absolute inset-0 w-full h-full object-contain p-6 md:p-10 transition-opacity duration-700 ease-in-out"
                                 :class="activeColor === 'brown' ? 'opacity-100' : 'opacity-0'">
                            <img src="{{ asset('images/spectacles-green.png') }}"
                                 alt="Green tinted polarized spectacles"
                                 class="absolute inset-0 w-full h-full object-contain p-6 md:p-10 transition-opacity duration-700 ease-in-out"
                                 :class="activeColor === 'green' ? 'opacity-100' : 'opacity-0'">

                            {{-- Active color label badge --}}
                            <div class="absolute bottom-5 left-1/2 -translate-x-1/2 z-20">
                                <div class="px-5 py-2 rounded-full bg-white/90 backdrop-blur-md shadow-lg border border-warm-100 flex items-center gap-2.5">
                                    <div class="w-3 h-3 rounded-full shadow-inner border border-black/10 transition-colors duration-500"
                                         :style="'background-color: ' + colors.find(c => c.id === activeColor).swatch"></div>
                                    <span class="text-xs font-black uppercase tracking-widest text-midnight" x-text="colors.find(c => c.id === activeColor).name"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Color selector + description --}}
                    <div class="lg:col-span-5 flex flex-col gap-6">
                        <div class="space-y-3">
                            <template x-for="color in colors" :key="color.id">
                                <button @click="activeColor = color.id"
                                        class="w-full flex items-center gap-4 p-5 rounded-2xl border-2 transition-all duration-300 text-left group"
                                        :class="activeColor === color.id
                                            ? 'border-purple-400 bg-purple-50/70 shadow-lg shadow-purple-100/50 scale-[1.02]'
                                            : 'border-warm-100 bg-white hover:border-purple-200 hover:bg-purple-50/30'">
                                    {{-- Swatch --}}
                                    <div class="w-12 h-12 rounded-xl shadow-md border-2 border-white shrink-0 transition-transform duration-300 group-hover:scale-110"
                                         :style="'background-color: ' + color.swatch"></div>
                                    {{-- Info --}}
                                    <div class="flex-1 min-w-0">
                                        <p class="font-display font-black text-midnight text-sm uppercase tracking-wider" x-text="color.name"></p>
                                        <p class="text-warm-500 text-xs mt-1 leading-relaxed line-clamp-2" x-text="color.desc"></p>
                                    </div>
                                    {{-- Active indicator --}}
                                    <div class="w-6 h-6 rounded-full flex items-center justify-center shrink-0 transition-all duration-300"
                                         :class="activeColor === color.id ? 'bg-purple-500' : 'bg-warm-100'">
                                        <svg x-show="activeColor === color.id" class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </button>
                            </template>
                        </div>

                        {{-- Extra info --}}
                        <div class="p-5 rounded-2xl bg-midnight text-white relative overflow-hidden">
                            <div class="absolute -top-6 -right-6 w-20 h-20 bg-purple-500/20 rounded-full blur-2xl"></div>
                            <p class="text-purple-300 text-[10px] font-black uppercase tracking-[0.2em] mb-2">All Tints Include</p>
                            <div class="grid grid-cols-2 gap-2 relative z-10">
                                <div class="flex items-center gap-2">
                                    <svg class="w-3 h-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-[11px] font-bold text-white/80">99.9% Polarized</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-3 h-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-[11px] font-bold text-white/80">UV400 Protection</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-3 h-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-[11px] font-bold text-white/80">ANSI Z87.1</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-3 h-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-[11px] font-bold text-white/80">SV & Progressive</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
</section>
@endforeach

{{-- Detailed Layout Chart & Progressive Lens Guide --}}
<section class="section-padding bg-white relative overflow-hidden">
    {{-- Technical Dot Grid Background --}}
    <div class="absolute inset-0 opacity-[0.4] pointer-events-none" style="background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 32px 32px;"></div>
    
    <div class="container-custom relative z-10">
        {{-- Header from user screenshot --}}
        <div class="text-center mb-16 pt-8">
            <h2 class="text-gray-900 font-black uppercase text-sm tracking-[0.4em] mb-4">
                Technical Specification
            </h2>
            <h3 class="text-5xl md:text-7xl font-display font-black leading-tight text-gray-900">
                Detailed Layout Chart <br>
                & Progressive Lens Guide
            </h3>
        </div>

        <div class="max-w-5xl mx-auto">
            {{-- Clean Technical Frame --}}
            <div class="relative rounded-[3rem] overflow-hidden border border-gray-100 bg-white shadow-[0_40px_100px_rgba(0,0,0,0.08)] p-4 md:p-10 group/chart">
                {{-- HUD Corners --}}
                <div class="absolute top-10 left-10 w-8 h-8 border-t-2 border-l-2 border-gold/20"></div>
                <div class="absolute top-10 right-10 w-8 h-8 border-t-2 border-r-2 border-gold/20"></div>
                <div class="absolute bottom-10 left-10 w-8 h-8 border-b-2 border-l-2 border-gold/20"></div>
                <div class="absolute bottom-10 right-10 w-8 h-8 border-b-2 border-r-2 border-gold/20"></div>

                {{-- The Actual Chart Image --}}
                <div class="relative rounded-2xl overflow-hidden shadow-sm border border-gray-50">
                    <img src="{{ asset('images/Layout Chart.jpg') }}" alt="Eye Mek Detailed Layout Chart" class="w-full h-auto">
                </div>
                
                {{-- Specification Metadata --}}
                <div class="mt-10 border-t border-gray-100 pt-8 flex flex-wrap items-center justify-between gap-6">
                    <div class="flex gap-8">
                        <div>
                            <p class="text-[10px] font-mono text-gray-400 uppercase tracking-widest mb-1">Fitting Height</p>
                            <p class="text-sm font-bold text-gray-900 tracking-tight">16mm Min. Lower / 10mm Upper</p>
                        </div>
                        <div class="w-px h-10 bg-gray-100"></div>
                        <div>
                            <p class="text-[10px] font-mono text-gray-400 uppercase tracking-widest mb-1">Diameters</p>
                            <p class="text-sm font-bold text-gray-900 tracking-tight">Ø 60 / 65 / 70 / 75 / 80mm</p>
                        </div>
                    </div>
                    
                    <button onclick="window.print()" class="px-8 py-4 bg-gray-900 text-white rounded-2xl text-xs font-bold uppercase tracking-widest hover:bg-gold transition-all shadow-lg hover:shadow-gold/20 flex items-center gap-3 group">
                        <svg class="w-4 h-4 text-gold group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        Print High-Res Chart
                    </button>
                </div>
            </div>
        </div>

        {{-- Legend --}}
        <div class="mt-16 flex flex-wrap justify-center gap-12 text-gray-400">
            <div class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-[.2em]">
                <span class="text-gold">✚</span> Zentration Point
            </div>
            <div class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-[.2em]">
                <span class="text-gold">⎯⎯</span> Corridor Axis
            </div>
            <div class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-[.2em]">
                <span class="text-gold">○</span> Near Reference
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="gradient-hero py-20">
    <div class="container-custom text-center">
        <h2 class="font-display text-3xl font-bold text-white">Need Help Choosing the Right Technology?</h2>
        <p class="text-white/70 mt-4 max-w-xl mx-auto">Our team can help you select the perfect lens technology for your customers. Get in touch today.</p>
        <a href="{{ route('contact') }}" class="btn-primary !bg-white !text-brand-500 mt-8">Contact Our Team</a>
    </div>
</section>
@endsection
