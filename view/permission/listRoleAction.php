<?php require "layout/header.php"; ?>
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">Phân quyền</li>
         <li class="breadcrumb-item">
            <a href="index.php?c=permission&a=roleList">Vai trò</a>
         </li>
         <li class="breadcrumb-item">Vai trò</li>
         <li class="breadcrumb-item">Tác vụ</li>
      </ol>
      <!-- /form -->
      <form class="form-horizontal" method="post" action="index.php?c=permission&a=updateRoleAction" enctype="multipart/form-data">
         <div class="form-group row">
            <input type="hidden" name="role_id" value="<?= $role->getID() ?>" class="form-control input-md">
            <?php foreach ($actions as $action) : ?>
               <div class="col-md-9 col-lg-6">
                  <input type="checkbox" name="action_ids[]" value="<?= $action->getID() ?>">
                  <?= $action->getDescription() ?>
               </div>
            <?php endforeach; ?>
         </div>
         <div class="form-action">
            <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
            <a href="index.php?c=permission&a=listRole" class="btn btn-warning btn-sm">Quay về</a>
         </div>
      </form>
      <!-- /form-->
   </div>
   <?php require "layout/footer.php"; ?>