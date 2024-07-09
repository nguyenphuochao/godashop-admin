<?php
class CommentController
{
    function index()
    {
        $productRepository = new ProductRepository();
        $products = $productRepository->getAll();
        require "view/comment/index.php";
    }

    function detail()
    {
        $product_id = $_GET['product_id'];

        $productRepository = new ProductRepository();
        $product = $productRepository->find($product_id);

        $commentRepository = new CommentRepository();
        $comments = $commentRepository->findByProductID($product_id);

        require "view/comment/detail.php";
    }

    // xóa 1 dòng comment
    function delete()
    {
        $id = $_GET['id'];
        $product_id = $_GET['product_id'];
        if ($this->remove($id)) {
            $_SESSION["success"] =  "Xóa thành công comment";
            header("Location: index.php?c=comment&a=detail&product_id=$product_id");
            return;
        }
        $_SESSION["error"] =  "Xóa thất bại comment";
        header("Location: index.php?c=comment&a=detail&product_id=$product_id");
    }

    // xóa nhiều comment
    function deletes()
    {
        $ids = $_POST['ids'];
        $product_id = $_POST['product_id'];
        foreach ($ids as $id) {
            if (!$this->remove($id)) {
                $_SESSION["error"] =  "Xóa thất bại comment";
                header("Location: index.php?c=comment&a=detail&product_id=$product_id");
                return;
            }
        }
        header("Location: index.php?c=comment&a=detail&product_id=$product_id");
    }

    function remove($id)
    {
        $commentRepository = new CommentRepository();
        $comment = $commentRepository->find($id);
        if ($commentRepository->delete($comment)) {
            return true;
        }
        return false;
    }
}
