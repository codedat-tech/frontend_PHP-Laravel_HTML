<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Product Management</h1>
        
        <!-- Display success message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Product Creation Form -->
        <form action="{{ url('products') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Product Name" required>
            <textarea name="description" placeholder="Product Description" required></textarea>
            <input type="number" step="0.01" name="price" placeholder="Product Price" required>
            <button type="submit">Add Product</button>
        </form>

        <!-- Product Table -->
        <table border="1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>${{ $product->price }}</td>
                        <td>
                            <!-- Edit Form -->
                            <form action="{{ url('products/' . $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $product->name }}" required>
                                <textarea name="description" required>{{ $product->description }}</textarea>
                                <input type="number" step="0.01" name="price" value="{{ $product->price }}" required>
                                <button type="submit">Update</button>
                            </form>
                            
                            <!-- Delete Form -->
                            <form action="{{ url('products/' . $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
