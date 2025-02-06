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
    {{-- Order graph --}}
    <h3 class="card-title card-header border-0 text-center">
        <i class="fas fa-th mr-1"></i>
        Monthly Order Graph of Yearly
    </h3>

    <div class="d-flex justify-content-center align-items-center mt-3">
        <input type="number" id="yearPicker" placeholder="Select Year" style="width: 200px; margin-right: 10px;" />
        <button id="filterBtn" class="btn btn-primary">Filter</button>
    </div>

    {{-- khu vuc chart --}}
    <div class="d-flex justify-content-center align-items-center mt-3">
        <div style="width: 60%; height: 250px;">
            <canvas id="orderChart"></canvas>
        </div>
    </div>
@endsection

@section('script-section')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // yearPicker là năm mặc định
        var currentYear = new Date().getFullYear();
        $('#yearPicker').val(currentYear);

        var ctx = document.getElementById('orderChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($orderMonths) !!}, // Dữ liệu ban đầu từ server
                datasets: [{
                    label: 'Number of Orders',
                    data: {!! json_encode($orderCounts) !!}, // Dữ liệu ban đầu từ server
                    backgroundColor: 'rgba(0, 123, 255, 0.5)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.1,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
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
                url: '{{ route('reports.order') }}', // Route cấu hình trong web.php
                method: 'GET',
                data: {
                    year: selectedYear
                },
                success: function(response) {
                    //nếu Counts là 0. dùng arrow function (hay còn gọi là lambda expression)
                    if (response.orderCounts.reduce((a, b) => a + b, 0) === 0) {
                        $('#errorMessage').text('No data available for the selected year.').show();
                        return;
                    } else {
                        $('#errorMessage').hide();
                    }
                    console.log('orderMonth: ' + response.orderMonths);
                    // update biểu đồ
                    lineChart.data.labels = response.orderMonths;
                    lineChart.data.datasets[0].data = response.orderCounts;
                    lineChart.update();
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
