<?php

error_reporting(0);
ini_set("display_errors", 0);
if (!isset($_SESSION)) {
    session_start();
}
$crm_url = 'https://unlimitedcharters.com/betacrm/index.php?entryPoint=VendorSystem';
$redirects = array(
    'after_login_complete_profile' => 'profile.php', //complete profile after first login
    'after_login_active' => 'dashboard.php',
    'after_logout' => 'login.php',
    'after_registration' => 'submitted.php',
    'profile_complete' => 'dashboard.php',
    'vehicle_image_delete' => 'vehicle.php'
    
);
$successes = array();
$errors = array();
$ispost = false;
$email = '';
$status = '';

?>