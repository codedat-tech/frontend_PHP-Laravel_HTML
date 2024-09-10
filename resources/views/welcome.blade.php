<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="welcome-box">
            <h1>Welcome, Admin!</h1>
            <p>Manage your dashboard efficiently with our powerful tools.</p>
            <a href="{{ url('/index') }}" class="btn">Go to Dashboard</a>

        </div>
    </div>
</body>
</html>
