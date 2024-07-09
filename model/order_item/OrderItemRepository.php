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
    function findOderID($order_id)
    {
        $condition = "order_id = $order_id";
        $order_items = $this->fetchAll($condition);
        return $order_items;
    }

    function find($product_id, $order_id)
    {
        $condition = "product_id = $product_id AND order_id = $order_id";
        $order_items = $this->fetchAll($condition);
        $order_item = current($order_items);
        return $order_item;
    }

    function save($data)
    {
        global $conn;
        $product_id = $data["product_id"];
        $order_id = $data["order_id"];
        $qty = $data["qty"];
        $unit_price = $data["unit_price"];
        $total_price = $data["total_price"];
        $sql = "INSERT INTO order_item (
            product_id,
            order_id,
            qty,
            unit_price,
            total_price
        ) VALUES (
            $product_id,
            $order_id,
            $qty,
            $unit_price,
            $total_price
        )";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;
    }

    function update(OrderItem $order_item)
    {
        global $conn;
        $product_id = $order_item->getProductID();
        $order_id = $order_item->getOrderID();
        $qty = $order_item->getQty();
        $unit_price = $order_item->getUnitPrice();
        $total_price = $order_item->getTotalPrice();
        $sql = "UPDATE  order_item SET 
                        product_id = $product_id,
                        order_id = $order_id,
                        qty = $qty,
                        unit_price = $unit_price,
                        total_price = $total_price
                        WHERE order_id = $order_id AND product_id = $product_id";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;
    }

    function delete(OrderItem $order_item){
        global $conn;
        $order_id = $order_item->getOrderID();
        $product_id = $order_item->getProductID();
        $sql = "DELETE FROM `order_item` WHERE order_id = $order_id AND product_id = $product_id";
        if($conn->query($sql) === TRUE){
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;
    }
}
