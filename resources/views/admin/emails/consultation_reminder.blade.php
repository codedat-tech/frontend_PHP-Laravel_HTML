<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consultation Confirmation</title>
</head>

<body>
    {{-- 1. messeg --}}
    <h3>Hello, {{ $consultation->customer->fullname }}!</h3>

    <p>
        Bucki Decord sent the appointment schedule that you initiated. Please see the attached content and please arrive
        on time as scheduled.
    </p>

    <p><strong>Scheduled Time:</strong> {{ $consultation->scheduledAT }}</p>

    <p>Thank you,<br>
        Bucki Decord Team</p>
    {{-- 2. view --}}
    <table style="width: 70%; margin: 0 auto;">
        <tr>
            <td style="width: 50%;">
                <img src="{{ $message->embed(public_path('storage/Image/LOGO.png')) }}" alt="Logo"
                    style="max-width:150px;">
                <!-- Embed logo in email using Content-ID (CID) for reference within email clients. -->
            </td>
            <td style="text-align: right;">
                <h2>Bucki Store</h2>
                <p>590 Nguyen Thi Minh Khai, District 3, Ho Chi Minh City, Vietnam</p>
                <p>Phone: (123) 456-7890</p>
            </td>
        </tr>
    </table>

    <table style="width: 70%; margin: 20px auto; border-collapse: collapse;">
        <tr>
            <td colspan="2" style="padding: 10px; border-bottom: 1px solid #ddd;">
                <h4>Customer Information</h4>
            </td>
        </tr>
        <tr>
            <td style="padding: 8px;"><strong>Full Name:</strong></td>
            <td style="padding: 8px;">{{ $consultation->customer->fullname }}</td>
        </tr>
        <tr>
            <td style="padding: 8px;"><strong>Telephone:</strong></td>
            <td style="padding: 8px;">{{ $consultation->customer->phone }}</td>
        </tr>
        <tr>
            <td style="padding: 8px;"><strong>Email:</strong></td>
            <td style="padding: 8px;">{{ $consultation->customer->email }}</td>
        </tr>
        <tr>
            <td style="padding: 8px;"><strong>Address:</strong></td>
            <td style="padding: 8px;">{{ $consultation->customer->address }}</td>
        </tr>
    </table>

    <h4 style="text-align: center; margin-top: 20px;">Schedule Information</h4>
    <table style="width: 70%; margin: 0 auto; border-collapse: collapse;">
        <thead>
            <tr style="text-align: center; background-color: #f2f2f2;">
                <th style="padding: 10px; border: 1px solid #ddd;">Schedule Time</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Note</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Designer</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align: center;">
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $consultation->scheduledAT }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $consultation->note }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $consultation->designer->fullname }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
