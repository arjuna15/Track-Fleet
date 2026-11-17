<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VendorPartner;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(): View
    {
        $vehicles = Vehicle::with(['vendorPartner', 'orders' => fn($q) => $q->latest()->limit(1)])->get();
        $vendors = VendorPartner::where('status', 'active')->get();

        $inTransitCount = $vehicles->where('status', 'in_transit')->count();
        $idleCount = $vehicles->where('status', 'idle')->count();
        $maintenanceCount = $vehicles->where('status', 'maintenance')->count();

        return view('admin.vehicles.index', compact('vehicles', 'vendors', 'inTransitCount', 'idleCount', 'maintenanceCount'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'plate_number' => 'required|string|unique:vehicles,plate_number',
            'truck_type' => 'required|in:CDD_BOX,CDE_ENGKEL,FUSO_BAK,TRONTON_WINGBOX,TRAILER_40FT',
            'driver_name' => 'required|string|max:255',
            'driver_phone' => 'required|string|max:50',
            'vendor_partner_id' => 'required|exists:vendor_partners,id',
            'current_location_name' => 'nullable|string|max:255',
        ], [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'max.string' => ':attribute maksimal :max karakter.',
            'unique' => ':attribute sudah terdaftar. Periksa kembali nomor polisi.',
            'in' => 'Pilih jenis kendaraan yang tersedia.',
            'exists' => 'Vendor tidak tersedia. Muat ulang halaman dan pilih kembali.',
        ], [
            'plate_number' => 'Nomor polisi',
            'truck_type' => 'Tipe kendaraan',
            'driver_name' => 'Nama pengemudi',
            'driver_phone' => 'Nomor telepon pengemudi',
            'vendor_partner_id' => 'Vendor',
            'current_location_name' => 'Lokasi terakhir',
        ]);

        Vehicle::create([
            ...$validated,
            'status' => 'idle',
            'current_lat' => -6.2088,
            'current_lng' => 106.8456, // default Jakarta
            'last_ping_at' => now(),
        ]);

        return back()->with('success', 'Unit armada berhasil didaftarkan ke inventori!');
    }
}
