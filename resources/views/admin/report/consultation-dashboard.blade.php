@extends('admin.layout.index')
@section('content')
    @include('admin.report.common')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card-header border-0">
        <h3 class="card-title">
            <i class="fas fa-th mr-1"></i>
            Consultation Chart (Monthly)
        </h3>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <div style="width: 80%; height: 400px;">
            <canvas id="consultationsByMonthChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctxMonth = document.getElementById('consultationsByMonthChart').getContext('2d');
        var monthChart = new Chart(ctxMonth, {
            type: 'line',
            data: {
                labels: {!! json_encode($months) !!}, // Danh sách các tháng
                datasets: [{
                    label: 'Consultations by Month',
                    data: {!! json_encode($consultationCountsByMonth) !!}, // Số lượng consultations theo tháng
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
    </script>
@endsection
