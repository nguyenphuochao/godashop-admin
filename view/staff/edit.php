<?php require "layout/header.php"; ?>
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="index.php">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Nhân viên</li>
      </ol>
      <!-- /form -->
      <form method="post" action="index.php?c=staff&a=update" enctype="multipart/form-data">

         <div class="form-group row">
            <label class="col-md-12 control-label" for="fullname">Họ Và Tên</label>
            <div class="col-md-9 col-lg-6">
               <input type="hidden" name="id" value="<?= $staff->getID() ?>" class="form-control input-md">
               <input name="name" id="name" type="text" value="<?= $staff->getName() ?>" class="form-control">
            </div>
         </div>

         <div class="form-group row">
            <label class="col-md-12 control-label" for="username">Tên Đăng Nhập</label>
            <div class="col-md-9 col-lg-6">
               <input name="username" id="username" type="text" value="<?= $staff->getUsername() ?>" class="form-control">
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
               <input name="mobile" id="mobile" type="text" value="<?= $staff->getMobile() ?>" class="form-control">
            </div>
         </div>

         <div class="form-group row">
            <label class="col-md-12 control-label" for="email">Email</label>
            <div class="col-md-9 col-lg-6">
               <input name="email" id="email" type="text" value="<?= $staff->getEmail() ?>" class="form-control">
            </div>
         </div>

         <div class="form-group row">
            <label class="col-md-12 control-label" for="role">Vai trò</label>
            <div class="col-md-9 col-lg-6">
               <select class="form-control" name="role">
                  <option value="">Chọn vai trò</option>
                  <?php foreach ($roles as $role) : ?>
                     <option <?= $role->getID() == $staff->getRoleID() ? "selected" : "" ?> value="<?= $role->getID() ?>"><?= $role->getName() ?></option>
                  <?php endforeach ?>
               </select>
            </div>
         </div>

         <?php if ($staff->getRoleID() != 1) : ?>
            <div class="form-grroup">
               <label><input type="checkbox" name="is_active" value="1" <?= $staff->getIsActive() == 1 ? "checked" : "" ?>> Kích hoạt</label>
            </div>
         <?php endif ?>

         <div class="form-action">
            <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="edit">
            <a href="index.php?c=staff" class="btn btn-warning btn-sm">Quay về</a>
         </div>

      </form>
      <!-- /form -->
   </div>
<?php require "layout/footer.php"; ?>