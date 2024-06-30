<?php
class TransportRepository extends BaseRepository
{

    protected function fetchAll($condition = null)
    {
        global $conn;
        $sql = "SELECT * FROM transport";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        $transports = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $transport = new Transport(
                    $row["id"],
                    $row["province_id"],
                    $row["price"]
                );
                $transports[] = $transport;
            }
        }
        return $transports;
    }


    function getAll()
    {
        return $this->fetchAll();
    }

    function findByProvinceID($province_id)
    {
        $condition = "province_id = $province_id";
        $transports = $this->fetchAll($condition);
        $transport = current($transports);
        return $transport;
    }
}
