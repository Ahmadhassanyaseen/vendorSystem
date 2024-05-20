<?php
require_once "./config.php";
// print_r($_REQUEST);
$lead_id = $_REQUEST['lead_id'];
$totalPrice = $_REQUEST['updatedPrice'];
$vehicle_id = $_REQUEST['vehicle_id'];
$vehicle_name = $_REQUEST['vehicle_name'];
$vendor_id = $_REQUEST['vendor_id'];
$quote_id = $_REQUEST['quote_id'];
$opertunityid_c = $_REQUEST['opertunity_id'];
$sub_quote_id = $_REQUEST['sub_quote_id'];




$data["vehicle_id"] = $_REQUEST['vehicle_id'];
$data["method"] = "fetchVehicle";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$vehicle_data = json_decode($response, true);


$data["opertunityid_c"] = $opertunityid_c;
$data["method"] = "FetchSingleLead";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$result_data = json_decode($response, true);
$opportunities = $result_data;

$distance = $opportunities[0]['distance_c'];
preg_match('/\d+(\.\d+)?/', $distance, $matches);
$distance = floatval($matches[0]);
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

$fuel = $vehicle_data['fuel_surcharge_percentage'] / 100;
$gratuity = $vehicle_data['driver_gratuity_percentage'] / 100;
$profit = $leadCharges['Vendor_Percentage'] / 100;




$trip_Mileage = $distance * 2 * $leadCharges['ChargesPerMile'];

$QuotedPrice = ($totalPrice - $trip_Mileage ) / (1 + $fuel + $gratuity);
$garagecharges = 0;
$trip_Fuel = $QuotedPrice * $fuel;
$trip_Gratuity = $QuotedPrice * $gratuity;
$TotalTripCost = $totalPrice;
// $TotalTripCost = $QuotedPrice + $trip_Mileage + $trip_Fuel + $trip_Gratuity + $garagecharges;
// $CostPerPerson = $TotalTripCost / $passengerCount;
$total_profit_c = $TotalTripCost * $profit;

$total_price_with_profit = $TotalTripCost + $total_profit_c;

// $quotedPriceWithProfit = ($total_price_with_profit - $trip_Mileage) / ($fuel + $gratuity + 1);

// print_r($quotedPriceWithProfit);

$data["vendor_id"] = $vendor_id;
$data["lead_id"] = $lead_id;
// $data['quoted_c'] = $QuotedPrice;
$data['quoted_price_with_profit'] = $total_price_with_profit;
// $data['quoted_price_with_profit'] = $quotedPriceWithProfit;
$data['quoted_c'] = $QuotedPrice;
$data['parent_quote'] = $quote_id;
$data['vehicle_id'] = $vehicle_id;
$data['vehicle_c'] = $vehicle_name;
$data['quote_number'] =  1;
$data['vendor_notes_c'] = "Best Price Available";
// echo "Xeno";
$data["method"] = "addNewQuote";

$curl = curl_init($crm_url);

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($curl);

$quoteData= json_decode($response, true);

$sub_quote_ids = $sub_quote_id .','.$quoteData['quote_id'];


$data['parent_quote_id'] = $quote_id;
$data['sub_quote_id']  =$sub_quote_ids;
$data['method'] = 'updateSubQuotes';
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($curl);
$sub_quote_result = json_decode($response, true);
 
// print_r($sub_quote_result);

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


$data['lead_opertunityid_c'] = $opertunityid_c;
$data["lead_id"] = $lead_id;
$data['email_temp'] = '45518869-7a70-050d-31e5-65ff1df7d1cb';
$data['lead_email'] = $lead_email[0]['email_address']['email_address'];
$data['link'] = 'https://unlimitedcharters.com/client24/subQuotes.php?lead_id=' . $lead_id . '&quote_id=' .$quote_id;
$data["method"] = "sendQuoteMail";

$curl = curl_init($crm_url);

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($curl);
// print_r($quoteData['quote_id']);
// echo '<script>alert("Quote Updated Successfully");
// window.location.href = "https://unlimitedcharters.com/vendor24/lead_quotes.php?opertunity_id=' . $opertunityid_c . '";
// </script>';
// header("Location: https://unlimitedcharters.com/vendor24/lead_quotes.php?opertunity_id=" . $opertunityid_c);

header('Location: dashboard.php');
?>