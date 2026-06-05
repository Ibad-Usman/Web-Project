<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Property Booking</title>
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

        .dashboard-header {
            margin-bottom: 40px;
        }

        .dashboard-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .dashboard-header p {
            color: #7f8c8d;
            font-size: 16px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .card-stat {
            font-size: 32px;
            font-weight: 700;
            color: #667eea;
            margin: 15px 0;
        }

        .card-text {
            color: #7f8c8d;
            font-size: 14px;
        }

        .card-link {
            display: inline-block;
            margin-top: 15px;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .card-link:hover {
            color: #764ba2;
        }

        .section-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #2c3e50;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .properties-table,
        .bookings-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .properties-table thead,
        .bookings-table thead {
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
        }

        .properties-table th,
        .bookings-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
        }

        .properties-table td,
        .bookings-table td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .properties-table tbody tr:hover,
        .bookings-table tbody tr:hover {
            background: #f8f9fa;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.active {
            background: #d4edda;
            color: #155724;
        }

        .status-badge.pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-badge.completed {
            background: #d1ecf1;
            color: #0c5460;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons a,
        .action-buttons button {
            padding: 6px 12px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-edit {
            background: #3498db;
            color: white;
        }

        .btn-edit:hover {
            background: #2980b9;
        }

        .btn-delete {
            background: #e74c3c;
            color: white;
        }

        .btn-delete:hover {
            background: #c0392b;
        }

        .btn-view {
            background: #667eea;
            color: white;
        }

        .btn-view:hover {
            background: #5568d3;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 10px;
            color: #7f8c8d;
        }

        .empty-state-icon {
            font-size: 50px;
            margin-bottom: 20px;
            opacity: 0.5;
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

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .properties-table,
            .bookings-table {
                font-size: 12px;
            }

            .properties-table th,
            .bookings-table th,
            .properties-table td,
            .bookings-table td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <a href="{{ route('dashboard') }}" class="navbar-brand">PropertyBook</a>
        <ul class="nav-links">
            <li><a href="{{ route('dashboard') }}" class="active">Dashboard</a></li>
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

    <!-- Main Content -->
    <div class="container">
        <div class="dashboard-header">
            <h1>Welcome back, {{ auth()->user()->name }}! 👋</h1>
            <p>Here's what's happening with your properties and bookings today.</p>
        </div>

        <!-- Statistics Cards -->
        <div class="dashboard-grid">
            <div class="card">
                <div class="card-icon">🏠</div>
                <div class="card-title">Properties</div>
                <div class="card-stat">{{ $properties_count ?? 0 }}</div>
                <p class="card-text">Active properties listed</p>
                <a href="{{ route('properties.index') }}" class="card-link">View all →</a>
            </div>

            <div class="card">
                <div class="card-icon">📅</div>
                <div class="card-title">Bookings</div>
                <div class="card-stat">{{ $bookings_count ?? 0 }}</div>
                <p class="card-text">Total bookings received</p>
                <a href="{{ route('bookings.index') }}" class="card-link">View all →</a>
            </div>

            <div class="card">
                <div class="card-icon">💰</div>
                <div class="card-title">Revenue</div>
                <div class="card-stat">${{ $total_revenue ?? '0.00' }}</div>
                <p class="card-text">This month</p>
                <a href="{{ route('bookings.index') }}" class="card-link">Details →</a>
            </div>

            <div class="card">
                <div class="card-icon">⭐</div>
                <div class="card-title">Rating</div>
                <div class="card-stat">{{ $average_rating ?? '4.5' }}/5</div>
                <p class="card-text">Based on reviews</p>
                <a href="{{ route('profile.edit') }}" class="card-link">View →</a>
            </div>
        </div>

        <!-- Recent Properties Section -->
        <div style="margin-bottom: 40px;">
            <div class="section-title">
                <span>Recent Properties</span>
                <a href="{{ route('properties.index') }}" class="btn-primary">+ Add Property</a>
            </div>

            @if(isset($recent_properties) && count($recent_properties) > 0)
                <table class="properties-table">
                    <thead>
                        <tr>
                            <th>Property Name</th>
                            <th>Location</th>
                            <th>Price/Night</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent_properties as $property)
                        <tr>
                            <td><strong>{{ $property->name ?? 'Property' }}</strong></td>
                            <td>{{ $property->location ?? 'N/A' }}</td>
                            <td>${{ $property->price ?? '0.00' }}</td>
                            <td>
                                <span class="status-badge active">Active</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('properties.show', ['id' => $property->id ?? 1]) }}" class="btn-view">View</a>
                                    <a href="{{ route('properties.edit', ['id' => $property->id ?? 1]) }}" class="btn-edit">Edit</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">🏠</div>
                    <p>No properties yet. Start by creating your first property!</p>
                    <a href="{{ route('properties.index') }}" class="btn-primary" style="margin-top: 15px;">Create Property</a>
                </div>
            @endif
        </div>

        <!-- Recent Bookings Section -->
        <div>
            <div class="section-title">
                <span>Recent Bookings</span>
                <a href="{{ route('bookings.index') }}" class="btn-primary">View All</a>
            </div>

            @if(isset($recent_bookings) && count($recent_bookings) > 0)
                <table class="bookings-table">
                    <thead>
                        <tr>
                            <th>Guest Name</th>
                            <th>Property</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent_bookings as $booking)
                        <tr>
                            <td><strong>{{ $booking->guest_name ?? 'Guest' }}</strong></td>
                            <td>{{ $booking->property_name ?? 'Property' }}</td>
                            <td>{{ $booking->check_in ?? 'N/A' }}</td>
                            <td>{{ $booking->check_out ?? 'N/A' }}</td>
                            <td>
                                <span class="status-badge pending">Pending</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('bookings.show', ['id' => $booking->id ?? 1]) }}" class="btn-view">View</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">📅</div>
                    <p>No bookings yet. Create a property to start accepting bookings!</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>