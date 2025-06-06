<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $table = 'instructors';

    protected $fillable = [
        'name',
        'contact'
    ];

    // Workshops relationship
    public function workshops()
    {
        return $this->hasMany(Workshop::class, 'instructor_id');
    }
}
