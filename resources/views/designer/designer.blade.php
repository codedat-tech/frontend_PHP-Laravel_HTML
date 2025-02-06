@extends('layouts.index')
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ url('Asset/js/viewProfileDesigner.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- 1 . Designer Gallery -->

    <h2 style="color: black; text-align:center">Designer Gallery</h2>
    <div class="gallery" id="designers">
        <div class="gallery-items" id="galleryItems">
            @foreach ($designers as $designer)
                <div class="gallery-item">
                    <img src="{{ asset('Asset/Image/designer/' . $designer->image) }}" alt="{{ $designer->fullname }}">
                    <h3><i class="ri-user-line icon"></i> Designer:
                        <br> {{ $designer->fullname }}
                    </h3>
                    <div class="details">
                        <button class="detail-button" onclick="viewDesigner({{ $designer->designerID }})"
                            style="text-decoration: underline; cursor: pointer;">
                            View Profile
                        </button>
                        <button class="detail-button" onclick="checkSchedule('{{ $designer->designerID }}')">Check
                            Schedule</button>
                        <button class="detail-button" onclick="showAddScheduleModal('{{ $designer->designerID }}')">Add
                            Schedule</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!--2.  Modals profile -->
    <div class="modal" id="profileModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('profileModal')">&times;</span>
            <h3 id="profileTitle"></h3>

            <object id="profilePdf" style="display: none; width: 100%; height: 500px;" type="application/pdf"></object>

            <p id="profileDescription">Profile description goes here.</p>
        </div>
    </div>

    {{-- 3.modals schedule --}}
    <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="scheduleModalLabel">Schedule Details</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div id="scheduleDetails"></div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <a href="{{ route('login') }}" id="loginButton" class="btn btn-primary" style="display: none;">Log
                        In</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 4.view Déigner --}}
    <div class="modal fade" id="viewDesignerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center w-100">Designer information</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Full Name:</th>
                            <td><span id="view_fullname"></span></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><span id="view_email"></span></td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td><span id="view_phone"></span></td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td><span id="view_address"></span></td>
                        </tr>
                        <tr>
                            <th>Portfolio:</th>
                            <td>
                                <a id="view_portfolio" target="_blank">View Portfolio</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Experience (Years):</th>
                            <td><span id="view_experienceYear"></span></td>
                        </tr>
                        <tr>
                            <th>Specialization:</th>
                            <td><span id="view_specialization"></span></td>
                        </tr>
                        <tr>
                            <th>Rating:</th>
                            <td><span id="view_rating"></span></td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td><span id="view_status"></span></td>
                        </tr>
                        <tr>
                            <th>Image:</th>
                            <td>
                                <img id="view_image" src="" alt="" style="width: 300px; height: auto;">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- 5 Modal Add Schedule -->
    <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addScheduleModalLabel">Add Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addScheduleForm">
                        <div class="mb-3">
                            <label for="designerID" class="form-label">Designer</label>
                            <select class="form-select" id="designerID" required>
                                <option value="">Select Designer</option>
                                @foreach ($designers as $designer)
                                    <option value="{{ $designer->designerID }}">{{ $designer->fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="scheduledDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="scheduledDate" required>
                            <small class="text-danger" id="date-error"></small>
                        </div>
                        <div class="mb-3">
                            <label for="scheduledTime" class="form-label">Time</label>
                            <input type="time" class="form-control" id="scheduledTime" required>
                            <small class="text-danger" id="time-error"></small>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <small class="text-danger" id="note-error"></small>
                            <textarea class="form-control" id="note" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirm('Are you sure you want to add schedule with this Designer?')">Add
                            Schedule</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
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

        // 1. VIEW PROFILE -> done
        function viewProfile(designerName, portfolio, event) {
            event.stopPropagation();

            // url PDF
            const pdfUrl = `/Asset/PDF/portfolio/${portfolio}`;
            document.getElementById('profileTitle').innerText = designerName;
            // open pdf profile
            if (pdfUrl.endsWith('.pdf')) {
                window.open(pdfUrl, 'PDF', 'width=800,height=600,resizable=yes,scrollbars=yes');
            } else {
                console.error('The provided file is not a PDF.');
            }
        }

        //  2. view schedule
        const customerName = @json(Auth::user()->fullname ?? 'Customer');

        function checkSchedule(designerID) {
            let customerID = {{ Auth::check() ? Auth::id() : 'null' }};

            if (customerID) {
                fetch(`/consultations/schedule?customerID=${customerID}&designerID=${designerID}`)
                    .then(response => response.json())
                    .then(data => {
                        let scheduleDetails =
                            `<p>Hello, ${customerName}! you have schedule:</p>`;

                        const today = new Date();
                        today.setHours(0, 0, 0, 0);

                        if (data.error) {
                            scheduleDetails += `<p>${data.error}</p>`;
                        } else if (data.message) {
                            scheduleDetails += `<p>${data.message}</p>`;
                        } else {
                            const futureConsultations = data.filter(consultation => {
                                const scheduledDate = new Date(consultation.scheduledAT);
                                return scheduledDate >= today;
                            });

                            if (futureConsultations.length === 0) {
                                scheduleDetails += `<p>There are no upcoming appointments.</p>`;
                            } else {
                                scheduleDetails += "<ul>";
                                futureConsultations.forEach(consultation => {
                                    scheduleDetails += `
                                <li><strong>Scheduled Date:</strong> ${consultation.scheduledAT} <br> 
                                <strong>Status:</strong> ${consultation.status1}</li>`;
                                });
                                scheduleDetails += "</ul>";
                            }
                        }

                        document.getElementById("scheduleDetails").innerHTML = scheduleDetails;
                        document.getElementById("loginButton").style.display = "none";

                        let scheduleModal = new bootstrap.Modal(document.getElementById('scheduleModal'));
                        scheduleModal.show();
                    })
                    .catch(error => {
                        alert('Error: ' + error);
                    });
            } else {
                document.getElementById("scheduleDetails").innerHTML = `
            <p>Hello, Guest!</p>
            <p>Please log in or sign up to view and schedule appointments with designers.</p>`;

                document.getElementById("loginButton").style.display = "inline-block";

                let scheduleModal = new bootstrap.Modal(document.getElementById('scheduleModal'));
                scheduleModal.show();
            }
        }

        // Show Notification
        function showNotification(message) {
            const notification = document.getElementById('notification');
            notification.innerText = message;
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 2000);
        }
    </script>

    {{-- add schedule --}}
    <script>
        function showAddScheduleModal(designerID) {
            // Đặt giá trị designerID vào select trong modal
            document.getElementById('designerID').value = designerID;

            // Mở modal
            let addScheduleModal = new bootstrap.Modal(document.getElementById('addScheduleModal'));
            addScheduleModal.show();
        }

        // Hàm kiểm tra trùng ngày
        function checkScheduleConflict() {
            const designerID = document.getElementById('designerID').value;
            const scheduledDate = document.getElementById('scheduledDate').value;
            const dateError = document.getElementById('date-error');

            // Xóa thông báo lỗi trước khi kiểm tra
            dateError.textContent = '';

            if (designerID && scheduledDate) {
                fetch(`/check-schedule-conflict`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            designerID: designerID,
                            scheduledAT: scheduledDate // Chỉ gửi ngày
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.conflict) {
                            dateError.textContent =
                                'This designer already has a consultation scheduled on this date. Please choose another date.';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }

        // Thêm sự kiện input cho trường ngày
        document.getElementById('scheduledDate').addEventListener('input', checkScheduleConflict);

        // Hàm kiểm tra từ ngữ không phù hợp
        function checkInappropriateLanguage() {
            const note = document.getElementById('note').value;
            const noteError = document.getElementById('note-error');
            const badWords = []; // Danh sách từ ngữ không phù hợp

            // Xóa thông báo lỗi trước khi kiểm tra
            noteError.textContent = '';

            fetch('/bad-words')
                .then(response => response.json())
                .then(data => {
                    badWords.push(...data);
                    for (const word of badWords) {
                        if (note.toLowerCase().includes(word.toLowerCase())) {
                            noteError.textContent = 'Your note contains inappropriate language: ' + word;
                            return; // Ngừng kiểm tra sau khi tìm thấy từ không phù hợp
                        }
                    }
                })
                .catch(error => {
                    console.error('Error loading bad words:', error);
                });
        }

        // Thêm sự kiện input cho trường note
        document.getElementById('note').addEventListener('input', checkInappropriateLanguage);

        document.getElementById('addScheduleForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const designerID = document.getElementById('designerID').value;
            const scheduledDate = document.getElementById('scheduledDate').value;
            const scheduledTime = document.getElementById('scheduledTime').value;
            const note = document.getElementById('note').value;

            // Gửi yêu cầu AJAX để thêm lịch hẹn
            fetch(`{{ route('consultation.addSchedule') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        designerID: designerID,
                        customerID: {{ Auth::check() ? Auth::id() : 'null' }}, // Lấy ID của customer đang đăng nhập
                        scheduledAT: `${scheduledDate} ${scheduledTime}`, // Nếu bạn vẫn cần giờ, hãy giữ lại
                        note: note,
                        status: true,
                        status1: 'Schedule'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                        let addScheduleModal = bootstrap.Modal.getInstance(document.getElementById(
                            'addScheduleModal'));
                        addScheduleModal.hide();
                        // Có thể làm mới danh sách lịch hẹn hoặc thực hiện các hành động khác
                    } else if (data.error) {
                        alert(data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while adding the schedule.');
                });
        });
    </script>
@endsection
