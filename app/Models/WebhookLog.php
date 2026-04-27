<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebhookLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'endpoint_id', 
        'event', 
        'payload', 
        'response_status', 
        'response_body', 
        'retry_count', 
        'error'
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function endpoint()
    {
        return $this->belongsTo(WebhookEndpoint::class, 'endpoint_id');
    }
}
