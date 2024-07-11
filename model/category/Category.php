<?php
class Category
{

    protected $id;
    protected $name;

    function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    // get giá trị của thuộc tính
    function getID()
    {
        return $this->id;
    }
    function getName()
    {
        return $this->name;
    }

    // set giá trị cho thuộc tính
    function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    // Relationship
    // Hasmany
    function getProducts()
    {
        $productRepository = new ProductRepository();
        $conds = [
            "category_id" => [
                "type" => "=",
                "val" => $this->id
            ]
        ];
        $products = $productRepository->getBy($conds);
        return $products;
    }
}
