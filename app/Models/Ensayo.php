<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ensayo extends Model
{
    use HasFactory;

    protected $table = 'ensayos';

    protected $fillable = [
        'nombre',
        'lugar_id',
        'fecha',
        'horario_inicio',
        'horario_fin'
    ];

    protected $casts = [
        'fecha' => 'date',
        'horario_inicio' => 'datetime:H:i',
        'horario_fin' => 'datetime:H:i'
    ];

    // Relación con localización
    public function lugar()
    {
        return $this->belongsTo(Localizacion::class, 'lugar_id');
    }
}
