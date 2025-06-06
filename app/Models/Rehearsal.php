<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rehearsal extends Model
{
    use HasFactory;

    protected $table = 'rehearsals';

    protected $fillable = [
        'name',
        'location_id',
        'date',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i'
    ];

    // Location relationship
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
