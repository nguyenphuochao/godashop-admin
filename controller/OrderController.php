<?php
class OrderController
{

    // Lấy danh sách order
    function index()
    {
        $orderRepository = new OrderRepository();
        $orders = $orderRepository->getAll();
        require "view/order/index.php";
    }

    // Xác nhận đơn hàng
    function confirm()
    {
        $id = $_GET["id"];

        $orderRepository = new OrderRepository();
        $order = $orderRepository->find($id);

        $staffRepository = new StaffRepository();
        $staff = $staffRepository->findEmail($_SESSION["email"]);


        $order->setOrderStatusID(2);
        $order->setStaffID($staff->getID());
        if ($orderRepository->update($order)) {
            $_SESSION["success"] = "Xác nhận đơn hàng thành công";
        } else {
            $_SESSION["error"] = $orderRepository->getError();
        }
        header("location:index.php?c=order&a=index");
    }
}
