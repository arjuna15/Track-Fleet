@extends('layouts.app')

@section('title', 'Lacak Kiriman Armada Real-Time — TrackFleet')
@section('meta_description', 'Lacak status dan lokasi terakhir kiriman Anda secara mandiri dengan kode pelacakan atau nomor pesanan resmi TrackFleet.')

@section('content')
<!-- Search Console Header (Seamless Deep Slate-950) -->
<section class="relative pt-28 pb-14 lg:pt-36 lg:pb-20 bg-slate-950 text-white border-b border-slate-800/80 overflow-hidden">
    <!-- Ambient Tech Glow -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[300px] bg-brand-600/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <span class="text-xs font-mono font-bold uppercase tracking-wider text-brand-300 bg-brand-500/15 px-3.5 py-1 rounded-full border border-brand-500/30">
            Portal Pelacakan Publik
        </span>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight animate-fade-up">
            Lacak Posisi Kiriman Kargo Anda
        </h1>
        <p class="text-slate-400 text-sm sm:text-base max-w-xl mx-auto leading-relaxed">
            Pantau posisi live GPS truk langsung dari ponsel sopir, jam estimasi tiba (ETA), dan konfirmasi serah terima digital E-POD secara transparan.
        </p>

        <!-- Search Form -->
        <form action="{{ route('tracking.public') }}" method="GET" class="mt-8 flex flex-col sm:flex-row gap-2.5 max-w-2xl mx-auto">
            <div class="relative flex-1">
                <i data-lucide="search" class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                <label for="trackingCode" class="sr-only">Kode pelacakan atau nomor pesanan</label>
                <input id="trackingCode" type="text" name="code" value="{{ $code ?? '' }}" required placeholder="Masukkan nomor resi: TRK-JKTSBY89..." class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-slate-900 border border-slate-700/90 text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 font-mono transition shadow-inner">
            </div>
            <button type="submit" class="px-7 py-3.5 rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-bold text-sm shadow-xl shadow-brand-600/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 shrink-0">
                <span>Lacak Sekarang</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </form>

        <div class="flex items-center justify-center gap-2 text-xs text-slate-400 pt-2">
            <span>Contoh resi aktif:</span>
            <a href="{{ route('tracking.public', ['code' => 'TRK-JKTSBY89']) }}" class="text-brand-400 hover:text-brand-300 font-mono bg-slate-900/80 px-2.5 py-1 rounded border border-slate-800 transition">TRK-JKTSBY89</a>
            <a href="{{ route('tracking.public', ['code' => 'TRK-JKTTNG12']) }}" class="text-brand-400 hover:text-brand-300 font-mono bg-slate-900/80 px-2.5 py-1 rounded border border-slate-800 transition">TRK-JKTTNG12</a>
        </div>
    </div>
</section>

