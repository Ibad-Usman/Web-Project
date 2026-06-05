<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - Property Booking</title>
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
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .bookings-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .booking-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .booking-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .booking-details {
            flex: 1;
        }

        .booking-property-name {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .booking-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .info-item {
            font-size: 14px;
            color: #7f8c8d;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-badge.confirmed {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-badge.completed {
            background: #d4edda;
            color: #155724;
        }

        .status-badge.cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .booking-footer {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .booking-price {
            font-size: 18px;
            font-weight: 700;
            color: #667eea;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-view {
            background: #667eea;
            color: white;
        }

        .btn-edit {
            background: #3498db;
            color: white;
        }

        .btn-cancel {
            background: #e74c3c;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 60px 30px;
            background: white;
            border-radius: 10px;
            color: #7f8c8d;
        }

        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .navbar { padding: 0 15px; }
            .nav-links { gap: 15px; }
            .container { padding: 0 15px; }
            .booking-info { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('dashboard') }}" class="navbar-brand">PropertyBook</a>
        <ul class="nav-links">
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('properties.index') }}">Properties</a></li>
            <li><a href="{{ route('bookings.index') }}" class="active">My Bookings</a></li>
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
            <h1>My Bookings 📅</h1>
            <p>Manage and track your property bookings</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if($bookings->count() > 0)
            <div class="bookings-list">
                @foreach($bookings as $booking)
                <div class="booking-card">
                    <div class="booking-details">
                        <div class="booking-property-name">{{ $booking->property->name }}</div>
                        <div class="booking-info">
                            <div class="info-item">📍 <strong>Location:</strong> {{ $booking->property->location }}</div>
                            <div class="info-item">📅 <strong>Check-in:</strong> {{ $booking->check_in_date->format('M d, Y') }}</div>
                            <div class="info-item">📅 <strong>Check-out:</strong> {{ $booking->check_out_date->format('M d, Y') }}</div>
                            <div class="info-item">🌙 <strong>Nights:</strong> {{ $booking->nights }}</div>
                        </div>
                    </div>

                    <div class="booking-footer">
                        <span class="status-badge {{ $booking->status }}">{{ $booking->status }}</span>
                        <div class="booking-price">${{ number_format($booking->total_price, 2) }}</div>
                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-view">View</a>
                        
                        @if($booking->status === 'pending')
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-edit">Edit</a>
                            <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-cancel" onclick="return confirm('Cancel this booking?')">Cancel</button>
                            </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <p>You haven't made any bookings yet.</p>
                <a href="{{ route('properties.index') }}" style="display: inline-block; margin-top: 20px; padding: 12px 25px; background: #667eea; color: white; text-decoration: none; border-radius: 5px;">Browse Properties</a>
            </div>
        @endif
    </div>
</body>
</html>