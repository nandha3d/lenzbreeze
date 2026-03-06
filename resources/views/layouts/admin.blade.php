<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Lenz Breeze Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    {{-- Dripicons for unified sidebar --}}
    <link rel="stylesheet" href="{{ asset('vendor/dripicons/webfont.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Unified sidebar styles for LenzBreeze Tailwind layout */
        .unified-sidebar-nav { list-style: none; padding: 8px 12px; margin: 0; }
        .unified-sidebar-nav .nav-section-header {
            color: rgba(255,255,255,0.35);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 16px 12px 6px;
            margin-top: 4px;
        }
        .unified-sidebar-nav .nav-item > a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 8px;
            color: rgba(255,255,255,0.55);
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.15s ease;
        }
        .unified-sidebar-nav .nav-item > a i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }
        .unified-sidebar-nav .nav-item > a:hover {
            background: rgba(255,255,255,0.06);
            color: #fff;
        }
        .unified-sidebar-nav .nav-item.active > a {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }
        .unified-sidebar-nav .submenu {
            list-style: none;
            padding: 2px 0 4px 32px;
            margin: 0;
        }
        .unified-sidebar-nav .submenu li a {
            display: block;
            padding: 5px 12px;
            color: rgba(255,255,255,0.45);
            font-size: 12.5px;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.15s ease;
        }
        .unified-sidebar-nav .submenu li a:hover {
            color: #fff;
            background: rgba(255,255,255,0.04);
        }
        /* Submenu collapse/expand via JS */
        .unified-sidebar-nav .submenu { display: none; }
        .unified-sidebar-nav .submenu.show { display: block; }
    </style>
</head>
<body class="min-h-screen bg-warm-100 font-sans" x-data="{ sidebarOpen: true }">
    <div class="flex">
        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="fixed inset-y-0 left-0 z-30 bg-brand-900 text-white transition-all duration-300 flex flex-col overflow-y-auto">
            {{-- Logo --}}
            <div class="h-16 flex items-center px-5 border-b border-white/10 shrink-0">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0" style="background-color: var(--color-logo-bg)">
                        <span class="font-bold text-sm font-display" style="color: var(--color-logo-text)">LB</span>
                    </div>
                    <span x-show="sidebarOpen" x-cloak class="font-display font-bold text-lg">Admin</span>
                </a>
            </div>

            {{-- Unified Nav --}}
            <nav class="flex-1 overflow-y-auto">
                @include('partials.unified-sidebar')
            </nav>

            {{-- Bottom --}}
            <div class="border-t border-white/10 p-3 shrink-0">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-white/60 hover:bg-white/5 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span x-show="sidebarOpen" x-cloak>View Website</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-white/60 hover:bg-red-500/20 hover:text-red-300 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span x-show="sidebarOpen" x-cloak>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div :class="sidebarOpen ? 'ml-64' : 'ml-20'" class="flex-1 transition-all duration-300">
            {{-- Top Bar --}}
            <header class="h-16 bg-white border-b border-warm-200/50 flex items-center justify-between px-6 sticky top-0 z-20">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg text-warm-400 hover:bg-warm-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="font-display font-semibold text-warm-700">@yield('page_title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-warm-400">{{ Auth::user()?->name ?? 'Admin' }}</span>
                    <div class="w-8 h-8 rounded-full bg-brand-500 text-white text-xs font-bold flex items-center justify-center">{{ substr(Auth::user()?->name ?? 'A', 0, 1) }}</div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="p-6">
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-green-700 text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.07 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                        <span class="text-red-700 text-sm font-medium">{{ session('error') }}</span>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
    <script>
        // Unified sidebar submenu toggle (no Bootstrap JS available in Tailwind layout)
        document.querySelectorAll('.unified-sidebar-nav [data-toggle="collapse"]').forEach(function(trigger) {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                var target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.classList.toggle('show');
                    this.setAttribute('aria-expanded', target.classList.contains('show'));
                }
            });
        });
        // Auto-expand active submenus
        document.querySelectorAll('.unified-sidebar-nav .nav-item.active .submenu').forEach(function(sub) {
            sub.classList.add('show');
        });
    </script>
</body>
</html>
