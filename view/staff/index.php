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
      <!-- DataTables Example -->
      <div class="action-bar">
         <a class="btn btn-primary btn-sm" href="index.php?c=staff&a=add">Thêm</a>
         <label style="cursor: pointer;margin: 0;" for="activeMulti" class="btn btn-primary btn-sm">Kích hoạt</label>
         <label style="cursor: pointer;margin: 0;" for="disableMulti" class="btn btn-danger btn-sm">Vô hiệu</label>
      </div>
      <form action="index.php?c=staff&a=activeOrDisableMulti" method="POST">
         <div class="card mb-3">
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th><input type="checkbox" onclick="checkAll(this)"></th>
                           <th>Tên </th>
                           <th>Tên đăng nhập</th>
                           <th>Email</th>
                           <th>Số điện thoại</th>
                           <th> Vai trò </th>
                           <th></th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($staffs as $staff) : ?>
                           <tr>
                              <td><input name="ids[]" value="<?= $staff->getID() ?>" type="checkbox"></td>
                              <td><?= $staff->getName() ?></td>
                              <td><?= $staff->getUsername() ?></td>
                              <td><?= $staff->getEmail() ?></td>
                              <td><?= $staff->getMobile() ?></td>
                              <td><?= $staff->getRole()->getName() ?></td>
                              <td>
                                 <a class="btn btn-warning btn-sm" href="index.php?c=staff&a=edit&id=<?=$staff->getID()?>">Sửa</a>
                              </td>
                              <td>
                                 <?php if ($staff->getIsActive() == 1) : ?>
                                    <a onclick="return confirm('Bạn muốn vô hiệu nhân viên này?')" class="btn btn-danger btn-sm" href="index.php?c=staff&a=disable&id=<?= $staff->getID() ?>">Vô hiệu</a>
                                 <?php endif ?>

                                 <?php if ($staff->getIsActive() == 0) : ?>
                                    <a class="btn btn-primary btn-sm" href="index.php?c=staff&a=active&id=<?= $staff->getID() ?>">Kích hoạt</a>
                                 <?php endif ?>
                              </td>
                           </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
                  <input type="submit" name="activeMulti" id="activeMulti" hidden>
                  <input type="submit" name="disableMulti" id="disableMulti" hidden>
               </div>
            </div>
         </div>
      </form>
   </div>
   <?php require "layout/footer.php"; ?>