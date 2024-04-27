<?php
session_start();
$_SESSION['mdleads'] = array();
function m_log($arMsg)
{
    $stEntry = "";
    $arLogData['event_datetime'] = '[' . date('D Y-m-d h:i:s A') . '] [client ' . $_SERVER['REMOTE_ADDR'] . ']';
    if (is_array($arMsg)) {
        foreach ($arMsg as $msg) {
            $stEntry .= $arLogData['event_datetime'] . " " . $msg . "\r\n";
        }
    } else {
        $stEntry .= $arLogData['event_datetime'] . " " . $arMsg . "\r\n";
    }
    $stEntry .= date("Y-m-d H:i:s");
    $stCurLogFileName = 'log_' . date('Ymd') . '.txt';
    $fHandler = fopen('log_path_logs.txt', 'a+');
    fwrite($fHandler, $stEntry);
    fclose($fHandler);
}
function mm_log($arMsg)
{
    $stEntry = " ZAHID TSTING \r\n";
    if (is_array($arMsg)) {
        foreach ($arMsg as $key => $value) {
            $stEntry .= $key . " => " . $value . "\r\n";
        }
    } else {
        $stEntry .= $arMsg . "\r\n";
    }
    $stEntry .= date("Y-m-d H:i:s");
    $fHandler = fopen('log_path_logs.txt', 'a+');
    fwrite($fHandler, $stEntry);
    fclose($fHandler);
}
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["todo"]) && $_POST["todo"] == "get_lead") {
    $lead = BeanFactory::getBean('Leads', $_POST["id"]);
    $data = array();
    if ($lead->id) {
        foreach ($lead->field_defs as $ind => $key) {
            if (isset($lead->$ind)) {
                $data[$ind] = $lead->$ind;
            }
        }
    } else {
        $data["response_status_callback"] = "error";
    }
    echo json_encode($data);
} else if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["todo"]) && $_POST["todo"] == "save_lead") {
    $lead = BeanFactory::newBean('Leads');
    if (isset($_POST["id"]) && $_POST["id"] != null) {
        $lead = BeanFactory::getBean('Leads', $_POST["id"]);
    }
    foreach ($_POST as $ind => $key) {
        if (isset($lead->field_defs[$ind]) && $ind != "id") {
            if ($ind == 'vendor_vehicle_id') {
                $lead->vnd_vechiles_id_c = $_POST[$ind];
            } else {
                $lead->$ind = $key;
            }
        }
    }
    if (isset($_POST['vendor_id']) && !empty($_POST['vendor_id'])) {
        $lead->vnd_vendors_id_c = $_POST['vendor_id'];
        $lead->vnd_vechiles_id_c = $_POST['vendor_vehicle_id'];
        $vnd = BeanFactory::getBean('VND_Vendors', $_POST['vendor_id']);
        if ($vnd->id) {
            $lead->vendor_phone_c = $vnd->phone_office;
            $lead->vendor_email_c = $vnd->email1;
        }
    }
    if ($_POST["leadtype_c"] == "multiday") {

        for ($i = 0; $i < $_POST['totaldays']; $i++) {
            $HourlyRate = $_POST['rate_c'];
            $Hours = $_POST["mdhours_c"][$i];
            $QuotedPrice = floatval($Hours) * floatval($HourlyRate);
            $Distance =  $_POST["mddistance_c"][$i];
            $Mileage = $Distance * 2 * 1.5;
            $Fuel = $QuotedPrice * .2;
            $Gratuity = $QuotedPrice * .05;
            $TotalTripCost = $QuotedPrice + $Fuel + $Mileage + $Gratuity;
            $mdleadar = array('pickup' => $_POST["mdpickup_c"][$i], "destination" => $_POST["mddestination_c"][$i], "eventdate" => $_POST["mdevent_date_c"][$i], "hours" => $_POST["mdhours_c"][$i], "tcost" => $TotalTripCost);
            array_push($_SESSION['mdleads'], $mdleadar);
        }
    }
    $lead->save();
    if ($lead->id) {
        $sql = "SELECT rate_c FROM leads_cstm where id_c='{$lead->id}'";
        $sqlresult = $GLOBALS['db']->getOne($sql);
        $result["id"] = $lead->id;
        $result["status"] = "success";
        $result["hrate"] = $sqlresult;
        $result['multidaydata'] = $_POST;
        if ($_POST["leadtype_c"] == "multiday") {
            // $GLOBALS['log']->fatal("*******************************MUTLTI START 1************************************");
            $GLOBALS['log']->fatal("LEAD ID SAMI =>" . $lead->id);
            $GLOBALS['log']->fatal(json_encode($_POST));
            require_once 'modules/shmd1_mdlead/shmd1_mdlead.php';
            $lbean = BeanFactory::getBean('Leads', $lead->id);
            //WHY IS THIS HERE IT WAS CAUSING ISSUES FOR MULTI DAY LEAD RECORDS WITH LEAD SO COMMENTED IT
            // $lbean->leads_shmd1_mdlead_1->delete($lead->id);
            $tdistance =  0;
            for ($i = 0; $i < $_POST['totaldays']; $i++) {
                $mdlead = BeanFactory::newBean('shmd1_mdlead');
                $mdlead->pickup_c = $_POST["mdpickup_c"][$i];
                $mdlead->destination_c = $_POST["mddestination_c"][$i];
                $mdlead->event_date_c = $_POST["mdevent_date_c"][$i];
                $mdlead->mdlead_id_c = $lead->id;
                $mdlead->mservicelength_c = $_POST["mdhours_c"][$i];
                $mdlead->mdistance_c = $_POST["mddistance_c"][$i];
                $tdistance +=  $_POST["mddistance_c"][$i];
                $lbean->distance_c = $tdistance;
                $mdlead->duration_c = $_POST["mdduration_c"][$i];
                $mdlead->save();
                // $GLOBALS['log']->fatal("MULIT ID => ".$mdlead->id);
                $lbean->leads_shmd1_mdlead_1->add($mdlead);
                $lbean->save();
                $HourlyRate = $lead->rate_c;
                $Hours = $_POST["mddestination_c"][$i];
                $QuotedPrice = (float) $Hours * (float) $HourlyRate;
                $Distance =  (float) $_POST["mddistance_c"][$i];
                $Mileage = $Distance * 2 * 1.5;
                $Fuel = $QuotedPrice * .2;
                $Gratuity = $QuotedPrice * .05;
                $TotalTripCost = $QuotedPrice + $Fuel + $Mileage + $Gratuity;
                $mdleadar = array('pickup' => $_POST["mdpickup_c"][$i], "destination" => $_POST["mddestination_c"][$i], "hours" => $_POST["mdhours_c"][$i], "tcost" => $TotalTripCost);
                array_push($_SESSION['mdleads'], $mdleadar);
            }
            // $GLOBALS['log']->fatal(json_encode($_SESSION['mdleads']));
            // $GLOBALS['log']->fatal("*******************************MUTLTI END 1************************************");
        }
    } else {
        $result["id"] = "";
        $result["status"] = "failed";
    }
    echo json_encode($result);
} else if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["todo"]) && $_POST["todo"] == "gigmaster_lead") {
    try {
        $lead = BeanFactory::newBean('Leads');
        if (isset($_POST["id"]) && $_POST["id"] != null) {
            $lead = BeanFactory::getBean('Leads', $lead->id);
        }
        foreach ($_POST as $ind => $key) {
            if (isset($lead->field_defs[$ind]) && $ind != "id") {
                $lead->$ind = $key;
            }
        }
        $lead->save();
        if ($lead->id) {
            $result["id"] = $lead->id;
            $result["status"] = "success";
        } else {
            $result["id"] = "";
            $result["status"] = "failed";
        }
        echo $result["status"];
    } catch (Exception $ex) {
        // $GLOBALS['log']->fatal("[GIGMASTER_LEAD_ERROR]" . $ex->getCode() . " - " . $ex->getMessage() . " - " . $ex->getFile() . "-" . $ex->getLine());
        // $GLOBALS['log']->fatal($ex->getTrace());
    }
} else if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["todo"]) && $_POST["todo"] == "get_vehicles_list") {
    $state = trim($_POST["pickup_state"]);
    $act_pass = round((int) $_POST["passengers"]);
    $min_pass = round((int) $_POST["passengers"] * 0.5);
    $max_pass = round((int) $_POST["passengers"] * 1.5);
    $event_date = date('Y-m-d', strtotime($_POST["event_date"]));
    $event_day = strtolower(date('l', strtotime($_POST["event_date"])));
    $sql = "SELECT vehicles.*, vehicles_c.*, vendors.id AS VENDOR_ID, vendors_c.address_lat_c AS lati, vendors_c.address_lng_c AS longi FROM vnd_vechiles AS vehicles, vnd_vechiles_cstm AS vehicles_c, vnd_vendors AS vendors, vnd_vendors_cstm AS vendors_c, vnd_vechiles_vnd_vendors_c AS vendors_vehicles WHERE vehicles.deleted=0 AND vehicles.vehicle_capacity BETWEEN $min_pass AND $max_pass AND vehicles.vehicle_status='YES' AND vehicles.id=vehicles_c.id_c AND vehicles_c.published_c='Yes' AND vendors_vehicles.vnd_vechiles_vnd_vendorsvnd_vechiles_idb=vehicles.id AND vendors_vehicles.vnd_vechiles_vnd_vendorsvnd_vendors_ida=vendors.id AND vendors_vehicles.deleted=0 AND vendors.deleted=0 AND vendors.id=vendors_c.id_c AND vendors.status='Active' AND (vendors.vnd_vendors_type='Interstate' || (vendors.vnd_vendors_type='Intrastate' && vendors.billing_address_state='$state'))";
    $sql_results = $GLOBALS['db']->query($sql);
    $vehicles_data = array();
    $service_name = '';
    while ($vehicle = $GLOBALS['db']->fetchByAssoc($sql_results)) {
        if (!empty($vehicle['VENDOR_ID'])) {
            $vendor = BeanFactory::getBean('VND_Vendors', $vehicle['VENDOR_ID']);
            if (!empty($vendor->id)) {
                if (empty($vendor->address_lat_c) || empty($vendor->address_lng_c)) {
                    $address = array();
                    if (!empty($vendor->billing_address_street)) {
                        $address[] = $vendor->billing_address_street;
                    }
                    if (!empty($vendor->billing_address_city)) {
                        $address[] = $vendor->billing_address_city;
                    }
                    if (!empty($vendor->billing_address_state)) {
                        $address[] = $vendor->billing_address_state;
                    }
                    if (!empty($vendor->billing_address_postalcode)) {
                        $address[] = $vendor->billing_address_postalcode;
                    }
                    $vendor_address = implode(' ', $address);
                    //$vendor_latlong = array('lat'=>'39.2903848','long'=>'-76.6121893');
                    $vendor_latlong = get_lat_long($vendor_address);
                    $lat = '';
                    $long = '';
                    if (isset($vendor_latlong['lat'])) {
                        $lat = $vendor_latlong['lat'];
                    }
                    if (isset($vendor_latlong['long'])) {
                        $long = $vendor_latlong['long'];
                    }
                    if ($lat && $long) {
                        $vendor_location = $lat . "," . $long;
                        $GLOBALS['db']->query('UPDATE vnd_vendors_cstm SET address_lat_c="' . $lat . '", address_lng_c="' . $long . '" WHERE id_c="' . $vendor->id . '"');
                    } else {
                        continue;
                    }
                } else {
                    $vendor_location = $vendor->address_lat_c . "," . $vendor->address_lng_c;
                }
                $lead_location = $_POST["pickup_lat"] . "," . $_POST["pickup_lng"];
                $mapoutput = see_distance($lead_location, $vendor_location);
                //  $mapoutput = array("distance"=>"100");
                if ($mapoutput["distance"] != "Null" && $mapoutput["distance"] != Null && $mapoutput["distance"] <= $vendor->service_radius) {
                    $hourly_rate = '';
                    $min_hours = '';
                    $q = 'SELECT * FROM vnd_special_rates AS sr, vnd_special_rates_vnd_vechiles_c as srv WHERE srv.vnd_special_rates_vnd_vechilesvnd_vechiles_ida="' . $vehicle['id'] . '" AND srv.vnd_special_rates_vnd_vechilesvnd_special_rates_idb=sr.id AND sr.deleted=0 AND sr.special_rate_start_from < "' . $event_date . '" AND sr.special_rate_end_on > "' . $event_date . '" ORDER BY sr.date_entered DESC ';
                    $srate_row = $GLOBALS['db']->fetchOne($q);
                    if ($srate_row && isset($srate_row['id'])) {
                        $phourly_rate = $srate_row['hourly_rate_' . $event_day];
                        $min_hours = $srate_row['min_hours_' . $event_day];
                        $service_name = $srate_row['name'];
                    }
                    if ($hourly_rate == '') {
                        $hr_day = 'hourly_rate_' . $event_day;
                        $mh_day = 'min_hours_' . $event_day;
                        $hourly_rate = $vehicle[$hr_day];
                    }
                    if ($min_hours == '') {
                        $min_hours = $vehicle[$mh_day];
                    }
                    $multiselect_options = array('interior_style', 'onboard_luxury', 'media_capability', 'complimentary');
                    $facilities = array();
                    $interior_styleData = str_replace('^', '', $vehicle['interior_style']);
                    $interior_style = explode(',', $interior_styleData);
                    $onboard_luxuryData = str_replace('^', '', $vehicle['onboard_luxury']);
                    $onboard_luxury = explode(',', $onboard_luxuryData);
                    $media_capabilityData = str_replace('^', '', $vehicle['media_capability']);
                    $media_capability = explode(',', $media_capabilityData);
                    $complimentaryData = str_replace('^', '', $vehicle['complimentary']);
                    $complimentary = explode(',', $complimentaryData);
                    $facilities = array_merge($interior_style, $onboard_luxury, $media_capability, $complimentary);
                    $images = explode(',', $vehicle['images']);
                    $v_data = array(
                        'Vehicle_Name' => $vehicle['name'],
                        'Cetagory' => $vehicle['name'],
                        'Vehicle_ID' => $vehicle['id'],
                        'Min_Hours' => $min_hours,
                        'Passenger' => $vehicle['vehicle_capacity'],
                        'Ranges' => array('*' => $hourly_rate),
                        'UC_Vehicles_Show' => array(),
                        'facilities' => $facilities,
                        'images' => $images,
                        'Bags' => $vehicle['luggage_limit'],
                        'PromHourly' => $phourly_rate,
                        'VendorId' => $vendor->id,
                        'vndlong' => $vendor->address_lng_c,
                        'vndlat' => $vendor->address_lat_c,
                        'allowcharges' => $vendor->allowcharges_c,
                        'hourstocharge_c' => $vendor->hourstocharge_c,
                        'servcie_name' => $service_name,
                    );
                    $vehicles_data[$vehicle['id']] = $v_data;
                }
            }
        }
    }
    echo json_encode($vehicles_data);
} else {
    echo "Invalid request. <a href='https://unlimitedcharters.com'>Click here to go back!</a>";
    exit();
}

