<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Booking Confirmation</h1>
    <p>Thank you for your booking! Here are the details:</p>
    <p>Designer: {{ $booking->designerID }}</p>
    <p>Date: {{ $booking->schedule_at }}</p>
    <p>Status: {{ $booking->status }}</p>
</body>
</html>
