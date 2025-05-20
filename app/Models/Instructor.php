<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $table = 'instructores';

    protected $fillable = [
        'nombre',
        'contacto'
    ];

    // Relación con talleres
    public function talleres()
    {
        return $this->hasMany(Taller::class, 'instructor_id');
    }
}
