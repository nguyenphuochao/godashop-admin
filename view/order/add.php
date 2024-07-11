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
        <!-- /.row -->
        <form class="spacing" method="post" action="index.php?c=order&a=store" enctype="multipart/form-data">
            <!-- customer_id -->
            <div class="row ">
                <div class="col-sm-4 col-lg-2">
                    <label>Tên khách hàng:</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <select class="form-control chosen-customer" name="customer_id" required>
                        <option value="">Chọn khách hàng</option>
                        <?php foreach ($customers as $customer) : ?>
                            <option value="<?= $customer->getID() ?>"><?= $customer->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- order_status_id -->
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Trạng thái:</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <select name="order_status_id" class="form-control">
                        <?php foreach ($statuses as $status) : ?>
                            <option <?= $status->getID() == 5 ? 'selected' : '' ?> value="<?= $status->getID() ?>">
                                <?= $status->getDescription(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- shipping_fullname -->
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Người nhận</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <input type="text" name="shipping_fullname" class="form-control shipping-name">
                </div>
            </div>
            <!-- shipping_mobile -->
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Số điện thoại người nhận</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <input type="text" name="shipping_mobile" class="form-control shipping-mobile">
                </div>
            </div>
            <!-- payment_method -->
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Hình thức thanh toán</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <select name="payment_method" class="form-control">
                        <option selected value="0">COD</option>
                        <option value="1">Bank</option>
                    </select>
                </div>
            </div>
            <!-- address -->
            <div class="row">
                <div class="col-sm-4 col-lg-2">
                    <label>Địa chỉ giao hàng</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <?php require "layout/address_variable.php" ?>
                    <div class="row">
                        <?php require "layout/address_layout.php"; ?>
                        <!-- shipping_housenumber_street -->
                        <div class="col-sm-12 mt-2">
                            <input type="text" name="shipping_housenumber_street" placeholder="Số nhà, đường" class="form-control housenumber-street">
                        </div>
                    </div>
                </div>

            </div>
            <!-- delivered_date -->
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Ngày giao hàng</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <input type="date" name="delivered_date" value="<?= date('Y-m-d') ?>" class="form-control">
                </div>
            </div>

            <!-- staff_id  -->
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Nhân viên phụ trách</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <select name="staff_id" class="form-control">
                        <?php foreach ($staffs as $staff) : ?>
                            <option value="<?= $staff->getID() ?>"><?= $staff->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Subtotal -->
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Tạm tính:</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <span class="sub-total">đ</span>
                </div>
            </div>

            <!-- Shipping_fee -->
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Phí giao hàng:</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <input name="shipping_fee" class="shipping-fee form-control" type="number" value="" required>
                </div>
            </div>

            <!-- Total -->
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Tổng cộng:</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <span class="payment-total">đ</span>
                </div>
            </div>
            <!-- Search Product -->
            <label class="control-label">Sản phẩm</label>
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label for="search-barcode">Nhập barcode: </label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <input type="number" name="search-barcode" id="search-barcode" class="form-control">
                </div>
            </div>
            <!-- Table Product -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover product-item" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Barcode</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="form-action">
                <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
                <a href="index.php?c=order" class="btn btn-warning btn-sm">Hủy</a>
            </div>
            <br>
        </form>
        <!-- /.row -->
        <!-- /.row -->

        <!-- /.row -->
    </div>

    <?php require "layout/footer.php"; ?>