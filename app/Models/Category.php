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

    // Cultural center events relationship
    public function culturalCenterEvents()
    {
        return $this->hasMany(CulturalCenter::class, 'category');
    }
}
