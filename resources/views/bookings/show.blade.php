<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
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

        .booking-header {
            background: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .booking-title {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .booking-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
        }

        .meta-label {
            color: #7f8c8d;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .meta-value {
            font-size: 16px;
            font-weight: 700;
            color: #2c3e50;
            margin-top: 5px;
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

        .details-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        .detail-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            border-bottom: 2px solid #f0f2f7;
            padding-bottom: 15px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #f0f2f7;
        }

        .detail-label {
            color: #7f8c8d;
            font-weight: 500;
        }

        .detail-value {
            color: #2c3e50;
            font-weight: 700;
        }

        .price-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border-left: 3px solid #667eea;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .price-row.total {
            border-top: 1px solid #ddd;
            padding-top: 12px;
            font-weight: 700;
            color: #667eea;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-edit {
            background: #3498db;
            color: white;
        }

        .btn-edit:hover {
            background: #2980b9;
        }

        .btn-cancel {
            background: #e74c3c;
            color: white;
        }

        @media (max-width: 768px) {
            .navbar { padding: 0 15px; }
            .nav-links { gap: 15px; }
            .container { padding: 0 15px; }
            .details-grid { grid-template-columns: 1fr; }
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
        <a href="{{ route('bookings.index') }}" class="back-link">← Back to My Bookings</a>

        <div class="booking-header">
            <div class="booking-title">{{ $booking->property->name }}</div>
            <div class="booking-meta">
                <div class="meta-item">
                    <div class="meta-label">Booking ID</div>
                    <div class="meta-value">#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</div>
                </div>
                <div class="meta-item">
                    <div class="meta-label">Status</div>
                    <div style="margin-top: 5px;">
                        <span class="status-badge {{ $booking->status }}">{{ $booking->status }}</span>
                    </div>
                </div>
                <div class="meta-item">
                    <div class="meta-label">Location</div>
                    <div class="meta-value">{{ $booking->property->location }}</div>
                </div>
            </div>
        </div>

        <div class="details-grid">
            <div class="detail-section">
                <h2 class="section-title">Booking Details</h2>

                <div class="detail-item">
                    <span class="detail-label">Check-in Date</span>
                    <span class="detail-value">{{ $booking->check_in_date->format('M d, Y') }}</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Check-out Date</span>
                    <span class="detail-value">{{ $booking->check_out_date->format('M d, Y') }}</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Number of Nights</span>
                    <span class="detail-value">{{ $booking->nights }}</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Price per Night</span>
                    <span class="detail-value">${{ number_format($booking->property->price_per_night, 2) }}</span>
                </div>

                <div class="action-buttons">
                    @if($booking->status === 'pending')
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-edit">Edit Booking</a>
                        <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}" style="flex: 1;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-cancel" style="width: 100%;" onclick="return confirm('Cancel this booking?')">Cancel Booking</button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="detail-section">
                <h2 class="section-title">Price Summary</h2>

                <div class="price-summary">
                    <div class="price-row">
                        <span>{{ $booking->nights }} nights × ${{ number_format($booking->property->price_per_night, 2) }}</span>
                        <span>${{ number_format($booking->total_price, 2) }}</span>
                    </div>
                    <div class="price-row total">
                        <span>Total Amount</span>
                        <span>${{ number_format($booking->total_price, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>