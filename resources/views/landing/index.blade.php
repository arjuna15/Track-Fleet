@extends('layouts.app')

@section('title', 'TrackFleet — Sistem Operasi Armada & Pengaman Margin Logistik B2B')
@section('meta_description', 'Platform operasional logistik cerdas. Pantau pergerakan truk live GPS dari ponsel sopir, kunci margin laba sebelum kirim dengan Margin Guard <10%, dan verifikasi bukti serah terima digital (E-POD).')

@section('content')

<!-- ==========================================
     HERO SECTION (Consistent Enterprise Brand)
     ========================================== -->
<section class="relative overflow-hidden pt-28 pb-20 lg:pt-36 lg:pb-28 bg-slate-950 text-white">
    <!-- Ambient Tech Glow & Grid Background -->
    <div class="absolute inset-0 bg-[radial-gradient(#2563eb_1px,transparent_1px)] [background-size:24px_24px] opacity-10 pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[400px] bg-brand-600/10 rounded-full blur-[160px] pointer-events-none"></div>

    <div class="relative w-full px-4 sm:px-6 md:px-10 lg:px-12 xl:px-16 2xl:px-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-14 items-center">
            
            <!-- Hero Left: Value Proposition -->
            <div class="lg:col-span-7 space-y-7 text-center lg:text-left animate-fade-up">
                
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-brand-500/15 text-brand-300 border border-brand-500/30 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-brand-400 animate-pulse"></span>
                    <span>TrackFleet OS v2.4 • Platform Operasi Logistik B2B Terpadu</span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.12]">
                    Kendali kiriman &amp;<br>
                    <span class="text-brand-400">
                        Amankan Margin Laba,
                    </span><br>
                    Tanpa Hardware Mahal.
                </h1>

                <p class="text-base sm:text-lg text-slate-300 max-w-2xl leading-relaxed">
                    Satu sistem operasional terintegrasi untuk menghentikan pesanan boncos via <strong class="text-white">Margin Guard &lt;10%</strong>, memantau posisi truk live GPS langsung dari ponsel sopir, hingga menerbitkan invoice otomatis berlandaskan bukti serah terima digital (<strong class="text-white">E-POD</strong>) yang sah.
                </p>

                <!-- Action CTAs -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3 sm:gap-4 pt-2">
                    <a href="{{ route('admin.dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-7 py-4 rounded-xl text-sm font-bold text-white bg-brand-600 hover:bg-brand-500 shadow-xl shadow-brand-600/30 transition transform hover:-translate-y-0.5">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        <span>Buka Dashboard Operasional</span>
                    </a>
                    
                    <a href="{{ route('tracking.public') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl text-sm font-semibold text-slate-200 bg-slate-800/90 hover:bg-slate-800 border border-slate-700/90 hover:border-slate-600 transition">
                        <i data-lucide="search" class="w-4 h-4 text-brand-400"></i>
                        <span>Lacak Nomor Resi</span>
                    </a>

                    <a href="{{ route('driver.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-4 rounded-xl text-sm font-semibold text-slate-300 hover:text-white bg-slate-900/80 hover:bg-slate-800 border border-slate-800 hover:border-slate-700 transition">
                        <i data-lucide="smartphone" class="w-4 h-4 text-brand-400"></i>
                        <span>Simulasi Sopir</span>
                    </a>
                </div>

                <!-- Live Micro Trust Badges (Unified Single Brand Tone) -->
                <div class="pt-6 grid grid-cols-2 sm:grid-cols-4 gap-4 border-t border-slate-800/80 text-left">
                    <div class="flex items-start gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-brand-500/10 border border-brand-500/20 flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="shield-check" class="w-4 h-4 text-brand-400"></i>
                        </div>
                        <div class="text-xs">
                            <div class="font-bold text-white">UU PDP Compliant</div>
                            <div class="text-[11px] text-slate-400">No. 27/2022 Amanat</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-brand-500/10 border border-brand-500/20 flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="smartphone" class="w-4 h-4 text-brand-400"></i>
                        </div>
                        <div class="text-xs">
                            <div class="font-bold text-white">Zero Hardware</div>
                            <div class="text-[11px] text-slate-400">Cukup GPS Ponsel</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-brand-500/10 border border-brand-500/20 flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="calculator" class="w-4 h-4 text-brand-400"></i>
                        </div>
                        <div class="text-xs">
                            <div class="font-bold text-white">Margin Guard</div>
                            <div class="text-[11px] text-slate-400">Cegah Order Boncos</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-brand-500/10 border border-brand-500/20 flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="file-check-2" class="w-4 h-4 text-brand-400"></i>
                        </div>
                        <div class="text-xs">
                            <div class="font-bold text-white">Sah UU ITE</div>
                            <div class="text-[11px] text-slate-400">No. 1/2024 Legal E-POD</div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Hero Right: Interactive Live Simulation Mission Card -->
            <div class="lg:col-span-5 animate-scale-in">
                <div class="relative mx-auto max-w-lg rounded-2xl p-[1px] bg-gradient-to-b from-brand-500/30 via-slate-800 to-slate-800 shadow-2xl">
                    <div class="relative rounded-2xl bg-slate-950 overflow-hidden border border-slate-800">
                        
                        <!-- Top Window Frame Header -->
                        <div class="px-5 py-3.5 bg-slate-950 border-b border-slate-800 flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-slate-600"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-slate-600"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-slate-600"></span>
                                <span class="text-xs font-mono text-slate-400 ml-2">Mission Control v2.4</span>
                            </div>
                            <span class="text-[10px] font-mono text-brand-300 bg-brand-500/10 px-2 py-0.5 rounded border border-brand-500/25 flex items-center gap-1.5 font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-brand-400 animate-pulse"></span>
                                DEMO · LIVE DISPATCH
                            </span>
                        </div>

                        <!-- Interactive Mission Tabs -->
                        <div class="p-2 bg-slate-950 border-b border-slate-800 flex gap-1.5 text-xs font-medium" role="tablist" aria-label="Pratinjau fitur inti TrackFleet">
                            <button type="button" role="tab" aria-selected="true" aria-controls="hero-panel-telemetry" tabindex="0" onclick="switchHeroTab('telemetry')" id="tab-btn-telemetry" class="flex-1 py-2 px-2.5 rounded-xl bg-brand-600 text-white font-bold transition text-center flex items-center justify-center gap-1.5 shadow-sm">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5" aria-hidden="true"></i>
                                <span>1. Telemetri</span>
                            </button>
                            <button type="button" role="tab" aria-selected="false" aria-controls="hero-panel-margin" tabindex="-1" onclick="switchHeroTab('margin')" id="tab-btn-margin" class="flex-1 py-2 px-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-900 transition text-center flex items-center justify-center gap-1.5">
                                <i data-lucide="calculator" class="w-3.5 h-3.5" aria-hidden="true"></i>
                                <span>2. Margin Laba</span>
                            </button>
                            <button type="button" role="tab" aria-selected="false" aria-controls="hero-panel-epod" tabindex="-1" onclick="switchHeroTab('epod')" id="tab-btn-epod" class="flex-1 py-2 px-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-900 transition text-center flex items-center justify-center gap-1.5">
                                <i data-lucide="file-check-2" class="w-3.5 h-3.5" aria-hidden="true"></i>
                                <span>3. E-POD Sah</span>
                            </button>
                        </div>

                        <!-- Panel 1: Live Telemetry -->
                        <div id="hero-panel-telemetry" role="tabpanel" aria-labelledby="tab-btn-telemetry" tabindex="0" class="p-5 space-y-4">
                            <div class="p-3.5 rounded-xl bg-slate-900/90 border border-slate-800">
                                <div class="flex justify-between items-center text-xs text-slate-400">
                                    <span class="font-mono text-slate-300 font-bold">TRK-JKTSBY89</span>
                                    <span class="px-2 py-0.5 rounded-full bg-brand-500/15 text-brand-300 font-bold text-[10px] uppercase border border-brand-500/30">
                                        Dalam Perjalanan
                                    </span>
                                </div>
                                <div class="mt-2 text-sm font-bold text-white flex items-center gap-2">
                                    <span>MM2100 Cikarang</span>
                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-brand-400"></i>
                                    <span>Rungkut Surabaya</span>
                                </div>
                                <div class="text-xs text-slate-400 mt-1 flex items-center gap-2">
                                    <i data-lucide="truck" class="w-3.5 h-3.5 text-brand-400"></i>
                                    <span>Tronton Wingbox • B 9142 TQU (Sopir: Supriyadi)</span>
                                </div>
                            </div>

                            <div class="p-3.5 rounded-xl bg-slate-900/90 border border-slate-800 space-y-2">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-slate-400 flex items-center gap-1.5">
                                        <i data-lucide="navigation-2" class="w-3.5 h-3.5 text-brand-400"></i>
                                        Titik GPS Terakhir
                                    </span>
                                    <span class="text-brand-300 font-mono text-[11px] font-bold">Kecepatan 68 km/jam</span>
                                </div>
                                <div class="text-xs font-semibold text-white">Tol Trans-Jawa KM 348 (Batang, Jawa Tengah)</div>
                                <div class="w-full bg-slate-800 rounded-full h-2 overflow-hidden">
                                    <div class="bg-brand-500 h-2 rounded-full w-[72%] transition-all duration-500"></div>
                                </div>
                                <div class="flex justify-between text-[11px] text-slate-400 font-mono pt-0.5">
                                    <span>Terkirim: 420 KM</span>
                                    <span>Sisa: 180 KM (ETA 14:15 WIB)</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3 text-xs">
                                <div class="p-2.5 rounded-lg bg-slate-900/90 border border-slate-800">
                                    <div class="text-slate-500 text-[10px] uppercase">Biaya BBM Solar</div>
                                    <div class="font-bold font-mono text-slate-200 mt-0.5">Rp 2.450.000</div>
                                </div>
                                <div class="p-2.5 rounded-lg bg-slate-900/90 border border-slate-800">
                                    <div class="text-slate-500 text-[10px] uppercase">Tarif Tol Trans-Jawa</div>
                                    <div class="font-bold font-mono text-slate-200 mt-0.5">Rp 1.120.000</div>
                                </div>
                            </div>
                        </div>

                        <!-- Panel 2: Margin Guard (Hidden by default) -->
                        <div id="hero-panel-margin" role="tabpanel" aria-labelledby="tab-btn-margin" tabindex="0" class="p-5 space-y-4 hidden">
                            <div class="p-4 rounded-xl bg-slate-900/90 border border-brand-500/30 space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold uppercase tracking-wider text-brand-400 flex items-center gap-1.5">
                                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                                        Margin Guard: STATUS AMAN
                                    </span>
                                    <span class="px-2 py-0.5 rounded-full bg-brand-500/20 text-brand-300 font-mono font-bold text-xs">
                                        +18,28% Laba
                                    </span>
                                </div>
                                <div class="text-2xl font-black text-white font-mono">Rp 2.650.000</div>
                                <div class="text-xs text-slate-400">
                                    Proyeksi keuntungan bersih setelah dipotong seluruh biaya operasional &amp; fee vendor.
                                </div>
                            </div>

                            <div class="space-y-2 text-xs">
                                <div class="flex justify-between p-2.5 rounded-lg bg-slate-900/90 border border-slate-800">
                                    <span class="text-slate-400">Nilai Kontrak Muatan (Shipper):</span>
                                    <span class="font-mono font-bold text-white">Rp 14.500.000</span>
                                </div>
                                <div class="flex justify-between p-2.5 rounded-lg bg-slate-900/90 border border-slate-800">
                                    <span class="text-slate-400">Total Biaya Jalan &amp; Muat Bongkar:</span>
                                    <span class="font-mono text-slate-300">- Rp 11.850.000</span>
                                </div>
                                <div class="flex justify-between p-2.5 rounded-lg bg-brand-500/10 border border-brand-500/25 text-brand-300 font-bold">
                                    <span>Margin Bersih Terselamatkan:</span>
                                    <span class="font-mono">Rp 2.650.000 (18,28%)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Panel 3: E-POD Digital Proof (Hidden by default) -->
                        <div id="hero-panel-epod" role="tabpanel" aria-labelledby="tab-btn-epod" tabindex="0" class="p-5 space-y-4 hidden">
                            <div class="p-3.5 rounded-xl bg-slate-900/90 border border-slate-800 space-y-2">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-bold text-slate-200 flex items-center gap-1.5">
                                        <i data-lucide="file-check-2" class="w-4 h-4 text-brand-400"></i>
                                        E-POD Digital Terverifikasi
                                    </span>
                                    <span class="font-mono text-[10px] text-brand-300 bg-brand-500/10 px-2 py-0.5 rounded border border-brand-500/20 font-bold">SAH HUKUM</span>
                                </div>
                                <div class="text-xs text-slate-400 leading-relaxed">
                                    Penerima: <strong class="text-white">Bpk. Hendro Santoso (Gudang Rungkut)</strong><br>
                                    Waktu Serah Terima: <span class="font-mono text-slate-300">16 Nov 2026, 11:42 WIB</span>
                                </div>
                                <div class="p-3 bg-slate-950 rounded-lg border border-slate-800 text-center">
                                    <div class="text-[10px] text-slate-500 font-mono mb-1">Tanda Tangan Digital Penerima</div>
                                    <div class="font-serif italic text-lg text-brand-300 tracking-wider">Hendro Santoso</div>
                                    <div class="text-[9px] text-slate-500 font-mono mt-1">SHA-256 Hash: 8f4b...c92a (Geo-tagged Surabaya)</div>
                                </div>
                            </div>

                            <div class="p-3 rounded-xl bg-brand-500/10 border border-brand-500/25 flex items-center justify-between text-xs">
                                <span class="text-brand-300 font-medium">Faktur Siap Diterbitkan</span>
                                <span class="font-mono font-bold text-white">Invoice #INV-202611-008</span>
                            </div>
                        </div>

                        <!-- Bottom Quick Links in Preview Card -->
                        <div class="px-5 py-3.5 bg-slate-950 border-t border-slate-800 flex items-center justify-between text-xs">
                            <span class="text-slate-400">Ingin coba langsung?</span>
                            <a href="{{ route('driver.index') }}" class="font-bold text-brand-400 hover:text-brand-300 transition flex items-center gap-1">
                                Buka Aplikasi Sopir <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ==========================================
     LOGISTICS CORRIDORS & REAL-TIME STATS
     Executive Network Console & Operational KPIs
     ========================================== -->
