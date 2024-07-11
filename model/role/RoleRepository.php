<?php
class RoleRepository extends BaseRepository
{

    protected function fetchAll($condition = null)
    {
        global $conn;
        $sql = "SELECT * FROM `role`";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        $roles = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $role = new Role($row['id'], $row['name']);
                $roles[] = $role;
            }
        }
        return $roles;
    }

    function getAll()
    {
        return $this->fetchAll();
    }

    function find($id)
    {
        $condition = "id = $id";
        $roles = $this->fetchAll($condition);
        $role = current($roles);
        return $role;
    }
}
