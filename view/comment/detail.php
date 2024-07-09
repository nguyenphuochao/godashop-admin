<?php require "layout/header.php"; ?>

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Quản lý</a>
            </li>
            <li class="breadcrumb-item">Đánh giá</li>
            <li class="breadcrumb-item active"><?= $product->getName() ?></li>
        </ol>
        <!-- DataTables Example -->
        <form action="index.php?c=comment&a=deletes" method="POST">
            <div class="action-bar">
                <input onclick="return confirm('Bạn chắc xóa?')" type="submit" class="btn btn-danger btn-sm" value="Xóa">
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" onclick="checkAll(this)"></th>
                                    <th>Email</th>
                                    <th>Tên </th>
                                    <th>Số sao</th>
                                    <th>Ngày tạo</th>
                                    <th>Nội dung</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($comments as $comment) : ?>
                                    <tr>
                                        <td><input name="ids[]" value="<?=$comment->getID() ?>" type="checkbox"></td>
                                        <td><?= $comment->getEmail() ?></td>
                                        <td><?= $comment->getFullName() ?> </td>
                                        <td><?= $comment->getStar() ?></td>
                                        <td><?= $comment->getCreatedDate() ?></td>
                                        <td><?= $comment->getDescription() ?></td>
                                        <td>
                                            <a onclick="return confirm('Bạn chắc xóa?')" class="btn btn-danger btn-sm" 
                                            href="index.php?c=comment&a=delete&&id=<?= $comment->getID() ?>&product_id=<?=$product->getID() ?>">Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <input type="hidden" name="product_id" value="<?=$product_id?>">
                    </div>
                </div>
            </div>
        </form>
    </div>

<?php require "layout/footer.php"; ?>