<section class="py-12 bg-slate-50 border-y border-slate-200/70">
    <div class="w-full px-4 sm:px-6 md:px-10 lg:px-12 xl:px-16 2xl:px-20">
        
        <!-- Live Corridors Network Ticker -->
        <div class="reveal p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col lg:flex-row items-center justify-between gap-4 text-xs text-slate-600 mb-8">
            <div class="flex items-center gap-2.5 font-bold uppercase tracking-wider text-slate-800 shrink-0">
                <span class="w-2.5 h-2.5 rounded-full bg-brand-600 animate-pulse"></span>
                <i data-lucide="map" class="w-4 h-4 text-brand-600"></i>
                <span>Jaringan Koridor Terintegrasi:</span>
            </div>
            
            <div class="flex flex-wrap items-center justify-center lg:justify-end gap-2 sm:gap-2.5 font-medium">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-50 border border-slate-200 text-slate-700 shadow-2xs hover:border-brand-300 transition">
                    <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600"></i>
                    <span>Trans-Jawa (Merak – Banyuwangi)</span>
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-50 border border-slate-200 text-slate-700 shadow-2xs hover:border-brand-300 transition">
                    <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600"></i>
                    <span>Lintas Sumatra (Bakauheni – Medan)</span>
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-50 border border-slate-200 text-slate-700 shadow-2xs hover:border-brand-300 transition">
                    <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600"></i>
                    <span>Pelabuhan Tanjung Priok &amp; Perak</span>
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-50 border border-slate-200 text-slate-700 shadow-2xs hover:border-brand-300 transition">
                    <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600"></i>
                    <span>MM2100, Cikarang &amp; KIIC Karawang</span>
                </span>
            </div>
        </div>

        <!-- Metric Counter Grid (4 Executive KPI Cards) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            
            <!-- Metric 1: Armada Terpantau -->
            <div class="reveal p-6 rounded-2xl bg-white border border-slate-200/90 hover:border-brand-500/40 hover:shadow-lg transition duration-200 flex flex-col justify-between space-y-4 shadow-sm group">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100 group-hover:scale-105 transition">
                        <i data-lucide="truck" class="w-5 h-5"></i>
                    </div>
                    <span class="text-[10px] font-mono font-bold uppercase text-brand-700 bg-brand-100/70 px-2 py-0.5 rounded border border-brand-200">
                        DEMO · LIVE GPS
                    </span>
                </div>
                <div>
                    <div class="text-3xl sm:text-4xl font-black text-slate-900 font-mono tracking-tight" data-count="{{ $stats['total_active_fleet'] }}">0</div>
                    <div class="text-sm font-bold text-slate-800 mt-1">Armada Terpantau Aktif</div>
                    <div class="text-xs text-slate-500 mt-0.5">Tronton, Fuso, CDD, dan Wingbox</div>
                </div>
                <div class="pt-3 border-t border-slate-100 flex items-center gap-1.5 text-[11px] text-slate-500">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-600"></span>
                    <span>Sinkronisasi rute tiap 10 detik</span>
                </div>
            </div>

            <!-- Metric 2: Provinsi Terlayani -->
            <div class="reveal p-6 rounded-2xl bg-white border border-slate-200/90 hover:border-brand-500/40 hover:shadow-lg transition duration-200 flex flex-col justify-between space-y-4 shadow-sm group" style="--reveal-delay:80ms">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100 group-hover:scale-105 transition">
                        <i data-lucide="map-pin" class="w-5 h-5"></i>
                    </div>
                    <span class="text-[10px] font-mono font-bold uppercase text-brand-700 bg-brand-100/70 px-2 py-0.5 rounded border border-brand-200">
                        INTER-ISLAND
                    </span>
                </div>
                <div>
                    <div class="text-3xl sm:text-4xl font-black text-slate-900 font-mono tracking-tight" data-count="{{ $stats['provinces_covered'] }}">0</div>
                    <div class="text-sm font-bold text-slate-800 mt-1">Provinsi Terlayani</div>
                    <div class="text-xs text-slate-500 mt-0.5">Jawa, Sumatra, Bali, dan Madura</div>
                </div>
                <div class="pt-3 border-t border-slate-100 flex items-center gap-1.5 text-[11px] text-slate-500">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-600"></span>
                    <span>Cakupan lintas pulau nasional</span>
                </div>
            </div>

            <!-- Metric 3: Rata-Rata Margin Terjaga -->
            <div class="reveal p-6 rounded-2xl bg-white border border-slate-200/90 hover:border-brand-500/40 hover:shadow-lg transition duration-200 flex flex-col justify-between space-y-4 shadow-sm group" style="--reveal-delay:160ms">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100 group-hover:scale-105 transition">
                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                    </div>
                    <span class="text-[10px] font-mono font-bold uppercase text-brand-700 bg-brand-100/70 px-2 py-0.5 rounded border border-brand-200">
                        MARGIN GUARD
                    </span>
                </div>
                <div>
                    <div class="text-3xl sm:text-4xl font-black text-slate-900 font-mono tracking-tight">{{ $stats['margin_saved_percentage'] }}</div>
                    <div class="text-sm font-bold text-slate-800 mt-1">Rata-Rata Margin Terjaga</div>
                    <div class="text-xs text-slate-500 mt-0.5">Terhindar dari order boncos (&lt;10%)</div>
                </div>
                <div class="pt-3 border-t border-slate-100 flex items-center gap-1.5 text-[11px] text-slate-500">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-600"></span>
                    <span>Proteksi laba kotor sebelum jalan</span>
                </div>
            </div>

            <!-- Metric 4: Perjalanan Terkelola -->
            <div class="reveal p-6 rounded-2xl bg-white border border-slate-200/90 hover:border-brand-500/40 hover:shadow-lg transition duration-200 flex flex-col justify-between space-y-4 shadow-sm group" style="--reveal-delay:240ms">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100 group-hover:scale-105 transition">
                        <i data-lucide="file-check-2" class="w-5 h-5"></i>
                    </div>
                    <span class="text-[10px] font-mono font-bold uppercase text-brand-700 bg-brand-100/70 px-2 py-0.5 rounded border border-brand-200">
                        SAH UU ITE
                    </span>
                </div>
                <div>
                    <div class="text-3xl sm:text-4xl font-black text-slate-900 font-mono tracking-tight" data-count="{{ $stats['total_trips'] }}">0</div>
                    <div class="text-sm font-bold text-slate-800 mt-1">Perjalanan Terkelola</div>
                    <div class="text-xs text-slate-500 mt-0.5">Surat jalan &amp; E-POD sah tersimpan</div>
                </div>
                <div class="pt-3 border-t border-slate-100 flex items-center gap-1.5 text-[11px] text-slate-500">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-600"></span>
                    <span>Integritas bukti serah terima digital</span>
                </div>
            </div>

        </div>

    </div>
</section>


<!-- ==========================================
     PROBLEM & SOLUTION (Kenapa Margin Bocor?)
     Clean, Monochromatic, Unified Brand Color
     ========================================== -->
<section class="py-20 bg-white">
    <div class="w-full px-4 sm:px-6 md:px-10 lg:px-12 xl:px-16 2xl:px-20">
        
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <span class="text-xs font-bold tracking-wider uppercase text-brand-600 bg-brand-50 px-3.5 py-1 rounded-full border border-brand-200">
                Tantangan Nyata Transporter Indonesia
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-4 tracking-tight">
                3 Titik Kebocoran Profit Logistik yang Sering Terabaikan
            </h2>
            <p class="text-slate-600 mt-3 text-base leading-relaxed">
                Kesalahan hitung ongkos di awal dan keterlambatan bukti serah terima adalah 2 penyebab terbesar margin transporter bocor tanpa disadari.
            </p>
        </div>

        <!-- 3 Problem vs Solution Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            
            <!-- Problem 1: Margin Bocor -->
            <div class="reveal p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl transition duration-300 flex flex-col justify-between space-y-6 group shadow-sm">
                <!-- Top Section with flex-1 for strict baseline alignment -->
                <div class="flex flex-col justify-between flex-1 space-y-4">
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center font-bold border border-slate-200 shadow-sm">
                                <i data-lucide="trending-down" class="w-6 h-6 text-brand-600"></i>
                            </div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-700 bg-slate-100 px-2.5 py-1 rounded border border-slate-200">
                                RISIKO MARGIN MINUS
                            </span>
                        </div>

                        <div class="mt-4">
                            <div class="text-xs font-mono font-bold uppercase text-brand-600 tracking-wider">Tantangan #1</div>
                            <h3 class="text-lg sm:text-xl font-bold text-slate-900 mt-1">Pesanan Boncos Tanpa Sadar</h3>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mt-2 sm:min-h-[72px]">
                                <strong class="text-slate-900">Salah estimasi tol &amp; solar</strong> bikin margin lenyap di jalan. Truk jalan terus, tapi pembukuan kas bulanan tetap tekor.
                            </p>
                        </div>
                    </div>

                    <!-- Pinned Impact Stat Box -->
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-xs flex items-center justify-between">
                        <div class="flex items-center gap-1.5 text-slate-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                            <span class="font-medium text-slate-500">Estimasi Kerugian:</span>
                        </div>
                        <span class="font-bold font-mono text-slate-900 bg-white px-2.5 py-1 rounded border border-slate-200">
                            Rp 1.500.000 / trip
                        </span>
                    </div>
                </div>

                <!-- Solution Box -->
                <div class="p-4 rounded-xl bg-brand-50/60 border border-brand-200/90 space-y-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5 text-xs font-bold text-brand-700">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-600"></i>
                            <span>Solusi TrackFleet:</span>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-brand-700 bg-brand-100 px-2 py-0.5 rounded border border-brand-200">
                            MARGIN GUARD
                        </span>
                    </div>
                    <p class="text-xs text-slate-700 leading-relaxed">
                        <strong class="text-brand-900">Kunci laba sebelum berangkat</strong>. Margin Guard otomatis mendeteksi biaya operasional dan memperingatkan jika margin di bawah 10%.
                    </p>
                    <div class="pt-2 border-t border-brand-200/70 text-[11px] text-brand-800 font-semibold flex items-center gap-1.5">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600"></i>
                        <span>Proteksi laba kotor 100% terkunci di muka</span>
                    </div>
                </div>
            </div>

            <!-- Problem 2: Beban Capex GPS -->
            <div class="reveal p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl transition duration-300 flex flex-col justify-between space-y-6 group shadow-sm" style="--reveal-delay:100ms">
                <!-- Top Section with flex-1 for strict baseline alignment -->
                <div class="flex flex-col justify-between flex-1 space-y-4">
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center font-bold border border-slate-200 shadow-sm">
                                <i data-lucide="banknote" class="w-6 h-6 text-brand-600"></i>
                            </div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-700 bg-slate-100 px-2.5 py-1 rounded border border-slate-200">
                                BEBAN CAPEX TINGGI
                            </span>
                        </div>

                        <div class="mt-4">
                            <div class="text-xs font-mono font-bold uppercase text-brand-600 tracking-wider">Tantangan #2</div>
                            <h3 class="text-lg sm:text-xl font-bold text-slate-900 mt-1">Biaya Hardware GPS Membengkak</h3>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mt-2 sm:min-h-[72px]">
                                <strong class="text-slate-900">Beli alat GPS Rp 2–3 Juta/unit</strong> menguras kas operasional, ditambah risiko alat dirusak atau sengaja dicabut sopir.
                            </p>
                        </div>
                    </div>

                    <!-- Pinned Impact Stat Box -->
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-xs flex items-center justify-between">
                        <div class="flex items-center gap-1.5 text-slate-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                            <span class="font-medium text-slate-500">Estimasi Beban Capex:</span>
                        </div>
                        <span class="font-bold font-mono text-slate-900 bg-white px-2.5 py-1 rounded border border-slate-200">
                            Rp 22.500.000 / 15 truk
                        </span>
                    </div>
                </div>

                <!-- Solution Box -->
                <div class="p-4 rounded-xl bg-brand-50/60 border border-brand-200/90 space-y-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5 text-xs font-bold text-brand-700">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-600"></i>
                            <span>Solusi TrackFleet:</span>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-brand-700 bg-brand-100 px-2 py-0.5 rounded border border-brand-200">
                            ZERO HARDWARE
                        </span>
                    </div>
                    <p class="text-xs text-slate-700 leading-relaxed">
                        <strong class="text-brand-900">Nol modal perangkat</strong>. Cukup buka tautan web di HP sopir: akurat, tanpa biaya montir, dan anti-cabut di jalan.
                    </p>
                    <div class="pt-2 border-t border-brand-200/70 text-[11px] text-brand-800 font-semibold flex items-center gap-1.5">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600"></i>
                        <span>Nol rupiah modal beli perangkat keras GPS</span>
                    </div>
                </div>
            </div>

            <!-- Problem 3: Surat Jalan Hilang & Kas Molor -->
            <div class="reveal p-6 sm:p-7 rounded-2xl bg-white border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl transition duration-300 flex flex-col justify-between space-y-6 group shadow-sm" style="--reveal-delay:200ms">
                <!-- Top Section with flex-1 for strict baseline alignment -->
                <div class="flex flex-col justify-between flex-1 space-y-4">
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center font-bold border border-slate-200 shadow-sm">
                                <i data-lucide="clock" class="w-6 h-6 text-brand-600"></i>
                            </div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-700 bg-slate-100 px-2.5 py-1 rounded border border-slate-200">
                                KAS MACET 14 HARI
                            </span>
                        </div>

                        <div class="mt-4">
                            <div class="text-xs font-mono font-bold uppercase text-brand-600 tracking-wider">Tantangan #3</div>
                            <h3 class="text-lg sm:text-xl font-bold text-slate-900 mt-1">Surat Jalan Hilang &amp; Tagihan Molor</h3>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mt-2 sm:min-h-[72px]">
                                <strong class="text-slate-900">Surat jalan fisik rentan hilang</strong> atau baru kembali berminggu-minggu. Penagihan tertunda, arus kas macet.
                            </p>
                        </div>
                    </div>

                    <!-- Pinned Impact Stat Box -->
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-xs flex items-center justify-between">
                        <div class="flex items-center gap-1.5 text-slate-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                            <span class="font-medium text-slate-500">Estimasi Kas Tertahan:</span>
                        </div>
                        <span class="font-bold font-mono text-slate-900 bg-white px-2.5 py-1 rounded border border-slate-200">
                            10–14 Hari / invoice
                        </span>
                    </div>
                </div>

                <!-- Solution Box -->
                <div class="p-4 rounded-xl bg-brand-50/60 border border-brand-200/90 space-y-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5 text-xs font-bold text-brand-700">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-600"></i>
                            <span>Solusi TrackFleet:</span>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-brand-700 bg-brand-100 px-2 py-0.5 rounded border border-brand-200">
                            E-POD DIGITAL
                        </span>
                    </div>
                    <p class="text-xs text-slate-700 leading-relaxed">
                        <strong class="text-brand-900">E-POD &amp; Tanda tangan instan</strong>. Foto kargo dan tanda tangan penerima tercatat detik itu juga. Faktur langsung siap ditagihkan.
                    </p>
                    <div class="pt-2 border-t border-brand-200/70 text-[11px] text-brand-800 font-semibold flex items-center gap-1.5">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600"></i>
                        <span>Sah UU ITE No. 1/2024 &amp; invoice cair hari itu</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>


