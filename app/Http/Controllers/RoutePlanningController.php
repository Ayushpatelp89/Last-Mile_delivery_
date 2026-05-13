<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCenter;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Route;
use App\Models\RouteStop;
use App\Services\RouteOptimizationService;
use Illuminate\Http\Request;

class RoutePlanningController extends Controller
{
    public function index()
    {
        $centers = DeliveryCenter::all();
        $drivers = Driver::where('availability_status', 'available')->get();
        $pendingOrders = Order::where('status', 'pending')->with('deliveryCenter')->get();
        
        return view('route-planning.index', compact('centers', 'drivers', 'pendingOrders'));
    }

    public function optimize(Request $request, RouteOptimizationService $optimizer)
    {
        $request->validate([
            'center_id' => 'required|exists:delivery_centers,id',
            'driver_id' => 'required|exists:drivers,id'
        ]);

        $center = DeliveryCenter::findOrFail($request->center_id);
        $orders = Order::where('delivery_center_id', $center->id)
                      ->where('status', 'pending')
                      ->get();

        if ($orders->isEmpty()) {
            return back()->with('error', 'No pending orders for this center.');
        }

        $driver = Driver::findOrFail($request->driver_id);
        
        // Optimize the route
        $result = $optimizer->optimizeRoute($center, $orders);

        // Save Route to DB
        $route = Route::create([
            'driver_id' => $driver->id,
            'vehicle_id' => $driver->vehicle_id,
            'date' => now()->toDateString(),
            'total_distance' => $result['total_distance_km'],
            'estimated_time' => $result['estimated_time_minutes'],
            'status' => 'planned'
        ]);

        // Save Stops
        $sequence = 1;
        foreach ($result['route'] as $orderData) {
            RouteStop::create([
                'route_id' => $route->id,
                'order_id' => $orderData['id'],
                'stop_sequence' => $sequence++
            ]);
            
            Order::where('id', $orderData['id'])->update(['status' => 'assigned']);
        }

        $driver->update(['availability_status' => 'on_delivery']);

        return redirect()->route('route-planning.show', $route->id)
                         ->with('success', 'Route optimized and created successfully!');
    }

    public function show(Route $route)
    {
        $route->load(['driver', 'vehicle', 'routeStops.order']);
        $center = $route->routeStops->first()->order->deliveryCenter ?? DeliveryCenter::first();
        return view('route-planning.show', compact('route', 'center'));
    }
}
