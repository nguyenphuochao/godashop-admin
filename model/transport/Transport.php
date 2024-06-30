<?php
class Transport
{
    protected $id;
    protected $province_id;
    protected $price;

    function __construct($id, $province_id, $price)
    {
        $this->id = $id;
        $this->province_id = $province_id;
        $this->price = $price;
    }

    // get attribute
    function getID()
    {
        return $this->id;
    }
    function getProvinceID()
    {
        return $this->province_id;
    }
    function getPrice()
    {
        return $this->price;
    }
}
