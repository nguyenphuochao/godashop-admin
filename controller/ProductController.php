<?php
class ProductController
{
    function index()
    {
        $productRepository = new ProductRepository();
        $products = $productRepository->getAll();
        require 'view/product/index.php';
    }
}
