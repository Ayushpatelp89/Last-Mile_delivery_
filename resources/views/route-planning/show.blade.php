@extends('layouts.app')

@section('header', 'Optimized Route Overview')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card p-4 h-100">
            <h5 class="mb-3 text-success"><i class="fa-solid fa-check-circle me-2"></i> Route #{{ $route->id }} Planned</h5>
            
            <div class="mb-4">
                <p class="mb-1 text-muted"><strong>Driver:</strong> {{ $route->driver->name }}</p>
                <p class="mb-1 text-muted"><strong>Vehicle:</strong> {{ $route->vehicle->vehicle_number }} ({{ $route->vehicle->type }})</p>
                <p class="mb-1 text-muted"><strong>Total Distance:</strong> {{ $route->total_distance }} km</p>
                <p class="mb-1 text-muted"><strong>Est. Time:</strong> {{ floor($route->estimated_time / 60) }}h {{ $route->estimated_time % 60 }}m</p>
            </div>

            <h6 class="fw-bold mb-3">Delivery Sequence:</h6>
            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item bg-light border-0 rounded mb-2">
                    <small class="text-muted d-block">START HUB</small>
                    <strong>{{ $center->name }}</strong>
                </li>
                @foreach($route->routeStops as $stop)
                <li class="list-group-item border-0 rounded mb-2 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-primary rounded-pill me-2">{{ $stop->stop_sequence }}</span>
                            <strong>{{ $stop->order->customer_name }}</strong>
                        </div>
                        <span class="badge bg-{{ $stop->order->status == 'delivered' ? 'success' : 'warning' }}">{{ $stop->order->status }}</span>
                    </div>
                    <small class="text-muted d-block mt-1 ms-4"><i class="fa-solid fa-location-dot me-1"></i> {{ $stop->order->address }}</small>
                </li>
                @endforeach
            </ul>

            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-100"><i class="fa-solid fa-arrow-left me-2"></i> Back to Dashboard</a>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card p-3 h-100">
            <h5 class="mb-3">Interactive Route Map</h5>
            <div id="map" style="height: 600px; border-radius: 8px;"></div>
        </div>
    </div>
</div>
@endsection

@stack('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('map').setView([{{ $center->latitude }}, {{ $center->longitude }}], 13);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap &copy; CARTO'
    }).addTo(map);

    var center = @json($center);
    var stops = @json($route->routeStops->pluck('order'));

    // Center icon
    var centerIcon = L.divIcon({
        className: 'custom-div-icon',
        html: "<div style='background-color:#1a233a; width:18px; height:18px; border-radius:50%; border:3px solid white; box-shadow: 0 0 5px rgba(0,0,0,0.5);'></div>",
        iconSize: [18, 18]
    });

    var routeCoordinates = [];
    
    // Add center to route coords
    routeCoordinates.push([center.latitude, center.longitude]);

    L.marker([center.latitude, center.longitude], {icon: centerIcon})
        .addTo(map)
        .bindPopup("<b>" + center.name + "</b><br>START POINT");

    // Add stops to route coords and map
    stops.forEach(function(order, index) {
        var seq = index + 1;
        var stopIcon = L.divIcon({
            className: 'custom-div-icon',
            html: "<div style='background-color:#43e97b; color:#1a233a; font-weight:bold; font-size:10px; text-align:center; line-height:20px; width:20px; height:20px; border-radius:50%; border:2px solid white; box-shadow: 0 0 5px rgba(0,0,0,0.5);'>" + seq + "</div>",
            iconSize: [20, 20]
        });

        L.marker([order.latitude, order.longitude], {icon: stopIcon})
            .addTo(map)
            .bindPopup("<b>Stop " + seq + ": " + order.customer_name + "</b><br>" + order.address);
            
        routeCoordinates.push([order.latitude, order.longitude]);
    });

    // Draw Polyline
    var polyline = L.polyline(routeCoordinates, {
        color: '#667eea',
        weight: 4,
        opacity: 0.8,
        dashArray: '10, 10', lineCap: 'round'
    }).addTo(map);

    // Fit map to route bounds
    map.fitBounds(polyline.getBounds(), {padding: [50, 50]});
});
</script>
