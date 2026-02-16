@extends('layouts.app')
@section('title', 'Business Partners - Lenz Breeze')
@section('meta_description', 'Partner with Lenz Breeze. Learn about our distributor network, partnership benefits, and how to become an authorized Lenz Breeze dealer.')

@section('content')
{{-- Page Hero --}}
<section class="gradient-brand py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10"><div class="absolute top-10 right-10 w-64 h-64 rounded-full bg-white/20 blur-3xl"></div></div>
    <div class="container-custom relative z-10">
        <div class="max-w-2xl">
            <h1 class="font-display text-4xl md:text-5xl font-bold text-white">Business Partners</h1>
            <p class="text-white/70 text-lg mt-4">Join India's growing network of optical retailers powered by Lenz Breeze. Together, we help millions see clearly.</p>
        </div>
    </div>
</section>

{{-- Partnership Benefits --}}
<section class="section-padding bg-white" data-animate>
    <div class="container-custom">
        <div class="text-center mb-14">
            <h2 class="section-title">Why Partner with Lenz Breeze?</h2>
            <p class="section-subtitle mx-auto">We believe in growing together. Our partnership model is designed to maximize your success.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $benefits = [
                    ['icon' => '💰', 'title' => 'Competitive Pricing', 'desc' => 'Direct factory pricing with attractive margin structures. Volume-based incentives and seasonal promotions.'],
                    ['icon' => '📦', 'title' => 'Fast Delivery', 'desc' => 'Same-day dispatch from the nearest facility. Lenses reach your store within 24-48 hours across India.'],
                    ['icon' => '🎓', 'title' => 'Training & Support', 'desc' => 'Comprehensive product training, fitting guides, and dedicated account managers for every partner.'],
                    ['icon' => '🔧', 'title' => 'Marketing Support', 'desc' => 'Point-of-sale materials, in-store displays, digital marketing assets, and co-branded campaigns.'],
                    ['icon' => '📊', 'title' => 'Business Analytics', 'desc' => 'Partner portal with order tracking, sales analytics, and trend insights to help grow your business.'],
                    ['icon' => '🛡️', 'title' => 'Warranty Support', 'desc' => 'Comprehensive warranty coverage on all products. Easy claim processing through our partner portal.'],
                ];
            @endphp
            @foreach($benefits as $benefit)
                <div class="card p-6 group">
                    <div class="text-3xl mb-3">{{ $benefit['icon'] }}</div>
                    <h3 class="font-display font-bold text-lg text-brand-500">{{ $benefit['title'] }}</h3>
                    <p class="text-sm text-warm-500 mt-2 leading-relaxed">{{ $benefit['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Network Stats --}}
<section class="gradient-hero py-16" data-animate>
    <div class="container-custom">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            @php
                $stats = [
                    ['number' => '500+', 'label' => 'Active Partners'],
                    ['number' => '22', 'label' => 'States Covered'],
                    ['number' => '24-48h', 'label' => 'Delivery Time'],
                    ['number' => '98%', 'label' => 'Partner Satisfaction'],
                ];
            @endphp
            @foreach($stats as $stat)
                <div>
                    <div class="font-display text-4xl font-bold text-white">{{ $stat['number'] }}</div>
                    <div class="text-white/60 text-sm mt-1">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- How to Become a Partner --}}
<section class="section-padding bg-warm-50" data-animate>
    <div class="container-custom">
        <div class="text-center mb-14">
            <h2 class="section-title">How to Become a Partner</h2>
            <p class="section-subtitle mx-auto">Getting started is simple. Follow these steps to join the Lenz Breeze network.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $steps = [
                    ['step' => '1', 'title' => 'Reach Out', 'desc' => 'Fill out our partnership inquiry form or call our business development team.'],
                    ['step' => '2', 'title' => 'Assessment', 'desc' => 'Our team evaluates your location, market, and business potential.'],
                    ['step' => '3', 'title' => 'Agreement', 'desc' => 'Finalize terms, pricing structure, and territorial coverage.'],
                    ['step' => '4', 'title' => 'Launch', 'desc' => 'Receive your welcome kit, product samples, and marketing materials. Start selling!'],
                ];
            @endphp
            @foreach($steps as $step)
                <div class="card p-6 text-center relative">
                    <div class="w-12 h-12 rounded-full gradient-accent text-white font-display font-bold text-lg flex items-center justify-center mx-auto mb-4">{{ $step['step'] }}</div>
                    <h3 class="font-display font-bold text-brand-500">{{ $step['title'] }}</h3>
                    <p class="text-sm text-warm-500 mt-2">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="section-padding bg-white" data-animate>
    <div class="container-custom">
        <div class="card-glass bg-gradient-to-br from-brand-50 to-accent-50 p-12 text-center">
            <h2 class="font-display text-3xl font-bold text-brand-500">Ready to Partner with Us?</h2>
            <p class="text-warm-600 mt-3 max-w-xl mx-auto">Get in touch with our business development team to discuss how we can grow together.</p>
            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <a href="{{ route('contact') }}" class="btn-primary">Partnership Inquiry</a>
                <a href="tel:{{ App\Models\Setting::get('company_phone', '+914712345678') }}" class="btn-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    Call Us Directly
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
