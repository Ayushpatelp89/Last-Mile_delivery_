<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCenter;
use Illuminate\Http\Request;

class DeliveryCenterController extends Controller
{
    public function index()
    {
        $centers = DeliveryCenter::all();
        return view('centers.index', compact('centers'));
    }

    public function create()
    {
        return view('centers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'contact_number' => 'nullable|string'
        ]);

        DeliveryCenter::create($validated);
        return redirect()->route('centers.index')->with('success', 'Center created successfully.');
    }

    public function show(DeliveryCenter $center)
    {
        return view('centers.show', compact('center'));
    }

    public function edit(DeliveryCenter $center)
    {
        return view('centers.edit', compact('center'));
    }

    public function update(Request $request, DeliveryCenter $center)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'contact_number' => 'nullable|string'
        ]);

        $center->update($validated);
        return redirect()->route('centers.index')->with('success', 'Center updated successfully.');
    }

    public function destroy(DeliveryCenter $center)
    {
        $center->delete();
        return redirect()->route('centers.index')->with('success', 'Center deleted successfully.');
    }
}
