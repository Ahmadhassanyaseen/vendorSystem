<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($page) || empty($page)) {
    header("location:login.php?welcome");
    exit();
}
//print_r($_SESSION['VNDR']);
//echo $_SESSION['VNDR']['status'];
//echo $page;
$allowed_pages = array('login', 'reset', 'register', 'activate', 'createpassword');
$restricted_pages = array('profile', 'dashboard', 'vehicle', 'delete', 'index' , 'addOns' , 'deleteVehicleImages' , 'lead_quotes'); //
if (isset($_SESSION['VNDR']) && !empty($_SESSION['VNDR'])) {
    if (isset($_SESSION['VNDR']['status']) && $_SESSION['VNDR']['status'] == 'Complete_Profile' && !in_array($page, $restricted_pages)) {
        header("location:profile.php");
        exit();
    } else if (isset($_SESSION['VNDR']['status']) && $_SESSION['VNDR']['status'] == 'Active' && !in_array($page, $restricted_pages)) {
        header("location:dashboard.php");
        exit();
    } else if (isset($_SESSION['VNDR']['status']) && $_SESSION['VNDR']['status'] == 'Disabled_Admin') {
        header("location:logout.php?suspended");
        exit();
    } else if (isset($_SESSION['VNDR']['status']) && $_SESSION['VNDR']['status'] == 'Deactivated') {
        header("location:logout.php?deactivated");
        exit();
    } else if (isset($_SESSION['VNDR']['status']) && $_SESSION['VNDR']['status'] == 'Email_Verification') {
        header("location:logout.php?verify");
        exit();
    } 
} else if (isset($page) && in_array($page, $restricted_pages)) {
    header("location:login.php?welcome");
    exit();
}