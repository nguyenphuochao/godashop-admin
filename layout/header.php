<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tổng quan</title>
    <!-- Create favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../public/images/logo.jpg" />
    <!-- Custom fonts for this template-->
    <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="../public/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../public/css/sb-admin.css" rel="stylesheet">
    <link href="../public/css/admin.css" rel="stylesheet">
</head>

<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <a class="navbar-brand mr-1" href="index.html">Mỹ Phẩm YouT</a>
        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Search -->
        <!-- Navbar -->
        <?php
        // check login
        if (empty($_SESSION['email'])) {
            if (!empty($_COOKIE["email"])) {
                $_SESSION["name"] = $_COOKIE["name"];
            } else {
                header("Location: login.php");
                exit;
            }
        }
        ?>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item no-arrow text-white">
                <span><?= $_SESSION["name"] ?></span> |
                <a class="text-white nounderline" href="index.php?c=auth&a=logout" data-toggle="modal" data-target="#logoutModal">Thoát</a>
            </li>
        </ul>
    </nav>
    <div id="wrapper">
        <!-- Sidebar -->
        <?php require 'layout/sidebar.php'; ?>