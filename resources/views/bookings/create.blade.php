<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Property</title>
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

        .nav-links a:hover {
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
        }

        .container {
            max-width: 900px;
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

        .form-card {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-title {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
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

        .property-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
            border-left: 3px solid #667eea;
        }

        .property-info h3 {
            color: #2c3e50;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .property-info p {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .price-preview {
            background: #f0f2f7;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
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

        .form-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            flex: 1;
            min-width: 150px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-cancel {
            background: #e9ecef;
            color: #666;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .navbar { padding: 0 15px; }
            .nav-links { gap: 15px; }
            .container { padding: 0 15px; }
            .form-card { padding: 25px; }
            .form-actions { flex-direction: column; }
            .btn { width: 100%; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('dashboard') }}" class="navbar-brand">PropertyBook</a>
        <ul class="nav-links">
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('properties.index') }}">Properties</a></li>
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
        <a href="{{ route('properties.show', $property->id) }}" class="back-link">← Back to Property</a>

        <div class="form-card">
            <h1 class="form-title">Complete Your Booking</h1>

            @if($errors->any())
                <div class="alert-error">
                    <ul style="margin-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="property-info">
                <h3>{{ $property->name }}</h3>
                <p>📍 {{ $property->location }}</p>
                <p>💰 ${{ number_format($property->price_per_night, 2) }} per night</p>
            </div>

            <form method="POST" action="{{ route('bookings.store') }}">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">

                <div class="form-group">
                    <label for="check_in_date">Check-in Date</label>
                    <input type="date" id="check_in_date" name="check_in_date" value="{{ old('check_in_date') }}" min="{{ now()->toDateString() }}" required>
                </div>

                <div class="form-group">
                    <label for="check_out_date">Check-out Date</label>
                    <input type="date" id="check_out_date" name="check_out_date" value="{{ old('check_out_date') }}" min="{{ now()->toDateString() }}" required>
                </div>

                <div class="price-preview">
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

                <div class="form-actions">
                    <button type="submit" class="btn btn-submit">Complete Booking</button>
                    <a href="{{ route('properties.show', $property->id) }}" class="btn btn-cancel">Cancel</a>
                </div>
            </form>
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