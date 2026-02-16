<footer class="bg-brand-900 text-warm-300">
    {{-- Newsletter Section --}}
    <div class="border-b border-white/10">
        <div class="container-custom py-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="font-display text-xl font-bold text-white">Stay Updated</h3>
                    <p class="text-sm text-warm-400 mt-1">Get the latest from Lenz Breeze — new products, technologies, and industry insights.</p>
                </div>
                <div class="w-full md:w-auto">
                    <livewire:newsletter-form />
                </div>
            </div>
        </div>
    </div>

    {{-- Main Footer --}}
    <div class="container-custom py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            {{-- Brand --}}
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo-icon.png') }}" alt="Lenz Breeze Logo" class="w-12 h-12 object-contain">
                    <img src="{{ asset('images/logo-text.png') }}" alt="Lenz Breeze" class="h-9 object-contain brightness-0 invert">
                </div>
                <p class="text-sm leading-relaxed text-warm-400">Premium optical lens manufacturer with state-of-the-art facilities across India. Trusted by thousands of optical partners nationwide.</p>
                <div class="flex gap-3 mt-6">
                    <a href="{{ App\Models\Setting::get('social_facebook', '#') }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/5 flex items-center justify-center text-warm-400 hover:bg-accent-500 hover:text-white transition-all" aria-label="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="{{ App\Models\Setting::get('social_instagram', '#') }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/5 flex items-center justify-center text-warm-400 hover:bg-accent-500 hover:text-white transition-all" aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <a href="{{ App\Models\Setting::get('social_linkedin', '#') }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/5 flex items-center justify-center text-warm-400 hover:bg-accent-500 hover:text-white transition-all" aria-label="LinkedIn">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="{{ App\Models\Setting::get('social_youtube', '#') }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/5 flex items-center justify-center text-warm-400 hover:bg-accent-500 hover:text-white transition-all" aria-label="YouTube">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-display font-semibold text-white mb-4">Quick Links</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-accent-400 transition-colors">About Us</a></li>
                    <li><a href="{{ route('products') }}" class="hover:text-accent-400 transition-colors">Our Products</a></li>
                    <li><a href="{{ route('technologies') }}" class="hover:text-accent-400 transition-colors">Technologies</a></li>
                    <li><a href="{{ route('facilities') }}" class="hover:text-accent-400 transition-colors">Facilities</a></li>
                    <li><a href="{{ route('partners') }}" class="hover:text-accent-400 transition-colors">Partners</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-accent-400 transition-colors">Contact</a></li>
                </ul>
            </div>

            {{-- Our Brands --}}
            <div>
                <h4 class="font-display font-semibold text-white mb-4">Our Brands</h4>
                <ul class="space-y-2.5 text-sm">
                    <li class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-accent-400"></span>Lenz Breeze</li>
                    <li class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-accent-400"></span>EYE MEK</li>
                </ul>
                <h4 class="font-display font-semibold text-white mb-3 mt-6">Technologies</h4>
                <ul class="space-y-2.5 text-sm">
                    <li>Blue Cut Lenses</li>
                    <li>Anti-Glare Coating</li>
                    <li>Photochromic Lenses</li>
                    <li>Polarized Lenses</li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="font-display font-semibold text-white mb-4">Head Office</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-accent-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ App\Models\Setting::get('address_trivandrum', 'Trivandrum, Kerala') }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-accent-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:{{ App\Models\Setting::get('company_email', 'info@lenzbreeze.com') }}" class="hover:text-accent-400 transition-colors">{{ App\Models\Setting::get('company_email', 'info@lenzbreeze.com') }}</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-accent-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a href="tel:{{ App\Models\Setting::get('company_phone', '+91 471 234 5678') }}" class="hover:text-accent-400 transition-colors">{{ App\Models\Setting::get('company_phone', '+91 471 234 5678') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-white/10">
        <div class="container-custom py-6 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-warm-500">
            <p>&copy; {{ date('Y') }} Lenz Breeze Optical Pvt. Ltd. All rights reserved.</p>
            <div class="flex gap-6">
                <a href="{{ route('privacy') }}" class="hover:text-accent-400 transition-colors">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="hover:text-accent-400 transition-colors">Terms & Conditions</a>
            </div>
        </div>
    </div>
</footer>
