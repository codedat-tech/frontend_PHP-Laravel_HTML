<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Designer Gallery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ url('Asset/css/designer.css') }}">
</head>

<body>
    <header>
        <h1>Designer Gallery</h1>
    </header>

    <div class="gallery" id="designers">
        <div class="gallery-items" id="galleryItems">
            @foreach($designers as $designer)
            <div class="gallery-item">
                <img src="{{ asset('Asset/Image/designer/' . $designer->image) }}" alt="{{ $designer->fullname }}">
                <h3><i class="ri-user-line icon"></i> Designer {{ $designer->fullname }}</h3>
                <div class="details">
                    <button class="detail-button" onclick="viewProfile('{{ $designer->fullname }}', '{{ asset($designer->portfolio) }}', event)">View Profile</button>
                    <button class="detail-button" onclick="showSchedule('{{ $designer->fullname }}'); event.stopPropagation();">Check Schedule</button>
                    <button class="detail-button" onclick="showReviewModal('{{ $designer->fullname }}', '{{ $designer->consultationID }}'); event.stopPropagation();">Add Review</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Modals -->
    <div class="modal" id="profileModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('profileModal')">&times;</span>
            <h3 id="profileTitle"></h3>
            <img id="profileImage" alt="Designer Image">
            <p id="profileDescription">Profile description goes here.</p>
        </div>
    </div>

    <div class="modal" id="reviewModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('reviewModal')">&times;</span>
            <h3>Add a Review for <span id="reviewDesigner"></span></h3>
            <div class="review-form">
                <input type="text" id="reviewName" placeholder="Your Name" class="form-input">
                <textarea id="reviewText" placeholder="Your Review" class="form-textarea"></textarea>

                <button class="submit-review" onclick="submitReview()">Submit Review</button>
            </div>
        </div>
    </div>

    <!-- Notification -->
    <div class="notification" id="notification"></div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function toggleDetails(item) {
            const details = item.querySelector('.details');
            if (details) {
                details.style.display = details.style.display === 'block' ? 'none' : 'block';
            }
        }

        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', function() {
                toggleDetails(this);
            });
        });

        function viewProfile(designerName, profileImage, event) {
            event.stopPropagation();
            document.getElementById('profileTitle').innerText = designerName;
            document.getElementById('profileImage').src = profileImage;
            document.getElementById('profileModal').style.display = 'block';
        }

        function showSchedule(designerName) {
            alert(`${designerName}'s schedule will be displayed here.`);
        }

        let currentConsultationID = null;

        function showReviewModal(designerName, consultationID) {
    document.getElementById('reviewDesigner').innerText = designerName;
    currentConsultationID = consultationID; // Store the consultation ID
    console.log('Current Consultation ID:', currentConsultationID); // Log the consultation ID
    document.getElementById('reviewModal').style.display = 'block';
}



        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function submitReview() {
    const name = document.getElementById('reviewName').value;
    const review = document.getElementById('reviewText').value;
    const consultationID = currentConsultationID; // Use stored consultation ID
    const reviewConsultationID = Date.now().toString(); // Generate a unique ID

    // Debugging logs
    console.log('Name:', name);
    console.log('Review:', review);
    console.log('Consultation ID:', consultationID);

    if (name && review && consultationID) {
        fetch('/reviews', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                reviewConsultationID: reviewConsultationID, // Pass the unique ID
                consultationID: consultationID,
                rating: 5, // Replace with actual rating if applicable
                comment: review,
            }),
        })
        .then(response => response.json())
        .then(data => {
            showNotification(data.message);
            closeModal('reviewModal');
        })
        .catch(error => {
            console.error('Error:', error);
        });
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
