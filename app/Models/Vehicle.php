<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['vehicle_number', 'type', 'capacity', 'fuel_type', 'status'];

    public function driver() {
        return $this->hasOne(Driver::class);
    }
}