function see_distance($origin, $destination)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.radar.io/v1/route/matrix?origins=' . urlencode($origin) . '&destinations=' . urlencode($destination) . '&mode=car&units=metric',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: prj_live_pk_54b2a02354afc907c3550d5b7e709b61937d9d88'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response, true);
    if (isset($response["meta"]['code']) &&  $response["meta"]['code'] == "200") {
        $result["distance"] = round($response['matrix'][0][0]['distance']['value'] / 1609.34, 2);
        $result["duration"] = $response['matrix'][0][0]['duration']['text'];
    } else {
        $result["distance"] = "Null";
        $result["duration"] = "Null";
    }
    if ($result["distance"] == 0) {
        $result["distance"] = 1;
    }
    return $result;
}
function get_lat_long($address)
{
    $address = str_replace(" ", "+", $address);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.radar.io/v1/search/autocomplete?query=' . $address,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: prj_live_pk_54b2a02354afc907c3550d5b7e709b61937d9d88'
        ),
    ));
    $response = curl_exec($curl);
    $response = json_decode($response, true);
    $result = array();
    if (isset($response["meta"]['code']) &&  $response["meta"]['code'] == "200") {
        $result['lat'] = $response['addresses'][0]['geometry']['coordinates'][1];
        $result['long'] = $response['addresses'][0]['geometry']['coordinates'][0];
    }
    return $result;
}
