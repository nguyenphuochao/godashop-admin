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
                    <select class="form-control" name="customer_id" required>
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
                            <option <?= $status->getID() == 1 ? 'selected' : '' ?> value="<?= $status->getID() ?>">
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
                    <input type="text" name="shipping_fullname" class="form-control">
                </div>
            </div>
            <!-- shipping_mobile -->
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Số điện thoại người nhận</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <input type="text" name="shipping_mobile" class="form-control">
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
                    <div class="row">
                        <!-- Province -->
                        <div class="col-sm-4">
                            <select name="province" class="form-control province">
                                <option value="">Tỉnh / thành phố</option>
                                <?php foreach ($provinces as $province) : ?>
                                    <option value="<?= $province->getID() ?>"><?= $province->getName(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- District -->
                        <div class="col-sm-4">
                            <select name="district" class="form-control district" required>
                                <option value="">Quận / huyện</option>
                                <?php foreach ($districts as $district) : ?>
                                    <option value="<?= $district->getID() ?>"><?= $district->getName() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Ward -->
                        <div class="col-sm-4">
                            <select name="ward" class="form-control ward">
                                <option value="">Phường / xã</option>
                                <?php foreach($wards as $ward) : ?>
                                    <option value="<?=$ward->getID() ?>"><?=$ward->getName() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- shipping_housenumber_street -->
                         <div class="col-sm-12 mt-2">
                            <input type="text" name="shipping_housenumber_street" class="form-control">
                         </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Ngày giao hàng</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <input type="date" name="delivered_date" value="<?= date('Y-m-d') ?>" class="form-control">
                </div>
            </div>

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

            <div class="form-action">
                <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
            </div>
            <br>
        </form>
        <!-- /.row -->
        <!-- /.row -->

        <!-- /.row -->
    </div>

<?php require "layout/footer.php"; ?>

<script>
    $(function(){
        // ajax district
        $(".district").find('option').not(':first').remove();
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
        $(".ward").find('option').not(':first').remove();
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
    });
</script>