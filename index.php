<?php 
session_start(); // init session
require 'config/config.php';
require 'config/connectDB.php';
require "bootstrap.php"; // loads model
require "functions/function.php"; // loads functions
// router
$c = $_GET['c'] ?? 'dashboard';
$a = $_GET['a'] ?? 'index';
$controllerName = ucfirst($c).'Controller';
require_once 'controller/'.$controllerName.'.php';
$controller = new $controllerName();
$controller->$a();