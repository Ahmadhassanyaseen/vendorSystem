<?php

$page = 'profile';
require_once './config.php';
require_once './session.php';
$errors = array();
$ispost = false;
$email = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once './functions.php';
    $required_fields = array('vid', 'uvid', 'name', 'email1', 'phone_office', 'billing_address_street', 'billing_address_city', 'billing_address_state', 'billing_address_postalcode', 'vendors_type', 'service_radius');//print_r($_POST);
    $validate_required = validate_required_fields($_POST, $required_fields);
    $validate_email = validate_email_address($_POST['email1']);
    if ($validate_required !== true)
        $errors[] = $validate_required;
    if ($validate_email !== true)
        $errors[] = 'Invalid or empty email address.';
    if ($errors != null && sizeof($errors) > 0) {
        $ispost = true;
    } else {
        $data = array();
        if (isset($_SESSION['VNDR']['status']) && $_SESSION['VNDR']['status'] == 'Complete_Profile') {
            $data["status"] = "Active";
        }
        $data["id"] = trim($_POST['vid']);
        $data["unique_vendor_id"] = trim($_POST['uvid']);
        $data["name"] = trim($_POST['name']);
        $data["email1"] = trim($_POST['email1']);
        $data["phone_office"] = trim($_POST['phone_office']);
        $data["billing_address_street"] = trim($_POST['billing_address_street']);
        $data["billing_address_city"] = trim($_POST['billing_address_city']);
        $data["billing_address_state"] = trim($_POST['billing_address_state']);
        $data["billing_address_postalcode"] = trim($_POST['billing_address_postalcode']);
        $data["vnd_vendors_type"] = trim($_POST['vendors_type']);
        $data["service_radius"] = trim($_POST['service_radius']);
        $data["allowcharges_c"] = trim($_POST["allowcharges"]);
        $data["hourstocharge_c"] = trim($_POST["hourstocharge"]);
        $data["address_lat_c"] = trim($_POST['address_lat']);
        $data["address_lng_c"] = trim($_POST['address_lng']);
        if (isset($_POST['website']))
            $data["website"] = trim($_POST['website']);
        if (isset($_POST['dot_number']))
            $data["dot_number"] = trim($_POST['dot_number']);
        if (isset($_POST['ownership']))
            $data["ownership"] = trim($_POST['ownership']);
        if (isset($_POST['phone_alternate']))
            $data["phone_alternate"] = trim($_POST['phone_alternate']);
        $data["method"] = "UpdateVendor";
        $curl = curl_init($crm_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        // print_r($response);
        if ($response == "success") {
            foreach ($data as $field => $value)
                $_SESSION['VNDR'][$field] = $value;
            header("Location:" . $redirects['profile_complete']);
            exit();
        } else {
            $errors[] = $response;
        }
    }
}

$title = 'Profile Update | United Coachways Vendor System';
require './header.php';
require_once './header_nav.php';
require './profile_form.php';
require './footer.php';
?>
