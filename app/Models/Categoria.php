<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nombre'
    ];

    // Relación con talleres
    public function talleres()
    {
        return $this->hasMany(Taller::class, 'categoria_id');
    }

    // Relación con casa_cultura (eventos)
    public function eventosCasaCultura()
    {
        return $this->hasMany(CasaCultura::class, 'categoria');
    }
}
