<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'trip_id', 'booking_time', 'number_of_seat', 'total_amount', 'status',
    ];
    public function user()
        {
            return $this->belongsTo(User::class);
        }

    public function trip()
        {
            return $this->belongsTo(Trip::class);
        }

    public function seats()
        {
            return $this->belongsToMany(Seat::class, 'booking_seats');
        }

}
