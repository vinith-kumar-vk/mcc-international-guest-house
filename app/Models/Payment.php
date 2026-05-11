<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'txnid',
        'payu_id',
        'amount',
        'currency',
        'status',
        'payment_mode',
        'error_message',
        'raw_response'
    ];

    protected $casts = [
        'raw_response' => 'array'
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
