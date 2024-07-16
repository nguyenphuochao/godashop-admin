<?php
class RoleActionRepository extends BaseRepository
{

    protected function fetchAll($condition = null)
    {
        global $conn;
        $sql = "SELECT * FROM `role_action`";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        $roleActions = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $roleAction = new RoleAction($row['role_id'], $row['action_id']);
                $roleActions[] = $roleAction;
            }
        }
        return $roleActions;
    }

    function getAll()
    {
        return $this->fetchAll();
    }

    function save($data)
    {
        global $conn;
        $role_id = $data["role_id"];
        $action_id = $data["action_id"];
        $sql = "INSERT INTO role_action (role_id, action_id) VALUES ($role_id, $action_id)";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;
    }

    function getByRoleID($role_id)
    {
        $condition = "role_id = $role_id";
        $roleActions = $this->fetchAll($condition);
        return $roleActions;
    }

    function deleteByRoleID($role_id)
    {
        global $conn;
        $sql = "DELETE FROM role_action WHERE role_id = $role_id";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;
    }
}
