<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Vehicle;
use App\Models\VendorPartner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $query = Order::with(['vehicle', 'vendorPartner'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('alert')) {
            $query->where('is_low_margin_alert', true);
        }

        $orders = $query->paginate(15);
        $vehicles = Vehicle::where('status', 'idle')->get();
        $vendors = VendorPartner::where('status', 'active')->get();

        $totalOrdersCount = Order::count();
        $inTransitCount = Order::where('status', 'in_transit')->count();
        $deliveredCount = Order::whereIn('status', ['delivered', 'completed'])->count();
        $lowMarginCount = Order::where('is_low_margin_alert', true)->count();
        $totalRevenue = Order::sum('selling_price');
        $totalGrossProfit = Order::sum('gross_profit');

        return view('admin.orders.index', compact(
            'orders', 'vehicles', 'vendors',
            'totalOrdersCount', 'inTransitCount', 'deliveredCount', 'lowMarginCount', 'totalRevenue', 'totalGrossProfit'
        ));
    }

    public function show(Order $order): View
    {
        $order->load(['vehicle', 'vendorPartner', 'locationPings']);

        return view('admin.orders.show', compact('order'));
    }

    public function showInvoice(Order $order): View
    {
        $order->load(['vehicle', 'vendorPartner']);

        // Nomor invoice deterministik dari nomor pesanan
        $invoiceNumber = 'INV/'.str_replace('TF-', '', $order->order_number).'/'.($order->invoice_date?->format('m-Y') ?? date('m-Y'));

        return view('admin.orders.invoice', compact('order', 'invoiceNumber'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'shipper_name' => 'required|string|max:255',
            'shipper_contact' => 'required|string|max:255',
            'origin_city' => 'required|string|max:100',
            'origin_address' => 'required|string|max:255',
            'destination_city' => 'required|string|max:100',
            'destination_address' => 'required|string|max:255',
            'cargo_description' => 'required|string|max:255',
            'cargo_weight_ton' => 'required|numeric|min:0.1',
            'selling_price' => 'required|numeric|min:0',
            'vendor_cost' => 'required|numeric|min:0',
            'operational_cost' => 'nullable|numeric|min:0',
            'vendor_partner_id' => 'nullable|exists:vendor_partners,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
        ], [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'max.string' => ':attribute maksimal :max karakter.',
            'numeric' => ':attribute harus berupa angka.',
            'min.numeric' => ':attribute minimal :min.',
            'exists' => 'Pilihan :attribute tidak tersedia. Muat ulang halaman dan pilih kembali.',
        ], [
            'shipper_name' => 'Nama pengirim',
            'shipper_contact' => 'Kontak pengirim',
            'origin_city' => 'Kota asal',
            'origin_address' => 'Alamat asal',
            'destination_city' => 'Kota tujuan',
            'destination_address' => 'Alamat tujuan',
            'cargo_description' => 'Jenis muatan',
            'cargo_weight_ton' => 'Berat muatan',
            'selling_price' => 'Nilai kiriman',
            'vendor_cost' => 'Biaya kendaraan',
            'operational_cost' => 'Biaya operasional',
            'vendor_partner_id' => 'Vendor',
            'vehicle_id' => 'Kendaraan',
        ]);

        $operational = $validated['operational_cost'] ?? 0;
        $marginData = Order::calculateMargin((float) $validated['selling_price'], (float) $validated['vendor_cost'], (float) $operational);

        $orderNumber = 'TF-'.date('Ym').'-'.str_pad(Order::count() + 1, 4, '0', STR_PAD_LEFT);
        $trackingCode = 'TRK-'.strtoupper(Str::random(8));

        $vehicle = ! empty($validated['vehicle_id']) ? Vehicle::find($validated['vehicle_id']) : null;

        $order = Order::create([
            'order_number' => $orderNumber,
            'public_tracking_code' => $trackingCode,
            'shipper_name' => $validated['shipper_name'],
            'shipper_contact' => $validated['shipper_contact'],
            'origin_city' => $validated['origin_city'],
            'origin_address' => $validated['origin_address'],
            'destination_city' => $validated['destination_city'],
            'destination_address' => $validated['destination_address'],
            'cargo_description' => $validated['cargo_description'],
            'cargo_weight_ton' => $validated['cargo_weight_ton'],
            'selling_price' => $validated['selling_price'],
            'vendor_cost' => $validated['vendor_cost'],
            'operational_cost' => $operational,
            'gross_profit' => $marginData['gross_profit'],
            'margin_percentage' => $marginData['margin_percentage'],
            'is_low_margin_alert' => $marginData['is_low_margin_alert'],
            'vendor_partner_id' => $validated['vendor_partner_id'] ?? null,
            'vehicle_id' => $vehicle?->id,
            'assigned_driver_name' => $vehicle?->driver_name,
            'assigned_driver_phone' => $vehicle?->driver_phone,
            'status' => $vehicle ? 'dispatched' : 'inquiry',
        ]);

        if ($vehicle) {
            $vehicle->update(['status' => 'in_transit']);
        }

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order '.$order->order_number.' berhasil didaftarkan ke sistem TrackFleet!');
    }

    public function generateInvoice(Order $order): RedirectResponse
    {
        $order->update([
            'invoice_generated' => true,
            'invoice_date' => now(),
            'status' => 'invoiced',
        ]);

        return back()->with('success', 'Invoice elektronik berhasil digenerate otomatis!');
    }
}
