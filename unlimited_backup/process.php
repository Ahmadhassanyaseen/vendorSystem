<?php

require_once get_theme_file_path() . '/config.php';
require_once get_theme_file_path() . '/add_log.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_REQUEST["todo"]) && $_REQUEST["todo"] == "save_lead") {
    print_error_log("saving lead....");
    try {
        if (isset($_SESSION["token"]) && isset($_POST["token"]) && $_POST["token"] == $_SESSION["token"]) {
            unset($_SESSION["token"]);
            $postArgs = array(
                'id' => $_REQUEST["lead_id"],
                'first_name' => $_REQUEST["first_name"],
                'last_name' => $_REQUEST["last_name"],
                'phone_mobile' => $_REQUEST["phone_mobile"],
                'email1' => $_REQUEST["email1"],
                'servicelength_c' => $_REQUEST["num_hours"],
                'description' => $_REQUEST["selected_vehicle_name"],
                'vehicle_type_c' => $_REQUEST["selected_vehicle_name"],
                'pickuplocation_c' => $_REQUEST["pickup"],
                'location_c' => $_REQUEST["destination"],
                'eventtype_c' => $_REQUEST["servicetype"],
                'eventdate_c' => $_REQUEST["event_date"],
                'pickuptime_c' => $_REQUEST["event_time"],
                'numberofpassengers_c' => $_REQUEST["passengers"],
                'distance_c' => $_REQUEST["distance"] . " miles",
                'duration_c' => $_REQUEST["duration"],
                'rate_c' => $_REQUEST["hourly_rate"],
                'clientnotes_c' => $_REQUEST["client_notes"],
                'todo' => $_REQUEST["todo"],
                'followup_steps_c' => ''
            );

            $curl = curl_init($crm_url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postArgs);
            $response = curl_exec($curl);
            $result = (array) json_decode($response);
            if (isset($result["status"]) && $result["status"] == "success") {
                print_error_log("Status success...");
                print_error_log($_REQUEST);
                print_error_log("Above Lead added Successfully...");
                print_error_log("end_log");
                header("location:https://unlimitedcharters.net/getquotes?response=success&lead_id=" . $result["id"]);
                exit();
            } else {
                print_error_log("Status not success...");
                print_error_log($_REQUEST);
                print_error_log("end_log");
                header("location:https://unlimitedcharters.net/getquotes?response=unknown&" . http_build_query($_REQUEST));
                exit();
            }
        } else {
            print_error_log("Invalid Token Passed...");
            print_error_log($_REQUEST);
            print_error_log("end_log");
            header("location:https://unlimitedcharters.net/getquotes?response=invalidtoken&" . http_build_query($_REQUEST));
            exit();
        }
    } catch (Exception $e) {
        print_error_log("Exception occurred: " . $e->getMessage());
    }
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["todo"]) && $_POST["todo"] == "get_map_key") {
    echo $map_keys[array_rand($map_keys)];
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["todo"]) && $_POST["todo"] == "validate_leadform") {
    print_error_log("Validation started");
    $results = array("status" => "", "message" => "");
    try {
        if (isset($_SESSION["token"]))
            unset($_SESSION["token"]);
        if (isset($_REQUEST['g-recaptcha-response']) && !empty($_REQUEST['g-recaptcha-response']) && $_REQUEST['g-recaptcha-response'] != '') {
            $ip = "";
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            $secret = $recaptcha_serverkey;
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_REQUEST['g-recaptcha-response'] . '&remoteip=' . $ip);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {
                print_error_log("Security captcha success...");
                $results["status"] = "success";
            } else {
                print_error_log("Security captcha validation failed but Adding Lead in CRM: will fix this issue later: reason: " . json_encode($responseData));
                $results["status"] = "success";
                //                print_error_log("Security captcha validation failed...");
                //                print_error_log($_REQUEST);
                //                print_error_log("end_log");
                //                $results["status"] = "failed";
                //                $results["message"] = "Click on security check to confirm you are not robot!";
            }
        } else {
            print_error_log("Security captcha not clicked...");
            print_error_log($_REQUEST);
            print_error_log("end_log");
            $results["status"] = "failed";
            $results["message"] = "Click on security check to confirm you are not robot!";
        }
        if ($results["status"] == "success") {
            //            , "distance", "duration"
            $verification_fields = array("last_name", "phone_mobile", "email1", "num_hours", "selected_vehicle_name", "pickup", "destination", "servicetype", "event_date", "event_time", "passengers");
            $validated = true;
            $failed_fields = array();
            foreach ($verification_fields as $field)
                if (!isset($_REQUEST[$field]) || $_REQUEST[$field] == null || trim($_REQUEST[$field]) == "" || empty($_REQUEST[$field])) {
                    $validated = false;
                    $failed_fields[] = $field;
                }
            if ($validated == true) {
                print_error_log("fields validation success...");
                $results["status"] = "success";
                $results["token"] = rand(1111111111, 9999999999);
                $_SESSION["token"] = $results["token"];
            } else {
                print_error_log("Fields validation failed for: " . implode(", ", $failed_fields));
                print_error_log($_REQUEST);
                print_error_log("end_log");
                $results["status"] = "failed";
                $results["message"] = "Required fields missing! Please fill the complete form and send again.";
            }
        }
        echo json_encode($results);
        exit();
    } catch (Exception $e) {
        print_error_log("Exception occurred: " . $e->getMessage());
        echo json_encode($results);
        exit();
    }
} else if (isset($_REQUEST["lead_id"]) && $_REQUEST["lead_id"] && $_REQUEST["lead_id"] != null && !empty($_REQUEST["lead_id"])) {
    //print_error_log("fetching a lead...");
    try {
        $postArgs = array('id' => $_REQUEST["lead_id"], 'todo' => 'get_lead');
        $curl = curl_init($crm_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postArgs);
        $response = curl_exec($curl);
        $data = json_decode($response);
        $page_data["first_name"] = $data->first_name;
        $page_data["last_name"] = $data->last_name;
        $page_data["phone_mobile"] = $data->phone_mobile;
        $page_data["email1"] = $data->email1;
        $page_data["num_hours"] = $data->servicelength_c;
        $page_data["selected_vehicle_name"] = $data->description;
        $page_data["pickup"] = $data->pickuplocation_c;
        $page_data["destination"] = $data->location_c;
        $page_data["event_date"] = $data->eventdate_c;
        $page_data["passengers"] = $data->numberofpassengers_c;
        $page_data["distance"] = str_replace(" miles", "", $data->distance_c);
        $page_data["duration"] = $data->duration_c;
        $page_data["hourly_rate"] = $data->rate_c;
        $page_data["lead_number"] = $data->opertunityid_c;
        $page_data["vehicle_requested"] = $rates["Website"][$page_data["selected_vehicle_name"]]["Vehicle_ID"];
        $page_data["servicetype_opt_selected"] = $data->eventtype_c;
        $formated_time = "";
        if ($data->pickuptime_c)
            $formated_time = date("h:i A", strtotime($data->pickuptime_c));
        $page_data["event_time_opt_selected"] = $formated_time;
        $service_type_found = false;
        foreach ($page_data["servicetype"] as $ind => $key) {
            if ($key == $page_data["servicetype_opt_selected"] || $ind == $page_data["servicetype_opt_selected"]) {
                $page_data["servicetype_opt_selected"] = $ind;
                $service_type_found = true;
                break;
            }
        }
        if ($service_type_found == false)
            $page_data["servicetype_opt_selected"] = "General Day Trip";
        foreach ($page_data["event_time"] as $ind => $key) {
            if ($key == $formated_time || $formated_time == $ind) {
                $page_data["event_time_opt_selected"] = $ind;
                break;
            }
        }
        if (!$page_data["event_time_opt_selected"] || $page_data["event_time_opt_selected"] == "")
            $page_data["event_time_opt_selected"] = "18:00";
    } catch (Exception $e) {
        print_error_log("Exception occurred: " . $e->getMessage());
    }
}
