<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CulturalCenter extends Model
{
    use HasFactory;
    protected $table = 'cultural_centers';
    public $timestamps = false;
    // Status constants
    public const STATUS_APPROVED = 'Approved';
    public const STATUS_REJECTED = 'Rejected';
    public const STATUS_PENDING = 'Pending';

    // Event type constants
    public const EVENT_FREE = 'Free';
    public const EVENT_PAID = 'Paid';

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
        'official_document_delivered',
        'event',
        'location',
        'category',
        'event_post'
    ];

    protected $casts = [
        'contract_reception_signed' => 'boolean',
        'reserved' => 'boolean',
        'agreement_signed' => 'boolean',
        'official_document_delivered' => 'boolean',
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
    public function eventPost()
    {
        return $this->belongsTo(EventPost::class, 'event_post');
    }
}
