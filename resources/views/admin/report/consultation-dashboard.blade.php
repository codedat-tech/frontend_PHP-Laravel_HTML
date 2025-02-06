@extends('admin.layout.index')
@section('content')
    @include('admin.report.common')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    {{-- thong bao loi --}}
    <div id="errorMessage" class="alert alert-danger text-center mt-3" style="display:none;"></div>
    <h3 class="card-title card-header border-0 text-center">
        <i class="fas fa-th mr-1"></i>
        Consultation Chart of Yearly
    </h3>

    <div class="d-flex justify-content-center align-items-center mt-3">
        <input type="number" id="yearPicker" placeholder="Select Year" style="width: 200px; margin-right: 10px;" />
        <button id="filterBtn" class="btn btn-primary">Filter</button>
    </div>

    {{-- chart --}}
    <div class="d-flex justify-content-center align-items-center mt-3">
        <div style="width: 60%; height: 250px;">
            <canvas id="consultationsChart"></canvas>
        </div>
    </div>
@endsection
@section('script-section')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var currentYear = new Date().getFullYear();
        $('#yearPicker').val(currentYear);

        var ctxMonth = document.getElementById('consultationsChart').getContext('2d');
        var consultationsChart = new Chart(ctxMonth, {
            type: 'line',
            data: {
                labels: {!! json_encode($consultationMonths) !!}, // Danh sách các tháng
                datasets: [{
                    label: 'Consultations by Month',
                    data: {!! json_encode($consultationCounts) !!}, // Số lượng consultations theo tháng
                    backgroundColor: 'blue',
                    borderColor: 'green', // boder
                    pointBackgroundColor: 'blue', // point
                    pointBorderColor: 'blue', //point border
                    pointHoverBackgroundColor: 'red', // point hover
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        //nhấn nút Filter
        $('#filterBtn').on('click', function() {
            var selectedYear = $('#yearPicker').val();

            // Kiểm tra năm lựa chọn
            if (selectedYear > currentYear) {
                $('#errorMessage').text('The selected year cannot be greater than the current year.').show();
                return;
            } else {
                $('#errorMessage').hide();
            }

            if (!selectedYear) {
                alert("Please select a year!");
                return;
            }

            // Gửi yêu cầu AJAX
            $.ajax({
                url: '{{ route('reports.consultations') }}', // Route cấu hình trong web.php
                method: 'GET',
                data: {
                    year: selectedYear
                },
                success: function(response) {
                    //nếu Counts là 0. dùng arrow function (hay còn gọi là lambda expression)
                    if (response.consultationCounts.reduce((a, b) => a + b, 0) === 0) {
                        $('#errorMessage').text('No data available for the selected year.').show();
                        return;
                    } else {
                        $('#errorMessage').hide();
                    }
                    // update biểu đồ
                    consultationsChart.data.labels = response.consultationMonths;
                    consultationsChart.data.datasets[0].data = response.consultationCounts;
                    consultationsChart.update();
                },
                error: function() {
                    alert('Error fetching data. Please try again.');
                }
            });
        });

        // Tải biểu đồ
        $(document).ready(function() {
            $('#filterBtn').click();
        });
    </script>
@endsection
