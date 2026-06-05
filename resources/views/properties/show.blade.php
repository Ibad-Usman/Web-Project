<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->name }} - Property Details</title>
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

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .property-header {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .property-image {
            width: 100%;
            height: 400px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 100px;
        }

        .property-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .property-info {
            padding: 30px;
        }

        .property-title {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .property-meta {
            display: flex;
            gap: 30px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .meta-item {
            font-size: 16px;
            color: #7f8c8d;
        }

        .meta-item.price {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
        }

        .content-wrapper {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .description-section,
        .booking-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-size: 22px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .description-text {
            line-height: 1.8;
            color: #555;
        }

        .booking-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .price-summary {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            border-left: 3px solid #667eea;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .price-row.total {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-weight: 700;
            color: #667eea;
        }

        .book-btn {
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .book-btn:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .navbar { padding: 0 15px; }
            .nav-links { gap: 15px; }
            .container { padding: 0 15px; }
            .content-wrapper { grid-template-columns: 1fr; }
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
        <a href="{{ route('properties.index') }}" class="back-link">← Back to Properties</a>

        <div class="property-header">
            <div class="property-image">
                @if($property->image_url)
                    <img src="{{ $property->image_url }}" alt="{{ $property->name }}">
                @else
                    🏠
                @endif
            </div>
            <div class="property-info">
                <div class="property-title">{{ $property->name }}</div>
                <div class="property-meta">
                    <div class="meta-item">📍 {{ $property->location }}</div>
                    <div class="meta-item price">${{ number_format($property->price_per_night, 2) }}/night</div>
                </div>
            </div>
        </div>

        <div class="content-wrapper">
            <div class="description-section">
                <h2 class="section-title">About this property</h2>
                <p class="description-text">{{ $property->description }}</p>
            </div>

            <div class="booking-section">
                <h2 class="section-title">Book This Property</h2>
                
                @if($errors->any())
                    <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                        <ul style="margin-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('bookings.store') }}" class="booking-form">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">

                    <div class="form-group">
                        <label for="check_in_date">Check-in Date</label>
                        <input type="date" id="check_in_date" name="check_in_date" min="{{ now()->toDateString() }}" required>
                    </div>

                    <div class="form-group">
                        <label for="check_out_date">Check-out Date</label>
                        <input type="date" id="check_out_date" name="check_out_date" min="{{ now()->toDateString() }}" required>
                    </div>

                    <div class="price-summary">
                        <div class="price-row">
                            <span>Nightly rate:</span>
                            <span>${{ number_format($property->price_per_night, 2) }}</span>
                        </div>
                        <div class="price-row">
                            <span id="nights-text">0 nights:</span>
                            <span id="nights-price">$0.00</span>
                        </div>
                        <div class="price-row total">
                            <span>Total Price:</span>
                            <span id="total-price">$0.00</span>
                        </div>
                    </div>

                    <button type="submit" class="book-btn">Book Now</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const checkInInput = document.getElementById('check_in_date');
        const checkOutInput = document.getElementById('check_out_date');
        const pricePerNight = {{ $property->price_per_night }};

        function calculatePrice() {
            if (checkInInput.value && checkOutInput.value) {
                const checkIn = new Date(checkInInput.value);
                const checkOut = new Date(checkOutInput.value);
                const nights = Math.max(0, Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24)));

                if (nights > 0) {
                    const nightsTotal = nights * pricePerNight;
                    document.getElementById('nights-text').textContent = nights + ' night(s):';
                    document.getElementById('nights-price').textContent = '$' + nightsTotal.toFixed(2);
                    document.getElementById('total-price').textContent = '$' + nightsTotal.toFixed(2);
                }
            }
        }

        checkInInput.addEventListener('change', calculatePrice);
        checkOutInput.addEventListener('change', calculatePrice);
        checkInInput.addEventListener('change', function() { checkOutInput.min = this.value; });
    </script>
</body>
</html>