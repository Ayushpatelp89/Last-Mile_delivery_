<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => bcrypt('password'),
            'role' => 'manager',
        ]);

        $cities = [
            ['name' => 'Mumbai (Bandra Hub)', 'lat' => 19.0596, 'lng' => 72.8295],
            ['name' => 'Delhi (CP Hub)', 'lat' => 28.6304, 'lng' => 77.2177],
            ['name' => 'Bangalore (Koramangala Hub)', 'lat' => 12.9352, 'lng' => 77.6245],
            ['name' => 'Chennai (T. Nagar Hub)', 'lat' => 13.0418, 'lng' => 80.2341],
            ['name' => 'Hyderabad (HITEC City Hub)', 'lat' => 17.4435, 'lng' => 78.3772],
            ['name' => 'Pune (Hinjawadi Hub)', 'lat' => 18.5913, 'lng' => 73.7389],
        ];

        $centers = [];
        foreach ($cities as $city) {
            $centers[] = \App\Models\DeliveryCenter::create([
                'name' => $city['name'],
                'address' => 'Central Hub, ' . explode(' ', $city['name'])[0],
                'latitude' => $city['lat'],
                'longitude' => $city['lng'],
                'contact_number' => '1800-' . rand(100000, 999999)
            ]);
        }

        $vehicles = [];
        $drivers = [];
        for ($i = 1; $i <= 12; $i++) {
            $vehicle = \App\Models\Vehicle::create([
                'vehicle_number' => 'IND-' . rand(1000, 9999),
                'type' => $i % 3 == 0 ? 'Truck' : 'Van',
                'capacity' => $i % 3 == 0 ? 3000 : 1000,
                'fuel_type' => 'Diesel',
            ]);
            $vehicles[] = $vehicle;

            $drivers[] = \App\Models\Driver::create([
                'name' => 'Driver ' . $i,
                'phone' => '98765' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'vehicle_id' => $vehicle->id,
            ]);
        }

        // Generate 5-8 orders for each center
        foreach ($centers as $center) {
            $orderCount = rand(5, 8);
            for ($o = 1; $o <= $orderCount; $o++) {
                // Randomize coordinates slightly around the center
                $latOffset = (rand(-50, 50) / 1000);
                $lngOffset = (rand(-50, 50) / 1000);
                
                \App\Models\Order::create([
                    'customer_name' => 'Customer ' . $o . ' (' . explode(' ', $center->name)[0] . ')',
                    'address' => 'Local Address ' . $o . ', ' . explode(' ', $center->name)[0],
                    'latitude' => $center->latitude + $latOffset,
                    'longitude' => $center->longitude + $lngOffset,
                    'parcel_weight' => rand(1, 20),
                    'priority' => rand(1, 10) > 8 ? 'high' : 'normal',
                    'delivery_center_id' => $center->id,
                ]);
            }
        }
    }
}
