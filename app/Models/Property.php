<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'price_per_night',
        'rating',
        'image_url',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
        'rating' => 'decimal:2',
    ];

    /**
     * Get all bookings for this property
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Check if property is available for given dates
     */
    public function isAvailable($checkInDate, $checkOutDate)
    {
        return !$this->bookings()
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                    ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                    ->orWhere(function ($q) use ($checkInDate, $checkOutDate) {
                        $q->where('check_in_date', '<=', $checkInDate)
                            ->where('check_out_date', '>=', $checkOutDate);
                    });
            })
            ->exists();
    }

    /**
     * Calculate total price for stay
     */
    public function calculateTotalPrice($checkInDate, $checkOutDate)
    {
        $nights = \Carbon\Carbon::parse($checkOutDate)->diffInDays(\Carbon\Carbon::parse($checkInDate));
        return $nights * $this->price_per_night;
    }
}