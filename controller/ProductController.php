<?php
class ProductController
{
    function index()
    {
        $productRepository = new ProductRepository();
        $products = $productRepository->getAll();
        require 'view/product/index.php';
    }

    function add()
    {
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getAll();

        $brandRepository = new BrandRepository();
        $brands = $brandRepository->getAll();
        require "view/product/add.php";
    }

    function store()
    {
        $file = $_FILES['image']['tmp_name'];
        $path = "uploads/" . $_FILES['image']['name'];
        $data = [];
        $data["barcode"] = $_POST["barcode"];
        $data["sku"] = $_POST["sku"];
        $data["name"] = $_POST["name"];
        $data["price"] = $_POST["price"];
        $data["discount_percentage"] = $_POST["discount_percentage"];
        $data["discount_from_date"] = $_POST["discount_from_date"];
        $data["discount_to_date"] = $_POST["discount_to_date"];
        $data["featured_image"] = $_FILES['image']['name'];
        $data["inventory_qty"] = $_POST["inventory_qty"];
        $data["category_id"] = $_POST["category_id"];
        $data["brand_id"] = $_POST["brand_id"];
        $data["created_date"] = date("Y-m-d H:i:s");
        $data["description"] = $_POST["description"];
        $data["featured"] = $_POST["featured"];

        $productRepository = new ProductRepository();
        if ($productRepository->save($data)) {
            move_uploaded_file($file, $path); // di chuyển file vào thư mục
            $_SESSION["success"] = "Thêm mới sản phẩm thành công";
        } else {
            $_SESSION["error"] = $productRepository->getError();
        }
        header('Location: index.php?c=product');
    }

    function edit()
    {
        $id = $_GET["id"];
        if (!$id) {
            header('Location: index.php?c=product');
            exit;
        }
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getAll();

        $brandRepository = new BrandRepository();
        $brands = $brandRepository->getAll();

        $productRepository = new ProductRepository();
        $product = $productRepository->find($id);
        require "view/product/edit.php";
    }

    function update()
    {
        $id = $_POST["id"];
        $productRepository = new ProductRepository();
        $product = $productRepository->find($id);
        $product->setBarCode($_POST["barcode"]);
        $product->setSKU($_POST["sku"]);
        $product->setName($_POST["name"]);
        $product->setPrice($_POST["price"]);
        $product->setDiscountPercentage($_POST["discount_percentage"]);
        $product->setDiscountFromDate($_POST["discount_from_date"]);
        $product->setDiscountToDate($_POST["discount_to_date"]);
        $product->setInventoryQty($_POST["inventory_qty"]);
        $product->setCategoryID($_POST["category_id"]);
        $product->setBrandID($_POST["brand_id"]);
        $product->setDescription($_POST["description"]);
        $product->setFeatured($_POST["featured"]);
        // update lại hình
        if (!empty($_FILES["image"]["name"])) {
            // xóa hình cũ đi
            $file = "uploads/" . $product->getFeaturedImage();
            unlink($file);
            // Cập nhật lại hình
            $product->setFeaturedImage($_FILES["image"]["name"]);
            $file = $_FILES['image']['tmp_name'];
            $path = "uploads/" . $_FILES['image']['name'];
            move_uploaded_file($file, $path); // di chuyển file vào thư mục
        }

        if ($productRepository->update($product)) {
            $_SESSION["success"] = "Cập nhật sản phẩm thành công";
        }

        $_SESSION["error"] = $productRepository->getError();
        header("Location: index.php?c=product");
    }

    function delete()
    {
        $id = $_GET["id"];
        if (!$id) {
            header('Location: index.php?c=product');
            exit;
        }
        $productRepository = new ProductRepository();
        $product = $productRepository->find($id);
        if ($productRepository->delete($product)) {
            // xóa lun cái file ảnh
            $file = "uploads/" . $product->getFeaturedImage();
            if (file_exists($file)) {
                unlink($file);
            }
            $_SESSION["success"] = "Xóa thành công sản phẩm";
        } else {
            $_SESSION["error"] = "Bạn không thể xóa sản phẩm đang tồn tại danh mục";
        }


        header("Location: index.php?c=product");
    }

    function deleteAll()
    {
        $flag = true;
        $ids = $_GET["ids"];
        foreach ($ids as $id) {
            $productRepository = new ProductRepository();
            $product = $productRepository->find($id);
            if ($productRepository->delete($product)) {
                $flag = true;
            } else {
                $flag = false;
            }
        }
        if ($flag == true) {
            echo "Xóa thành công sản phẩm";
            exit;
        }
        echo "Bạn không thể xóa sản phẩm đang tồn tại danh mục";
    }

    function findBarCode()
    {
        $barcode = $_GET["barcode"];
        $productRepository = new ProductRepository();
        $product = $productRepository->findByBarCode($barcode);
        if (!$product) {
            return false;
        }
        $data = [
            "id" => $product->getID(),
            "barcode" => $product->getBarCode(),
            "feature_image" => $product->getFeaturedImage(),
            "name" => $product->getName(),
            "price" => $product->getPrice(),
            "sale_price" => $product->getSalePrice(),
            "discount_percentage" => $product->getDiscountPercentage(),

        ];
        // trả về json cho trình duyệt
        echo json_encode($data);
    }
}
