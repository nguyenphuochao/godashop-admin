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
      <!-- DataTables Example -->
      <div class="action-bar">
         <input type="button" class="btn btn-primary btn-sm" onclick="Add()" value="Thêm" name="add">
         <label style="cursor: pointer;" class="btn btn-danger btn-sm mt-2" for="delete" value="Xóa" name="delete">Xóa</label>
      </div>
      <form method="POST" action="index.php?c=brand&a=deletes">
         <input type="submit" id="delete" hidden>
         <div class="card mb-3">
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th><input type="checkbox" onclick="checkAll(this)"></th>
                           <th>Tên</th>
                           <th></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($brands as $brand) : ?>
                           <tr>
                              <td><input name="ids[]" value="<?= $brand->getID() ?>" type="checkbox"></td>
                              <td><?= $brand->getName() ?></td>
                              <td><input data-id="<?= $brand->getID() ?>" type="button" onclick="Edit(this);" value="Sửa" class="btn btn-warning btn-sm"></td>
                              <td>
                                 <a data="<?= $brand->getID() ?>" href="index.php?c=brand&a=delete&id=<?= $brand->getID() ?>" class="btn btn-danger btn-sm btn-delete-brand">Xóa</a>
                              </td>
                           </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </form>
   </div>
   <?php require "layout/footer.php"; ?>
   <script>
      function Add() {
         window.location.href = "index.php?c=brand&a=add";
      }

      function Edit(self) {
         var id = $(self).attr("data-id");
         window.location.href = "index.php?c=brand&a=edit&id=" + id;
      }
   </script>