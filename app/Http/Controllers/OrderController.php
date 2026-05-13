<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\DeliveryCenter;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('deliveryCenter')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $centers = DeliveryCenter::all();
        return view('orders.create', compact('centers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'parcel_weight' => 'required|numeric',
            'priority' => 'required|string',
            'delivery_center_id' => 'required|exists:delivery_centers,id',
        ]);

        Order::create($validated);
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $centers = DeliveryCenter::all();
        return view('orders.edit', compact('order', 'centers'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'parcel_weight' => 'required|numeric',
            'priority' => 'required|string',
            'delivery_center_id' => 'required|exists:delivery_centers,id',
            'status' => 'required|string'
        ]);

        $order->update($validated);
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
