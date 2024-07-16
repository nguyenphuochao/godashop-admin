<?php
class ActionRepository extends BaseRepository
{
    protected function fetchAll($condition = null)
    {
        global $conn;
        $sql = "SELECT * FROM `action`";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        $actions = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $action = new Action($row['id'], $row['name'], $row["description"]);
                $actions[] = $action;
            }
        }
        return $actions;
    }

    function getAll()
    {
        return $this->fetchAll();
    }

    function find($id)
    {
        $condition = "id = $id";
        $actions = $this->fetchAll($condition);
        $action = current($actions);
        return $action;
    }
}
