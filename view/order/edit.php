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
        <form class="spacing" method="post" action="index.php?c=order&a=update" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12 ">
                    <label for="name" class="control-label">Đơn hàng: #<?= $order->getID() ?></label>
                    <input type="hidden" name="id" value="<?= $order->getID() ?>">
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-4 col-lg-2">
                    <label>Tên khách hàng:</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <span><?= $order->getCustomer()->getName() ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Email:</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <span><?= $order->getCustomer()->getEmail() ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Trạng thái:</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <select name="status" class="form-control">
                        <?php foreach ($statues as $status) : ?>
                            <option value="<?= $status->getID() ?>" <?= $order->getOrderStatusID() == $status->getID() ? "selected" : "" ?>><?= $status->getDescription(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Ngày đặt hàng:</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <span><?= $order->getCreatedDate(); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Người nhận</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <input type="text" name="shipping_fullname" value="<?= $order->getShippingFullname() ?>" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Số điện thoại người nhận</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <input type="text" name="shipping_mobile" value="<?= $order->getShippingMobile() ?>" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Hình thức thanh toán</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <select name="payment_method" class="form-control">
                        <option <?= $order->getPaymentMethod() == 0 ? "selected" : "" ?> value="0">COD</option>
                        <option <?= $order->getPaymentMethod() == 1 ? "selected" : "" ?> value="1">Bank</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Tạm tính:</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <span><?= number_format($order->getSubTotal()); ?> đ</span>
                    <input type="hidden" name="subtotal" value="<?=$order->getSubTotal()?>">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Phí giao hàng:</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <input type="number" name="shipping_fee" value="<?= $order->getShippingFee() ?>"> đ
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Tổng cộng:</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <span class="total"><?= number_format($order->getSubTotal() + $order->getShippingFee()); ?> đ</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-lg-2">
                    <label>Địa chỉ giao hàng</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <div class="row">
                        <!-- Province -->
                        <div class="col-sm-4">
                            <select name="province" class="form-control province">
                                <option value="">Tỉnh / thành phố</option>
                                <?php foreach ($provinces as $province) : ?>
                                    <option <?=$province_id == $province->getID() ? "selected" : "" ?> value="<?= $province->getID() ?>"><?= $province->getName(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- District -->
                        <div class="col-sm-4">
                            <select name="district" class="form-control district" required>
                                <option value="">Quận / huyện</option>
                                <?php foreach ($districts as $district) : ?>
                                    <option <?=$district_id == $district->getID() ? "selected" : "" ?> value="<?= $district->getID() ?>"><?= $district->getName() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Ward -->
                        <div class="col-sm-4">
                            <select name="ward" class="form-control ward">
                                <option value="">Phường / xã</option>
                                <?php foreach ($wards as $ward) : ?>
                                    <option <?=$order->getShippingWardID() == $ward->getID() ? "selected" : ""?> value="<?= $ward->getID() ?>"><?= $ward->getName() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- shipping_housenumber_street -->
                         <div class="col-sm-12">
                            <input type="text" class="form-control mt-2" name="shipping_housenumber_street" value="<?=$order->getShippingHousenumberStreet() ?>">
                         </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Ngày giao hàng</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <input type="date" name="delivered_date" value="<?= $order->getDeliveredDate() ?>" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Nhân viên phụ trách</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <select name="staff" class="form-control">
                        <option value="">Vui lòng chọn</option>
                        <?php foreach ($staffs as $staff) : ?>
                            <option <?= $order->getStaffID() == $staff->getID() ? "selected" : ""; ?> value="<?= $staff->getID() ?>"><?= $staff->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <label class="control-label">Sản phẩm</label>
            <div class="form-group">
                <button class="btn btn-primary btn-sm">Thêm sản phẩm</button>
                <input type="submit" class="btn btn-danger btn-sm" value="Xóa sản phẩm" name="delete">
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" onclick="checkAll(this)"></th>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
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
                                        <td><input type="checkbox"></td>
                                        <td><a href="index.php?c=product&a=edit&id=<?= $product->getID() ?>">#<?= $product->getBarCode() ?></a></td>
                                        <td><?= $product->getName(); ?></td>
                                        <td><img src="uploads/<?= $product->getFeaturedImage(); ?>"></td>
                                        <td><?= number_format($order_item->getUnitPrice()) ?></td>
                                        <td><span><?= $order_item->getQty(); ?></span></td>
                                        <td><span><?= number_format($order_item->getTotalPrice()); ?> đ</span></td>
                                    </tr>
                                    <input style="display: none;" type="text" name="ids[]" value="<?=$product->getID()?>">
                                    <input style="display: none;" type="text" name="qtys[]" value="<?=$order_item->getQty()?>">
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="form-action">
                <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="edit">
            </div>
            <br>
        </form>
    </div>
    <!-- /.row -->
    <!-- /.row -->

    <!-- /.row -->
</div>
<?php require "layout/footer.php"; ?>

<script>
    $(function(){
        // ajax district
        $(".province").change(function(){
            var province_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "index.php?c=order&a=ajaxGetDistrict",
                data: {
                    province_id : province_id
                },
                success: function (response) {
                   $(".district").html(response);
                }
            });
        });

        // ajax ward
        $(".district").change(function(){
            var district_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "index.php?c=order&a=ajaxGetWard",
                data: {
                    district_id : district_id
                },
                success: function (response) {
                   $(".ward").html(response);
                }
            });
        });
        
        // ajax shipping_fee
        $(".province").change(function(){
            var province_id = $(this).val();
            var subtotal = $("input[name=subtotal]").val();
            var total = 
            $.ajax({
                type: "GET",
                url: "index.php?c=order&a=ajaxGetShippingFee",
                data: {
                    province_id : province_id,
                    subtotal : subtotal
                },
                success: function (response) {
                    var data = JSON.parse(response);
                   $("input[name=shipping_fee]").val(data.shipping_fee);
                   $(".total").html(data.total);
                }
            });
        });
    });
</script>