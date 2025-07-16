<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $fillable = ['route_id', 'vehicle_id', 'departure_time', 'price_per_seat'];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function getRouteNameAttribute()
    {
        $from = $this->route?->departure?->name;
        $to = $this->route?->arrival?->name;

        return $from && $to ? "$from → $to" : 'N/A';
    }

}
