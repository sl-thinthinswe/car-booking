<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = ['license_plate','model','seat_count'];
    public function seats()
        {
            return $this->hasMany(Seat::class);
        }

    public function trips()
        {
            return $this->hasMany(Trip::class);
        }

}
