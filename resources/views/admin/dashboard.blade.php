@extends('layouts.app')

@section('title', 'Dashboard Operasional & Dispatch — TrackFleet')
@section('page_title', 'Dashboard')
@section('meta_description', 'Pusat komando operasional logistik, pemantauan live GPS armada Trans-Jawa, penugasan sopir, dan status transit kargo.')

@section('content')
<div class="px-6 sm:px-8 lg:px-10 pb-12 space-y-6 max-w-[1600px] mx-auto w-full">
    
    <!-- Role Sub-header / Breadcrumb Context -->
    <div class="flex items-center justify-between text-xs text-slate-400 font-medium pb-1">
        <div class="flex items-center gap-2">
            <span class="font-bold text-[#1A1D1F]">Dashboard Operasional &amp; Dispatch</span>
            <span class="text-slate-300">•</span>
            <span>PT Logistik Digital Nusantara</span>
        </div>
        <div class="flex items-center gap-2 font-mono">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="text-slate-600 font-bold text-[11px]">Sistem Online</span>
        </div>
    </div>

    <!-- Main Bento Grid: 2 Large Columns (Left: 8 cols, Right: 4 cols) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left / Center Column (Bento Overview & Telemetry Radar, 8 cols) -->
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
                    
                    <!-- Stat 1: Armada Dalam Perjalanan (Raised White Card like "Customers" in reference) -->
                    <div class="bg-white rounded-[22px] p-5 shadow-[0_8px_30px_rgba(0,0,0,0.06)] border border-slate-100 space-y-3">
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-500">
                            <i data-lucide="truck" class="w-4 h-4 text-slate-400"></i>
                            <span>Armada Dalam Perjalanan</span>
                        </div>
                        <div class="flex items-baseline gap-3">
                            <span class="text-4xl sm:text-5xl font-black text-[#1A1D1F] font-mono tracking-tight">{{ $inTransitCount }}</span>
                            <div class="flex flex-col">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-600 font-mono">
                                    ↑ 36.8%
                                </span>
                                <span class="text-[10px] text-slate-400 mt-0.5 font-medium">vs bln lalu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Stat 2: Truk Siaga di Pool (Flat Minimal Card like "Balance" in reference) -->
                    <div class="p-5 rounded-[22px] bg-slate-50/60 border border-slate-100/80 space-y-3">
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-500">
                            <i data-lucide="warehouse" class="w-4 h-4 text-slate-400"></i>
                            <span>Truk Siaga di Pool</span>
                        </div>
                        <div class="flex items-baseline gap-3">
                            <span class="text-4xl sm:text-5xl font-black text-[#1A1D1F] font-mono tracking-tight">{{ $idleVehiclesCount }}</span>
                            <div class="flex flex-col">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-50 text-blue-600 font-mono">
                                    Siap Jalan
                                </span>
                                <span class="text-[10px] text-slate-400 mt-0.5 font-medium">dari {{ $activeVehicles->count() }} unit</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Driver Avatars Row with Subtitle & Arrow Button (Like Reference Image) -->
                <div class="pt-4 border-t border-slate-100 space-y-3">
                    <div>
                        <h4 class="text-xs font-bold text-[#1A1D1F]">
                            {{ $inTransitCount }} pengemudi aktif bertugas hari ini!
                        </h4>
                        <p class="text-[11px] text-slate-400 mt-0.5">
                            Kirim pesan instruksi dispatch atau tinjau surat jalan pengemudi Trans-Jawa.
                        </p>
                    </div>

                    <!-- Horizontal Driver Avatars -->
                    <div class="flex items-center gap-4 sm:gap-6 pt-1 overflow-x-auto pb-1">
                        @php
                            $driverList = [
                                ['name' => 'Suhendra', 'role' => 'Fuso CDD', 'bg' => 'from-amber-400 to-orange-500', 'initials' => 'SW'],
                                ['name' => 'Rian H.', 'role' => 'Tronton', 'bg' => 'from-blue-500 to-indigo-600', 'initials' => 'RH'],
                                ['name' => 'Joko P.', 'role' => 'Trailer 40ft', 'bg' => 'from-emerald-500 to-teal-600', 'initials' => 'JP'],
                                ['name' => 'Dedi I.', 'role' => 'CDD Box', 'bg' => 'from-purple-500 to-pink-600', 'initials' => 'DI'],
                                ['name' => 'Arjuna', 'role' => 'Dispatcher', 'bg' => 'from-slate-700 to-slate-900', 'initials' => 'AP'],
                            ];
                        @endphp
                        @foreach($driverList as $drv)
                        <div class="flex flex-col items-center gap-1.5 shrink-0 group">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-tr {{ $drv['bg'] }} text-white font-black text-xs flex items-center justify-center shadow-md ring-4 ring-white group-hover:scale-105 transition-transform duration-200">
                                {{ $drv['initials'] }}
                            </div>
                            <span class="text-[11px] font-bold text-slate-700 group-hover:text-black transition">{{ $drv['name'] }}</span>
                        </div>
                        @endforeach

                        <!-- View All Circle Button (Right Arrow like reference) -->
                        <a href="{{ route('admin.vehicles.index') }}" class="flex flex-col items-center gap-1.5 shrink-0 group" title="Lihat semua armada & sopir">
                            <div class="w-12 h-12 rounded-full border border-slate-200 bg-white flex items-center justify-center text-slate-500 group-hover:border-black group-hover:text-black group-hover:bg-slate-50 shadow-sm transition-all duration-200">
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </div>
                            <span class="text-[11px] font-semibold text-slate-400 group-hover:text-black transition">Semua</span>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Bento Card 2: Radar Telemetri GPS Live / Product View (Like Reference Image) -->
            <div class="bg-white rounded-[28px] p-6 sm:p-7 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-5">
                <!-- Header with Title & Filter Dropdown -->
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-black text-[#1A1D1F] tracking-tight">Radar Telemetri GPS Live</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Pemantauan koordinat posisi truk kargo real-time di koridor Trans-Jawa</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" class="px-3.5 py-1.5 rounded-full border border-slate-200/90 text-xs font-semibold text-slate-600 bg-white hover:bg-slate-50 shadow-sm flex items-center gap-1.5 transition">
                            <span>Jalur Trans-Jawa</span>
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400"></i>
                        </button>
                    </div>
                </div>

                <!-- Giant Cargo Volume Highlight (Like $10.2m in Reference Image) -->
                <div class="flex items-baseline gap-3">
                    <span class="text-3xl sm:text-4xl font-black text-slate-300 font-mono tracking-tight">
                        Rp {{ number_format($orders->sum('selling_price') / 1000000, 1) }}m
                    </span>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                        Nilai Muatan Dipantau
                    </span>
                </div>

                <!-- Interactive Leaflet Map Container with Bento Rounded Corners -->
                <div class="relative rounded-[22px] overflow-hidden border border-slate-100 shadow-inner">
                    <div id="liveFleetMap" class="w-full h-[360px] z-10">
                        <noscript>
                            <div class="map-fallback h-full bg-slate-50 flex flex-col items-center justify-center p-6 text-center">
                                <i data-lucide="map-off" class="w-8 h-8 text-slate-400 mb-2"></i>
                                <p class="text-slate-500 text-xs font-medium">Aktifkan JavaScript untuk melihat peta armada</p>
                            </div>
                        </noscript>
                    </div>
                    
                    <!-- Map Badge Overlay -->
                    <div class="absolute top-3 left-3 z-20 pointer-events-none">
                        <div class="bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-full border border-slate-200/80 shadow-sm text-xs font-bold text-slate-800 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>GPS Live: {{ $inTransitCount }} Truk Aktif</span>
                        </div>
                    </div>
                </div>

                <!-- Route Progress Summary -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2 text-center text-xs">
                    <div class="p-3 rounded-2xl bg-slate-50/70 border border-slate-100">
                        <div class="text-[10px] text-slate-400 font-bold uppercase">Tiba &amp; E-POD</div>
                        <div class="text-base font-black text-[#1A1D1F] font-mono mt-0.5">{{ $deliveredCount }}</div>
                    </div>
                    <div class="p-3 rounded-2xl bg-slate-50/70 border border-slate-100">
                        <div class="text-[10px] text-slate-400 font-bold uppercase">Antrean Dispatch</div>
                        <div class="text-base font-black text-amber-700 font-mono mt-0.5">{{ $inquiryCount + $dispatchedCount }}</div>
                    </div>
                    <div class="p-3 rounded-2xl bg-slate-50/70 border border-slate-100">
                        <div class="text-[10px] text-slate-400 font-bold uppercase">Mitra Vendor</div>
                        <div class="text-base font-black text-[#1A1D1F] font-mono mt-0.5">{{ $vendors->count() }}</div>
                    </div>
                    <div class="p-3 rounded-2xl bg-slate-50/70 border border-slate-100">
                        <div class="text-[10px] text-slate-400 font-bold uppercase">SLA Tepat Waktu</div>
                        <div class="text-base font-black text-emerald-600 font-mono mt-0.5">99.2%</div>
                    </div>
                </div>

            </div>

            <!-- Bento Card 3: Antrean Penugasan & Status Dispatch (Table Container) -->
            <div class="bg-white rounded-[28px] p-6 sm:p-7 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <h3 class="text-base font-bold text-[#1A1D1F]">Status Pengiriman &amp; Surat Jalan Terkini</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Pantau status armada dan verifikasi e-POD manifes kargo</p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-slate-700 hover:text-black transition flex items-center gap-1">
                        <span>Kelola Pesanan</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>

                <!-- Mobile Responsive Cards -->
                <div class="responsive-table-mobile block md:hidden space-y-3">
                    @forelse($recentDispatches as $o)
                    <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/70 space-y-2">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-mono font-bold text-brand-600">{{ $o->order_number }}</span>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $o->status === 'in_transit' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-700' }}">
                                {{ $o->statusLabel() }}
                            </span>
                        </div>
                        <div class="text-xs font-bold text-slate-900">{{ $o->shipper_name }}</div>
                        <div class="text-[11px] text-slate-500">{{ $o->origin_city }} → {{ $o->destination_city }}</div>
                        <div class="flex items-center justify-between pt-1 text-xs">
                            <span class="font-mono font-bold text-slate-800">Rp {{ number_format($o->selling_price, 0, ',', '.') }}</span>
                            <a href="{{ route('admin.orders.show', $o) }}" class="text-xs font-bold text-brand-600 hover:underline">Detail →</a>
                        </div>
                    </div>
                    @empty
                    <div class="py-6 text-center text-xs text-slate-400">Belum ada pesanan aktif.</div>
                    @endforelse
                </div>

                <!-- Desktop Table -->
                <div class="responsive-table-desktop hidden md:block overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-600">
                        <thead class="text-slate-400 uppercase font-mono text-[10px] tracking-wider border-b border-slate-100">
                            <tr>
                                <th class="pb-3 px-3 font-bold">No. Pesanan</th>
                                <th class="pb-3 px-3 font-bold">Shipper</th>
                                <th class="pb-3 px-3 font-bold">Rute</th>
                                <th class="pb-3 px-3 font-bold">Armada</th>
                                <th class="pb-3 px-3 text-right font-bold whitespace-nowrap">Nilai Muatan</th>
                                <th class="pb-3 px-3 text-center font-bold">Status</th>
                                <th class="pb-3 px-3 text-center font-bold">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($recentDispatches as $o)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3 px-3 font-mono font-bold text-[#1A1D1F]">
                                    <a href="{{ route('admin.orders.show', $o) }}" class="hover:text-brand-600">
                                        {{ $o->order_number }}
                                    </a>
                                </td>
                                <td class="py-3 px-3 font-bold text-slate-900">{{ $o->shipper_name }}</td>
                                <td class="py-3 px-3 text-slate-600 whitespace-nowrap">{{ $o->origin_city }} → {{ $o->destination_city }}</td>
                                <td class="py-3 px-3 font-mono font-bold text-slate-800">
                                    {{ $o->vehicle ? $o->vehicle->plate_number : 'Belum Assign' }}
                                </td>
                                <td class="py-3 px-3 text-right font-mono font-bold text-slate-900 whitespace-nowrap">
                                    Rp {{ number_format($o->selling_price, 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-3 text-center whitespace-nowrap">
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $o->status === 'in_transit' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-700 border border-slate-200' }}">
                                        {{ $o->statusLabel() }}
                                    </span>
                                </td>
                                <td class="py-3 px-3 text-center">
                                    <a href="{{ route('admin.orders.show', $o) }}" class="px-2.5 py-1 rounded-full border border-slate-200 text-slate-700 hover:bg-slate-100 text-[11px] font-bold transition">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-6 text-center text-xs text-slate-400">Belum ada pesanan aktif.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Right Rail / Column (Bento Cards: Popular Products & Comments, 4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Bento Card 4: Pesanan Kargo Prioritas (Like "Popular Products" in Reference Image) -->
            <div class="bg-white rounded-[28px] p-6 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-5">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-black text-[#1A1D1F] tracking-tight">Pesanan Kargo Prioritas</h3>
                    <span class="text-[10px] font-mono font-bold bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full">Live</span>
                </div>

                <!-- Product List Items (Exactly like reference image items) -->
                <div class="space-y-4">
                    @forelse($orders->take(5) as $idx => $ord)
                    @php
                        $avatarGradients = [
                            'from-amber-400 to-orange-500',
                            'from-blue-500 to-indigo-600',
                            'from-emerald-400 to-teal-500',
                            'from-purple-500 to-pink-500',
                            'from-rose-400 to-red-500',
                        ];
                        $grad = $avatarGradients[$idx % count($avatarGradients)];
                    @endphp
                    <div class="flex items-center justify-between gap-3 group">
                        <!-- Thumbnail Icon Box -->
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr {{ $grad }} flex items-center justify-center text-white shrink-0 shadow-sm">
                            <i data-lucide="truck" class="w-5 h-5"></i>
                        </div>

                        <!-- Title & Description -->
                        <div class="min-w-0 flex-1">
                            <a href="{{ route('admin.orders.show', $ord) }}" class="text-xs font-bold text-[#1A1D1F] truncate block hover:text-brand-600 transition">
                                {{ $ord->shipper_name }}
                            </a>
                            <div class="text-[11px] text-slate-400 truncate mt-0.5">
                                {{ $ord->vehicle ? $ord->vehicle->plate_number : 'Belum Ditugaskan' }} • {{ $ord->cargo_weight_ton }}T
                            </div>
                        </div>

                        <!-- Price & Status Badge -->
                        <div class="text-right shrink-0">
                            <div class="font-mono font-bold text-xs text-[#1A1D1F] whitespace-nowrap">
                                Rp {{ number_format($ord->selling_price / 1000000, 1) }}M
                            </div>
                            <span class="inline-block mt-0.5 px-2 py-0.5 rounded-full text-[9px] font-bold uppercase {{ $ord->status === 'in_transit' ? 'bg-emerald-50 text-emerald-600' : ($ord->status === 'delivered' ? 'bg-blue-50 text-blue-600' : 'bg-slate-100 text-slate-600') }}">
                                {{ $ord->status === 'in_transit' ? 'Active' : ($ord->status === 'delivered' ? 'Delivered' : 'Pending') }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="py-4 text-center text-xs text-slate-400">Tidak ada pesanan kargo.</div>
                    @endforelse
                </div>

                <!-- All Products Outline Button (Like Reference Image) -->
                <div class="pt-2">
                    <a href="{{ route('admin.orders.index') }}" class="w-full py-2.5 rounded-full border border-slate-200/90 text-xs font-bold text-slate-700 hover:text-black hover:bg-slate-50 transition text-center block shadow-sm">
                        Lihat Semua Pesanan
                    </a>
                </div>
            </div>

            <!-- Bento Card 5: Log Telemetri GPS & Checkpoint (Like "Comments" in Reference Image) -->
            <div class="bg-white rounded-[28px] p-6 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-5">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-black text-[#1A1D1F] tracking-tight">Log Telemetri &amp; Dispatch</h3>
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                </div>

                <!-- Recent Activity Items (Like Comments) -->
                <div class="space-y-4 text-xs">
                    
                    <!-- Comment Item 1 -->
                    <div class="space-y-1.5 pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-slate-900 text-white font-bold text-[10px] flex items-center justify-center shrink-0">
                                SW
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="font-bold text-[#1A1D1F]">Suhendra Wijaya</span>
                                <span class="text-[10px] text-slate-400 font-mono ml-1.5">09:00 WIB</span>
                            </div>
                        </div>
                        <p class="text-slate-600 text-[11px] leading-relaxed pl-9">
                            Truk B 9142 TQU melintasi Gerbang Tol Cikampek KM 57, kecepatan stabil 75 km/jam menuju Surabaya.
                        </p>
                    </div>

                    <!-- Comment Item 2 -->
                    <div class="space-y-1.5 pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-brand-600 text-white font-bold text-[10px] flex items-center justify-center shrink-0">
                                RH
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="font-bold text-[#1A1D1F]">Rian Hidayat</span>
                                <span class="text-[10px] text-slate-400 font-mono ml-1.5">08:30 WIB</span>
                            </div>
                        </div>
                        <p class="text-slate-600 text-[11px] leading-relaxed pl-9">
                            Surat jalan kargo Unilever telah diverifikasi E-POD. Foto dan tanda tangan digital sah hukum telah diunggah.
                        </p>
                    </div>

                    <!-- Comment Item 3 -->
                    <div class="space-y-1.5">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-emerald-600 text-white font-bold text-[10px] flex items-center justify-center shrink-0">
                                JP
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="font-bold text-[#1A1D1F]">Joko Purwanto</span>
                                <span class="text-[10px] text-slate-400 font-mono ml-1.5">07:45 WIB</span>
                            </div>
                        </div>
                        <p class="text-slate-600 text-[11px] leading-relaxed pl-9">
                            Armada Trailer L 9455 UA tiba di pelabuhan penyeberangan Bakauheni, kargo Indofood aman.
                        </p>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const vehicles = @json($activeVehicles);
        const orders = @json($orders);

        const map = L.map('liveFleetMap').setView([-6.9, 109.5], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; OpenStreetMap | TrackFleet GPS Telemetry'
        }).addTo(map);

        function pin(color, glyph, pulse) {
            return L.divIcon({
                className: 'custom-fleet-pin' + (pulse ? ' live-marker' : ''),
                html: '<div style="background-color:' + color + ';width:28px;height:28px;border-radius:50%;border:2px solid #fff;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 8px rgba(0,0,0,.3);color:#fff;font-weight:700;font-size:11px;font-family:JetBrains Mono,monospace">' + glyph + '</div>',
                iconSize: [28, 28],
                iconAnchor: [14, 14]
            });
        }

        const pts = [];
        orders.forEach(function (o) {
            if (o.status === 'in_transit' && o.vehicle) {
                const pt = [-6.9175 + (Math.random() - 0.5) * 1.5, 107.6191 + (Math.random() - 0.5) * 3];
                pts.push(pt);
                L.marker(pt, { icon: pin('#10b981', '🚛', true) })
                    .addTo(map)
                    .bindPopup('<div style="font-size:12px;font-family:Plus Jakarta Sans,sans-serif"><strong>' + o.order_number + '</strong><br>' + o.vehicle.plate_number + ' (' + o.driver_name + ')<br><span style="color:#10b981;font-weight:bold">' + o.origin_city + ' → ' + o.destination_city + '</span><br><span style="color:#64748b">Status: Dalam Perjalanan (Live GPS)</span></div>');
            }
        });

        if (pts.length > 0) {
            map.fitBounds(L.latLngBounds(pts), { padding: [50, 50] });
        }
    });
</script>
@endpush
@endsection
