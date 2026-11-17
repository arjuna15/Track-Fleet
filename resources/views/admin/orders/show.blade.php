@extends('layouts.app')

@section('title', 'Pesanan ' . $order->order_number . ' — TrackFleet')
@section('page_title', 'Detail Pesanan')
@section('meta_description', 'Rincian keuangan, rute, riwayat lokasi, dan bukti serah terima untuk pesanan ' . $order->order_number . '.')

@section('content')
<div class="px-6 sm:px-8 lg:px-10 pb-12 space-y-6 max-w-[1600px] mx-auto w-full">
    
    <!-- Top Breadcrumb & Status -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-1 text-xs text-slate-400 font-medium">
        <div>
            <div class="flex items-center gap-2 text-xs">
                <a href="{{ route('admin.dashboard') }}" class="text-brand-600 hover:underline">Dashboard</a>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.orders.index') }}" class="text-brand-600 hover:underline">Pesanan</a>
                <span class="text-slate-300">/</span>
                <span class="text-slate-500 font-mono">{{ $order->order_number }}</span>
            </div>
            <div class="flex flex-wrap items-center gap-2 sm:gap-3 mt-1.5">
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 font-mono">{{ $order->order_number }}</h1>
                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-800 border border-blue-200">
                    {{ $order->statusLabel() }}
                </span>
                @if($order->is_low_margin_alert)
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-300 flex items-center gap-1">
                        <i data-lucide="alert-triangle" class="w-3.5 h-3.5"></i> Margin rendah
                    </span>
                @endif
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('tracking.public', ['code' => $order->public_tracking_code]) }}" target="_blank" rel="noopener noreferrer" class="px-4 py-2 rounded-full text-xs font-bold bg-white hover:bg-slate-50 text-slate-700 border border-slate-200/90 shadow-sm flex items-center gap-1.5 transition">
                <i data-lucide="external-link" class="w-3.5 h-3.5 text-slate-400"></i>
                <span>Lacak Pelanggan</span>
            </a>
            @if($order->invoice_generated)
                <a href="{{ route('admin.orders.invoice.show', $order) }}" class="px-5 py-2 rounded-full text-xs font-bold bg-[#1A1D1F] hover:bg-black text-white shadow-sm transition flex items-center gap-1.5">
                    <i data-lucide="receipt" class="w-3.5 h-3.5"></i>
                    <span>Lihat Invoice</span>
                </a>
            @elseif($order->status === 'delivered')
                <form action="{{ route('admin.orders.invoice', $order) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-5 py-2 rounded-full text-xs font-bold bg-[#1A1D1F] hover:bg-black text-white shadow-sm transition flex items-center gap-1.5">
                        <i data-lucide="receipt" class="w-3.5 h-3.5"></i>
                        <span>Terbitkan Tagihan</span>
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- 2 Column Layout: Details & GPS Map -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Left Column: Financials & Route Details -->
        <div class="lg:col-span-7 space-y-6">
            
            <!-- Financial Profit Breakdown Card -->
            <div class="bg-white rounded-[28px] border border-slate-100 p-6 sm:p-7 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-4">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                    <i data-lucide="pie-chart" class="w-4 h-4 text-slate-400"></i>
                    <span>Struktur Keuangan &amp; Margin Perjalanan</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pb-4 border-b border-slate-100">
                    <div>
                        <div class="text-[11px] text-slate-400 font-semibold">Tarif Shipper</div>
                        <div class="text-lg font-black text-[#1A1D1F] font-mono mt-0.5">
                            Rp {{ number_format($order->selling_price, 0, ',', '.') }}
                        </div>
                    </div>
                    <div>
                        <div class="text-[11px] text-slate-400 font-semibold">Beban Modal</div>
                        <div class="text-lg font-bold text-slate-600 font-mono mt-0.5">
                            Rp {{ number_format($order->vendor_cost + $order->operational_cost, 0, ',', '.') }}
                        </div>
                    </div>
                    <div>
                        <div class="text-[11px] text-slate-400 font-semibold">Laba Kotor</div>
                        <div class="text-lg font-black {{ $order->gross_profit >= 0 ? 'text-emerald-700' : 'text-rose-600' }} font-mono mt-0.5">
                            Rp {{ number_format($order->gross_profit, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <span class="text-slate-500 font-medium">Margin Laba:</span>
                    <span class="font-mono font-black text-sm {{ $order->is_low_margin_alert ? 'text-amber-800 bg-amber-50 px-2.5 py-0.5 rounded-full border border-amber-200' : 'text-emerald-700' }}">
                        {{ $order->margin_percentage }}%
                    </span>
                </div>
            </div>

            <!-- Route & Shipper Info -->
            <div class="bg-white rounded-[28px] border border-slate-100 p-6 sm:p-7 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-4">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                    <i data-lucide="map-pin" class="w-4 h-4 text-slate-400"></i>
                    <span>Pengirim, Muatan, dan Rute</span>
                </h3>

                <div class="grid grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-slate-500">Pengirim:</span>
                        <div class="font-bold text-slate-900 mt-0.5">{{ $order->shipper_name }}</div>
                        <div class="text-slate-500">{{ $order->shipper_contact }}</div>
                    </div>
                    <div>
                        <span class="text-slate-400">Deskripsi Barang:</span>
                        <div class="font-bold text-slate-900 mt-0.5">{{ $order->cargo_description }}</div>
                        <div class="text-slate-500">{{ $order->cargo_weight_ton }} Ton</div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 grid grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-slate-500">Lokasi asal:</span>
                        <div class="font-bold text-slate-900 mt-0.5">{{ $order->origin_city }}</div>
                        <div class="text-slate-500">{{ $order->origin_address }}</div>
                    </div>
                    <div>
                        <span class="text-slate-500">Lokasi tujuan:</span>
                        <div class="font-bold text-slate-900 mt-0.5">{{ $order->destination_city }}</div>
                        <div class="text-slate-500">{{ $order->destination_address }}</div>
                    </div>
                </div>
            </div>

            <!-- Electronic Proof of Delivery (E-POD) Status -->
            <div class="bg-white rounded-[28px] border border-slate-100 p-6 sm:p-7 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-3">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                    <i data-lucide="file-check" class="w-4 h-4 text-emerald-600"></i>
                    <span>Status Bukti Terima Digital (E-POD)</span>
                </h3>

                @if($order->pod_uploaded_at)
                    @php $hasRealPod = $order->pod_image_path && str_starts_with($order->pod_image_path, 'uploads/'); @endphp
                    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0">
                            <i data-lucide="check-circle-2" class="w-6 h-6"></i>
                        </div>
                        <div class="text-xs flex-1">
                            <div class="font-bold text-emerald-900 text-sm">Bukti serah terima tersimpan</div>
                            <div class="text-emerald-700 mt-0.5">Penerima: <strong>{{ $order->pod_signer_name ?? 'Petugas Gudang' }}</strong></div>
                            <div class="text-emerald-700 text-[11px] font-mono mt-0.5">Diterima {{ $order->pod_uploaded_at->format('d M Y, H:i') }} WIB</div>
                        </div>
                        @if($hasRealPod)
                            <a href="{{ asset($order->pod_image_path) }}" target="_blank" rel="noopener noreferrer" class="shrink-0">
                                <img src="{{ asset($order->pod_image_path) }}" alt="Bukti serah terima {{ $order->order_number }}" class="w-16 h-16 rounded-xl object-cover border-2 border-emerald-300 hover:opacity-90 transition">
                            </a>
                        @endif
                    </div>
                @else
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 text-xs text-slate-500 flex items-center gap-3">
                        <i data-lucide="clock" class="w-5 h-5 text-slate-400"></i>
                        <span>Bukti penerimaan akan muncul setelah pengemudi menyelesaikan serah terima.</span>
                    </div>
                @endif
            </div>

        </div>

        <!-- Right Column: Location History & Map -->
        <div class="lg:col-span-5 space-y-6">
            
            <!-- Map Container -->
            <div class="bg-white rounded-[28px] border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] overflow-hidden">
                <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                    <span class="text-xs font-bold text-[#1A1D1F]">Riwayat Lokasi GPS</span>
                    <span class="text-[11px] font-mono text-slate-400 font-bold">{{ $order->locationPings->count() }} pembaruan</span>
                </div>
                <div id="orderRouteMap" class="w-full h-[320px]">
                    <noscript>
                        <div class="map-fallback h-full bg-slate-50 flex items-center justify-center p-6 text-center">
                            <i data-lucide="map-off" class="w-8 h-8 text-slate-400"></i>
                            <p class="text-slate-600 text-xs font-medium">Aktifkan JavaScript untuk melihat rute perjalanan GPS.</p>
                        </div>
                    </noscript>
                </div>
            </div>

            <!-- Ping Timeline -->
            <div class="bg-white rounded-[28px] border border-slate-100 p-6 sm:p-7 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-4">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pembaruan Perjalanan</h4>

                <div class="relative pl-6 space-y-6 border-l-2 border-slate-100 ml-2">
                    @forelse($order->locationPings as $ping)
                    <div class="relative">
                        <span class="absolute -left-[31px] top-0 w-3.5 h-3.5 rounded-full bg-[#1A1D1F] border-2 border-white ring-2 ring-slate-100"></span>
                        <div class="text-xs font-bold text-[#1A1D1F]">{{ $ping->location_name }}</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">{{ $ping->notes }}</div>
                        <div class="text-[10px] text-slate-400 font-mono mt-1">{{ $ping->recorded_at->format('H:i, d M Y') }} WIB (Kecepatan: {{ $ping->speed_kmh }} km/h)</div>
                    </div>
                    @empty
                    <div class="text-sm text-slate-400">Belum ada pembaruan lokasi untuk pesanan ini.</div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pings = @json($order->locationPings);
        
        // Center on last ping or default
        const lastPing = pings.length > 0 ? [pings[0].latitude, pings[0].longitude] : [-6.2, 106.8];
        const map = L.map('orderRouteMap').setView(lastPing, 9);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; OpenStreetMap | TrackFleet GPS'
        }).addTo(map);

        if (pings.length > 0) {
            const latlngs = [];
            pings.forEach((p, idx) => {
                const pt = [p.latitude, p.longitude];
                latlngs.push(pt);

                L.marker(pt).addTo(map).bindPopup(`
                    <div style="font-size: 11px;">
                        <strong>${p.location_name}</strong><br>
                        ${p.notes || ''}<br>
                        <span style="color: #64748b;">${p.speed_kmh} km/jam</span>
                    </div>
                `);
            });

            // Draw polyline connecting points
            if (latlngs.length > 1) {
                L.polyline(latlngs, { color: '#2563eb', weight: 4, dashArray: '6, 8' }).addTo(map);
                map.fitBounds(L.latLngBounds(latlngs), { padding: [30, 30] });
            }
        }
    });
</script>
@endpush
@endsection
