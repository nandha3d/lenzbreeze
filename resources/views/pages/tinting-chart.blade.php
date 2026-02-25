@extends('layouts.app')
@section('title', 'Lens Tinting Chart - Lenz Breeze')
@section('meta_description', 'Explore our comprehensive lens tinting chart. Choose from a wide range of colors including Black, Brown, Pink, Blue, Green, Gray, Red, and Yellow.')

@section('content')
{{-- Page Hero --}}
<section class="gradient-brand py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 right-10 w-64 h-64 rounded-full bg-white/20 blur-3xl"></div>
    </div>
    <div class="container-custom relative z-10 text-center">
        <h1 class="font-display text-4xl md:text-5xl font-bold text-white">Lens Tinting Chart</h1>
        <p class="text-white/70 text-lg mt-4 max-w-2xl mx-auto">Your guide to ordering a wide range of tinted lenses. We offer a total of 38 pure colors using the best lens coloring dyes in the world.</p>
    </div>
</section>

{{-- Tinting Grid --}}
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="mb-12 p-6 bg-warm-50 rounded-2xl border border-warm-100 text-sm text-warm-600">
            <p>Our Tinting chart is your guide to ordering a wide range of tinted lenses. The images you see below are the actual lens photos, helping you choose the perfect color for your visual needs. While we offer a broad range, please note that "Green", "Gray", and "Red" categories have specific shade counts as shown below.</p>
        </div>

        @php
            $colorGroups = [
                ['name' => 'Black', 'code' => 'BL', 'count' => 5, 'base' => 'bg-gray-900', 'shades' => [
                    '1' => 'rgba(26, 32, 44, 0.2)', '3' => 'rgba(26, 32, 44, 0.4)', '5' => 'rgba(26, 32, 44, 0.6)', '7' => 'rgba(26, 32, 44, 0.8)', '9' => 'rgba(26, 32, 44, 1)'
                ]],
                ['name' => 'Brown', 'code' => 'BR', 'count' => 5, 'base' => 'bg-amber-900', 'shades' => [
                    '1' => 'rgba(120, 66, 18, 0.2)', '3' => 'rgba(120, 66, 18, 0.4)', '5' => 'rgba(120, 66, 18, 0.6)', '7' => 'rgba(120, 66, 18, 0.8)', '9' => 'rgba(120, 66, 18, 1)'
                ]],
                ['name' => 'Pink', 'code' => 'PI', 'count' => 5, 'base' => 'bg-pink-500', 'shades' => [
                    '1' => 'rgba(236, 72, 153, 0.2)', '3' => 'rgba(236, 72, 153, 0.4)', '5' => 'rgba(236, 72, 153, 0.6)', '7' => 'rgba(236, 72, 153, 0.8)', '9' => 'rgba(236, 72, 153, 1)'
                ]],
                ['name' => 'Blue', 'code' => 'BU', 'count' => 5, 'base' => 'bg-blue-600', 'shades' => [
                    '1' => 'rgba(37, 99, 235, 0.2)', '3' => 'rgba(37, 99, 235, 0.4)', '5' => 'rgba(37, 99, 235, 0.6)', '7' => 'rgba(37, 99, 235, 0.8)', '9' => 'rgba(37, 99, 235, 1)'
                ]],
                ['name' => 'Green', 'code' => 'GR', 'count' => 4, 'base' => 'bg-green-700', 'shades' => [
                    '1' => 'rgba(21, 128, 61, 0.3)', '3' => 'rgba(21, 128, 61, 0.5)', '5' => 'rgba(21, 128, 61, 0.7)', '7' => 'rgba(21, 128, 61, 0.9)'
                ]],
                ['name' => 'Gray', 'code' => 'GY', 'count' => 4, 'base' => 'bg-slate-700', 'shades' => [
                    '1' => 'rgba(51, 65, 85, 0.3)', '3' => 'rgba(51, 65, 85, 0.5)', '7' => 'rgba(51, 65, 85, 0.7)', '9' => 'rgba(51, 65, 85, 0.9)'
                ]],
                ['name' => 'Red', 'code' => 'RD', 'count' => 5, 'base' => 'bg-red-600', 'shades' => [
                    '1' => 'rgba(220, 38, 38, 0.2)', '3' => 'rgba(220, 38, 38, 0.4)', '5' => 'rgba(220, 38, 38, 0.6)', '7' => 'rgba(220, 38, 38, 0.8)', '9' => 'rgba(220, 38, 38, 1)'
                ]],
                ['name' => 'Yellow', 'code' => 'YE', 'count' => 5, 'base' => 'bg-yellow-400', 'shades' => [
                    '1' => 'rgba(250, 204, 21, 0.2)', '3' => 'rgba(250, 204, 21, 0.4)', '5' => 'rgba(250, 204, 21, 0.6)', '7' => 'rgba(250, 204, 21, 0.8)', '9' => 'rgba(250, 204, 21, 1)'
                ]],
            ];
        @endphp

        <div class="space-y-10">
            @foreach($colorGroups as $group)
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <h2 class="font-display text-xl font-bold text-brand-500">{{ $group['name'] }}</h2>
                        <div class="h-px flex-grow bg-warm-100"></div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-warm-400">{{ $group['code'] }} Series</span>
                    </div>
                    <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 gap-4">
                        @foreach($group['shades'] as $num => $rgba)
                            <div class="text-center group cursor-help">
                                <div class="relative aspect-square w-full max-w-[60px] mx-auto rounded-full shadow-inner mb-2 flex items-center justify-center overflow-hidden border border-warm-100 transition-transform duration-300 group-hover:scale-110" style="background: {{ $rgba }};">
                                    {{-- Reflection Effect --}}
                                    <div class="absolute inset-0 bg-gradient-to-tr from-white/10 via-transparent to-white/30 opacity-60"></div>
                                    <div class="absolute top-2 left-2 w-3 h-3 rounded-full bg-white/20 blur-[1px]"></div>
                                </div>
                                <span class="text-[10px] font-display font-bold text-brand-600 block leading-tight">{{ $group['code'] }}-{{ $num }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
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
                    <div class="mt-6 ml-6 space-y-3 text-sm text-warm-500 italic">
                        <p>a) In this case, we will need to wait for the sample lens to arrive at our facility before we can process the order.</p>
                        <p>b) We will take one extra day over the standard delivery time from the date of receipt of the sample tinted lens.</p>
                        <p>c) Please note that it is your responsibility to deliver the tint sample to the lab.</p>
                    </div>
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
                        <li><strong>Verification:</strong> We check for color matching against a translight. If no difference is apparent there, it is considered a full match.</li>
                        <li><strong>Chart Variation:</strong> Due to printing and digital screen reproduction, slight variations between this chart and the final product may occur.</li>
                    </ul>
                </div>
            </div>

            <div class="space-y-8">
                {{-- Pricing CTA --}}
                <div class="card p-8 gradient-brand text-white shadow-lg flex flex-col items-center justify-center text-center h-full">
                    <div class="text-4xl mb-4">💰</div>
                    <h2 class="font-display text-2xl font-bold mb-4">3. Pricing</h2>
                    <p class="text-white/80 mb-8 max-w-sm">For specific pricing details related to our premium tinting services, please contact our customer care or your sales representative.</p>
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
        <h2 class="font-display text-2xl font-bold text-brand-500 mb-4">Quality Lenses by Suprol</h2>
        <p class="text-warm-400 max-w-2xl mx-auto">Lenz Breeze partners with world-class manufacturers to bring you precision optics. Our tinting process uses industry-standard BPI(r) dyes for maximum longevity and color stability.</p>
    </div>
</section>
@endsection
