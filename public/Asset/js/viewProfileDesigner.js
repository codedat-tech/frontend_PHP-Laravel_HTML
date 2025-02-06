// 2. Use AJAX request
function viewDesigner(id)
{
    $.ajax({
        url: `/designers/${id}/edit`,
        method: 'GET',
        dataType: 'json',
        success: function (data)
        {
            document.getElementById('view_fullname').innerText = data.fullname;
            document.getElementById('view_email').innerText = data.email;
            document.getElementById('view_phone').innerText = data.phone;
            document.getElementById('view_address').innerText = data.address;
            document.getElementById('view_experienceYear').innerText = data.experienceYear;
            document.getElementById('view_specialization').innerText = data.specialization;
            document.getElementById('view_rating').innerText = data.rating;
            document.getElementById('view_status').innerText = data.status == 1 ? 'Active' : 'Inactive';
            document.getElementById('view_image').src = `/Asset/Image/designer/${data.image}`;
            // Cập nhật link portfolio
            const portfolioLink = document.getElementById('view_portfolio');
            portfolioLink.href = `/Asset/PDF/portfolio/${data.portfolio}`;
            portfolioLink.innerText = data.portfolio ? "View Portfolio" : "No Portfolio Available";

            $('#viewDesignerModal').modal('show');
        },
        error: function (xhr, status, error)
        {
            console.error('Error fetching designer details:', error);
        }
    });
}