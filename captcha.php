<?php

if (!isset($_SESSION)) {
    session_start();
}
include("./phptextClass.php");

/* create class object */
$phptextObj = new phptextClass();
/* phptext function to genrate image with text */
$phptextObj->phpcaptcha('#00b0ff', '#fff', 250, 45, 7, 15);
?>