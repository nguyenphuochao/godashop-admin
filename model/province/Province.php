<?php
class Province
{
    protected $id;
    protected $name;
    protected $type;

    function __construct($id, $name, $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }

    // get Attribute
    function getID()
    {
        return $this->id;
    }
    function getName()
    {
        return $this->name;
    }
    function getType()
    {
        return $this->type;
    }
}
