<?php
class StaffController
{

    function index()
    {
        $staffRepository = new StaffRepository();
        $staffs = $staffRepository->getAll();

        require "view/staff/index.php";
    }

    function active()
    {
        $id = $_GET['id'];
        if ($this->activeOrDisable($id, 1)) {
            $_SESSION["success"] = "Kích hoạt nhân viên thành công";
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
            $_SESSION["success"] = "Vô hiệu hóa nhân viên thành công";
            header("Location: index.php?c=staff");
            exit;
        }
    }

    function activeOrDisableMulti()
    {
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