<!-- ==========================================
     INTERACTIVE ROI & FLEET SAVINGS CALCULATOR
     Enterprise Light Dashboard Architecture
     ========================================== -->
<section class="py-20 bg-slate-50 relative overflow-hidden">
    <div class="w-full px-4 sm:px-6 md:px-10 lg:px-12 xl:px-16 2xl:px-20">
        
        <div class="text-center max-w-3xl mx-auto mb-14 reveal">
            <span class="text-xs font-bold tracking-wider uppercase text-brand-600 bg-brand-50 px-3.5 py-1 rounded-full border border-brand-200">
                Simulasi Nilai Bisnis Nyata
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-4 tracking-tight">
                Berapa Potensi Margin yang Bisa Anda Selamatkan?
            </h2>
            <p class="text-slate-600 mt-3 text-sm sm:text-base leading-relaxed">
                Pilih skala armada aktif yang Anda operasikan dan pantau simulasi efisiensi modal, penghematan waktu admin, serta proteksi margin bulanan secara transparan.
            </p>
        </div>

        <!-- Enterprise Fleet Simulator Dashboard Card -->
        <div class="reveal-scale bg-white rounded-3xl border border-slate-200/90 shadow-lg p-6 sm:p-10 space-y-8">
            
            <!-- Control Bar: Fleet Scale Segmented Tabs -->
            <div class="space-y-3">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between text-xs gap-2">
                    <span class="font-bold text-slate-900 uppercase tracking-wider font-mono">Pilih Jumlah Armada Aktif:</span>
                    <span class="text-slate-500 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-brand-600"></span>
                        <span>Kalkulasi Otomatis Berbasis Data Rata-Rata Transporter Indonesia</span>
                    </span>
                </div>
                
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-2.5 sm:gap-3">
                    <button type="button" onclick="setFleetSize(5)" id="btn-fleet-5" class="fleet-btn px-4 py-3 rounded-xl font-bold text-xs sm:text-sm border border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50 transition text-center">
                        <div class="text-sm sm:text-base font-extrabold">5 Truk</div>
                        <div class="text-[10px] font-normal text-slate-500 mt-0.5">Mikro Armada</div>
                    </button>
                    <button type="button" onclick="setFleetSize(15)" id="btn-fleet-15" class="fleet-btn px-4 py-3 rounded-xl font-bold text-xs sm:text-sm border-2 border-brand-600 bg-brand-600 text-white shadow-md shadow-brand-500/20 transition text-center">
                        <div class="text-sm sm:text-base font-extrabold">15 Truk</div>
                        <div class="text-[10px] font-normal text-brand-100 mt-0.5">Transporter Menengah</div>
                    </button>
                    <button type="button" onclick="setFleetSize(30)" id="btn-fleet-30" class="fleet-btn px-4 py-3 rounded-xl font-bold text-xs sm:text-sm border border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50 transition text-center">
                        <div class="text-sm sm:text-base font-extrabold">30 Truk</div>
                        <div class="text-[10px] font-normal text-slate-500 mt-0.5">Armada Berkembang</div>
                    </button>
                    <button type="button" onclick="setFleetSize(60)" id="btn-fleet-60" class="fleet-btn px-4 py-3 rounded-xl font-bold text-xs sm:text-sm border border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50 transition text-center">
                        <div class="text-sm sm:text-base font-extrabold">60 Truk</div>
                        <div class="text-[10px] font-normal text-slate-500 mt-0.5">Transporter Regional</div>
                    </button>
                    <button type="button" onclick="setFleetSize(100)" id="btn-fleet-100" class="fleet-btn px-4 py-3 rounded-xl font-bold text-xs sm:text-sm border border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50 transition text-center col-span-2 sm:col-span-1">
                        <div class="text-sm sm:text-base font-extrabold">100+ Truk</div>
                        <div class="text-[10px] font-normal text-slate-500 mt-0.5">Enterprise Korporat</div>
                    </button>
                </div>
            </div>

            <!-- Top Zone: Hero Financial Impact Banner -->
            <div class="p-6 sm:p-8 rounded-2xl bg-brand-50/60 border border-brand-200/90 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-brand-700 bg-brand-100 px-2.5 py-1 rounded border border-brand-200">
                            ESTIMASI DAMPAK FINANSIAL
                        </span>
                        <span class="text-xs text-slate-500 hidden sm:inline">• Tanpa biaya tersembunyi</span>
                    </div>
                    <div class="flex items-baseline gap-2 flex-wrap">
                        <span class="text-xs sm:text-sm font-semibold text-slate-600">Total Potensi Nilai Terproteksi:</span>
                        <div id="calc-annual-saved" class="text-3xl sm:text-4xl lg:text-5xl font-black font-mono text-slate-900 tracking-tight">
                            Rp 270.000.000
                        </div>
                        <span class="text-xs sm:text-sm font-bold text-brand-700">/ tahun</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed max-w-2xl">
                        Akumulasi dari eliminasi modal pengadaan alat GPS, pencegahan order boncos via Margin Guard, serta percepatan pencairan kas penagihan.
                    </p>
                </div>

                <div class="shrink-0 flex flex-col sm:flex-row lg:flex-col gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-3.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs sm:text-sm shadow-md transition flex items-center justify-center gap-2">
                        <span>Buka Dashboard &amp; Buktikan Gratis</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                    <div class="text-[11px] text-center text-slate-500 flex items-center justify-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600"></i>
                        <span>14 Hari Uji Coba Tanpa Syarat</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Zone: 4 Key Efficiency Pillars Breakdown -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                
                <!-- Card 1: Kebocoran Dicegah -->
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-brand-300 transition space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100">
                            <i data-lucide="shield-check" class="w-5 h-5"></i>
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase text-brand-700 bg-brand-100 px-2 py-0.5 rounded border border-brand-200">
                            PROTEKSI LABA
                        </span>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-slate-500 uppercase tracking-wider">Kebocoran Dicegah</div>
                        <div id="calc-margin-saved" class="text-2xl font-black font-mono text-slate-900 mt-1">Rp 22.500.000</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">/ bulan dari pesanan boncos</div>
                    </div>
                    <p class="text-xs text-slate-600 pt-2 border-t border-slate-200/70 leading-relaxed">
                        Margin Guard otomatis mendeteksi rute dan tarif di bawah ambang batas minimal 10% sebelum truk jalan.
                    </p>
                </div>

                <!-- Card 2: Hemat Hardware GPS -->
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-brand-300 transition space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100">
                            <i data-lucide="smartphone" class="w-5 h-5"></i>
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase text-brand-700 bg-brand-100 px-2 py-0.5 rounded border border-brand-200">
                            ZERO CAPEX
                        </span>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-slate-500 uppercase tracking-wider">Hemat Hardware GPS</div>
                        <div id="calc-gps-saved" class="text-2xl font-black font-mono text-slate-900 mt-1">Rp 22.500.000</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">modal alat &amp; montir bengkel</div>
                    </div>
                    <p class="text-xs text-slate-600 pt-2 border-t border-slate-200/70 leading-relaxed">
                        Nol rupiah beli alat fisik blackbox GPS. Cukup browser smartphone yang sudah dibawa tiap pengemudi.
                    </p>
                </div>

                <!-- Card 3: Percepatan Tagihan Kas -->
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-brand-300 transition space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100">
                            <i data-lucide="receipt" class="w-5 h-5"></i>
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase text-brand-700 bg-brand-100 px-2 py-0.5 rounded border border-brand-200">
                            CASH FLOW
                        </span>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-slate-500 uppercase tracking-wider">Percepatan Tagihan</div>
                        <div id="calc-billing-speed" class="text-2xl font-black font-mono text-slate-900 mt-1">14 Hari → 1 Hari</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">siklus invoice ke shipper</div>
                    </div>
                    <p class="text-xs text-slate-600 pt-2 border-t border-slate-200/70 leading-relaxed">
                        Tanda tangan digital E-POD sah hukum seketika di lokasi bongkar, tagihan invoice langsung terbit hari itu.
                    </p>
                </div>

                <!-- Card 4: Efisiensi Kerja Tim -->
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-brand-300 transition space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100">
                            <i data-lucide="clock" class="w-5 h-5"></i>
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase text-brand-700 bg-brand-100 px-2 py-0.5 rounded border border-brand-200">
                            PRODUKTIVITAS
                        </span>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-slate-500 uppercase tracking-wider">Efisiensi Kerja Tim</div>
                        <div id="calc-hours-saved" class="text-2xl font-black font-mono text-slate-900 mt-1">~60 Jam / bln</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">waktu staf dispatcher hemat</div>
                    </div>
                    <p class="text-xs text-slate-600 pt-2 border-t border-slate-200/70 leading-relaxed">
                        Tidak perlu lagi menelpon sopir satu per satu di jalan. Lokasi dan rute terpantau otomatis di peta live.
                    </p>
                </div>

            </div>

        </div>

    </div>
</section>


<!-- ==========================================
     BENTO GRID (6 Core Capabilities)
     Asymmetric Enterprise Bento Architecture
     ========================================== -->
