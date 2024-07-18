<?php
class BrandController
{

    function index()
    {
        $brandRepository = new BrandRepository();
        $brands = $brandRepository->getAll();

        require "view/brand/index.php";
    }

    function add()
    {
        require "view/brand/add.php";
    }

    function save()
    {
        $brandRepository = new BrandRepository();
        $brand = $brandRepository->findByName($_POST['name']);
        if ($brand) {
            $_SESSION["error"] = "Nhãn hiệu đã tồn tại";
            header("Location: index.php?c=brand&a=add");
            exit;
        }
        $data = [];
        $data['name'] = $_POST['name'];
        if ($brandRepository->save($data)) {
            $_SESSION["success"] = "Thêm nhãn hiệu thành công";
            header("Location: index.php?c=brand");
            exit;
        }
        echo $brandRepository->getError();
    }

    function edit()
    {
        $id = $_GET['id'];
        $brandRepository = new BrandRepository();
        $brand = $brandRepository->find($id);

        require "view/brand/edit.php";
    }

    function update()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];

        $brandRepository = new BrandRepository();
        $brand = $brandRepository->findByName($_POST['name']);
        if ($brand && $brand->getID() != $id) {
            $_SESSION["error"] = "Nhãn hiệu đã tồn tại";
            header("Location: index.php?c=brand&a=edit&id=$id");
            exit;
        }

        $brandRepository = new BrandRepository();
        $brand = $brandRepository->find($id);
        $brand->setName($name);
        if ($brandRepository->update($brand)) {
            $_SESSION["success"] = "Cập nhật nhãn hiệu thành công";
            header("Location: index.php?c=brand");
            exit;
        }
        echo $brandRepository->getError();
    }

    function delete()
    {
        $id = $_GET['id'];
        if ($this->remove($id)) {
            $_SESSION["success"] = "Xóa nhãn hiệu thành công";
            header("Location: index.php?c=brand");
            exit;
        }
    }

    function deletes()
    {
        $flag = true;
        $ids = $_POST['ids'];
        foreach ($ids as $id) {
            if (!$this->remove($id)) {
                $flag = false;
            }
        }
        if ($flag) {
            $_SESSION["success"] = "Xóa nhãn hiệu thành công";
            header("Location: index.php?c=brand");
            exit;
        }
        header("Location: index.php?c=brand");
    }

    function checkDelete()
    {
        $brand_id = $_GET["brand_id"];
        if ($this->canDelete($brand_id)) {
            echo json_encode(["can_delete" => 1, "message" => "OK"]);
        }
    }

    function checkDeletes()
    {
        $ids = $_GET["ids"];
        foreach ($ids as $id) {
            if (!$this->canDelete($id)) {
                return;
            }
        }
        echo json_encode(["can_delete" => 1, "message" => "OK"]);
    }

    // Protected function
    protected function remove($id)
    {
        $brandRepository = new BrandRepository();
        $brand = $brandRepository->find($id);
        if ($brandRepository->delete($brand)) {
            return true;
        }
        echo $brandRepository->getError();
        return false;
    }

    protected function canDelete($id)
    {
        $brandRepository = new BrandRepository();
        $brand = $brandRepository->find($id);
        if (count($brand->getProducts()) > 0) {
            echo json_encode(["can_delete" => 0, "message" => "Nhãn hiệu đang chứa sản phẩm, không thể xóa"]);
            return false;
        }
        return true;
    }
}
