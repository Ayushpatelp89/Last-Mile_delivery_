<?php

namespace App\Services;

use App\Models\DeliveryCenter;
use App\Models\Order;

class RouteOptimizationService
{
    /**
     * Known high-traffic / rush zones in Indian cities
     */
    private $rushZones = [
        ['name' => 'Mumbai Suburbs', 'lat' => 19.0596, 'lng' => 72.8295, 'radius_km' => 10, 'multiplier' => 1.8],
        ['name' => 'Delhi Central', 'lat' => 28.6304, 'lng' => 77.2177, 'radius_km' => 15, 'multiplier' => 2.0],
        ['name' => 'Bangalore IT Corridor', 'lat' => 12.9352, 'lng' => 77.6245, 'radius_km' => 12, 'multiplier' => 2.5],
        ['name' => 'Chennai Core', 'lat' => 13.0418, 'lng' => 80.2341, 'radius_km' => 8, 'multiplier' => 1.5],
    ];

    /**
     * Optimize delivery route using Nearest Neighbor Algorithm.
     * Incorporates a simulated traffic/climate multiplier.
     * 
     * @param DeliveryCenter $center
     * @param \Illuminate\Support\Collection $orders
     * @return array
     */
    public function optimizeRoute(DeliveryCenter $center, $orders)
    {
        $unvisited = collect($orders->toArray());
        $route = [];
        $currentLocation = [
            'latitude' => $center->latitude,
            'longitude' => $center->longitude
        ];
        
        $totalDistance = 0;
        $totalTimeMinutes = 0;

        while ($unvisited->isNotEmpty()) {
            $nearest = null;
            $shortestDistance = PHP_INT_MAX;
            $nearestKey = null;

            foreach ($unvisited as $key => $order) {
                $distance = $this->calculateDistance(
                    $currentLocation['latitude'], 
                    $currentLocation['longitude'], 
                    $order['latitude'], 
                    $order['longitude']
                );

                if ($distance < $shortestDistance) {
                    $shortestDistance = $distance;
                    $nearest = $order;
                    $nearestKey = $key;
                }
            }

            if ($nearest) {
                $route[] = $nearest;
                $totalDistance += $shortestDistance;
                
                // Calculate time with traffic multiplier
                $trafficMultiplier = $this->getTrafficMultiplier($nearest['latitude'], $nearest['longitude']);
                
                // Base speed 40km/h (which is 0.66 km per minute)
                $travelTime = ($shortestDistance / 40) * 60;
                $penalizedTime = $travelTime * $trafficMultiplier;
                
                // Add 10 mins per stop for delivery
                $totalTimeMinutes += $penalizedTime + 10;

                $currentLocation = [
                    'latitude' => $nearest['latitude'],
                    'longitude' => $nearest['longitude']
                ];
                $unvisited->forget($nearestKey);
            }
        }

        return [
            'route' => $route,
            'total_distance_km' => round($totalDistance, 2),
            'estimated_time_minutes' => round($totalTimeMinutes)
        ];
    }

    /**
     * Check if a location falls within a known rush zone and apply penalty.
     */
    private function getTrafficMultiplier($lat, $lng)
    {
        $maxMultiplier = 1.0;
        foreach ($this->rushZones as $zone) {
            $distanceToZone = $this->calculateDistance($lat, $lng, $zone['lat'], $zone['lng']);
            if ($distanceToZone <= $zone['radius_km']) {
                if ($zone['multiplier'] > $maxMultiplier) {
                    $maxMultiplier = $zone['multiplier'];
                }
            }
        }
        
        // Add random climate factor (1.0 to 1.3) to simulate sudden weather changes
        $climateFactor = rand(10, 13) / 10;
        
        return $maxMultiplier * $climateFactor;
    }

    /**
     * Calculate Haversine Distance in KM
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
            
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
    }
}
