<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $table = 'workshops';

    protected $fillable = [
        'name',
        'monthly_cost',
        'age',
        'class_days',
        'morning_schedule',
        'afternoon_schedule',
        'instructor_id',
        'location_id',
        'category_id'
    ];

    protected $casts = [
        'monthly_cost' => 'float',
        'morning_schedule' => 'datetime:H:i',
        'afternoon_schedule' => 'datetime:H:i'
    ];

    // Instructor relationship
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }

    // Location relationship
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    // Category relationship
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
