<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#14213d">

    <title>@yield('title', 'TrackFleet — Operasional Armada')</title>
    <meta name="description" content="@yield('meta_description', 'TrackFleet — platform B2B untuk memantau perjalanan, mengelola armada, menghitung margin, dan menyimpan bukti serah terima dalam satu alur kerja.')">
    <meta name="keywords" content="fleet management, pelacakan armada, logistik Indonesia, e-POD, margin pengiriman, SaaS logistik">
    <meta name="author" content="PT Logistik Digital Nusantara">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / social -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="TrackFleet">
    <meta property="og:title" content="@yield('title', 'TrackFleet — Operasional Armada')">
    <meta property="og:description" content="@yield('meta_description', 'Platform B2B untuk memantau perjalanan, mengelola armada, dan melihat kinerja pengiriman.')">
    <meta property="og:image" content="{{ asset('og-image.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'TrackFleet — Operasional Armada')">
    <meta name="twitter:description" content="@yield('meta_description', 'Platform B2B untuk memantau perjalanan, mengelola armada, dan melihat kinerja pengiriman.')">
    <meta name="twitter:image" content="{{ asset('og-image.png') }}">

    <!-- Favicon & app icons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <!-- Vite: Tailwind CSS + self-hosted fonts (Plus Jakarta Sans, JetBrains Mono) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fonts

    <!-- Ikon & peta di-host lokal (tanpa ketergantungan CDN). Peta hanya pada halaman yang memakainya. -->
    <script src="{{ asset('vendor/lucide.min.js') }}" defer></script>
    @if(request()->routeIs('admin.dashboard', 'admin.orders.show', 'tracking.public'))
        <link rel="stylesheet" href="{{ asset('vendor/leaflet/leaflet.css') }}">
        <script src="{{ asset('vendor/leaflet/leaflet.js') }}" defer></script>
    @endif

    <style>
        [x-cloak] { display: none !important; }
        .glassmorphism {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
    @stack('styles')
</head>
<body class="@if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) bg-slate-950 @elseif(request()->routeIs('landing.pricing')) bg-white @elseif(request()->routeIs('admin.*') || request()->routeIs('driver.*')) bg-[#F4F5F6] @else bg-[#f8fafc] @endif text-slate-800 antialiased min-h-screen flex flex-col font-sans overflow-x-hidden selection:bg-brand-500 selection:text-white">

    <!-- Top progress bar (micro-interaction on navigation) -->
    <div id="tfProgress" class="fixed inset-x-0 top-0 z-[200] h-0.5 bg-brand-500 origin-left scale-x-0 transition-transform duration-300 ease-out"></div>

    <!-- Skip link -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-lg focus:bg-white focus:px-4 focus:py-3 focus:text-slate-900 focus:shadow-lg">Lewati ke konten</a>

    <!-- Flash Messages (toast, auto-dismiss) -->
    @php
        $flashes = [
            'success' => ['check-circle', 'emerald'],
            'error' => ['alert-circle', 'rose'],
            'warning' => ['alert-triangle', 'amber'],
        ];
    @endphp
    @foreach($flashes as $key => [$icon, $tone])
        @if(session($key))
            <div data-tf-toast class="fixed top-20 right-4 z-[120] max-w-sm w-[calc(100%-2rem)] sm:w-auto animate-slide-up">
                <div class="flex items-start gap-3 rounded-xl border px-4 py-3 text-sm shadow-lg backdrop-blur
                    @if($tone === 'emerald') bg-emerald-50/95 border-emerald-200 text-emerald-800
                    @elseif($tone === 'rose') bg-rose-50/95 border-rose-200 text-rose-800
                    @else bg-amber-50/95 border-amber-200 text-amber-800 @endif">
                    <i data-lucide="{{ $icon }}" class="w-5 h-5 shrink-0 mt-0.5"></i>
                    <div class="flex-1 font-medium">{{ session($key) }}</div>
                    <button type="button" data-tf-toast-close aria-label="Tutup notifikasi" class="shrink-0 opacity-60 hover:opacity-100 transition">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        @endif
    @endforeach

    <!-- Main Content Area -->
    @if(request()->routeIs('admin.*') && !request()->routeIs('admin.orders.invoice.*'))
    
    <!-- Mobile Sidebar Drawer Overlay (Slide-over for < lg) -->
    <div id="tfAdminMobileDrawer" class="fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-sm lg:hidden hidden transition-opacity duration-300" onclick="closeAdminDrawer()">
        <div class="fixed inset-y-0 left-0 w-80 bg-[#F4F5F6] text-slate-700 shadow-2xl flex flex-col border-r border-slate-200" onclick="event.stopPropagation()">
            <!-- Drawer Brand & Close Button -->
            <div class="h-16 px-6 border-b border-slate-200/80 flex items-center justify-between bg-white">
                <a href="{{ route('landing.index') }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-[#1A1D1F] flex items-center justify-center text-white shadow-sm">
                        <svg viewBox="0 0 24 24" class="w-4 h-4 fill-none stroke-current" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="9"></circle>
                            <path d="M12 3v18M3 12h18"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="text-base font-black text-[#1A1D1F] tracking-tight">Track<span class="text-brand-600">Fleet</span></span>
                    </div>
                </a>
                <button type="button" onclick="closeAdminDrawer()" class="p-2 rounded-xl text-slate-400 hover:text-[#1A1D1F] hover:bg-slate-100 transition">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <!-- Drawer Navigation Items -->
            <div class="p-5 space-y-2 overflow-y-auto flex-1">
                @include('layouts.partials.admin-nav-links')
            </div>
            <!-- Drawer User Card -->
            <div class="p-5 border-t border-slate-200/80 bg-white">
                @include('layouts.partials.admin-user-card')
            </div>
        </div>
    </div>

    <!-- Desktop Sidebar (Full-height fixed w-64, Bento Minimal Style) -->
    <aside class="admin-sidebar hidden lg:flex flex-col w-64 shrink-0 bg-[#F4F5F6] border-r border-slate-200/80 fixed inset-y-0 left-0 z-40 no-print">
        <!-- Brand Header with Crosshair Icon -->
        <div class="h-20 px-6 flex items-center justify-between">
            <a href="{{ route('landing.index') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-full bg-[#1A1D1F] flex items-center justify-center text-white shadow-sm group-hover:scale-105 transition-transform duration-200">
                    <svg viewBox="0 0 24 24" class="w-5 h-5 fill-none stroke-current" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M12 3v18M3 12h18"></path>
                    </svg>
                </div>
                <div>
                    <span class="text-base font-black text-[#1A1D1F] tracking-tight">Track<span class="text-brand-600">Fleet</span></span>
                </div>
            </a>
        </div>

        <!-- Navigation Links Container -->
        <div class="p-4 space-y-1 overflow-y-auto flex-1">
            @include('layouts.partials.admin-nav-links')
        </div>

        <!-- Bottom User Controls & Utility -->
        <div class="p-4 border-t border-slate-200/60 mt-auto">
            @include('layouts.partials.admin-user-card')
        </div>
    </aside>

    <!-- Mobile-Only Header Bar (< lg) -->
    <header class="lg:hidden sticky top-0 z-30 h-14 bg-white/95 backdrop-blur-md border-b border-slate-200/80 px-4 flex items-center justify-between no-print">
        <button type="button" onclick="openAdminDrawer()" class="p-2 rounded-xl text-slate-700 hover:bg-slate-100 transition" aria-label="Buka navigasi admin">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>

        <a href="{{ route('landing.index') }}" class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-full bg-[#1A1D1F] flex items-center justify-center text-white shadow-sm">
                <svg viewBox="0 0 24 24" class="w-3.5 h-3.5 fill-none stroke-current" stroke-width="2.5">
                    <circle cx="12" cy="12" r="9"></circle>
                    <path d="M12 3v18M3 12h18"></path>
                </svg>
            </div>
            <span class="text-sm font-black text-slate-900 tracking-tight">Track<span class="text-brand-600">Fleet</span></span>
        </a>

        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="text-[11px] font-mono font-bold text-slate-600">{{ auth()->user()->roleLabel() }}</span>
        </div>
    </header>

    <!-- Admin Content Area (lg:pl-64, Soft Canvas #F4F5F6) -->
    <div class="lg:pl-64 flex-1 flex flex-col min-w-0 bg-[#F4F5F6]">
        
        <!-- Top Action Bar (Matching Reference Image) -->
        <div class="h-20 px-6 sm:px-8 lg:px-10 flex items-center justify-between gap-4 no-print border-b border-transparent">
            <!-- Big Bold Page Title -->
            <div class="flex items-center gap-3">
                <h1 class="text-2xl sm:text-3xl font-black text-[#1A1D1F] tracking-tight">
                    @yield('page_title', 'Dashboard')
                </h1>
            </div>

            <!-- Right Action Cluster -->
            <div class="flex items-center gap-3">
                <!-- Pill Search Bar -->
                <div class="relative hidden sm:block w-56 md:w-64 lg:w-72">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <input type="text" placeholder="Search anything..." class="w-full pl-10 pr-4 py-2 rounded-full bg-white border border-slate-200/80 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900 shadow-[0_2px_8px_rgba(0,0,0,0.02)] transition">
                </div>

                <!-- Solid Black Pill Create Button -->
                @if(request()->routeIs('admin.orders.*') || request()->routeIs('admin.dashboard'))
                <button type="button" onclick="openTfModal('modalNewOrder', this)" class="inline-flex items-center gap-1.5 px-5 py-2 rounded-full text-xs font-bold text-white bg-[#1A1D1F] hover:bg-black shadow-sm transition-all transform hover:-translate-y-0.5">
                    <span>Create</span>
                </button>
                @elseif(request()->routeIs('admin.vehicles.*'))
                <button type="button" onclick="openTfModal('modalNewVehicle', this)" class="inline-flex items-center gap-1.5 px-5 py-2 rounded-full text-xs font-bold text-white bg-[#1A1D1F] hover:bg-black shadow-sm transition-all transform hover:-translate-y-0.5">
                    <span>Create</span>
                </button>
                @else
                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1.5 px-5 py-2 rounded-full text-xs font-bold text-white bg-[#1A1D1F] hover:bg-black shadow-sm transition-all transform hover:-translate-y-0.5">
                    <span>Create</span>
                </a>
                @endif

                <!-- Notification Bell Button -->
                <button type="button" class="w-9 h-9 rounded-full bg-white border border-slate-200/80 flex items-center justify-center text-slate-600 hover:text-[#1A1D1F] hover:bg-slate-50 shadow-sm transition relative" aria-label="Notifikasi">
                    <i data-lucide="bell" class="w-4 h-4"></i>
                    <span class="w-2 h-2 rounded-full bg-emerald-500 absolute top-2 right-2"></span>
                </button>

                <!-- Message Square Button -->
                <button type="button" class="w-9 h-9 rounded-full bg-white border border-slate-200/80 flex items-center justify-center text-slate-600 hover:text-[#1A1D1F] hover:bg-slate-50 shadow-sm transition" aria-label="Pesan">
                    <i data-lucide="message-square" class="w-4 h-4"></i>
                </button>

                <!-- User Avatar Circle -->
                <div class="flex items-center gap-2 pl-2 border-l border-slate-200/80">
                    <div class="w-9 h-9 rounded-full bg-[#1A1D1F] text-white font-bold flex items-center justify-center text-xs shadow-sm ring-2 ring-white">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                </div>
            </div>
        </div>

        <main id="main-content" class="flex-1 min-w-0" tabindex="-1">
            @yield('content')
        </main>

        <!-- Minimal Clean Admin Footer -->
        <footer class="mt-auto px-8 py-5 text-xs text-slate-400 flex flex-col sm:flex-row items-center justify-between gap-3 no-print">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="font-bold text-slate-700">TrackFleet Command Center</span>
                <span class="text-slate-300">•</span>
                <span class="text-slate-400">PT Logistik Digital Nusantara</span>
            </div>
            <div class="flex items-center gap-4 text-[11px] text-slate-500">
                <span class="font-mono text-slate-600 bg-white px-2.5 py-0.5 rounded-full border border-slate-200 font-bold">v2.4 Enterprise</span>
                <span class="text-slate-300">•</span>
                <a href="{{ route('tracking.public') }}" class="hover:text-black font-semibold transition">Portal Pelacakan</a>
                <span class="text-slate-300">•</span>
                <a href="{{ route('driver.index') }}" class="hover:text-black font-semibold transition">Aplikasi Driver</a>
            </div>
        </footer>
    </div>
    @else
    <main id="main-content" class="flex-1 relative" tabindex="-1">
        <!-- Luxury Floating Island Navbar inside MAIN with margin (Unified Grid Alignment) -->
        @unless(request()->routeIs('login') || request()->routeIs('driver.*'))
        <div id="tfNavbarWrapper" class="sticky top-0 z-50 w-full max-w-6xl mx-auto px-4 sm:px-6 pt-4 pb-2 -mb-[88px] pointer-events-none transition-all duration-300">
            <div class="pointer-events-auto">
                @include('layouts.partials.navbar')
            </div>
        </div>
        @endunless

        @yield('content')
    </main>
    @endif

    <!-- Modern Enterprise SaaS Footer (Airy, Perfectly Aligned, Rich & Structured) -->
    @if(!request()->routeIs('admin.*') && !request()->routeIs('login') && !request()->routeIs('driver.*'))
    <footer class="relative bg-slate-950 text-slate-400 text-sm border-t border-slate-800/80 overflow-hidden">
        <!-- Subtle Ambient Glow -->
        <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[800px] h-[250px] bg-brand-600/10 rounded-full blur-[140px] pointer-events-none"></div>

        <div class="relative w-full px-4 sm:px-6 md:px-10 lg:px-12 xl:px-16 2xl:px-20 pt-16 pb-12">
            
            <!-- Top Trust Highlight Bar (Lively & Credible, Edge-to-Edge) -->
            <div class="pb-8 mb-12 border-b border-slate-800/70 flex flex-col xl:flex-row items-start xl:items-center justify-between gap-6">
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('landing.index') }}" class="inline-block transition-transform duration-200 hover:scale-[1.02]">
                        <span class="text-2xl font-black tracking-tight text-white">Track<span class="text-brand-500">Fleet</span></span>
                    </a>
                    <span class="text-[10px] uppercase font-bold tracking-widest text-brand-300 bg-brand-500/10 px-2.5 py-0.5 rounded-full border border-brand-500/25">
                        Enterprise Logistik B2B
                    </span>
                </div>
                
                <div class="flex flex-wrap items-center gap-3 sm:gap-6 text-xs text-slate-400">
                    <div class="flex items-center gap-1.5 text-slate-300">
                        <i data-lucide="shield-check" class="w-4 h-4 text-brand-400"></i>
                        <span>Enkripsi TLS 1.3 &amp; UU PDP Compliant</span>
                    </div>
                    <span class="text-slate-700 hidden sm:inline">—</span>
                    <div class="flex items-center gap-1.5 text-slate-300">
                        <i data-lucide="map-pin" class="w-4 h-4 text-brand-400"></i>
                        <span>Jalur Trans-Jawa &amp; Sumatra</span>
                    </div>
                </div>
            </div>

            <!-- Main 5-Column Grid: Sejajar, Terstruktur, dengan Pembatas Kolom & Prefix Dash (-) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-6 xl:gap-8 pb-12 border-b border-slate-800/70">
                
                <!-- Col 1: Brand & Kontak -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-brand-500 font-mono font-bold text-sm">—</span>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-200">Tentang Kami</h4>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Operating system armada logistik cerdas. Pantau pergerakan truk live GPS, amankan margin laba sebelum kirim, dan simpan bukti serah terima digital sah.
                    </p>
                    <ul class="space-y-2.5 text-xs text-slate-400 pt-1">
                        <li class="flex items-center gap-2">
                            <span class="text-slate-600 font-mono">—</span>
                            <span>PT Logistik Digital Nusantara</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-slate-600 font-mono">—</span>
                            <span class="font-mono text-[11px]">Jakarta Selatan 12190</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-slate-600 font-mono">—</span>
                            <a href="mailto:halo@trackfleet.id" class="hover:text-white transition font-mono text-[11px]">halo@trackfleet.id</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-slate-600 font-mono">—</span>
                            <span>Operasional 24/7 Trans-Jawa</span>
                        </li>
                    </ul>
                </div>

                <!-- Col 2: Solusi Platform -->
                <div class="space-y-4 lg:border-l lg:border-slate-800/70 lg:pl-6 xl:pl-8">
                    <div class="flex items-center gap-2">
                        <span class="text-brand-500 font-mono font-bold text-sm">—</span>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-200">Solusi Platform</h4>
                    </div>
                    <ul class="space-y-2.5 text-xs">
                        <li>
                            <a href="{{ route('landing.index') }}" class="group flex items-center gap-2 text-slate-400 hover:text-white transition">
                                <span class="text-brand-500/80 font-mono text-xs group-hover:text-brand-400 transition">—</span>
                                <span>Kendali Kiriman Armada</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-2 text-slate-400 hover:text-white transition">
                                <span class="text-brand-500/80 font-mono text-xs group-hover:text-brand-400 transition">—</span>
                                <span>Dashboard Operasional</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tracking.public') }}" class="group flex items-center gap-2 text-slate-400 hover:text-white transition">
                                <span class="text-brand-500/80 font-mono text-xs group-hover:text-brand-400 transition">—</span>
                                <span>Live GPS Telemetri</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.orders.index') }}" class="group flex items-center gap-2 text-slate-400 hover:text-white transition">
                                <span class="text-brand-500/80 font-mono text-xs group-hover:text-brand-400 transition">—</span>
                                <span>Margin Guard &lt;10%</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('driver.index') }}" class="group flex items-center gap-2 text-slate-400 hover:text-white transition">
                                <span class="text-brand-500/80 font-mono text-xs group-hover:text-brand-400 transition">—</span>
                                <span>Bukti Terima (E-POD)</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.vehicles.index') }}" class="group flex items-center gap-2 text-slate-400 hover:text-white transition">
                                <span class="text-brand-500/80 font-mono text-xs group-hover:text-brand-400 transition">—</span>
                                <span>Manajemen Truk &amp; Vendor</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Col 3: Akses Cepat -->
                <div class="space-y-4 lg:border-l lg:border-slate-800/70 lg:pl-6 xl:pl-8">
                    <div class="flex items-center gap-2">
                        <span class="text-brand-500 font-mono font-bold text-sm">—</span>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-200">Akses Cepat</h4>
                    </div>
                    <ul class="space-y-2.5 text-xs">
                        <li>
                            <a href="{{ route('tracking.public') }}" class="group flex items-center gap-2 text-slate-400 hover:text-white transition">
                                <span class="text-brand-500/80 font-mono text-xs group-hover:text-brand-400 transition">—</span>
                                <span>Lacak Nomor Resi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('landing.pricing') }}" class="group flex items-center gap-2 text-slate-400 hover:text-white transition">
                                <span class="text-brand-500/80 font-mono text-xs group-hover:text-brand-400 transition">—</span>
                                <span>Paket &amp; Skema Tarif</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('driver.index') }}" class="group flex items-center gap-2 text-slate-400 hover:text-white transition">
                                <span class="text-brand-500/80 font-mono text-xs group-hover:text-brand-400 transition">—</span>
                                <span>Simulator Pengemudi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}" class="group flex items-center gap-2 text-slate-400 hover:text-white transition">
                                <span class="text-brand-500/80 font-mono text-xs group-hover:text-brand-400 transition">—</span>
                                <span>Portal Command Center</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tracking.public', ['code' => 'TRK-JKTSBY89']) }}" class="group flex items-center gap-2 text-slate-400 hover:text-white transition">
                                <span class="text-brand-500/80 font-mono text-xs group-hover:text-brand-400 transition">—</span>
                                <span>Contoh Live Tracking</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('landing.index') }}" class="group flex items-center gap-2 text-slate-400 hover:text-white transition">
                                <span class="text-brand-500/80 font-mono text-xs group-hover:text-brand-400 transition">—</span>
                                <span>Dokumentasi Alur Tugas</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Col 4: Bantuan & Sales -->
                <div class="space-y-4 lg:border-l lg:border-slate-800/70 lg:pl-6 xl:pl-8">
                    <div class="flex items-center gap-2">
                        <span class="text-brand-500 font-mono font-bold text-sm">—</span>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-200">Bantuan &amp; Sales</h4>
                    </div>
                    <ul class="space-y-2.5 text-xs">
                        <li>
                            <a href="https://wa.me/6281122334455?text=Halo%20TrackFleet%2C%20saya%20tertarik%20demo%20sistem" target="_blank" rel="noopener noreferrer" class="group flex items-center gap-2 text-emerald-400 hover:text-emerald-300 transition">
                                <span class="text-emerald-500 font-mono text-xs">—</span>
                                <span>WhatsApp Sales Team</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('landing.pricing') }}" class="group flex items-center gap-2 text-slate-400 hover:text-white transition">
                                <span class="text-brand-500/80 font-mono text-xs group-hover:text-brand-400 transition">—</span>
                                <span>Uji Coba 14 Hari Gratis</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}" class="group flex items-center gap-2 text-slate-400 hover:text-white transition">
                                <span class="text-brand-500/80 font-mono text-xs group-hover:text-brand-400 transition">—</span>
                                <span>Akun Demo Operasional</span>
                            </a>
                        </li>
                        <li>
                            <span class="flex items-center gap-2 text-slate-400">
                                <span class="text-slate-600 font-mono text-xs">—</span>
                                <span>SLA Respons &lt; 15 Menit</span>
                            </span>
                        </li>
                        <li>
                            <span class="flex items-center gap-2 text-slate-400">
                                <span class="text-slate-600 font-mono text-xs">—</span>
                                <span>Integrasi API ERP Siap</span>
                            </span>
                        </li>
                        <li>
                            <span class="flex items-center gap-2 text-slate-400">
                                <span class="text-slate-600 font-mono text-xs">—</span>
                                <span>Konsultasi Operasional B2B</span>
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Col 5: Regulasi & Legalitas -->
                <div class="space-y-4 md:col-span-2 lg:col-span-1 lg:border-l lg:border-slate-800/70 lg:pl-6 xl:pl-8">
                    <div class="flex items-center gap-2">
                        <span class="text-brand-500 font-mono font-bold text-sm">—</span>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-200">Regulasi &amp; Data</h4>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-900/90 border border-slate-800 space-y-3 shadow-sm">
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-200">
                            <div class="w-6 h-6 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center border border-emerald-500/20">
                                <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                            </div>
                            <span>Standar B2B Enterprise</span>
                        </div>
                        <p class="text-[11px] text-slate-400 leading-relaxed">
                            Data manifest, GPS, dan POD dilindungi enkripsi TLS 1.3 &amp; sesuai amanat UU PDP No. 27/2022.
                        </p>
                        <div class="space-y-1.5 text-[10px] font-mono text-slate-300">
                            <div class="flex items-center gap-1.5 text-emerald-300">
                                <span>—</span>
                                <span>UU PDP No. 27/2022 Compliant</span>
                            </div>
                            <div class="flex items-center gap-1.5 text-brand-300">
                                <span>—</span>
                                <span>Role-Based Access Control</span>
                            </div>
                            <div class="flex items-center gap-1.5 text-slate-400">
                                <span>—</span>
                                <span>Audit Log &amp; Digital Hash</span>
                            </div>
                            <div class="flex items-center gap-1.5 text-slate-400">
                                <span>—</span>
                                <span>Data Center Lokal Indonesia</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Row: Copyright, Legal Links & Metrics -->
            <div class="pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <div class="flex flex-wrap items-center gap-2 text-center md:text-left">
                    <span>&copy; {{ date('Y') }} PT Logistik Digital Nusantara.</span>
                    <span class="text-slate-700 hidden sm:inline">—</span>
                    <span>Seluruh hak cipta dilindungi undang-undang.</span>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4 text-xs">
                    <a href="{{ route('tracking.public') }}" class="hover:text-slate-300 transition">Cek Resi</a>
                    <span class="text-slate-700">—</span>
                    <a href="{{ route('landing.pricing') }}" class="hover:text-slate-300 transition">Tarif Layanan</a>
                    <span class="text-slate-700">—</span>
                    <a href="{{ route('login') }}" class="hover:text-slate-300 transition">Portal Staf</a>
                    <span class="text-slate-700">—</span>
                    <span class="font-mono text-[11px] text-brand-400 bg-brand-500/10 px-2 py-0.5 rounded border border-brand-500/20">v2.4 Production</span>
                </div>
            </div>

        </div>
    </footer>
    @endif

    <!-- Back to top -->
    <button type="button" id="tfBackTop" aria-label="Kembali ke atas" class="fixed bottom-5 right-5 z-[110] hidden items-center justify-center w-11 h-11 rounded-full bg-slate-900 text-white shadow-lg hover:bg-brand-600 transition opacity-0 translate-y-2">
        <i data-lucide="chevron-right" class="w-5 h-5 -rotate-90"></i>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.lucide) {
                lucide.createIcons({ attrs: { 'aria-hidden': 'true', focusable: 'false' } });
            }

            // ---- Toasts: auto dismiss ----
            document.querySelectorAll('[data-tf-toast]').forEach(function (toast) {
                var hide = function () {
                    toast.style.transition = 'opacity .3s ease, transform .3s ease';
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateY(-10px)';
                    setTimeout(function () { toast.remove(); }, 300);
                };
                toast.querySelector('[data-tf-toast-close]')?.addEventListener('click', hide);
                setTimeout(hide, 5500);
            });

            // ---- Lightweight GPU Scroll Reveal (Zero Overhead, Unobserves Immediately) ----
            var revealEls = document.querySelectorAll('.reveal, .reveal-scale');
            if ('IntersectionObserver' in window && revealEls.length) {
                var io = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            io.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
                revealEls.forEach(function (el) { io.observe(el); });
            } else {
                revealEls.forEach(function (el) { el.classList.add('is-visible'); });
            }

            // ---- Native Smooth Scroll for Internal Anchors with Navbar Offset Compensation ----
            document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(function (anchor) {
                anchor.addEventListener('click', function (e) {
                    var targetId = this.getAttribute('href');
                    var targetEl = document.querySelector(targetId);
                    if (targetEl) {
                        e.preventDefault();
                        var navOffset = 88;
                        var targetPos = targetEl.getBoundingClientRect().top + window.pageYOffset - navOffset;
                        window.scrollTo({ top: Math.max(0, targetPos), behavior: 'smooth' });
                        if (history.pushState) history.pushState(null, null, targetId);
                    }
                });
            });

            
            // ---- Navbar Scroll Shadow Adjustment ----
            var navHeader = document.querySelector('#tfNavbarWrapper header');
            if (navHeader) {
                var onNavScroll = function () {
                    if (window.scrollY > 20) {
                        navHeader.classList.add('shadow-2xl');
                    } else {
                        navHeader.classList.remove('shadow-2xl');
                    }
                };
                window.addEventListener('scroll', onNavScroll, { passive: true });
                onNavScroll();
            }

            // ---- Top progress bar on navigation ----
            var bar = document.getElementById('tfProgress');
            var start = function () {
                if (!bar) return;
                bar.style.transition = 'transform .4s ease';
                bar.style.transform = 'scaleX(0.7)';
            };
            window.addEventListener('beforeunload', function () {
                if (bar) { bar.style.transition = 'transform .3s ease'; bar.style.transform = 'scaleX(1)'; }
            });
            document.querySelectorAll('a[href]:not([target="_blank"]):not([href^="#"]):not([href^="mailto"])').forEach(function (a) {
                a.addEventListener('click', function () { if (!a.href.startsWith('javascript')) start(); });
            });
            document.querySelectorAll('form').forEach(function (f) {
                f.addEventListener('submit', function () { start(); });
            });

            // ---- Mobile menu with backdrop overlay ----
            var menuToggle = document.getElementById('tfMenuToggle');
            var mobileMenu = document.getElementById('tfMobileMenu');
            if (menuToggle && mobileMenu) {
                var overlay = document.createElement('div');
                overlay.className = 'fixed inset-0 bg-black/40 backdrop-blur-sm z-40 hidden mobile-overlay transition-opacity duration-200';
                overlay.id = 'tfMobileOverlay';
                document.body.appendChild(overlay);

                var toggleMenu = function (forceClose) {
                    var isCurrentlyOpen = !mobileMenu.classList.contains('hidden');
                    var shouldClose = forceClose === true || isCurrentlyOpen;
                    if (shouldClose) {
                        mobileMenu.classList.add('hidden');
                        overlay.classList.add('hidden');
                        menuToggle.setAttribute('aria-expanded', 'false');
                    } else {
                        mobileMenu.classList.remove('hidden');
                        overlay.classList.remove('hidden');
                        menuToggle.setAttribute('aria-expanded', 'true');
                    }
                };

                menuToggle.addEventListener('click', function (e) {
                    e.stopPropagation();
                    toggleMenu();
                });
                overlay.addEventListener('click', function () {
                    toggleMenu(true);
                });
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                        toggleMenu(true);
                    }
                });
            }

            // ---- Back to top ----
            var top = document.getElementById('tfBackTop');
            if (top) {
                var onScroll = function () {
                    if (window.scrollY > 500) {
                        top.classList.remove('hidden'); top.classList.add('flex');
                        requestAnimationFrame(function () { top.classList.remove('opacity-0', 'translate-y-2'); });
                    } else {
                        top.classList.add('opacity-0', 'translate-y-2');
                        setTimeout(function () { if (window.scrollY <= 500) { top.classList.add('hidden'); top.classList.remove('flex'); } }, 250);
                    }
                };
                window.addEventListener('scroll', onScroll, { passive: true });
                top.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: 'smooth' }); });
            }
        });

        function openAdminDrawer() {
            const drawer = document.getElementById('tfAdminMobileDrawer');
            if (!drawer) return;
            drawer.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeAdminDrawer() {
            const drawer = document.getElementById('tfAdminMobileDrawer');
            if (!drawer) return;
            drawer.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        let tfModalTrigger = null;
        function openTfModal(id, trigger) {
            const modal = document.getElementById(id);
            if (!modal) return;
            tfModalTrigger = trigger;
            modal.classList.remove('hidden');
            modal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('overflow-hidden');
            modal.querySelector('[data-modal-close]')?.focus();
        }

        function closeTfModal(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('overflow-hidden');
            tfModalTrigger?.focus();
            tfModalTrigger = null;
        }

        document.addEventListener('keydown', function (event) {
            const modal = document.querySelector('[role="dialog"][aria-hidden="false"]');
            if (!modal) return;
            if (event.key === 'Escape') {
                closeTfModal(modal.id);
                return;
            }
            if (event.key !== 'Tab') return;
            const items = [...modal.querySelectorAll('a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])')];
            if (!items.length) return;
            if (event.shiftKey && document.activeElement === items[0]) {
                event.preventDefault();
                items.at(-1).focus();
            } else if (!event.shiftKey && document.activeElement === items.at(-1)) {
                event.preventDefault();
                items[0].focus();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
