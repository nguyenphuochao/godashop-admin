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

    function findByEmail($email)
    {
        $condition = "email = $email";
        $customers = $this->fetchAll($condition);
        $customer = current($customers);
        return $customer;
    }

    // save
    function save($data)
    {
        global $conn;
        $name = $data["name"];
        $password = $data["password"];
        $mobile = $data["mobile"];
        $email = $data["email"];
        $login_by = $data["login_by"];
        $ward_id = $data["ward_id"];
        $shipping_name = $data["shipping_name"];
        $shipping_mobile = $data["shipping_mobile"];
        $housenumber_street = $data["housenumber_street"];
        $is_active = $data["is_active"];

        $sql = "INSERT INTO customer (
            name,
            password,
            mobile,
            email,
            login_by,
            ward_id,
            shipping_name,
            shipping_mobile,
            housenumber_street,
            is_active   
        ) VALUES (
            '$name',
            '$password',
            '$mobile',
            '$email',
            '$login_by',
            '$ward_id',
            '$shipping_name',
            '$shipping_mobile',
            '$housenumber_street',
            '$is_active'
        )";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;
    }

    function update($customer)
    {
        global $conn;
        $id = $customer->getID();
        $name = $customer->getName();
        $password = $customer->getPassword();
        $mobile = $customer->getMobile();
        $email = $customer->getEmail();
        $login_by = $customer->getLoginBy();
        $ward_id = $customer->getWardID();
        $shipping_name = $customer->getShippingName();
        $shipping_mobile = $customer->getShippingMobile();
        $housenumber_street = $customer->getHousenumberStreet();
        $is_active = $customer->getIsActive();
        $sql = "UPDATE customer SET
                name = '$name',
                password = '$password',
                mobile = '$mobile',
                email = '$email',
                login_by = '$login_by',
                ward_id = '$ward_id',
                shipping_name = '$shipping_name',
                shipping_mobile = '$shipping_mobile',
                housenumber_street = '$housenumber_street',
                is_active = '$is_active'
                WHERE id = $id
        ";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;
    }
}
