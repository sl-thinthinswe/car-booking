<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSeat extends Model
{
    use HasFactory;
    public function booking()
        {
            return $this->belongsTo(Booking::class);
        }

    public function seat()
        {
            return $this->belongsTo(Seat::class);
        }

    public function trip()
        {
            return $this->belongsTo(Trip::class);
        }

}
