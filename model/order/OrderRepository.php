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
}
