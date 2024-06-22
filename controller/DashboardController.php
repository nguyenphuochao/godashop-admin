<?php
class DashboardController
{
    function index()
    {
        require 'view/dashboard/index.php';
    }
    function add()
    {
        echo "Form add";
    }
    function store()
    {
        echo "Store data";
    }
    function edit()
    {
        echo "Edit data";
    }
    function update()
    {
        echo "Update data";
    }
    function delete()
    {
        echo "Delete data";
    }
}
