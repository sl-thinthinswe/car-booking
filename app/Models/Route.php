<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $fillable = ['departure_id', 'arrival_id', 'duration', 'distance_km'];

    public function departure()
    {
        return $this->belongsTo(City::class, 'departure_id');
    }

    public function arrival()
    {
        return $this->belongsTo(City::class, 'arrival_id');
    }

    public function trips()
        {
            return $this->hasMany(Trip::class);
        }

}
