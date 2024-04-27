<?php
$page = 'delete';
require_once './config.php';
require_once './session.php';
if (isset($_REQUEST['vehicle']) && !empty($_REQUEST['vehicle'])) {
    $data = array();
    if (isset($_REQUEST['vehicle']) && !empty($_REQUEST['vehicle']))
        $data["id"] = trim($_REQUEST['vehicle']);
    if (isset($_SESSION['VNDR']['id']) && !empty($_SESSION['VNDR']['id']))
        $data["vendor_id"] = $_SESSION['VNDR']['id'];
    $data["method"] = "DeleteVehicle";
    $curl = curl_init($crm_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($curl);
    $result_data = json_decode($response, true);
    if (isset($result_data['CURL_RESULT']) && $result_data['CURL_RESULT'] == "success") {
        unset($_SESSION['VNDR']['VEHICLES'][$data["id"]]);
       // header("Location:dashboard.php");
        return $result_data['CURL_RESULT'];
    }else{
        echo 'Failed to delete vehicle. Try again later or contact Administrator.';
    }
}