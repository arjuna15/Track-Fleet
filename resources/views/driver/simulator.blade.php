@extends('layouts.app')

@section('title', 'Aplikasi sopir & Simulasi Telemetri GPS — TrackFleet')
@section('meta_description', 'Aplikasi lapangan untuk sopir kargo: pemancaran koordinat GPS real-time hardware-free dan bukti serah terima digital E-POD sah hukum.')

@section('content')
<div class="min-h-screen bg-[#F4F5F6] text-slate-800 pb-16">
    
    <!-- Top Driver App Bar (Sleek Minimalist Navigation & Dual View Controller) -->
    <header class="bg-white border-b border-slate-200/80 sticky top-0 z-40 shadow-sm no-print">
        <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 h-18 sm:h-20 flex items-center justify-between gap-4">
            
            <!-- Left: App Brand & Driver Title -->
            <div class="flex items-center gap-3 min-w-0">
                <a href="{{ route('landing.index') }}" class="w-10 h-10 rounded-full bg-[#1A1D1F] flex items-center justify-center text-white shadow-sm shrink-0 hover:scale-105 transition-transform duration-200">
                    <svg viewBox="0 0 24 24" class="w-5 h-5 fill-none stroke-current" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M12 3v18M3 12h18"></path>
                    </svg>
                </a>
                <div class="min-w-0">
                    <div class="flex items-center gap-2">
                        <span class="text-base font-black text-[#1A1D1F] tracking-tight">Track<span class="text-brand-600">Fleet</span></span>
                        <span class="text-[10px] font-mono uppercase tracking-wider px-2 py-0.5 rounded-full bg-slate-100 font-bold text-slate-700">Driver OS</span>
                    </div>
                    <span class="text-xs text-slate-600 block truncate font-medium">Aplikasi sopir &amp; Telemetri Lapangan</span>
                </div>
            </div>

            <!-- Center: Dual Layout Mode Switcher (Web, iPhone 15, Split) -->
            <div class="hidden sm:flex items-center p-1 rounded-full bg-slate-100 border border-slate-200/80 text-xs font-bold shadow-inner">
                <button type="button" onclick="switchDriverMode('split')" id="btnModeSplit" class="px-3.5 py-1.5 rounded-full transition-all flex items-center gap-1.5 bg-white text-[#1A1D1F] shadow-sm">
                    <i data-lucide="columns-2" class="w-3.5 h-3.5"></i>
                    <span>Split (Web + HP)</span>
                </button>
                <button type="button" onclick="switchDriverMode('phone')" id="btnModePhone" class="px-3.5 py-1.5 rounded-full transition-all flex items-center gap-1.5 text-slate-500 hover:text-black">
                    <i data-lucide="smartphone" class="w-3.5 h-3.5"></i>
                    <span>iPhone 15 HP</span>
                </button>
                <button type="button" onclick="switchDriverMode('web')" id="btnModeWeb" class="px-3.5 py-1.5 rounded-full transition-all flex items-center gap-1.5 text-slate-500 hover:text-black">
                    <i data-lucide="monitor" class="w-3.5 h-3.5"></i>
                    <span>Web Layar Penuh</span>
                </button>
            </div>

            <!-- Right: Live Satellite Status, Back to Admin & Avatar -->
            <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                
                <!-- Live GPS Status Pill -->
                <div class="hidden md:flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold font-mono">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>GPS Satelit Aktif</span>
                </div>

                <!-- Back to Admin Command Center -->
                <a href="{{ auth()->user()->isFinance() ? route('admin.finance') : route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold shadow-sm transition">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5 text-slate-400"></i>
                    <span class="hidden sm:inline">Kembali ke Admin</span>
                    <span class="sm:hidden">Admin</span>
                </a>

                <!-- Driver Avatar -->
                <div class="flex items-center gap-2 pl-2 border-l border-slate-200">
                    <div class="w-9 h-9 rounded-full bg-[#1A1D1F] text-white font-bold flex items-center justify-center text-xs shadow-sm">
                        {{ strtoupper(substr($selectedOrder->driver_name ?? auth()->user()->name, 0, 2)) }}
                    </div>
                </div>

            </div>
        </div>
        
        <!-- Mobile Mode Switcher (< sm) -->
        <div class="sm:hidden px-4 py-2 bg-slate-50 border-t border-slate-200/80 flex items-center justify-center">
            <div class="inline-flex items-center p-0.5 rounded-full bg-slate-200/80 text-[11px] font-bold w-full max-w-xs justify-between">
                <button type="button" onclick="switchDriverMode('split')" id="btnModeSplitMobile" class="flex-1 py-1 rounded-full text-center bg-white text-black shadow-xs">
                    Split
                </button>
                <button type="button" onclick="switchDriverMode('phone')" id="btnModePhoneMobile" class="flex-1 py-1 rounded-full text-center text-slate-600">
                    iPhone 15
                </button>
                <button type="button" onclick="switchDriverMode('web')" id="btnModeWebMobile" class="flex-1 py-1 rounded-full text-center text-slate-600">
                    Web
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8 space-y-6">
        
        <!-- Flash Notification Toast -->
        @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center justify-between gap-3 shadow-sm animate-slide-up">
            <div class="flex items-center gap-2.5 font-bold">
                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-950">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        @endif

        @if($selectedOrder)
        <!-- Top Trip Manifest Bar (Bento Pill Style) -->
        <div class="bg-white rounded-[24px] p-5 sm:p-6 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] flex flex-col md:flex-row md:items-center justify-between gap-5">
            <div class="space-y-1.5 min-w-0">
                <div class="flex flex-wrap items-center gap-2 text-xs">
                    <span class="font-mono font-black text-brand-600 bg-brand-50 px-2.5 py-0.5 rounded-full border border-brand-200">
                        {{ $selectedOrder->order_number }}
                    </span>
                    <span class="text-slate-400">•</span>
                    <span class="font-mono text-slate-500 text-[11px]">Resi: {{ $selectedOrder->public_tracking_code }}</span>
                    <span class="text-slate-400">•</span>
                    @php
                        $statusBadge = [
                            'inquiry' => 'bg-slate-100 text-slate-700 border-slate-200',
                            'dispatched' => 'bg-blue-50 text-blue-800 border-blue-200',
                            'in_transit' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                            'delivered' => 'bg-teal-50 text-teal-800 border-teal-200',
                            'invoiced' => 'bg-purple-50 text-purple-800 border-purple-200',
                            'completed' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
                        ];
                    @endphp
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase border {{ $statusBadge[$selectedOrder->status] ?? 'bg-slate-100 text-slate-700' }}">
                        {{ $selectedOrder->statusLabel() }}
                    </span>
                </div>

                <h1 class="text-xl sm:text-2xl font-black text-[#1A1D1F] tracking-tight flex flex-wrap items-center gap-2">
                    <span>{{ $selectedOrder->origin_city }}</span>
                    <span class="text-slate-300 font-normal">➔</span>
                    <span class="text-brand-600">{{ $selectedOrder->destination_city }}</span>
                </h1>

                <p class="text-xs text-slate-500 font-medium">
                    Shipper: <strong class="text-[#1A1D1F] font-bold">{{ $selectedOrder->shipper_name }}</strong> · Muatan: {{ $selectedOrder->cargo_description }} ({{ $selectedOrder->cargo_weight_ton }} Ton)
                </p>
            </div>

            <!-- Custom Bento Dropdown: Surat Jalan (SPJ) Selector -->
            <div class="relative shrink-0" id="dropdownSpjWrapper">
                <div class="text-[11px] font-bold text-slate-500 mb-1 flex items-center justify-between">
                    <span>Ganti Surat Jalan (SPJ):</span>
                    <span class="text-[10px] font-mono text-slate-400 font-semibold">{{ $orders->count() }} Order Aktif</span>
                </div>
                
                <!-- Custom Trigger Button (Matching Bento Box Style) -->
                <button type="button" 
                        id="dropdownSpjTrigger" 
                        onclick="toggleSpjDropdown(event)" 
                        aria-haspopup="listbox" 
                        aria-expanded="false" 
                        class="w-full sm:w-80 bg-white hover:bg-slate-50 border border-slate-200/90 hover:border-slate-300 rounded-2xl p-2.5 shadow-sm hover:shadow transition-all text-left flex items-center justify-between gap-3 focus:outline-none focus:ring-2 focus:ring-slate-900 group">
                    <div class="min-w-0 flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center shrink-0 group-hover:bg-[#1A1D1F] group-hover:text-white transition-colors">
                            <i data-lucide="file-text" class="w-4 h-4"></i>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-1.5">
                                <span class="font-mono font-bold text-xs text-[#1A1D1F]">{{ $selectedOrder->order_number }}</span>
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            </div>
                            <div class="text-[11px] text-slate-500 truncate font-medium">
                                {{ $selectedOrder->origin_city }} ➔ {{ $selectedOrder->destination_city }}
                            </div>
                        </div>
                    </div>
                    <div class="shrink-0 flex items-center gap-1.5 pl-2 border-l border-slate-100">
                        <i data-lucide="chevron-down" id="dropdownSpjChevron" class="w-4 h-4 text-slate-400 group-hover:text-black transition-transform duration-200"></i>
                    </div>
                </button>

                <!-- Hidden Accessible Select for Fallback -->
                <select id="driverOrderSelect" name="order_id" class="sr-only" aria-hidden="true" tabindex="-1">
                    @foreach($orders as $ord)
                        <option value="{{ $ord->id }}" {{ $selectedOrder->id === $ord->id ? 'selected' : '' }}>
                            {{ $ord->order_number }} ({{ $ord->origin_city }} → {{ $ord->destination_city }})
                        </option>
                    @endforeach
                </select>

                <!-- Custom Dropdown Menu Panel (Luxury Floating Card) -->
                <div id="dropdownSpjMenu" 
                     class="hidden absolute right-0 top-full mt-2 w-full sm:w-96 bg-white rounded-[24px] shadow-[0_16px_50px_rgba(0,0,0,0.12)] border border-slate-100 p-2.5 z-50 transition-all origin-top-right">
                    
                    <!-- Menu Header -->
                    <div class="px-3 py-2 flex items-center justify-between border-b border-slate-100 mb-1.5">
                        <span class="text-[10px] font-mono uppercase font-bold tracking-wider text-slate-400">Pilih Surat Jalan (SPJ)</span>
                        <span class="text-[10px] font-bold font-mono px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">{{ $orders->count() }} Tersedia</span>
                    </div>

                    <!-- Items List -->
                    <div class="max-h-72 overflow-y-auto space-y-1.5 py-1 scrollbar-thin">
                        @foreach($orders as $ord)
                        @php
                            $isSelected = $selectedOrder->id === $ord->id;
                            $ordBadge = [
                                'inquiry' => 'bg-slate-100 text-slate-700',
                                'dispatched' => 'bg-blue-50 text-blue-700',
                                'in_transit' => 'bg-emerald-50 text-emerald-700',
                                'delivered' => 'bg-teal-50 text-teal-700',
                                'invoiced' => 'bg-purple-50 text-purple-700',
                                'completed' => 'bg-emerald-50 text-emerald-700',
                            ];
                        @endphp
                        <a href="{{ route('driver.index', ['order_id' => $ord->id]) }}" 
                           class="block p-3 rounded-2xl transition-all {{ $isSelected ? 'bg-slate-50 border border-slate-200/90 shadow-xs' : 'hover:bg-slate-50/70 border border-transparent' }}">
                            <div class="flex items-center justify-between gap-2 mb-1">
                                <div class="flex items-center gap-1.5">
                                    <span class="font-mono font-bold text-xs {{ $isSelected ? 'text-brand-600' : 'text-[#1A1D1F]' }}">
                                        {{ $ord->order_number }}
                                    </span>
                                    @if($isSelected)
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase {{ $ordBadge[$ord->status] ?? 'bg-slate-100 text-slate-600' }}">
                                        {{ $ord->statusLabel() }}
                                    </span>
                                    @if($isSelected)
                                        <div class="w-4 h-4 rounded-full bg-[#1A1D1F] text-white flex items-center justify-center text-[9px]">
                                            <i data-lucide="check" class="w-2.5 h-2.5"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="text-xs font-bold text-slate-800 flex items-center gap-1.5 truncate">
                                <span>{{ $ord->origin_city }}</span>
                                <span class="text-slate-300">➔</span>
                                <span>{{ $ord->destination_city }}</span>
                            </div>

                            <div class="text-[11px] text-slate-400 truncate mt-0.5">
                                {{ $ord->shipper_name }} · {{ $ord->cargo_weight_ton }} Ton ({{ $ord->cargo_description }})
                            </div>
                        </a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

        <!-- DUAL VIEW STUDIO CONTAINER: Web Left + iPhone 15 Right (Controlled by View Mode) -->
        <div id="driverStudioContainer" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- ========================================== -->
            <!-- 💻 SECTION 1: WEB DASHBOARD / FIELD DESK -->
            <!-- ========================================== -->
            <div id="viewWebSection" class="lg:col-span-7 space-y-6">
                
                <!-- Bento Card 1: Route Progress & Waypoint Stepper -->
                <div class="bg-white rounded-[28px] p-6 sm:p-7 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-5">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-brand-600"></i>
                            <h3 class="text-sm font-bold text-[#1A1D1F] uppercase tracking-wider">Koridor Perjalanan Trans-Jawa</h3>
                        </div>
                        <span class="text-[11px] font-mono text-slate-400 font-semibold">Truk: {{ $selectedOrder->vehicle ? $selectedOrder->vehicle->plate_number : 'B 9142 TQU' }}</span>
                    </div>

                    <!-- Visual Route Stepper -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Origin Point -->
                        <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1.5">
                            <div class="flex items-center gap-1.5 text-xs font-bold text-slate-500">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                <span>Titik Muat (Origin)</span>
                            </div>
                            <div class="font-black text-sm text-[#1A1D1F]">{{ $selectedOrder->origin_city }}</div>
                            <div class="text-[11px] text-slate-500 leading-tight">{{ $selectedOrder->origin_address }}</div>
                        </div>

                        <!-- Current Waypoint -->
                        <div class="p-4 rounded-2xl bg-brand-50/50 border border-brand-200/80 space-y-1.5">
                            <div class="flex items-center gap-1.5 text-xs font-bold text-brand-700">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>Posisi Terakhir</span>
                            </div>
                            <div class="font-black text-sm text-brand-900 truncate" id="dispCurrentLocationWeb">
                                {{ $selectedOrder->locationPings->last()->location_name ?? 'Tol Trans-Jawa KM 208' }}
                            </div>
                            <div class="text-[11px] text-brand-700 font-mono">
                                Kecepatan: {{ $selectedOrder->locationPings->last()->speed_kmh ?? 70 }} km/jam
                            </div>
                        </div>

                        <!-- Destination Point -->
                        <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 space-y-1.5">
                            <div class="flex items-center gap-1.5 text-xs font-bold text-slate-500">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span>Titik Bongkar (Destinasi)</span>
                            </div>
                            <div class="font-black text-sm text-[#1A1D1F]">{{ $selectedOrder->destination_city }}</div>
                            <div class="text-[11px] text-slate-500 leading-tight">{{ $selectedOrder->destination_address }}</div>
                        </div>
                    </div>
                </div>

                <!-- Bento Card 2: Web GPS Transmitter Studio -->
                <div class="bg-white rounded-[28px] p-6 sm:p-7 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-6">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                <i data-lucide="radio" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-[#1A1D1F] uppercase tracking-wider">Pemancar Titik Lokasi GPS</h3>
                                <p class="text-[11px] text-slate-400">Pancarkan telemetri koordinat ke satelit server TrackFleet</p>
                            </div>
                        </div>
                        <span class="text-[11px] font-mono text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200 font-bold">
                            Live Uplink
                        </span>
                    </div>

                    <!-- Quick Browser Geolocation Auto-Detect Button -->
                    <div class="p-3.5 rounded-2xl bg-blue-50/60 border border-blue-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                        <div class="flex items-center gap-2 text-blue-900 font-semibold">
                            <i data-lucide="crosshair" class="w-4 h-4 text-blue-600 shrink-0"></i>
                            <span>Deteksi GPS otomatis dari sensor HP / Browser</span>
                        </div>
                        <button type="button" onclick="detectDeviceGeolocation('web')" class="px-4 py-2 rounded-full bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow-sm transition shrink-0 flex items-center justify-center gap-1.5">
                            <i data-lucide="locate" class="w-3.5 h-3.5"></i>
                            <span>Deteksi Lokasi Saya</span>
                        </button>
                    </div>

                    <!-- 1-Click Simulation Waypoint Chips (Trans-Jawa Express) -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-700">Simulasi Cepat Titik Tol Trans-Jawa (1-Klik Isi Form):</label>
                        <div class="flex flex-wrap gap-1.5">
                            <button type="button" onclick="setPresetBoth('Gerbang Tol Cikampek KM 57', -6.3892, 107.3014, 75)" class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium transition">
                                📍 KM 57 Cikampek
                            </button>
                            <button type="button" onclick="setPresetBoth('Rest Area Tol Cipali KM 102, Subang', -6.5218, 107.6942, 80)" class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium transition">
                                📍 KM 102 Cipali
                            </button>
                            <button type="button" onclick="setPresetBoth('Gerbang Tol Palimanan KM 208, Cirebon', -6.7214, 108.4521, 78)" class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium transition">
                                📍 KM 208 Palimanan
                            </button>
                            <button type="button" onclick="setPresetBoth('Tol Trans-Jawa KM 318, Batang-Semarang', -6.9147, 109.6021, 72)" class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium transition">
                                📍 KM 318 Batang
                            </button>
                            <button type="button" onclick="setPresetBoth('Tol Banyumanik KM 429, Ungaran', -7.1215, 110.4128, 70)" class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium transition">
                                📍 KM 429 Semarang
                            </button>
                            <button type="button" onclick="setPresetBoth('Gerbang Tol Waru KM 715, Surabaya', -7.3218, 112.7214, 60)" class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium transition">
                                📍 KM 715 Surabaya
                            </button>
                        </div>
                    </div>

                    <!-- GPS Ping Transmission Form (Web Desk) -->
                    <form action="{{ route('driver.ping', $selectedOrder) }}" method="POST" class="space-y-4 text-xs">
                        @csrf
                        
                        <div>
                            <label for="pingLocationNameWeb" class="block font-bold text-slate-700 mb-1">Nama Tempat / Checkpoint Saat Ini *</label>
                            <input type="text" id="pingLocationNameWeb" name="location_name" required value="{{ old('location_name', 'Tol Trans-Jawa KM 208, Palimanan') }}" placeholder="Contoh: Tol Cipali KM 102, Rest Area" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900 shadow-sm transition">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label for="pingLatitudeWeb" class="block font-bold text-slate-700 mb-1">Latitude *</label>
                                <input type="text" id="pingLatitudeWeb" name="latitude" required inputmode="decimal" value="{{ old('latitude', '-6.7214') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 font-mono text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900 shadow-sm">
                            </div>
                            <div>
                                <label for="pingLongitudeWeb" class="block font-bold text-slate-700 mb-1">Longitude *</label>
                                <input type="text" id="pingLongitudeWeb" name="longitude" required inputmode="decimal" value="{{ old('longitude', '108.4521') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 font-mono text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900 shadow-sm">
                            </div>
                            <div>
                                <label for="pingSpeedWeb" class="block font-bold text-slate-700 mb-1">Kecepatan (km/h)</label>
                                <input type="number" id="pingSpeedWeb" name="speed_kmh" min="0" max="150" value="{{ old('speed_kmh', 78) }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 font-mono text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900 shadow-sm">
                            </div>
                        </div>

                        <div>
                            <label for="pingNotesWeb" class="block font-bold text-slate-700 mb-1">Catatan Pengemudi Lapangan</label>
                            <input type="text" id="pingNotesWeb" name="notes" value="{{ old('notes', 'Perjalanan lancar di jalur tol, kondisi muatan aman.') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900 shadow-sm transition">
                        </div>

                        <button type="submit" class="w-full py-3.5 rounded-full bg-[#1A1D1F] hover:bg-black text-white font-bold text-xs shadow-md transition flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
                            <i data-lucide="radio" class="w-4 h-4 text-emerald-400 animate-pulse"></i>
                            <span>Pancarkan Pembaruan Lokasi GPS Satelit</span>
                        </button>
                    </form>
                </div>

                <!-- Bento Card 3: Riwayat Pancaran GPS Hari Ini -->
                <div class="bg-white rounded-[28px] p-6 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                        <h4 class="text-xs font-bold text-[#1A1D1F] uppercase tracking-wider">Riwayat Telemetri GPS</h4>
                        <span class="text-[10px] font-mono text-slate-400">{{ $selectedOrder->locationPings->count() }} Pings</span>
                    </div>

                    <div class="relative pl-5 space-y-4 border-l-2 border-slate-100 ml-2 text-xs">
                        @forelse($selectedOrder->locationPings->take(4) as $ping)
                        <div class="relative">
                            <span class="absolute -left-[27px] top-0.5 w-3 h-3 rounded-full bg-[#1A1D1F] border-2 border-white ring-2 ring-slate-100"></span>
                            <div class="font-bold text-[#1A1D1F]">{{ $ping->location_name }}</div>
                            <div class="text-[11px] text-slate-500 mt-0.5">{{ $ping->notes }}</div>
                            <div class="text-[10px] text-slate-400 font-mono mt-0.5">
                                {{ $ping->recorded_at->format('H:i') }} WIB · Kecepatan {{ $ping->speed_kmh }} km/h
                            </div>
                        </div>
                        @empty
                        <div class="text-[11px] text-slate-400">Belum ada titik koordinat yang dipancarkan hari ini.</div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- ======================================================== -->
            <!-- 📱 SECTION 2: iPHONE 15 PRO DEVICE MOCKUP (HP FIELD APP) -->
            <!-- ======================================================== -->
            <div id="viewPhoneSection" class="lg:col-span-5 flex flex-col items-center">
                
                <!-- Floating device helper tag -->
                <div class="mb-3 flex items-center justify-between w-full max-w-[390px] px-2 text-xs text-slate-500 font-medium">
                    <div class="flex items-center gap-1.5 font-bold text-[#1A1D1F]">
                        <i data-lucide="smartphone" class="w-4 h-4 text-brand-600"></i>
                        <span>iPhone 15 Pro — Aplikasi Sopir</span>
                    </div>
                    <span class="font-mono text-[10px] bg-white border border-slate-200 px-2 py-0.5 rounded-full shadow-xs">
                        iOS 17.5 • Live Touch
                    </span>
                </div>

                <!-- iPhone 15 Pro Titanium Frame Mockup -->
                <div class="relative w-full max-w-[390px] bg-[#222428] p-[11px] rounded-[55px] shadow-[0_25px_70px_rgba(0,0,0,0.35),0_0_0_1px_rgba(255,255,255,0.1)] ring-1 ring-black/40">
                    
                    <!-- Physical Buttons (Left: Action Button, Vol+, Vol-) -->
                    <div class="absolute -left-[14px] top-24 w-[3.5px] h-8 bg-[#2d2f34] rounded-l-sm"></div>
                    <div class="absolute -left-[14px] top-36 w-[3.5px] h-11 bg-[#2d2f34] rounded-l-sm"></div>
                    <div class="absolute -left-[14px] top-52 w-[3.5px] h-11 bg-[#2d2f34] rounded-l-sm"></div>

                    <!-- Physical Button (Right: Side Power Button) -->
                    <div class="absolute -right-[14px] top-32 w-[3.5px] h-16 bg-[#2d2f34] rounded-r-sm"></div>

                    <!-- Inner iPhone 15 Screen Canvas -->
                    <div class="relative w-full h-[780px] bg-[#F4F5F6] rounded-[44px] overflow-hidden flex flex-col border border-black/30 shadow-inner">
                        
                        <!-- Top iOS Status Bar + Dynamic Island -->
                        <div class="h-11 px-7 pt-2.5 flex items-center justify-between text-slate-900 text-[11px] font-bold shrink-0 bg-[#F4F5F6]/90 backdrop-blur-md relative z-30 select-none">
                            <!-- Left: iOS Time -->
                            <span class="tracking-tight font-sans font-black">09:41</span>

                            <!-- Center: Dynamic Island -->
                            <div class="absolute left-1/2 -translate-x-1/2 top-2 w-[116px] h-[28px] bg-black rounded-full flex items-center justify-between px-2.5 shadow-md">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span class="text-[9px] font-mono text-emerald-400 font-bold">KM 208</span>
                                </div>
                                <div class="w-2.5 h-2.5 rounded-full bg-[#1A1A1A] border border-slate-700"></div>
                            </div>

                            <!-- Right: Cell, WiFi, Battery -->
                            <div class="flex items-center gap-1.5 text-slate-900">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 3c-4.97 0-9 4.03-9 9 0 2.12.74 4.07 1.97 5.61L12 22l7.03-4.39C20.26 16.07 21 14.12 21 12c0-4.97-4.03-9-9-9z"/></svg>
                                <span class="text-[9px] font-bold font-mono">5G</span>
                                <div class="w-4.5 h-2.5 border border-slate-900 rounded-xs p-0.5 flex items-center">
                                    <div class="w-full h-full bg-slate-900 rounded-2xs"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Scrollable Mobile App Body -->
                        <div class="flex-1 overflow-y-auto px-4 py-3 space-y-4 text-xs">
                            
                            <!-- Mobile App Brand Banner -->
                            <div class="bg-white rounded-2xl p-3.5 border border-slate-100 shadow-sm flex items-center justify-between">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <div class="w-8 h-8 rounded-full bg-[#1A1D1F] text-white flex items-center justify-center font-bold text-xs shadow-xs">
                                        {{ strtoupper(substr($selectedOrder->driver_name ?? 'SP', 0, 2)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-bold text-[#1A1D1F] truncate text-xs">{{ $selectedOrder->driver_name ?? 'Sopir Lapangan' }}</div>
                                        <div class="text-[10px] text-slate-400 font-mono">{{ $selectedOrder->vehicle ? $selectedOrder->vehicle->plate_number : 'B 9142 TQU' }}</div>
                                    </div>
                                </div>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span>Aktif</span>
                                </span>
                            </div>

                            <!-- Mobile SPJ Card -->
                            <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm space-y-2.5">
                                <div class="flex items-center justify-between text-[11px]">
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-mono font-bold text-brand-600 bg-brand-50 px-2 py-0.5 rounded-md">
                                            {{ $selectedOrder->order_number }}
                                        </span>
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    </div>
                                    <button type="button" onclick="toggleMobileSpjSheet()" class="text-[10px] font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 px-2.5 py-1 rounded-full flex items-center gap-1 transition shadow-xs">
                                        <span>Ganti SPJ</span>
                                        <i data-lucide="chevron-down" class="w-3 h-3 text-slate-500"></i>
                                    </button>
                                </div>
                                
                                <div class="flex items-center justify-between gap-2 pt-1">
                                    <div>
                                        <div class="text-[10px] uppercase font-bold text-slate-400">Rute Perjalanan</div>
                                        <div class="text-xs font-black text-[#1A1D1F]">{{ $selectedOrder->origin_city }} ➔ {{ $selectedOrder->destination_city }}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-[10px] uppercase font-bold text-slate-400">Muatan</div>
                                        <div class="text-xs font-bold text-slate-700">{{ $selectedOrder->cargo_weight_ton }} Ton</div>
                                    </div>
                                </div>

                                <div class="text-[11px] text-slate-500 bg-slate-50 p-2 rounded-xl border border-slate-100 truncate">
                                    Shipper: <strong>{{ $selectedOrder->shipper_name }}</strong>
                                </div>
                            </div>

                            <!-- iOS Action Sheet Modal for iPhone SPJ Switcher -->
                            <div id="mobileSpjSheet" class="hidden absolute inset-0 z-40 bg-slate-900/60 backdrop-blur-xs flex flex-col justify-end rounded-[44px] p-3" onclick="toggleMobileSpjSheet()">
                                <div class="bg-white rounded-3xl p-4 space-y-3 shadow-2xl max-h-[75%] overflow-y-auto" onclick="event.stopPropagation()">
                                    <div class="w-10 h-1 bg-slate-300 rounded-full mx-auto mb-1"></div>
                                    <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                                        <span class="text-xs font-black text-[#1A1D1F]">Pilih Surat Jalan (SPJ)</span>
                                        <button type="button" onclick="toggleMobileSpjSheet()" class="text-slate-400 hover:text-black">
                                            <i data-lucide="x" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                    <div class="space-y-2">
                                        @foreach($orders as $ord)
                                        <a href="{{ route('driver.index', ['order_id' => $ord->id]) }}" class="block p-3 rounded-2xl border transition {{ $selectedOrder->id === $ord->id ? 'bg-slate-100 border-slate-300 font-bold' : 'bg-slate-50 border-slate-100 hover:bg-slate-100' }}">
                                            <div class="flex items-center justify-between text-[11px]">
                                                <span class="font-mono text-xs font-bold text-[#1A1D1F]">{{ $ord->order_number }}</span>
                                                <span class="text-[9px] uppercase px-2 py-0.5 rounded-full font-bold bg-white text-slate-700 border border-slate-200">{{ $ord->statusLabel() }}</span>
                                            </div>
                                            <div class="text-xs text-slate-800 font-bold mt-1">{{ $ord->origin_city }} ➔ {{ $ord->destination_city }}</div>
                                            <div class="text-[10px] text-slate-400 truncate mt-0.5">{{ $ord->shipper_name }} · {{ $ord->cargo_weight_ton }} Ton</div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Quick Presets Transmitter -->
                            <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1.5 font-bold text-[#1A1D1F] text-xs">
                                        <i data-lucide="radio" class="w-3.5 h-3.5 text-blue-600"></i>
                                        <span>Update Lokasi GPS HP</span>
                                    </div>
                                    <button type="button" onclick="detectDeviceGeolocation('phone')" class="text-[10px] font-bold text-blue-600 hover:underline flex items-center gap-1">
                                        <i data-lucide="locate" class="w-3 h-3"></i>
                                        <span>GPS HP</span>
                                    </button>
                                </div>

                                <!-- Fast Tap Presets on Phone Screen -->
                                <div class="grid grid-cols-2 gap-1.5">
                                    <button type="button" onclick="setPresetBoth('Tol KM 57 Cikampek', -6.3892, 107.3014, 75)" class="px-2.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-[10px] font-semibold text-left transition truncate">
                                        📍 KM 57 Cikampek
                                    </button>
                                    <button type="button" onclick="setPresetBoth('Tol KM 102 Cipali', -6.5218, 107.6942, 80)" class="px-2.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-[10px] font-semibold text-left transition truncate">
                                        📍 KM 102 Cipali
                                    </button>
                                    <button type="button" onclick="setPresetBoth('Tol KM 208 Palimanan', -6.7214, 108.4521, 78)" class="px-2.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-[10px] font-semibold text-left transition truncate">
                                        📍 KM 208 Palimanan
                                    </button>
                                    <button type="button" onclick="setPresetBoth('Tol KM 318 Batang', -6.9147, 109.6021, 72)" class="px-2.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-[10px] font-semibold text-left transition truncate">
                                        📍 KM 318 Batang
                                    </button>
                                    <button type="button" onclick="setPresetBoth('Tol KM 429 Semarang', -7.1215, 110.4128, 70)" class="px-2.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-[10px] font-semibold text-left transition truncate">
                                        📍 KM 429 Semarang
                                    </button>
                                    <button type="button" onclick="setPresetBoth('Tol KM 715 Surabaya', -7.3218, 112.7214, 60)" class="px-2.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-[10px] font-semibold text-left transition truncate">
                                        📍 KM 715 Surabaya
                                    </button>
                                </div>

                                <!-- Phone Ping Form -->
                                <form action="{{ route('driver.ping', $selectedOrder) }}" method="POST" class="space-y-2.5 pt-1">
                                    @csrf
                                    <input type="text" id="pingLocationNamePhone" name="location_name" required value="{{ old('location_name', 'Tol Trans-Jawa KM 208, Palimanan') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-slate-900 focus:outline-none">

                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="text" id="pingLatitudePhone" name="latitude" required value="{{ old('latitude', '-6.7214') }}" class="w-full px-2.5 py-1.5 rounded-xl border border-slate-200 font-mono text-[11px] focus:outline-none">
                                        <input type="text" id="pingLongitudePhone" name="longitude" required value="{{ old('longitude', '108.4521') }}" class="w-full px-2.5 py-1.5 rounded-xl border border-slate-200 font-mono text-[11px] focus:outline-none">
                                    </div>

                                    <input type="hidden" id="pingSpeedPhone" name="speed_kmh" value="75">
                                    <input type="hidden" name="notes" value="Pembaruan posisi instan via iPhone 15 Pro driver.">

                                    <button type="submit" class="w-full py-2.5 rounded-full bg-[#1A1D1F] hover:bg-black text-white font-bold text-xs shadow-sm transition flex items-center justify-center gap-1.5">
                                        <i data-lucide="radio" class="w-3.5 h-3.5 text-emerald-400"></i>
                                        <span>Kirim Lokasi Satelit</span>
                                    </button>
                                </form>
                            </div>

                            <!-- Mobile Digital E-POD Studio -->
                            <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1.5 font-bold text-[#1A1D1F] text-xs">
                                        <i data-lucide="file-check-2" class="w-3.5 h-3.5 text-emerald-600"></i>
                                        <span>E-POD Digital Bukti Serah</span>
                                    </div>
                                    <span class="text-[9px] font-mono text-slate-400 font-bold uppercase">Sah UU ITE</span>
                                </div>

                                @if($selectedOrder->pod_uploaded_at)
                                    <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 space-y-2">
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                                            <span class="font-bold text-xs">E-POD Terverifikasi</span>
                                        </div>
                                        <div class="text-[10px] text-emerald-700">
                                            Penerima: <strong>{{ $selectedOrder->pod_signer_name }}</strong><br>
                                            Waktu: {{ $selectedOrder->pod_uploaded_at->format('d/m/Y H:i') }} WIB
                                        </div>
                                    </div>
                                @else
                                    <form action="{{ route('driver.upload-pod', $selectedOrder) }}" method="POST" enctype="multipart/form-data" class="space-y-2.5">
                                        @csrf
                                        <input type="text" name="pod_signer_name" required value="{{ old('pod_signer_name') }}" placeholder="Nama Penerima Gudang *" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-emerald-600 focus:outline-none">

                                        <label for="pod_image_phone" class="block border-2 border-dashed border-slate-200 hover:border-emerald-500 rounded-xl p-3 text-center bg-slate-50/70 cursor-pointer transition">
                                            <img id="podPreviewPhone" class="hidden mx-auto max-h-24 rounded-lg mb-2 object-cover" alt="Pratinjau" />
                                            <div id="podPromptPhone" class="space-y-1">
                                                <i data-lucide="camera" class="w-4 h-4 text-emerald-600 mx-auto"></i>
                                                <span class="text-[11px] font-bold text-slate-700 block">Foto Surat Jalan Cap Basah</span>
                                            </div>
                                        </label>
                                        <input id="pod_image_phone" type="file" name="pod_image" accept="image/*" capture="environment" class="sr-only">

                                        <button type="submit" class="w-full py-2.5 rounded-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-sm transition flex items-center justify-center gap-1.5">
                                            <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                            <span>Selesaikan E-POD</span>
                                        </button>
                                    </form>
                                @endif
                            </div>

                        </div>

                        <!-- Bottom iOS Home Indicator -->
                        <div class="h-6 flex items-center justify-center shrink-0 bg-[#F4F5F6]/90 backdrop-blur-md">
                            <div class="w-32 h-1 bg-slate-400/80 rounded-full"></div>
                        </div>

                    </div>
                </div>

                <!-- Subtle Caption under Phone -->
                <p class="mt-2 text-[11px] text-slate-400 text-center">
                    Simulasi UI responsif resolusi native iPhone 15 (393 × 852 px).
                </p>

            </div>

        </div>
        @else
        <div class="bg-white rounded-[28px] p-12 text-center max-w-lg mx-auto border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-4">
            <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto">
                <i data-lucide="truck" class="w-8 h-8"></i>
            </div>
            <h2 class="text-lg font-black text-[#1A1D1F]">Tidak Ada Pesanan Aktif</h2>
            <p class="text-xs text-slate-500">Saat ini tidak ada armada atau pesanan kargo yang ditugaskan ke profil Anda.</p>
            <a href="{{ route('admin.orders.index') }}" class="inline-flex px-5 py-2.5 rounded-full bg-[#1A1D1F] text-white text-xs font-bold hover:bg-black transition">
                Buka Daftar Pesanan Admin
            </a>
        </div>
        @endif

    </main>

</div>

@push('scripts')
<script>
    // Custom Bento SPJ Dropdown Toggle
    function toggleSpjDropdown(e) {
        if (e) e.stopPropagation();
        const menu = document.getElementById('dropdownSpjMenu');
        const chevron = document.getElementById('dropdownSpjChevron');
        const trigger = document.getElementById('dropdownSpjTrigger');
        if (!menu) return;

        const isOpen = !menu.classList.contains('hidden');
        if (isOpen) {
            menu.classList.add('hidden');
            chevron?.classList.remove('rotate-180');
            trigger?.setAttribute('aria-expanded', 'false');
        } else {
            menu.classList.remove('hidden');
            chevron?.classList.add('rotate-180');
            trigger?.setAttribute('aria-expanded', 'true');
        }
    }

    // Mobile iPhone SPJ Sheet Toggle
    function toggleMobileSpjSheet() {
        const sheet = document.getElementById('mobileSpjSheet');
        if (sheet) {
            sheet.classList.toggle('hidden');
        }
    }

    // Close Dropdown on Outside Click
    document.addEventListener('click', function(e) {
        const wrapper = document.getElementById('dropdownSpjWrapper');
        const menu = document.getElementById('dropdownSpjMenu');
        const chevron = document.getElementById('dropdownSpjChevron');
        const trigger = document.getElementById('dropdownSpjTrigger');
        if (menu && !wrapper?.contains(e.target)) {
            menu.classList.add('hidden');
            chevron?.classList.remove('rotate-180');
            trigger?.setAttribute('aria-expanded', 'false');
        }
    });

    // Close on Escape Key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const menu = document.getElementById('dropdownSpjMenu');
            const chevron = document.getElementById('dropdownSpjChevron');
            const trigger = document.getElementById('dropdownSpjTrigger');
            if (menu && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
                chevron?.classList.remove('rotate-180');
                trigger?.setAttribute('aria-expanded', 'false');
            }
            const sheet = document.getElementById('mobileSpjSheet');
            if (sheet && !sheet.classList.contains('hidden')) {
                sheet.classList.add('hidden');
            }
        }
    });

    // Mode Switcher: 'split' | 'phone' | 'web'
    function switchDriverMode(mode) {
        const studioContainer = document.getElementById('driverStudioContainer');
        const webSection = document.getElementById('viewWebSection');
        const phoneSection = document.getElementById('viewPhoneSection');

        const btnSplit = document.getElementById('btnModeSplit');
        const btnPhone = document.getElementById('btnModePhone');
        const btnWeb = document.getElementById('btnModeWeb');

        const btnSplitMob = document.getElementById('btnModeSplitMobile');
        const btnPhoneMob = document.getElementById('btnModePhoneMobile');
        const btnWebMob = document.getElementById('btnModeWebMobile');

        // Reset button active classes
        [btnSplit, btnPhone, btnWeb].forEach(b => {
            if (b) {
                b.classList.remove('bg-white', 'text-[#1A1D1F]', 'shadow-sm');
                b.classList.add('text-slate-500');
            }
        });
        [btnSplitMob, btnPhoneMob, btnWebMob].forEach(b => {
            if (b) {
                b.classList.remove('bg-white', 'text-black', 'shadow-xs');
                b.classList.add('text-slate-600');
            }
        });

        if (mode === 'split') {
            if (webSection) webSection.classList.remove('hidden', 'lg:col-span-12');
            if (webSection) webSection.classList.add('lg:col-span-7');
            if (phoneSection) phoneSection.classList.remove('hidden');
            if (phoneSection) phoneSection.classList.add('lg:col-span-5');

            btnSplit?.classList.add('bg-white', 'text-[#1A1D1F]', 'shadow-sm');
            btnSplitMob?.classList.add('bg-white', 'text-black', 'shadow-xs');
        } else if (mode === 'phone') {
            if (webSection) webSection.classList.add('hidden');
            if (phoneSection) phoneSection.classList.remove('hidden', 'lg:col-span-5');
            if (phoneSection) phoneSection.classList.add('lg:col-span-12');

            btnPhone?.classList.add('bg-white', 'text-[#1A1D1F]', 'shadow-sm');
            btnPhoneMob?.classList.add('bg-white', 'text-black', 'shadow-xs');
        } else if (mode === 'web') {
            if (phoneSection) phoneSection.classList.add('hidden');
            if (webSection) webSection.classList.remove('hidden', 'lg:col-span-7');
            if (webSection) webSection.classList.add('lg:col-span-12');

            btnWeb?.classList.add('bg-white', 'text-[#1A1D1F]', 'shadow-sm');
            btnWebMob?.classList.add('bg-white', 'text-black', 'shadow-xs');
        }

        try {
            localStorage.setItem('driver_view_mode', mode);
        } catch (e) {}
    }

    // Set Preset Location into Both Web and Phone Forms
    function setPresetBoth(name, lat, lng, speed) {
        const nameWeb = document.getElementById('pingLocationNameWeb');
        const latWeb = document.getElementById('pingLatitudeWeb');
        const lngWeb = document.getElementById('pingLongitudeWeb');
        const speedWeb = document.getElementById('pingSpeedWeb');

        const namePhone = document.getElementById('pingLocationNamePhone');
        const latPhone = document.getElementById('pingLatitudePhone');
        const lngPhone = document.getElementById('pingLongitudePhone');
        const speedPhone = document.getElementById('pingSpeedPhone');

        if (nameWeb) nameWeb.value = name;
        if (latWeb) latWeb.value = lat;
        if (lngWeb) lngWeb.value = lng;
        if (speedWeb) speedWeb.value = speed;

        if (namePhone) namePhone.value = name;
        if (latPhone) latPhone.value = lat;
        if (lngPhone) lngPhone.value = lng;
        if (speedPhone) speedPhone.value = speed;

        // Visual flash indication
        [nameWeb, namePhone].forEach(el => {
            if (el) {
                el.classList.add('bg-blue-50');
                setTimeout(() => el.classList.remove('bg-blue-50'), 600);
            }
        });
    }

    // Real Browser / Smartphone Geolocation Auto-Detect
    function detectDeviceGeolocation(target) {
        if (!navigator.geolocation) {
            alert('Sensor GPS tidak didukung di browser ini.');
            return;
        }

        const nameWeb = document.getElementById('pingLocationNameWeb');
        const latWeb = document.getElementById('pingLatitudeWeb');
        const lngWeb = document.getElementById('pingLongitudeWeb');

        const namePhone = document.getElementById('pingLocationNamePhone');
        const latPhone = document.getElementById('pingLatitudePhone');
        const lngPhone = document.getElementById('pingLongitudePhone');

        const statusMsg = 'Mendeteksi satelit GPS...';
        if (nameWeb) nameWeb.value = statusMsg;
        if (namePhone) namePhone.value = statusMsg;

        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude.toFixed(6);
                const lng = position.coords.longitude.toFixed(6);
                const locLabel = 'Posisi GPS Akurat (' + lat + ', ' + lng + ')';

                if (latWeb) latWeb.value = lat;
                if (lngWeb) lngWeb.value = lng;
                if (nameWeb) nameWeb.value = locLabel;

                if (latPhone) latPhone.value = lat;
                if (lngPhone) lngPhone.value = lng;
                if (namePhone) namePhone.value = locLabel;
            },
            (error) => {
                alert('Gagal membaca GPS otomatis: ' + error.message + '. Gunakan preset Trans-Jawa.');
                const fallback = 'Tol Trans-Jawa (Manual)';
                if (nameWeb) nameWeb.value = fallback;
                if (namePhone) namePhone.value = fallback;
            },
            { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
        );
    }

    // Phone E-POD Image Live Preview
    (function () {
        const fileInput = document.getElementById('pod_image_phone');
        const preview = document.getElementById('podPreviewPhone');
        const prompt = document.getElementById('podPromptPhone');

        if (fileInput && preview && prompt) {
            fileInput.addEventListener('change', function () {
                const file = fileInput.files && fileInput.files[0];
                if (!file) return;

                const url = URL.createObjectURL(file);
                preview.src = url;
                preview.classList.remove('hidden');
                prompt.classList.add('hidden');
            });
        }
    })();

    // Restore user preferred layout mode on load
    document.addEventListener('DOMContentLoaded', () => {
        try {
            const saved = localStorage.getItem('driver_view_mode');
            if (saved === 'phone' || saved === 'web' || saved === 'split') {
                switchDriverMode(saved);
            }
        } catch (e) {}
    });
</script>
@endpush
@endsection