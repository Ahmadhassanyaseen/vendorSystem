<?php

$page = 'vehicle';
require_once './config.php';
require_once './session.php';
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Retrieve vehicleId and image from the request
$vehicle_id = $_GET['vehicle_id'];
$image = $_GET['image'];

$data["vehicle_id"] = $vehicle_id;
$data["image"] = $image;
$data["method"] = "deleteVehicleImage";

// Initialize cURL
$curl = curl_init($crm_url);

// Set cURL options
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

// Execute cURL request
$response = curl_exec($curl);

// Check for cURL errors
if ($response === false) {
    echo 'cURL error: ' . curl_error($curl);
} else {
    // Attempt to decode the response as JSON
    $result_data = json_decode($response, true);

    // Check if JSON decoding was successful
    if ($result_data !== null) {
        // Output decoded response for debugging
        // print_r($result_data);
    } else {
        // Output response from server as error
        echo 'Server error: ' . $response;
    }
}

$data1["vehicle_id"] = $vehicle_id;
$data1["method"] = "fetchVehicleImages";
$curl = curl_init($crm_url);

// Set cURL options
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data1);
// Execute cURL request
$response1 = curl_exec($curl);
$result_data1 = json_decode($response1, true);
echo '</br>';
print_r($result_data1);
// Check for cURL errors
if ($response1 === false) {
    echo 'cURL error: ' . curl_error($curl);
} else {
    // Check if JSON decoding was successful
    if ($result_data1 !== null) {
        // Update session data with the new image data
        $vehicleData = $_SESSION['VNDR']['VEHICLES'];

        foreach ($vehicleData as &$veh) {
            if ($veh['id'] == $vehicle_id) {
                $newImages['vehicle_images'] = explode(',', $result_data1['vehicle_images']) ;
                $veh['images'] = $newImages['vehicle_images'];
                break;
            }
        }
        
        // Update session variable
        $_SESSION['VNDR']['VEHICLES'] = $vehicleData;
        header("Location:" . $redirects['vehicle_image_delete']);
        echo '</br>';
        // Output updated session data for debugging
        print_r($_SESSION['VNDR']['VEHICLES']);
    } else {
        // Output response from server as error
        echo 'Server error: ' . $response;
    }
}

// Close cURL
curl_close($curl);
?>
