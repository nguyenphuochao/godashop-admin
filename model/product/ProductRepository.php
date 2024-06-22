<?php
class ProductRepository extends BaseRepository
{
    // query gọi data
    protected function fetchAll($condition = null, $sort = null, $limit = null)
    {
        global $conn;
        $products = array();
        $sql = "SELECT * FROM view_product";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        if ($sort) {
            $sql .= " $sort";
        }
        if ($limit) {
            $sql .= " $limit";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Product(
                    $row['id'],
                    $row['barcode'],
                    $row['sku'],
                    $row['name'],
                    $row['price'],
                    $row['discount_percentage'],
                    $row['discount_from_date'],
                    $row['discount_to_date'],
                    $row['featured_image'],
                    $row['inventory_qty'],
                    $row['category_id'],
                    $row['brand_id'],
                    $row['created_date'],
                    $row['description'],
                    $row['star'],
                    $row['featured'],
                    $row['sale_price']
                );
                $products[] = $product;
            }
        }
        return $products;
    }
    function getAll()
    {
       return $this->getBy();
    }

    /**
     * $array_conds = array("type" => ">=", "val" => 100)
     */
    function getBy($array_conds = array(), $array_sorts = array(), $page = null, $qty_per_page = null)
    {
        if ($page) {
            $page_index = $page - 1;
        }
        // condition
        $temp = array();
        foreach ($array_conds as $column => $cond) {
            $type = $cond["type"];
            $val = $cond["val"];
            $str = "$column $type ";
            if (in_array($type, array("BETWEEN", "LIKE"))) {
                $str .= "$val";
            } else {
                $str .= "'$val'";
            }
            $temp[] = $str;
        }
        $condition = null;
        if (count($array_conds)) {
            $condition = implode(" AND ", $temp);
        }
        // sort
        $temp = array();
        foreach ($array_sorts as $key => $sort) {
            $temp[] = "$key $sort";
        }
        $sort = null;
        if (count($array_sorts)) {
            $sort = "ORDER BY " . implode(", ", $temp);
        }
        // paging
        $limit = null;
        if ($qty_per_page) {
            $start = $page_index * $qty_per_page;
            $limit = "LIMIT $start, $qty_per_page";
        }

        return $this->fetchAll($condition, $sort, $limit);
    }

    function find($id)
    {
        global $conn;
        $condition = "id = $id";
        $products = $this->fetchAll($condition);
        $product = current($products);
        return $product;
    }
    function delete(Product $product)
    {
        global $conn;
        $id = $product->getID();
        $sql = "DELETE FROM product WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error:" . $sql . PHP_EOL . $conn->error;
        return false;
    }
}
