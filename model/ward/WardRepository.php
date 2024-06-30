<?php
class WardRepository extends BaseRepository
{
    function fetchAll($condition = null)
    {
        global $conn;
        $sql = "SELECT * FROM ward";

        if ($condition) {
            $sql .= " WHERE $condition";
        }

        $result = $conn->query($sql);
        $wards = [];

        while ($row = $result->fetch_assoc()) {
            $ward = new Ward(
                $row['id'],
                $row["name"],
                $row["type"],
                $row["district_id"]
            );
            $wards[] = $ward;
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
        $wards = $this->fetchAll($condition);
        return $wards;
    }
}
