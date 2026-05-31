@extends('layout')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Properties</title>
</head>
<body>

<h1>Available Properties</h1>

@foreach($properties as $property)

<div style="border:1px solid black;padding:15px;margin:15px;">

    <h3>{{ $property->title }}</h3>

    <p>Location: {{ $property->location }}</p>

    <p>Price: {{ $property->price }}</p>

    <p>Size: {{ $property->size }}</p>

    <a href="/properties/{{ $property->id }}">
        View Details
    </a>

</div>

@endforeach

</body>
</html>
@endsection