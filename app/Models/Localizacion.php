<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localizacion extends Model
{
    use HasFactory;

    protected $table = 'localizaciones';

    protected $fillable = [
        'nombre'
    ];

    // Relación con talleres
    public function talleres()
    {
        return $this->hasMany(Taller::class, 'lugar_id');
    }

    // Relación con casa_cultura
    public function eventosCasaCultura()
    {
        return $this->hasMany(CasaCultura::class, 'lugar');
    }

    // Relación con ensayos
    public function ensayos()
    {
        return $this->hasMany(Ensayo::class, 'lugar_id');
    }
}
