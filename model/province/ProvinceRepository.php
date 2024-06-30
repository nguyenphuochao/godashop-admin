<?php
class ProvinceRepository extends BaseRepository
{
    protected function fetchAll($condition = null)
    {
        global $conn;
        $sql = "SELECT * FROM province";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        $provices = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $province = new Province(
                    $row["id"],
                    $row["name"],
                    $row["type"]
                );
                $provices[] = $province;
            }
        }
        return $provices;
    }

    function find($id)
    {
        $condition = "id = $id";
        $provinces = $this->fetchAll($condition);
        $province = current($provinces);
        return $province;
    }

    function getAll()
    {
        return $this->fetchAll();
    }
}
