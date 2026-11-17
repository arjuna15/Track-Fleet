@extends('layouts.app')

@section('title', 'Invoice ' . $invoiceNumber . ' — TrackFleet')
@section('meta_description', 'Dokumen invoice untuk pesanan ' . $order->order_number . '.')

@php
    $issueDate = $order->invoice_date ?? now();
    $dueDate = $issueDate->copy()->addDays(14);
    $dpp = (float) $order->selling_price;
    $ppn = round($dpp * 0.11);
    $total = $dpp + $ppn;
@endphp

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Toolbar (tidak ikut tercetak) -->
    <div class="no-print flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
        <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-slate-900">
            <i data-lucide="chevron-right" class="w-4 h-4 rotate-180"></i>
            Kembali ke pesanan
        </a>
        <div class="flex items-center gap-2">
            <span class="text-[11px] text-slate-500 hidden sm:inline">Gunakan menu Cetak untuk menyimpan sebagai PDF.</span>
            <button type="button" onclick="window.print()" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-900 hover:bg-slate-800 text-white shadow-md transition flex items-center gap-1.5">
                <i data-lucide="file-check-2" class="w-4 h-4"></i>
                Cetak / Simpan PDF
            </button>
        </div>
    </div>

    <!-- Dokumen Invoice -->
    <div class="print-sheet bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 sm:p-10">

        <!-- Kop -->
        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-6 pb-6 border-b-2 border-slate-900">
            <div class="flex items-center gap-3">
                <img src="{{ asset('favicon.svg') }}" alt="TrackFleet" class="w-11 h-11 rounded-xl">
                <div>
                    <div class="text-lg font-black text-slate-900 leading-none">TrackFleet</div>
                    <div class="text-[11px] text-slate-500 font-medium mt-1">PT TrackFleet Logistik Nusantara</div>
                </div>
            </div>
            <div class="text-left sm:text-right">
                <div class="text-2xl font-black text-slate-900 uppercase tracking-tight">Invoice</div>
                <div class="text-xs font-mono text-slate-600 mt-1">{{ $invoiceNumber }}</div>
                <span class="inline-block mt-2 px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $order->invoice_generated ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                    {{ $order->invoice_generated ? 'Lunas / Tertagih' : 'Draft' }}
                </span>
            </div>
        </div>

        <!-- Info penerbit & penerima -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 py-6 text-xs">
            <div>
                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Diterbitkan oleh</div>
                <div class="font-bold text-slate-900">PT TrackFleet Logistik Nusantara</div>
                <div class="text-slate-500 leading-relaxed mt-1">
                    Jl. Jenderal Sudirman Kav. 52-53<br>
                    Jakarta Selatan 12190<br>
                    NPWP 01.234.567.8-901.000
                </div>
            </div>
            <div>
                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Ditagihkan kepada</div>
                <div class="font-bold text-slate-900">{{ $order->shipper_name }}</div>
                <div class="text-slate-500 leading-relaxed mt-1">
                    {{ $order->shipper_contact }}<br>
                    {{ $order->origin_city }}<br>
                    Ref. {{ $order->order_number }}
                </div>
            </div>
            <div class="sm:text-right">
                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Detail</div>
                <div class="space-y-1 text-slate-600">
                    <div>Tanggal terbit: <strong class="text-slate-900">{{ $issueDate->format('d M Y') }}</strong></div>
                    <div>Jatuh tempo: <strong class="text-slate-900">{{ $dueDate->format('d M Y') }}</strong></div>
                    <div>Termin: <strong class="text-slate-900">14 hari</strong></div>
                </div>
            </div>
        </div>

        <!-- Rincian layanan -->
        <div class="overflow-x-auto">
            <table class="w-full text-xs mt-2 min-w-[460px] sm:min-w-0">
                <thead>
                    <tr class="bg-slate-900 text-white">
                        <th class="text-left font-bold px-4 py-2.5 rounded-l-lg">Deskripsi layanan</th>
                        <th class="text-center font-bold px-4 py-2.5">Muatan</th>
                        <th class="text-right font-bold px-4 py-2.5 rounded-r-lg">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-slate-100">
                        <td class="px-4 py-4">
                            <div class="font-bold text-slate-900">Jasa angkutan barang</div>
                            <div class="text-slate-500 mt-0.5">{{ $order->origin_city }} &rarr; {{ $order->destination_city }}</div>
                            <div class="text-slate-400 text-[11px] mt-0.5">{{ $order->cargo_description }}</div>
                        </td>
                        <td class="px-4 py-4 text-center text-slate-600">{{ $order->cargo_weight_ton }} Ton</td>
                        <td class="px-4 py-4 text-right font-mono font-bold text-slate-900">Rp {{ number_format($dpp, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Ringkasan biaya -->
        <div class="flex justify-end mt-6">
            <div class="w-full sm:w-72 space-y-2 text-xs">
                <div class="flex items-center justify-between text-slate-600">
                    <span>Subtotal (DPP)</span>
                    <span class="font-mono">Rp {{ number_format($dpp, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between text-slate-600">
                    <span>PPN 11%</span>
                    <span class="font-mono">Rp {{ number_format($ppn, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between pt-3 border-t-2 border-slate-900">
                    <span class="font-black text-slate-900 uppercase text-sm">Total tagihan</span>
                    <span class="font-mono font-black text-slate-900 text-base">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Pembayaran & tanda tangan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-10 pt-6 border-t border-slate-100 text-xs">
            <div>
                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Instruksi pembayaran</div>
                <div class="text-slate-600 leading-relaxed">
                    Bank Mandiri &middot; A/C <span class="font-mono font-bold text-slate-900">137-00-1234-5678</span><br>
                    Atas nama: PT TrackFleet Logistik Nusantara<br>
                    Mohon cantumkan nomor invoice pada berita transfer.
                </div>
            </div>
            <div class="sm:text-right">
                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-6">Hormat kami,</div>
                <div class="font-bold text-slate-900 border-t border-slate-300 inline-block pt-2 px-6">Bagian Keuangan TrackFleet</div>
            </div>
        </div>

        <p class="text-[10px] text-slate-400 mt-8 leading-relaxed">
            Invoice ini diterbitkan secara elektronik dan sah tanpa tanda tangan basah. Pembayaran yang diterima setelah tanggal jatuh tempo dapat dikenakan denda keterlambatan sesuai perjanjian kerja sama.
        </p>
    </div>
</div>
@endsection
