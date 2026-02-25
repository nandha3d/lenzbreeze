<header class="sticky top-0 z-[100] glass-premium transition-all duration-500" x-data="{ mobileOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
    <div class="container-custom">
        <div class="flex items-center justify-between transition-all duration-500" :class="scrolled ? 'h-16' : 'h-20'">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="relative">
                    <img src="{{ asset('images/logo-icon.png') }}" alt="Lenz Breeze Logo" class="h-10 lg:h-12 w-auto object-contain transition-transform duration-500 group-hover:rotate-[10deg] group-hover:scale-110">
                    <div class="absolute -inset-1 bg-tech-cyan/20 blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-full"></div>
                </div>
                <img src="{{ asset('images/logo-text.png') }}" alt="Lenz Breeze" class="h-4 lg:h-5 w-auto object-contain hidden sm:block">
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden lg:flex items-center gap-2">
                @php
                    $navItems = [
                        ['route' => 'home', 'label' => 'Home'],
                        ['route' => 'about', 'label' => 'About'],
                        ['route' => 'products', 'label' => 'Products', 'pattern' => 'products*'],
                        ['route' => 'facilities', 'label' => 'Facilities'],
                        ['route' => 'technologies', 'label' => 'Technologies'],
                        ['route' => 'tinting-chart', 'label' => 'Tinting Chart'],
                        ['route' => 'partners', 'label' => 'Partners'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    @php
                        $isActive = request()->routeIs($item['pattern'] ?? $item['route']);
                    @endphp
                    <a href="{{ route($item['route']) }}" 
                       class="px-4 py-2 text-sm font-bold tracking-tight rounded-full transition-all duration-300 {{ $isActive ? 'text-midnight bg-gold/10' : 'text-warm-600 hover:text-midnight hover:bg-white/50' }}">
                       {{ $item['label'] }}
                    </a>
                @endforeach
                
                <a href="{{ route('contact') }}" class="ml-2 px-6 py-2.5 bg-midnight text-white text-sm font-bold rounded-full hover:bg-midnight/90 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    Contact Us
                </a>
            </nav>

            {{-- Mobile Toggle --}}
            <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-xl text-midnight hover:bg-white/50 transition-colors">
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileOpen" x-cloak 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0 -translate-y-10" 
         x-transition:enter-end="opacity-100 translate-y-0" 
         x-transition:leave="transition ease-in duration-200" 
         x-transition:leave-start="opacity-100 translate-y-0" 
         x-transition:leave-end="opacity-0 -translate-y-10" 
         class="lg:hidden glass-premium border-t border-white/20">
        <nav class="container-custom py-6 flex flex-col gap-2">
            @foreach($navItems as $item)
                @php
                    $isActive = request()->routeIs($item['pattern'] ?? $item['route']);
                @endphp
                <a href="{{ route($item['route']) }}" 
                   class="px-6 py-3 rounded-2xl text-base font-bold transition-all duration-300 {{ $isActive ? 'text-midnight bg-gold/10 ml-2' : 'text-warm-600 hover:bg-white/50' }}">
                   {{ $item['label'] }}
                </a>
            @endforeach
            <a href="{{ route('contact') }}" class="mt-4 px-6 py-4 bg-midnight text-white text-center font-bold rounded-2xl shadow-xl">
                Contact Us
            </a>
        </nav>
    </div>
</header>
