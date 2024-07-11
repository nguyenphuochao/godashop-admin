<?php
class CustomerController
{
    function index()
    {
        $customerRepository = new CustomerRepository();
        $customers = $customerRepository->getAll();
        include "view/customer/index.php";
    }

    function add()
    {
        $provinceRepository = new ProvinceRepository();
        $provinces = $provinceRepository->getAll();

        require "view/customer/add.php";
    }

    function save()
    {
        $data = array();
        $data["name"] = $_POST["fullname"];
        $data["email"] = $_POST["email"];
        $data["login_by"] = "form";
        $data["password"] = $_POST["password"];
        $data["mobile"] = $_POST["mobile"];
        $data["ward_id"] = $_POST["ward"];
        $data["housenumber_street"] = $_POST["shipping_housenumber_street"];
        $data["shipping_name"] = $_POST["shipping_name"];
        $data["shipping_mobile"] = $_POST["shipping_mobile"];
        $data["is_active"] = $_POST["active"];

        $customerRepository = new CustomerRepository();
        if ($customerRepository->save($data)) {
            header("Location: index.php?c=customer");
            exit;
        }
        echo $customerRepository->getError();
    }

    function edit()
    {
        $id = $_GET["id"];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->find($id);

        $provinceRepository = new ProvinceRepository();
        $provinces = $provinceRepository->getAll();

        require "view/customer/edit.php";
    }

    function update()
    {
        $id = $_POST["id"];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->find($id);
        $customer->setName($_POST["fullname"]);
        $customer->setMobile($_POST["mobile"]);
        $customer->setHousenumberStreet($_POST["housenumumber_street"]);
        $customer->setShippingName($_POST["shipping_name"]);
        $customer->setShippingMobile($_POST["shipping_mobile"]);
        $customer->setWardID($_POST["ward"]);
        $customer->setIsActive($_POST["active"]);
        if ($customerRepository->update($customer)) {
            header("Location: index.php?c=customer");
            exit;
        }
        echo $customerRepository->getError();
    }
}
