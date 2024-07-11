<?php
class Role
{
    protected $id;
    protected $name;

    function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    // get attribute
    function getID()
    {
        return $this->id;
    }
    function getName()
    {
        return $this->name;
    }

    // set attribute
    function setName($name)
    {
        $this->name = $name;
        return;
    }
}
