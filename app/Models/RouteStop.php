<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteStop extends Model
{
    protected $fillable = ['route_id', 'order_id', 'stop_sequence', 'estimated_arrival_time', 'status'];

    public function route() {
        return $this->belongsTo(Route::class);
    }
    public function order() {
        return $this->belongsTo(Order::class);
    }
}
