<header class="sticky top-0 z-[100] bg-white/90 backdrop-blur-md border-b border-warm-200/50" x-data="{ mobileOpen: false }">
    <div class="container-custom">
        <div class="flex items-center justify-between h-18">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo.png') }}" alt="EYE MEK Logo" class="h-12 object-contain group-hover:scale-105 transition-transform duration-300">
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden lg:flex items-center gap-1">
                <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('home') ? 'text-accent-600 bg-accent-50' : 'text-warm-600 hover:text-brand-500 hover:bg-warm-100' }}">Home</a>
                <a href="{{ route('about') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('about') ? 'text-accent-600 bg-accent-50' : 'text-warm-600 hover:text-brand-500 hover:bg-warm-100' }}">About</a>
                <a href="{{ route('products') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('products*') ? 'text-accent-600 bg-accent-50' : 'text-warm-600 hover:text-brand-500 hover:bg-warm-100' }}">Products</a>
                <a href="{{ route('facilities') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('facilities') ? 'text-accent-600 bg-accent-50' : 'text-warm-600 hover:text-brand-500 hover:bg-warm-100' }}">Facilities</a>
                <a href="{{ route('technologies') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('technologies') ? 'text-accent-600 bg-accent-50' : 'text-warm-600 hover:text-brand-500 hover:bg-warm-100' }}">Technologies</a>
                <a href="{{ route('partners') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('partners') ? 'text-accent-600 bg-accent-50' : 'text-warm-600 hover:text-brand-500 hover:bg-warm-100' }}">Partners</a>
                <a href="{{ route('contact') }}" class="btn-primary text-sm !py-2 !px-5">Contact Us</a>
            </nav>

            {{-- Mobile Toggle --}}
            <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-lg text-warm-600 hover:bg-warm-100 transition-colors">
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4" class="lg:hidden border-t border-warm-200/50 bg-white">
        <nav class="container-custom py-4 flex flex-col gap-1">
            <a href="{{ route('home') }}" class="px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('home') ? 'text-accent-600 bg-accent-50' : 'text-warm-600 hover:bg-warm-100' }}">Home</a>
            <a href="{{ route('about') }}" class="px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('about') ? 'text-accent-600 bg-accent-50' : 'text-warm-600 hover:bg-warm-100' }}">About Us</a>
            <a href="{{ route('products') }}" class="px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('products*') ? 'text-accent-600 bg-accent-50' : 'text-warm-600 hover:bg-warm-100' }}">Products</a>
            <a href="{{ route('facilities') }}" class="px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('facilities') ? 'text-accent-600 bg-accent-50' : 'text-warm-600 hover:bg-warm-100' }}">Facilities</a>
            <a href="{{ route('technologies') }}" class="px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('technologies') ? 'text-accent-600 bg-accent-50' : 'text-warm-600 hover:bg-warm-100' }}">Technologies</a>
            <a href="{{ route('partners') }}" class="px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('partners') ? 'text-accent-600 bg-accent-50' : 'text-warm-600 hover:bg-warm-100' }}">Partners</a>
            <a href="{{ route('contact') }}" class="btn-primary text-center mt-2">Contact Us</a>
        </nav>
    </div>
</header>
