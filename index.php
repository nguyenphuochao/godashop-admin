<?php
session_start(); // init session
require 'config/config.php';
require 'config/connectDB.php';
require "bootstrap.php"; // loads model

include "load.php";
// router
$c = $_GET['c'] ?? 'dashboard';
$a = $_GET['a'] ?? 'index';


// check ACL
if (!empty($_SESSION['email'])) {
    $aclService = new ACLService();
    $staffRepository = new StaffRepository();
    $staff = $staffRepository->findEmail($_SESSION['email']);
    if (!$aclService->hasPermission($staff, $c, $a)) {
        $_SESSION["error"] =  $aclService->getMessage();
        header("Location: index.php");
        exit;
    }
}


$controllerName = ucfirst($c) . 'Controller';
require_once 'controller/' . $controllerName . '.php';
$controller = new $controllerName();
$controller->$a();
