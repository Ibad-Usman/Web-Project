<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Properties - Property Booking</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #666;
            font-weight: 500;
            transition: color 0.3s;
            padding: 8px 12px;
            border-radius: 5px;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #667eea;
            background: #f0f2f7;
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logout-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 30px;
        }

        .page-header {
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .page-header p {
            color: #7f8c8d;
            font-size: 16px;
        }

        .properties-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .property-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .property-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 60px;
            overflow: hidden;
        }

        .property-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .property-body {
            padding: 20px;
        }

        .property-name {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .property-location {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .property-price {
            font-size: 20px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 15px;
        }

        .property-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.2s;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .property-btn:hover {
            transform: translateY(-2px);
        }

        .empty-state {
            text-align: center;
            padding: 60px 30px;
            background: white;
            border-radius: 10px;
            color: #7f8c8d;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 40px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #667eea;
        }

        @media (max-width: 768px) {
            .navbar { padding: 0 15px; }
            .nav-links { gap: 15px; }
            .container { padding: 0 15px; }
            .properties-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('dashboard') }}" class="navbar-brand">PropertyBook</a>
        <ul class="nav-links">
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('properties.index') }}" class="active">Properties</a></li>
            <li><a href="{{ route('bookings.index') }}">My Bookings</a></li>
            <li><a href="{{ route('profile.edit') }}">Profile</a></li>
        </ul>
        <div class="nav-user">
            <span style="color: #666;">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1>Browse Properties 🏠</h1>
            <p>Find and book your perfect stay</p>
        </div>

        @if($properties->count() > 0)
            <div class="properties-grid">
                @foreach($properties as $property)
                <div class="property-card">
                    <div class="property-image">
                        @if($property->image_url)
                            <img src="{{ $property->image_url }}" alt="{{ $property->name }}">
                        @else
                            🏠
                        @endif
                    </div>
                    <div class="property-body">
                        <div class="property-name">{{ $property->name }}</div>
                        <div class="property-location">📍 {{ $property->location }}</div>
                        <div class="property-price">${{ number_format($property->price_per_night, 2) }}/night</div>
                        <a href="{{ route('properties.show', $property->id) }}" class="property-btn">View & Book</a>
                    </div>
                </div>
                @endforeach
            </div>

            @if($properties->hasPages())
            <div class="pagination">
                {{ $properties->links() }}
            </div>
            @endif
        @else
            <div class="empty-state">
                <p>No properties found.</p>
            </div>
        @endif
    </div>
</body>
</html>