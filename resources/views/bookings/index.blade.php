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
            margin-bottom: 30px;
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
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .booking-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .booking-details {
            flex: 1;
            min-width: 300px;
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
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-item strong {
            color: #333;
        }

        .booking-footer {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
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

        .booking-price {
            font-size: 18px;
            font-weight: 700;
            color: #667eea;
            padding: 10px 15px;
            background: #f0f2f7;
            border-radius: 5px;
            min-width: 120px;
            text-align: right;
        }

        .btn-action {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-view {
            background: #667eea;
            color: white;
        }

        .btn-view:hover {
            background: #5568d3;
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
            border: none;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background: #c0392b;
        }

        .empty-state {
            text-align: center;
            padding: 60px 30px;
            background: white;
            border-radius: 10px;
            color: #7f8c8d;
            margin-top: 30px;
        }

        .empty-state-icon {
            font-size: 60px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state-btn {
            margin-top: 20px;
        }

        .empty-state-btn a {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s;
        }

        .empty-state-btn a:hover {
            transform: translateY(-2px);
        }

        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #667eea;
            font-weight: 600;
        }

        .pagination a:hover {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .pagination .active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0 15px;
            }

            .nav-links {
                gap: 15px;
            }

            .container {
                padding: 0 15px;
            }

            .booking-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .booking-footer {
                width: 100%;
            }

            .booking-price {
                width: 100%;
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
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

    <!-- Main Content -->
    <div class="container">
        <div class="page-header">
            <h1>My Bookings 📅</h1>
            <p>Manage and track your property bookings</p>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <!-- Bookings List -->
        @if($bookings->count() > 0)
            <div class="bookings-list">
                @foreach($bookings as $booking)
                <div class="booking-card">
                    <div class="booking-details">
                        <div class="booking-property-name">{{ $booking->property->name }}</div>
                        <div class="booking-info">
                            <div class="info-item">
                                📍 <strong>Location:</strong>
                                {{ $booking->property->location }}
                            </div>
                            <div class="info-item">
                                📅 <strong>Check-in:</strong>
                                {{ $booking->check_in_date->format('M d, Y') }}
                            </div>
                            <div class="info-item">
                                📅 <strong>Check-out:</strong>
                                {{ $booking->check_out_date->format('M d, Y') }}
                            </div>
                            <div class="info-item">
                                🌙 <strong>Nights:</strong>
                                {{ $booking->nights }}
                            </div>
                        </div>
                    </div>

                    <div class="booking-footer">
                        <span class="status-badge {{ $booking->status }}">{{ $booking->status }}</span>
                        <div class="booking-price">${{ number_format($booking->total_price, 2) }}</div>
                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn-action btn-view">View Details</a>
                        
                        @if($booking->status === 'pending')
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn-action btn-edit">Edit</a>
                            <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-cancel" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel</button>
                            </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($bookings->hasPages())
            <div class="pagination">
                {{ $bookings->links() }}
            </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📅</div>
                <p>You haven't made any bookings yet.</p>
                <p style="color: #7f8c8d; margin: 10px 0;">Start exploring and book your perfect stay today!</p>
                <div class="empty-state-btn">
                    <a href="{{ route('properties.index') }}">Browse Properties</a>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
