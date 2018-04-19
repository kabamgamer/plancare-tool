<?php
session_start();

if(isset($_SESSION["error"])){
    echo "<div class='alert alert-danger container' id='hide'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']);
}
if(isset($_SESSION["success"])){
    echo "<div class='alert alert-success container' id='hide'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']);
}