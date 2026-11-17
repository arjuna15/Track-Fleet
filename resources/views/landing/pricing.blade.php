@extends('layouts.app')

@section('title', 'Pilihan Skema & Paket Layanan — TrackFleet')
@section('meta_description', 'Pilihan paket operasional armada fleksibel sesuai skala truk. Dari coba gratis 14 hari, paket operasional harian, hingga integrasi ERP korporat.')

@section('content')
<!-- Header Banner (Clean Pure White Canvas) -->
<section class="pt-28 pb-16 lg:pt-36 lg:pb-20 bg-white">
    <div class="w-full px-4 sm:px-6 md:px-10 lg:px-12 xl:px-16 2xl:px-20 text-center reveal">
        <span class="text-xs font-bold uppercase tracking-wider text-brand-600 bg-brand-50 border border-brand-200 px-3.5 py-1 rounded-full">
            Transparansi Biaya &amp; Skalabilitas
        </span>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 mt-4 tracking-tight">
            Paket yang Mengikuti Skala Armada Anda
        </h1>
        <p class="text-slate-600 mt-3 max-w-2xl mx-auto text-sm sm:text-base leading-relaxed">
            Tanpa modal beli alat GPS fisik, tanpa kontrak tahunan yang mengikat. Mulai uji coba gratis 14 hari dan tingkatkan kapasitas armada saat bisnis Anda bertumbuh.
        </p>
    </div>
</section>

