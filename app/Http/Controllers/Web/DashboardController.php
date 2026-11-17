<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Vehicle;
use App\Models\VendorPartner;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Entrypoint: Auto-route to respective role dashboard
     */
    public function index(): View|RedirectResponse
    {
        if (auth()->check() && auth()->user()->isFinance()) {
            return redirect()->route('admin.finance');
        }

        return $this->operational();
    }

    /**
     * Halaman 1: Admin Operasional (Dispatch, Live GPS Telemetri & Armada)
     */
    public function operational(): View
    {
        $orders = Order::with(['vehicle', 'vendorPartner'])->latest()->get();
        $activeVehicles = Vehicle::with('vendorPartner')->get();
        $vendors = VendorPartner::withCount('orders')->get();

        $inTransitCount = $orders->where('status', 'in_transit')->count();
        $deliveredCount = $orders->where('status', 'delivered')->count();
        $dispatchedCount = $orders->where('status', 'dispatched')->count();
        $inquiryCount = $orders->where('status', 'inquiry')->count();
        $idleVehiclesCount = $activeVehicles->where('status', 'idle')->count();
        $runningVehiclesCount = $activeVehicles->where('status', 'in_transit')->count();
        $lowMarginCount = $orders->where('is_low_margin_alert', true)->count();

        // Data visualisasi status dispatch operasional
        $statusOrder = ['inquiry', 'dispatched', 'in_transit', 'delivered', 'invoiced', 'completed'];
        $statusDistribution = collect($statusOrder)
            ->map(fn ($s) => ['status' => $s, 'count' => $orders->where('status', $s)->count()])
            ->filter(fn ($row) => $row['count'] > 0)
            ->values();

        $recentDispatches = $orders->take(8);

        return view('admin.dashboard', compact(
            'orders',
            'activeVehicles',
            'vendors',
            'inTransitCount',
            'deliveredCount',
            'dispatchedCount',
            'inquiryCount',
            'idleVehiclesCount',
            'runningVehiclesCount',
            'lowMarginCount',
            'statusDistribution',
            'recentDispatches'
        ));
    }

    /**
     * Halaman 2: Manajer Keuangan (Profit Intelligence, Margin Guard, Invoicing & Kas)
     */
    public function finance(): View
    {
        $orders = Order::with(['vehicle', 'vendorPartner'])->latest()->get();

        $totalRevenue = $orders->sum('selling_price');
        $totalVendorCost = $orders->sum('vendor_cost');
        $totalOperationalCost = $orders->sum('operational_cost');
        $totalGrossProfit = $orders->sum('gross_profit');
        $overallMarginPct = $totalRevenue > 0 ? ($totalGrossProfit / $totalRevenue) * 100 : 0;

        $lowMarginOrders = $orders->where('is_low_margin_alert', true);
        $lowMarginCount = $lowMarginOrders->count();

        $invoicedOrders = $orders->where('invoice_generated', true);
        $invoicedCount = $invoicedOrders->count();
        $invoicedAmount = $invoicedOrders->sum('selling_price');

        $pendingInvoiceOrders = $orders->where('status', 'delivered')->where('invoice_generated', false);
        $pendingInvoiceCount = $pendingInvoiceOrders->count();
        $pendingInvoiceAmount = $pendingInvoiceOrders->sum('selling_price');

        $vendors = VendorPartner::withCount('orders')->with('orders')->get();
        $vendorCosts = $vendors->map(fn ($v) => [
            'name' => $v->name,
            'code' => $v->company_code,
            'orders_count' => $v->orders_count,
            'total_cost' => (float) $v->orders->sum('vendor_cost'),
        ])->sortByDesc('total_cost')->values();

        $marginByOrder = $orders->take(8)->map(fn ($o) => [
            'order_number' => $o->order_number,
            'shipper_name' => $o->shipper_name,
            'margin_percentage' => (float) $o->margin_percentage,
            'gross_profit' => (float) $o->gross_profit,
            'is_low_margin_alert' => (bool) $o->is_low_margin_alert,
        ]);

        $avgTicket = $orders->count() > 0 ? $orders->avg('selling_price') : 0;

        return view('admin.finance.dashboard', compact(
            'orders',
            'totalRevenue',
            'totalVendorCost',
            'totalOperationalCost',
            'totalGrossProfit',
            'overallMarginPct',
            'lowMarginOrders',
            'lowMarginCount',
            'invoicedOrders',
            'invoicedCount',
            'invoicedAmount',
            'pendingInvoiceOrders',
            'pendingInvoiceCount',
            'pendingInvoiceAmount',
            'vendorCosts',
            'marginByOrder',
            'avgTicket'
        ));
    }
}
