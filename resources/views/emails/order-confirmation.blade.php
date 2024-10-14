<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Dear {{ $data['firstName'] }} {{ $data['lastName'] }},</p>
    <p>Thank you for your order!</p>
    <p>Order Details:</p>
    <ul>
        <li>Address: {{ $data['address'] }} {{ $data['address2'] }}</li>
        <li>Country: {{ $data['country'] }}</li>
        <li>State: {{ $data['state'] }}</li>
        <li>Zip: {{ $data['zip'] }}</li>
        <!-- Add more details as needed -->
    </ul>
    <p>We will process your order and send you further updates.</p>
</body>
</html>
