@extends('admin.layout.index')
@section('content')
    @include('admin.report.common')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Order graph -->
    <div class="card-header border-0">
        <h3 class="card-title">
            <i class="fas fa-th mr-1"></i>
            Monthly Order Graph
        </h3>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <div style="width: 80%; height: 400px;">
            <canvas id="orderChart"></canvas>
        </div>
    </div>
    {{-- table view --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('orderChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($orderMonths) !!},
                datasets: [{
                    label: 'Number of Orders',
                    data: {!! json_encode($orderCounts) !!},
                    backgroundColor: 'blue',
                    borderColor: 'green', // boder
                    pointBackgroundColor: 'blue', // point
                    pointBorderColor: 'blue', //point border
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
        $.widget.bridge('uibutton', $.ui.button)
    </script>
@endsection
