<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Designer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">DecorVista</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Designer Booking</a></li>
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

    <div class="container mt-5">
        <h1>Book an Appointment with {{ $designer->fullname }}</h1>

        <!-- Thông tin chi tiết về designer -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $designer->fullname }}</h5>
                <p><strong>Email:</strong> {{ $designer->email }}</p>
                <p><strong>Phone Number:</strong> {{ $designer->phone }}</p>
                <p><strong>Portfolio:</strong> {{ $designer->portfolio }} <a href="#">View Portfolio</a></p>
                <p><strong>Years of Experience:</strong> {{ $designer->experienceYear }} years</p>
                <p><strong>Specialization:</strong> {{ $designer->specialization }}</p>
                <p><strong>Rating:</strong> {{ $designer->rating }}/5</p>
            </div>
        </div>

        <!-- Form để book lịch -->
        <form action="{{ route('booking.store') }}" method="POST">
            @csrf
            <input type="hidden" name="designer_id" value="{{ $designer->designerID }}">

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" name="date" required>
            </div>

            <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" class="form-control" name="time" required>
            </div>

            <div class="form-group">
                <label for="content">Request Details:</label>
                <textarea class="form-control" name="content" placeholder="Optional message"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Book Appointment</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
