@extends('admin.layout.index')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="container">
            <h3>Add Voucher</h3>
            <form action="{{ route('vouchers.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="code">Voucher Code</label>
                    <input type="text" class="form-control" id="code" name="code" required>
                    <small class="text-danger" id="codeError" style="display: none;"></small>
                </div>
                <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="number" class="form-control" id="discount" name="discount" step="0.01" required>
                    <small class="text-danger" id="discountError" style="display: none;"></small>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create Voucher</button>
            </form>
        </div>
    </div>

    <div class="container">
        <h3>Vouchers</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vouchers as $voucher)
                    <tr>
                        <td>{{ $voucher->code }}</td>
                        <td>{{ $voucher->discount }}</td>
                        <td>{{ $voucher->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('vouchers.edit', $voucher) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('vouchers.toggleStatus', $voucher->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to change the status?')">
                                    {{ $voucher->status ? 'Disable' : 'Enable' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#code').on('input', function() {
                var code = $('code').val();
                $('#codeError').hide(); // Ẩn thông báo lỗi khi người dùng bắt đầu nhập

                if (code.length > 0) {
                    $.ajax({
                        url: '{{ route('vouchers.checkCode') }}',
                        type: 'GET',
                        data: {
                            code: code
                        },
                        success: function(response) {
                            if (response.exists) {
                                $('#codeError').text(
                                    'Voucher code already exists. Please choose another one.'
                                ).show();
                            } else {
                                $('#codeError').hide(); // Ẩn thông báo lỗi nếu mã không trùng
                            }
                        },
                        error: function() {
                            $('#codeError').text('An error occurred while checking the code.')
                                .show();
                        }
                    });
                }
            });
            $('#discount').on('input', function() {
                var discount = $(this).val();
                var regex = /^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/;
                var min = 1;
                var max = 95;

                if (!regex.test(discount)) {
                    $('#discountError').text(
                        'Invalid discount format. Please enter a value between 1 and 95 with up to 2 decimal places.'
                    ).show();
                } else if (discount < min || discount > max) {
                    $('#discountError').text('Discount must be between 1 and 95.').show();
                } else {
                    $('#discountError').hide();
                }
            });
        });
    </script>
@endsection
