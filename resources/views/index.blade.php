<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>






<!-- <h1>Welcome, {{ $username }}!</h1>

<!-- Display success message if any -->
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif



    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <h2>Navigation</h2>
        <a href="{{ url('products') }}">Products</a>
        <a href="{{ url('categories') }}">Category</a>
        <a href="{{ url('admin') }}">Logout</a>
        <!-- Add more links as needed -->
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Mobile Nav Toggle Button -->
        <button class="mobile-nav-toggle">&#9776;</button>
        
        <!-- Page Content -->
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

    <!-- Category Dropdown -->
    <select name="category_name" required>
        <option value="">Select Category</option>
        <?php if(!empty($categories)) {?>
        @foreach ($categories as $category)
            <option value="{{ $category->name }}">{{ $category->name }}</option>
        @endforeach
        <?php } ?>
    </select>

    <button type="submit">Add Product</button>
</form>


            <!-- Product Table -->
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($products)) {?>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>${{ $product->price }}</td>
                            <td>{{ $product->category_name }}</td>
                            <td>
                                <!-- Edit Form -->
                                <form action="{{ url('products/' . $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="name" value="{{ $product->name }}" required>
                                    <textarea name="description" required>{{ $product->description }}</textarea>
                                    <input type="number" step="0.01" name="price" value="{{ $product->price }}" required>
                                    <select name="category_name" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->name }}" {{ $category->name == $product->category_name ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
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
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- JavaScript to toggle mobile menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toggleButton = document.querySelector('.mobile-nav-toggle');
            var sidebar = document.querySelector('.sidebar');

            if (toggleButton && sidebar) {
                toggleButton.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }
        });


        
    </script>
</body>
</html>
