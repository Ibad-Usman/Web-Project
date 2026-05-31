<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BookingController extends Controller
{
    public function create($id)
    {
        $property = Property::findOrFail($id);

        return view('booking.create', compact('property'));
    }
    public function index()
{
    $bookings = Booking::with('property')
        ->where('user_id', Auth::id())
        ->get();

    return view('booking.index', compact('bookings'));
}

    public function store(Request $request)
    {
        Booking::create([
            'user_id' => Auth::id(),
            'property_id' => $request->property_id,
            'down_payment' => $request->down_payment,
            'payment_plan' => $request->payment_plan,
            'status' => 'Pending'
        ]);

        return redirect('/properties')
            ->with('success', 'Booking Submitted Successfully');
    }
}