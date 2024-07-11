<?php require "layout/header.php"; ?>

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Quản lý</a>
            </li>
            <li class="breadcrumb-item">Hình ảnh</li>
            <li class="breadcrumb-item active"><?= $product->getName() ?></li>
        </ol>
        <!-- DataTables Example -->
        <form action="index.php?c=imageitem&a=deletes" method="POST">
            <div class="action-bar">
                <input onclick="return confirm('Bạn chắc xóa?')" type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" onclick="checkAll(this)"></th>
                                    <th>Hình ảnh</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($imageItems as $imageItem) : ?>
                                    <tr>
                                        <td><input name="ids[]" value="<?= $imageItem->getID() ?>" type="checkbox"></td>
                                        <td><img src="uploads/<?= $imageItem->getName() ?>"></td>
                                        <td>
                                            <a onclick="return confirm('Bạn chắc xóa?')" href="index.php?c=imageitem&a=delete&product_id=<?= $product->getID() ?>&id=<?= $imageItem->getID() ?>" class="btn btn-danger btn-sm">Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <input type="hidden" name="product_id" value="<?=$product->getID() ?>">
                    </div>
                </div>
            </div>
        </form>
        <!-- save upload file -->
        <form action="index.php?c=imageitem&a=save" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <label>Upload hình</label>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-12">
                    <input type="file" name="image" class="form-control" onchange="loadFile(event)">
                    <img src="" id="image">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <input type="submit" value="Upload" class="btn btn-primary btn-sm">
                    <input type="hidden" name="product_id" value="<?=$product->getID() ?>">
                </div>
            </div>
        </form>
    </div>

    <?php require "layout/footer.php"; ?>