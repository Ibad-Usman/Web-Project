<!DOCTYPE html>
<html>
<head>
    <title>Property Details</title>
</head>
<body>

<h1>{{ $property->title }}</h1>

<p>Location: {{ $property->location }}</p>

<p>Price: {{ $property->price }}</p>

<p>Size: {{ $property->size }}</p>

<p>{{ $property->description }}</p>

<a href="/book/{{ $property->id }}">
    Book Property
</a>

</body>
</html>