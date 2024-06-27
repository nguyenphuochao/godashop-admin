<?php
class OrderRepository extends BaseRepository
{

    protected function fetchAll($condition = null, $sort = null)
    {
        global $conn;
        $orders = array();
        $sql = "SELECT * FROM `order`";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        if ($sort) {
            $sql .= " $sort";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = new Order(
                    $row['id'],
                    $row['created_date'],
                    $row['order_status_id'],
                    $row['staff_id'],
                    $row['customer_id'],
                    $row['shipping_fullname'],
                    $row['shipping_mobile'],
                    $row['payment_method'],
                    $row['shipping_ward_id'],
                    $row['shipping_housenumber_street'],
                    $row['shipping_fee'],
                    $row['delivered_date']
                );
            }
        }
        return $orders;
    }

    // lấy theo tiêu chí
    /**
     * $array_conds = array(
     *         'name' => array(
     *                'type' => '=',
     *                'val'  => '100'      
     *      )
     *   )
     * 
     * 
     */
    function getBy($array_conds = array(), $array_sorts = array(), $page = null, $qty_per_page = null)
    {
        if ($page) {
            $page_index = $page - 1;
        }
        // condition
        $temp = array();
        foreach ($array_conds as $column => $cond) {
            $type = $cond['type'];
            $val = $cond['val'];
            $str = " $column $type ";
            if (in_array($type, ['BETWEEN', 'LIKE'])) {
                $str .= "$val";
            } else {
                $str .= "'$val'";
            }
            $temp[] = $str;
        }
        $condition = null;
        if (count($array_conds)) {
            $condition = implode(' AND ', $temp);
        }
        // sort
        // ORDER BY id DESC,name ASC
        $temp = array();
        foreach ($array_sorts as $key => $sort) {
            $temp[] = "$key $sort";
        }
        $sort = null;
        if (count($array_sorts)) {
            $sort = "ORDER BY " . implode(',', $temp);
        }
        // limit 
        $limit = null;
        if ($qty_per_page) {
            $start = $page_index * $qty_per_page;
            $limit = "LIMIT $start,$qty_per_page";
        }

        return $this->fetchAll($condition, $sort, $limit);
    }

    function getAll()
    {
        return $this->fetchAll();
    }

    function find($id)
    {
        $condition = "id = $id";
        $orders = $this->fetchAll($condition);
        $order = current($orders);
        return $order;
    }

    function delete(Order $order)
    {
        global $conn;
        $id = $order->getID();
        $sql = "DELETE FROM `order` WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
    }

    function update(Order $order)
    {
        global $conn;
        $id = $order->getID();
        $created_date = $order->getCreatedDate();
        $order_status_id = $order->getOrderStatusID();
        $staff_id = $order->getStaffID();
        $customer_id = $order->getCustomerID();
        $shipping_fullname = $order->getShippingFullname();
        $shipping_mobile = $order->getShippingMobile();
        $payment_method = $order->getPaymentMethod();
        $shipping_ward_id = $order->getShippingWardID();
        $shipping_housenumber_street = $order->getShippingHousenumberStreet();
        $shipping_fee = $order->getShippingFee();
        $delivered_date = $order->getDeliveredDate();

        $sql = "UPDATE `order` SET 
                        created_date = '$created_date',
                        order_status_id = $order_status_id,
                        staff_id = $staff_id,
                        customer_id = $customer_id,
                        shipping_fullname = '$shipping_fullname',
                        shipping_mobile = '$shipping_mobile',
                        payment_method = '$payment_method',
                        shipping_ward_id = '$shipping_ward_id',
                        shipping_housenumber_street = '$shipping_housenumber_street',
                        shipping_fee = $shipping_fee,
                        delivered_date = '$delivered_date'
                        WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;
    }
}
