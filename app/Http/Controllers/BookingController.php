<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of user's bookings
     */
    public function index()
    {
        $bookings = auth()->user()->bookings()
            ->with('property')
            ->orderBy('check_in_date', 'desc')
            ->paginate(10);
        
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking
     */
    public function create($property_id)
    {
        $property = Property::findOrFail($property_id);
        
        return view('bookings.create', compact('property'));
    }

    /**
     * Store a newly created booking
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ], [
            'check_in_date.after_or_equal' => 'Check-in date must be today or later',
            'check_out_date.after' => 'Check-out date must be after check-in date',
        ]);

        $property = Property::findOrFail($validated['property_id']);
        $checkInDate = Carbon::parse($validated['check_in_date']);
        $checkOutDate = Carbon::parse($validated['check_out_date']);

        // Check availability
        if (!$property->isAvailable($checkInDate, $checkOutDate)) {
            return back()->with('error', 'Property is not available for selected dates.');
        }

        // Calculate total price
        $totalPrice = $property->calculateTotalPrice($checkInDate, $checkOutDate);

        // Create booking
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'property_id' => $property->id,
            'check_in_date' => $checkInDate,
            'check_out_date' => $checkOutDate,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking created successfully! Status: Pending');
    }

    /**
     * Display the specified booking
     */
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Ensure user can only view their own bookings
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified booking
     */
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Only allow editing pending bookings
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Can only edit pending bookings');
        }
        
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified booking
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Only allow editing pending bookings
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Can only edit pending bookings');
        }

        $validated = $request->validate([
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        $checkInDate = Carbon::parse($validated['check_in_date']);
        $checkOutDate = Carbon::parse($validated['check_out_date']);

        // Check availability (excluding current booking)
        $property = $booking->property;
        $isAvailable = !$property->bookings()
            ->where('id', '!=', $booking->id)
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

        if (!$isAvailable) {
            return back()->with('error', 'Property is not available for selected dates.');
        }

        // Recalculate total price
        $totalPrice = $property->calculateTotalPrice($checkInDate, $checkOutDate);

        $booking->update([
            'check_in_date' => $checkInDate,
            'check_out_date' => $checkOutDate,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking updated successfully!');
    }

    /**
     * Cancel the specified booking
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Only allow cancelling pending/confirmed bookings
        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return back()->with('error', 'Cannot cancel completed or already cancelled bookings');
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking cancelled successfully!');
    }
}