<section class="py-20 bg-white">
    <div class="w-full px-4 sm:px-6 md:px-10 lg:px-12 xl:px-16 2xl:px-20">
        
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <span class="text-xs font-bold tracking-wider uppercase text-brand-600 bg-brand-50 px-3.5 py-1 rounded-full border border-brand-200">
                Fitur Unggulan B2B
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-4 tracking-tight">
                Arsitektur Modul Komprehensif untuk Transporter Modern
            </h2>
            <p class="text-slate-600 mt-3 text-sm sm:text-base leading-relaxed">
                Didesain khusus mengatasi kompleksitas jalanan logistik Indonesia: dari pencegahan pesanan boncos, pelacakan rute tol Trans-Jawa, hingga invoice pajak instan.
            </p>
        </div>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
            
            <!-- Bento 1: Margin Guard Engine (Wide Flagship Card - Col 7) -->
            <div class="reveal lg:col-span-7 p-6 sm:p-8 rounded-2xl bg-slate-50 border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl transition duration-300 flex flex-col justify-between space-y-6 group">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold border border-brand-100 shadow-sm">
                            <i data-lucide="shield-alert" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-brand-700 bg-brand-100/60 px-2.5 py-1 rounded border border-brand-200">
                            ENGINE PROFIT PROTEKSI
                        </span>
                    </div>

                    <div>
                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900">Margin Guard &lt;10%: Proteksi Laba Otomatis</h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mt-2">
                            <strong class="text-slate-900">Hitung laba sebelum jalan</strong>. Otomatis bandingkan tarif muatan dengan solar, tol Trans-Jawa, dan uang jalan sopir. Peringatan tegas jika margin di bawah 10%.
                        </p>
                    </div>

                    <!-- Micro-Interface: Live Margin Calculation Preview -->
                    <div class="p-4 rounded-xl bg-white border border-slate-200 shadow-sm space-y-3">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between text-xs gap-1">
                            <span class="font-bold text-slate-800">Simulasi Order: Jakarta → Surabaya (CDD Box)</span>
                            <span class="font-mono font-bold text-brand-700 bg-brand-50 px-2 py-0.5 rounded border border-brand-200 shrink-0">TARIF: Rp 6.800.000</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2 text-center text-xs">
                            <div class="p-2 rounded-lg bg-slate-50 border border-slate-200/80">
                                <div class="text-[10px] text-slate-500">BBM Solar</div>
                                <div class="font-bold text-slate-800 mt-0.5">Rp 2.100.000</div>
                            </div>
                            <div class="p-2 rounded-lg bg-slate-50 border border-slate-200/80">
                                <div class="text-[10px] text-slate-500">Tol Trans-Jawa</div>
                                <div class="font-bold text-slate-800 mt-0.5">Rp 1.450.000</div>
                            </div>
                            <div class="p-2 rounded-lg bg-slate-50 border border-slate-200/80">
                                <div class="text-[10px] text-slate-500">Uang Jalan Sopir</div>
                                <div class="font-bold text-slate-800 mt-0.5">Rp 1.800.000</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-slate-100 text-xs">
                            <div class="flex items-center gap-1.5 text-slate-700">
                                <i data-lucide="shield-check" class="w-4 h-4 text-brand-600"></i>
                                <span>Estimasi Margin Bersih: <strong class="text-slate-900">Rp 1.450.000 (21.3%)</strong></span>
                            </div>
                            <span class="font-bold text-[10px] uppercase font-mono text-brand-700 bg-brand-100 px-2.5 py-0.5 rounded">STATUS: AMAN</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs text-slate-600">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Peringatan dini order rugi sebelum armada jalan</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Rekomendasi penyesuaian tarif muatan</span>
                    </div>
                </div>
            </div>

            <!-- Bento 2: Zero Hardware GPS Telemetry (Col 5) -->
            <div class="reveal lg:col-span-5 p-6 sm:p-8 rounded-2xl bg-slate-50 border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl transition duration-300 flex flex-col justify-between space-y-6 group" style="--reveal-delay:80ms">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold border border-brand-100 shadow-sm">
                            <i data-lucide="navigation" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-brand-700 bg-brand-100/60 px-2.5 py-1 rounded border border-brand-200">
                            TELEMETRI REAL-TIME
                        </span>
                    </div>

                    <div>
                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900">GPS Ponsel Sopir (Zero Hardware)</h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mt-2">
                            <strong class="text-slate-900">Lacak rute via ponsel sopir</strong>. Cukup buka tautan tugas di browser: koordinat GPS, kecepatan, dan estimasi waktu tiba (ETA) terpantau akurat tanpa beli alat GPS fisik.
                        </p>
                    </div>

                    <!-- Micro-Interface: Live Phone GPS Preview -->
                    <div class="p-4 rounded-xl bg-white border border-slate-200 shadow-sm space-y-3">
                        <div class="flex items-center justify-between text-xs">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-brand-600 animate-pulse"></span>
                                <span class="font-bold text-slate-800 font-mono">B 9841 UXT • Tol Cipali KM 164</span>
                            </div>
                            <span class="text-[10px] font-mono text-brand-700 bg-brand-50 px-2 py-0.5 rounded border border-brand-200 font-bold">68 KM/JAM</span>
                        </div>
                        <div class="text-[11px] text-slate-600 font-mono bg-slate-50 p-2.5 rounded-lg border border-slate-200/80 flex items-center justify-between">
                            <span>LAT: -6.7192, LNG: 108.2104</span>
                            <span class="font-bold text-slate-800">ETA: 14:15 WIB</span>
                        </div>
                        <div class="text-[11px] text-slate-500 flex items-center justify-between">
                            <span>Baterai HP sopir hemat daya</span>
                            <span class="text-brand-700 font-bold">Akurat &amp; Aman</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-200/80 space-y-1.5 text-xs text-slate-600">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Hemat biaya modal hardware GPS Rp 2–3 Juta / unit</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Privasi terjaga: hanya melacak saat bertugas aktif</span>
                    </div>
                </div>
            </div>

            <!-- Bento 3: E-POD & Digital Signature (Col 4) -->
            <div class="reveal lg:col-span-4 p-6 sm:p-7 rounded-2xl bg-slate-50 border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl transition duration-300 flex flex-col justify-between space-y-5 group">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold border border-brand-100 shadow-sm">
                            <i data-lucide="file-check-2" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-brand-700 bg-brand-100/60 px-2.5 py-1 rounded border border-brand-200">
                            LEGALITAS RESMI
                        </span>
                    </div>

                    <div>
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900">E-POD &amp; Tanda Tangan Digital</h3>
                        <p class="text-xs text-slate-600 leading-relaxed mt-2">
                            <strong class="text-slate-900">Bukti serah terima sah instan</strong>. Tanda tangan digital di layar HP, foto muatan di gudang penerima, dan timestamp GPS aman anti-sengketa.
                        </p>
                    </div>

                    <!-- Micro-Interface: Touch Signature Preview -->
                    <div class="p-3.5 rounded-xl bg-white border border-slate-200 shadow-sm space-y-2">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-bold text-slate-800">Tanda Tangan Penerima</span>
                            <span class="text-[10px] font-mono text-brand-700 bg-brand-50 px-1.5 py-0.5 rounded font-bold">TERVALIDASI</span>
                        </div>
                        <div class="h-10 rounded-lg bg-slate-50 border border-dashed border-slate-300 flex items-center justify-center text-xs text-slate-500 italic font-serif">
                            Bambang Santoso (Gudang Cikarang)
                        </div>
                        <div class="text-[10px] text-slate-500 flex items-center justify-between">
                            <span>Foto Kargo: 18 Pallet Segel</span>
                            <span class="font-mono text-slate-600">11:42 WIB</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-200/80 space-y-1.5 text-xs text-slate-600">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Menghilangkan risiko surat jalan basah / hilang</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Kekuatan hukum sah amanat UU ITE No. 1/2024</span>
                    </div>
                </div>
            </div>

            <!-- Bento 4: Automated Invoicing (Col 4) -->
            <div class="reveal lg:col-span-4 p-6 sm:p-7 rounded-2xl bg-slate-50 border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl transition duration-300 flex flex-col justify-between space-y-5 group" style="--reveal-delay:80ms">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold border border-brand-100 shadow-sm">
                            <i data-lucide="receipt" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-brand-700 bg-brand-100/60 px-2.5 py-1 rounded border border-brand-200">
                            PERCEPATAN KAS
                        </span>
                    </div>

                    <div>
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900">Faktur Tagihan Otomatis</h3>
                        <p class="text-xs text-slate-600 leading-relaxed mt-2">
                            <strong class="text-slate-900">Penagihan 1 hari cair</strong>. Begitu E-POD ditandatangani, draf invoice resmi otomatis tersusun lengkap dengan ongkir &amp; PPN siap kirim.
                        </p>
                    </div>

                    <!-- Micro-Interface: Invoice Draft Preview -->
                    <div class="p-3.5 rounded-xl bg-white border border-slate-200 shadow-sm space-y-2">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-bold text-slate-800 font-mono">Invoice INV/2026/089</span>
                            <span class="text-[10px] font-mono text-brand-700 bg-brand-50 px-1.5 py-0.5 rounded font-bold">SIAP CETAK</span>
                        </div>
                        <div class="p-2 rounded-lg bg-slate-50 border border-slate-200/80 space-y-1 text-xs">
                            <div class="flex justify-between text-slate-600"><span>Ongkir Muatan:</span><span class="font-bold text-slate-800">Rp 5.500.000</span></div>
                            <div class="flex justify-between text-slate-600"><span>PPN 1.1%:</span><span class="font-bold text-slate-800">Rp 60.500</span></div>
                        </div>
                        <div class="text-[10px] text-slate-500 flex items-center justify-between">
                            <span>Status: Siap Ditagihkan</span>
                            <span class="text-brand-700 font-bold">Format A4 / PDF</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-200/80 space-y-1.5 text-xs text-slate-600">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Siklus penagihan terpotong dari 14 hari jadi 1 hari</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Rekonsiliasi ongkir transparan dan bebas sengketa</span>
                    </div>
                </div>
            </div>

            <!-- Bento 5: Public Shipper Portal (Col 4) -->
            <div class="reveal lg:col-span-4 p-6 sm:p-7 rounded-2xl bg-slate-50 border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl transition duration-300 flex flex-col justify-between space-y-5 group" style="--reveal-delay:160ms">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold border border-brand-100 shadow-sm">
                            <i data-lucide="search" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-brand-700 bg-brand-100/60 px-2.5 py-1 rounded border border-brand-200">
                            MANDIRI &amp; TRANSPARAN
                        </span>
                    </div>

                    <div>
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900">Portal Lacak Mandiri (Shipper)</h3>
                        <p class="text-xs text-slate-600 leading-relaxed mt-2">
                            <strong class="text-slate-900">Pangkas 80% telepon klien</strong>. Bagikan link resi unik agar pemilik kargo bisa lacak posisi mandiri tanpa login dan tanpa melihat margin rahasia Anda.
                        </p>
                    </div>

                    <!-- Micro-Interface: Tracking Link Preview -->
                    <div class="p-3.5 rounded-xl bg-white border border-slate-200 shadow-sm space-y-2">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-bold text-slate-800 font-mono">Kode Resi: TRK-JKT-SBY-491</span>
                            <span class="text-[10px] font-mono text-brand-700 bg-brand-50 px-1.5 py-0.5 rounded font-bold">AKSES PUBLIK</span>
                        </div>
                        <div class="p-2 rounded-lg bg-slate-50 border border-slate-200/80 text-xs text-slate-700 flex items-center gap-2">
                            <i data-lucide="link" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                            <span class="truncate text-[11px] font-mono text-slate-600">trackfleet.id/tracking?code=TRK...</span>
                        </div>
                        <div class="text-[10px] text-slate-500 flex items-center justify-between">
                            <span>Peta live tanpa login</span>
                            <span class="text-brand-700 font-bold">Margin Dirahasiakan</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-200/80 space-y-1.5 text-xs text-slate-600">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Tampilan peta interaktif yang ramah pengguna</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Meningkatkan citra profesionalisme transporter</span>
                    </div>
                </div>
            </div>

            <!-- Bento 6: Fleet & Driver Master Command Center (Wide Command Card - Col 12) -->
            <div class="reveal lg:col-span-12 p-6 sm:p-8 rounded-2xl bg-slate-50 border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl transition duration-300 group">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-center">
                    
                    <div class="lg:col-span-5 space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold border border-brand-100 shadow-sm">
                                <i data-lucide="truck" class="w-6 h-6"></i>
                            </div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-brand-700 bg-brand-100/60 px-2.5 py-1 rounded border border-brand-200">
                                MANAJEMEN ASET &amp; KEPATUHAN
                            </span>
                        </div>

                        <div>
                            <h3 class="text-xl sm:text-2xl font-bold text-slate-900">Database Terpusat Truk, Uji KIR, STNK &amp; Sopir</h3>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mt-2">
                                <strong class="text-slate-900">Radar dokumen armada &amp; pengemudi</strong>. Kelola truk internal &amp; mitra (CDD, Fuso, Tronton). Dapatkan peringatan otomatis sebelum uji KIR, STNK, dan SIM kedaluwarsa.
                            </p>
                        </div>

                        <div class="space-y-2 text-xs text-slate-600 pt-2 border-t border-slate-200">
                            <div class="flex items-center gap-2">
                                <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                                <span>Radar peringatan masa kedaluwarsa dokumen kendaraan H-30 hari</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                                <span>Mencegah penugasan sopir tanpa dokumen SIM/KIR yang sah</span>
                            </div>
                        </div>
                    </div>

                    <!-- Fleet Live Radar Table Preview -->
                    <div class="lg:col-span-7 bg-white p-4 sm:p-5 rounded-xl border border-slate-200 shadow-sm space-y-3">
                        <div class="flex items-center justify-between text-xs pb-2 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <i data-lucide="gauge" class="w-4 h-4 text-brand-600"></i>
                                <span class="font-bold text-slate-900">Radar Kesiapan Armada &amp; Uji KIR</span>
                            </div>
                            <span class="text-[10px] font-mono text-brand-700 bg-brand-50 px-2 py-0.5 rounded font-bold border border-brand-200">KONTROL DISPATCH</span>
                        </div>

                        <div class="space-y-2 text-xs">
                            <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div class="flex items-center gap-3">
                                    <span class="w-2 h-2 rounded-full bg-brand-600"></span>
                                    <div>
                                        <div class="font-bold text-slate-900 font-mono">B 9421 UXT • Tronton Wingbox</div>
                                        <div class="text-[11px] text-slate-500">Sopir: Supriyadi (SIM B2 Umum)</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 sm:text-right">
                                    <span class="text-[10px] font-mono font-bold text-slate-700 bg-white border border-slate-200 px-2 py-0.5 rounded">Uji KIR: Aktif 180 Hari</span>
                                    <span class="text-[10px] font-bold text-brand-700 bg-brand-50 px-2 py-0.5 rounded border border-brand-200">DITUGASKAN</span>
                                </div>
                            </div>

                            <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div class="flex items-center gap-3">
                                    <span class="w-2 h-2 rounded-full bg-brand-600"></span>
                                    <div>
                                        <div class="font-bold text-slate-900 font-mono">D 8102 AC • CDD Long Box</div>
                                        <div class="text-[11px] text-slate-500">Sopir: Heri Prabowo (SIM B1)</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 sm:text-right">
                                    <span class="text-[10px] font-mono font-bold text-slate-700 bg-white border border-slate-200 px-2 py-0.5 rounded">Uji KIR: Aktif 94 Hari</span>
                                    <span class="text-[10px] font-bold text-slate-600 bg-white px-2 py-0.5 rounded border border-slate-200">STANDBY POOL</span>
                                </div>
                            </div>

                            <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div class="flex items-center gap-3">
                                    <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                    <div>
                                        <div class="font-bold text-slate-900 font-mono">L 9022 UV • Fuso Heavy Duty</div>
                                        <div class="text-[11px] text-slate-500">Sopir: Hendra Kurniawan</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 sm:text-right">
                                    <span class="text-[10px] font-mono font-bold text-slate-600 bg-white border border-slate-200 px-2 py-0.5 rounded">Uji KIR: H-14 Hari</span>
                                    <span class="text-[10px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded border border-slate-200">PERINGATAN UJI</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>


<!-- ==========================================
     SOP ALUR KERJA 4 LANGKAH
     Connected Pipeline & Single Brand Accent
     ========================================== -->
