<?php

require_once './config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = array();
    $data["user_email"] = trim($_POST['user_email']);
    $data["method"] = "DuplicateCheck";
    $curl = curl_init($crm_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    echo $response = curl_exec($curl);
}