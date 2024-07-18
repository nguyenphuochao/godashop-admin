<?php
class Brand
{
    protected $id;
    protected $name;

    function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    // Get giá trị của thuộc tính
    function getID()
    {
        return $this->id;
    }
    
    function getName()
    {
        return $this->name;
    }
 
    // Set giá trị cho thuộc tính
    function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    function getProducts()
    {
        $productRepository = new ProductRepository();
        $products = $productRepository->getByBrandID($this->id);
        return $products;
    }
    
}
