<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPost extends Model
{
    use HasFactory;

    protected $table = 'event_posts';

    protected $fillable = [
        'children_attended',
        'youth_attended',
        'adults_attended'
    ];

    // Cultural center relationship
    public function culturalCenter()
    {
        return $this->hasOne(CulturalCenter::class, 'event_post');
    }
}
