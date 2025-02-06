@extends('admin.layout.index')
@section('content')
    @include('admin.report.common')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- charts area --}}
    <div class="card-header border-0">
        <h3 class="card-title card-header border-0">
            <i class="fas fa-th mr-1"></i>
            Product Report
        </h3>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <div style="width: 60%; height: 250px;">
            <canvas id="productChart"></canvas>
        </div>
    </div>
@endsection
@section('script-section')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('productChart').getContext('2d');
        var productChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($categoryNames) !!},
                datasets: [{
                    label: 'Product count',
                    data: {!! json_encode($productCounts) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
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
