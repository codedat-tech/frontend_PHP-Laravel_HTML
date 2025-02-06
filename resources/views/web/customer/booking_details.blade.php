
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">DecorVista</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="">Designer Booking</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Nav 1</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Nav 2</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Nav 3</a></li>
            </ul>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    User <span class="caret"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="{{ route('customer.booking_history') }}">Booking History</a>
                    <div class="dropdown-divider"></div>
                    <form action="" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>Booking Details</h1>
        <p><strong>Designer:</strong> {{ $booking->designer->fullname}}</p>
        <p><strong>Scheduled At:</strong> {{ $booking->scheduledAT}}</p>
        <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
        <p><strong>Content:</strong> {{ $booking->note ?? 'No details provided' }}</p>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
