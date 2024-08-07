<?php require "layout/header.php"; ?>

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Quản lý</a>
            </li>
            <li class="breadcrumb-item active">Đánh giá</li>
        </ol>
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Tên </th>
                                <th>Hình ảnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product) : ?>
                                <tr>
                                    <td><a href="index.php?c=comment&a=detail&product_id=<?=$product->getID() ?>"><?= $product->getBarCode() ?></a></td>
                                    <td><?= $product->getName() ?></td>
                                    <td>
                                        <img src="uploads/<?= $product->getFeaturedImage() ?>" alt="">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php require "layout/footer.php"; ?>