<?php
class DashboardController
{
    function index()
    {
        $orderRepository = new OrderRepository();
        $from_date = (!empty($_GET["from_date"]) ? $_GET["from_date"]: date("Y-m-d")) . " 00:00:00";
		$to_date = (!empty($_GET["to_date"]) ? $_GET["to_date"]: date("Y-m-d")) . " 23:59:59";

        $conds = [
            'created_date' => [
                'type' => 'BETWEEN',
                'val' => "'$from_date' AND '$to_date'"
            ]
        ];
        $orders = $orderRepository->getBy($conds);
        require 'view/dashboard/index.php';
    }
}
