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

        <div class="row">
            <div class="col-sm-12 ">
                <label for="name" class="control-label">Đơn hàng: #<?= $order->getID() ?></label>
                <input type="hidden" name="id" value="112">
            </div>
        </div>
        <div class="row ">
            <div class="col-sm-4 col-lg-2">
                <label">Tên khách hàng:</label>
            </div>
            <div class="col-sm-8 col-lg-10">
                <span><?= $order->getCustomer()->getName(); ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-lg-2">
                <label>Điện thoại:</label>
            </div>
            <div class="col-sm-8 col-lg-10">
                <span><?= $order->getCustomer()->getMobile(); ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-lg-2">
                <label>Email:</label>
            </div>
            <div class="col-sm-8 col-lg-10">
                <span><?= $order->getCustomer()->getEmail(); ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-lg-2">
                <label>Trạng thái:</label>
            </div>
            <div class="col-sm-8 col-lg-10">
                <span><?= $order->getStatus()->getDescription(); ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-lg-2">
                <label>Ngày đặt hàng:</label>
            </div>
            <div class="col-sm-8 col-lg-10">
                <span><?= $order->getCreatedDate(); ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-lg-2">
                <label>Hình thức thanh toán:</label>
            </div>
            <div class="col-sm-8 col-lg-10">
                <span><?= $order->getPaymentMethod() == 0 ? "COD" : "BANK" ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-lg-2">
                <label>Phí giao hàng:</label>
            </div>
            <div class="col-sm-8 col-lg-10">
                <span><?= number_format($order->getShippingFee()); ?> đ</span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-lg-2">
                <label>Tạm tính:</label>
            </div>
            <div class="col-sm-8 col-lg-10">
                <span><?= number_format($order->getSubTotal()); ?> đ</span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-lg-2">
                <label>Tổng cộng:</label>
            </div>
            <div class="col-sm-8 col-lg-10">
                <span><?= number_format($order->getSubTotal() + $order->getShippingFee()); ?> đ</span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-lg-2">
                <label>Địa chỉ giao hàng:</label>
            </div>
            <div class="col-sm-8 col-lg-10">
                <span>
                    <?= $order->getShippingHousenumberStreet(); ?>,
                    <?= $order->getWard()->getName(); ?>,
                    <?= $order->getWard()->getDistrict()->getName(); ?>,
                    <?= $order->getWard()->getDistrict()->getProvince()->getName(); ?>
                </span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-lg-2">
                <label>Nhân viên phụ trách:</label>
            </div>
            <div class="col-sm-8 col-lg-10">
                <span><?= $order->getStaff() ? $order->getStaff()->getName() : "" ?></span>
            </div>
        </div>
        <label class="control-label">Sản phẩm</label>
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $order_items = $order->getOrderItem();
                            ?>
                            <?php foreach ($order_items as $order_item) :
                                $product = $order_item->getProduct();
                            ?>
                                <tr>
                                    <td><a href="index.php?c=product&a=edit&id=<?= $product->getID() ?>">#<?= $product->getBarCode() ?></a></td>
                                    <td><?= $product->getName(); ?></td>
                                    <td><img src="uploads/<?= $product->getFeaturedImage(); ?>"></td>
                                    <td><?= number_format($order_item->getUnitPrice()) ?> đ</td>
                                    <td><?= $order_item->getQty(); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <?php require "layout/footer.php"; ?>