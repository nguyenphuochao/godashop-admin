<?php
class BrandRepository extends BaseRepository
{
    function fetchAll($condition = null)
    {
        global $conn;
        $sql = "SELECT * FROM brand";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $brands = [];
            while ($row = $result->fetch_assoc()) {
                $brand = new Brand(
                    $row['id'],
                    $row['name']
                );
                $brands[] = $brand;
            }
            return $brands;
        }
    }

    function getAll()
    {
        return $this->fetchAll();
    }

    function find($id)
    {
        $condition = "id = $id";
        $brands = $this->fetchAll($condition);
        $brand = current($brands);
        return $brand;
    }

    function findByName($name)
    {
        $condition = "name = '$name'";
        $brands = $this->fetchAll($condition);
        $brand = current($brands);
        return $brand;
    }

    function save($data)
    {
        global $conn;
        $name = $data['name'];
        $sql = "INSERT INTO brand (name) VALUES ('$name')";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "ERROR: " . $sql . PHP_EOL . $conn->error;
        return false;
    }

    function update($brand)
    {
        global $conn;
        $id = $brand->getID();
        $name = $brand->getName();
        $sql = "UPDATE brand SET name = '$name' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "ERROR: " . $sql . PHP_EOL . $conn->error;
        return false;
    }

    function delete($brand)
    {
        global $conn;
        $id = $brand->getID();
        $sql = "DELETE FROM brand WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "ERROR: " . $sql . PHP_EOL . $conn->error;
        return false;
    }
}
