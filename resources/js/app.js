// Import DataTables CSS
import 'datatables.net-dt/css/jquery.dataTables.css';
import 'datatables.net-dt/css/jquery.dataTables.min.css';

// Import jQuery và DataTables JS
import 'datatables.net';
import $ from 'jquery';

// Khởi tạo DataTables
$(document).ready(function ()
{
    $('#products-table').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
    });
});
