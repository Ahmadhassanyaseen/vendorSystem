<?php 
require_once "./config.php";
$lead_id = $_GET['lead_id'];
$opertunity_id = $_GET['opertunity_id'];
// print_r($_GET);
// $status = $_GET['status'];
// $agreement_status_c = "default";
// if($status == 1){
//     $agreement_status_c = "Accepted";
// }elseif($status == 0){
//     $agreement_status_c = "Rejected";
// }
$data['lead_id'] = $lead_id;
$data['status'] = 'Rejected';
$data["method"] = "updateSingleLeadStatus";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);

$leadStatus = json_decode($response, true);

// print_r($leadStatus);



$data["lead_id"] = $lead_id;
$data["method"] = "fetchSingleLeadEmail";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$result_data = json_decode($response, true);
$lead_email = $result_data;

// $data['quote_id'] = $quote_data['quote_id'];
$data['lead_opertunityid_c'] = $lead_opertunityid_c;
$data["lead_id"] = $lead_id;
$data['email_temp'] = 'c1ec9212-009e-8c90-061d-65fff6e561ea';
$data['lead_email'] = 'quotes@unlimitecharters.com';
$data['link'] = 'https://unlimitedcharters.com';
$data["method"] = "sendQuoteMail";

$curl = curl_init($crm_url);

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($curl);
header("Location: dashboard.php" );

?>