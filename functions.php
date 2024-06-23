<?php
function messageStatus()
{
    if (!empty($_SESSION["success"])) {
        echo '<div class="alert alert-success">' . $_SESSION["success"] . '</div>';
    } else if (!empty($_SESSION["error"])) {
        echo '<div class="alert alert-success">' . $_SESSION["error"] . '</div>';
    }
    unset($_SESSION["success"]);
    unset($_SESSION["error"]);
}
