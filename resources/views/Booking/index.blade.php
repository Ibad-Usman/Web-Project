
@extends('layout')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
</head>
<body>

<h1>My Bookings</h1>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Property</th>
        <th>Payment Plan</th>
        <th>Down Payment</th>
        <th>Status</th>
    </tr>

    @foreach($bookings as $booking)

    <tr>
        <td>{{ $booking->id }}</td>
        <td>{{ $booking->property->title }}</td>
        <td>{{ $booking->payment_plan }}</td>
        <td>{{ $booking->down_payment }}</td>
        <td>{{ $booking->status }}</td>
    </tr>

    @endforeach

</table>

</body>
</html>
@endsection