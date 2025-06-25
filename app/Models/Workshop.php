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
        'age_range',
        'instructor_id',
        'location_id',
        'category_id',
        'deleted'
    ];

    protected $casts = [
        'monthly_cost' => 'float',
        'deleted' => 'boolean'
    ];

    // Atributos por defecto
    protected $attributes = [
        'deleted' => false
    ];

    // Scope para obtener solo talleres no eliminados
    public function scopeNotDeleted($query)
    {
        return $query->where('deleted', false);
    }

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

    // Workshop schedules relationship
    public function schedules()
    {
        return $this->hasMany(WorkshopSchedule::class);
    }
}
