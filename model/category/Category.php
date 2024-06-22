<?php
class Category
{
    protected $id;
    protected $name;
    protected $parent_id;
    protected $created_date;
    protected $updated_date;
    protected $status;
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
}
