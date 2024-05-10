<?php

$page = 'vehicle';
require_once './config.php';
require_once './session.php';
require_once './vehicle_options.php';
$vehicle_object = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once './functions.php';
    //'luggage_limit',
    $required_fields = array('vehicle_type', 'vehicle_year', 'vehicle_color', 'vehicle_capacity',  'vehicle_quantity');
    $validate_required = validate_required_fields($_POST, $required_fields);
    if ($validate_required !== true)
        $errors[] = $validate_required;
    if ($errors != null && sizeof($errors) > 0) {
        $ispost = true;
    } else {
        $data = array();
        $data = $_POST;
        if (isset($_REQUEST['vehicle']) && !empty($_REQUEST['vehicle']))
            $data["id"] = trim($_REQUEST['vehicle']);
        if (isset($_SESSION['VNDR']['id']) && !empty($_SESSION['VNDR']['id']))
            $data["vendor_id"] = $_SESSION['VNDR']['id'];
        if (isset($_POST['custom_daily_rates']))
            $data["custom_daily_rates"] = "";
        $data["name"] = trim($_POST['vehicle_type']);
        $interior_style = array();
        foreach ($_POST['interior_style'] as $interiorValue)
            $interior_style[] = '^' . trim($interiorValue) . '^';
        $data["interior_style"] = implode(",", $interior_style);
        $onboard_luxury = array();
        foreach ($_POST['onboard_luxury'] as $onboardValue)
            $onboard_luxury[] = '^' . trim($onboardValue) . '^';
        $data["onboard_luxury"] = implode(",", $onboard_luxury);
        $media_capability = array();
        foreach ($_POST['media_capability'] as $mediaValue)
            $media_capability[] = '^' . trim($mediaValue) . '^';
        $data["media_capability"] = implode(",", $media_capability);
        $complimentary = array();
        foreach ($_POST['complimentary'] as $complimentaryValue)
            $complimentary[] = '^' . trim($complimentaryValue) . '^';
        $data["complimentary"] = implode(",", $complimentary);
        $data["method"] = "UpdateVehicle";
        ////////////
        $vehicle_images = array();
        $errors_images = array();
        $uploadedFiles = array();
        $extension = array("jpeg", "jpg", "png", "gif");
        $bytes = 1024;
        $KB = 2048;
        $totalBytes = $bytes * $KB;
        $UploadFolder = "vehicles";

        $counter = 0;
        foreach ($_POST['uploaded_images'] as $img) {
            if (!empty($img)) {
                if (strpos($img, 'removed_') !== false) {
                    $img_name = str_replace('removed_', '', $img);
                    unlink($UploadFolder . "/" . $img_name);
                } else {
                    if (file_exists($UploadFolder . "/" . $img) == true) {
                        $vehicle_images[] = $img;
                        $counter++;
                    }
                }
            }
        }

        foreach ($_FILES["vehicle_images"]["tmp_name"] as $key => $tmp_name) {
            if ($counter >= 6)
                break;
            $temp = $_FILES["vehicle_images"]["tmp_name"][$key];
            $name_display = $_FILES["vehicle_images"]["name"][$key];
            if (empty($temp))
                break;
            $counter++;
            $UploadOk = true;
            if ($_FILES["vehicle_images"]["size"][$key] > $totalBytes) {
                $UploadOk = false;
                array_push($errors_images, $name_display . " file size is larger than the 2 MB.");
            }
            $ext = pathinfo($name_display, PATHINFO_EXTENSION);
            $name = md5($_FILES["vehicle_images"]["name"][$key] . '_' . date('Y-m-d h:i:s')) . '.' . $ext;
            /*if (in_array($ext, $extension) == false) {
                $UploadOk = false;
                array_push($errors_images, $name_display . " is invalid file type.");
            }*/
            if (file_exists($UploadFolder . "/" . $name) == true) {
                $UploadOk = false;
                array_push($errors_images, $name_display . " file is already exist.");
            }
            //  echo 'name'.$name;
            if ($UploadOk == true) {
                move_uploaded_file($temp, $UploadFolder . "/" . $name);
                $uploadedFiles[$name] = $name_display;
                $vehicle_images[] = $name;
            }
        }

        $data["vehicle_images"] = implode(",", $vehicle_images);

        //////////////
        $curl = curl_init($crm_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        $result_data = json_decode($response, true);
        if (isset($result_data['CURL_RESULT']) && $result_data['CURL_RESULT'] == "success") {
            $_SESSION['VNDR']['VEHICLES'][$result_data['id']]['vehicle'] = $result_data['id'];
            $multiselect_options = array('interior_style', 'onboard_luxury', 'media_capability', 'complimentary');
            // print_r($_POST);
            foreach ($result_data as $rindx => $rdata) {
                $_SESSION['VNDR']['VEHICLES'][$result_data['id']][$rindx] = $rdata;
            }
            // print_r($result_data['id']);
            $vhdata['id'] = $result_data['id'];
            $vhdata['method'] = 'fetchVehicleSpecialRatesIds';
            $curl3 = curl_init($crm_url);
            curl_setopt($curl3, CURLOPT_POST, true);
            curl_setopt($curl3, CURLOPT_HEADER, false);
            curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl3, CURLOPT_POSTFIELDS, $vhdata);
            $response3 = curl_exec($curl3);


            $result_data3 = json_decode($response3, true);
            // print_r($_POST);
            // echo "<br>";
            // echo "<br>";
            // print_r($result_data3);
            $deletedItems = array();
            $leftItems = array();


            if ( $result_data3['data'] != "" && !empty($_POST['special_rate'])) {
                // echo "lpo1";
                $resultIds = array_column($result_data3['data'], 'id');

                // Check for left items
                foreach ($_POST['special_rate'] as $spVal) {
                    if (in_array($spVal, $resultIds)) {
                        $leftItems[] = $spVal;
                    }
                }

                // Check for deleted items
                foreach ($resultIds as $spRes) {
                    if (!in_array($spRes, $_POST['special_rate'])) {
                        $deletedItems[] = $spRes;
                    }
                }
            } else {
                // echo "lpo2";
                if ( $result_data3['data'] != "") {
                // echo "lpo3";
                    $resultIds = array_column($result_data3['data'], 'id');
                    // All items are deleted if there are no result data
                    $deletedItems = $resultIds;
                }
            }



            // ok

            // Extracting IDs from $result_data3['data']
            //             if(count($result_data3['data']) > 0){
            //             $resultIds = array_column($result_data3['data'], 'id');
            // // if($_POST['special_rate']){
            //             // Checking which IDs are present in $_POST['special_rate']
            //             foreach ($_POST['special_rate'] as $spVal) {
            //                 if (in_array($spVal, $resultIds)) {
            //                     $leftItems[] = $spVal;
            //                 } 
            //             }
            //             foreach ($resultIds as $spRes) {
            //                 if($_POST['special_rate']){
            //                 foreach($_POST['special_rate'] as $spVal){
            //                 if ($spVal !== $spRes) {
            //                     $deletedItems[] = $spRes;
            //                 } 
            //             }
            //             }else{
            //                 $deletedItems[] = $spRes;
            //             }
            //             }
            //         // }
            //     }
            // ok


            // $result_data3 = json_decode($response3, true);
            // print_r($result_data3['data']);
            // $deletedItems = array();
            // $leftItems = array();

            // foreach ($result_data3['data'] as $result) {
            //     foreach ($_POST['special_rate'] as $spIndx => $spVal) {
            //         if ($result['id'] == $spVal) {
            //             $leftItems[] = $spVal;
            //             break; // Stop the loop once a match is found
            //         }
            //     }
            // }

            // // Iterate through the original data again to find deleted items
            // foreach ($_POST['special_rate'] as $spIndx => $spVal) {
            //     if (!in_array($spVal, $leftItems)) {
            //         $deletedItems[] = $spVal;
            //     }
            // }

            // print_r($response3);
            // $result_data3 = json_decode($response3, true);
            // print_r($result_data3['data']);
            // $deletedItems = array();
            // $leftItems = array();
            // foreach ($result_data3['data'] as $result) {
            //     // print_r($_POST['special_rate']);
            //     // echo '<br>';
            //     // print_r($result['vnd_special_rates_vnd_vechilesvnd_special_rates_idb']);
            //     // // print_r($result);
            //     // echo '<br>';

            //     foreach ($_POST['special_rate'] as $spIndx => $spVal) {

            //         if ($result['id'] == $spVal) {
            //             $leftItems[] = $spVal;
            //         }
            //     }

            // }
            // foreach ($result_data3['data'] as $result) {
            //     // print_r($_POST['special_rate']);
            //     // echo '<br>';
            //     // print_r($result['vnd_special_rates_vnd_vechilesvnd_special_rates_idb']);
            //     // // print_r($result);
            //     // echo '<br>';

            //     foreach ($leftItems as $spIndx => $spVal) {

            //         if ($result['id'] !== $spVal) {
            //             $deletedItems[] = $spVal;
            //         }

            //     }

            // }


            // echo "<br>";
            // echo "<br>";
            // print_r($_POST);
            // print_r($leftItems);
            // echo "<br>";
            // echo "<br>";
            // print_r($deletedItems);
            if($deletedItems && count($deletedItems) > 0){
                foreach ($deletedItems as $delItem => $delVal) {
                    $vhdata['id'] = $delVal;
                    $vhdata['method'] = 'deleteSpecialRatesNew';
                    $curl3 = curl_init($crm_url);
                    curl_setopt($curl3, CURLOPT_POST, true);
                    curl_setopt($curl3, CURLOPT_HEADER, false);
                    curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl3, CURLOPT_POSTFIELDS, $vhdata);
                    $response3 = curl_exec($curl3);

                }
            }
            $rates_object = array();
            $rates_mapping = array('name_special_rate', 'special_rate_start_from', 'special_rate_end_on', 'special_base_hourly_rate', 'special_base_min_hours', 'special_base_additional_hourly', 'custom_special_rates', 'special_hourly_rate_monday', 'special_hourly_rate_tuesday', 'special_hourly_rate_wednesday', 'special_hourly_rate_thursday', 'special_hourly_rate_friday', 'special_hourly_rate_saturday', 'special_hourly_rate_sunday', 'special_min_hours_monday', 'special_min_hours_tuesday', 'special_min_hours_wednesday', 'special_min_hours_thursday', 'special_min_hours_friday', 'special_min_hours_saturday', 'special_min_hours_sunday', 'special_additional_hourly_mon', 'special_additional_hourly_tue', 'special_additional_hourly_wed', 'special_additional_hourly_thu', 'special_additional_hourly_fri', 'special_additional_hourly_sat', 'special_additional_hourly_sun');
            foreach ($_POST['name_special_rate'] as $spIndx => $spVal) {
                $rate_data = array();
                if (isset($_POST['special_rate'][$spIndx]) && !empty($_POST['special_rate'][$spIndx]))
                    $rate_data['id'] = trim($_POST['special_rate'][$spIndx]);
                if (isset($_POST['special_rate_deleted'][$spIndx]) && $_POST['special_rate_deleted'][$spIndx] == 'YES') {
                    $rate_data['delete_special_rate'] = 'YES';
                } else {
                    $rate_data['delete_special_rate'] = 'NO';
                }
                $rate_data['name'] = trim($_POST['name_special_rate'][$spIndx]);
                $rate_data['special_rate_start_from'] = trim($_POST['special_rate_start_from'][$spIndx]);
                $rate_data['special_rate_end_on'] = trim($_POST['special_rate_end_on'][$spIndx]);
                $rate_data['base_hourly_rate'] = trim($_POST['special_base_hourly_rate'][$spIndx]);
                $rate_data['base_min_hours'] = trim($_POST['special_base_min_hours'][$spIndx]);
                $rate_data['base_additional_hourly'] = trim($_POST['special_base_additional_hourly'][$spIndx]);
                if (isset($_POST['custom_special_rates'][$spIndx]))
                    $rate_data['custom_rates'] = '1';
                else
                    $rate_data['custom_rates'] = '0';
                $rate_data['hourly_rate_monday'] = trim($_POST['special_hourly_rate_monday'][$spIndx]);
                $rate_data['hourly_rate_tuesday'] = trim($_POST['special_hourly_rate_tuesday'][$spIndx]);
                $rate_data['hourly_rate_wednesday'] = trim($_POST['special_hourly_rate_wednesday'][$spIndx]);
                $rate_data['hourly_rate_thursday'] = trim($_POST['special_hourly_rate_thursday'][$spIndx]);
                $rate_data['hourly_rate_friday'] = trim($_POST['special_hourly_rate_friday'][$spIndx]);
                $rate_data['hourly_rate_saturday'] = trim($_POST['special_hourly_rate_saturday'][$spIndx]);
                $rate_data['hourly_rate_sunday'] = trim($_POST['special_hourly_rate_sunday'][$spIndx]);
                $rate_data['min_hours_monday'] = trim($_POST['special_min_hours_monday'][$spIndx]);
                $rate_data['min_hours_tuesday'] = trim($_POST['special_min_hours_tuesday'][$spIndx]);
                $rate_data['min_hours_wednesday'] = trim($_POST['special_min_hours_wednesday'][$spIndx]);
                $rate_data['min_hours_thursday'] = trim($_POST['special_min_hours_thursday'][$spIndx]);
                $rate_data['min_hours_friday'] = trim($_POST['special_min_hours_friday'][$spIndx]);
                $rate_data['min_hours_saturday'] = trim($_POST['special_min_hours_saturday'][$spIndx]);
                $rate_data['min_hours_sunday'] = trim($_POST['special_min_hours_sunday'][$spIndx]);
                $rate_data['additional_hourly_monday'] = trim($_POST['special_additional_hourly_mon'][$spIndx]);
                $rate_data['additional_hourly_tuesday'] = trim($_POST['special_additional_hourly_tue'][$spIndx]);
                $rate_data['additional_hourly_wednesday'] = trim($_POST['special_additional_hourly_wed'][$spIndx]);
                $rate_data['additional_hourly_thursday'] = trim($_POST['special_additional_hourly_thu'][$spIndx]);
                $rate_data['additional_hourly_friday'] = trim($_POST['special_additional_hourly_fri'][$spIndx]);
                $rate_data['additional_hourly_saturday'] = trim($_POST['special_additional_hourly_sat'][$spIndx]);
                $rate_data['additional_hourly_sunday'] = trim($_POST['special_additional_hourly_sun'][$spIndx]);
                $rate_data['vnd_special_rates_vnd_vechilesvnd_vechiles_ida'] = $result_data['id'];
                $rate_data['method'] = 'updateSpecialRatesNew';

                // echo'<br>';

                $curl2 = curl_init($crm_url);
                curl_setopt($curl2, CURLOPT_POST, true);
                curl_setopt($curl2, CURLOPT_HEADER, false);
                curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl2, CURLOPT_POSTFIELDS, $rate_data);
                $response = curl_exec($curl2);
                // print_r($rate_data);
                // print_r($response);
                // echo '<br>';
                // echo '<br>';
                if ($response == 'error') {
                    $errors[] = 'Error occurred while adding special rate';
                } else if ($response == 'skip') {
                } else {
                    // $rates_object[$response]['special_rate'] = $response;
                    // foreach ($rates_mapping as $rIndx)
                    //     $rates_object[$response][$rIndx] = trim($_POST[$rIndx][$spIndx]);
                    // $rates_object[$response]['special_rate'] = trim($_POST['special_rate'][$spIndx]);
                }
            }
            // $_SESSION['VNDR']['VEHICLES'][$result_data['id']]['VEHICLESRATES'] = $rates_object;
            header("Location: http://localhost/vendor/vehicle.php" );
        } else {
            $errors[] = $response;
        }
    }
}
if (isset($_REQUEST['vehicle']) && !empty($_REQUEST['vehicle'])) {
    if (isset($_SESSION['VNDR']['VEHICLES'][$_REQUEST['vehicle']])) {
        $vehicle_object = $_SESSION['VNDR']['VEHICLES'][$_REQUEST['vehicle']];
        // $vehicle_object['SpeicalRates'] = $_SESSION['VNDR']['VEHICLES'][$_REQUEST['vehicle']]['VEHICLESRATES'];


        $data['id'] = $vehicle_object['vehicle'];
        $data["method"] = "fetchSpecialRatesNew";
        $curl = curl_init($crm_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        // print_r($response);
        $specialRates = json_decode($response, true);
        $vehicle_object['SpeicalRates'] = $specialRates['data'];
        $vehicle_object['xeno'] = "ahmad";
    } else {
        $data = array();
        $data = $_POST;
        if (isset($_REQUEST['vehicle']) && !empty($_REQUEST['vehicle']))
            $data["id"] = trim($_REQUEST['vehicle']);
        if (isset($_SESSION['VNDR']['id']) && !empty($_SESSION['VNDR']['id']))
            $data["vendor_id"] = $_SESSION['VNDR']['id'];
        $data["method"] = "FetchVehicle";
        $curl = curl_init($crm_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        $result_data = json_decode($response, true);
        if (isset($result_data['CURL_RESULT']) && $result_data['CURL_RESULT'] == "success") {
            $_SESSION['VNDR']['VEHICLES'][$result_data['id']]['vehicle'] = $result_data['id'];
            foreach ($result_data as $rindx => $rdata) {
                $_SESSION['VNDR']['VEHICLES'][$result_data['id']][$rindx] = $rdata;
                $vehicle_object = $_SESSION['VNDR']['VEHICLES'][$_REQUEST['vehicle']];
                $vehicle_object['SpeicalRates'] = $_SESSION['VNDR']['VEHICLES'][$_REQUEST['vehicle']]['VEHICLESRATES'];
            }
        } else {
            $errors[] = $response;
        }
    }
} else {
    $vehicle_object = $default_values;
}
require './header.php';
require_once './header_nav.php';
require_once './vehicle_form_cp.php';
// require_once './testWizard.php';
require './footer.php';