<section class="py-20 bg-slate-50 relative overflow-hidden">
    <div class="w-full px-4 sm:px-6 md:px-10 lg:px-12 xl:px-16 2xl:px-20">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6 reveal">
            <div>
                <span class="text-xs font-bold tracking-wider uppercase text-brand-600 bg-brand-50 px-3.5 py-1 rounded-full border border-brand-200">
                    Standard Operating Procedure
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-4 tracking-tight">
                    Alur Kerja Operasional 4 Langkah Tanpa Celah
                </h2>
                <p class="text-slate-600 mt-3 text-sm sm:text-base max-w-3xl leading-relaxed">
                    Dari pesanan masuk hingga pencairan tagihan, seluruh alur kerja logistik terkendali otomatis tanpa tumpukan kertas manual atau risiko salah komunikasi.
                </p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-brand-600 hover:text-brand-700 bg-white border border-slate-200 hover:border-brand-300 px-4 py-2.5 rounded-xl shadow-sm transition shrink-0">
                <span>Lihat Dashboard Operasional</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <!-- 4 Connected Pipeline Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 relative">
            
            <!-- Step 1 -->
            <div class="bg-white rounded-2xl border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl hover:-translate-y-1 transition duration-300 p-6 flex flex-col justify-between space-y-6 relative group shadow-sm reveal">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-brand-600 text-white font-mono font-bold flex items-center justify-center text-sm shadow-md shadow-brand-500/20 ring-4 ring-slate-50 group-hover:scale-105 transition">
                            01
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2.5 py-1 rounded border border-slate-200">
                            PRA-PERJALANAN
                        </span>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100">
                        <i data-lucide="clipboard-check" class="w-6 h-6"></i>
                    </div>

                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-slate-900">Catat Pesanan &amp; Validasi Margin</h3>
                        <p class="text-xs text-slate-600 leading-relaxed mt-2">
                            Input rute asal-tujuan, jenis muatan, tarif tagihan shipper, serta estimasi solar &amp; tol. Sistem seketika mengunci margin laba.
                        </p>
                    </div>

                    <ul class="pt-3 border-t border-slate-100 space-y-1.5 text-xs text-slate-600">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                            <span>Simulasi biaya tol &amp; solar otomatis</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                            <span>Margin Guard &lt;10% cegah order rugi</span>
                        </li>
                    </ul>
                </div>

                <div class="p-3 rounded-xl bg-brand-50/60 border border-brand-200/80 flex items-center justify-between text-xs">
                    <div>
                        <div class="text-[10px] font-mono font-bold uppercase text-brand-700 tracking-wider">Hasil Terverifikasi</div>
                        <div class="font-bold text-slate-900 mt-0.5">Surat Perintah &amp; Margin Valid</div>
                    </div>
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-600 shrink-0"></i>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="bg-white rounded-2xl border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl hover:-translate-y-1 transition duration-300 p-6 flex flex-col justify-between space-y-6 relative group shadow-sm reveal" style="--reveal-delay: 80ms;">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-brand-600 text-white font-mono font-bold flex items-center justify-center text-sm shadow-md shadow-brand-500/20 ring-4 ring-slate-50 group-hover:scale-105 transition">
                            02
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2.5 py-1 rounded border border-slate-200">
                            DISPATCH ARMADA
                        </span>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100">
                        <i data-lucide="truck" class="w-6 h-6"></i>
                    </div>

                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-slate-900">Penugasan Sopir &amp; Surat Jalan</h3>
                        <p class="text-xs text-slate-600 leading-relaxed mt-2">
                            Tentukan kendaraan dan sopir yang bertugas. Sistem otomatis menghasilkan Surat Jalan resmi dan tautan web tugas ke ponsel sopir tanpa install APK.
                        </p>
                    </div>

                    <ul class="pt-3 border-t border-slate-100 space-y-1.5 text-xs text-slate-600">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                            <span>Surat jalan digital siap cetak / PDF resmi</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                            <span>Tautan tugas web langsung via WhatsApp</span>
                        </li>
                    </ul>
                </div>

                <div class="p-3 rounded-xl bg-brand-50/60 border border-brand-200/80 flex items-center justify-between text-xs">
                    <div>
                        <div class="text-[10px] font-mono font-bold uppercase text-brand-700 tracking-wider">Hasil Terverifikasi</div>
                        <div class="font-bold text-slate-900 mt-0.5">Surat Jalan &amp; Akses Sopir Aktif</div>
                    </div>
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-600 shrink-0"></i>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="bg-white rounded-2xl border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl hover:-translate-y-1 transition duration-300 p-6 flex flex-col justify-between space-y-6 relative group shadow-sm reveal" style="--reveal-delay: 160ms;">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-brand-600 text-white font-mono font-bold flex items-center justify-center text-sm shadow-md shadow-brand-500/20 ring-4 ring-slate-50 group-hover:scale-105 transition">
                            03
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2.5 py-1 rounded border border-slate-200">
                            MONITORING TRANSIT
                        </span>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100">
                        <i data-lucide="navigation" class="w-6 h-6"></i>
                    </div>

                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-slate-900">Perjalanan &amp; Live Telemetri GPS</h3>
                        <p class="text-xs text-slate-600 leading-relaxed mt-2">
                            Sopir memulai tugas lewat browser ponsel. Dispatcher dan shipper memantau pergerakan truk secara live di rute Trans-Jawa dengan ETA otomatis.
                        </p>
                    </div>

                    <ul class="pt-3 border-t border-slate-100 space-y-1.5 text-xs text-slate-600">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                            <span>Pelacakan koordinat GPS tanpa alat fisik</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                            <span>Link pelacakan mandiri untuk shipper</span>
                        </li>
                    </ul>
                </div>

                <div class="p-3 rounded-xl bg-brand-50/60 border border-brand-200/80 flex items-center justify-between text-xs">
                    <div>
                        <div class="text-[10px] font-mono font-bold uppercase text-brand-700 tracking-wider">Hasil Terverifikasi</div>
                        <div class="font-bold text-slate-900 mt-0.5">Live Telemetry &amp; ETA Rute Sinkron</div>
                    </div>
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-600 shrink-0"></i>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="bg-white rounded-2xl border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl hover:-translate-y-1 transition duration-300 p-6 flex flex-col justify-between space-y-6 relative group shadow-sm reveal" style="--reveal-delay: 240ms;">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-brand-600 text-white font-mono font-bold flex items-center justify-center text-sm shadow-md shadow-brand-500/20 ring-4 ring-slate-50 group-hover:scale-105 transition">
                            04
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2.5 py-1 rounded border border-slate-200">
                            PENYELESAIAN &amp; BILLING
                        </span>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100">
                        <i data-lucide="file-check" class="w-6 h-6"></i>
                    </div>

                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-slate-900">E-POD Digital &amp; Auto-Invoice</h3>
                        <p class="text-xs text-slate-600 leading-relaxed mt-2">
                            Penerima kargo menandatangani E-POD di layar smartphone sopir. Dalam hitungan detik status pesanan Selesai dan tagihan faktur invoice resmi siap dikirim.
                        </p>
                    </div>

                    <ul class="pt-3 border-t border-slate-100 space-y-1.5 text-xs text-slate-600">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                            <span>Tanda tangan digital sah UU ITE No. 1/2024</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                            <span>Faktur invoice siap kirim detik itu juga</span>
                        </li>
                    </ul>
                </div>

                <div class="p-3 rounded-xl bg-brand-50/60 border border-brand-200/80 flex items-center justify-between text-xs">
                    <div>
                        <div class="text-[10px] font-mono font-bold uppercase text-brand-700 tracking-wider">Hasil Terverifikasi</div>
                        <div class="font-bold text-slate-900 mt-0.5">Invoice Terbit &amp; Klaim Sah Hukum</div>
                    </div>
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-600 shrink-0"></i>
                </div>
            </div>

        </div>

        <!-- Bottom SOP Assurance Strip -->
        <div class="mt-12 p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/90 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-600 shadow-sm reveal">
            <div class="flex items-center gap-3">
                <span class="w-2.5 h-2.5 rounded-full bg-brand-600 animate-pulse"></span>
                <span class="font-semibold text-slate-900">Efisiensi Operasional Terstandarisasi</span>
                <span class="text-slate-300 hidden sm:inline">•</span>
                <span class="text-slate-500">Menghilangkan 90% waktu konfirmasi telepon manual &amp; mempercepat siklus penagihan kas</span>
            </div>
            <a href="{{ route('driver.index') }}" class="font-bold text-brand-600 hover:text-brand-700 transition flex items-center gap-1.5 shrink-0">
                <span>Uji Coba Tampilan Aplikasi Sopir</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

    </div>
</section>


<!-- ==========================================
     COMPARISON MATRIX (Cara Lama vs TrackFleet)
     Sleek Row Cards & Single Brand Highlight
     ========================================== -->
