<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    protected $fillable = ['vehicle_id', 'seat_number'];

    public function vehicle()
        {
            return $this->belongsTo(Vehicle::class);
        }
}
