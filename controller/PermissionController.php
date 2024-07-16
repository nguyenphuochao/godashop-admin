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
    }

    function updateRole()
    {
    }

    function delete()
    {
    }

    function listRoleAction()
    {
        $id = $_GET["id"];
        $actionRepository = new ActionRepository();
        $actions = $actionRepository->getAll();

        $roleRepository = new RoleRepository();
        $role = $roleRepository->find($id);

        require "view/permission/listRoleAction.php";
    }

    function updateRoleAction()
    {

        $role_id = $_POST["role_id"];
        $action_ids = $_POST["action_ids"];
        $data = [];

        foreach ($action_ids as $action_id) {
            // $roleRepository = new RoleRepository();
            // $role = $roleRepository->find($role_id);
            // $roleRepository->delete($role); // xóa hết quyền cũ
            // // cập nhật quyền mới
            // if ($roleRepository->save($data)) {
            //     $_SESSION["success"] = "Cập nhật quyền thành công";
            // }
        }
    }
};