<section class="py-20 bg-white">
    <div class="w-full px-4 sm:px-6 md:px-10 lg:px-12 xl:px-16 2xl:px-20">
        
        <div class="text-center max-w-3xl mx-auto mb-14 reveal">
            <span class="text-xs font-bold tracking-wider uppercase text-brand-600 bg-brand-50 px-3.5 py-1 rounded-full border border-brand-200">
                Analisis Komparasi Efisiensi
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-4 tracking-tight">
                Mengapa Beralih dari Cara Manual ke TrackFleet OS?
            </h2>
            <p class="text-slate-600 mt-3 text-sm sm:text-base leading-relaxed">
                Perbandingan objektif antara pengelolaan konvensional berbasis WhatsApp &amp; spreadsheet Excel dengan ekosistem otomatis terpadu TrackFleet.
            </p>
        </div>

        <!-- Desktop Column Headers -->
        <div class="hidden lg:grid grid-cols-12 gap-6 px-6 py-3 mb-2 text-xs font-bold tracking-wider uppercase text-slate-500">
            <div class="col-span-4 flex items-center gap-2">
                <i data-lucide="layers" class="w-4 h-4 text-slate-400"></i>
                <span>Aspek Operasional Logistik</span>
            </div>
            <div class="col-span-4 flex items-center gap-2 text-slate-600">
                <i data-lucide="minus-circle" class="w-4 h-4 text-slate-400"></i>
                <span>Cara Lama (Excel, Kertas &amp; WA)</span>
            </div>
            <div class="col-span-4 flex items-center gap-2 text-brand-700">
                <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-600"></i>
                <span>TrackFleet Enterprise OS</span>
            </div>
        </div>

        <!-- Comparison Rows Container -->
        <div class="space-y-4">
            
            <!-- Row 1: Investasi Alat Pelacak GPS -->
            <div class="bg-white rounded-2xl border border-slate-200/90 hover:border-brand-300 hover:shadow-md transition duration-200 p-5 sm:p-6 reveal">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-6 items-stretch">
                    <!-- Aspect -->
                    <div class="lg:col-span-4 flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center border border-slate-200 shrink-0 mt-0.5">
                            <i data-lucide="smartphone" class="w-5 h-5 text-brand-600"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2 py-0.5 rounded">
                                Hardware &amp; Biaya
                            </span>
                            <h3 class="text-base font-bold text-slate-900 mt-1">1. Investasi Alat Pelacak (GPS)</h3>
                            <p class="text-xs text-slate-500 mt-1">Biaya pengadaan perangkat, montir, dan server pihak ketiga.</p>
                        </div>
                    </div>

                    <!-- Cara Lama -->
                    <div class="lg:col-span-4 p-4 rounded-xl bg-slate-50 border border-slate-200/70 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-1.5 text-xs font-bold text-slate-500 mb-1.5 lg:hidden">
                                <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-slate-400"></i>
                                <span>Cara Lama:</span>
                            </div>
                            <div class="text-xs font-semibold text-slate-700">Beban Biaya Capex &amp; Vendor Mahal</div>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                <strong class="text-slate-800">Beli GPS Rp 1,5–3 Jt / truk</strong> + ongkos pasang montir bengkel + biaya server vendor Rp 150rb/bulan per unit.
                            </p>
                        </div>
                    </div>

                    <!-- TrackFleet OS -->
                    <div class="lg:col-span-4 p-4 rounded-xl bg-brand-50/50 border border-brand-200/90 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-1.5 text-xs font-bold text-brand-700">
                                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-brand-600"></i>
                                    <span>TrackFleet OS</span>
                                </div>
                                <span class="text-[10px] font-mono font-bold uppercase text-brand-700 bg-brand-100 px-2 py-0.5 rounded border border-brand-200">
                                    Nol Rupiah Hardware
                                </span>
                            </div>
                            <div class="text-xs font-bold text-slate-900">Zero Hardware &amp; Cukup HP Sopir</div>
                            <p class="text-xs text-slate-700 mt-1 leading-relaxed">
                                <strong class="text-brand-900">Rp 0 modal alat</strong>. Cukup buka link web di HP pengemudi tanpa instalasi APK, tanpa montir, dan anti-cabut di jalan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: Pencegahan Pesanan Merugi -->
            <div class="bg-white rounded-2xl border border-slate-200/90 hover:border-brand-300 hover:shadow-md transition duration-200 p-5 sm:p-6 reveal">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-6 items-stretch">
                    <!-- Aspect -->
                    <div class="lg:col-span-4 flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center border border-slate-200 shrink-0 mt-0.5">
                            <i data-lucide="shield-alert" class="w-5 h-5 text-brand-600"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2 py-0.5 rounded">
                                Margin &amp; Profit
                            </span>
                            <h3 class="text-base font-bold text-slate-900 mt-1">2. Pencegahan Pesanan Merugi</h3>
                            <p class="text-xs text-slate-500 mt-1">Keputusan menerima muatan sebelum uang jalan digelontorkan.</p>
                        </div>
                    </div>

                    <!-- Cara Lama -->
                    <div class="lg:col-span-4 p-4 rounded-xl bg-slate-50 border border-slate-200/70 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-1.5 text-xs font-bold text-slate-500 mb-1.5 lg:hidden">
                                <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-slate-400"></i>
                                <span>Cara Lama:</span>
                            </div>
                            <div class="text-xs font-semibold text-slate-700">Boncos Baru Ketahuan di Akhir Bulan</div>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                <strong class="text-slate-800">Rugi disadari terlambat</strong>. Biaya tol dan solar tidak dihitung presisi sebelum unit jalan, kas bulanan tekor.
                            </p>
                        </div>
                    </div>

                    <!-- TrackFleet OS -->
                    <div class="lg:col-span-4 p-4 rounded-xl bg-brand-50/50 border border-brand-200/90 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-1.5 text-xs font-bold text-brand-700">
                                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-brand-600"></i>
                                    <span>TrackFleet OS</span>
                                </div>
                                <span class="text-[10px] font-mono font-bold uppercase text-brand-700 bg-brand-100 px-2 py-0.5 rounded border border-brand-200">
                                    Margin Guard &lt;10%
                                </span>
                            </div>
                            <div class="text-xs font-bold text-slate-900">Kunci Laba Otomatis Sebelum Truk Jalan</div>
                            <p class="text-xs text-slate-700 mt-1 leading-relaxed">
                                <strong class="text-brand-900">Kunci laba di muka</strong>. Margin Guard otomatis menganalisis tarif vs ongkos dan memblokir order berisiko rugi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 3: Pemantauan Lokasi Armada -->
            <div class="bg-white rounded-2xl border border-slate-200/90 hover:border-brand-300 hover:shadow-md transition duration-200 p-5 sm:p-6 reveal">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-6 items-stretch">
                    <!-- Aspect -->
                    <div class="lg:col-span-4 flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center border border-slate-200 shrink-0 mt-0.5">
                            <i data-lucide="map-pin" class="w-5 h-5 text-brand-600"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2 py-0.5 rounded">
                                Visibilitas Lapangan
                            </span>
                            <h3 class="text-base font-bold text-slate-900 mt-1">3. Pemantauan Lokasi Armada</h3>
                            <p class="text-xs text-slate-500 mt-1">Kabar posisi sopir, rute Trans-Jawa, dan estimasi waktu tiba.</p>
                        </div>
                    </div>

                    <!-- Cara Lama -->
                    <div class="lg:col-span-4 p-4 rounded-xl bg-slate-50 border border-slate-200/70 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-1.5 text-xs font-bold text-slate-500 mb-1.5 lg:hidden">
                                <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-slate-400"></i>
                                <span>Cara Lama:</span>
                            </div>
                            <div class="text-xs font-semibold text-slate-700">Telepon &amp; Chat Sopir Satu per Satu di WA</div>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                <strong class="text-slate-800">Repot hubungi puluhan sopir</strong>. Mengganggu konsentrasi menyetir dan sering tak direspons saat macet.
                            </p>
                        </div>
                    </div>

                    <!-- TrackFleet OS -->
                    <div class="lg:col-span-4 p-4 rounded-xl bg-brand-50/50 border border-brand-200/90 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-1.5 text-xs font-bold text-brand-700">
                                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-brand-600"></i>
                                    <span>TrackFleet OS</span>
                                </div>
                                <span class="text-[10px] font-mono font-bold uppercase text-brand-700 bg-brand-100 px-2 py-0.5 rounded border border-brand-200">
                                    Live Telemetry &amp; ETA
                                </span>
                            </div>
                            <div class="text-xs font-bold text-slate-900">Peta Telemetri Otomatis Tanpa Ganggu Sopir</div>
                            <p class="text-xs text-slate-700 mt-1 leading-relaxed">
                                <strong class="text-brand-900">Pantau live 24/7</strong>. Posisi armada, kecepatan, dan estimasi waktu tiba (ETA) terpantau langsung tanpa telepon.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 4: Bukti Serah Terima Barang (E-POD) -->
            <div class="bg-white rounded-2xl border border-slate-200/90 hover:border-brand-300 hover:shadow-md transition duration-200 p-5 sm:p-6 reveal">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-6 items-stretch">
                    <!-- Aspect -->
                    <div class="lg:col-span-4 flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center border border-slate-200 shrink-0 mt-0.5">
                            <i data-lucide="file-check" class="w-5 h-5 text-brand-600"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2 py-0.5 rounded">
                                Bukti Kiriman Sah
                            </span>
                            <h3 class="text-base font-bold text-slate-900 mt-1">4. Bukti Serah Terima Barang</h3>
                            <p class="text-xs text-slate-500 mt-1">Validasi penerimaan muatan di gudang tujuan (Proof of Delivery).</p>
                        </div>
                    </div>

                    <!-- Cara Lama -->
                    <div class="lg:col-span-4 p-4 rounded-xl bg-slate-50 border border-slate-200/70 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-1.5 text-xs font-bold text-slate-500 mb-1.5 lg:hidden">
                                <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-slate-400"></i>
                                <span>Cara Lama:</span>
                            </div>
                            <div class="text-xs font-semibold text-slate-700">Surat Jalan Kertas Rentan Basah &amp; Hilang</div>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                <strong class="text-slate-800">Kertas terselip, basah, atau hilang</strong> di kabin sehingga pembuktian serah terima muatan rawan sengketa.
                            </p>
                        </div>
                    </div>

                    <!-- TrackFleet OS -->
                    <div class="lg:col-span-4 p-4 rounded-xl bg-brand-50/50 border border-brand-200/90 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-1.5 text-xs font-bold text-brand-700">
                                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-brand-600"></i>
                                    <span>TrackFleet OS</span>
                                </div>
                                <span class="text-[10px] font-mono font-bold uppercase text-brand-700 bg-brand-100 px-2 py-0.5 rounded border border-brand-200">
                                    Sah UU ITE No. 1/2024
                                </span>
                            </div>
                            <div class="text-xs font-bold text-slate-900">E-POD Digital dengan Tanda Tangan &amp; Foto</div>
                            <p class="text-xs text-slate-700 mt-1 leading-relaxed">
                                <strong class="text-brand-900">Sah UU ITE No. 1/2024</strong>. Tanda tangan di layar HP &amp; foto muatan tersimpan aman dengan GPS detik itu juga.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 5: Waktu Penerbitan Invoice -->
            <div class="bg-white rounded-2xl border border-slate-200/90 hover:border-brand-300 hover:shadow-md transition duration-200 p-5 sm:p-6 reveal">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-6 items-stretch">
                    <!-- Aspect -->
                    <div class="lg:col-span-4 flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center border border-slate-200 shrink-0 mt-0.5">
                            <i data-lucide="clock" class="w-5 h-5 text-brand-600"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2 py-0.5 rounded">
                                Kecepatan Kas (Billing)
                            </span>
                            <h3 class="text-base font-bold text-slate-900 mt-1">5. Waktu Penerbitan Invoice</h3>
                            <p class="text-xs text-slate-500 mt-1">Kecepatan penagihan ke shipper dan perputaran modal operasional.</p>
                        </div>
                    </div>

                    <!-- Cara Lama -->
                    <div class="lg:col-span-4 p-4 rounded-xl bg-slate-50 border border-slate-200/70 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-1.5 text-xs font-bold text-slate-500 mb-1.5 lg:hidden">
                                <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-slate-400"></i>
                                <span>Cara Lama:</span>
                            </div>
                            <div class="text-xs font-semibold text-slate-700">Arus Kas Tertahan Menunggu 10–14 Hari</div>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                <strong class="text-slate-800">Menunggu fisik surat jalan</strong> kembali ke pool berhari-hari baru bisa menagih ke shipper. Kas tercekik.
                            </p>
                        </div>
                    </div>

                    <!-- TrackFleet OS -->
                    <div class="lg:col-span-4 p-4 rounded-xl bg-brand-50/50 border border-brand-200/90 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-1.5 text-xs font-bold text-brand-700">
                                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-brand-600"></i>
                                    <span>TrackFleet OS</span>
                                </div>
                                <span class="text-[10px] font-mono font-bold uppercase text-brand-700 bg-brand-100 px-2 py-0.5 rounded border border-brand-200">
                                    Detik Itu Juga
                                </span>
                            </div>
                            <div class="text-xs font-bold text-slate-900">Faktur Tagihan Siap Terbit Otomatis</div>
                            <p class="text-xs text-slate-700 mt-1 leading-relaxed">
                                <strong class="text-brand-900">Invoice terbit seketika</strong> begitu E-POD ditandatangani di lokasi gudang. Tagihan langsung siap ditagihkan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 6: Layanan ke Klien (Shipper) -->
            <div class="bg-white rounded-2xl border border-slate-200/90 hover:border-brand-300 hover:shadow-md transition duration-200 p-5 sm:p-6 reveal">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-6 items-stretch">
                    <!-- Aspect -->
                    <div class="lg:col-span-4 flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center border border-slate-200 shrink-0 mt-0.5">
                            <i data-lucide="users" class="w-5 h-5 text-brand-600"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2 py-0.5 rounded">
                                Transparansi Shipper
                            </span>
                            <h3 class="text-base font-bold text-slate-900 mt-1">6. Layanan ke Klien (Shipper)</h3>
                            <p class="text-xs text-slate-500 mt-1">Kepuasan pemilik kargo dan citra profesionalisme transporter.</p>
                        </div>
                    </div>

                    <!-- Cara Lama -->
                    <div class="lg:col-span-4 p-4 rounded-xl bg-slate-50 border border-slate-200/70 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-1.5 text-xs font-bold text-slate-500 mb-1.5 lg:hidden">
                                <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-slate-400"></i>
                                <span>Cara Lama:</span>
                            </div>
                            <div class="text-xs font-semibold text-slate-700">Klien Komplain Karena Menunggu Info</div>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                <strong class="text-slate-800">Shipper bolak-balik tanya admin</strong>. Pelayanan lambat menurunkan kepercayaan klien dan membebani tim.
                            </p>
                        </div>
                    </div>

                    <!-- TrackFleet OS -->
                    <div class="lg:col-span-4 p-4 rounded-xl bg-brand-50/50 border border-brand-200/90 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-1.5 text-xs font-bold text-brand-700">
                                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-brand-600"></i>
                                    <span>TrackFleet OS</span>
                                </div>
                                <span class="text-[10px] font-mono font-bold uppercase text-brand-700 bg-brand-100 px-2 py-0.5 rounded border border-brand-200">
                                    Portal Publik Mandiri
                                </span>
                            </div>
                            <div class="text-xs font-bold text-slate-900">Link Lacak Publik Sekali Klik Tanpa Login</div>
                            <p class="text-xs text-slate-700 mt-1 leading-relaxed">
                                <strong class="text-brand-900">Klien cek posisi mandiri</strong> via link unik tanpa login. Transparan bagi shipper, margin internal tetap rahasia.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom Impact & Summary Bar -->
        <div class="mt-10 p-6 sm:p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm flex flex-col lg:flex-row items-center justify-between gap-6 reveal">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 w-full lg:w-auto">
                <div class="border-l-2 border-brand-500 pl-4">
                    <div class="text-xs font-mono font-bold text-brand-600 uppercase">Efisiensi Modal</div>
                    <div class="text-lg font-extrabold text-slate-900 mt-0.5">Rp 0 Biaya Alat</div>
                    <div class="text-xs text-slate-500 mt-0.5">Hemat Rp 2–3 Juta / truk</div>
                </div>
                <div class="border-l-2 border-brand-500 pl-4">
                    <div class="text-xs font-mono font-bold text-brand-600 uppercase">Siklus Penagihan</div>
                    <div class="text-lg font-extrabold text-slate-900 mt-0.5">85% Lebih Cepat</div>
                    <div class="text-xs text-slate-500 mt-0.5">Invoice terbit seketika</div>
                </div>
                <div class="border-l-2 border-brand-500 pl-4">
                    <div class="text-xs font-mono font-bold text-brand-600 uppercase">Keamanan Laba</div>
                    <div class="text-lg font-extrabold text-slate-900 mt-0.5">100% Terproteksi</div>
                    <div class="text-xs text-slate-500 mt-0.5">Deteksi order boncos dini</div>
                </div>
            </div>

            <div class="flex items-center gap-3 w-full lg:w-auto justify-end">
                <a href="{{ route('landing.pricing') }}" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-brand-600 text-white font-bold text-xs sm:text-sm hover:bg-brand-700 transition shadow-sm text-center flex items-center justify-center gap-2">
                    <span>Lihat Pilihan Skema Tarif</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>

    </div>
</section>


<!-- ==========================================
     SECURITY, COMPLIANCE & LEGAL STANDARDS
     Crisp White Enterprise Architecture
     ========================================== -->
<section class="py-20 bg-slate-50">
    <div class="w-full px-4 sm:px-6 md:px-10 lg:px-12 xl:px-16 2xl:px-20">
        
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <span class="text-xs font-bold tracking-wider uppercase text-brand-600 bg-brand-50 px-3.5 py-1 rounded-full border border-brand-200">
                Enterprise Security &amp; Compliance
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-4 tracking-tight">
                Standar Kepatuhan Hukum &amp; Keamanan Data B2B
            </h2>
            <p class="text-slate-600 mt-3 text-sm sm:text-base leading-relaxed">
                Menjamin keamanan manifest barang, integritas tanda tangan E-POD, dan privasi titik telemetri sesuai kerangka regulasi digital Republik Indonesia.
            </p>
        </div>

        <!-- 4 Security Pillars Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            
            <!-- Pillar 1 -->
            <div class="p-6 sm:p-7 rounded-2xl bg-slate-50 border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl transition duration-300 flex flex-col justify-between space-y-5 reveal">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold border border-brand-100 shadow-sm">
                            <i data-lucide="shield-check" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-brand-700 bg-brand-100/60 px-2.5 py-1 rounded border border-brand-200">
                            REGULASI RESMI
                        </span>
                    </div>

                    <div>
                        <div class="text-xs font-mono font-semibold text-brand-600">Amanat Regulasi</div>
                        <h3 class="text-lg font-bold text-slate-900 mt-0.5">UU PDP No. 27/2022</h3>
                        <p class="text-xs text-slate-600 leading-relaxed mt-2">
                            Perlindungan data pribadi pengemudi dan data manifest muatan klien diproses sesuai tata kelola privasi tanpa dibagikan ke pihak ketiga.
                        </p>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-200 space-y-1.5 text-xs text-slate-700">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Persetujuan pemrosesan data sopir</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Data manifest terisolasi per tenant</span>
                    </div>
                </div>
            </div>

            <!-- Pillar 2 -->
            <div class="p-6 sm:p-7 rounded-2xl bg-slate-50 border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl transition duration-300 flex flex-col justify-between space-y-5 reveal" style="--reveal-delay: 80ms;">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold border border-brand-100 shadow-sm">
                            <i data-lucide="lock" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-brand-700 bg-brand-100/60 px-2.5 py-1 rounded border border-brand-200">
                            KRIPTOGRAFI
                        </span>
                    </div>

                    <div>
                        <div class="text-xs font-mono font-semibold text-brand-600">Integritas Digital</div>
                        <h3 class="text-lg font-bold text-slate-900 mt-0.5">Enkripsi TLS 1.3 &amp; Hash</h3>
                        <p class="text-xs text-slate-600 leading-relaxed mt-2">
                            Pengiriman telemetri koordinat dan tanda tangan serah terima dilindungi cryptographic hash SHA-256 yang anti-rekayasa dan sah hukum.
                        </p>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-200 space-y-1.5 text-xs text-slate-700">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Transmisi end-to-end terenkripsi</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Alat bukti sah UU ITE No. 1/2024</span>
                    </div>
                </div>
            </div>

            <!-- Pillar 3 -->
            <div class="p-6 sm:p-7 rounded-2xl bg-slate-50 border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl transition duration-300 flex flex-col justify-between space-y-5 reveal" style="--reveal-delay: 160ms;">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold border border-brand-100 shadow-sm">
                            <i data-lucide="server" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-brand-700 bg-brand-100/60 px-2.5 py-1 rounded border border-brand-200">
                            DOMESTIK
                        </span>
                    </div>

                    <div>
                        <div class="text-xs font-mono font-semibold text-brand-600">Pusat Data Indonesia</div>
                        <h3 class="text-lg font-bold text-slate-900 mt-0.5">Server PP No. 71/2019</h3>
                        <p class="text-xs text-slate-600 leading-relaxed mt-2">
                            Infrastruktur komputasi dan penyimpanan berada pada fasilitas data center Tier-3 di Indonesia sesuai amanat PSTE Kominfo.
                        </p>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-200 space-y-1.5 text-xs text-slate-700">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Data residency lokal Indonesia</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Redundant automated database backup</span>
                    </div>
                </div>
            </div>

            <!-- Pillar 4 -->
            <div class="p-6 sm:p-7 rounded-2xl bg-slate-50 border border-slate-200/90 hover:border-brand-500/40 hover:shadow-xl transition duration-300 flex flex-col justify-between space-y-5 reveal" style="--reveal-delay: 240ms;">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold border border-brand-100 shadow-sm">
                            <i data-lucide="users" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-brand-700 bg-brand-100/60 px-2.5 py-1 rounded border border-brand-200">
                            TATA KELOLA
                        </span>
                    </div>

                    <div>
                        <div class="text-xs font-mono font-semibold text-brand-600">Akses Bertingkat</div>
                        <h3 class="text-lg font-bold text-slate-900 mt-0.5">Role-Based Access (RBAC)</h3>
                        <p class="text-xs text-slate-600 leading-relaxed mt-2">
                            Pemisahan izin akses yang ketat antara staf operasional dispatcher, bagian keuangan, manajemen armada, dan portal shipper.
                        </p>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-200 space-y-1.5 text-xs text-slate-700">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Kalkulasi margin disembunyikan dari klien</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                        <span>Pencatatan riwayat audit log operasional</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom Security Assurance Strip -->
        <div class="mt-12 p-4 sm:p-5 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-600 reveal">
            <div class="flex items-center gap-3">
                <span class="w-2.5 h-2.5 rounded-full bg-brand-600 animate-pulse"></span>
                <span class="font-semibold text-slate-900">Sertifikasi &amp; Keamanan Data Terverifikasi</span>
                <span class="text-slate-300 hidden sm:inline">•</span>
                <span class="text-slate-500">Kesiapan Audit ISO 27001 &amp; Integrasi ERP Korporat</span>
            </div>
            <a href="https://wa.me/6281122334455?text=Halo%20TrackFleet%2C%20saya%20ingin%20tanya%20seputar%20keamanan%20dan%20integrasi%20sistem" target="_blank" rel="noopener noreferrer" class="font-bold text-brand-600 hover:text-brand-700 transition flex items-center gap-1 shrink-0">
                <span>Konsultasi Keamanan &amp; Integrasi</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

    </div>
