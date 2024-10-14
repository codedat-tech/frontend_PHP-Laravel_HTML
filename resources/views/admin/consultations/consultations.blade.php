@extends('admin.layout.index')
@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1>Consultations Management</h1>

        <!-- Display Existing Consultations -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    {{-- <th>Consultation ID</th> --}}
                    <th>Designer ID</th>
                    <th>Customer ID</th>
                    <th>Scheduled At</th>
                    <th>Status</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consultations as $consultation)
                    <tr>
                        {{-- <td>{{ $consultation->consultationID }}</td> --}}
                        <td>{{ $consultation->designerID }}</td>
                        <td>{{ $consultation->customerID }}</td>
                        <td>{{ $consultation->scheduledAT }}</td>
                        <td>{{ $consultation->status }}</td>
                        <td>{{ $consultation->note }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-warning btn-sm" onclick="editConsultation({{ $consultation }})"
                                data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                            <form action="{{ route('consultations.destroy', $consultation->consultationID) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <hr>

        <!-- Edit Consultation Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Consultation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editConsultationForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" name="consultationID" id="modalConsultationID">

                            <div class="mb-3">
                                <label for="modalDesignerID" class="form-label">Designer ID</label>
                                <input type="text" name="designerID" class="form-control" id="modalDesignerID" required>
                            </div>

                            <div class="mb-3">
                                <label for="modalCustomerID" class="form-label">Customer ID</label>
                                <input type="text" name="customerID" class="form-control" id="modalCustomerID" required>
                            </div>

                            <div class="mb-3">
                                <label for="modalScheduledAT" class="form-label">Scheduled At</label>
                                <input type="datetime-local" name="scheduledAT" class="form-control" id="modalScheduledAT"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="modalStatus" class="form-label">Status</label>
                                <input type="text" name="status" class="form-control" id="modalStatus" required>
                            </div>

                            <div class="mb-3">
                                <label for="modalNote" class="form-label">Note</label>
                                <textarea name="note" class="form-control" id="modalNote"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function editConsultation(consultation) {
                document.getElementById('modalConsultationID').value = consultation.consultationID;
                document.getElementById('modalDesignerID').value = consultation.designerID;
                document.getElementById('modalCustomerID').value = consultation.customerID;
                document.getElementById('modalScheduledAT').value = new Date(consultation.scheduledAT).toISOString().slice(0,
                    16);
                document.getElementById('modalStatus').value = consultation.status;
                document.getElementById('modalNote').value = consultation.note;

                // Update the form action for PUT request
                document.getElementById('editConsultationForm').action = '/consultations/' + consultation.consultationID;
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
@endsection
