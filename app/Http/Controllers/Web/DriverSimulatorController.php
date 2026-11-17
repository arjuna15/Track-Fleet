<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LocationPing;
use App\Models\Order;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DriverSimulatorController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::whereIn('status', ['dispatched', 'in_transit', 'delivered'])->get();
        $selectedOrder = null;

        if ($request->filled('order_id')) {
            $selectedOrder = Order::with(['vehicle', 'locationPings'])->find($request->order_id);
        } elseif ($orders->isNotEmpty()) {
            $selectedOrder = $orders->first();
            $selectedOrder->load(['vehicle', 'locationPings']);
        }

        return view('driver.simulator', compact('orders', 'selectedOrder'));
    }

    public function pingLocation(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'location_name' => 'required|string|max:255',
            'speed_kmh' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:500',
        ]);

        $ping = LocationPing::create([
            'order_id' => $order->id,
            'vehicle_id' => $order->vehicle_id,
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'location_name' => $validated['location_name'],
            'speed_kmh' => $validated['speed_kmh'] ?? 60.0,
            'notes' => $validated['notes'] ?? 'Update posisi berkala via smartphone driver.',
            'recorded_at' => now(),
        ]);

        // Update current vehicle position
        if ($order->vehicle) {
            $order->vehicle->update([
                'current_lat' => $validated['latitude'],
                'current_lng' => $validated['longitude'],
                'current_location_name' => $validated['location_name'],
                'last_ping_at' => now(),
                'status' => 'in_transit',
            ]);
        }

        if ($order->status === 'dispatched') {
            $order->update(['status' => 'in_transit']);
        }

        return back()->with('success', 'Lokasi GPS berhasil dipancarkan ke satelit TrackFleet!');
    }

    public function uploadPod(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'pod_signer_name' => 'required|string|max:255',
            'notes' => 'nullable|string|max:255',
            'pod_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $podPath = $order->pod_image_path ?? 'pod-stempel-verified.png';

        if ($request->hasFile('pod_image')) {
            $dir = public_path('uploads/pod');
            if (! is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $file = $request->file('pod_image');
            $name = 'pod-'.$order->id.'-'.now()->format('YmdHis').'.'.$file->getClientOriginalExtension();
            $file->move($dir, $name);
            $podPath = 'uploads/pod/'.$name;
        }

        $order->update([
            'status' => 'delivered',
            'pod_signer_name' => $validated['pod_signer_name'],
            'pod_uploaded_at' => now(),
            'pod_image_path' => $podPath,
            'invoice_generated' => true,
            'invoice_date' => now(),
        ]);

        if ($order->vehicle) {
            $order->vehicle->update(['status' => 'idle']);
        }

        return back()->with('success', 'Bukti Terima (POD) berhasil diunggah! Invoice otomatis digenerate seketika.');
    }
}
