<?php
$page = 'reset';
require_once './config.php';
require_once './session.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once './functions.php';
    // $validate_code = validate_captcha_code($_POST, $_SESSION);
    $required_fields = array('user_email');
    $validate_required = validate_required_fields($_POST, $required_fields);
    $validate_email = validate_email_address($_POST['user_email']);
    if ($_POST['user_email'])
        $email = $_POST['user_email'];
    // if ($validate_code !== true)
    //     $errors[] = 'Validation code is empty or incorrect.';
    if ($validate_required !== true)
        $errors[] = $validate_required;
    if ($validate_email !== true)
        $errors[] = 'Invalid or empty email address.';
    if ($errors != null && sizeof($errors) > 0) {
        $ispost = true;
    } else {
        $data = array();
        $data["user_email"] = trim($_POST['user_email']);
        $data["method"] = "ResetPassword";
        $curl = curl_init($crm_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        if ($response == "success") {
            $successes[] = 'We have sent you an email with link to password reset. Please click that link to create a new password.';
        } else {
            $errors[] = $response;
        }
    }
}

$title = 'Reset Password | Unlimited Charters Vendor System';
require './header.php';
require './reset_form.php';
require './footer.php';
?>