<!-- Pricing Cards Grid -->
<section class="pb-20 bg-white">
    <div class="w-full px-4 sm:px-6 md:px-10 lg:px-12 xl:px-16 2xl:px-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
        
        <!-- Starter Plan -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-7 sm:p-8 shadow-sm hover:shadow-md hover:border-slate-300 transition duration-300 flex flex-col justify-between reveal">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2.5 py-1 rounded border border-slate-200">
                        MIKRO ARMADA
                    </span>
                    <span class="text-xs font-bold text-slate-500">1–5 Truk</span>
                </div>

                <h3 class="text-xl sm:text-2xl font-black text-slate-900 mt-4">Mulai</h3>
                <p class="text-xs text-slate-600 mt-1 leading-relaxed">Cocok untuk pemilik usaha rintisan dengan 1 s.d. 5 armada aktif.</p>
                
                <div class="mt-6 p-4 rounded-xl bg-slate-50 border border-slate-200/70">
                    <div class="flex items-baseline">
                        <span class="text-3xl sm:text-4xl font-black text-slate-900 font-mono">Rp 0</span>
                        <span class="text-xs text-slate-500 ml-2">/ 14 hari coba gratis</span>
                    </div>
                    <div class="text-xs text-slate-500 mt-1 font-medium">Lalu Rp 60.000 / truk / bulan</div>
                </div>

                <ul class="mt-6 space-y-3 text-xs text-slate-600">
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check" class="w-4 h-4 text-brand-600 shrink-0"></i>
                        <span>Hingga 5 armada aktif</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check" class="w-4 h-4 text-brand-600 shrink-0"></i>
                        <span>Pembaruan lokasi melalui ponsel</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check" class="w-4 h-4 text-brand-600 shrink-0"></i>
                        <span>Perhitungan margin pesanan</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check" class="w-4 h-4 text-brand-600 shrink-0"></i>
                        <span>Bukti serah terima digital</span>
                    </li>
                    <li class="flex items-center gap-2.5 text-slate-400">
                        <i data-lucide="minus" class="w-4 h-4 text-slate-300 shrink-0"></i>
                        <span>Peringatan Margin Guard &lt;10%</span>
                    </li>
                </ul>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="mt-8 block text-center py-3.5 rounded-xl border border-slate-300 font-bold text-xs text-slate-800 hover:bg-slate-50 hover:border-brand-400 transition shadow-xs">
                Mulai coba gratis 14 hari
            </a>
        </div>

        <!-- Professional Plan (Recommended) -->
        <div class="bg-slate-950 text-white rounded-2xl border-2 border-brand-500 p-7 sm:p-8 shadow-2xl relative flex flex-col justify-between transform md:-translate-y-2 reveal-scale" style="--reveal-delay: 100ms;">
            <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-brand-600 text-white text-[10px] uppercase tracking-wider font-extrabold px-3.5 py-1 rounded-full shadow-md shadow-brand-500/30 flex items-center gap-1.5 border border-brand-400">
                <i data-lucide="sparkles" class="w-3 h-3 text-brand-200"></i>
                <span>Untuk operasional harian</span>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-brand-300 bg-brand-500/15 px-2.5 py-1 rounded border border-brand-500/30">
                        PILIHAN UTAMA
                    </span>
                    <span class="text-xs font-bold text-slate-400">6–30 Truk</span>
                </div>

                <h3 class="text-xl sm:text-2xl font-black text-white mt-4">Operasional</h3>
                <p class="text-xs text-slate-400 mt-1 leading-relaxed">Cocok untuk transporter berkembang dengan 6 s.d. 30 unit armada.</p>
                
                <div class="mt-6 p-4 rounded-xl bg-slate-900 border border-slate-800">
                    <div class="flex items-baseline">
                        <span class="text-3xl sm:text-4xl font-black text-white font-mono">Rp 50.000</span>
                        <span class="text-xs text-slate-400 ml-2">/ truk / bulan</span>
                    </div>
                    <div class="text-xs text-brand-400 mt-1 font-semibold">Ditagih bulanan atau tahunan (diskon 15%)</div>
                </div>

                <ul class="mt-6 space-y-3 text-xs text-slate-300">
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check" class="w-4 h-4 text-brand-400 shrink-0"></i>
                        <span>Semua fitur Starter Fleet</span>
                    </li>
                    <li class="flex items-center gap-2.5 text-white font-bold">
                        <i data-lucide="shield-check" class="w-4 h-4 text-brand-400 shrink-0"></i>
                        <span>Penanda pesanan dengan margin di bawah 10%</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check" class="w-4 h-4 text-brand-400 shrink-0"></i>
                        <span>Halaman pelacakan untuk pelanggan</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check" class="w-4 h-4 text-brand-400 shrink-0"></i>
                        <span>Penerbitan faktur setelah bukti serah terima diunggah</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check" class="w-4 h-4 text-brand-400 shrink-0"></i>
                        <span>Dukungan khusus untuk tim Anda</span>
                    </li>
                </ul>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="mt-8 block text-center py-3.5 rounded-xl bg-brand-600 hover:bg-brand-500 font-bold text-xs text-white shadow-lg shadow-brand-600/30 transition transform hover:-translate-y-0.5">
                Pilih paket Operasional
            </a>
        </div>

        <!-- Enterprise Plan -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-7 sm:p-8 shadow-sm hover:shadow-md hover:border-slate-300 transition duration-300 flex flex-col justify-between reveal" style="--reveal-delay: 200ms;">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2.5 py-1 rounded border border-slate-200">
                        ENTERPRISE
                    </span>
                    <span class="text-xs font-bold text-slate-500">&gt;30 Truk</span>
                </div>

                <h3 class="text-xl sm:text-2xl font-black text-slate-900 mt-4">Korporat</h3>
                <p class="text-xs text-slate-600 mt-1 leading-relaxed">Untuk distributor skala besar &gt;30 armada dengan integrasi khusus.</p>
                
                <div class="mt-6 p-4 rounded-xl bg-slate-50 border border-slate-200/70">
                    <div class="flex items-baseline">
                        <span class="text-3xl sm:text-4xl font-black text-slate-900 font-mono">Custom</span>
                        <span class="text-xs text-slate-500 ml-2">/ kesepakatan kontrak</span>
                    </div>
                    <div class="text-xs text-slate-500 mt-1 font-medium">Implementasi integrasi ERP khusus</div>
                </div>

                <ul class="mt-6 space-y-3 text-xs text-slate-600">
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check" class="w-4 h-4 text-brand-600 shrink-0"></i>
                        <span>Armada tak terbatas</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check" class="w-4 h-4 text-brand-600 shrink-0"></i>
                        <span>Integrasi API ke SAP / Oracle / Accurate</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check" class="w-4 h-4 text-brand-600 shrink-0"></i>
                        <span>Kesepakatan tingkat layanan khusus</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check" class="w-4 h-4 text-brand-600 shrink-0"></i>
                        <span>Pilihan infrastruktur sesuai kebutuhan</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check" class="w-4 h-4 text-brand-600 shrink-0"></i>
                        <span>Dedicated Account Manager 24/7</span>
                    </li>
                </ul>
            </div>

            <a href="https://wa.me/6281122334455?text=Halo%20TrackFleet%2C%20saya%20tertarik%20konsultasi%20paket%20Korporat" target="_blank" rel="noopener noreferrer" class="mt-8 flex items-center justify-center gap-2 py-3.5 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 hover:border-brand-400 font-bold text-xs text-slate-800 transition shadow-xs">
                <i data-lucide="message-square" class="w-4 h-4 text-brand-600"></i>
                <span>Hubungi tim penjualan</span>
            </a>
        </div>

    </div>

    <!-- Trust Guarantee Badges -->
    <div class="mt-14 p-6 sm:p-8 rounded-2xl bg-white border border-slate-200/90 shadow-sm grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-xs text-slate-600 reveal">
        <div class="flex items-start gap-3">
            <div class="w-9 h-9 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100 shrink-0">
                <i data-lucide="shield-check" class="w-4 h-4"></i>
            </div>
            <div>
                <div class="font-bold text-slate-900 text-sm">UU PDP Compliant</div>
                <div class="text-slate-500 text-[11px] mt-0.5">Keamanan data kargo terjamin UU No. 27/2022</div>
            </div>
        </div>

        <div class="flex items-start gap-3">
            <div class="w-9 h-9 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100 shrink-0">
                <i data-lucide="smartphone" class="w-4 h-4"></i>
            </div>
            <div>
                <div class="font-bold text-slate-900 text-sm">Nol Hardware</div>
                <div class="text-slate-500 text-[11px] mt-0.5">Cukup buka tautan web di ponsel pengemudi</div>
            </div>
        </div>

        <div class="flex items-start gap-3">
            <div class="w-9 h-9 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100 shrink-0">
                <i data-lucide="file-check-2" class="w-4 h-4"></i>
            </div>
            <div>
                <div class="font-bold text-slate-900 text-sm">Legalitas E-POD</div>
                <div class="text-slate-500 text-[11px] mt-0.5">Bukti serah terima sah amanat UU ITE No. 1/2024</div>
            </div>
        </div>

        <div class="flex items-start gap-3">
            <div class="w-9 h-9 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100 shrink-0">
                <i data-lucide="headphones" class="w-4 h-4"></i>
            </div>
            <div>
                <div class="font-bold text-slate-900 text-sm">Pendampingan Setup</div>
                <div class="text-slate-500 text-[11px] mt-0.5">Bantuan pendaftaran armada hingga siap jalan</div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
