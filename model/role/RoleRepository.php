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

    function save($data)
    {
        global $conn;
        $name = $data["name"];
        $sql = "INSERT INTO role(name) VALUES ('$name')";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;
    }

    function update($role)
    {
        global $conn;
        $id = $role->getID();
        $name = $role->getName();
        $sql = "UPDATE `role` SET name = '$name' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;
    }

    function delete($role)
    {
        global $conn;
        $id = $role->getID();
        $sql = "DELETE FROM `role` WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;
    }
}