</section>


<!-- ==========================================
     FREQUENTLY ASKED QUESTIONS (FAQ)
     Split 2-Column Desktop Grid with Helpdesk Card
     ========================================== -->
<section class="py-20 bg-white">
    <div class="w-full px-4 sm:px-6 md:px-10 lg:px-12 xl:px-16 2xl:px-20">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
            
            <!-- FAQ Left Column: Sticky Deskripsi & Helpdesk Box -->
            <div class="lg:col-span-5 space-y-6 lg:sticky lg:top-28 reveal">
                <div>
                    <span class="text-xs font-bold tracking-wider uppercase text-brand-600 bg-brand-50 px-3.5 py-1 rounded-full border border-brand-200">
                        Pusat Bantuan &amp; FAQ
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-4 tracking-tight leading-tight">
                        Pertanyaan yang Sering Diajukan
                    </h2>
                    <p class="text-slate-600 mt-3 text-sm sm:text-base leading-relaxed">
                        Hal-hal esensial seputar implementasi armada tanpa alat GPS, keabsahan hukum E-POD untuk penagihan, hingga formula proteksi Margin Guard.
                    </p>
                </div>

                <!-- Helpdesk Contact Card -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold border border-brand-100">
                            <i data-lucide="help-circle" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="text-sm font-bold text-slate-900">Butuh Konsultasi Operasional?</div>
                            <div class="text-[11px] text-slate-500">Tim kami siap membantu integrasi armada</div>
                        </div>
                    </div>

                    <p class="text-xs text-slate-600 leading-relaxed">
                        Punya kebutuhan khusus untuk armada truk, format surat jalan, atau skema tarif perusahaan Anda? Diskusikan langsung bersama tim spesialis logistik kami.
                    </p>

                    <div class="pt-2 space-y-2.5">
                        <a href="https://wa.me/6281122334455?text=Halo%20TrackFleet%2C%20saya%20ingin%20tanya%20seputar%20implementasi%20armada" target="_blank" rel="noopener noreferrer" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-bold text-xs shadow-md shadow-brand-600/20 transition">
                            <i data-lucide="message-square" class="w-4 h-4"></i>
                            <span>Hubungi Tim Spesialis via WhatsApp</span>
                        </a>

                        <div class="flex items-center justify-between text-[11px] text-slate-500 pt-1">
                            <span class="flex items-center gap-1.5">
                                <i data-lucide="clock" class="w-3.5 h-3.5 text-brand-600"></i>
                                Respon cepat &lt; 15 menit
                            </span>
                            <a href="mailto:halo@trackfleet.id" class="text-brand-600 hover:underline font-mono">halo@trackfleet.id</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Right Column: Numbered Rich Accordion Cards -->
            <div class="lg:col-span-7 space-y-4 reveal" style="--reveal-delay: 100ms;">
                
                <!-- FAQ 1 (Open by default) -->
                <div id="faq-card-faq-1" class="rounded-2xl bg-white border border-brand-300 shadow-sm overflow-hidden transition-all duration-200">
                    <button type="button" id="faq-btn-faq-1" aria-expanded="true" aria-controls="faq-1" onclick="toggleFaq('faq-1')" class="group w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4">
                        <div class="flex items-start gap-3.5">
                            <span class="font-mono text-xs font-bold text-brand-600 bg-brand-50 px-2 py-0.5 rounded-md border border-brand-100 shrink-0 mt-0.5">01</span>
                            <span class="font-bold text-slate-900 text-sm sm:text-base group-hover:text-brand-600 transition leading-snug">
                                Apakah saya benar-benar tidak perlu memasang alat fisik GPS di truk?
                            </span>
                        </div>
                        <div class="w-7 h-7 rounded-full bg-slate-100 group-hover:bg-brand-50 flex items-center justify-center text-slate-500 group-hover:text-brand-600 shrink-0 transition">
                            <i id="faq-icon-faq-1" data-lucide="chevron-down" class="w-4 h-4 rotate-180 transition-transform duration-200"></i>
                        </div>
                    </button>
                    <div id="faq-1" role="region" aria-labelledby="faq-btn-faq-1" class="px-5 sm:px-6 pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                        <p class="mb-3">
                            <strong class="text-slate-900">Ya, 100% tanpa modal beli hardware GPS.</strong> Pengemudi hanya perlu membuka tautan penugasan surat jalan digital di browser ponsel (Google Chrome atau Safari).
                        </p>
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 space-y-1.5">
                            <div class="flex items-center gap-2 font-semibold text-slate-900">
                                <i data-lucide="check" class="w-4 h-4 text-brand-600"></i>
                                <span>Keunggulan Pendekatan Mobile Web:</span>
                            </div>
                            <ul class="space-y-1 pl-6 list-disc text-slate-600 text-[11px] sm:text-xs">
                                <li>Nol rupiah biaya pengadaan blackbox GPS (hemat Rp 1.5–3 Juta / truk).</li>
                                <li>Tidak ada risiko kabel dipotong atau GPS dicabut sopir di jalan.</li>
                                <li>Privasi sopir terjamin karena pelacakan hanya aktif saat tugas pengiriman berlangsung.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div id="faq-card-faq-2" class="rounded-2xl bg-white border border-slate-200 shadow-sm overflow-hidden transition-all duration-200">
                    <button type="button" id="faq-btn-faq-2" aria-expanded="false" aria-controls="faq-2" onclick="toggleFaq('faq-2')" class="group w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4">
                        <div class="flex items-start gap-3.5">
                            <span class="font-mono text-xs font-bold text-brand-600 bg-brand-50 px-2 py-0.5 rounded-md border border-brand-100 shrink-0 mt-0.5">02</span>
                            <span class="font-bold text-slate-900 text-sm sm:text-base group-hover:text-brand-600 transition leading-snug">
                                Bagaimana jika ponsel pengemudi kehabisan sinyal di tengah jalur Trans-Jawa?
                            </span>
                        </div>
                        <div class="w-7 h-7 rounded-full bg-slate-100 group-hover:bg-brand-50 flex items-center justify-center text-slate-500 group-hover:text-brand-600 shrink-0 transition">
                            <i id="faq-icon-faq-2" data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200"></i>
                        </div>
                    </button>
                    <div id="faq-2" role="region" aria-labelledby="faq-btn-faq-2" class="px-5 sm:px-6 pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4 hidden">
                        Aplikasi sopir TrackFleet dirancang dengan arsitektur <strong class="text-slate-900">Offline-First</strong>. Bila armada melintasi area pegunungan atau titik blank spot di tol, titik koordinat dan foto bukti serah terima tetap tersimpan aman di memori lokal ponsel dan akan otomatis tersinkronisasi ke dashboard saat ponsel kembali menangkap sinyal seluler.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div id="faq-card-faq-3" class="rounded-2xl bg-white border border-slate-200 shadow-sm overflow-hidden transition-all duration-200">
                    <button type="button" id="faq-btn-faq-3" aria-expanded="false" aria-controls="faq-3" onclick="toggleFaq('faq-3')" class="group w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4">
                        <div class="flex items-start gap-3.5">
                            <span class="font-mono text-xs font-bold text-brand-600 bg-brand-50 px-2 py-0.5 rounded-md border border-brand-100 shrink-0 mt-0.5">03</span>
                            <span class="font-bold text-slate-900 text-sm sm:text-base group-hover:text-brand-600 transition leading-snug">
                                Bagaimana cara kerja formula Margin Guard &lt;10%?
                            </span>
                        </div>
                        <div class="w-7 h-7 rounded-full bg-slate-100 group-hover:bg-brand-50 flex items-center justify-center text-slate-500 group-hover:text-brand-600 shrink-0 transition">
                            <i id="faq-icon-faq-3" data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200"></i>
                        </div>
                    </button>
                    <div id="faq-3" role="region" aria-labelledby="faq-btn-faq-3" class="px-5 sm:px-6 pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4 hidden">
                        <p class="mb-3">
                            Margin Guard secara otomatis menghitung: <code class="px-2 py-1 rounded bg-slate-100 text-slate-800 font-mono text-[11px] font-bold">(Nilai Kontrak - (Biaya Tol + BBM Solar + Uang Jalan + Vendor)) / Nilai Kontrak</code>.
                        </p>
                        <p>
                            Bila laba kotor yang dihasilkan berada di bawah <strong class="text-slate-900">10%</strong>, sistem secara visual memberi penanda khusus pada baris pesanan agar tim operasional dapat segera bernegosiasi ulang dengan pemilik muatan sebelum surat jalan diterbitkan.
                        </p>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div id="faq-card-faq-4" class="rounded-2xl bg-white border border-slate-200 shadow-sm overflow-hidden transition-all duration-200">
                    <button type="button" id="faq-btn-faq-4" aria-expanded="false" aria-controls="faq-4" onclick="toggleFaq('faq-4')" class="group w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4">
                        <div class="flex items-start gap-3.5">
                            <span class="font-mono text-xs font-bold text-brand-600 bg-brand-50 px-2 py-0.5 rounded-md border border-brand-100 shrink-0 mt-0.5">04</span>
                            <span class="font-bold text-slate-900 text-sm sm:text-base group-hover:text-brand-600 transition leading-snug">
                                Apakah tanda tangan E-POD sah secara hukum untuk menagih ke klien (shipper)?
                            </span>
                        </div>
                        <div class="w-7 h-7 rounded-full bg-slate-100 group-hover:bg-brand-50 flex items-center justify-center text-slate-500 group-hover:text-brand-600 shrink-0 transition">
                            <i id="faq-icon-faq-4" data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200"></i>
                        </div>
                    </button>
                    <div id="faq-4" role="region" aria-labelledby="faq-btn-faq-4" class="px-5 sm:px-6 pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4 hidden">
                        Sangat sah. Berdasarkan amanat <strong class="text-slate-900">UU ITE No. 1/2024</strong> dan regulasi <strong class="text-slate-900">UU PDP No. 27/2022</strong>, bukti tanda tangan digital pada layar sentuh yang disertai geo-tag koordinat lokasi bongkar, foto muatan fisik, dan cap waktu digital diakui sah sebagai alat bukti elektronik transaksi perdagangan untuk penagihan faktur resmi.
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div id="faq-card-faq-5" class="rounded-2xl bg-white border border-slate-200 shadow-sm overflow-hidden transition-all duration-200">
                    <button type="button" id="faq-btn-faq-5" aria-expanded="false" aria-controls="faq-5" onclick="toggleFaq('faq-5')" class="group w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4">
                        <div class="flex items-start gap-3.5">
                            <span class="font-mono text-xs font-bold text-brand-600 bg-brand-50 px-2 py-0.5 rounded-md border border-brand-100 shrink-0 mt-0.5">05</span>
                            <span class="font-bold text-slate-900 text-sm sm:text-base group-hover:text-brand-600 transition leading-snug">
                                Apakah saya bisa memberikan link pelacakan kepada pemilik barang tanpa mereka melihat margin laba saya?
                            </span>
                        </div>
                        <div class="w-7 h-7 rounded-full bg-slate-100 group-hover:bg-brand-50 flex items-center justify-center text-slate-500 group-hover:text-brand-600 shrink-0 transition">
                            <i id="faq-icon-faq-5" data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200"></i>
                        </div>
                    </button>
                    <div id="faq-5" role="region" aria-labelledby="faq-btn-faq-5" class="px-5 sm:px-6 pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4 hidden">
                        Tentu saja. Portal Lacak Publik (<a href="{{ route('tracking.public') }}" class="text-brand-600 underline font-semibold">tracking/public</a>) dibuat secara terisolasi. Pemilik barang hanya dapat melihat status perjalanan, lokasi peta, dan informasi rute tanpa bisa melihat biaya operasional, ongkos solar, tarif vendor, maupun persentase margin keuntungan perusahaan Anda.
                    </div>
                </div>

                <!-- FAQ 6 -->
                <div id="faq-card-faq-6" class="rounded-2xl bg-white border border-slate-200 shadow-sm overflow-hidden transition-all duration-200">
                    <button type="button" id="faq-btn-faq-6" aria-expanded="false" aria-controls="faq-6" onclick="toggleFaq('faq-6')" class="group w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4">
                        <div class="flex items-start gap-3.5">
                            <span class="font-mono text-xs font-bold text-brand-600 bg-brand-50 px-2 py-0.5 rounded-md border border-brand-100 shrink-0 mt-0.5">06</span>
                            <span class="font-bold text-slate-900 text-sm sm:text-base group-hover:text-brand-600 transition leading-snug">
                                Berapa lama waktu yang dibutuhkan untuk mulai menggunakan TrackFleet?
                            </span>
                        </div>
                        <div class="w-7 h-7 rounded-full bg-slate-100 group-hover:bg-brand-50 flex items-center justify-center text-slate-500 group-hover:text-brand-600 shrink-0 transition">
                            <i id="faq-icon-faq-6" data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200"></i>
                        </div>
                    </button>
                    <div id="faq-6" role="region" aria-labelledby="faq-btn-faq-6" class="px-5 sm:px-6 pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4 hidden">
                        Kurang dari 10 menit. Anda dapat langsung membuka dashboard operasional, mendaftarkan nomor polisi armada serta nama pengemudi, lalu langsung membuat surat jalan pertama. Tanpa instalasi alat mekanik, tanpa kartu kredit, dan langsung siap pakai.
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>


<!-- ==========================================
     GRAND FULL-WIDTH ENTERPRISE CTA BANNER
     Split Executive Command Layout
     ========================================== -->
