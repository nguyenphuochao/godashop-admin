<?php
if (empty($_SESSION['email'])) {
    if (!empty($_COOKIE["email"])) {
        $_SESSION["name"] = $_COOKIE["name"];
        $_SESSION["email"] = $_COOKIE["email"];
    } else {
        header("Location: login.php");
        exit;
    }
}
