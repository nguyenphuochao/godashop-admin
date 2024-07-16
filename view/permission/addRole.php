<?php require "layout/header.php"; ?>
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="index.php">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Vai trò</li>
      </ol>
      <!-- /form -->
      <form class="form-horizontal" method="post" action="index.php?c=permission&a=saveRole" enctype="multipart/form-data">
         <div class="form-group row">
            <label class="col-md-12 control-label" for="name">Tên</label>
            <div class="col-md-9 col-lg-6">
               <input name="name" id="name" type="text" class="form-control" required>
            </div>
         </div>
         <div class="form-action">
            <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
            <a href="index.php?c=permission&a=listRole" class="btn btn-warning btn-sm">Quay về</a>
         </div>
      </form>
      <!-- /form-->
   </div>
   <?php require "layout/footer.php"; ?>