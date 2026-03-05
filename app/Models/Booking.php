<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'gst_id', 'room_name', 'booking_date', 
        'start_time', 'end_time', 'total_price', 'razorpay_order_id', 
        'razorpay_payment_id', 'payment_status'
    ];
}
