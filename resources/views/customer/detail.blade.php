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
        .dashboard {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .designer-info {
            flex: 1;
            margin-right: 20px; /* space between the two sections */
        }
        .booking-form {
            flex: 1;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">DecorVista</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <a href="{{ route('user.designer_booking') }}">Designer Booking</a>
                <li class="nav-item"><a class="nav-link" href="#">Nav 1</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Nav 2</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Nav 3</a></li>
            </ul>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->full_name }} <span class="caret"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="{{ route('user.booking_history') }}">Booking History</a>
                    <div class="dropdown-divider"></div>
                    <form action="" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container dashboard">
        <div class="designer-info">
            <h1>{{ $designer->fullName }}</h1>
            <p><strong>Email Address:</strong> {{ $designer->email }}</p>
            <p><strong>Phone Number:</strong> {{ $designer->phone }}</p>
            <p><strong>Portfolio Link:</strong> <a href="{{ $designer->portfolio }}">{{ $designer->portfolio }}</a></p>
            <p><strong>Years of Experience:</strong> {{ $designer->yearsOfExperience }} years</p>
            <p><strong>Specialization:</strong> {{ $designer->specialization }}</p>
            <p><strong>Rating:</strong> {{ $designer->rating }} / 5</p>
        </div>
        <div class="booking-form">
            <h2>Book Appointment</h2>
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="designer_id" value="{{ $designer->id }}">

                <label for="date">Date:</label>
                <input type="date" name="date" required>

                <label for="time">Time:</label>
                <input type="time" name="time" required>

                <label for="content">Request Details:</label>
                <textarea name="content"></textarea>

                <button type="submit">Book Appointment</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
