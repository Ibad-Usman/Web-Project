@extends('layout')

@section('content')

<h1>Customer Dashboard</h1>

<div>
    <h3>Total Bookings: {{ $totalBookings }}</h3>
    <h3>Pending: {{ $pendingBookings }}</h3>
    <h3>Approved: {{ $approvedBookings }}</h3>
    <form method="POST" action="{{ route('logout') }}" class="inline">
    @csrf
    <button type="submit" class="px-3 py-2 text-red-600">
        Logout
    </button>
</form>
</div>

@endsection