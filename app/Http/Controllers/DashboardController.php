<?php

namespace App\Http\Controllers;

use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();

        $pendingBookings = Booking::where('status', 'Pending')->count();

        $approvedBookings = Booking::where('status', 'Approved')->count();

        $bookings = Booking::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'approvedBookings',
            'bookings'
        ));
    }
}