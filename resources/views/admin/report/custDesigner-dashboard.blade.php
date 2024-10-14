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
            Customer and Designer Growth (Monthly)
        </h3>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <div style="width: 80%; height: 400px;">
            <canvas id="customerDesignerChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('customerDesignerChart').getContext('2d');
        var customerDesignerChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($months) !!}, // Dùng $months thay vì $date
                datasets: [{
                        label: 'Number of Customers',
                        data: {!! json_encode($customerCounts) !!},
                        backgroundColor: 'blue',
                        borderColor: 'green', // boder
                        pointBackgroundColor: 'blue', // point
                        pointBorderColor: 'blue', //point border
                        pointHoverBackgroundColor: 'red', // point hover
                        borderWidth: 3
                    },
                    {
                        label: 'Number of Designers',
                        data: {!! json_encode($designerCounts) !!},
                        pointBorderColor: 'green', //point border
                        pointHoverBackgroundColor: 'yellow', // point hover
                        borderWidth: 3
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    }
                }
            }
        });
    </script>
@endsection
