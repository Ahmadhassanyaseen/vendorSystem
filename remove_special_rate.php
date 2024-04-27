<?php

require_once './config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['special_rate']) && !empty($_POST['special_rate']) && isset($_POST['vehicle']) && !empty($_POST['vehicle'])) {
    $data = array();
    $data["special_rate"] = trim($_POST['special_rate']);
    $data["vehicle"] = trim($_POST['vehicle']);
    $data["method"] = "RemoveSepcialRate";
    $curl = curl_init($crm_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($curl);
    if ($response == 'success') {
        if (isset($_POST['vehicle']) && !empty($_POST['vehicle'])) {
            if (!isset($_SESSION)) {
                session_start();
            }
            if (isset($_SESSION['VNDR'][$_POST['vehicle']][$_POST['special_rate']]))
                unset($_SESSION['VNDR'][$_POST['vehicle']][$_POST['special_rate']]);
        }
    }
    echo $response;
} else {
    echo 'failed';
}