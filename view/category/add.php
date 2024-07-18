<?php require "layout/header.php"; ?>
<style>
   .plus-item,
   .minus-item {
      background: #2fc061;
      color: white;
      font-weight: bold;
   }
</style>
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
      <form method="post" action="index.php?c=category&a=save" enctype="multipart/form-data">
         <div class="category-form">
            <div class="form-group row">
               <label class="col-md-12 control-label" for="name">Tên</label>
               <div class="col-md-9 col-lg-6">
                  <input name="names[]" id="name" type="text" class="form-control" required>
               </div>
               <button type="button" class="plus-item" style="padding: 0 10px;">+</button>
            </div>
         </div>
         <div class="form-action">
            <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
            <a href="index.php?c=category" class="btn btn-warning btn-sm">Quay về</a>
         </div>
      </form>
      <!-- /form -->
   </div>
   <?php require "layout/footer.php"; ?>
   <script>
      $(function() {
         $("body").on("click", ".plus-item", function() {
            $(".category-form").append(
               `<div class="form-group row">
                  <label class="col-md-12 control-label" for="name">Tên</label>
                  <div class="col-md-9 col-lg-6">
                     <input name="names[]" id="name" type="text" class="form-control">
                  </div>
                  <button type="button" class="minus-item" style="padding: 0 11px;">-</button>
               </div>`
            );
         });

         $("body").on("click", ".minus-item", function() {
            $(this).parent().remove();
         });
      });
   </script>