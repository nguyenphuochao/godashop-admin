<?php
class ImageItemController
{
    function index()
    {
        $productRepository = new ProductRepository();
        $products = $productRepository->getAll();

        require "view/image_item/index.php";
    }

    function detail()
    {
        $product_id = $_GET['product_id'];
        $productRepository = new ProductRepository();
        $product = $productRepository->find($product_id);

        $imageItemRepository = new ImageItemRepository();
        $imageItems = $imageItemRepository->getByProductID($product_id);

        require "view/image_item/detail.php";
    }
    
    // delete one item
    function delete()
    {
        $id = $_GET["id"];
        $product_id = $_GET["product_id"];
        if ($this->remove($id)) {
            header("Location: index.php?c=imageitem&a=detail&product_id=$product_id");
            exit;
        }
    }

    // delete many items
    function deletes()
    {
        if (empty($_POST["ids"])) {
            $_SESSION["error"] = "Vui lòng chọn";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $product_id = $_POST["product_id"];
        $ids = $_POST["ids"];
        // dùng for cho mảng tuần tự 1 chiều
        for ($i = 0; $i <= count($ids) - 1; $i++) {
            if ($this->remove($ids[$i])) {
                $_SESSION["success"] = "Xóa thành công";
                header("Location: index.php?c=imageitem&a=detail&product_id=$product_id");
            }
        }
    }

    function remove($id)
    {
        $imageItemRepository = new ImageItemRepository();
        $imageItem = $imageItemRepository->find($id);
        $filePatch = "uploads/" . $imageItem->getName();
        if ($imageItemRepository->delete($imageItem)) {
            if(file_exists($filePatch)){
                unlink($filePatch); // remove file in folder
            }
            return true;
        }
        return false;
    }

    function save()
    {
        $product_id = $_POST["product_id"];
        if (!empty($_FILES["image"]["name"]) && $_FILES["image"]["error"] == 0) {
            $imageService = new ImageService();
            $correctFileName = $imageService->getCorrectImage($_FILES["image"]["name"]);
            $data = [];
            $data["product_id"] = $product_id;
            $data["name"] = $correctFileName;

            $imageItemRepository = new ImageItemRepository();
            if ($imageItemRepository->save($data)) {
                $from = $_FILES["image"]["tmp_name"];
                $to = "uploads/" . $correctFileName;
                move_uploaded_file($from, $to);
                header("Location: index.php?c=imageitem&a=detail&product_id=$product_id");
                exit;
            }
            echo $imageItemRepository->getError();
            exit();
        }
        echo "Vui lòng chọn ảnh";
    }
}
