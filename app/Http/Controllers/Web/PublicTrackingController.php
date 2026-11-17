<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicTrackingController extends Controller
{
    public function index(Request $request): View
    {
        $code = $request->get('code');
        $order = null;

        if ($code) {
            $order = Order::with(['vehicle', 'locationPings'])
                ->where('public_tracking_code', trim($code))
                ->orWhere('order_number', trim($code))
                ->first();
        }

        return view('tracking.public', compact('order', 'code'));
    }
}
