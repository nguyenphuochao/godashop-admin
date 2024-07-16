<?php
class PermissionController
{

    function listRole()
    {
        $roleRepository = new RoleRepository();
        $roles = $roleRepository->getAll();

        require 'view/permission/listRole.php';
    }

    function addRole()
    {
        require "view/permission/addRole.php";
    }

    function saveRole()
    {
        $data = [];
        $data["name"] = $_POST["name"];
        $roleRepository = new RoleRepository();
        if ($roleRepository->save($data)) {
            $_SESSION["success"] = "Thêm mới vai trò thành công";
            header("Location: index.php?c=permission&a=listRole");
            exit;
        }
    }

    function editRole()
    {
        $id = $_GET["id"];
        $roleRepository = new RoleRepository();
        $role = $roleRepository->find($id);

        require "view/permission/editRole.php";
    }

    function updateRole()
    {
        $id = $_POST["id"];
        $roleRepository = new RoleRepository();
        $role = $roleRepository->find($id);
        $role->setName($_POST["name"]);
        if ($roleRepository->update($role)) {
            $_SESSION["success"] = "Cập nhật vai trò thành công";
            header("Location: index.php?c=permission&a=listRole");
            exit;
        }
    }

    function deleteRole()
    {
        $id = $_GET["id"];
        $roleRepository = new RoleRepository();
        $role = $roleRepository->find($id);
        if ($roleRepository->delete($role)) {
            $_SESSION["success"] = "Xóa vai trò thành công";
            header("Location: index.php?c=permission&a=listRole");
            exit;
        }
    }

    function checkDeleteRole()
    {
        $role_id = $_GET["role_id"];
        $roleActionRepository = new RoleRepository();
        $role = $roleActionRepository->find($role_id);
        if (count($role->getActions()) > 0) {
            echo json_encode(["can_delete" => 0, "message" => "Vai trò này có tác vụ, không thể xóa"]);
            return;
        }

        if (count($role->getStaffs()) > 0) {
            echo json_encode(["can_delete" => 0, "message" => "Vai trò này có nhân viên, không thể xóa"]);
            return;
        }
        // xóa được
        echo json_encode(["can_delete" => 1, "message" => "OK"]);
        return;
    }

    function listAction()
    {
        $actionRepository = new ActionRepository();
        $actions = $actionRepository->getAll();

        require "view/permission/listAction.php";
    }

    // danh sách quyền cho nhân viên
    function listRoleAction()
    {
        $actionRepository = new ActionRepository();
        $actions = $actionRepository->getAll();

        $role_id = $_GET["id"];
        $roleRepository = new RoleRepository();
        $role = $roleRepository->find($role_id);
        $roleActions = $role->getActions();

        $selected_actions = [];
        foreach ($roleActions as $roleAction) {
            $selected_actions[] = $roleAction->getActionID();
        }

        require "view/permission/listRoleAction.php";
    }

    // gán quyền cho nhân viên
    function updateRoleAction()
    {
        $role_id = $_POST["role_id"];
        $action_ids = $_POST["action_ids"];

        $roleRepository = new RoleRepository();
        $role = $roleRepository->find($role_id);

        // Thu hồi tất cả quyền
        $roleActionRepository = new RoleActionRepository();
        $roleActionRepository->deleteByRoleID($role_id);

        // Gán lại quyền mới
        foreach ($action_ids as $action_id) {
            $data = [];
            $data["role_id"] = $role_id;
            $data["action_id"] = $action_id;
            $roleActionRepository->save($data);
        }
        $_SESSION["success"] = "Cập nhật quyền cho {$role->getName()} thành công";
        header("Location: index.php?c=permission&a=listRoleAction&id=$role_id");
    }
}
