<?php
class CategoryController
{

    function index()
    {
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getAll();
        include "view/category/index.php";
    }

    function add()
    {
        require "view/category/add.php";
    }

    function save()
    {
        $data = [];
        $data["name"] = $_POST["name"];
        $categoryRepository = new CategoryRepository();
        if ($categoryRepository->save($data)) {
            $_SESSION["success"] = "Thêm mới danh mục thành công";
            header("Location: index.php?c=category");
        }
    }

    function delete()
    {
        $id = $_GET['id'];
        if ($this->remove($id)) {
            $_SESSION["success"] = "Xóa danh mục thành công";
            header("Location: index.php?c=category");
        }
    }

    function deletes()
    {
        $ids = $_POST['ids'];
        $flag = true;
        foreach ($ids as $id) {
            if (!$this->remove($id)) {
                $flag = false;
            }
        }
        if ($flag) {
            $_SESSION["success"] = "Xóa danh mục thành công";
            header("Location: index.php?c=category");
        }
    }

    function remove($id)
    {
        $categoryRepository = new CategoryRepository();
        $category = $categoryRepository->find($id);
        if ($categoryRepository->delete($category)) {
            return true;
        }
        echo $categoryRepository->getError();
        return false;
    }

    function checkDelete()
    {
        $category_id = $_GET["category_id"];
        $categoryRepository = new CategoryRepository();
        $category = $categoryRepository->find($category_id);
        $producs = $category->getProducts();
        if (count($producs) > 0) {
            // không xóa dc
            echo json_encode(["can_detele" => 0, "message" => "Danh mục {$category->getName()} đang chứa sản phẩm, không thể xóa"]);
            return;
        }
        // có thể xóa
        echo json_encode(["can_detele" => 1, "message" => "OK"]);
    }

    function checkDeletes()
    {
        $ids = $_GET['ids'];
        $categoryRepository = new CategoryRepository();
        $flag = true;
        foreach ($ids as $id) {
            $category = $categoryRepository->find($id);
            $producs = $category->getProducts();
            if (count($producs) > 0) {
                $flag = false;
            }
        }
        if ($flag) {
            // không thể xóa
            echo json_encode(["can_detele" => 1, "message" => "OK"]);
            return false;
        }
        // có thể xóa
        echo json_encode(["can_detele" => 0, "message" => "Danh mục có chứa sản phẩm, không thể xóa"]);
    }
}
