@extends('layouts.app')

@section('title', 'Dashboard Keuangan & Pengendali Margin — TrackFleet')
@section('page_title', 'Keuangan & Margin')
@section('meta_description', 'Pusat komando keuangan logistik, pemantauan laba kotor, peringatan Margin Guard <10%, dan siklus penagihan invoice shipper.')

@section('content')
<div class="px-6 sm:px-8 lg:px-10 pb-12 space-y-6 max-w-[1600px] mx-auto w-full">
    
    <!-- Context Header & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-1 text-xs text-slate-400 font-medium">
        <div class="flex items-center gap-2">
            <span class="font-bold text-[#1A1D1F]">Dashboard Keuangan &amp; Pengendali Margin</span>
            <span class="text-slate-300">•</span>
            <span>PT Logistik Digital Nusantara</span>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.operational') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full border border-slate-200/90 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold shadow-sm transition">
                <i data-lucide="truck" class="w-3.5 h-3.5 text-blue-600"></i>
                <span>Tinjau Operasional</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full border border-slate-200/90 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold shadow-sm transition">
                <i data-lucide="package" class="w-3.5 h-3.5 text-emerald-600"></i>
                <span>Daftar Pesanan</span>
            </a>
            <button type="button" onclick="exportFinanceCSV()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-bold text-white bg-[#1A1D1F] hover:bg-black shadow-sm transition">
                <i data-lucide="download" class="w-3.5 h-3.5"></i>
                <span>Ekspor Laporan</span>
            </button>
        </div>
    </div>

    <!-- 4 Bento Financial KPI Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        
        <!-- Total Revenue -->
        <div class="bg-white rounded-[24px] p-5 sm:p-6 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-3">
            <div class="flex items-center justify-between text-xs font-bold text-slate-500">
                <span>Total Nilai Tagihan (Omzet)</span>
                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-700">
                    <i data-lucide="banknote" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-[#1A1D1F] font-mono tracking-tight whitespace-nowrap">
                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </div>
            <div class="text-xs text-slate-400 flex items-center gap-1">
                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-blue-500"></i>
                <span>Dari total {{ $orders->count() }} pesanan kargo</span>
            </div>
        </div>

        <!-- Total Cost -->
        <div class="bg-white rounded-[24px] p-5 sm:p-6 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-3">
            <div class="flex items-center justify-between text-xs font-bold text-slate-500">
                <span>Beban Biaya Modal</span>
                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-700">
                    <i data-lucide="receipt" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-[#1A1D1F] font-mono tracking-tight whitespace-nowrap">
                Rp {{ number_format($totalVendorCost + $totalOperationalCost, 0, ',', '.') }}
            </div>
            <div class="text-xs text-slate-400 flex items-center justify-between">
                <span>Vendor: Rp {{ number_format($totalVendorCost / 1000000, 1) }}Jt</span>
                <span>Ops/Tol: Rp {{ number_format($totalOperationalCost / 1000000, 1) }}Jt</span>
            </div>
        </div>

        <!-- Gross Profit & Overall Margin -->
        <div class="bg-white rounded-[24px] p-5 sm:p-6 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-3">
            <div class="flex items-center justify-between text-xs font-bold text-slate-500">
                <span>Laba Kotor Bersih</span>
                <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <i data-lucide="trending-up" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-emerald-700 font-mono tracking-tight whitespace-nowrap">
                Rp {{ number_format($totalGrossProfit, 0, ',', '.') }}
            </div>
            <div class="text-xs text-emerald-700 font-bold flex items-center gap-1.5 font-mono">
                <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-600"></i>
                <span>Rata-rata Margin: {{ number_format($overallMarginPct, 2) }}%</span>
            </div>
        </div>

        <!-- Invoicing & Billing Status -->
        <div class="bg-white rounded-[24px] p-5 sm:p-6 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-3">
            <div class="flex items-center justify-between text-xs font-bold text-slate-500">
                <span>Penagihan &amp; Piutang</span>
                <div class="w-8 h-8 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center">
                    <i data-lucide="file-check-2" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-[#1A1D1F] font-mono tracking-tight">
                {{ $invoicedCount }} Faktur
            </div>
            <div class="text-xs text-slate-400 flex items-center justify-between">
                <span class="text-emerald-700 font-bold">Rp {{ number_format($invoicedAmount / 1000000, 1) }}Jt terbit</span>
                @if($pendingInvoiceCount > 0)
                    <span class="text-amber-800 font-bold bg-amber-50 px-1.5 py-0.5 rounded border border-amber-200">{{ $pendingInvoiceCount }} siap tagih</span>
                @else
                    <span class="text-slate-400">Semua tertagih</span>
                @endif
            </div>
        </div>

    </div>

    <!-- Margin Guard Warning Banner (If Any Low Margin Exists) -->
    @if($lowMarginCount > 0)
    <div class="p-4 sm:p-5 rounded-2xl bg-amber-50/80 border border-amber-300 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-start gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center shrink-0 border border-amber-200">
                <i data-lucide="alert-triangle" class="w-5 h-5"></i>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h3 class="text-sm font-bold text-amber-900">Perhatian Margin Guard: Ada {{ $lowMarginCount }} Pesanan Berisiko Boncos (<10%)</h3>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase bg-amber-200 text-amber-900">Perlu Review Finance</span>
                </div>
                <p class="text-xs text-amber-800 mt-1 leading-relaxed">
                    Pesanan ini memiliki selisih tarif ke shipper dan biaya operasional yang tipis. Harap lakukan renegosiasi tarif muatan atau evaluasi rute sebelum invoice diterbitkan.
                </p>
            </div>
        </div>
        <a href="{{ route('admin.orders.index', ['alert' => '1']) }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-amber-600 hover:bg-amber-500 text-white shadow-sm transition shrink-0 flex items-center justify-center gap-1.5">
            <span>Filter Pesanan Rentan</span>
            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
        </a>
    </div>
    @endif

    <!-- 2 Financial Intelligence Columns -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Col Left (7 cols): Margin by Order Bar Chart -->
        <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <i data-lucide="bar-chart-3" class="w-5 h-5 text-emerald-600"></i>
                        <span>Analisis Margin Keuntungan per Pesanan</span>
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">Garis vertikal batas aman Margin Guard di posisi 10%</p>
                </div>
                <span class="text-xs font-mono font-bold text-slate-600 bg-slate-100 px-2.5 py-1 rounded-md">
                    Rata-rata: Rp {{ number_format($avgTicket, 0, ',', '.') }} / tiket
                </span>
            </div>

            @php $maxMargin = max(35, (float) $marginByOrder->max('margin_percentage')); @endphp
            <div class="space-y-3.5 pt-1">
                @forelse($marginByOrder as $row)
                <div class="p-3 rounded-xl bg-slate-50/80 border border-slate-200/60 hover:bg-slate-50 transition">
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <div class="flex items-center gap-2">
                            <span class="font-mono font-bold text-slate-900">{{ $row['order_number'] }}</span>
                            <span class="text-slate-400">•</span>
                            <span class="text-slate-600 truncate max-w-[180px]">{{ $row['shipper_name'] }}</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <span class="text-[11px] font-mono text-slate-500">Laba: Rp {{ number_format($row['gross_profit'], 0, ',', '.') }}</span>
                            <span class="font-mono font-bold px-2 py-0.5 rounded text-xs {{ $row['is_low_margin_alert'] ? 'bg-amber-100 text-amber-800 border border-amber-200' : 'bg-emerald-100 text-emerald-800 border border-emerald-200' }}">
                                {{ number_format($row['margin_percentage'], 2) }}%
                            </span>
                        </div>
                    </div>
                    <div class="relative h-2.5 rounded-full bg-slate-200/80 overflow-hidden">
                        <div class="absolute inset-y-0 left-0 rounded-full transition-all duration-700 {{ $row['is_low_margin_alert'] ? 'bg-gradient-to-r from-amber-400 to-amber-500' : 'bg-gradient-to-r from-emerald-500 to-emerald-600' }}"
                             style="width: {{ min(100, $row['margin_percentage'] / $maxMargin * 100) }}%"></div>
                        <div class="absolute inset-y-0 w-0.5 bg-slate-600/80 z-10" style="left: {{ 10 / $maxMargin * 100 }}%" title="Batas Aman 10%"></div>
                    </div>
                </div>
                @empty
                <p class="text-xs text-slate-500 py-6 text-center">Belum ada data transaksi pesanan.</p>
                @endforelse
            </div>
        </div>

        <!-- Col Right (5 cols): Vendor Partner Cost Breakdown -->
        <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <i data-lucide="building-2" class="w-5 h-5 text-brand-600"></i>
                        <span>Beban Biaya Vendor Partner</span>
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">Alokasi pembayaran ke pihak ketiga</p>
                </div>
                <span class="text-xs font-mono text-slate-500">{{ $vendorCosts->count() }} Mitra</span>
            </div>

            <div class="space-y-3 pt-1">
                @forelse($vendorCosts as $vc)
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/70 flex items-center justify-between">
                    <div>
                        <div class="font-bold text-slate-900 text-xs flex items-center gap-1.5">
                            <span>{{ $vc['name'] }}</span>
                            <span class="text-[10px] font-mono text-slate-400 bg-white px-1.5 py-0.5 rounded border border-slate-200">{{ $vc['code'] }}</span>
                        </div>
                        <div class="text-[11px] text-slate-500 mt-0.5">{{ $vc['orders_count'] }} pesanan diselesaikan</div>
                    </div>
                    <div class="text-right">
                        <div class="font-mono font-bold text-slate-900 text-xs">
                            Rp {{ number_format($vc['total_cost'], 0, ',', '.') }}
                        </div>
                        <div class="text-[10px] text-slate-400">Total sewa unit</div>
                    </div>
                </div>
                @empty
                <p class="text-xs text-slate-500 py-6 text-center">Belum ada vendor terdaftar.</p>
                @endforelse
            </div>

            <div class="pt-2 border-t border-slate-100 text-[11px] text-slate-500 flex items-center justify-between">
                <span>Total tagihan vendor logistik:</span>
                <span class="font-mono font-bold text-slate-900">Rp {{ number_format($totalVendorCost, 0, ',', '.') }}</span>
            </div>
        </div>

    </div>

    <!-- Financial Ledger & Invoicing Action Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <i data-lucide="receipt" class="w-5 h-5 text-emerald-600"></i>
                    <span>Buku Besar Tagihan &amp; Penerbitan Invoice</span>
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Daftar transaksi, kontrol margin laba, dan pencairan invoice resmi shipper</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.orders.index') }}" class="px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50 transition">
                    Lihat Semua Pesanan →
                </a>
            </div>
        </div>

        <!-- Desktop Financial Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600" id="financeTable">
                <thead class="bg-slate-50/80 text-slate-700 uppercase font-mono text-[10px] tracking-wider border-b border-slate-200/80">
                    <tr>
                        <th class="py-3 px-4">No. Order &amp; Shipper</th>
                        <th class="py-3 px-4">Rute Pengiriman</th>
                        <th class="py-3 px-4 text-right">Tarif Shipper (DPP)</th>
                        <th class="py-3 px-4 text-right">Beban Modal (Cost)</th>
                        <th class="py-3 px-4 text-right">Laba Kotor</th>
                        <th class="py-3 px-4 text-center">Margin</th>
                        <th class="py-3 px-4 text-center">Status Invoice</th>
                        <th class="py-3 px-4 text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($orders as $o)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-3.5 px-4">
                            <a href="{{ route('admin.orders.show', $o) }}" class="font-mono font-bold text-brand-600 hover:underline">
                                {{ $o->order_number }}
                            </a>
                            <div class="font-semibold text-slate-900 mt-0.5">{{ $o->shipper_name }}</div>
                        </td>
                        <td class="py-3.5 px-4">
                            <div class="font-medium text-slate-800">{{ $o->origin_city }} → {{ $o->destination_city }}</div>
                            <div class="text-[11px] text-slate-400 mt-0.5">{{ $o->cargo_description }} ({{ $o->cargo_weight_ton }} Ton)</div>
                        </td>
                        <td class="py-3.5 px-4 text-right font-mono font-bold text-slate-900">
                            Rp {{ number_format($o->selling_price, 0, ',', '.') }}
                        </td>
                        <td class="py-3.5 px-4 text-right font-mono text-slate-600">
                            Rp {{ number_format($o->vendor_cost + $o->operational_cost, 0, ',', '.') }}
                        </td>
                        <td class="py-3.5 px-4 text-right font-mono font-bold {{ $o->gross_profit >= 0 ? 'text-emerald-700' : 'text-rose-600' }}">
                            Rp {{ number_format($o->gross_profit, 0, ',', '.') }}
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <span class="inline-block px-2 py-0.5 rounded font-mono font-bold text-[11px] {{ $o->is_low_margin_alert ? 'bg-amber-100 text-amber-800 border border-amber-200' : 'bg-emerald-100 text-emerald-800 border border-emerald-200' }}">
                                {{ $o->margin_percentage }}%
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            @if($o->invoice_generated)
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <i data-lucide="check" class="w-3 h-3"></i> Faktur Terbit
                                </span>
                            @elseif($o->status === 'delivered')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-amber-50 text-amber-800 border border-amber-200">
                                    <i data-lucide="clock" class="w-3 h-3"></i> E-POD Sah (Siap)
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-slate-100 text-slate-500">
                                    {{ $o->statusLabel() }}
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            @if($o->invoice_generated)
                                <a href="{{ route('admin.orders.invoice.show', $o) }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[11px] shadow-xs transition">
                                    <i data-lucide="receipt" class="w-3.5 h-3.5"></i>
                                    <span>Lihat Invoice</span>
                                </a>
                            @elseif($o->status === 'delivered')
                                <form action="{{ route('admin.orders.invoice', $o) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-brand-600 hover:bg-brand-500 text-white font-bold text-[11px] shadow-xs transition">
                                        <i data-lucide="file-plus" class="w-3.5 h-3.5"></i>
                                        <span>Terbitkan</span>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('admin.orders.show', $o) }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-100 font-medium text-[11px] transition">
                                    <span>Rincian</span>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-8 text-center text-slate-500 text-xs">
                            Tidak ada data transaksi pesanan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@push('scripts')
<script>
    function exportFinanceCSV() {
        const rows = [
            ['No Order', 'Shipper', 'Asal', 'Tujuan', 'Tarif Shipper (DPP)', 'Biaya Modal (Cost)', 'Laba Kotor', 'Margin (%)', 'Status Invoice']
        ];
        
        @foreach($orders as $o)
            rows.push([
                "{{ $o->order_number }}",
                "{{ addslashes($o->shipper_name) }}",
                "{{ addslashes($o->origin_city) }}",
                "{{ addslashes($o->destination_city) }}",
                "{{ $o->selling_price }}",
                "{{ $o->vendor_cost + $o->operational_cost }}",
                "{{ $o->gross_profit }}",
                "{{ $o->margin_percentage }}%",
                "{{ $o->invoice_generated ? 'Invoiced' : $o->status }}"
            ]);
        @endforeach

        let csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.map(cell => `"${cell}"`).join(",")).join("\n");
        let encodedUri = encodeURI(csvContent);
        let link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "Laporan_Keuangan_TrackFleet_" + new Date().toISOString().slice(0,10) + ".csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
@endpush
@endsection
