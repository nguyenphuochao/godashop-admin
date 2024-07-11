<?php require "layout/header.php"; ?>
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="index.php">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Danh mục</li>
      </ol>
      <!-- /form -->
      <form method="post" action="index.php?c=category&a=update" enctype="multipart/form-data">
         <div class="form-group row">
            <label class="col-md-12 control-label" for="name">Tên</label>
            <div class="col-md-9 col-lg-6">
               <input type="hidden" name="id" value="<?=$category->getID() ?>" class="form-control">
               <input name="name" id="name" type="text" value="<?=$category->getName() ?>" class="form-control">
            </div>
         </div>
         <div class="form-action">
            <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="update">
         </div>
      </form>
      <!-- /form -->
   </div>
<?php require "layout/footer.php"; ?>