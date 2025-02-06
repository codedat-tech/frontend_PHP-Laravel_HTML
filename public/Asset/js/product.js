function showEditForm(product)
{
    document.getElementById('editProductID').value = product.productID;
    document.getElementById('productName').value = product.name;
    document.getElementById('productPrice').value = product.price;
    document.getElementById('productQuantityInStock').value = product.quantityInStock;
    document.getElementById('InStocked').value = product.inStocked;
    document.getElementById('categoryID').value = product.categoryID;
    document.getElementById('brandID').value = product.brandID;
    document.getElementById('description').value = product.description;
    document.getElementById('status').value = product.status;

    if (product.image)
    {
        document.getElementById('edit_currentImage').src = `/Asset/Image/product/${product.image}`;
        document.getElementById('edit_imageName').innerText = product.image;
    } else
    {
        // No image available
        document.getElementById('edit_currentImage').src = '';
        document.getElementById('edit_imageName').innerText = 'No image available';
    }

    $('#updateProductModal').modal('show');

    // Set the action dynamically
    document.getElementById('productEditForm').action = `{{ url('admin/products/update') }}/${product.productID}`;
}

function showProductDetails(product)
{
    document.getElementById('detailsProductName').innerText = product.name;
    document.getElementById('detailsProductPrice').innerText = product.price;
    document.getElementById('detailsProductQuantityInStock').innerText = product.quantityInStock;
    document.getElementById('detailsProductInStocked').innerText = product.inStocked;
    document.getElementById('detailsProductCategory').innerText = product.category?.name ?? 'No Category';
    document.getElementById('detailsProductBrand').innerText = product.brand?.name ?? 'No Brand';
    document.getElementById('detailsProductDescription').innerText = product.description;

    if (product.image)
    {
        document.getElementById('detailsProductImage').src = `/Asset/Image/product/${product.image}`;
    } else
    {
        document.getElementById('detailsProductImage').src = ''; // Hoặc một hình ảnh mặc định
    }

    $('#productDetailsModal').modal('show');
    document.getElementById('productEditForm').action = `{{ url('admin/products/update') }}/${product.productID}`;
}

function sortColumn(column)
{
    // Lấy các tham số hiện tại của trang
    const urlParams = new URLSearchParams(window.location.search);
    const currentSortBy = urlParams.get('sort_by');
    const currentSortOrder = urlParams.get('sort') || 'asc';

    // 
    const newSortOrder = (currentSortBy === column && currentSortOrder === 'asc') ? 'desc' : 'asc';

    // Cập nhật URL
    urlParams.set('sort_by', column);
    urlParams.set('sort', newSortOrder);
    window.location.search = urlParams.toString();
}

// set style cursor cho cột đang được chọn
document.addEventListener('DOMContentLoaded', function ()
{
    const columns = ['name', 'category', 'brand', 'price', 'quantityInStock', 'inStocked', 'status'];
    const currentSortBy = new URLSearchParams(window.location.search).get('sort_by');

    columns.forEach(column =>
    {
        const link = document.getElementById(`sort-${column}`);
        if (link)
        {
            if (column === currentSortBy)
            {
                link.classList.add('active-sort'); //highlight cột
                link.style.opacity = 1;
            } else
            {
                link.classList.remove('active-sort');
                link.style.opacity = 0.3; // Làm mờ cột
            }
        }
    });
});