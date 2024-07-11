<?php
class WardRepository extends BaseRepository
{
    function fetchAll($condition = null, $order = null)
    {
        global $conn;
        $sql = "SELECT * FROM ward";

        if ($condition) {
            $sql .= " WHERE $condition";
        }
        if ($order) {
            $sql .= " ORDER BY $order";
        }
        $result = $conn->query($sql);
        $wards = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ward = new Ward(
                    $row['id'],
                    $row["name"],
                    $row["type"],
                    $row["district_id"]
                );
                $wards[] = $ward;
            }
        }

        return $wards;
    }

    function getAll()
    {
        return $this->fetchAll();
    }

    function find($id)
    {
        $condition = "id = $id";
        $wards = $this->fetchAll($condition);
        $ward = current($wards);
        return $ward;
    }

    function findDistrict($district_id)
    {
        $condition = "district_id = $district_id";
        $wards = $this->fetchAll($condition, "name ASC");
        return $wards;
    }
}
