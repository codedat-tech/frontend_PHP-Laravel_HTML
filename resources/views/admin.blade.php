<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

    <div class="login-container">
    <img src="{{ asset('img/icons8-admin-100.png') }}" alt="Admin Profile Picture" class="profile-pic">
        <h1>Admin Login</h1>

        @if ($errors->any())
            <div class="error-message">
                <strong>Error!</strong> {{ $errors->first('username') }}
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
