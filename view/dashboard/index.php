<?php require "layout/header.php"; ?>
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Tổng quan</li>
        </ol>
        <div class="mb-3 my-3">
            <?php $type = !empty($_GET["type"]) ? $_GET["type"] : "today"; ?>
            <a href="?type=today&from_date=<?= date('Y-m-d') ?>&to_date=<?= date('Y-m-d') ?>" class="<?= $type == 'today' ? 'active' : '' ?> btn btn-primary">Hôm nay</a>
            <a href="?type=yesterday&from_date=<?= date('Y-m-d', strtotime("-1 days")) ?>&to_date=<?= date('Y-m-d', strtotime("-1 days")) ?>" class="<?= $type == 'yesterday' ? 'active' : '' ?> btn btn-primary">Hôm qua</a>
            <a href="?type=thisweek&from_date=<?= date('Y-m-d', strtotime("this week")) ?>&to_date=<?= date('Y-m-d') ?>" class="<?= $type == 'thisweek' ? 'active' : '' ?> btn btn-primary">Tuần này</a>
            <a href="?type=thismonth&from_date=<?= date('Y-m-01') ?>&to_date=<?= date('Y-m-d') ?>" class="<?= $type == 'thismonth' ? 'active' : '' ?> btn btn-primary">Tháng này</a>
            <a href="?type=3months&from_date=<?= date('Y-m-d', strtotime("-3 months")) ?>&to_date=<?= date('Y-m-d') ?>" class="<?= $type == '3months' ? 'active' : '' ?> btn btn-primary">3 tháng</a>
            <a href="?type=thisyear&from_date=<?= date('Y-01-01') ?>&to_date=<?= date('Y-m-d') ?>" class="<?= $type == 'thisyear' ? 'active' : '' ?> btn btn-primary">Năm này</a>
            <div class="dropdown" style="display:inline-block">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <div style="margin:20px">
                        <form action="index.php?c=dashboard">
                            Từ ngày <input type="date" name="from_date" class="form-control" id="usr" value="<?= $type == 'custom' ? $_GET["from_date"] : "" ?>">
                            Đến ngày <input type="date" name="to_date" class="form-control" id="usr" value="<?= $type == 'custom' ? $_GET["to_date"] : "" ?>">
                            <input type="hidden" name="type" value="custom">
                            <br>
                            <input type="submit" value="Tìm" class="btn btn-primary form-control">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Icon Cards-->
        <div class="row">
            <div class="col-xl-4 col-sm-6 mb-3">
                <div class="card text-white bg-warning o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-list"></i>
                        </div>
                        <div class="mr-5"><?= count($orders); ?> Đơn hàng</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                        <span class="float-left">Chi tiết</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <!-- Tính toán doanh thu -->
            <?php
            $total_revenue = 0; // tổng doanh thu
            $order_cancel = 0; // số lượng đơn hàng bị hủy
            foreach ($orders as $order) {
                if ($order->getOrderStatusID() != 6) {
                    $total_revenue += $order->getSubTotal() + $order->getShippingFee();
                } else {
                    $order_cancel++;
                }
            }
            ?>
            <div class="col-xl-4 col-sm-6 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-shopping-cart"></i>
                        </div>

                        <div class="mr-5">Doanh thu <?= number_format($total_revenue); ?> đ</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                        <span class="float-left">Chi tiết</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-3">
                <div class="card text-white bg-danger o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-life-ring"></i>
                        </div>
                        <div class="mr-5"><?= $order_cancel ?> đơn hàng bị hủy</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                        <span class="float-left">Chi tiết</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Đơn hàng
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã</th>
                                <th>Tên khách hàng</th>
                                <th>Điện thoai</th>
                                <th>Email</th>
                                <th>Trạng Thái</th>
                                <th>Ngày đặt hàng</th>
                                <th>Phương thức thanh toán</th>
                                <th>Người nhận</th>
                                <th>Số điện thoại nhận</th>
                                <th>Ngày giao hàng</th>
                                <th>Phí giao hàng</th>
                                <th>Tạm tính</th>
                                <th>Tổng cộng</th>
                                <th>Địa chỉ giao hàng</th>
                                <th>Nhân viên phụ trách</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php require "layout/order.php"; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php require "layout/footer.php"; ?>