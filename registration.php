<?php

$page = 'register';
require_once './config.php';
require_once './session.php';
require_once './errorLog.php';



$log = "";
$success_log = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once './functions.php';
    // print_r($_POST);
    $log .= "POST request detected." . PHP_EOL;
    // $validate_code = validate_captcha_code($_POST, $_SESSION);
    $required_fields = array('user_email', 'user_password', 'confirm_password');
    $validate_required = validate_required_fields($_POST, $required_fields);
    $password_match = validate_match_password($_POST);
    $validate_email = validate_email_address($_POST['user_email']);


    // echo $password_match;


    $log .= "Trying to post validate data." . PHP_EOL;
    if ($_POST['user_email'])
    $log .= "Found a user email field value." . PHP_EOL;
        $email = $_POST['user_email'];
    // if ($validate_code !== true)
    //     $log .= "Found a validation code field value." . PHP_EOL;
    //     $errors[] = 'Validation code is empty or incorrect.';
    if (!$validate_required){
        $log .= "Found a validation Required field value." . PHP_EOL;
        $errors[] = $validate_required;

    }
    if (!$password_match){
        $errors[] = 'Password doesn\'t match with confirm password.';
        $log .= "Found a password math field value." . PHP_EOL;

    }
    if (!$validate_email){
        $log .= "Found a validation email field value." . PHP_EOL;
        $errors[] = 'Invalid or empty email address.';

    }
    if ($errors != null && sizeof($errors) > 0) {
        $log .= "Adding $ispost to session." . PHP_EOL;
        $ispost = true;
    } else {
        $data = array();
        $data["email1"] = trim($_POST['user_email']);
        $data["password"] = md5(trim($_POST['user_password']));
        $data["method"] = "CreateVendor";
        $curl = curl_init($crm_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        $log .= $response;
        if ($response == "success") {
            $success_log .= "Successfully registered. Redirecting to login page." . PHP_EOL;
            header("Location:" . $redirects['after_registration']);
            exit();
        } else {
            $log .= "Lead creation failed. CRM error detected. May be error while results parsing. Manually search lead in CRM agains this email (" . $_POST['user_email'] . ")" . PHP_EOL;
            $errors[] = $response;
        }
    }
}

$title = 'Sign Up | Unlimited Charters Vendor System';
require './header.php';
require './registration_form.php';
require './footer.php';
?>