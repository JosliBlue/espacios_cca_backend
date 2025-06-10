<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceReservation extends Model
{
    use HasFactory;
    protected $table = 'space_reservations';
    public $timestamps = false;
    // Status constants
    public const STATUS_APPROVED = 'Aprobado';
    public const STATUS_REJECTED = 'Rechazado';
    public const STATUS_PENDING = 'Pendiente';

    // Event type constants
    public const EVENT_FREE = 'Gratuito';
    public const EVENT_PAID = 'Pagado';

    protected $fillable = [
        'name',
        'date',
        'start_time',
        'end_time',
        'responsible_person',
        'responsible_person_phone',
        'contract_reception_signed',
        'reserved',
        'status',
        'agreement_signed',
        'delivery_document',
        'event',
        'location',
        'category',
        'event_post'
    ];

    protected $casts = [
        'contract_reception_signed' => 'boolean',
        'reserved' => 'boolean',
        'agreement_signed' => 'boolean',
        'delivery_document' => 'boolean',
        'date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i'
    ];

    // Category relationship
    public function category()
    {
        return $this->belongsTo(Category::class, 'category');
    }

    // Location relationship
    public function location()
    {
        return $this->belongsTo(Location::class, 'location');
    }

    // Event post relationship
    public function postEvent()
    {
        return $this->belongsTo(PostEvent::class, 'event_post');
    }
}
