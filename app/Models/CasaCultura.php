<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasaCultura extends Model
{
    use HasFactory;
    protected $table = 'casa_cultura';
    public $timestamps = false;
    // Constantes para estado
    public const ESTADO_APROBADO = 'Aprobado';
    public const ESTADO_RECHAZADO = 'Rechazado';
    public const ESTADO_PENDIENTE = 'Pendiente';

    // Constantes para tipo de evento
    public const EVENTO_GRATUITO = 'Gratuito';
    public const EVENTO_PAGADO = 'Pagado';


    protected $fillable = [
        'nombre',
        'fecha',
        'horario_inicio',
        'horario_fin',
        'persona_responsable',
        'persona_responsable_telefono',
        'firma_contrato_recepcion',
        'reservado',
        'estado',
        'convenio_firmado',
        'entrega_oficio',
        'evento',
        'lugar',
        'categoria',
        'post_evento'
    ];

    protected $casts = [
        'firma_contrato_recepcion' => 'boolean',
        'reservado' => 'boolean',
        'convenio_firmado' => 'boolean',
        'entrega_oficio' => 'boolean',
        'fecha' => 'date',
        'horario_inicio' => 'datetime:H:i',
        'horario_fin' => 'datetime:H:i'
    ];

    // Relación con categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria');
    }

    // Relación con localización
    public function lugar()
    {
        return $this->belongsTo(Localizacion::class, 'lugar');
    }

    // Relación con post_evento
    public function postEvento()
    {
        return $this->belongsTo(PostEvento::class, 'post_evento');
    }
}
