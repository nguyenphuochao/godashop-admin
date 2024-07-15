<?php
class StaffController
{

    function index()
    {
        $staffRepository = new StaffRepository();
        $staffs = $staffRepository->getAll();

        require "view/staff/index.php";
    }

    function add()
    {
        $roleRepository = new RoleRepository();
        $roles = $roleRepository->getAll();

        require "view/staff/add.php";
    }

    function save()
    {
        $data = [];
        $data["role_id"] = $_POST["role"];
        $data["name"] = $_POST["name"];
        $data["mobile"] = $_POST["mobile"];
        $data["username"] = $_POST["username"];
        $data["password"] = md5($_POST["password"]);
        $data["email"] = $_POST["email"];
        $data["is_active"] = $_POST["is_active"];
        $staffRepository = new StaffRepository();
        if ($staffRepository->save($data)) {
            $_SESSION["success"] = "Thêm nhân viên thành công";
            header("Location: index.php?c=staff");
            exit;
        }
    }

    function edit()
    {
        $id = $_GET['id'];
        $staffRepository = new StaffRepository();
        $staff = $staffRepository->find($id);

        $roleRepository = new RoleRepository();
        $roles = $roleRepository->getAll();

        require "view/staff/edit.php";
    }

    function update()
    {
        $id = $_POST["id"];
        $staffRepository = new StaffRepository();
        $staff = $staffRepository->find($id);
        $staff->setRoleID($_POST["role"]);
        $staff->setName($_POST["name"]);
        $staff->setMobile($_POST["mobile"]);
        $staff->setUsername($_POST["username"]);
        $staff->setEmail($_POST["email"]);
        if (!empty($_POST["password"])) {
            $staff->setPassword(md5($_POST["password"]));
        }
        $staff->setIsActive(0);
        if (!empty($_POST["is_active"])) {
            $staff->setIsActive(1);
        }
        if($staff->getRoleID() == 1){
            $staff->setIsActive(1);
        }
        if ($staffRepository->update($staff)) {
            $_SESSION["success"] = "Cập nhật nhân viên {$staff->getName()} thành công";
            header("Location: index.php?c=staff");
            exit;
        }
    }

    function active()
    {
        $id = $_GET['id'];
        $staffRepository = new StaffRepository();
        $staff = $staffRepository->find($id);
        if ($this->activeOrDisable($id, 1)) {
            $_SESSION["success"] = "Kích hoạt nhân viên {$staff->getName()} thành công";
            header("Location: index.php?c=staff");
            exit;
        }
    }

    function disable()
    {
        $id = $_GET['id'];
        $staffRepository = new StaffRepository();
        $staff = $staffRepository->find($id);
        if ($staff->getRoleID() == 1) {
            $_SESSION["error"] = "Tài khoản admin không thể vô hiệu";
            header("Location: index.php?c=staff");
            exit;
        }

        if ($this->activeOrDisable($id, 0)) {
            $_SESSION["success"] = "Vô hiệu hóa nhân viên {$staff->getName()} thành công";
            header("Location: index.php?c=staff");
            exit;
        }
    }

    function activeOrDisableMulti()
    {
        if (empty($_POST["ids"])) {
            $_SESSION["error"] = "Vui lòng chọn";
            header("Location: index.php?c=staff");
            exit;
        }

        $ids = $_POST["ids"];
        $activeMulti = !empty($_POST["activeMulti"]) ? 1 : 0;
        $flag = true;
        foreach ($ids as $id) {
            if (!$this->activeOrDisable($id, $activeMulti)) {
                $flag = false;
            }
        }

        if ($flag) {
            header("Location: index.php?c=staff");
        }
    }

    protected function activeOrDisable($id, $isActive)
    {
        $staffRepository = new StaffRepository();
        $staff = $staffRepository->find($id);
        if ($staff->getRoleID() == 1) {
            return true;
        }
        $staff->setIsActive($isActive);
        return $staffRepository->update($staff);
    }
}
