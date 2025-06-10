<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Essay extends Model
{
    use HasFactory;

    protected $table = 'essays';

    protected $fillable = [
        'name',
        'date',
        'start_time',
        'end_time',
        'location_id'
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
