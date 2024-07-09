<?php
class Comment
{
    protected $id;
    protected $product_id;
    protected $email;
    protected $fullname;
    protected $star;
    protected $created_date;
    protected $description;

    function __construct($id, $product_id, $email, $fullname, $star, $created_date, $description)
    {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->email = $email;
        $this->fullname = $fullname;
        $this->star = $star;
        $this->created_date = $created_date;
        $this->description = $description;
    }

    // get atrribute
    function getID()
    {
        return $this->id;
    }
    function getProductID()
    {
        return $this->product_id;
    }
    function getEmail()
    {
        return $this->email;
    }
    function getFullname()
    {
        return $this->fullname;
    }
    function getStar()
    {
        return $this->star;
    }
    function getCreatedDate()
    {
        return $this->created_date;
    }
    function getDescription()
    {
        return $this->description;
    }
}
