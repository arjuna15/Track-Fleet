@extends('layouts.app')

@section('title', 'Pesanan & Margin Pengiriman — TrackFleet')
@section('page_title', 'Pesanan & Margin')
@section('meta_description', 'Pusat kendali pesanan kargo, dispatch surat jalan, validasi laba kotor, dan proteksi Margin Guard sebelum armada jalan.')

@section('content')
<div class="px-6 sm:px-8 lg:px-10 pb-12 space-y-6 max-w-[1600px] mx-auto w-full">
    
    <!-- Sub-header / Breadcrumb Context -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-1 text-xs text-slate-400 font-medium">
        <div class="flex items-center gap-2">
            <span class="font-bold text-[#1A1D1F]">Pusat Kendali Pesanan &amp; Surat Jalan</span>
            <span class="text-slate-300">•</span>
            <span class="text-slate-500">{{ $totalOrdersCount }} Order Aktif</span>
        </div>
        <div class="flex items-center gap-2">
            <button type="button" onclick="exportOrdersToCSV()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full border border-slate-200/90 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold shadow-sm transition">
                <i data-lucide="download" class="w-3.5 h-3.5 text-slate-400"></i>
                <span>Ekspor CSV</span>
            </button>
            <button id="openNewOrder" type="button" aria-haspopup="dialog" aria-controls="modalNewOrder" onclick="openTfModal('modalNewOrder', this)" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-bold text-white bg-[#1A1D1F] hover:bg-black shadow-sm transition">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                <span>+ Order Baru</span>
            </button>
        </div>
    </div>

    <!-- Main Bento Grid: 2 Large Columns (Left: 8 cols, Right: 4 cols) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left Column: Overview + Master Table (8 cols) -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- Bento Card 1: Overview (Identical to User Reference Image) -->
            <div class="bg-white rounded-[28px] p-6 sm:p-7 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-6">
                <!-- Header with Title & Dropdown Filter -->
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-black text-[#1A1D1F] tracking-tight">Overview</h2>
                    <div class="relative">
                        <button type="button" class="px-3.5 py-1.5 rounded-full border border-slate-200/90 text-xs font-semibold text-slate-600 bg-white hover:bg-slate-50 shadow-sm flex items-center gap-1.5 transition">
                            <span>Bulan ini</span>
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400"></i>
                        </button>
                    </div>
                </div>

                <!-- Two Stat Blocks Side-by-Side (Raised Card + Flat Card) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <!-- Stat 1: Total Nilai Kargo (Raised White Card like "Customers" in reference) -->
                    <div class="bg-white rounded-[22px] p-5 shadow-[0_8px_30px_rgba(0,0,0,0.06)] border border-slate-100 space-y-3">
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-500">
                            <i data-lucide="banknote" class="w-4 h-4 text-slate-400"></i>
                            <span>Total Nilai Kargo</span>
                        </div>
                        <div class="flex items-baseline gap-3">
                            <span class="text-3xl sm:text-4xl font-black text-[#1A1D1F] font-mono tracking-tight whitespace-nowrap">
                                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                            </span>
                            <div class="flex flex-col">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-600 font-mono">
                                    ↑ 36.8%
                                </span>
                                <span class="text-[10px] text-slate-400 mt-0.5 font-medium whitespace-nowrap">vs bln lalu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Stat 2: Laba Kotor Bersih (Flat Minimal Card like "Balance" in reference) -->
                    <div class="p-5 rounded-[22px] bg-slate-50/60 border border-slate-100/80 space-y-3">
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-500">
                            <i data-lucide="trending-up" class="w-4 h-4 text-slate-400"></i>
                            <span>Laba Kotor Terlindungi</span>
                        </div>
                        <div class="flex items-baseline gap-3">
                            <span class="text-3xl sm:text-4xl font-black text-[#1A1D1F] font-mono tracking-tight whitespace-nowrap">
                                Rp {{ number_format($totalGrossProfit ?? ($totalRevenue * 0.18), 0, ',', '.') }}
                            </span>
                            <div class="flex flex-col">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-600 font-mono">
                                    ↑ 18.2%
                                </span>
                                <span class="text-[10px] text-slate-400 mt-0.5 font-medium whitespace-nowrap">Margin Sehat</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Subtext / Callout (Matching Reference Image) -->
                <div class="pt-2">
                    <div class="text-xs font-bold text-[#1A1D1F]">
                        {{ $inTransitCount }} armada kargo sedang aktif di koridor Trans-Jawa!
                    </div>
                    <div class="text-[11px] text-slate-400 mt-0.5">
                        Pantau telemetri GPS rute real-time dan konfirmasi dokumen digital e-POD saat kargo tiba.
                    </div>
                </div>

                <!-- Driver & Field Team Row (5 Avatars + View All Button like Reference Image) -->
                <div class="flex items-center gap-3 sm:gap-4 overflow-x-auto pb-1 pt-1">
                    @php
                        $fieldStaff = [
                            ['name' => 'Supardi', 'role' => 'Tronton', 'color' => 'bg-amber-100 text-amber-800'],
                            ['name' => 'Bambang', 'role' => 'Wingbox', 'color' => 'bg-blue-100 text-blue-800'],
                            ['name' => 'Joko W.', 'role' => 'Fuso HD', 'color' => 'bg-emerald-100 text-emerald-800'],
                            ['name' => 'Rudi H.', 'role' => 'CDD Long', 'color' => 'bg-purple-100 text-purple-800'],
                            ['name' => 'Eko P.', 'role' => 'Engkel Box', 'color' => 'bg-rose-100 text-rose-800'],
                        ];
                    @endphp
                    @foreach($fieldStaff as $staff)
                    <div class="flex flex-col items-center gap-1.5 shrink-0">
                        <div class="w-12 h-12 rounded-full {{ $staff['color'] }} flex items-center justify-center font-bold text-sm shadow-sm ring-2 ring-white">
                            {{ substr($staff['name'], 0, 1) }}
                        </div>
                        <span class="text-[11px] font-semibold text-slate-700">{{ $staff['name'] }}</span>
                    </div>
                    @endforeach

                    <!-- View All Circular Button -->
                    <div class="flex flex-col items-center gap-1.5 shrink-0 pl-1">
                        <a href="{{ route('admin.vehicles.index') }}" class="w-12 h-12 rounded-full border border-slate-200/90 flex items-center justify-center text-slate-400 hover:text-black hover:border-black hover:bg-slate-50 transition shadow-sm" title="Lihat semua driver">
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                        <span class="text-[11px] font-semibold text-slate-400">Semua</span>
                    </div>
                </div>
            </div>

            <!-- Bento Card 2: Filter Toolbar & Master Orders Table -->
            <div class="bg-white rounded-[28px] p-6 sm:p-7 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-5">
                
                <!-- Card Header with Title & Action Controls -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-black text-[#1A1D1F] tracking-tight">Daftar Pesanan &amp; Status Dispatch</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Pantau seluruh siklus surat jalan dari order dibuat hingga e-POD ditandatangani</p>
                    </div>
                    
                    <!-- Search Input with Keyboard Shortcut -->
                    <div class="relative w-full sm:w-64">
                        <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                        <input type="text" id="orderSearchInput" placeholder="Cari pesanan, kota, plat..." onkeyup="filterOrdersTable()" class="w-full pl-10 pr-9 py-2 rounded-full bg-slate-50/70 border border-slate-200/80 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:bg-white transition shadow-sm">
                        <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-[10px] font-mono font-bold text-slate-400 border border-slate-200 px-1.5 py-0.5 rounded-md bg-white">/</span>
                    </div>
                </div>

                <!-- Segmented Filter Pills -->
                <div class="bg-slate-100/80 p-1 rounded-full inline-flex flex-wrap items-center gap-1 text-xs">
                    <a href="{{ route('admin.orders.index') }}" class="px-4 py-1.5 rounded-full font-bold transition flex items-center gap-2 {{ !request('status') && !request('alert') ? 'bg-white text-[#1A1D1F] shadow-sm' : 'text-slate-500 hover:text-[#1A1D1F]' }}">
                        <span>Semua</span>
                        <span class="font-mono text-[10px] px-2 py-0.5 rounded-full {{ !request('status') && !request('alert') ? 'bg-[#1A1D1F] text-white' : 'bg-slate-200 text-slate-600' }}">{{ $totalOrdersCount }}</span>
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'in_transit']) }}" class="px-4 py-1.5 rounded-full font-bold transition flex items-center gap-2 {{ request('status') === 'in_transit' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-500 hover:text-[#1A1D1F]' }}">
                        <span>Dalam Perjalanan</span>
                        <span class="font-mono text-[10px] px-2 py-0.5 rounded-full {{ request('status') === 'in_transit' ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-600' }}">{{ $inTransitCount }}</span>
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" class="px-4 py-1.5 rounded-full font-bold transition flex items-center gap-2 {{ request('status') === 'delivered' ? 'bg-white text-[#1A1D1F] shadow-sm' : 'text-slate-500 hover:text-[#1A1D1F]' }}">
                        <span>Sudah Tiba</span>
                        <span class="font-mono text-[10px] px-2 py-0.5 rounded-full {{ request('status') === 'delivered' ? 'bg-[#1A1D1F] text-white' : 'bg-slate-200 text-slate-600' }}">{{ $deliveredCount }}</span>
                    </a>
                    <a href="{{ route('admin.orders.index', ['alert' => '1']) }}" class="px-4 py-1.5 rounded-full font-bold transition flex items-center gap-2 {{ request('alert') ? 'bg-amber-500 text-white shadow-sm' : 'text-amber-800 hover:text-amber-950' }}">
                        <i data-lucide="alert-triangle" class="w-3.5 h-3.5"></i>
                        <span>Margin Rendah</span>
                        <span class="font-mono text-[10px] px-2 py-0.5 rounded-full {{ request('alert') ? 'bg-amber-700 text-white' : 'bg-amber-200 text-amber-900 font-bold' }}">{{ $lowMarginCount }}</span>
                    </a>
                </div>

                <!-- Table Content (Mobile & Desktop) -->
                <div class="border border-slate-100 rounded-2xl overflow-hidden">
                    
                    <!-- Mobile Card Layout (< md) -->
                    <div class="responsive-table-mobile block md:hidden p-4 space-y-3.5 bg-slate-50/30">
                        @forelse($orders as $o)
                        @php
                            $statusBadge = [
                                'inquiry' => 'bg-slate-100 text-slate-700 border-slate-200',
                                'dispatched' => 'bg-blue-50 text-blue-800 border-blue-200',
                                'in_transit' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
                                'delivered' => 'bg-teal-50 text-teal-800 border-teal-200',
                                'invoiced' => 'bg-slate-100 text-slate-700 border-slate-200',
                                'completed' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
                            ];
                            $statusLabels = [
                                'inquiry' => 'Menunggu', 'dispatched' => 'Disiapkan',
                                'in_transit' => 'Dalam Perjalanan', 'delivered' => 'Tiba di Tujuan',
                                'invoiced' => 'Ditagihkan', 'completed' => 'Selesai',
                            ];
                        @endphp
                        <div data-order-card class="p-4 rounded-2xl border border-slate-100 bg-white hover:border-slate-200 hover:shadow-sm transition space-y-3 {{ $o->is_low_margin_alert ? 'border-l-4 border-l-amber-500' : '' }}">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <a href="{{ route('admin.orders.show', $o) }}" class="font-bold font-mono text-brand-600 text-sm hover:underline flex items-center gap-1.5">
                                        <span>{{ $o->order_number }}</span>
                                    </a>
                                    <div class="text-[11px] text-slate-400 font-mono mt-0.5">Resi: {{ $o->public_tracking_code }}</div>
                                    <div class="text-xs font-bold text-slate-900 mt-1">{{ $o->shipper_name }}</div>
                                    <div class="text-[11px] text-slate-500">{{ $o->cargo_description }} ({{ $o->cargo_weight_ton }} Ton)</div>
                                </div>
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase border {{ $statusBadge[$o->status] ?? 'bg-slate-100 text-slate-600' }} shrink-0">
                                    {{ $statusLabels[$o->status] ?? ucfirst(str_replace('_', ' ', $o->status)) }}
                                </span>
                            </div>

                            <div class="text-xs text-slate-600 bg-slate-50/70 rounded-xl p-2.5 flex items-center justify-between border border-slate-100">
                                <div>
                                    <div class="text-[10px] uppercase text-slate-400 font-bold">Rute Pengiriman</div>
                                    <div class="font-medium text-slate-800">{{ $o->origin_city }} → {{ $o->destination_city }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-[10px] uppercase text-slate-400 font-bold">Armada</div>
                                    <div class="font-mono font-bold text-slate-800">{{ $o->vehicle ? $o->vehicle->plate_number : 'Belum Ditugaskan' }}</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-2 text-[11px] pt-1 border-t border-slate-100">
                                <div>
                                    <div class="text-[10px] text-slate-400">Harga Jual</div>
                                    <div class="font-bold text-slate-800 font-mono text-xs whitespace-nowrap">Rp {{ number_format($o->selling_price, 0, ',', '.') }}</div>
                                </div>
                                <div>
                                    <div class="text-[10px] text-slate-400">Laba Kotor</div>
                                    <div class="font-bold font-mono text-xs whitespace-nowrap {{ $o->gross_profit >= 0 ? 'text-emerald-700' : 'text-rose-600' }}">Rp {{ number_format($o->gross_profit, 0, ',', '.') }}</div>
                                </div>
                                <div>
                                    <div class="text-[10px] text-slate-400">Margin (%)</div>
                                    <div class="font-bold font-mono text-xs whitespace-nowrap {{ $o->is_low_margin_alert ? 'text-amber-700' : 'text-emerald-700' }}">
                                        {{ $o->margin_percentage }}%
                                        @if($o->is_low_margin_alert) ⚠️ @endif
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-1">
                                <span class="text-[11px] text-slate-500">Sopir: {{ $o->driver_name }}</span>
                                <a href="{{ route('admin.orders.show', $o) }}" class="px-3.5 py-1.5 rounded-full bg-[#1A1D1F] text-white text-xs font-bold hover:bg-black transition">
                                    Detail Pesanan →
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="py-12 text-center text-slate-400 text-xs">Tidak ada pesanan yang cocok dengan kriteria filter saat ini.</div>
                        @endforelse
                    </div>

                    <!-- Desktop High-Density Table Layout (>= md) -->
                    <div class="responsive-table-desktop hidden md:block overflow-x-auto">
                        <table class="w-full text-left text-xs text-slate-600">
                            <thead class="bg-slate-50/70 text-slate-400 uppercase font-mono text-[10px] tracking-wider border-b border-slate-100">
                                <tr>
                                    <th class="py-4 px-5 font-bold">Kode Pesanan</th>
                                    <th class="py-4 px-5 font-bold">Shipper &amp; Muatan</th>
                                    <th class="py-4 px-5 font-bold">Rute Trans-Jawa</th>
                                    <th class="py-4 px-5 font-bold">Unit Truk &amp; Vendor</th>
                                    <th class="py-4 px-5 text-right font-bold whitespace-nowrap">Tarif Klien (DPP)</th>
                                    <th class="py-4 px-5 text-right font-bold whitespace-nowrap">Modal Vendor</th>
                                    <th class="py-4 px-5 text-right font-bold whitespace-nowrap">Laba Kotor</th>
                                    <th class="py-4 px-5 text-center font-bold whitespace-nowrap">Margin (%)</th>
                                    <th class="py-4 px-5 text-center font-bold">Status</th>
                                    <th class="py-4 px-5 text-center font-bold">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @forelse($orders as $o)
                                <tr class="hover:bg-slate-50/70 transition-colors duration-150 {{ $o->is_low_margin_alert ? 'border-l-4 border-l-amber-500 bg-amber-50/20' : '' }}">
                                    <!-- Order Number & Tracking -->
                                    <td class="py-4 px-5">
                                        <a href="{{ route('admin.orders.show', $o) }}" class="font-bold text-[#1A1D1F] font-mono text-xs hover:text-brand-600 transition flex items-center gap-1.5 group">
                                            <span>{{ $o->order_number }}</span>
                                            <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 text-slate-400 group-hover:text-brand-600 opacity-0 group-hover:opacity-100 transition"></i>
                                        </a>
                                        <div class="flex items-center gap-1.5 mt-1">
                                            <span class="font-mono text-[10px] text-slate-500 bg-slate-100 px-2 py-0.5 rounded-md font-bold">
                                                {{ $o->public_tracking_code }}
                                            </span>
                                        </div>
                                    </td>

                                    <!-- Shipper & Cargo Description -->
                                    <td class="py-4 px-5">
                                        <div class="font-bold text-[#1A1D1F] text-[13px]">{{ $o->shipper_name }}</div>
                                        <div class="text-[11px] text-slate-400 mt-0.5 line-clamp-1" title="{{ $o->cargo_description }}">
                                            {{ $o->cargo_description }} · <span class="font-semibold text-slate-600">{{ $o->cargo_weight_ton }} Ton</span>
                                        </div>
                                    </td>

                                    <!-- Route Asal -> Tujuan -->
                                    <td class="py-4 px-5">
                                        <div class="flex items-center gap-1.5 text-slate-800 font-semibold whitespace-nowrap text-xs">
                                            <span>{{ $o->origin_city }}</span>
                                            <span class="text-slate-300">➔</span>
                                            <span class="font-bold text-slate-900">{{ $o->destination_city }}</span>
                                        </div>
                                        <div class="text-[10px] font-mono text-slate-400 mt-0.5">Koridor Trans-Jawa</div>
                                    </td>

                                    <!-- Vehicle & Vendor -->
                                    <td class="py-4 px-5">
                                        @if($o->vehicle)
                                            <div class="inline-block font-mono font-bold text-white bg-[#1A1D1F] px-2.5 py-0.5 rounded text-[11px] tracking-wider shadow-sm">
                                                {{ $o->vehicle->plate_number }}
                                            </div>
                                            <div class="text-[11px] text-slate-400 mt-1">
                                                {{ $o->vendorPartner->name ?? 'Armada Internal' }}
                                            </div>
                                        @else
                                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-mono text-slate-400 italic bg-slate-100">
                                                Belum ditugaskan
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Tarif Klien (DPP) -->
                                    <td class="py-4 px-5 text-right font-mono font-bold text-slate-900 whitespace-nowrap text-xs">
                                        Rp {{ number_format($o->selling_price, 0, ',', '.') }}
                                    </td>

                                    <!-- Modal Vendor (Cost) -->
                                    <td class="py-4 px-5 text-right font-mono text-slate-500 whitespace-nowrap text-xs">
                                        Rp {{ number_format($o->vendor_cost + $o->operational_cost, 0, ',', '.') }}
                                    </td>

                                    <!-- Laba Kotor -->
                                    <td class="py-4 px-5 text-right font-mono font-black whitespace-nowrap text-xs {{ $o->gross_profit >= 0 ? 'text-emerald-700' : 'text-rose-600' }}">
                                        Rp {{ number_format($o->gross_profit, 0, ',', '.') }}
                                    </td>

                                    <!-- Margin Percentage -->
                                    <td class="py-4 px-5 text-center whitespace-nowrap">
                                        @if($o->is_low_margin_alert)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black bg-amber-100 text-amber-900 shadow-sm animate-pulse" title="Peringatan Margin Guard: Margin di bawah 10%!">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                                <span>{{ $o->margin_percentage }}%</span>
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700">
                                                {{ $o->margin_percentage }}%
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="py-4 px-5 text-center whitespace-nowrap">
                                        @php
                                            $statusTones = [
                                                'inquiry' => 'bg-slate-100 text-slate-700 border-slate-200',
                                                'dispatched' => 'bg-blue-50 text-blue-800 border-blue-200',
                                                'in_transit' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
                                                'delivered' => 'bg-teal-50 text-teal-800 border-teal-200',
                                                'invoiced' => 'bg-purple-50 text-purple-800 border-purple-200',
                                                'completed' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
                                            ];
                                            $statusNames = [
                                                'inquiry' => 'Menunggu',
                                                'dispatched' => 'Disiapkan',
                                                'in_transit' => 'Dalam Perjalanan',
                                                'delivered' => 'Tiba di Tujuan',
                                                'invoiced' => 'Ditagihkan',
                                                'completed' => 'Selesai',
                                            ];
                                        @endphp
                                        <span class="inline-block px-3 py-1 rounded-full text-[11px] font-bold uppercase border {{ $statusTones[$o->status] ?? 'bg-slate-100 text-slate-700 border-slate-200' }}">
                                            {{ $statusNames[$o->status] ?? ucfirst(str_replace('_', ' ', $o->status)) }}
                                        </span>
                                    </td>

                                    <!-- Detail Actions -->
                                    <td class="py-4 px-5 text-center whitespace-nowrap">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <a href="{{ route('admin.orders.show', $o) }}" class="px-3.5 py-1.5 rounded-full border border-slate-200 text-slate-700 hover:text-black hover:border-black font-bold text-xs transition">
                                                Detail
                                            </a>
                                            <a href="{{ route('tracking.public', ['code' => $o->public_tracking_code]) }}" target="_blank" rel="noopener noreferrer" class="p-1.5 rounded-full bg-slate-100 text-slate-500 hover:text-black hover:bg-slate-200 transition" title="Lacak Live">
                                                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="py-12 text-center text-slate-400 text-xs">
                                        Tidak ada pesanan pengiriman yang cocok.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                @if($orders->hasPages())
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                    {{ $orders->links() }}
                </div>
                @endif

            </div>

        </div>

        <!-- Right Rail Column (4 cols, Matching Right Column in Reference Image) -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Bento Card 3: Pesanan Kargo Prioritas (Matching "Popular products" in reference) -->
            <div class="bg-white rounded-[28px] p-6 sm:p-7 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-5">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-black text-[#1A1D1F] tracking-tight">Pesanan Prioritas</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Muatan bernilai tinggi aktif</p>
                    </div>
                    <span class="text-[10px] font-mono font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">
                        Top Kargo
                    </span>
                </div>

                <!-- Products List -->
                <div class="space-y-4">
                    @forelse($orders->take(5) as $idx => $pOrder)
                    <div class="flex items-center justify-between gap-3 group">
                        <div class="flex items-center gap-3 min-w-0">
                            <!-- Rounded Visual Icon with Subtle Gradient -->
                            <div class="w-12 h-12 rounded-2xl shrink-0 flex items-center justify-center shadow-sm 
                                @if($idx % 4 === 0) bg-gradient-to-br from-amber-100 to-amber-200 text-amber-800
                                @elseif($idx % 4 === 1) bg-gradient-to-br from-blue-100 to-indigo-200 text-blue-800
                                @elseif($idx % 4 === 2) bg-gradient-to-br from-emerald-100 to-teal-200 text-emerald-800
                                @else bg-gradient-to-br from-purple-100 to-pink-200 text-purple-800 @endif">
                                <i data-lucide="truck" class="w-5 h-5"></i>
                            </div>
                            <div class="min-w-0">
                                <a href="{{ route('admin.orders.show', $pOrder) }}" class="text-xs font-bold text-[#1A1D1F] truncate group-hover:text-brand-600 transition block">
                                    {{ $pOrder->shipper_name }}
                                </a>
                                <div class="text-[11px] text-slate-400 truncate mt-0.5">
                                    {{ $pOrder->origin_city }} → {{ $pOrder->destination_city }}
                                </div>
                            </div>
                        </div>

                        <!-- Price & Status Badge -->
                        <div class="text-right shrink-0">
                            <div class="text-xs font-black text-[#1A1D1F] font-mono">
                                Rp {{ number_format($pOrder->selling_price, 0, ',', '.') }}
                            </div>
                            <span class="inline-block mt-0.5 px-2 py-0.5 rounded-full text-[9px] font-bold uppercase
                                @if($pOrder->status === 'in_transit') bg-emerald-50 text-emerald-600 border border-emerald-100
                                @elseif($pOrder->status === 'delivered') bg-teal-50 text-teal-600 border border-teal-100
                                @else bg-slate-100 text-slate-500 @endif">
                                {{ $pOrder->status === 'in_transit' ? 'Active' : ($pOrder->status === 'delivered' ? 'Delivered' : 'Pending') }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="py-4 text-center text-slate-400 text-xs">Belum ada pesanan aktif.</div>
                    @endforelse
                </div>

                <!-- Pill Outline Button (Matching Reference Image "All products") -->
                <div class="pt-2">
                    <button type="button" onclick="window.scrollTo({top: 400, behavior: 'smooth'})" class="w-full py-2.5 rounded-full border border-slate-200/90 text-xs font-bold text-slate-700 hover:text-black hover:border-black hover:bg-slate-50 transition shadow-sm text-center">
                        Semua Pesanan ({{ $totalOrdersCount }})
                    </button>
                </div>
            </div>

            <!-- Bento Card 4: Log Dispatch & Proteksi Margin (Matching "Comments" in reference) -->
            <div class="bg-white rounded-[28px] p-6 sm:p-7 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-5">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-black text-[#1A1D1F] tracking-tight">Aktivitas &amp; Telemetri</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Laporan pengemudi &amp; alert laba</p>
                    </div>
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                </div>

                <!-- Activity Feed Items (Matching "Comments" layout in reference) -->
                <div class="space-y-4">
                    <!-- Item 1: Live Transit Checkpoint -->
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 rounded-full bg-slate-100 text-[#1A1D1F] font-bold text-xs flex items-center justify-center shrink-0 shadow-sm">
                            BS
                        </div>
                        <div class="space-y-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-[#1A1D1F]">Bambang Sutrisno</span>
                                <span class="text-[10px] text-slate-400 font-mono">10m lalu</span>
                            </div>
                            <p class="text-[11px] text-slate-500 leading-relaxed">
                                Melintas Tol Cipali KM 102 Subang. Kecepatan 62 km/jam, suhu muatan terkendali aman.
                            </p>
                        </div>
                    </div>

                    <!-- Item 2: Delivered & EPOD Arrival -->
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 rounded-full bg-slate-100 text-[#1A1D1F] font-bold text-xs flex items-center justify-center shrink-0 shadow-sm">
                            SP
                        </div>
                        <div class="space-y-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-[#1A1D1F]">Supardi</span>
                                <span class="text-[10px] text-slate-400 font-mono">25m lalu</span>
                            </div>
                            <p class="text-[11px] text-slate-500 leading-relaxed">
                                Tiba di Gudang Tujuan Surabaya. Menunggu verifikasi fisik &amp; e-POD tanda tangan digital.
                            </p>
                        </div>
                    </div>

                    <!-- Item 3: Margin Guard Alert Box -->
                    <div class="p-3.5 rounded-2xl bg-amber-50/70 border border-amber-200/80 space-y-1.5">
                        <div class="flex items-center gap-2 text-amber-800 text-xs font-bold">
                            <i data-lucide="shield-alert" class="w-4 h-4 text-amber-600"></i>
                            <span>Proteksi Margin Guard</span>
                        </div>
                        <p class="text-[11px] text-amber-900 leading-relaxed">
                            {{ $lowMarginCount }} pesanan terdeteksi memiliki margin di bawah 10%. Negosiasikan kembali modal vendor untuk mengamankan profitabilitas.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Modal Form Buat Pesanan Baru (Bento Style) -->
<div id="modalNewOrder" role="dialog" aria-modal="true" aria-labelledby="modalNewOrderTitle" class="fixed inset-0 z-[150] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm hidden">
    <div class="w-full max-w-2xl bg-white rounded-[28px] p-6 sm:p-8 shadow-2xl border border-slate-100 space-y-6 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
        
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div>
                <h3 id="modalNewOrderTitle" class="text-xl font-black text-[#1A1D1F]">Buat Pesanan Kargo Baru</h3>
                <p class="text-xs text-slate-400 mt-0.5">Lengkapi data shipper, rute, tarif, dan alokasi armada</p>
            </div>
            <button type="button" onclick="closeTfModal('modalNewOrder')" class="p-2 rounded-full text-slate-400 hover:text-black hover:bg-slate-100 transition">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="{{ route('admin.orders.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf

            @if(isset($errors) && $errors->any())
                <div id="orderValidationSummary" role="alert" tabindex="-1" class="rounded-2xl border border-rose-200 bg-rose-50 p-4 text-xs text-rose-900">
                    <p class="font-bold">Periksa kembali data pesanan:</p>
                    <ul class="mt-1.5 list-inside list-disc space-y-1">
                        @foreach($errors->all() as $msg)
                            <li>{{ $msg }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="orderShipperName" class="block font-bold text-slate-700 mb-1">Nama Shipper (Klien) *</label>
                    <input type="text" id="orderShipperName" name="shipper_name" required value="{{ old('shipper_name') }}" placeholder="PT Sumber Berkah Makmur" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-slate-900 focus:outline-none">
                </div>
                <div>
                    <label for="orderCargoDescription" class="block font-bold text-slate-700 mb-1">Deskripsi Muatan *</label>
                    <input type="text" id="orderCargoDescription" name="cargo_description" required value="{{ old('cargo_description') }}" placeholder="Biskuit &amp; Makanan Ringan" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-slate-900 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="orderOriginCity" class="block font-bold text-slate-700 mb-1">Kota Asal (Pickup) *</label>
                    <input type="text" id="orderOriginCity" name="origin_city" required value="{{ old('origin_city') }}" placeholder="Bekasi, Jawa Barat" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-slate-900 focus:outline-none">
                </div>
                <div>
                    <label for="orderDestinationCity" class="block font-bold text-slate-700 mb-1">Kota Tujuan (Delivery) *</label>
                    <input type="text" id="orderDestinationCity" name="destination_city" required value="{{ old('destination_city') }}" placeholder="Surabaya, Jawa Timur" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-slate-900 focus:outline-none">
                </div>
                <div>
                    <label for="orderCargoWeight" class="block font-bold text-slate-700 mb-1">Tonase Muatan (Ton) *</label>
                    <input type="number" step="0.1" id="orderCargoWeight" name="cargo_weight_ton" required value="{{ old('cargo_weight_ton') }}" placeholder="12.5" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-slate-900 focus:outline-none font-mono">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2 border-t border-slate-100">
                <div>
                    <label for="orderSellingPrice" class="block font-bold text-slate-700 mb-1">Harga Jual Shipper (Rp) *</label>
                    <input type="number" id="orderSellingPrice" name="selling_price" required value="{{ old('selling_price') }}" placeholder="14500000" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-slate-900 focus:outline-none font-mono">
                </div>
                <div>
                    <label for="orderVendorCost" class="block font-bold text-slate-700 mb-1">Biaya Vendor Rekanan (Rp) *</label>
                    <input type="number" id="orderVendorCost" name="vendor_cost" required value="{{ old('vendor_cost') }}" placeholder="11500000" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-slate-900 focus:outline-none font-mono">
                </div>
                <div>
                    <label for="orderOperationalCost" class="block font-bold text-slate-700 mb-1">Biaya Ops/Tol (Rp) *</label>
                    <input type="number" id="orderOperationalCost" name="operational_cost" required value="{{ old('operational_cost', 0) }}" placeholder="350000" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-slate-900 focus:outline-none font-mono">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div>
                    <label for="orderVehicleId" class="block font-bold text-slate-700 mb-1">Pilih Armada Truk</label>
                    <select id="orderVehicleId" name="vehicle_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-slate-900 focus:outline-none">
                        <option value="">-- Tugaskan Nanti (Status: Inquiry) --</option>
                        @foreach(\App\Models\Vehicle::all() as $v)
                            <option value="{{ $v->id }}">{{ $v->plate_number }} ({{ $v->vehicle_type }} - Sopir: {{ $v->driver_name }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="orderDriverPhone" class="block font-bold text-slate-700 mb-1">Nomor WhatsApp Sopir</label>
                    <input type="text" id="orderDriverPhone" name="driver_phone" value="{{ old('driver_phone') }}" placeholder="081234567890" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-slate-900 focus:outline-none font-mono">
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <button type="button" onclick="closeTfModal('modalNewOrder')" class="px-5 py-2.5 rounded-full border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold transition">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2.5 rounded-full bg-[#1A1D1F] hover:bg-black text-white font-bold shadow-sm transition">
                    Simpan &amp; Terbitkan Pesanan
                </button>
            </div>
        </form>

    </div>
</div>

@push('scripts')
<script>
    function filterOrdersTable() {
        const query = (document.getElementById('orderSearchInput')?.value || '').toLowerCase();
        
        // Filter desktop table rows
        const rows = document.querySelectorAll('.responsive-table-desktop tbody tr');
        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });

        // Filter mobile cards
        const cards = document.querySelectorAll('.responsive-table-mobile [data-order-card]');
        cards.forEach(card => {
            const text = card.innerText.toLowerCase();
            card.style.display = text.includes(query) ? '' : 'none';
        });
    }

    function exportOrdersToCSV() {
        window.location.href = "{{ route('admin.orders.index') }}?export=csv";
    }

    document.addEventListener('DOMContentLoaded', () => {
        @if(isset($errors) && $errors->any())
            openTfModal('modalNewOrder', document.getElementById('openNewOrder'));
            document.getElementById('orderValidationSummary')?.focus();
        @endif
    });
</script>
@endpush
@endsection