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
      <form method="POST" action="index.php?c=category&a=deletes">
         <!-- DataTables Example -->
         <div class="action-bar">
            <a class="btn btn-primary btn-sm" href="index.php?c=category&a=add">Thêm</a>
            <input type="submit" class="btn btn-danger btn-sm" value="Xóa" id="delete" name="delete">
         </div>
         <div class="card mb-3">
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th><input type="checkbox"  onclick="checkAll(this)"></th>
                           <th>Tên</th>
                           <th></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($categories as $category) : ?>
                           <tr>
                              <td><input type="checkbox" name="ids[]" value="<?=$category->getID() ?>"></td>
                              <td><?= $category->getName() ?></td>
                              <td> <input type="button" onclick="Edit('1');" value="Sửa" class="btn btn-warning btn-sm"></td>
                              <td>
                                 <a data="<?= $category->getID() ?>" href="index.php?c=category&a=delete&id=<?= $category->getID() ?>" class="btn btn-danger btn-sm btn-delete-cat">Xóa</a>
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