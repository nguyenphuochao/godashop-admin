<?php
class StaffRepository extends BaseRepository
{
    function fetAll($condition = null)
    {
        global $conn;
        $sql = "SELECT * FROM staff";

        if ($condition) {
            $sql .= " WHERE $condition";
        }

        $result = $conn->query($sql);
        $staffs = [];

        while ($row = $result->fetch_assoc()) {
            $staff = new Staff(
                $row['id'],
                $row['role_id'],
                $row['name'],
                $row['mobile'],
                $row['username'],
                $row['password'],
                $row['email'],
                $row['is_active']
            );
            $staffs[] = $staff;
        }

        return $staffs;
    }

    function getAll()
    {
        return $this->fetAll();
    }

    function find($id)
    {
        $condition = "id = $id";
        $staffs = $this->fetAll($condition);
        $staff = current($staffs);
        return $staff;
    }

    function findByUserNamePassWord($username, $password)
    {
        $condition = "username = '$username' AND password = '$password'";
        $staffs = $this->fetAll($condition);
        $staff = current($staffs);
        return $staff;
    }

    function findEmail($email)
    {
        $condition = "email = '$email'";
        $staffs = $this->fetAll($condition);
        $staff = current($staffs);
        return $staff;
    }

    function save($data)
    {
        global $conn;
        $role_id = $data["role_id"];
        $name = $data["name"];
        $mobile = $data["mobile"];
        $username = $data["username"];
        $password = $data["password"];
        $email = $data["email"];
        $is_active = $data["is_active"];

        $sql = "INSERT INTO staff (
                role_id, 
                name, 
                mobile, 
                username, 
                password, 
                email, 
                is_active)
                VALUES (
                $role_id, 
                '$name', 
                '$mobile', 
                '$username', 
                '$password', 
                '$email', 
                $is_active)";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error:" . $sql . PHP_EOL . $conn->error;
        return false;
    }

    function update($staff)
    {
        global $conn;
        $id = $staff->getID();
        $role_id = $staff->getRoleID();
        $name = $staff->getName();
        $mobile = $staff->getMobile();
        $username = $staff->getUsername();
        $password = $staff->getPassword();
        $email = $staff->getEmail();
        $is_active = $staff->getIsActive();

        $sql = "UPDATE staff SET 
                role_id = $role_id,
                name = '$name',
                mobile = '$mobile',
                username = '$username',
                password = '$password',
                email = '$email',
                is_active = '$is_active'
                WHERE id = $id";

        if ($conn->query($sql)) {
            return true;
        }
        $this->error =  "Error:" . $sql . PHP_EOL . $conn->error;
        return false;
    }

    function getActionNames($staff)
    {
        global $conn;
        $actionNames = [];
        $role_id = $staff->getRoleID();
        $sql = "SELECT *
                FROM role_action JOIN action 
                ON role_action.action_id = action.id
                WHERE role_action.role_id = $role_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $actionNames[] = $row["name"];
            }
        }
        return $actionNames;
    }
}
