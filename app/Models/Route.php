<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['driver_id', 'vehicle_id', 'date', 'total_distance', 'estimated_time', 'status'];

    public function driver() {
        return $this->belongsTo(Driver::class);
    }
    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
    public function routeStops() {
        return $this->hasMany(RouteStop::class)->orderBy('stop_sequence');
    }
}
