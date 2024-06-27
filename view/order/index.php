<?php require "layout/header.php"; ?>
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Quản lý</a>
            </li>
            <li class="breadcrumb-item active">Đơn hàng</li>
        </ol>
        <!-- DataTables Example -->
        <div class="action-bar">
            <input type="submit" class="btn btn-primary btn-sm" value="Thêm" name="add">
            <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
        </div>
        <div class="card mb-3">
            <?=messageStatus(); ?>
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