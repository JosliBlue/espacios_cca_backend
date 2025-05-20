<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostEvento extends Model
{
    use HasFactory;

    protected $table = 'post_eventos';

    protected $fillable = [
        'infantes_asistido',
        'jovenes_asistidos',
        'adultos_asistidos'
    ];

    // Relación con casa_cultura
    public function casaCultura()
    {
        return $this->hasOne(CasaCultura::class, 'post_evento');
    }
}
