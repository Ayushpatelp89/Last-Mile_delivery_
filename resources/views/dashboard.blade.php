@extends('layouts.app')

@section('header', 'Dashboard Overview')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stat-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-2 text-white-50">Total Centers</h6>
                    <h2 class="mb-0 fw-bold">{{ $stats['centers'] }}</h2>
                </div>
                <div class="fs-1 opacity-50"><i class="fa-solid fa-building"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card-2 p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-2 text-dark opacity-50">Active Vehicles</h6>
                    <h2 class="mb-0 fw-bold">{{ $stats['vehicles'] }}</h2>
                </div>
                <div class="fs-1 opacity-25"><i class="fa-solid fa-truck"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card-3 p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-2 text-dark opacity-50">Total Drivers</h6>
                    <h2 class="mb-0 fw-bold">{{ $stats['drivers'] }}</h2>
                </div>
                <div class="fs-1 opacity-25"><i class="fa-solid fa-id-card"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card-4 p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-2 text-white-50">Pending Orders</h6>
                    <h2 class="mb-0 fw-bold">{{ $stats['orders'] }}</h2>
                </div>
                <div class="fs-1 opacity-50"><i class="fa-solid fa-box-open"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card p-3">
            <h5 class="mb-3"><i class="fa-solid fa-map-location-dot me-2"></i> Live Logistics Map</h5>
            <div id="map" style="height: 500px; border-radius: 8px;"></div>
        </div>
    </div>
</div>
@endsection

@stack('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('map').setView([20.5937, 78.9629], 5); // Default to India

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
