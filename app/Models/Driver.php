<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['name', 'phone', 'vehicle_id', 'availability_status'];

    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
}