<!-- Content Area (Clean White Canvas) -->
<section class="py-12 bg-white min-h-[500px]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($order)
            @php
                $stepMap = [
                    1 => ['inquiry', 'dispatched'],
                    2 => ['in_transit'],
                    3 => ['delivered'],
                    4 => ['invoiced', 'completed'],
                ];
                $currentStep = 1;
                foreach ($stepMap as $n => $statuses) {
                    if (in_array($order->status, $statuses, true)) { $currentStep = $n; }
                }
                $stepLabels = [1 => 'Siap jalan', 2 => 'Dalam perjalanan', 3 => 'Tiba & serah terima', 4 => 'Selesai'];
            @endphp

            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-lg p-5 sm:p-8 space-y-6 reveal is-visible">

                <!-- Tracking Header Card -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-brand-600 animate-pulse"></span>
                            <span class="text-xs font-mono font-bold uppercase text-slate-500">Kode Pelacakan Resmi</span>
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 font-mono mt-1 tracking-tight">{{ $order->public_tracking_code }}</h2>
                        <div class="text-xs text-slate-500 mt-1">
                            Surat Jalan: <strong class="text-slate-800 font-mono">{{ $order->order_number }}</strong> • Shipper: <strong class="text-slate-800">{{ $order->shipper_name }}</strong>
                        </div>
                    </div>

                    <div class="text-left sm:text-right">
                        <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold uppercase border {{ $order->statusTone() }} shadow-2xs">
                            {{ $order->statusLabel() }}
                        </span>
                        <div class="text-xs font-semibold text-slate-700 mt-1.5 flex items-center sm:justify-end gap-1.5">
                            <span>{{ $order->origin_city }}</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-brand-600"></i>
                            <span>{{ $order->destination_city }}</span>
                        </div>
                    </div>
                </div>

                <!-- Visual Progress Stepper -->
                <div class="py-2">
                    <div class="relative">
                        <div class="absolute top-4 left-6 right-6 h-1 bg-slate-100 hidden sm:block rounded-full" aria-hidden="true"></div>
                        <div class="absolute top-4 left-6 h-1 bg-brand-600 hidden sm:block rounded-full transition-all duration-700" style="width: calc({{ ($currentStep - 1) / 3 * 100 }}% - {{ ($currentStep - 1) / 3 * 32 }}px)" aria-hidden="true"></div>
                        <ol class="relative grid grid-cols-4 gap-2 text-center text-xs">
                            @foreach($stepLabels as $n => $label)
                                @php $done = $n < $currentStep; $current = $n === $currentStep; @endphp
                                <li class="space-y-2">
                                    <div @class([
                                        'w-8 h-8 sm:w-9 sm:h-9 mx-auto rounded-xl flex items-center justify-center font-bold text-xs transition-all duration-300 font-mono shadow-xs',
                                        'bg-brand-600 text-white shadow-brand-500/20' => $done || $current,
                                        'bg-slate-100 text-slate-400 border border-slate-200' => !$done && !$current,
                                        'ring-4 ring-brand-100 animate-pulse' => $current,
                                    ])>
                                        @if($done)
                                            <i data-lucide="check" class="w-4 h-4 text-white"></i>
                                        @else
                                            {{ $n }}
                                        @endif
                                    </div>
                                    <span @class(['font-bold text-[11px] sm:text-xs leading-tight block', 'text-slate-900' => $done || $current, 'text-slate-400' => !$done && !$current])>{{ $label }}</span>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>

                <!-- Route Map -->
                <div class="rounded-2xl overflow-hidden border border-slate-200/90 shadow-sm">
                    <div class="p-3 bg-slate-50 border-b border-slate-200 flex items-center justify-between text-xs text-slate-600">
                        <div class="flex items-center gap-2 font-bold text-slate-800">
                            <i data-lucide="map" class="w-4 h-4 text-brand-600"></i>
                            <span>Peta Telemetri Jalur Perjalanan</span>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-brand-700 bg-brand-50 px-2 py-0.5 rounded border border-brand-200">LIVE GPS ARMADA</span>
                    </div>
                    <div id="shipperMap" class="w-full h-[360px]">
                        <noscript>
                            <div class="map-fallback h-full bg-slate-50 flex items-center justify-center p-6 text-center">
                                <i data-lucide="map-off" class="w-8 h-8 text-slate-400"></i>
                                <p class="text-slate-600 text-xs font-medium">Aktifkan JavaScript untuk melihat visualisasi rute.</p>
                            </div>
                        </noscript>
                    </div>
                </div>

                <!-- Current Status Box -->
                @php $latestPing = $order->locationPings->first(); @endphp
                <div class="p-4 sm:p-5 rounded-xl bg-slate-50 border border-slate-200/90 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center border border-brand-100 shrink-0 mt-0.5">
                        <i data-lucide="navigation" class="w-5 h-5"></i>
                    </div>
                    <div class="text-xs space-y-1">
                        <div class="font-bold text-slate-900 text-sm">Titik Lokasi Terakhir Armada</div>
                        <div class="text-slate-700 font-medium text-xs sm:text-sm">
                            {{ $latestPing ? $latestPing->location_name : 'Menunggu pembaruan titik koordinat GPS dari sopir' }}
                        </div>
                        @if($latestPing)
                            <div class="text-slate-500 text-[11px] font-mono pt-1 flex flex-wrap items-center gap-x-4 gap-y-1">
                                <span>Pembaruan: <strong>{{ $latestPing->recorded_at->format('d M Y, H:i') }} WIB</strong></span>
                                <span>Kecepatan: <strong>{{ $latestPing->speed_kmh }} km/jam</strong></span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- E-POD Verification if Delivered -->
                @if($order->pod_uploaded_at)
                <div class="p-4 sm:p-5 rounded-xl bg-brand-50/70 border border-brand-200 text-xs space-y-2">
                    <div class="flex items-center gap-2 font-bold text-brand-900 text-sm">
                        <i data-lucide="shield-check" class="w-5 h-5 text-brand-600"></i>
                        <span>Muatan Resmi Diterima di Gudang Tujuan (Sah E-POD)</span>
                    </div>
                    <div class="text-slate-700 leading-relaxed">
                        Ditandatangani secara digital oleh <strong class="text-slate-900">{{ $order->pod_signer_name ?? 'Penerima Resmi' }}</strong> pada {{ $order->pod_uploaded_at->format('d M Y, H:i') }} WIB dengan koordinat terverifikasi UU ITE No. 1/2024.
                    </div>
                </div>
                @endif

            </div>
        @elseif($code)
            <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center space-y-4 shadow-sm animate-scale-in max-w-lg mx-auto">
                <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-500 border border-rose-200 mx-auto flex items-center justify-center">
                    <i data-lucide="alert-circle" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900">Kiriman Tidak Ditemukan</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Kode pelacakan <strong class="font-mono text-slate-900 bg-slate-100 px-2 py-0.5 rounded">{{ $code }}</strong> belum terdaftar dalam sistem. Periksa kembali kode pada dokumen surat jalan atau konfirmasi ke pengirim kargo.
                </p>
                <div class="pt-2">
                    <a href="{{ route('tracking.public') }}" class="inline-flex items-center gap-2 text-xs font-bold text-brand-600 hover:text-brand-700">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        <span>Coba Cari Kode Lain</span>
                    </a>
                </div>
            </div>
        @else
            <!-- Default Welcome State (Enterprise Console Preview) -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-8 sm:p-12 text-center space-y-6 shadow-sm reveal">
                <div class="w-16 h-16 rounded-2xl bg-brand-50 text-brand-600 border border-brand-100 mx-auto flex items-center justify-center shadow-xs">
                    <i data-lucide="package-search" class="w-8 h-8" aria-hidden="true"></i>
                </div>
                
                <div class="max-w-md mx-auto space-y-2">
                    <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Masukkan Kode Pelacakan</h2>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Status perjalanan, peta telemetri rute GPS, dan bukti serah terima digital akan seketika tampil di sini secara mandiri tanpa perlu login.
                    </p>
                </div>

                <!-- 3 Quick Value Badges -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-slate-100 max-w-2xl mx-auto text-left text-xs">
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1">
                        <div class="font-bold text-slate-900 flex items-center gap-1.5">
                            <i data-lucide="navigation-2" class="w-3.5 h-3.5 text-brand-600"></i>
                            <span>Live GPS Otomatis</span>
                        </div>
                        <p class="text-[11px] text-slate-500">Koordinat akurat dari browser smartphone sopir.</p>
                    </div>

                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1">
                        <div class="font-bold text-slate-900 flex items-center gap-1.5">
                            <i data-lucide="file-check-2" class="w-3.5 h-3.5 text-brand-600"></i>
                            <span>Sah UU ITE E-POD</span>
                        </div>
                        <p class="text-[11px] text-slate-500">Foto barang &amp; tanda tangan penerima tervalidasi.</p>
                    </div>

                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1">
                        <div class="font-bold text-slate-900 flex items-center gap-1.5">
                            <i data-lucide="shield" class="w-3.5 h-3.5 text-brand-600"></i>
                            <span>Privasi Terjaga</span>
                        </div>
                        <p class="text-[11px] text-slate-500">Rincian margin &amp; biaya transporter tetap rahasia.</p>
                    </div>
                </div>

                <!-- Quick Click Sample Codes -->
                <div class="pt-2 flex flex-wrap justify-center items-center gap-2 text-xs">
                    <span class="text-slate-400">Klik untuk mencoba:</span>
                    <a href="{{ route('tracking.public', ['code' => 'TRK-JKTSBY89']) }}" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-brand-50 hover:text-brand-700 hover:border-brand-200 border border-slate-200 font-mono font-bold text-slate-700 transition">
                        TRK-JKTSBY89 (Rute Surabaya)
                    </a>
                    <a href="{{ route('tracking.public', ['code' => 'TRK-JKTTNG12']) }}" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-brand-50 hover:text-brand-700 hover:border-brand-200 border border-slate-200 font-mono font-bold text-slate-700 transition">
                        TRK-JKTTNG12 (Rute Tangerang)
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

