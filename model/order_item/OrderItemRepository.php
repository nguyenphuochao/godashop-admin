<?php
class OrderItemRepository extends BaseRepository
{

    // Hàm truy vấn table order_item
    protected function fetchAll($condition = null)
    {
        global $conn;
        $sql = "SELECT * FROM order_item";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        $order_items = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $order_item = new OrderItem(
                    $row["product_id"],
                    $row["order_id"],
                    $row["qty"],
                    $row["unit_price"],
                    $row["total_price"]
                );
                $order_items[] = $order_item;
            }
        }
        return $order_items;
    }

    // Hàm query lấy order_id
    function findOderID($order_id){
        $condition = "order_id = $order_id";
        $order_items = $this->fetchAll($condition);
        return $order_items;
    }
}
