<?php
require_once 'config.php';

$lead_id = $_GET['lead_id'];
$lead_opertunityid_c = $_GET['lead_opertunityid_c'];
$vendor_id = $_GET['vendor_id'];
$vehicle_id = $_GET['vehicle_id'];
$quoted_c   = $_GET['quoted_c'];
$vehicle_name = $_GET['vehicle_name'];
$distance = $_GET['distance'];
preg_match('/\d+(\.\d+)?/', $distance, $matches);
$distance = floatval($matches[0]);

// print_r($_GET);
$data["method"] = "leadCharges";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$leadCharges = json_decode($response, true);
$profit = $leadCharges['Vendor_Percentage'] / 100;

$fuel = $leadCharges['FuelSarcharge'] / 100;
$gratuity = $leadCharges['Gratuity'] / 100;
$profit = $leadCharges['Vendor_Percentage'] / 100;
$QuotedPrice = $quoted_c;
$garagecharges = 0;
$trip_Mileage = $distance * 2 * $leadCharges['ChargesPerMile'];
$trip_Fuel = $QuotedPrice * $fuel;
$trip_Gratuity = $QuotedPrice * $gratuity;
$TotalTripCost = $QuotedPrice + $trip_Mileage + $trip_Fuel + $trip_Gratuity + $garagecharges;
// $CostPerPerson = $TotalTripCost / $passengerCount;
$total_profit_c = $TotalTripCost * $profit;

$total_price_with_profit = $TotalTripCost + $total_profit_c;

$quotedPriceWithProfit = ($total_price_with_profit - $trip_Mileage) / ($fuel + $gratuity + 1);



$data["vendor_id"] = $vendor_id;
$data["lead_id"] = $lead_id;
// $data['quoted_c'] = $QuotedPrice;
$data['quoted_c'] = $quoted_c;
$data['quoted_price_with_profit'] = $quotedPriceWithProfit;
$data['vehicle_id'] = $vehicle_id;
$data['vehicle_c'] = $vehicle_name;
$data['quote_number'] = 0;
$data['vendor_notes_c'] = "Best Price Available";
// echo "Xeno";
$data["method"] = "addNewQuote";

$curl = curl_init($crm_url);

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($curl);

if ($response !== false) {
    // Check if response contains 'success'
    if (strpos($response, 'success') !== false) {
        // echo 'Operation successful ' . $response;
        $quote_data = json_decode($response, true);
        // print_r($quote_data);

    } else {
        // Handle other responses
        // echo 'Operation failed: ' . $response;
    }
} else {
    // Handle CURL errors
    // echo 'CURL error: ' . curl_error($curl);
}

// $quote_data = json_decode($response, true);
if ($_POST['sent_quote_id']) {

    $quote_id = $_POST['sent_quote_id'] . ', ' . $quote_data['quote_id'];
} else {
    $quote_id = $quote_data['quote_id'];
}

$data["lead_id"] = $lead_id;
$data['count'] = 0;
$data['quote_id'] = $quote_id;
$data["method"] = "leadCountUpdate";

$curl = curl_init($crm_url);

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($curl);


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



$data["lead_id"] = $lead_id;
$data['lead_email'] = $lead_email[0]['email_address']['email_address'];
$data['lead_opertunityid_c'] = $lead_opertunityid_c;

$data['email_temp'] = '4742bee5-b037-d803-0b2c-6603ebdfdb93';
$data['link'] = 'https://unlimitedcharters.com/client24/index.php?lead_id=' . $lead_id . '&quote_id=' . $quote_data['quote_id'];
$data["method"] = "sendQuoteMail";

$curl = curl_init($crm_url);

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($curl);
// echo $response;

header('location: ./dashboard.php');
