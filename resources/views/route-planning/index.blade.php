@extends('layouts.app')

@section('header', 'Route Optimization Engine')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card p-4 h-100">
            <h5 class="mb-4"><i class="fa-solid fa-route text-primary me-2"></i> Plan New Route</h5>
            
            <form action="{{ route('route-planning.optimize') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold">Select Delivery Center</label>
                    <select class="form-select" name="center_id" required>
                        <option value="">-- Choose Center --</option>
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted fw-bold">Assign Driver</label>
                    <select class="form-select" name="driver_id" required>
                        <option value="">-- Choose Available Driver --</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}">{{ $driver->name }} ({{ $driver->vehicle->vehicle_number ?? 'No Vehicle' }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="alert alert-info py-2">
                    <small><i class="fa-solid fa-circle-info me-1"></i> The system will automatically select all pending orders for the chosen center and calculate the optimal sequence using Haversine Distance heuristic.</small>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-bold py-2">
                    <i class="fa-solid fa-wand-magic-sparkles me-2"></i> Generate Optimal Route
                </button>
            </form>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card p-3 h-100">
            <h5 class="mb-3">Pending Deliveries Overview</h5>
            <div id="map" style="height: 500px; border-radius: 8px;"></div>
        </div>
    </div>
</div>
@endsection

@stack('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('map').setView([20.5937, 78.9629], 5);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap &copy; CARTO'
    }).addTo(map);

    var centers = @json($centers);
    var orders = @json($pendingOrders);

    // Center icon
    var centerIcon = L.divIcon({
        className: 'custom-div-icon',
        html: "<div style='background-color:#1a233a; width:15px; height:15px; border-radius:50%; border:2px solid white; box-shadow: 0 0 5px rgba(0,0,0,0.5);'></div>",
        iconSize: [15, 15]
    });

    // Order icon
    var orderIcon = L.divIcon({
        className: 'custom-div-icon',
        html: "<div style='background-color:#fa709a; width:12px; height:12px; border-radius:50%; border:2px solid white; box-shadow: 0 0 5px rgba(0,0,0,0.5);'></div>",
        iconSize: [12, 12]
    });

    centers.forEach(function(center) {
        L.marker([center.latitude, center.longitude], {icon: centerIcon})
            .addTo(map)
            .bindPopup("<b>" + center.name + "</b><br>Center Hub");
    });

    orders.forEach(function(order) {
        L.marker([order.latitude, order.longitude], {icon: orderIcon})
            .addTo(map)
            .bindPopup("<b>Order #" + order.id + "</b><br>" + order.customer_name);
    });
});
</script>
