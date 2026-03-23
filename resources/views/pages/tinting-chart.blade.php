@extends('layouts.app')
@section('title', 'Tinting Color Chart - Eye Mek Premium Lens Shades')
@section('meta_description', 'Browse our extensive range of lens tinting colors. From classic Black and Brown to vibrant Blue and Pink series for personalized Eye Mek style.')

@section('content')
{{-- Page Hero --}}
<section class="relative flex items-center justify-center overflow-hidden bg-black" style="height: 850px;">
    {{-- Background Image - Full Width & Centered --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/tint.avif') }}" alt="Lens Tinting" class="w-full h-full object-cover" style="object-position: center;">
        {{-- Very subtle overlay just to ground the text --}}
        <div class="absolute inset-0 bg-black/30"></div>
    </div>
    
    <div class="container-custom relative z-10 text-center">
        <div class="mt-20">
            <span class="inline-block px-6 py-2 rounded-full bg-brand-500 text-white text-sm font-bold uppercase tracking-widest mb-8 shadow-[0_0_20px_rgba(255,255,255,0.2)]">Personalized Optics</span>
            <h1 class="font-display text-5xl md:text-9xl font-bold text-white mb-8 drop-shadow-[0_10px_20px_rgba(0,0,0,0.9)] leading-[1.1]">
                Vibrant Vision, <br>
                <span class="text-brand-400 drop-shadow-[0_5px_10px_rgba(0,0,0,0.6)]">Personalized Style</span>
            </h1>
            <p class="text-white text-2xl md:text-4xl max-w-5xl mx-auto leading-relaxed drop-shadow-[0_8px_16px_rgba(0,0,0,0.9)] font-bold">
                Explore our premium palette of artisan shades. <br>
                Precision color and enduring clarity.
            </p>
        </div>
    </div>
</section>

{{-- Tinting Grid --}}
<section class="section-padding bg-warm-50">
    <div class="container-custom">
        {{-- Intro Info --}}
        <div class="mb-12 p-6 bg-warm-50 rounded-2xl border border-warm-100 text-sm text-warm-600">
            <p>Our Tinting chart is your guide to ordering a wide range of tinted lenses. The images you see below are the actual lens photos, helping you choose the perfect color for your visual needs. While we offer a broad range, please note that "Green", "Gray", and "Red" categories have specific shade counts as shown below.</p>
        </div>

        @php
            $colorGroups = [
                ['name' => 'Black Series', 'code' => 'BL', 'image' => 'blacktint.avif'],
                ['name' => 'Brown Series', 'code' => 'BR', 'image' => 'browntint.avif'],
                ['name' => 'Pink Series', 'code' => 'PI', 'image' => 'pinktint.avif'],
                ['name' => 'Blue Series', 'code' => 'BU', 'image' => 'bluetint.avif'],
                ['name' => 'Green Series', 'code' => 'GR', 'image' => 'greenint.avif'],
                ['name' => 'Gray Series', 'code' => 'GY', 'image' => 'graytint.avif'],
                ['name' => 'Red Series', 'code' => 'RD', 'image' => 'redtint.avif'],
                ['name' => 'Yellow Series', 'code' => 'YE', 'image' => 'yellowtint.avif'],
            ];
        @endphp

        {{-- Single Unified Box Container --}}
        <div class="bg-white rounded-2xl border border-warm-200 shadow-sm overflow-hidden p-8 md:p-12">
            <div class="space-y-10">
                @foreach($colorGroups as $group)
                    <div class="color-series-block">
                        <div class="flex items-center gap-4 mb-4">
                            <h2 class="font-display text-xl font-bold text-brand-900">{{ $group['name'] }}</h2>
                            <div class="h-px flex-grow bg-warm-100"></div>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-warm-400">{{ $group['code'] }}</span>
                        </div>
                        
                        <div class="relative rounded-xl overflow-hidden shadow-md border border-warm-100 bg-warm-50">
                            {{-- Full Image Strip --}}
                            <img src="{{ asset('images/' . $group['image']) }}" alt="{{ $group['name'] }}" class="w-full h-auto block">
                            
                            {{-- Subtle Reflection Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-tr from-white/5 via-transparent to-white/10 pointer-events-none"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Info Sections --}}
<section class="section-padding bg-warm-50">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="space-y-8">
                {{-- Delivery Time --}}
                <div class="card p-8 bg-white border-l-4 border-l-brand-500 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h2 class="font-display text-2xl font-bold text-brand-500">1. Delivery Time</h2>
                    </div>
                    <ul class="space-y-4 text-warm-600">
                        <li class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-brand-400 mt-2 shrink-0"></span>
                            <p>For a tinting order, if a <strong>standard color</strong> is requested, we will need <strong>one extra day</strong> for delivery.</p>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-brand-400 mt-2 shrink-0"></span>
                            <p>For a tinting order, if a <strong>non-standard color</strong> is requested, we will need the <strong>physical sample</strong> in order to process the order.</p>
                        </li>
                    </ul>
                </div>

                {{-- Color Matching --}}
                <div class="card p-8 bg-white border-l-4 border-l-accent-500 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-accent-50 text-accent-600 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z"/></svg>
                        </div>
                        <h2 class="font-display text-2xl font-bold text-accent-600">2. Color Matching</h2>
                    </div>
                    <ul class="space-y-4 text-warm-600 text-sm">
                        <li>For best results, please specify the <strong>tint chart code</strong> (e.g., BL-5) when placing your order.</li>
                        <li>While we strive for 100% color match, slight variations are normal due to the nature of the tinting process.</li>
                        <li><strong>Thickness/Base Variation:</strong> If an order contains two lenses with different base curves or thicknesses, a slight mismatch may occur.</li>
                    </ul>
                </div>
            </div>

            <div class="space-y-8">
                {{-- Pricing CTA --}}
                <div class="card p-8 gradient-brand text-white shadow-lg flex flex-col items-center justify-center text-center h-full rounded-[2rem]">
                    <div class="text-4xl mb-4">💰</div>
                    <h2 class="font-display text-2xl font-bold mb-4">3. Pricing</h2>
                    <p class="text-white/80 mb-8 max-w-sm">For specific pricing details related to our premium Eye Mek tinting services, please contact our customer care or your sales representative.</p>
                    <div class="flex flex-wrap gap-4 justify-center">
                        <a href="{{ route('contact') }}" class="btn-primary !bg-white !text-brand-600 border-none">Contact Sales</a>
                        <a href="tel:+918921165871" class="btn-outline-white">Call Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FAQ or Note --}}
<section class="section-padding bg-white">
    <div class="container-custom text-center">
        <h2 class="font-display text-2xl font-bold text-brand-500 mb-4">Quality Lenses by Eye Mek</h2>
        <p class="text-warm-400 max-w-2xl mx-auto">Lenz Breeze partners with world-class manufacturers to bring you precision Eye Mek optics. Our tinting process uses industry-standard BPI(r) dyes for maximum longevity and color stability.</p>
    </div>
</section>
@endsection
