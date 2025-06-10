<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = [
        'name'
    ];

    // Workshops relationship
    public function workshops()
    {
        return $this->hasMany(Workshop::class, 'location_id');
    }

    // space reservation events relationship
    public function SpaceReservationEvents()
    {
        return $this->hasMany(SpaceReservation::class, 'location');
    }

    // Essays relationship
    public function Essays()
    {
        return $this->hasMany(Essay::class, 'location_id');
    }
}
