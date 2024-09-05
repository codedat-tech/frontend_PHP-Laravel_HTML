<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Management</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container">
        <h1>Categories Management</h1>

        <!-- Success Message -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <!-- Create Category Form -->
        <h2>Create New Category</h2>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            
            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
            
            <button type="submit" class="btn btn-primary">Save</button>
        </form>

        <!-- Categories List -->
        <h2>Categories List</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)) {?>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <!-- Edit Category Form -->
                            <form action="{{ route('categories.update', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="button" onclick="editCategory({{ $category->id }})" class="btn btn-warning">Edit</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <?php }?>
            </tbody>
        </table>
    </div>

    <!-- Edit Category Modal -->
    <div id="editModal" style="display:none;">
        <div class="modal-content">
            <h2>Edit Category</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">
                <label for="edit_name">Name:</label>
                <input type="text" id="edit_name" name="name" required>
                
                <label for="edit_description">Description:</label>
                <textarea id="edit_description" name="description"></textarea>
                
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" onclick="closeEditModal()" class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function editCategory(id) {
            fetch(`/categories/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_name').value = data.name;
                    document.getElementById('edit_description').value = data.description;
                    document.getElementById('editForm').action = `/categories/${id}`;
                    document.getElementById('editModal').style.display = 'block';
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>
</html>
