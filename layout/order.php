<?php foreach ($orders as $order) : ?>
    <tr>
        <td>#<?= $order->getID() ?></td>
        <td><?= $order->getCustomer()->getName(); ?></td>
        <td><?= $order->getCustomer()->getMobile(); ?></td>
        <td><?= $order->getCustomer()->getEmail(); ?></td>
        <td><?= $order->getStatus()->getDescription(); ?></td>
        <td><?= $order->getCreatedDate() ?></td>
        <td><?= $order->getPaymentMethod() == 0 ? 'COD' : 'BANK' ?></td>
        <td><?= $order->getShippingFullname(); ?></td>
        <td><?= $order->getShippingMobile(); ?></td>
        <td><?= $order->getDeliveredDate(); ?></td>

        <td><?= number_format($order->getShippingFee()); ?> đ</td>
        <td><?= number_format($order->getSubTotal()); ?> đ</td>
        <td><?= number_format($order->getSubTotal() + $order->getShippingFee()); ?> đ</td>
        <td>278 Hòa Bình, Hiệp Tân, Tân Phú, TP.HCM</td>
        <td><?= $order->getStaff() ? $order->getStaff()->getName() : '' ?></td>
        <?php if ($order->getOrderStatusID() == 1) : ?>
            <td><a href="index.php?c=order&a=confirm&id=<?= $order->getID() ?>" class="btn btn-primary btn-sm">Xác nhận</a></td>
        <?php endif; ?>
        <td><a href="#" class="btn btn-warning btn-sm">Sửa</a></td>
        <td><a href="#" class="btn btn-danger btn-sm">Xóa</a></td>
    </tr>
<?php endforeach; ?>