<section class="relative py-20 bg-slate-950 text-white overflow-hidden border-t border-slate-800/80">
    <!-- Ambient Glow -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[350px] bg-brand-600/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="relative w-full px-4 sm:px-6 md:px-10 lg:px-12 xl:px-16 2xl:px-20">
        <div class="relative rounded-3xl bg-gradient-to-br from-slate-900 via-slate-900 to-slate-950 border border-slate-800 p-8 sm:p-12 lg:p-14 shadow-2xl overflow-hidden reveal-scale">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left Column (7 cols): Punchy Value & CTAs -->
                <div class="lg:col-span-7 space-y-6 text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-brand-500/10 text-brand-300 border border-brand-500/20">
                        <span class="w-2 h-2 rounded-full bg-brand-400 animate-pulse"></span>
                        <span>Akses Instan • Uji Coba Gratis 14 Hari Tanpa Syarat</span>
                    </div>

                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white leading-[1.15]">
                        Hentikan Kebocoran Margin &amp;<br>
                        <span class="text-brand-400">Kendalikan Armada Anda</span> Hari Ini.
                    </h2>
                    
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-xl">
                        Mulai gunakan dashboard untuk memantau pergerakan truk secara live GPS via ponsel sopir, kunci margin laba sebelum unit berangkat, dan percepat penagihan invoice shipper dengan E-POD digital sah.
                    </p>

                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="{{ route('admin.dashboard') }}" class="px-7 py-3.5 rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-bold text-sm shadow-xl shadow-brand-600/30 transition transform hover:-translate-y-0.5 inline-flex items-center gap-2">
                            <span>Buka Dashboard Operasional Gratis</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                        <a href="https://wa.me/6281122334455?text=Halo%20TrackFleet%2C%20saya%20ingin%20konsultasi%20operasional%20armada" target="_blank" rel="noopener noreferrer" class="px-6 py-3.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 font-semibold text-sm transition inline-flex items-center gap-2">
                            <i data-lucide="message-square" class="w-4 h-4 text-brand-400"></i>
                            <span>Konsultasi WhatsApp</span>
                        </a>
                    </div>

                    <div class="pt-3 flex flex-wrap items-center gap-y-2 gap-x-6 text-xs text-slate-400">
                        <span class="flex items-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5 text-brand-400"></i> Langsung aktif dalam 5 menit</span>
                        <span class="flex items-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5 text-brand-400"></i> Tanpa hardware GPS</span>
                        <span class="flex items-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5 text-brand-400"></i> Tanpa kartu kredit</span>
                    </div>
                </div>

                <!-- Right Column (5 cols): Live Operational Proof Terminal -->
                <div class="lg:col-span-5">
                    <div class="p-6 rounded-2xl bg-slate-950/90 border border-slate-800 space-y-4 shadow-xl">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-brand-400 animate-pulse"></span>
                                <span class="text-xs font-mono font-bold text-white uppercase tracking-wider">Status Operasi Armada</span>
                            </div>
                            <span class="text-[10px] font-mono text-brand-400 bg-brand-500/10 px-2.5 py-0.5 rounded border border-brand-500/20">DEMO · LIVE SYSTEM</span>
                        </div>

                        <div class="space-y-2.5 text-xs">
                            <div class="p-3 rounded-xl bg-slate-900 border border-slate-800/80 flex items-center justify-between">
                                <span class="text-slate-400">Proteksi Margin Guard</span>
                                <span class="font-bold text-brand-400 font-mono">100% Aktif (&lt;10% Alert)</span>
                            </div>
                            <div class="p-3 rounded-xl bg-slate-900 border border-slate-800/80 flex items-center justify-between">
                                <span class="text-slate-400">Biaya Pengadaan Alat GPS</span>
                                <span class="font-bold text-white font-mono">Rp 0 (Ponsel Sopir)</span>
                            </div>
                            <div class="p-3 rounded-xl bg-slate-900 border border-slate-800/80 flex items-center justify-between">
                                <span class="text-slate-400">Kecepatan Terbit Tagihan</span>
                                <span class="font-bold text-brand-400 font-mono">1 Hari (Pasca E-POD)</span>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a href="{{ route('landing.pricing') }}" class="block text-center w-full py-3 rounded-xl bg-slate-900 hover:bg-slate-800 border border-slate-700/80 text-xs font-bold text-slate-300 hover:text-white transition">
                                Lihat Pilihan Skema Tarif Armada →
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@push('scripts')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@graph": [
        {
            "@@type": "Organization",
            "@@id": "{{ url('/') }}#organization",
            "name": "TrackFleet",
            "url": "{{ url('/') }}",
            "logo": "{{ asset('favicon.svg') }}",
            "description": "Platform operasional logistik B2B untuk memantau armada live GPS via ponsel sopir, mengunci margin laba sebelum kirim, dan menerbitkan invoice berlandaskan bukti serah terima digital (E-POD).",
            "areaServed": "ID",
            "contactPoint": {
                "@@type": "ContactPoint",
                "contactType": "sales",
                "email": "halo@trackfleet.id",
                "telephone": "+6281122334455",
                "availableLanguage": ["id", "en"]
            }
        },
        {
            "@@type": "FAQPage",
            "@@id": "{{ url('/') }}#faq",
            "mainEntity": [
                {
                    "@@type": "Question",
                    "name": "Apakah saya benar-benar tidak perlu memasang alat fisik GPS di truk?",
                    "acceptedAnswer": { "@@type": "Answer", "text": "Ya, 100% tanpa modal beli hardware GPS. Pengemudi hanya perlu membuka tautan penugasan surat jalan digital di browser ponsel (Google Chrome atau Safari)." }
                },
                {
                    "@@type": "Question",
                    "name": "Bagaimana jika ponsel pengemudi kehabisan sinyal di tengah jalur Trans-Jawa?",
                    "acceptedAnswer": { "@@type": "Answer", "text": "Aplikasi sopir TrackFleet dirancang dengan arsitektur Offline-First. Titik koordinat dan foto bukti serah terima tetap tersimpan di memori lokal ponsel dan otomatis tersinkronisasi ke dashboard saat ponsel kembali menangkap sinyal seluler." }
                },
                {
                    "@@type": "Question",
                    "name": "Bagaimana cara kerja formula Margin Guard di bawah 10 persen?",
                    "acceptedAnswer": { "@@type": "Answer", "text": "Margin Guard menghitung (Nilai Kontrak - (Biaya Tol + BBM Solar + Uang Jalan + Vendor)) / Nilai Kontrak. Bila laba kotor di bawah 10%, sistem memberi penanda khusus pada baris pesanan agar tim operasional dapat segera bernegosiasi ulang sebelum surat jalan diterbitkan." }
                },
                {
                    "@@type": "Question",
                    "name": "Apakah tanda tangan E-POD sah secara hukum untuk menagih ke klien (shipper)?",
                    "acceptedAnswer": { "@@type": "Answer", "text": "Sangat sah. Berdasarkan UU ITE No. 1/2024 dan UU PDP No. 27/2022, bukti tanda tangan digital disertai geo-tag koordinat, foto muatan, dan cap waktu digital diakui sebagai alat bukti elektronik untuk penagihan faktur resmi." }
                },
                {
                    "@@type": "Question",
                    "name": "Apakah saya bisa memberikan link pelacakan kepada pemilik barang tanpa mereka melihat margin laba saya?",
                    "acceptedAnswer": { "@@type": "Answer", "text": "Tentu. Portal Lacak Publik dibuat terisolasi. Pemilik barang hanya dapat melihat status perjalanan, lokasi peta, dan informasi rute tanpa bisa melihat biaya operasional maupun persentase margin keuntungan perusahaan Anda." }
                },
                {
                    "@@type": "Question",
                    "name": "Berapa lama waktu yang dibutuhkan untuk mulai menggunakan TrackFleet?",
                    "acceptedAnswer": { "@@type": "Answer", "text": "Kurang dari 10 menit. Anda dapat langsung membuka dashboard operasional, mendaftarkan nomor polisi armada serta nama pengemudi, lalu langsung membuat surat jalan pertama. Tanpa instalasi alat mekanik dan tanpa kartu kredit." }
                }
            ]
        }
    ]
}
</script>
<script>
    // Tab switcher in Hero Mission preview card
    function switchHeroTab(tab) {
        ['telemetry', 'margin', 'epod'].forEach(function(t) {
            var panel = document.getElementById('hero-panel-' + t);
            var btn = document.getElementById('tab-btn-' + t);
            if (panel && btn) {
                if (t === tab) {
                    panel.classList.remove('hidden');
                    btn.className = 'flex-1 py-2 px-2.5 rounded-xl bg-brand-600 text-white font-bold transition text-center flex items-center justify-center gap-1.5 shadow-sm';
                    btn.setAttribute('aria-selected', 'true');
                    btn.setAttribute('tabindex', '0');
                } else {
                    panel.classList.add('hidden');
                    btn.className = 'flex-1 py-2 px-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-900 transition text-center flex items-center justify-center gap-1.5';
                    btn.setAttribute('aria-selected', 'false');
                    btn.setAttribute('tabindex', '-1');
                }
            }
        });
        if (window.lucide) { lucide.createIcons(); }
    }

    // Keyboard navigation (Left/Right arrows) for hero feature tabs
    document.addEventListener('DOMContentLoaded', function () {
        var tablist = document.querySelector('[role="tablist"]');
        if (!tablist) return;
        var order = ['telemetry', 'margin', 'epod'];
        tablist.addEventListener('keydown', function (e) {
            if (e.key !== 'ArrowRight' && e.key !== 'ArrowLeft') return;
            var active = (document.activeElement && document.activeElement.id || '').replace('tab-btn-', '');
            var current = order.indexOf(active);
            if (current === -1) return;
            e.preventDefault();
            var next = e.key === 'ArrowRight' ? (current + 1) % order.length : (current - 1 + order.length) % order.length;
            switchHeroTab(order[next]);
            var btn = document.getElementById('tab-btn-' + order[next]);
            if (btn) btn.focus();
        });
    });

    // Dynamic Fleet ROI Calculator
    var fleetData = {
        5: { annual: 'Rp 90.000.000', margin: 'Rp 7.500.000', gps: 'Rp 7.500.000', billing: '14 Hari → 1 Hari', hours: '~20 Jam / bln' },
        15: { annual: 'Rp 270.000.000', margin: 'Rp 22.500.000', gps: 'Rp 22.500.000', billing: '14 Hari → 1 Hari', hours: '~60 Jam / bln' },
        30: { annual: 'Rp 540.000.000', margin: 'Rp 45.000.000', gps: 'Rp 45.000.000', billing: '14 Hari → 1 Hari', hours: '~120 Jam / bln' },
        60: { annual: 'Rp 1.080.000.000', margin: 'Rp 90.000.000', gps: 'Rp 90.000.000', billing: '14 Hari → 1 Hari', hours: '~240 Jam / bln' },
        100: { annual: 'Rp 1.800.000.000+', margin: 'Rp 150.000.000+', gps: 'Rp 150.000.000+', billing: '14 Hari → 1 Hari', hours: '~400 Jam / bln' }
    };

    function setFleetSize(size) {
        [5, 15, 30, 60, 100].forEach(function(s) {
            var btn = document.getElementById('btn-fleet-' + s);
            if (btn) {
                var subDiv = btn.children[1];
                if (s === size) {
                    btn.className = 'fleet-btn px-4 py-3 rounded-xl font-bold text-xs sm:text-sm border-2 border-brand-600 bg-brand-600 text-white shadow-md shadow-brand-500/20 transition text-center';
                    if (subDiv) subDiv.className = 'text-[10px] font-normal text-brand-100 mt-0.5';
                } else {
                    btn.className = 'fleet-btn px-4 py-3 rounded-xl font-bold text-xs sm:text-sm border border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50 transition text-center';
                    if (subDiv) subDiv.className = 'text-[10px] font-normal text-slate-500 mt-0.5';
                }
            }
        });

        var data = fleetData[size];
        if (data) {
            var elAnnual = document.getElementById('calc-annual-saved');
            var elMargin = document.getElementById('calc-margin-saved');
            var elGps = document.getElementById('calc-gps-saved');
            var elBilling = document.getElementById('calc-billing-speed');
            var elHours = document.getElementById('calc-hours-saved');
            if (elAnnual) elAnnual.textContent = data.annual;
            if (elMargin) elMargin.textContent = data.margin;
            if (elGps) elGps.textContent = data.gps;
            if (elBilling) elBilling.textContent = data.billing;
            if (elHours) elHours.textContent = data.hours;
        }
    }

    // FAQ Accordion Toggle
    function toggleFaq(id) {
        var content = document.getElementById(id);
        var icon = document.getElementById('faq-icon-' + id);
        var card = document.getElementById('faq-card-' + id);
        var btn = document.getElementById('faq-btn-' + id);
        if (content) {
            var isHidden = content.classList.contains('hidden');
            if (isHidden) {
                content.classList.remove('hidden');
                if (icon) icon.classList.add('rotate-180');
                if (btn) btn.setAttribute('aria-expanded', 'true');
                if (card) {
                    card.classList.add('border-brand-300', 'shadow-md');
                    card.classList.remove('border-slate-200');
                }
            } else {
                content.classList.add('hidden');
                if (icon) icon.classList.remove('rotate-180');
                if (btn) btn.setAttribute('aria-expanded', 'false');
                if (card) {
                    card.classList.remove('border-brand-300', 'shadow-md');
                    card.classList.add('border-slate-200');
                }
            }
        }
    }

    // Animated count-up for statistics
    document.addEventListener('DOMContentLoaded', function () {
        var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var els = document.querySelectorAll('[data-count]');
        var run = function (el) {
            var target = parseInt(el.getAttribute('data-count'), 10) || 0;
            if (reduced) { el.textContent = target.toLocaleString('id-ID'); return; }
            var start = null, dur = 1400;
            var step = function (ts) {
                if (!start) start = ts;
                var p = Math.min((ts - start) / dur, 1);
                var eased = 1 - Math.pow(1 - p, 3);
                el.textContent = Math.round(target * eased).toLocaleString('id-ID');
                if (p < 1) requestAnimationFrame(step);
            };
            requestAnimationFrame(step);
        };
        if ('IntersectionObserver' in window) {
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (e) { if (e.isIntersecting) { run(e.target); io.unobserve(e.target); } });
            }, { threshold: 0.5 });
            els.forEach(function (el) { io.observe(el); });
        } else {
            els.forEach(run);
        }
    });
</script>
@endpush

@endsection
