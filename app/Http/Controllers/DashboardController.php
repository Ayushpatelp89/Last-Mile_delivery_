<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'centers' => \App\Models\DeliveryCenter::count(),
            'vehicles' => \App\Models\Vehicle::count(),
            'drivers' => \App\Models\Driver::count(),
            'orders' => \App\Models\Order::count(),
        ];

        // Let's get active routes and orders for map overview
        $centers = \App\Models\DeliveryCenter::all();
        $pendingOrders = \App\Models\Order::where('status', 'pending')->get();

        return view('dashboard', compact('stats', 'centers', 'pendingOrders'));
    }
}
