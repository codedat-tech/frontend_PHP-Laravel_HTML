@extends('admin.layout.index')

@section('content')
    <div class="container mt-4">
        <h1>Products Management</h1>
        <h3 class="h5">Add New Product</h3>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control" placeholder="Product Name" required>
            </div>
            <div class="form-group mb-3">
                <label for="price">Product Price</label>
                <input type="number" step="0.01" name="price" class="form-control" placeholder="Product Price"
                    required>
            </div>
            <div class="form-group mb-3">
                <label for="quantity">Product Quantity</label>
                <input type="number" name="quantity" class="form-control" placeholder="Product Quantity" required>
            </div>
            <div class="form-group mb-3">
                <label for="categoryID">Category</label>
                <select name="categoryID" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->categoryID }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="brandID">Brand</label>
                <select name="brandID" class="form-control" required>
                    <option value="">Select Brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->brandID }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="image">Product Image</label>
                <input type="file" name="image" class="form-control-file" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
@endsection
