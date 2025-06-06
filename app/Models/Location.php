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

    // Cultural center events relationship
    public function culturalCenterEvents()
    {
        return $this->hasMany(CulturalCenter::class, 'location');
    }

    // Rehearsals relationship
    public function rehearsals()
    {
        return $this->hasMany(Rehearsal::class, 'location_id');
    }
}
