<?php
class RoleAction
{

    protected $role_id;
    protected $action_id;

    function __construct($role_id, $action_id)
    {
        $this->role_id = $role_id;
        $this->action_id = $action_id;
    }
    
    // get Attribute
    function getRoleID()
    {
        return $this->role_id;
    }
    function getActionID()
    {
        return $this->action_id;
    }
}
