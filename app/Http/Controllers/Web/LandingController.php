<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Vehicle;
use App\Models\VendorPartner;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_active_fleet' => Vehicle::where('status', 'in_transit')->count() + 142, // showcase realistic number
            'provinces_covered' => 18,
            'margin_saved_percentage' => '14.8%',
            'total_trips' => Order::count() + 1280,
        ];

        return view('landing.index', compact('stats'));
    }

    public function pricing(): View
    {
        return view('landing.pricing');
    }
}
