<!DOCTYPE html>
<html>
<head>
    <title>Book Property</title>
</head>
<body>

<h1>Book Property</h1>

<h2>{{ $property->title }}</h2>

<p>Location: {{ $property->location }}</p>

<p>Price: {{ $property->price }}</p>

<form method="POST" action="/book">

    @csrf

    <input type="hidden"
           name="property_id"
           value="{{ $property->id }}">

    <label>Down Payment</label>

    <input type="number"
           name="down_payment"
           required>

    <br><br>

    <label>Payment Plan</label>

    <select name="payment_plan">

        <option>Monthly</option>

        <option>Quarterly</option>

        <option>Yearly</option>

    </select>

    <br><br>

    <button type="submit">
        Submit Booking
    </button>

</form>

</body>
</html>