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
}
