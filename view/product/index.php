<?php require "layout/header.php"; ?>
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Quản lý</a>
            </li>
            <li class="breadcrumb-item active">Sản phẩm</li>
        </ol>
        <!-- DataTables Example -->
        <div class="action-bar">
            <input type="submit" class="btn btn-primary btn-sm" value="Thêm" name="add">
            <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><input type="checkbox" onclick="checkAll(this)"></th>
                                <th>Barcode</th>
                                <th>SKU</th>
                                <th style="width:50px">Tên </th>
                                <th>Hình ảnh</th>
                                <th>Giá bán lẻ</th>
                                <th>% giảm giá</th>
                                <th>Giá bán thực tế</th>
                                <th>Lượng tồn</th>
                                <th>Đánh giá</th>
                                <th>Nội bật</th>
                                <th>Danh mục</th>
                                <th>Nhãn hiệu</th>
                                <th>Ngày tạo</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product) : ?>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td><?= $product->getBarCode() ?></td>
                                    <td><?= $product->getSKU() ?></td>
                                    <td><?= $product->getName() ?></td>
                                    <td><img src="../public/images/<?= $product->getFeaturedImage() ?>"></td>
                                    <td><?= number_format($product->getPrice()); ?> ₫</td>
                                    <td><?= $product->getDiscountPercentage() ?>%</td>
                                    <td><?= number_format($product->getSalePrice()) ?> ₫</td>
                                    <td><?= $product->getInventoryQty() ?></td>
                                    <td><?= $product->getStar() ?></td>
                                    <td><?= $product->getFeatured() == 1 ? 'Nổi bật' : '' ?></td>
                                    <td><?= $product->getCategory()->getName(); ?></td>
                                    <td><?= $product->getBrand()->getName(); ?></td>
                                    <td><?= $product->getCreatedDate() ?></td>
                                    <td><a href="../../pages/comment/list.html">Đánh giá</a></td>
                                    <td><a href="../../pages/image/list.html">Hình ảnh</a></td>
                                    <td><input type="button" onclick="Edit('25');" value="Sửa" class="btn btn-warning btn-sm"></td>
                                    <td><input type="button" onclick="Delete('25');" value="Xóa" class="btn btn-danger btn-sm"></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php require "layout/footer.php"; ?>