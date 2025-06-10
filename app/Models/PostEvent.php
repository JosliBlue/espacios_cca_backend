<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostEvent extends Model
{
    use HasFactory;

    protected $table = 'post_events';

    protected $fillable = [
        'children_attended',
        'youth_attended',
        'adults_attended'
    ];

    protected $casts = [
        'children_attended' => 'integer',
        'youth_attended' => 'integer',
        'adults_attended' => 'integer',
        'total_attendees' => 'integer'
    ];

    // space reservation relationship
    public function SpaceReservation()
    {
        return $this->hasOne(SpaceReservation::class, 'event_post');
    }
}
