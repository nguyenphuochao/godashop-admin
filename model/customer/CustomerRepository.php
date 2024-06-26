<?php
class CustomerRepository extends BaseRepository
{

    // truy vấn table customer
    protected function fetchAll($condition = null)
    {
        global $conn;
        $sql = "SELECT * FROM customer";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        $customers = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $customer = new Customer(
                    $row["id"],
                    $row["name"],
                    $row["password"],
                    $row["mobile"],
                    $row["email"],
                    $row["login_by"],
                    $row["ward_id"],
                    $row["shipping_name"],
                    $row["shipping_mobile"],
                    $row["housenumber_street"],
                    $row["is_active"]
                );
                $customers[] = $customer;
            }
        }
        return $customers;
    }

    // Lấy tất cả danh sách table customer
    function getAll()
    {
        return $this->fetchAll();
    }

    // Lấy dữ liệu 1 dòng
    function find($id)
    {
        $condition = "id = $id";
        $customers = $this->fetchAll($condition);
        $customer = current($customers);
        return $customer;
    }
}
