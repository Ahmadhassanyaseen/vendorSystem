<?php

$page = 'login';
require_once './config.php';
require './session.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ispost = true;
    require_once './functions.php';
    $required_fields = array('username', 'password');
    $validate_required = validate_required_fields($_POST, $required_fields);
    $validate_email = validate_email_address($_POST['username']);
    if ($_POST['username'])
        $email = $_POST['username'];
    if ($validate_required !== true)
        $errors[] = $validate_required;
    if ($validate_email !== true)
        $errors[] = 'Invalid or empty email address.';
    if ($errors != null && sizeof($errors) > 0) {
        $errors[] = 'Not Found';
    } else {
        $data = array();
        $data["username"] = trim($_POST['username']);
        $data["password"] = md5(trim($_POST['password']));
        $data["method"] = "LoginVendor";
        $curl = curl_init($crm_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        $result_data = json_decode($response, true);
        if (isset($result_data['CURL_RESULT']) && $result_data['CURL_RESULT'] == "success") {
            foreach ($result_data as $rindx => $rdata)
                $_SESSION['VNDR'][$rindx] = $rdata;
            if (isset($_SESSION['VNDR']['status']) && $_SESSION['VNDR']['status'] == 'Active') {
                header("Location:" . $redirects['after_login_active']);
            } else {
                header("Location:" . $redirects['after_login_complete_profile']);
            }
            exit();
        } else {
            $errors[] = $response;
        }
    }
}

$title = 'Sign In | Unlimited Charters Vendor System';
require './header.php';
require './login_form.php';
require './footer.php';
