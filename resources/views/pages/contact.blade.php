@extends('layouts.app')
@section('title', 'Contact Lenz Breeze - Visit our Trivandrum or Cochin Offices')
@section('meta_description', 'Get in touch with Lenz Breeze. Contact our head office in Trivandrum or our branch office in Cochin for premium Eye Mek lens assistance.')

@section('content')
{{-- Page Hero --}}
<section class="gradient-brand py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10"><div class="absolute top-10 right-10 w-64 h-64 rounded-full bg-white/20 blur-3xl"></div></div>
    <div class="container-custom relative z-10">
        <div class="max-w-2xl">
            <h1 class="font-display text-4xl md:text-5xl font-bold text-white">Contact Us</h1>
            <p class="text-white/70 text-lg mt-4">Have questions? We'd love to hear from you. Reach out to us through any of the channels below.</p>
        </div>
    </div>
</section>

{{-- Contact Info + Form --}}
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">
            {{-- Contact Info --}}
            <div class="lg:col-span-2 space-y-8">
                <div>
                    <h2 class="font-display text-2xl font-bold text-brand-500 mb-6">Get in Touch</h2>
                    <div class="space-y-5">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-accent-50 text-accent-600 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-warm-700 text-sm">Email</h3>
                                <a href="mailto:{{ App\Models\Setting::get('company_email', 'info@lenzbreeze.com') }}" class="text-accent-600 hover:text-accent-700 transition-colors">{{ App\Models\Setting::get('company_email', 'info@lenzbreeze.com') }}</a>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-accent-50 text-accent-600 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-warm-700 text-sm">Phone</h3>
                                <div class="space-y-1">
                                    <a href="tel:+918921165871" class="text-accent-600 hover:text-accent-700 transition-colors block">+91 89211 65871</a>
                                    <a href="tel:+918891218423" class="text-accent-600 hover:text-accent-700 transition-colors block">+91 88912 18423</a>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-green-50 text-green-600 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-warm-700 text-sm">WhatsApp</h3>
                                <a href="https://wa.me/{{ App\Models\Setting::get('company_whatsapp', '914712345678') }}" target="_blank" class="text-green-600 hover:text-green-700 transition-colors">Chat with us on WhatsApp</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Office Locations --}}
                <div class="border-t border-warm-200 pt-6">
                    <h3 class="font-display font-bold text-brand-500 mb-4">Our Locations</h3>
                    <div class="space-y-4 text-sm">
                        @php
                            $locations = [
                                ['city' => 'Trivandrum', 'label' => 'Head Office', 'address' => 'TC 81/781, Near Baba Tourist Home, Thyvila Road, Thampanoor, Thiruvananthapuram - 695 001'],
                                ['city' => 'Cochin', 'label' => 'Branch Office', 'address' => '34/1735(A1 & A2), Gokul Chambers, Kannanthodath Lane, Near Changampuzha Park, Edappally, Cochin - 682024'],
                            ];
                        @endphp
                        @foreach($locations as $loc)
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-accent-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <div>
                                    <span class="font-semibold text-warm-700">{{ $loc['city'] }} @if($loc['label'])<span class="text-accent-600 text-xs">({{ $loc['label'] }})</span>@endif</span>
                                    <p class="text-warm-400">{{ $loc['address'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="lg:col-span-3">
                <div class="card p-8">
                    <h2 class="font-display text-2xl font-bold text-brand-500 mb-6">Send Us a Message</h2>
                    <livewire:contact-form />
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Map --}}
<section class="bg-warm-50" data-animate>
    <div class="container-custom py-16">
        <h2 class="section-title text-center mb-8">Find Us</h2>
        <div class="rounded-2xl overflow-hidden shadow-lg h-[350px] bg-warm-200">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127065.34087887!2d76.8884!3d8.5241!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b05bb75c34cfb8d%3A0xb8e511eebfba3b30!2sThiruvananthapuram%2C%20Kerala!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin"
                width="100%" height="100%"
                style="border:0;" allowfullscreen="" loading="lazy" title="Google Maps view of Lenz Breeze locations"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>
@endsection
