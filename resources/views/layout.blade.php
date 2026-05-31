<!DOCTYPE html>
<html>
<head>
    <title>Real Estate System</title>

    <style>
        body{
            font-family:Arial;
            margin:0;
        }

        nav{
            background:#333;
            padding:15px;
        }

        nav a{
            color:white;
            text-decoration:none;
            margin-right:20px;
        }

        .container{
            padding:20px;
        }
    </style>
</head>
<body>

<nav>
    <a href="/dashboard">Dashboard</a>
    <a href="/properties">Properties</a>
    <a href="/my-bookings">My Bookings</a>
    <a href="/login">Login</a>
    <a href="/register">Register</a>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>