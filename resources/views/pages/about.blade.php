@extends('layouts.app')
@section('title', 'About Us - Lenz Breeze')
@section('meta_description', 'Learn about Lenz Breeze - India\'s premier optical lens manufacturer with 20+ years of excellence, 4 manufacturing facilities, and ISO certified quality.')

@section('content')
{{-- Page Hero --}}
<section class="gradient-brand py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 right-10 w-64 h-64 rounded-full bg-white/20 blur-3xl"></div>
    </div>
    <div class="container-custom relative z-10">
        <div class="max-w-2xl">
            <h1 class="font-display text-4xl md:text-5xl font-bold text-white">About Lenz Breeze</h1>
            <p class="text-white/70 text-lg mt-4">A passion for precision, and innovation in optical lens manufacturing.</p>
        </div>
    </div>
</section>

{{-- Company Story --}}
<section class="section-padding bg-white" data-animate>
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-accent-600 font-semibold text-sm tracking-wider uppercase">Our Story</span>
                <h2 class="section-title mt-2">Crafting Vision Since 2024</h2>
                <p class="text-warm-600 mt-6 leading-relaxed">
                    Founded on 1st February 2024 in Trivandrum, Kerala, Lenz Breeze began with a simple mission — to make premium optical lenses accessible to everyone. What started as an ambitious vision has rapidly grown into a trusted name in lens manufacturing.
                </p>
                <p class="text-warm-600 mt-4 leading-relaxed">
                    In a significant milestone, we expanded our reach by opening a branch in Ernakulam on 1st November 2024. Today, with specialized facilities in Trivandrum and Cochin, we produce high-quality lenses under our premier brand: <strong>Eye Mek</strong>, offering both high-performance premium and value-focused collections.
                </p>
                <p class="text-warm-600 mt-4 leading-relaxed">
                    Every lens we craft reflects our commitment to precision engineering, innovative technology, and uncompromising quality. We believe everyone deserves crystal-clear vision, delivered with care and accuracy.
                </p>
            </div>
            <div class="relative">
                <div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl border border-warm-100">
                    <img src="{{ asset('images/aboutus.jpg') }}" alt="Lenz Breeze Manufacturing" class="w-full h-full object-cover">
                </div>
                <div class="absolute -bottom-6 -left-6 w-32 h-32 rounded-2xl gradient-accent flex items-center justify-center text-white shadow-lg">
                    <div class="text-center">
                        <div class="text-2xl font-bold">10,000+</div>
                        <div class="text-xs mt-0.5">Customers</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Mission & Vision --}}
<section class="section-padding bg-warm-50" data-animate>
    <div class="container-custom">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="card p-8">
                <div class="w-14 h-14 rounded-xl bg-brand-500 text-white flex items-center justify-center mb-5">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h3 class="font-display text-2xl font-bold text-brand-500">Our Mission</h3>
                <p class="text-warm-600 mt-3 leading-relaxed">To deliver world-class optical lenses that combine advanced technology with affordability, empowering optical professionals to provide the best vision solutions to their customers.</p>
            </div>
            <div class="card p-8">
                <div class="w-14 h-14 rounded-xl gradient-accent text-white flex items-center justify-center mb-5">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                </div>
                <h3 class="font-display text-2xl font-bold text-brand-500">Our Vision</h3>
                <p class="text-warm-600 mt-3 leading-relaxed">To become India's most trusted and innovative optical lens brand, setting the benchmark for quality, sustainability, and customer satisfaction in the Eye Mek collection.</p>
            </div>
        </div>
    </div>
</section>

{{-- Manufacturing Excellence --}}
<section class="section-padding bg-white" data-animate>
    <div class="container-custom">
        <div class="text-center mb-14">
            <h2 class="section-title">Manufacturing Excellence</h2>
            <p class="section-subtitle mx-auto">Our facilities combine precision engineering with advanced automation to produce lenses of exceptional quality.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $capabilities = [
                    ['title' => 'Digital Free-Form Surfacing', 'desc' => 'CNC-controlled lens generators for personalized progressive and single vision designs with ±0.01D accuracy.'],
                    ['title' => 'Multi-Layer Coating', 'desc' => 'Vacuum deposition systems applying 7+ AR coating layers for superior anti-reflective performance.'],
                    ['title' => 'Quality Control Lab', 'desc' => 'Every lens passes through 12 quality checkpoints including power verification, cosmetic inspection, and coating adhesion tests.'],
                    ['title' => 'Blue Cut Filtering', 'desc' => 'Proprietary substrate technology and coating processes for effective blue light filtration while maintaining true colors.'],
                    ['title' => 'Photochromic Integration', 'desc' => 'Advanced spin coating and imbibing processes for photochromic molecules, ensuring consistent activation and fade-back.'],
                    ['title' => 'Sustainable Manufacturing', 'desc' => 'Water recycling systems, energy-efficient processes, and waste reduction initiatives across all facilities.'],
                ];
            @endphp
            @foreach($capabilities as $cap)
                <div class="card p-6">
                    <h3 class="font-display font-bold text-lg text-brand-500">{{ $cap['title'] }}</h3>
                    <p class="text-sm text-warm-500 mt-2 leading-relaxed">{{ $cap['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Certifications --}}
<section class="section-padding bg-warm-50" data-animate>
    <div class="container-custom">
        <div class="text-center mb-14">
            <h2 class="section-title">Quality Certifications</h2>
            <p class="section-subtitle mx-auto">Our commitment to quality is validated by international certifications.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @php
                $certs = [
                    ['name' => 'ISO 9001:2015', 'desc' => 'Quality Management'],
                    ['name' => 'ISO 14001', 'desc' => 'Environmental Management'],
                    ['name' => 'CE Marking', 'desc' => 'European Standards'],
                    ['name' => 'FDA Registered', 'desc' => 'US Quality Standards'],
                ];
            @endphp
            @foreach($certs as $cert)
                <div class="card p-6 text-center">
                    <div class="w-16 h-16 rounded-full bg-accent-50 text-accent-600 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                    <h3 class="font-display font-bold text-brand-500">{{ $cert['name'] }}</h3>
                    <p class="text-xs text-warm-400 mt-1">{{ $cert['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
