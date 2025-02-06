@extends('admin.layout.index')
@section('content')
    @include('admin.report.common')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div id="errorMessage" class="alert alert-danger text-center mt-3" style="display:none;"></div>

    {{-- Customer graph --}}
    <h3 class="card-title card-header border-0 text-center">
        <i class="fas fa-th mr-1"></i>
        Customer Growth of Yearly
    </h3>
    <div class="d-flex justify-content-center align-items-center mt-3">
        <input type="number" id="yearPicker1" placeholder="Select Year" style="width: 200px; margin-right: 10px;" />
        <button id="filterBtn1" class="btn btn-primary">Filter</button>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-3">
        <div style="width: 60%; height: 250px;">
            <canvas id="customerChart"></canvas>
        </div>
    </div>

    {{-- Designer graph --}}
    <h3 class="card-title card-header border-0 text-center">
        <i class="fas fa-th mr-1"></i>
        Designer Growth of Yearly
    </h3>
    <div class="d-flex justify-content-center align-items-center mt-3">
        <input type="number" id="yearPicker2" placeholder="Select Year" style="width: 200px; margin-right: 10px;" />
        <button id="filterBtn2" class="btn btn-primary">Filter</button>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-3">
        <div style="width: 60%; height: 250px;">
            <canvas id="designerChart"></canvas>
        </div>
    </div>
@endsection

@section('script-section')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Customer Chart --}}
    <script>
        var currentYear1 = new Date().getFullYear();
        $('#yearPicker1').val(currentYear1);

        var customerCtx = document.getElementById('customerChart').getContext('2d');
        var customerChart = new Chart(customerCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($customerMonths) !!},
                datasets: [{
                    label: 'Number of Customers',
                    data: {!! json_encode($customerCounts) !!},
                    backgroundColor: 'blue',
                    borderColor: 'green',
                    pointBackgroundColor: 'blue',
                    pointBorderColor: 'blue',
                    pointHoverBackgroundColor: 'red',
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                }
            }
        });

        $('#filterBtn1').on('click', function() {
            var selectedYear = $('#yearPicker1').val();
            if (selectedYear > currentYear1) {
                $('#errorMessage').text('The selected year cannot be greater than the current year.').show();
                return;
            } else {
                $('#errorMessage').hide();
            }
            $.ajax({
                url: '{{ route('reports.cusdesign') }}',
                method: 'GET',
                data: {
                    year: selectedYear
                },
                success: function(response) {
                    if (response.customerCounts.reduce((a, b) => a + b, 0) === 0) {
                        $('#errorMessage').text('No data available for the selected year.').show();
                        return;
                    } else {
                        $('#errorMessage').hide();
                    }
                    customerChart.data.labels = response.customerMonths;
                    customerChart.data.datasets[0].data = response.customerCounts;
                    customerChart.update();
                }
            });
        });

        $(document).ready(function() {
            $('#filterBtn1').click();
        });
    </script>

    {{-- Designer Chart --}}
    <script>
        var currentYear2 = new Date().getFullYear();
        $('#yearPicker2').val(currentYear2);

        var designerCtx = document.getElementById('designerChart').getContext('2d');
        var designerChart = new Chart(designerCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($designerMonths) !!},
                datasets: [{
                    label: 'Number of Designers',
                    data: {!! json_encode($designerCounts) !!},
                    backgroundColor: 'blue',
                    borderColor: 'green',
                    pointBackgroundColor: 'blue',
                    pointBorderColor: 'blue',
                    pointHoverBackgroundColor: 'red',
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                }
            }
        });

        $('#filterBtn2').on('click', function() {
            var selectedYear = $('#yearPicker2').val();
            if (selectedYear > currentYear2) {
                $('#errorMessage').text('The selected year cannot be greater than the current year.').show();
                return;
            } else {
                $('#errorMessage').hide();
            }
            $.ajax({
                url: '{{ route('reports.cusdesign') }}',
                method: 'GET',
                data: {
                    year: selectedYear
                },
                success: function(response) {
                    if (response.designerCounts.reduce((a, b) => a + b, 0) === 0) {
                        $('#errorMessage').text('No data available for the selected year.').show();
                        return;
                    } else {
                        $('#errorMessage').hide();
                    }
                    designerChart.data.labels = response.designerMonths;
                    designerChart.data.datasets[0].data = response.designerCounts;
                    designerChart.update();
                }
            });
        });

        $(document).ready(function() {
            $('#filterBtn2').click();
        });
    </script>
@endsection
