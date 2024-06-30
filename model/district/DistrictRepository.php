<?php
class DistrictRepository extends BaseRepository
{
    protected function fetchAll($condition = null)
    {
        global $conn;
        $sql = "SELECT * FROM district";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        $districts = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $district = new District(
                    $row["id"],
                    $row["name"],
                    $row["type"],
                    $row["province_id"]
                );
                $districts[] = $district;
            }
        }
        return $districts;
    }

    function getAll()
    {
        return $this->fetchAll();
    }

    function find($id)
    {
        $condition = "id= $id";
        $districts = $this->fetchAll($condition);
        $district = current($districts);
        return $district;
    }

    function findProvince($provice_id)
    {
        $condition = "province_id = $provice_id";
        $districts = $this->fetchAll($condition);
        return $districts;
    }
}
