<?php

require_once "./config.php";

// print_r($_POST);
$distance_org = $_POST['distance'];
preg_match('/\d+(\.\d+)?/', $distance_org, $matches);
$distance = floatval($matches[0]);
$lead_id = $_POST['lead_id'];
$distanceTime = $_POST['distanceTime'];
$passengerCount = $_POST['passengerCount'];
// echo '</br>';

// echo $distanceTime;
// echo $distance;
// echo $passengerCount;
// echo '</br>';
// echo '</br>';
// $name = "Ahmad";
$data["vehicle_id"] = $_POST['SelectVehicle'];
$data["method"] = "fetchVehicle";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$vehicle_data = json_decode($response, true);
// print_r($vehicle_data);
// echo '</br>';
// echo '</br>';
// $name = "Ahmad";
// $data["test"] = $name;
$data["method"] = "leadCharges";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$leadCharges= json_decode($response, true);
// print_r($leadCharges);


$fuel = $leadCharges['FuelSarcharge'] / 100;
$gratuity = $leadCharges['Gratuity'] / 100 ;
$profit = $leadCharges['Vendor_Percentage'] / 100;
$QuotedPrice = $distanceTime * $vehicle_data['base_hourly_rate'];
$garagecharges = 0;
$trip_Mileage = $distance* 2 * $leadCharges['ChargesPerMile'];
$trip_Fuel = $QuotedPrice * $fuel;
$trip_Gratuity = $QuotedPrice * $gratuity;
$TotalTripCost = $QuotedPrice + $trip_Mileage + $trip_Fuel + $trip_Gratuity + $garagecharges;
$CostPerPerson = $TotalTripCost / $passengerCount;
$total_profit_c = $TotalTripCost * $profit;
// echo '</br>';
// echo '</br>';
// echo $trip_Mileage;
// echo '</br>';
// echo $trip_Fuel;
// echo '</br>';
// echo $trip_Gratuity;
// echo '</br>';
// echo $TotalTripCost;
// echo '</br>';
// echo $CostPerPerson;
// echo '</br>';
// echo $total_profit_c;
// echo '</br>';
// updateSingleLead($lead_id, $fuel, $gratuity, $quoted_price, $mileage, $total_cost, $costperperson);
$data["lead_id"] = $lead_id;
$data["fuel"] = $trip_Fuel;
$data["gratuity"] = $trip_Gratuity;
$data["quoted_price"] = $QuotedPrice;
$data["mileage"] = $trip_Mileage;
$data["total_cost"] = $TotalTripCost;
$data["costperperson"] = $CostPerPerson;
$data['rate_c'] = $vehicle_data['base_hourly_rate'];
$data['vechiles_name_c'] = $vehicle_data['name'];
$data['vehicle_type_c'] = $vehicle_data['name'];
$data['total_profit_c'] = $total_profit_c;
$data["method"] = "updateSingleLead";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$leadCharges = json_decode($response, true);
// print_r($leadCharges);


header("Location: editLead_vendor.php?opertunityid_c=" . $_POST['opportunity_id']);
// 
?>