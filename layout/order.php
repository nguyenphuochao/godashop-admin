<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Mã</th>
            <th>Tên khách hàng</th>
            <th>Điện thoai</th>
            <th>Email</th>
            <th>Trạng Thái</th>
            <th>Ngày đặt hàng</th>
            <th>Phương thức thanh toán</th>
            <th>Người nhận</th>
            <th>Số điện thoại nhận</th>
            <th>Ngày giao hàng</th>
            <th>Phí giao hàng</th>
            <th>Tạm tính</th>
            <th>Tổng cộng</th>
            <th>Địa chỉ giao hàng</th>
            <th>Nhân viên phụ trách</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
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
                <td>
                    <?= $order->getShippingHousenumberStreet(); ?>,
                    <?= $order->getWard()->getName(); ?>,
                    <?= $order->getWard()->getDistrict()->getName(); ?>,
                    <?= $order->getWard()->getDistrict()->getProvince()->getName(); ?>
                </td>
                <td><?= $order->getStaff() ? $order->getStaff()->getName() : '' ?></td>
                <td>
                    <?php if ($order->getOrderStatusID() == 1) : ?>
                        <a href="index.php?c=order&a=confirm&id=<?= $order->getID() ?>" onclick="return confirm('Bạn muốn xác nhận đơn hàng phải không?')" class="btn btn-primary btn-sm">Xác nhận</a>
                    <?php endif; ?>
                </td>
                <td><a href="index.php?c=order&a=detail&id=<?= $order->getID() ?>" class="btn btn-success btn-sm">Xem chi tiết</a></td>
                <td><a href="index.php?c=order&a=edit&id=<?= $order->getID() ?>" class="btn btn-warning btn-sm">Sửa</a></td>
                <td><a href="index.php?c=order&a=delete&id=<?= $order->getID() ?>" onclick="return confirm('Bạn muốn xóa đơn hàng này hả?')" class="btn btn-danger btn-sm">Xóa</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>