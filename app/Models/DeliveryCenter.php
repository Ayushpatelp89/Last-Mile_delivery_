<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryCenter extends Model
{
    protected $fillable = ['name', 'address', 'latitude', 'longitude', 'contact_number'];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
