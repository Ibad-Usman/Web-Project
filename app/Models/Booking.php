<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'check_in_date',
        'check_out_date',
        'total_price',
        'status',
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    /**
     * Get the user who made the booking
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the property being booked
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get number of nights in booking
     */
    public function getNightsAttribute()
    {
        return $this->check_out_date->diffInDays($this->check_in_date);
    }

    /**
     * Check if booking is in past
     */
    public function isPast()
    {
        return $this->check_out_date->isPast();
    }

    /**
     * Check if booking is upcoming
     */
    public function isUpcoming()
    {
        return $this->check_in_date->isFuture();
    }

    /**
     * Check if booking is active (currently happening)
     */
    public function isActive()
    {
        return $this->check_in_date->isToday() || 
               ($this->check_in_date->isPast() && $this->check_out_date->isFuture());
    }
}