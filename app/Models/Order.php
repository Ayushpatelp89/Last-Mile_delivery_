<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_name', 'address', 'latitude', 'longitude', 'parcel_weight', 'priority', 'delivery_time_window', 'status', 'delivery_center_id'];

    public function deliveryCenter() {
        return $this->belongsTo(DeliveryCenter::class);
    }
}
