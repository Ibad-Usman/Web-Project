<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
   public function user()
{
    return $this->belongsTo(User::class);
}

public function property()
{
    return $this->belongsTo(Property::class);
}
    protected $fillable = [
        'user_id',
        'property_id',
        'down_payment',
        'payment_plan',
        'status'
    ];

    protected $casts = [
        'down_payment' => 'decimal:2',
    ];

    protected $attributes = [
        'status' => 'Pending',
    ];
}