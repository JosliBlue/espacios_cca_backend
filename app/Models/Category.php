<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name'
    ];

    // Workshops relationship
    public function workshops()
    {
        return $this->hasMany(Workshop::class, 'category_id');
    }

    // space reservation events relationship
    public function SpaceReservationEvents()
    {
        return $this->hasMany(SpaceReservation::class, 'category_id');
    }
}
