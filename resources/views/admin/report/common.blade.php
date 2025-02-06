<div class="row">
    <div class="col-sm-3">
        <!-- box 1 -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Products</h3>

                <p class="report-count">{{ $productCount }}</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/admin/report/products" class="small-box-footer">Show info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-sm-3">
        <!-- box 2-->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Orders</sup></h3>

                <p class="report-count">{{ $orderCount }}</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="/admin/report/orders" class="small-box-footer">Show info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-sm-3">
        <!-- box 3 -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>Users</h3>

                <p class="report-count">{{ $userCount }}</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="/admin/report/cusdesign" class="small-box-footer">Show info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-sm-3">
        <!-- box 4-->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Consultations</h3>

                <p class="report-count">{{ $consultationCount }}</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/admin/report/consultations" class="small-box-footer">Show info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
