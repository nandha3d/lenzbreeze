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
    <!-- Font Awesome CSS (needed for submenu arrows) -->
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Unified sidebar styles for LenzBreeze Tailwind layout */
        .unified-sidebar-nav { list-style: none; padding: 8px 12px; margin: 0; }
        .unified-sidebar-nav .nav-section-header {
            color: #9ca3af;
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
            color: #4b5563;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.15s ease;
        }
        .unified-sidebar-nav .nav-item > a i {
            font-size: 16px;
            width: 20px;
            text-align: center;
            color: #9ca3af;
        }
        .unified-sidebar-nav .nav-item > a:hover {
            background: rgba(0, 175, 176, 0.08);
            color: var(--color-accent-600, #009494);
        }
        .unified-sidebar-nav .nav-item > a:hover i {
            color: var(--color-accent-600, #009494);
        }
        .unified-sidebar-nav .nav-item.active > a {
            background: rgba(0, 175, 176, 0.1);
            color: var(--color-accent-600, #009494);
            font-weight: 600;
        }
        .unified-sidebar-nav .nav-item.active > a i {
            color: var(--color-accent-600, #009494);
        }
        
        .unified-sidebar-nav .nav-item.has-submenu > a { position: relative; padding-right: 40px; }
        .unified-sidebar-nav .nav-item.has-submenu > a::after {
            content: "\f105"; font-family: "FontAwesome" !important; position: absolute; right: 16px;
            font-size: 12px; color: #9ca3af; transition: transform 0.2s ease;
        }
        .unified-sidebar-nav .nav-item.has-submenu > a[aria-expanded="true"]::after { transform: rotate(90deg); color: var(--color-accent-500, #00afb0); }

        .unified-sidebar-nav .submenu {
            list-style: none;
            padding: 2px 0 4px 32px;
            margin: 0;
        }
        .unified-sidebar-nav .submenu li a {
            display: block;
            padding: 5px 12px;
            color: #6b7280;
            font-size: 12.5px;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.15s ease;
        }
        .unified-sidebar-nav .submenu li a:hover {
            color: var(--color-accent-600, #009494);
            background: rgba(0, 175, 176, 0.05);
        }
        .unified-sidebar-nav .submenu li.active a {
            color: var(--color-accent-600, #009494);
            background: rgba(0, 175, 176, 0.1);
            font-weight: 600;
        }
        /* Submenu collapse/expand via JS */
        .unified-sidebar-nav .submenu { 
            display: none; 
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        .unified-sidebar-nav .submenu.show { 
            display: block !important; 
            visibility: visible !important;
            opacity: 1;
        }
    </style>
</head>
<body class="min-h-screen bg-warm-100 font-sans" x-data="{ sidebarOpen: true }">
    <div class="flex">
        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="fixed inset-y-0 left-0 z-[100] bg-white border-r border-gray-200 text-gray-800 transition-all duration-300 flex flex-col overflow-y-auto lz-sidebar">
            {{-- Logo --}}
            <div class="h-16 flex items-center px-5 border-b border-gray-200 shrink-0">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0" style="background-color: var(--color-logo-bg)">
                        <span class="font-bold text-sm font-display text-white">LB</span>
                    </div>
                    <span x-show="sidebarOpen" x-cloak class="font-display font-bold text-lg text-gray-900">Admin</span>
                </a>
            </div>

            {{-- Unified Nav --}}
            <nav class="flex-1 overflow-y-auto sidebar-scrollbar">
                @include('partials.unified-sidebar')
            </nav>

            {{-- Bottom --}}
            <div class="border-t border-gray-200 p-3 shrink-0">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span x-show="sidebarOpen" x-cloak>View Website</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-500 hover:bg-red-50 hover:text-red-600 transition-colors">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Unified sidebar submenu toggle
            document.querySelectorAll('.unified-sidebar-nav [data-toggle="collapse"]').forEach(function(trigger) {
                trigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation(); // Avoid event bubbling that might hit other listeners
                    
                    var targetId = this.getAttribute('href');
                    var target = document.querySelector(targetId);
                    
                    if (target) {
                        var isShowing = target.classList.contains('show');
                        
                        // Close other open submenus
                        document.querySelectorAll('.unified-sidebar-nav .submenu.show').forEach(function(openSub) {
                            if (openSub !== target) {
                                openSub.classList.remove('show');
                                var otherTrigger = document.querySelector('a[href="#' + openSub.id + '"]');
                                if (otherTrigger) otherTrigger.setAttribute('aria-expanded', 'false');
                            }
                        });
                        
                        // Toggle current
                        target.classList.toggle('show');
                        this.setAttribute('aria-expanded', !isShowing);
                    }
                });
            });

            // Auto-expand active submenus with priority
            document.querySelectorAll('.unified-sidebar-nav .nav-item.active .submenu').forEach(function(sub) {
                sub.classList.add('show');
                var trigger = document.querySelector('a[href="#' + sub.id + '"]');
                if (trigger) trigger.setAttribute('aria-expanded', 'true');
            });
        });
    </script>
</body>
</html>
