<?php
session_start();

if(isset($_SESSION["error"])){
    echo "<div class='alert alert-danger container'>" . $_SESSION['error'] . "</div>";
    session_destroy();
}
if(isset($_SESSION["success"])){
    echo "<div class='alert alert-success container'>" . $_SESSION['success'] . "</div>";
    session_destroy();
}