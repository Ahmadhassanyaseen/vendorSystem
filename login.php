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


   
  
    if (!$_POST['username'])
    {
    $errors[] = 'Add Email Address';
        
}
    if ($validate_required !== true)
    {

        echo $validate_required;
        
        $errors[] = $validate_required;
    }
    if ($validate_email !== true)
    {
        echo $validate_email;
        $errors[] = 'Invalid or empty email address.';

    }
    // if ($errors != null && sizeof($errors) > 0) {
    //     echo json_encode($errors);
    //     exit();
        
    // } 
    else {
        $data = array();
        $data["email"] = trim($_POST['username']);
        $data["password"] = md5(trim($_POST['password']));
        $data["method"] = "loginVendorNew";

        // print_r($data);
        // print_r($_POST);
        // print_r($data['username']);
        $curl = curl_init($crm_url);

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        
        // echo $response;
        // echo 'xeno';
        $result_data = json_decode($response, true);
        // print_r($result_data);
        //     echo '</br>';
        //     echo '</br>';
        if (isset($result_data['CURL_RESULT']) && $result_data['CURL_RESULT'] == "success") {
           $_SESSION['VNDR'] = $result_data['data'];
           if(isset($_SESSION['VNDR']) && $_SESSION['VNDR']['status'] == "Active"){
                header("Location: dashboard.php");
            }
            else{
                echo "<script>alert('Acivate Now');</script>";
            }
            // print_r($_SESSION);
        } else {
        //    print_r($response);
            $errors[] = "Login Error";
        }
    }
}

$title = 'Sign In | Unlimited Charters Vendor System';
require './header.php';
require './login_form_org.php';
require './footer.php';
?>