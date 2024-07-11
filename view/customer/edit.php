<?php require "layout/header.php"; ?>

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Quản lý</a>
            </li>
            <li class="breadcrumb-item active">Khách hàng</li>
        </ol>
        <!-- /form -->
        <form method="post" action="index.php?c=customer&a=update" enctype="multipart/form-data">

            <div class="form-group row">
                <label class="col-md-12 control-label" for="fullname">Tên</label>
                <div class="col-md-9 col-lg-6">
                    <input type="hidden" name="id" value="<?= $customer->getID() ?>" class="form-control">
                    <input name="fullname" id="fullname" type="text" value="<?= $customer->getName() ?>" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-12 control-label" for="email">Email</label>
                <div class="col-md-9 col-lg-6">
                    <input name="email" id="email" type="text" value="<?= $customer->getEmail() ?>" class="form-control" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-12 control-label" for="password">Mật Khẩu</label>
                <div class="col-md-9 col-lg-6">
                    <input name="password" id="password" type="password" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-12 control-label" for="mobile">Số Điện Thoại</label>
                <div class="col-md-9 col-lg-6">
                    <input name="mobile" id="mobile" type="text" value="<?= $customer->getMobile() ?>" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-12 control-label" for="loginby">Đăng nhập từ</label>
                <div class="col-md-9 col-lg-6">
                    <select class="form-control">
                        <option <?= $customer->getLoginBy() == 'form' ? "selected" : "" ?> value="form">Form</option>
                        <option <?= $customer->getLoginBy() == 'google' ? "selected" : "" ?> value="google">Google</option>
                        <option <?= $customer->getLoginBy() == 'facebook' ? "selected" : "" ?> value="facebook">Facebook</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-12 control-label" for="">Địa chỉ</label>
                <?php require "layout/address_variable.php" ?>
                <?php require "layout/address_layout.php"; ?>
            </div>

            <div class="form-group row">
                <div class="col-md-9 col-lg-6">
                    <input type="text" class="form-control" placeholder="Số nhà, đường" name="housenumumber_street" value="<?=$customer->getHousenumberStreet() ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-12 control-label" for="mobile">Tên người nhận</label>
                <div class="col-md-9 col-lg-6">
                    <input name="shipping_name" id="shipping_name" type="text" value="<?=$customer->getShippingName() ?>" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-12 control-label" for="mobile">Số điện thoại người nhận</label>
                <div class="col-md-9 col-lg-6">
                    <input name="shipping_mobile" id="shipping_mobile" type="tel" value="<?=$customer->getShippingMobile() ?>" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-12 control-label" for="mobile">Đã kích hoạt</label>
                <div class="col-md-9 col-lg-6">
                    <input name="active" id="active" type="checkbox" value="1" <?=$customer->getIsActive() == 1 ? "checked" : "" ?>>
                </div>
            </div>

            <div class="form-action">
                <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="update">
                <a href="index.php?c=customer" class="btn btn-warning btn-sm">Quay về</a>
            </div>
        </form>
        <!-- /form -->
    </div>

    <?php require "layout/footer.php"; ?>