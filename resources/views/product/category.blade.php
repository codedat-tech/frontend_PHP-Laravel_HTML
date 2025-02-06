@extends('layouts.index')
@section('content')
    <style>
        /* category */
        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .category {
            padding: 100px 0 0;
        }

        .category-top {
            margin-bottom: 50px;
            display: flex;
            align-items: center;
        }

        .category-top p {
            font-family: var(--main-text-font);
            margin: 0 12px;
            font-size: 12px;
            white-space: nowrap;
        }

        .category-top span,
        .category-top p {
            display: inline-block;
            /* Forces inline behavior */
        }

        .category-top span {
            font-size: 12px;
            margin: 0 12px;
        }

        .category-left {
            width: 20%;
        }

        .category-right {
            width: 80%;
        }

        .category-right-top-item:first-child {
            flex: 2;
            font-size: 16px;
            font-family: var(--main-text-font);
            font-weight: bold;
        }

        .category-right-top-item {
            flex: 1;
            padding: 0 12px;
        }

        .category-right-top-item button {
            width: 100%;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            background-color: #ffff;
            border: 1px solid #dddddd;
            cursor: pointer;
        }

        .category-right-top-item select {
            width: 100%;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            background-color: #ffff;
            border: 1px solid #dddddd;
            cursor: pointer;
        }

        .category-right-content {
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;
            justify-content: flex-start;
            gap: 18px;
        }

        .category-right-content-item {
            width: calc(33.33% - 12px);
            text-align: center;
            padding: 12px 0;
        }

        .category-right-content-item h1 {
            font-size: 15px;
            font-family: var(--main-text-font);
            margin-top: 6px;
            color: #333333;
        }

        .category-right-content-item img {
            width: 100%;
            height: 250px;
        }

        .category-right-content-item p {
            font-size: 15px;
        }

        .category-right-bottom {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            width: 100%;
        }

        .category-right-bottom p {
            font-family: var(--main-text-font);
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .page-number {
            margin: 0 10px;
            padding: 8px 12px;
            border: 1px solid #ddd;
            cursor: pointer;
            border-radius: 4px;
        }

        .category-right-bottom-items span {
            padding: 0 8px;
            cursor: pointer;
        }

        .category-left ul li {
            padding: 12px 0;
            position: relative;
        }

        .category-left ul li ul {
            display: none;
            position: relative;
            /* left: 100%; */
            top: 0;
        }

        .category-left ul li>a {
            color: black;
            font-size: 16px;
            font-weight: bold;
            font-family: var(--main-text-font);
        }

        .category-left ul li ul li {
            position: relative;
            padding-left: 10px;
        }

        .category-left ul li ul li a {
            color: #333333;
            font-size: 12px;
        }

        .category-left-li ul {
            display: none;
        }

        .category-left-li.block ul {
            display: block;
        }

        /* Cố định chiều cao của card */
        .product-card {
            width: 300px;
            /* Cố định chiều cao của card */
            display: flex;
            flex-direction: column;
            /* Để các phần tử trong card được sắp xếp theo chiều dọc */
        }

        /* Cố định kích thước ảnh sản phẩm */
        .product-img {
            padding-top: 5px;
            width: 150px;
            height: 150px;
            object-fit: cover;
            /* Cố định tỉ lệ ảnh mà không bị méo */
            margin: 0 auto;
            /* Căn giữa ảnh */
        }

        /* Đảm bảo rằng thẻ card-body chiếm phần còn lại của card */
        .card-body {
            /* flex-grow: 1; */
            /* Cho phép card-body chiếm phần còn lại của card */

            height: 40%;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 5px;
        }
    </style>

    <body>
        <div class="container mt-4">
            <!-- Filter and Search Section -->
            <form method="GET" action="{{ route('category.show', ['categoryID' => $category->categoryID]) }}">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <p><strong>Category | </strong> {{ $category->name }}</p>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="search" id="search" class="form-control"
                            placeholder="Search by product name" size="20" oninput="searchProducts()">
                    </div>
                    <div class="col-md-2">
                        <form method="GET" action="{{ route('category.show', ['categoryID' => $category->categoryID]) }}">
                            <select name="sort_by" id="sort_by" class="form-select" onchange="this.form.submit()">
                                <option value="price"
                                    {{ request('sort_by') == 'price' && request('sort') == 'asc' ? 'selected' : '' }}>Price:
                                    Low to High</option>
                                <option value="price"
                                    {{ request('sort_by') == 'price' && request('sort') == 'desc' ? 'selected' : '' }}>
                                    Price: High to Low</option>
                            </select>
                            <input type="hidden" name="sort" value="{{ request('sort') == 'asc' ? 'desc' : 'asc' }}">
                        </form>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Product Grid Section -->
        <section class="category">
            @if ($noResults)
                <p>No products found in this category.</p>
            @else
                <div class="row" id="product-list">
                    {{-- <div id="product-list"> --}}
                    @foreach ($products as $product)
                        <div class="col-md-3 mb-4">
                            <div class="card product-card">
                                <img src="{{ asset('Asset/Image/product/' . $product->image) }}"
                                    class="card-img-top product-img" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <div class="product-name d-flex align-items-center justify-content-center">
                                        <h6 class="me-1 mb-0">Name:</h6>
                                        <h5 class="card-title mb-0">{{ $product->name }}</h5>
                                    </div>
                                    <div class="product-name d-flex align-items-center justify-content-center">
                                        <h6 class="me-1 mb-0">Brand:</h6>
                                        <h6 class="card-title mb-0">{{ optional($product->brand)->name }}</h6>
                                    </div>


                                    <p class="card-text">{{ number_format($product->price, 0, ',', '.') }}<sup>USD</sup>
                                    </p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="{{ route('product.detail', ['productID' => $product->productID]) }}"
                                            class="btn btn-primary me-2">View Details</a>

                                        <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="productID" value="{{ $product->productID }}">
                                            <input type="hidden" name="product_qty" value="1">
                                            <button type="submit" class="btn btn-success ms-2">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- </div> --}}
                </div>
                <div class="pagination justify-content-center">
                    {{ $products->appends(request()->input())->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </section>
        </div>
    </body>
@endsection

@section('scripts')
    @parent
    <script>
        // category.js
        const itemslidebar = document.querySelectorAll('.category-left-li');
        itemslidebar.forEach(function(menu, index) {
            menu.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent the default link behavior
                menu.classList.toggle("block"); // Toggle the "block" class
            });
        });

        function searchProducts() {
            const query = document.getElementById('search').value;
            const categoryID = {{ $category->categoryID }};

            // Gửi yêu cầu AJAX đến server
            fetch(`/search-products?categoryID=${categoryID}&query=${query}`)
                .then(response => response.json())
                .then(data => {
                    // Xóa nội dung cũ và cập nhật kết quả tìm kiếm mới
                    const productList = document.getElementById('product-list');
                    productList.innerHTML = ''; // Xóa danh sách sản phẩm cũ

                    if (data.products.length > 0) {
                        data.products.forEach(product => {
                            productList.innerHTML += `
                            <div class="col-md-3 mb-4">
                                <div class="card product-card">
                                    <img src="/Asset/Image/product/${product.image}" class="card-img-top product-img" alt="${product.name}">
                                    <div class="card-body">
                                        <h5 class="card-title">${product.name}</h5>
                                        <p class="card-text">${product.price.toLocaleString()}<sup>USD</sup></p>
                                        <p>
                                            <a href="/product_detail/${product.productID}" class="btn btn-primary">View Details</a>
                                            <form action="/cart/add" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="productID" value="${product.productID}">
                                                <input type="hidden" name="product_qty" value="1">
                                                <button type="submit" class="btn btn-success ms-2">Add to Cart</button>
                                            </form>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        `;
                        });
                    } else {
                        productList.innerHTML = '<p>No products found.</p>';
                    }
                });
        }
    </script>
@endsection
