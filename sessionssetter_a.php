<?php
    session_start();
    if ($_SESSION["valid_user"] == false)
    {
    header("location:index.php");
    exit;
    }
    if ($_SESSION["rechte"] < 2)
    {
    header("location:dash.php");
    exit;
    }
?>
