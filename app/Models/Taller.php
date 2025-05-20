<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;

    protected $table = 'talleres';

    protected $fillable = [
        'nombre',
        'costo_mensual',
        'edad',
        'dias_de_clase',
        'horario_maniana',
        'horario_tarde',
        'instructor_id',
        'lugar_id',
        'categoria_id'
    ];

    protected $casts = [
        'costo_mensual' => 'float',
        'horario_maniana' => 'datetime:H:i',
        'horario_tarde' => 'datetime:H:i'
    ];

    // Relación con instructor
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }

    // Relación con localización
    public function lugar()
    {
        return $this->belongsTo(Localizacion::class, 'lugar_id');
    }

    // Relación con categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
