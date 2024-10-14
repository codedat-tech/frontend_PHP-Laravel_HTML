<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Review</title>
    <link rel="stylesheet" href="{{ url('Asset/css/designer.css') }}">
</head>
<body>
    <h1>Submit a Review</h1>

    <form id="reviewForm">
        <input type="text" id="reviewName" placeholder="Your Name" required>
        <textarea id="reviewText" placeholder="Your Review" required></textarea>
        <input type="hidden" id="consultationID" value="1"> <!-- Set this value dynamically -->
        <button type="button" onclick="submitReview()">Submit Review</button>
    </form>

    <div class="notification" id="notification"></div>

    <script>
        function submitReview() {
            const name = document.getElementById('reviewName').value;
            const review = document.getElementById('reviewText').value;
            const consultationID = document.getElementById('consultationID').value;

            if (name && review && consultationID) {
                fetch('/reviews', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        consultationID: consultationID,
                        rating: 5, // You can modify this as needed
                        comment: review,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    showNotification(data.message);
                    // Optionally reset the form
                    document.getElementById('reviewForm').reset();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            } else {
                alert('Please fill out all fields.');
            }
        }

        function showNotification(message) {
            const notification = document.getElementById('notification');
            notification.innerText = message;
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 2000);
        }
    </script>
</body>
</html>

{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Modal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .modal {
            display: none; /* Initially hidden */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .modal-content {
            background-color: #ffffff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .close {
            color: #333;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #ff0000;
        }

        .detail-button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin: 10px auto;
            display: block;
        }

        .detail-button:hover {
            background-color: #0056b3;
        }

        .review-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-input,
        .form-textarea {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .form-input:focus,
        .form-textarea:focus {
            border-color: #007BFF;
            outline: none;
        }
    </style>
</head>

<body>
    <button class="detail-button" onclick="document.getElementById('reviewModal').style.display='block'">Add Review</button>

    <div id="reviewModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('reviewModal').style.display='none'">&times;</span>
            <h3 id="reviewModalTitle">Submit Your Review</h3>
            <div class="review-form">
                <input type="text" id="reviewerName" placeholder="Your name" class="form-input" required>
                <textarea id="reviewText" placeholder="Write your review" rows="4" class="form-textarea" required></textarea>
                <button class="detail-button">Submit Review</button>
            </div>
        </div>
    </div>
</body>

</html> --}}
