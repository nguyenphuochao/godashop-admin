<ul class="sidebar navbar-nav">
    <?php
    global $c, $a;
    $aclService = new ACLService();
    $staffRepository = new StaffRepository();
    $staff = $staffRepository->findEmail($_SESSION['email']);
    ?>
    <!-- Dashboard -->
    <li class="nav-item <?= $c == 'dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="index.php"><i class="fas fa-fw fa-tachometer-alt"></i> <span>Tổng quan</span></a>
    </li>

    <!-- Order -->
    <?php if ($aclService->hasMenus($staff, ACLService::VIEW_ORDER)) : ?>
        <li class="nav-item dropdown <?= $c == 'order' ? 'active' : '' ?>">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-shopping-cart"></i> <span>Đơn hàng</span></a>
            <div class="dropdown-menu <?= $c == 'order' ? 'show' : '' ?>" aria-labelledby="">
                <a class="dropdown-item <?= $c == 'order' && $a == 'index' ? 'active' : '' ?>" href="index.php?c=order">Danh sách</a>
                <a class="dropdown-item <?= $c == 'order' && $a == 'add' ? 'active' : '' ?>" href="index.php?c=order&a=add">Thêm</a>
            </div>
        </li>
    <?php endif; ?>

    <!-- Product -->
    <?php if ($aclService->hasMenus($staff, ACLService::VIEW_PRODUCT)) : ?>
        <li class="nav-item dropdown <?= $c == 'product' ? 'active' : '' ?>">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fab fa-product-hunt"></i> <span>Sản phẩm</span></a>
            <div class="dropdown-menu <?= $c == 'product' ? 'show' : '' ?>" aria-labelledby="">
                <a class="dropdown-item <?= $c == 'product' && $a == 'index' ? 'active' : '' ?>" href="index.php?c=product">Danh sách</a>
                <a class="dropdown-item <?= $c == 'product' && $a == 'add' ? 'active' : '' ?>" href="index.php?c=product&a=add">Thêm</a>
            </div>
        </li>
    <?php endif; ?>
    
    <!-- Comment -->
    <?php if ($aclService->hasMenus($staff, ACLService::VIEW_COMMENT)) : ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-comments"></i> <span>Comment</span></a>
            <div class="dropdown-menu <?= $c == 'comment' ? 'show' : '' ?>" aria-labelledby="">
                <a class="dropdown-item <?= $c == 'comment' ? 'active' : '' ?>" href="index.php?c=comment">Danh sách</a>
            </div>
        </li>
    <?php endif; ?>

    <!-- ImageItem -->
    <?php if ($aclService->hasMenus($staff, ACLService::VIEW_PRODUCT)) : ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="far fa-image"></i> <span>Hình ảnh</span></a>
            <div class="dropdown-menu <?= $c == 'imageitem' ? 'show' : '' ?>" aria-labelledby="">
                <a class="dropdown-item <?= $c == 'imageitem' ? 'active' : '' ?>" href="index.php?c=imageitem">Danh sách</a>
            </div>
        </li>
    <?php endif; ?>

    <!-- Customer -->
    <?php if ($aclService->hasMenus($staff, ACLService::VIEW_CUSTOMER)) : ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-user-alt"></i> <span>Khách hàng</span></a>
            <div class="dropdown-menu <?= $c == 'customer' ? "show" : "" ?>" aria-labelledby="">
                <a class="dropdown-item <?= $c == 'customer' && $a == 'index' ? "active" : "" ?>" href="index.php?c=customer">Danh sách</a>
                <a class="dropdown-item <?= $c == 'customer' && $a == 'add' ? "active" : "" ?>" href="index.php?c=customer&a=add">Thêm</a>
            </div>
        </li>
    <?php endif; ?>

    <!-- Category -->
    <?php if ($aclService->hasMenus($staff, ACLService::VIEW_CATEGORY)) : ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-folder"></i> <span>Danh mục</span></a>
            <div class="dropdown-menu <?= $c == 'category' ? "show" : "" ?>" aria-labelledby="">
                <a class="dropdown-item <?= $c == 'category' && $a == 'index' ? "active" : "" ?>" href="index.php?c=category">Danh sách</a>
                <a class="dropdown-item <?= $c == 'category' && $a == 'add' ? "active" : "" ?>" href="index.php?c=category&a=add">Thêm</a>
            </div>
        </li>
    <?php endif; ?>

     <!-- Brand -->
     <?php if ($aclService->hasMenus($staff, ACLService::VIEW_BRAND)) : ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-folder"></i> <span>Nhãn hiệu</span></a>
            <div class="dropdown-menu <?= $c == 'brand' ? "show" : "" ?>" aria-labelledby="">
                <a class="dropdown-item <?= $c == 'brand' && $a == 'index' ? "active" : "" ?>" href="index.php?c=brand">Danh sách</a>
                <a class="dropdown-item <?= $c == 'brand' && $a == 'add' ? "active" : "" ?>" href="index.php?c=brand&a=add">Thêm</a>
            </div>
        </li>
    <?php endif; ?>

    <!-- Transport -->
    <?php if ($aclService->hasMenus($staff, ACLService::VIEW_TRANSPORT)) : ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-shipping-fast"></i> <span>Phí giao hàng</span></a>
            <div class="dropdown-menu" aria-labelledby="">
                <a class="dropdown-item" href="../../pages/transport/list.html">Danh sách</a>
                <a class="dropdown-item" href="../../pages/transport/add.html">Thêm</a>
            </div>
        </li>
    <?php endif; ?>

    <!-- Staff -->
    <?php if ($aclService->hasMenus($staff, ACLService::VIEW_STAFF)) : ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-users"></i> <span>Nhân viên</span></a>
            <div class="dropdown-menu <?= $c == 'staff' ? "show" : "" ?>" aria-labelledby="">
                <a class="dropdown-item <?= $c == 'staff' & $a == 'index' ? "active" : "" ?>" href="index.php?c=staff">Danh sách</a>
                <a class="dropdown-item <?= $c == 'staff' & $a == 'add' ? "active" : "" ?>" href="index.php?c=staff&a=add">Thêm</a>
            </div>
        </li>
    <?php endif; ?>

    <!-- Permission -->
    <?php if ($aclService->hasMenus($staff, ACLService::VIEW_PERMISSION)) : ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-user-shield"></i> <span>Phân quyền</span></a>
            <div class="dropdown-menu <?= $c == 'permission' ? 'show' : '' ?>" aria-labelledby="">
                <a class="dropdown-item <?= $c == 'permission' && $a == 'listRole' ? 'active' : '' ?>" href="index.php?c=permission&a=listRole">Danh sách vai trò</a>
                <a class="dropdown-item <?= $c == 'permission' && $a == 'addRole' ? 'active' : '' ?>" href="index.php?c=permission&a=addRole">Thêm vai trò</a>
                <a class="dropdown-item <?= $c == 'permission' && $a == 'listAction' ? 'active' : '' ?>" href="index.php?c=permission&a=listAction">Danh sách tác vụ</a>
            </div>
        </li>
    <?php endif; ?>

    <!-- Status -->
    <?php if ($aclService->hasMenus($staff, ACLService::VIEW_STATUS)) : ?>
        <li class="nav-item">
            <a class="nav-link" href="../../pages/order_status/list.html"><i class="fas fa-star-half-alt"></i> <span>Trạng thái đơn hàng</span></a>
        </li>
    <?php endif; ?>

    <!-- News letter -->
    <?php if ($aclService->hasMenus($staff, ACLService::VIEW_NEWSLETTER)) : ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-file-alt"></i> <span>News letter</span></a>
            <div class="dropdown-menu" aria-labelledby="">
                <a class="dropdown-item" href="../../pages/newsletter/list.html">Danh sách</a>
                <a class="dropdown-item" href="../../pages/newsletter/send.html">Gởi mail</a>
            </div>
        </li>
    <?php endif; ?>

</ul>

<div class="message bg-info text-center" style="position: absolute; left:50%; transform: translateX(-50%);width:100%"><?= !empty($_SESSION["success"]) ? $_SESSION["success"] : "" ?></div>
<?php
unset($_SESSION["success"]);
?>

<div class="error bg-danger text-center" style="position: absolute; left:50%; transform: translateX(-50%);width:100%; color:white"><?= !empty($_SESSION["error"]) ? $_SESSION["error"] : "" ?></div>
<?php
unset($_SESSION["error"]);
?>