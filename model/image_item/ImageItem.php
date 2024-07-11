<?php
class ImageItem
{
    // init property
    protected $id;
    protected $product_id;
    protected $name;

    // autoload
    function __construct($id, $product_id, $name)
    {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->name = $name;
    }

    // get attribute
    function getID()
    {
        return $this->id;
    }
    function getProductID()
    {
        return $this->product_id;
    }
    function getName()
    {
        return $this->name;
    }
    
    // set attribute
    function setProductID($product_id)
    {
        $this->product_id = $product_id;
        return $this;
    }
    function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
