<?php
    include 'core/init.php';
    Cookie::delete("accessToken");
    header("Location: ".$_ENV["LOGIN_PORTAL"]);
?>