@if($order)
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pings = @json($order->locationPings);
        const map = L.map('shipperMap').setView(pings.length > 0 ? [pings[0].latitude, pings[0].longitude] : [-6.2, 106.8], 8);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; OpenStreetMap | TrackFleet Portal'
        }).addTo(map);

        function pin(color, glyph, pulse) {
            return L.divIcon({
                className: 'custom-fleet-pin' + (pulse ? ' live-marker' : ''),
                html: '<div style="background-color:' + color + ';width:26px;height:26px;border-radius:50%;border:2px solid #fff;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 8px rgba(0,0,0,.3);color:#fff;font-weight:700;font-size:11px;font-family:JetBrains Mono,monospace">' + glyph + '</div>',
                iconSize: [26, 26],
                iconAnchor: [13, 13]
            });
        }

        if (pings.length > 0) {
            const pts = [];
            const ordered = [...pings].reverse();
            ordered.forEach((p, idx) => {
                const pt = [p.latitude, p.longitude];
                pts.push(pt);
                const isLast = idx === ordered.length - 1;
                L.marker(pt, { icon: pin(isLast ? '#2563eb' : '#64748b', isLast ? '●' : (idx + 1), isLast) })
                    .addTo(map)
                    .bindPopup('<div style="font-size:12px"><strong>' + p.location_name + '</strong><br>' + (p.notes || '') + '<br><span style="color:#64748b">' + p.speed_kmh + ' km/jam</span></div>');
            });
            if (pts.length > 1) {
                L.polyline(pts, { color: '#2563eb', weight: 4 }).addTo(map);
                map.fitBounds(L.latLngBounds(pts), { padding: [40, 40] });
            }
        }
    });
</script>
@endpush
@endif
@endsection
