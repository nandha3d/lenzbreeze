@extends('layouts.app')
@section('title', 'Our Facilities - Lenz Breeze')
@section('meta_description', 'Lenz Breeze operates 4 state-of-the-art manufacturing facilities across India — Trivandrum, Kochi, Chennai, and Delhi NCR.')

@section('content')
{{-- Page Hero --}}
<section class="gradient-brand py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10"><div class="absolute top-10 right-10 w-64 h-64 rounded-full bg-white/20 blur-3xl"></div></div>
    <div class="container-custom relative z-10">
        <div class="max-w-2xl">
            <h1 class="font-display text-4xl md:text-5xl font-bold text-white">Our Facilities</h1>
            <p class="text-white/70 text-lg mt-4">Four state-of-the-art manufacturing and distribution centers strategically located across India.</p>
        </div>
    </div>
</section>

{{-- Facilities Grid --}}
<section class="section-padding bg-white" data-animate>
    <div class="container-custom">
        @php
            $facilities = [
                ['city' => 'Trivandrum', 'state' => 'Kerala', 'type' => 'Headquarters & Manufacturing', 'icon' => '🏭',
                 'address' => App\Models\Setting::get('address_trivandrum', 'Trivandrum, Kerala'),
                 'capabilities' => ['Digital Free-Form Lab', 'Multi-Layer Coating Unit', 'Quality Control Center', 'R&D Laboratory', 'Corporate Office'],
                 'desc' => 'Our flagship facility and corporate headquarters. Houses our primary manufacturing line, R&D lab, and premium coating unit.'],
                ['city' => 'Kochi', 'state' => 'Kerala', 'type' => 'Manufacturing & Distribution', 'icon' => '🔬',
                 'address' => App\Models\Setting::get('address_kochi', 'Kochi, Kerala'),
                 'capabilities' => ['Lens Surfacing Unit', 'AR Coating Line', 'Distribution Center', 'Quality Lab'],
                 'desc' => 'Our second manufacturing facility focused on high-volume production and distribution for the Kerala and Karnataka markets.'],
                ['city' => 'Chennai', 'state' => 'Tamil Nadu', 'type' => 'Manufacturing', 'icon' => '⚙️',
                 'address' => App\Models\Setting::get('address_chennai', 'Chennai, Tamil Nadu'),
                 'capabilities' => ['High-Volume Production', 'Blue Cut Processing', 'Photochromic Lab', 'Packaging Unit'],
                 'desc' => 'Dedicated to high-volume lens production with specialized lines for Blue Cut and Photochromic processing.'],
                ['city' => 'Delhi NCR', 'state' => 'Uttar Pradesh', 'type' => 'Distribution Hub', 'icon' => '📦',
                 'address' => App\Models\Setting::get('address_delhi', 'Noida, Uttar Pradesh'),
                 'capabilities' => ['Regional Distribution', 'Order Processing', 'Customer Service', 'Showroom'],
                 'desc' => 'Our North India hub for distribution, customer support, and direct partnerships with optical retailers.'],
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($facilities as $index => $facility)
                <div class="card p-8">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="text-3xl mb-2">{{ $facility['icon'] }}</div>
                            <h2 class="font-display text-2xl font-bold text-brand-500">{{ $facility['city'] }}</h2>
                            <span class="text-sm text-warm-400">{{ $facility['state'] }}</span>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-accent-50 text-accent-700">{{ $facility['type'] }}</span>
                    </div>
                    <p class="text-warm-600 text-sm leading-relaxed mb-4">{{ $facility['desc'] }}</p>
                    <div class="border-t border-warm-100 pt-4">
                        <h3 class="text-xs font-semibold text-warm-400 uppercase tracking-wider mb-2">Capabilities</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($facility['capabilities'] as $cap)
                                <span class="px-2.5 py-1 rounded-md bg-warm-100 text-warm-600 text-xs font-medium">{{ $cap }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex items-start gap-2 mt-4 text-xs text-warm-400">
                        <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ $facility['address'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Map Section --}}
<section class="section-padding bg-warm-50" data-animate>
    <div class="container-custom">
        <div class="text-center mb-10">
            <h2 class="section-title">Find Us on the Map</h2>
            <p class="section-subtitle mx-auto">Our locations span the length of India — from Trivandrum to Delhi NCR.</p>
        </div>
        <div class="rounded-2xl overflow-hidden shadow-lg h-[400px] bg-warm-200">
            <iframe
                src="https://www.google.com/maps/d/u/0/embed?mid=1&ll=15.0,78.0&z=5"
                width="100%" height="100%"
                style="border:0;" allowfullscreen="" loading="lazy" title="Google Maps view of Lenz Breeze locations"
                referrerpolicy="no-referrer-when-downgrade"
                class="w-full h-full">
            </iframe>
        </div>
    </div>
</section>

{{-- Quality Process --}}
<section class="section-padding bg-white" data-animate>
    <div class="container-custom">
        <div class="text-center mb-14">
            <h2 class="section-title">Our Quality Process</h2>
            <p class="section-subtitle mx-auto">Every lens goes through a rigorous multi-step quality control process.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $steps = [
                    ['step' => '01', 'title' => 'Raw Material', 'desc' => 'Only premium optical-grade materials sourced from certified suppliers worldwide.'],
                    ['step' => '02', 'title' => 'Precision Surfacing', 'desc' => 'CNC-controlled generators shape lenses to exact prescriptions with ±0.01D tolerance.'],
                    ['step' => '03', 'title' => 'Multi-Layer Coating', 'desc' => 'Vacuum deposition applies AR, hard coat, and specialty layers under cleanroom conditions.'],
                    ['step' => '04', 'title' => 'Final Inspection', 'desc' => '12-point quality check including power verification, cosmetic inspection, and coating adhesion.'],
                ];
            @endphp
            @foreach($steps as $step)
                <div class="card p-6 text-center">
                    <div class="w-12 h-12 rounded-full gradient-accent text-white font-display font-bold text-lg flex items-center justify-center mx-auto mb-4">{{ $step['step'] }}</div>
                    <h3 class="font-display font-bold text-brand-500">{{ $step['title'] }}</h3>
                    <p class="text-sm text-warm-500 mt-2">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
