<?php
// print_r($_POST);
require_once "./config.php";

// print_r($_POST);
$distance_org = $_POST['distance'];
preg_match('/\d+(\.\d+)?/', $distance_org, $matches);
$distance = floatval($matches[0]);
$lead_id = $_POST['lead_id'];
$sent_lead_count = $_POST['sent_lead_count'];
$distanceTime = $_POST['distanceTime'];
$passengerCount = $_POST['passengerCount'];
$lead_name = $_POST['lead_name'];
$lead_mobile = $_POST['lead_mobile'];
$totalPrice = $_POST['updatedPrice'];
// $quotedPrice = $_POST['updatedPrice'];
$data["vehicle_id"] = $_POST['vehicle_id'];
$data["method"] = "fetchVehicle";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$vehicle_data = json_decode($response, true);

$data["method"] = "leadCharges";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$leadCharges = json_decode($response, true);
// print_r($leadCharges);


$fuel = $vehicle_data['fuel_surcharge_percentage'] / 100;
$gratuity = $vehicle_data['driver_gratuity_percentage'] / 100;
$profit = $leadCharges['Vendor_Percentage'] / 100;
// $QuotedPrice = $distanceTime * $vehicle_data['base_hourly_rate'];
$TotalTripCost = $totalPrice;
$trip_Mileage = $distance * 2 * $leadCharges['ChargesPerMile'];
$totalPrice = $totalPrice - $trip_Mileage;
$quotedPrice = $totalPrice /(1 + $fuel + $gratuity);
$garagecharges = 0;
$QuotedPrice = $quotedPrice;
$trip_Fuel = $QuotedPrice * $fuel;
$trip_Gratuity = $QuotedPrice * $gratuity;
// $TotalTripCost = $QuotedPrice + $trip_Mileage + $trip_Fuel + $trip_Gratuity + $garagecharges;
$CostPerPerson = $TotalTripCost / $passengerCount;
$total_profit_c = $TotalTripCost * $profit;

$total_price_with_profit = $TotalTripCost + $total_profit_c;

$quotedPriceWithProfit = ($total_price_with_profit - $trip_Mileage) / ($fuel + $gratuity + 1);



// echo $total_price_with_profit;
// echo "<br>";
// echo $_POST['vendor_id'];
// echo "<br>";
// echo $QuotedPrice;
// echo "<br>";
// echo $lead_id;
// echo "<br>";
// echo $_POST['vehicle_id'];
// echo "<br>";
// echo $vehicle_data['name'];


$data["vendor_id"] = $_POST['vendor_id'];
$data["lead_id"] = $lead_id;
// $data['quoted_c'] = $QuotedPrice;
$data['quoted_c'] = $QuotedPrice;
$data['quoted_price_with_profit'] = $total_price_with_profit;
$data['vehicle_id'] = $_POST['vehicle_id'];
$data['vehicle_c'] = $vehicle_data['name'];
$data['quote_number'] = $sent_lead_count + 1;
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

    $quote_id = $_POST['sent_quote_id'] . ',' . $quote_data['quote_id'];
} else {
    $quote_id = $quote_data['quote_id'];
}




$data["lead_id"] = $lead_id;
$data['count'] = $sent_lead_count + 1;
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

$lead_opertunityid_c = $_POST['opertunity_id'];
$lead_eventdate = $_POST['lead_eventdate'];
$lead_eventtype = $_POST['lead_eventtype'];
$lead_pickuptime = $_POST['lead_pickuptime'];
$lead_pickuplocation = $_POST['lead_pickuplocation'];
$lead_location = $_POST['lead_location'];


$data["lead_id"] = $lead_id;
$data['lead_email'] = $lead_email[0]['email_address']['email_address'];
$data['lead_opertunityid_c'] = $lead_opertunityid_c;
$data['quote_id'] = $quote_data['quote_id'];
$data['email_temp'] = '45518869-7a70-050d-31e5-65ff1df7d1cb';
$data['link'] = 'https://unlimitedcharters.com/client24/index.php?lead_id=' . $lead_id . '&quote_id=' . $quote_data['quote_id'];
$data["method"] = "sendQuoteMail";

$curl = curl_init($crm_url);

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($curl);


// print_r($response);
header("Location: dashboard.php");
// 
