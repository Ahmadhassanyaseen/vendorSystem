<?php

$page = 'logout';
require_once './config.php';

unset($_SESSION['VNDR']);
if($_SESSION){
    session_destroy();
}
header("Location: " . $redirects['after_logout']);
exit;
?>
