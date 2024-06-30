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

    function add()
    {
        $customerRepository = new CustomerRepository();
        $customers = $customerRepository->getAll();

        $statusRepository = new StatusRepository();
        $statuses = $statusRepository->getAll();

        $staffRepository = new StaffRepository();
        $staffs = $staffRepository->getAll();

        $provinceRepository = new ProvinceRepository();
        $provinces = $provinceRepository->getAll();

        $districtRepository = new DistrictRepository();
        $districts = $districtRepository->getAll();

        $wardRepository = new WardRepository();
        $wards = $wardRepository->getAll();

        require "view/order/add.php";
    }

    function ajaxGetDistrict()
    {
        $province_id = $_GET["province_id"];
        $districtRepository = new DistrictRepository();
        $districts = $districtRepository->findProvince($province_id);
        echo '<option value = "">' . 'Quận / huyện' . '</option>';
        foreach ($districts as $district) {
            echo '<option value = "' . $district->getID() . '">' . $district->getName() . '</option>';
        }
    }

    function ajaxGetWard()
    {
        $district_id = $_GET["district_id"];
        $wardRepository = new WardRepository();
        $wards = $wardRepository->findDistrict($district_id);
        echo '<option value = "">' . 'Phưởng / xã' . '</option>';
        foreach ($wards as $ward) {
            echo '<option value = "' . $ward->getID() . '">' . $ward->getName() . '</option>';
        }
    }

    function store()
    {
        $transportRepository = new TransportRepository();
        $transport = $transportRepository->findByProvinceID($_POST["province"]);

        $data = [];
        $data["created_date"] = date("Y-m-d H:i:s");
        $data["order_status_id"] = $_POST["order_status_id"];
        $data["staff_id"] = $_POST["staff_id"];
        $data["customer_id"] = $_POST["customer_id"];
        $data["shipping_fullname"] = $_POST["shipping_fullname"];
        $data["shipping_mobile"] = $_POST["shipping_mobile"];
        $data["payment_method"] = $_POST["payment_method"];
        $data["shipping_ward_id"] = $_POST["ward"];
        $data["shipping_housenumber_street"] = $_POST["shipping_housenumber_street"];
        $data["shipping_fee"] = $transport->getPrice();
        $data["delivered_date"] = $_POST["delivered_date"];
        $orderRepository = new OrderRepository();
        if ($orderRepository->save($data)) {
            $_SESSION["success"] = "Thêm mới đơn hàng thành công";
        } else {
            $_SESSION["error"] = $orderRepository->getError();
        }
        header("Location: index.php?c=order");
    }

    function detail()
    {
        $id = $_GET["id"];
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find($id);
        require "view/order/detail.php";
    }

    function edit()
    {
        $id = $_GET["id"];
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find($id);

        $district_id = $order->getWard()->getDistrictID();
        $province_id = $order->getWard()->getDistrict()->getProvinceID();


        $statusRepository = new StatusRepository();
        $statues = $statusRepository->getAll();

        $staffRepository = new StaffRepository();
        $staffs = $staffRepository->getAll();

        $provinceRepository = new ProvinceRepository();
        $provinces = $provinceRepository->getAll();

        $districtRepository = new DistrictRepository();
        $districts = $districtRepository->getAll();
        if ($province_id) {
            $districts = $districtRepository->findProvince($province_id);
        }

        $wardRepository = new WardRepository();
        $wards = $wardRepository->getAll();
        if ($district_id) {
            $wards = $wardRepository->findDistrict($district_id);
        }

        require "view/order/edit.php";
    }

    function ajaxGetShippingFee()
    {
        $province_id = $_GET["province_id"];
        $subtotal = $_GET["subtotal"];
        $transportRepository = new TransportRepository();
        $transport = $transportRepository->findByProvinceID($province_id);
        $shipping_fee = $transport->getPrice();
        $total = number_format($shipping_fee + $subtotal);
        $data = [
            "shipping_fee" => $shipping_fee,
            "total" => $total
        ];
        echo json_encode($data);
    }

    function update()
    {
        $order_id = $_POST["id"];
        $order_status_id = $_POST["status"];
        $staff_id = $_POST["staff"];
        $shipping_fullname = $_POST["shipping_fullname"];
        $shipping_mobile = $_POST["shipping_mobile"];
        $payment_method = $_POST["payment_method"];
        $shipping_ward_id = $_POST["ward"];
        $shipping_housenumber_street = $_POST["shipping_housenumber_street"];
        $shipping_fee = $_POST["shipping_fee"];
        $delivered_date = $_POST["delivered_date"];
        $ids = $_POST["ids"];
        $qtys = $_POST["qtys"];

        $orderRepository = new OrderRepository();
        $order = $orderRepository->find($order_id);
        $order->setOrderStatusID($order_status_id);
        $order->setStaffID($staff_id);
        $order->setShippingFullname($shipping_fullname);
        $order->setShippingMobile($shipping_mobile);
        $order->setPaymentMethod($payment_method);
        $order->setShippingWardID($shipping_ward_id);
        $order->setShippingHousenumberStreet($shipping_housenumber_street);
        $order->setShippingFee($shipping_fee);
        $order->setDeliveredDate($delivered_date);
        if ($orderRepository->update($order)) {
            for ($i = 0; $i <= count($ids); $i++) {
                $productRepository = new ProductRepository();
                $product = $productRepository->find($ids[$i]);

                $orderItemRepository = new OrderItemRepository();
                $order_item = $orderItemRepository->find($ids[$i], $order_id);

                $order_item->setProductID($ids[$i]);
                $order_item->setOrderID($order_id);
                $order_item->setQty($qtys[$i]);
                $order_item->setUnitPrice($product->getSalePrice());
                $order_item->setTotalPrice($qtys[$i] * $product->getSalePrice());

                if ($orderItemRepository->update($order_item)) {
                    $_SESSION["success"] = "Cập nhật đơn hàng thành công";
                } else {
                    $_SESSION["error"] = $orderItemRepository->getError();
                }
                header("Location: index.php?c=order");
            }
        }
    }

    function delete()
    {
    }
}
