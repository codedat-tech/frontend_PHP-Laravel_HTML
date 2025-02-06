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
            <h3>Edit Voucher</h3>
            <form action="{{ route('vouchers.update', $voucher) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="code">Voucher Code</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ $voucher->code }}"
                        required>
                    <small class="text-danger" id="codeError" style="display: none;"></small>
                </div>
                <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="number" class="form-control" id="discount" name="discount"
                        value="{{ $voucher->discount }}" step="0.01" required>
                    <small class="text-danger" id="discountError" style="display: none;"></small>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="1" {{ $voucher->status ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$voucher->status ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Voucher</button>
                <a href="{{ url('vouchers') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Validate discount input
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

            // Validate voucher code uniqueness (if necessary)
            $('#code').on('blur', function() {
                var code = $(this).val();
                $('#codeError').hide();

                if (code.length > 0) {
                    $.ajax({
                        url: '{{ route('vouchers.checkCode') }}',
                        type: 'GET',
                        data: {
                            code: code,
                            id: '{{ $voucher->id }}' // Pass the current voucher ID to exclude it from the check
                        },
                        success: function(response) {
                            if (response.exists) {
                                $('#codeError').text(
                                    'Voucher code already exists. Please choose another one.'
                                ).show();
                            } else {
                                $('#codeError').hide();
                            }
                        },
                        error: function() {
                            $('#codeError').text('An error occurred while checking the code.')
                                .show();
                        }
                    });
                }
            });
        });
    </script>
@endsection
