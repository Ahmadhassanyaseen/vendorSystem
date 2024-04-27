<?php
require_once "modules/Configurator/Configurator.php";
error_reporting(0);
ini_set("display_errors", 0);
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["method"]) && $_POST["method"] == "CreateVendor") {
        require_once './modules/VND_Vendors/VND_Vendors.php';
        $vnd = new VND_Vendors();
        $vnd->retrieve_by_string_fields(array('username' => $_POST["email1"]));
        if ($vnd->id) {
            echo "Email address already exists. Try login instead.";
        } else {
            $vnd->name = $_POST["email1"];
            $vnd->email1 = $_POST["email1"];
            $vnd->password = $_POST["password"];
            $vnd->password_reset_link = md5($_POST["password"]) . md5($_POST["email1"]);
            $vnd->status = "Email_Verification";
            $vnd->username = $_POST["email1"];
            $vnd->trigger_emails = "Profile_Verification";
            $vnd->save();
            if ($vnd->id)
                echo "success";
            else
                echo "Error occurred while submitting your request. Try again later or contact Administrator.";
        }
    } else if (isset($_POST["method"]) && $_POST["method"] == "loginVendorNew") {
        $result = loginVendorNew($_POST['email'], $_POST['password']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "FetchVehicle") {
        $result = fetchVehicle($_POST['id']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "FetchVehicleImages") {
        $result = fetchVehicleImages($_POST['id']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "FetchVndLeads") {
        $result = fetchVndLeads($_POST['vendor_email'], $_POST['vendor_id']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "FetchSingleLead") {
        $result = fetchSingleLead($_POST['opertunityid_c']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "updateSingleLead") {
        $result = updateSingleLead($_POST['lead_id'], $_POST['fuel'], $_POST['gratuity'], $_POST['quoted_price'], $_POST['mileage'], $_POST['total_cost'], $_POST['costperperson'], $_POST['rate_c'], $_POST['vechiles_name_c'], $_POST['vehicle_type_c'], $_POST['total_profit_c']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "updateSingleLeadStatus") {
        $result = updateSingleLeadStatus($_POST['lead_id'], $_POST['status']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "vendor_cstm") {
        $result = vendor_cstm($_POST['vndid']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "fetchVndVechiles") {
        $result = fetchVndVechiles($_POST['vndid']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "fetchVehicle") {
        $result = fetchVehicle($_POST['vehicle_id']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "leadCharges") {
        $result = leadCharges();
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "fetchVehicleImages") {
        $result = fetchVehicleImages($_POST['vehicle_id']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "deleteVehicleImage") {
        $result = deleteVehicleImage($_POST['vehicle_id'], $_POST['image']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "fetchALLVndVehicles") {
        $result = fetchALLVndVehicles($_POST['vndid']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "fetchALLVndVehicles") {
        $result = fetchALLVndVehicles($_POST['vndid']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    }
    // else if (isset($_POST["method"]) && $_POST["method"] == "addNewQuote") {
    //     $result = addNewQuote($_POSt['vendor_id'] , $_POSt['lead_id']  , $_POSt['quoted_c'] , $_POSt['vehicle_c']   , $_POSt['vendor_notes_c']);
    //     $result['CURL_RESULT'] = "success";
    //     echo json_encode($result);
    // }  
    else if (isset($_POST["method"]) && $_POST["method"] == "xeno") {
        $result = xeno($_POST['id'], $_POST['name']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "addLeadQuote") {
        $result = addLeadQuote($_POST['lead_id'], $_POST['vendor_id'], $_POST['vehicle_id'], $_POST['opertunity_id'], $_POST['fuel'], $_POST['gratuity'], $_POST['quoted_price'], $_POST['mileage'], $_POST['total_cost'], $_POST['costperperson'], $_POST['rate_c'], $_POST['vehicle_type_c'], $_POST['total_profit_c'], $_POST['vendor_email'], $_POST['vendor_phone'], $_POST['lead_type'], $_POST['service_length']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "testLeadQuote") {
        $result = testLeadQuote($_POST['vendor_id'], $_POST['lead_id']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "allQuotes") {
        $result = allQuotes($_POST['vendor_id'], $_POST['lead_id']);
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "UpdateSepcialRate") {
        require_once './modules/VND_Special_Rates/VND_Special_Rates.php';
        $deleted = 0;
        $special_rate = new VND_Special_Rates();
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $special_rate->retrieve($_POST['id']);
            if (isset($_POST['delete_special_rate']) && $_POST['delete_special_rate'] == 'YES') {
                $special_rate->deleted = 1;
                $special_rate->save();
                $deleted = 1;
            }
        } else if (isset($_POST['delete_special_rate']) && $_POST['delete_special_rate'] == 'YES') {
            $deleted = 1;
        }
        if ($deleted == 0) {
            foreach ($_POST as $spIndx => $spVal) {
                if (isset($special_rate->field_defs[$spIndx]) && $spIndx != 'id')
                    $special_rate->$spIndx = $spVal;
            }
            if (isset($_POST['custom_rates']))
                $special_rate->custom_rates = '1';
            else
                $special_rate->custom_rates = '0';
            $special_rate->save();
            if ($special_rate->id)
                echo $special_rate->id;
            else
                echo 'error';
        } else {
            echo 'skip';
        }
    } else if (isset($_POST["method"]) && $_POST["method"] == "UpdateImages") { //
        $GLOBALS['log']->fatal("update vechicle " . $_POST['id']);
        global $db;
        $sql = "UPDATE vnd_vechiles SET images='" . $_POST['vehicle_images'] . "' WHERE id='" . $_POST['id'] . "'";
        $sql_results = $db->query($sql);
        echo json_encode($sql_results);
    } else if (isset($_POST["method"]) && $_POST["method"] == "DeleteVehicle") {
        require_once './modules/VND_Vechiles/VND_Vechiles.php';
        $vehicle = new VND_Vechiles(); //$GLOBALS['log']->fatal("delete vechicle ".$_POST['id']);
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $vehicle->retrieve(trim($_POST['id']));
        }
        $result = array();
        if (($vehicle->vnd_vechiles_vnd_vendorsvnd_vendors_ida == trim($_POST['vendor_id'])) || !empty($_POST['vendor_id'])) {
            $vehicle->deleted = 1;
            $vehicle->save();
            $GLOBALS['log']->fatal("delete vechicle yes " . $_POST['id']);
            $result['CURL_RESULT'] = "success";
        } else {
            $result['CURL_RESULT'] = "failed";
            $GLOBALS['log']->fatal("delete vechicle no" . $_POST['id'] . $vehicle->vnd_vechiles_vnd_vendorsvnd_vendors_ida);
        }
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "UpdateVehicle") { //'luggage_limit',
        $required_fields = array('name', 'vehicle_year', 'vehicle_color', 'vehicle_capacity',  'vehicle_quantity', 'base_hourly_rate', 'base_min_hours', 'images');
        require_once './modules/VND_Vechiles/VND_Vechiles.php';
        $vehicle = new VND_Vechiles();
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $vehicle->retrieve(trim($_POST['id']));
        }
        $vehicle->name = trim($_POST['vehicle_type']);
        $vehicle->vehicle_make = trim($_POST['vehicle_make']);
        $vehicle->vehicle_model = trim($_POST['vehicle_model']);
        $vehicle->vehicle_year = trim($_POST['vehicle_year']);
        $vehicle->vehicle_color = trim($_POST['vehicle_color']);
        $vehicle->vehicle_capacity = trim($_POST['vehicle_capacity']);
        $vehicle->luggage_limit = trim($_POST['luggage_limit']);
        $vehicle->vehicle_quantity = trim($_POST['vehicle_quantity']);
        $vehicle->vehicle_status = trim($_POST['vehicle_status']);
        $vehicle->interior_style = trim($_POST['interior_style']);
        $vehicle->onboard_luxury = trim($_POST['onboard_luxury']);
        $vehicle->media_capability = trim($_POST['media_capability']);
        $vehicle->complimentary = trim($_POST['complimentary']);
        $vehicle->base_hourly_rate = trim($_POST['base_hourly_rate']);
        $vehicle->base_min_hours = trim($_POST['base_min_hours']);
        $vehicle->base_additional_hourly = trim($_POST['base_additional_hourly']);
        if (isset($_POST['custom_daily_rates']))
            $vehicle->custom_daily_rates = '1';
        else
            $vehicle->custom_daily_rates = '0';
        $vehicle->hourly_rate_monday = trim($_POST['hourly_rate_monday']);
        $vehicle->hourly_rate_tuesday = trim($_POST['hourly_rate_tuesday']);
        $vehicle->hourly_rate_wednesday = trim($_POST['hourly_rate_wednesday']);
        $vehicle->hourly_rate_thursday = trim($_POST['hourly_rate_thursday']);
        $vehicle->hourly_rate_friday = trim($_POST['hourly_rate_friday']);
        $vehicle->hourly_rate_saturday = trim($_POST['hourly_rate_saturday']);
        $vehicle->hourly_rate_sunday = trim($_POST['hourly_rate_sunday']);
        $vehicle->min_hours_monday = trim($_POST['min_hours_monday']);
        $vehicle->min_hours_tuesday = trim($_POST['min_hours_tuesday']);
        $vehicle->min_hours_wednesday = trim($_POST['min_hours_wednesday']);
        $vehicle->min_hours_thursday = trim($_POST['min_hours_thursday']);
        $vehicle->min_hours_friday = trim($_POST['min_hours_friday']);
        $vehicle->min_hours_saturday = trim($_POST['min_hours_saturday']);
        $vehicle->min_hours_sunday = trim($_POST['min_hours_sunday']);
        $vehicle->additional_hourly_monday = trim($_POST['additional_hourly_monday']);
        $vehicle->additional_hourly_tuesday = trim($_POST['additional_hourly_tuesday']);
        $vehicle->additional_hourly_wednesday = trim($_POST['additional_hourly_wednesday']);
        $vehicle->additional_hourly_thursday = trim($_POST['additional_hourly_thursday']);
        $vehicle->additional_hourly_friday = trim($_POST['additional_hourly_friday']);
        $vehicle->additional_hourly_saturday = trim($_POST['additional_hourly_saturday']);
        $vehicle->additional_hourly_sunday = trim($_POST['additional_hourly_sunday']);
        $vehicle->fuel_surcharge_percentage = trim($_POST['fuel_surcharge_percentage']);
        $vehicle->driver_gratuity_percentage = trim($_POST['driver_gratuity_percentage']);
        $vehicle->vnd_vechiles_vnd_vendorsvnd_vendors_ida = trim($_POST['vendor_id']);
        $vehicle->images = trim($_POST['vehicle_images']);
        $vehicle->published_c = 'Yes';
        foreach ($required_fields as $reqval) {
            if (!isset($vehicle->$reqval) || empty($vehicle->$reqval))
                $vehicle->published_c = 'No';
        }
        $vehicle->save();
        $result = array();
        $multiselect_options = array('interior_style', 'onboard_luxury', 'media_capability', 'complimentary');
        foreach ($vehicle->field_defs as $field => $f_info) {
            if (isset($f_info['type']) && $f_info['type'] == 'currency' || $f_info['type'] == 'float') {
                $result[$field] = number_format($vehicle->$field, 2, '.', ',');
            } else if (in_array($field, $multiselect_options)) {
                $rdata = str_replace('^', '', $vehicle->$field);
                $arryData = explode(',', $rdata);
                $result[$field] = $arryData;
            } else {
                $result[$field] = $vehicle->$field;
            }
        }
        $result["vehicle_type"] = $vehicle->name;
        $result["vehicle_images"] = explode(',', $vehicle->images);
        $result["vehicle"] = $vehicle->id;
        $result['CURL_RESULT'] = "success";
        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "UpdateVendor") {
        require_once './modules/VND_Vendors/VND_Vendors.php';
        $vnd = new VND_Vendors();
        $vnd->retrieve($_POST["id"]);
        if ($vnd->unique_vendor_id == $_POST["unique_vendor_id"]) {
            $vnd->name = $_POST["name"];
            $vnd->email1 = $_POST["email1"];
            $vnd->website = $_POST["website"];
            $vnd->phone_office = $_POST["phone_office"];
            $vnd->billing_address_street = $_POST["billing_address_street"];
            $vnd->billing_address_city = $_POST["billing_address_city"];
            $vnd->billing_address_state = $_POST["billing_address_state"];
            $vnd->billing_address_postalcode = $_POST["billing_address_postalcode"];
            $vnd->vnd_vendors_type = $_POST["vnd_vendors_type"];
            $vnd->service_radius = $_POST["service_radius"];
            $vnd->allowcharges_c = $_POST["allowcharges_c"];
            $vnd->hourstocharge_c = $_POST["hourstocharge_c"];
            $vnd->dot_number = $_POST["dot_number"];
            $vnd->ownership = $_POST["ownership"];
            $vnd->phone_alternate = $_POST["phone_alternate"];
            $vnd->address_lat_c = $_POST["address_lat_c"];
            $vnd->address_lng_c = $_POST["address_lng_c"];
            $vnd->status = "Active";
            $vnd->save();
            if ($vnd->id)
                echo "success";
            else
                echo "Error occurred while updating your profile. Try again later or contact Administrator.";
        } else {
            echo "Vendor doesn't exist. Please try to create a new account or contact administrator.";
        }
    } else if (isset($_POST["method"]) && $_POST["method"] == "ProfileActivate") {
        require_once './modules/VND_Vendors/VND_Vendors.php';
        $vnd = new VND_Vendors();
        $vnd->retrieve_by_string_fields(array('password_reset_link' => $_POST["password_reset_link"], 'unique_vendor_id' => $_POST["unique_vendor_id"]));
        if ($vnd->id) {
            if ($vnd->status == "Email_Verification" || $vnd->status == "Email Verification") {
                $oSugarEmailAdd = new SugarEmailAddress;
                $primary_email_add = $oSugarEmailAdd->getPrimaryAddress($vnd);
                $vnd->email1 = $primary_email_add;
                $vnd->status = "Complete_Profile";
                $vnd->save();
                echo 'success';
            } else {
                echo "Your profile is already activated. Click following link to Login";
            }
        } else {
            echo "Invalid information specified";
        }
    } else if (isset($_POST["method"]) && $_POST["method"] == "ValidateResetPassword") {
        require_once './modules/VND_Vendors/VND_Vendors.php';
        $vnd = new VND_Vendors();
        $vnd->retrieve_by_string_fields(array('password_reset_link' => $_POST["password_reset_link"], 'unique_vendor_id' => $_POST["unique_vendor_id"]));
        if ($vnd->id) {
            if ($vnd->status == "Disabled_Admin" || $vnd->status == "Disabled Admin") {
                echo "Your account was suspended. Please contact administrator for help.";
            } else if ($vnd->status == "Deactivated" || $vnd->status == "Deactivated") {
                echo "Your account was deactivated by you. Please contact administrator for help.";
            } else {
                $oSugarEmailAdd = new SugarEmailAddress;
                $primary_email_add = $oSugarEmailAdd->getPrimaryAddress($vnd);
                $vnd->email1 = $primary_email_add;
                $vnd->password = $_POST["password"];
                $vnd->save();
                $GLOBALS['log']->fatal("validate resset " . $primary_email_add);
                echo 'success';
            }
        } else {
            echo "Invalid information specified";
        }
    } else if (isset($_POST["method"]) && $_POST["method"] == "ResetPassword") {
        require_once './modules/VND_Vendors/VND_Vendors.php';
        $vnd = new VND_Vendors();
        $vnd->retrieve_by_string_fields(array('username' => $_POST["user_email"]));
        if ($vnd->id) {
            if ($vnd->status == "Disabled_Admin" || $vnd->status == "Disabled Admin") {
                echo "Your account was suspended. Please contact administrator for help.";
            } else if ($vnd->status == "Deactivated" || $vnd->status == "Deactivated") {
                echo "Your account was deactivated by you. Please contact administrator for help.";
            } else {
                $oSugarEmailAdd = new SugarEmailAddress;
                $primary_email_add = $oSugarEmailAdd->getPrimaryAddress($vnd);
                $vnd->email1 = $primary_email_add;
                $vnd->trigger_emails = "Password_Reset";
                $vnd->password_reset_link = md5($vnd->password_reset_link) . md5(date('Y-m-d h:i:s'));
                $vnd->save();
                $GLOBALS['log']->fatal("pass resset " . $primary_email_add);
                echo 'success';
            }
        } else {
            echo "Specified email doesn't exist in our system. Make sure you entered a correct email address.";
        }
    } else if (isset($_POST["method"]) && $_POST["method"] == "RemoveSepcialRate") {
        require_once './modules/VND_Special_Rates/VND_Special_Rates.php';
        $special_rate = new VND_Special_Rates();
        $special_rate->retrieve($_POST['special_rate']);
        $special_rate->deleted = 1;
        $special_rate->save();
        $special_rate->load_relationship('vnd_special_rates_vnd_vechiles');
        $special_rate->vnd_special_rates_vnd_vechiles->delete($_POST['special_rate'], $_POST['vehicle']);
        echo 'success';
    } else if (isset($_POST["method"]) && $_POST["method"] == "DuplicateCheck") {
        require_once './modules/VND_Vendors/VND_Vendors.php';
        $vnd = new VND_Vendors();
        $vnd->retrieve_by_string_fields(array('username' => $_POST["user_email"]));
        if ($vnd->id) {
            echo 'exists';
        } else {
            echo 'notexist';
        }
    }
    // else if (isset($_POST["method"]) && $_POST["method"] == "LoginVendor") {
    //     require_once './modules/VND_Vendors/VND_Vendors.php';
    //     $vnd = new VND_Vendors();
    //     $vnd->retrieve_by_string_fields(array('username' => $_POST["username"], 'password' => $_POST["password"]));
    //     //  $result['username'] = $_POST["username"];
    //     //  $result['password'] = $_POST["password"];
    //     // return $result;
    //     if ($vnd->id) {
    //         if ($vnd->status == "Email_Verification" || $vnd->status == "Email Verification") {
    //             echo "Please veryif your email address. Open email and click on verification link to activate your profile.";
    //         } else if ($vnd->status == "Disabled_Admin") {
    //             echo "Your account was suspended by the administrator!";
    //         } else {
    //             $result = array();
    //             foreach ($vnd->field_defs as $field => $f_info) {
    //                 $result[$field] = $vnd->$field;
    //             }
    //             $vehicles_object = array();
    //             if ($vnd->load_relationship('vnd_vechiles_vnd_vendors')) {
    //                 $relatedBeans = $vnd->vnd_vechiles_vnd_vendors->get();
    //                 if ($relatedBeans) {
    //                     foreach ($relatedBeans as $vIndx) {
    //                         $vehicles_object[$vIndx] = fetchVehicle($vIndx);
    //                     }
    //                 }
    //             }
    //             $oSugarEmailAdd = new SugarEmailAddress;
    //             $primary_email_add = $oSugarEmailAdd->getPrimaryAddress($vnd);
    //             $result['email1'] = $primary_email_add;
    //             $result['VEHICLES'] = $vehicles_object;
    //             $result['CURL_RESULT'] = "success";

    //             echo json_encode($result);
    //         }
    //     } else {
    //         echo "Invalid email. It doesn't exist in our system.";
    //     }
    // } 
    else if (isset($_POST["method"]) && $_POST["method"] == "MasterVendor") {


        $result = array();



        $result['vehicles'] = fetchVndVechiles($_POST["id"]);

        $result['CURL_RESULT'] = "success";

        //$result['VEHICLES'] = $vehicles_object;

        echo json_encode($result);
    } else if (isset($_POST["method"]) && $_POST["method"] == "MasterVendorGetVendor") {


        $result = array();



        $result['vendors'] = fetchVendors($_POST['vname']);

        $result['CURL_RESULT'] = "success";

        //$result['VEHICLES'] = $vehicles_object;

        echo json_encode($result);
    } else {
        echo "Invalid Method! Please try again or contact Administrator.";
    }
} else {
    echo "Invalid Request! Please try again or contact Administrator.";
}

// function addLeadQuote($lead_id , $vendor_id , $vehicle_id, $opertunity_id, $fuel, $gratuity, $quoted_price, $mileage, $total_cost, $costperperson , $rate_c ,  $vehicle_type_c , $total_profit_c , $vendor_email , $vendor_phone , $lead_type , $service_length )
// {
//     require_once './modules/Leads/Lead.php';
//     $lead = new Lead();

//     global $db;
//     $result = array();

//     // Prepare the SQL statement for insertion
//     $sql = "INSERT INTO lead_quote (lead_id, vendor_id, vehicle_id, opertunity_id, fuel_c, gratuity_c, quoted_c, mileage_c, total_trip_cost, costperperson_c, rate_c, vehicle_type_c, total_profit, vendor_email, vendor_phone, leadtype_c, servicelength_c, date_created) 
//             VALUES ('$lead_id', '$vendor_id', '$vehicle_id', '$opertunity_id', '$fuel', '$gratuity', '$quoted_price', '$mileage', '$total_cost', '$costperperson', '$rate_c', '$vehicle_type_c', '$total_profit_c', '$vendor_email', '$vendor_phone', '$lead_type', '$service_length', NOW())";

//     // Execute the SQL query
//     $sql_results = $db->query($sql);

//     if ($sql_results) {
//         $result['success'] = true;
//         $result['message'] = "Lead quote added successfully.";
//     } else {
//         $result['success'] = false;
//         $result['message'] = "Failed to add lead quote.";
//     }

//     return $result;
// }

function addLeadQuote($lead_id, $vendor_id, $vehicle_id, $opportunity_id, $fuel, $gratuity, $quoted_price, $mileage, $total_cost, $costperperson, $rate_c,  $vehicle_type_c, $total_profit_c, $vendor_email, $vendor_phone, $lead_type, $service_length)
{
    require_once './modules/Leads/Lead.php';
    $lead = new Lead();

    global $db;
    $result = array();

    // Prepare the SQL statement for insertion
    $sql = "INSERT INTO lead_quote (lead_id, vendor_id, vehicle_id, opertunity_id, fuel_c, gratuity_c, quoted_c, mileage_c, total_trip_cost, costperperson_c, rate_c, vehicle_type_c, total_profit, vendor_email, vendor_phone, leadtype_c, servicelength_c, date_created) 
            VALUES ('$lead_id', '$vendor_id', '$vehicle_id', '$opportunity_id', '$fuel', '$gratuity', '$quoted_price', '$mileage', '$total_cost', '$costperperson', '$rate_c', '$vehicle_type_c', '$total_profit_c', '$vendor_email', '$vendor_phone', '$lead_type', '$service_length', NOW())";

    // Execute the SQL query
    $sql_results = $db->query($sql);

    if ($sql_results) {
        $result['success'] = true;
        $result['message'] = "Lead quote added successfully.";
        // Include input parameters in the response
        $result['lead_id'] = $lead_id;
        $result['vendor_id'] = $vendor_id;
        $result['vehicle_id'] = $vehicle_id;
        $result['opportunity_id'] = $opportunity_id;
        $result['fuel'] = $fuel;
        $result['gratuity'] = $gratuity;
        $result['quoted_price'] = $quoted_price;
        $result['mileage'] = $mileage;
        $result['total_cost'] = $total_cost;
        $result['costperperson'] = $costperperson;
        $result['rate_c'] = $rate_c;
        $result['vehicle_type_c'] = $vehicle_type_c;
        $result['total_profit_c'] = $total_profit_c;
        $result['vendor_email'] = $vendor_email;
        $result['vendor_phone'] = $vendor_phone;
        $result['lead_type'] = $lead_type;
        $result['service_length'] = $service_length;
    } else {
        $result['success'] = false;
        $result['message'] = "Failed to add lead quote.";
        $result['lead_id'] = $lead_id;
        $result['vendor_id'] = $vendor_id;
        $result['vehicle_id'] = $vehicle_id;
        $result['opportunity_id'] = $opportunity_id;
        $result['fuel'] = $fuel;
        $result['gratuity'] = $gratuity;
        $result['quoted_price'] = $quoted_price;
        $result['mileage'] = $mileage;
        $result['total_cost'] = $total_cost;
        $result['costperperson'] = $costperperson;
        $result['rate_c'] = $rate_c;
        $result['vehicle_type_c'] = $vehicle_type_c;
        $result['total_profit_c'] = $total_profit_c;
        $result['vendor_email'] = $vendor_email;
        $result['vendor_phone'] = $vendor_phone;
        $result['lead_type'] = $lead_type;
        $result['service_length'] = $service_length;
    }

    return $result;
}



function fetchVendors($vname)
{
    global $db;
    $vendor_object = array();
    if (!empty($vname))
        $sql = "SELECT DISTINCT id,name FROM vnd_vendors where STATUS='active' and deleted=0 and (name LIKE '%" . $vname . "%' OR username LIKE '%" . $vname . "%' OR phone_office LIKE '%" . $vname . "%')";
    else
        $sql = "SELECT id,name FROM vnd_vendors where STATUS='active' and deleted=0";
    $sql_results = $db->query($sql);
    while ($vendor = $db->fetchByAssoc($sql_results)) {
        $vendor_object[$vendor['id']] = $vendor['name'];
    }
    return $vendor_object;
}
function fetchVndVechiles($vndid)
{
    global $db;
    $vehicles_object = array();

    $sql2 = "SELECT vnd_vechiles_vnd_vendorsvnd_vechiles_idb FROM vnd_vechiles_vnd_vendors_c where vnd_vechiles_vnd_vendorsvnd_vendors_ida	='" . $vndid . "'";
    $sql_results2 = $db->query($sql2);
    while ($vechileid = $db->fetchByAssoc($sql_results2)) {
        $sql3 = "SELECT name,images,interior_style FROM vnd_vechiles where id ='" . $vechileid['vnd_vechiles_vnd_vendorsvnd_vechiles_idb'] . "' AND deleted=0";
        $sql_results3 = $db->query($sql3);
        while ($vechile = $db->fetchByAssoc($sql_results3)) {
            //$GLOBALS['log']->fatal("vechile get ". $vechileid['vnd_vechiles_vnd_vendorsvnd_vechiles_idb'].$vechile['name'].$vechile['images']);
            $vehicles_object[$vechileid['vnd_vechiles_vnd_vendorsvnd_vechiles_idb']]['name'] = $vechile['name'];
            $vehicles_object[$vechileid['vnd_vechiles_vnd_vendorsvnd_vechiles_idb']]['images'] = $vechile['images'];
            //$vehicles_object[$vechileid['vnd_vechiles_vnd_vendorsvnd_vechiles_idb']]['vndname'] = $vendor['name'];
        }
    }

    return $vehicles_object;
}
function fetchVndLeads($vendor_email, $vendor_id)
{
    $fetch_list = array('lead_source', 'first_name', 'last_name', 'opertunityid_c');
    require_once './modules/Leads/Lead.php';
    $lead = new Lead();

    $result = array();
    $count = 0;

    global $db;

    $sql = "SELECT leads.id, leads.first_name, leads.last_name, leads_cstm.opertunityid_c, leads_cstm.quoted_c, leads_cstm.agreement_status_c,leads_cstm.vendor_confirmation_c,leads_cstm.duration_c,leads_cstm.distance_c,leads_cstm.eventdate_c, leads_cstm.sent_lead_count FROM leads_cstm INNER JOIN leads ON leads.id=leads_cstm.id_c WHERE leads_cstm.vendor_email_c='" . $vendor_email . "'";
    $sql_results = $db->query($sql);

    $lead_data = array();
    $service_name = '';
    //$GLOBALS['log']->fatal($act_pass);
    //$GLOBALS['log']->fatal($min_pass);
    //$GLOBALS['log']->fatal($max_pass);
    //$GLOBALS['log']->fatal($event_day);
    //$GLOBALS['log']->fatal($sql);
    while ($lead = $db->fetchByAssoc($sql_results)) {
        if (!empty($lead['opertunityid_c'])) {
            //$GLOBALS['log']->fatal("Lead ". $lead['opertunityid_c'].' '.$lead['first_name']);
            $result[$count]['opertunityid_c'] = $lead['opertunityid_c'];
            $result[$count]['first_name'] = $lead['first_name'];
            $result[$count]['last_name'] = $lead['last_name'];
            $result[$count]['quoted_c'] = $lead['quoted_c'];
            $result[$count]['agreement_status_c'] = $lead['agreement_status_c'];
            $result[$count]['eventdate_c'] = $lead['eventdate_c'];
            $result[$count]['duration_c'] = $lead['duration_c'];
            $result[$count]['distance_c'] = $lead['distance_c'];
            $result[$count]['sent_lead_count'] = $lead['sent_lead_count'];
            $result[$count]['vendor_confirmation_c'] = $lead['vendor_confirmation_c'];
            $sql1 = "SELECT * from lead_vnd_cstm where lead_id='" . $lead['id'] . "' AND vendor_id='" . $vendor_id . "'";
            $sql_results1 = $db->query($sql1);
            while ($reply = $db->fetchByAssoc($sql_results1)) {
                $result[$count]['vreply'] = $reply['reply'];
            }
            $count++;
        }
    }
    //$result['CURL_RESULT'] = "success";
    return $result;
}
function fetchVehicleImages($vehicle_id)
{
    $GLOBALS['log']->fatal("fetch v images id  " . $vehicle_id);
    global $db;
    $result = array();

    $sql3 = "SELECT images FROM vnd_vechiles where id ='" . $vehicle_id . "'";
    $sql_results3 = $db->query($sql3);
    while ($vechile = $db->fetchByAssoc($sql_results3)) {
        $result["vehicle_images"] = $vechile['images'];
    }
    return $result;
}
function deleteVehicleImage($vehicle_id, $image)
{
    global $db;
    $result = array();

    // Escape the image name to prevent SQL injection
    $escaped_image = $db->quote($image);

    // Delete the specific image from the vnd_vechiles table
    $sql = "UPDATE vnd_vechiles SET images = REPLACE(images, '$escaped_image', '') WHERE id = '" . $vehicle_id . "'";
    // $sql = "SELECT images FROM vnd_vechiles where id ='" . $vehicle_id . "'";
    $db->query($sql);

    // Check if the image deletion was successful
    // if ($db->getAffectedRowCount() > 0) {
    //     $result['success'] = true;
    //     $result['message'] = 'Image deleted successfully';
    // } else {
    //     $result['success'] = false;
    //     $result['message'] = 'Failed to delete image';
    // }

    // $result['image']= $image;
    $result['vehicle_id'] = $sql;
    // $result['affectedRows'] = $db->getAffectedRowCount();
    return $result;
}
function fetchVehicle($vehicle_id)
{
    //$GLOBALS['log']->fatal("fetch id  ". $vehicle_id);
    $fetch_list = array('id', 'name', 'custom_daily_rates', 'base_hourly_rate', 'base_additional_hourly', 'hourly_rate_monday', 'hourly_rate_tuesday', 'hourly_rate_wednesday', 'hourly_rate_thursday', 'hourly_rate_friday', 'hourly_rate_saturday', 'hourly_rate_sunday', 'additional_hourly_monday', 'additional_hourly_tuesday', 'additional_hourly_wednesday', 'additional_hourly_thursday', 'additional_hourly_friday', 'additional_hourly_saturday', 'additional_hourly_sunday', 'vehicle_year', 'vehicle_color', 'vehicle_status', 'published_c', 'base_min_hours', 'min_hours_monday', 'min_hours_tuesday', 'min_hours_wednesday', 'min_hours_thursday', 'min_hours_friday', 'min_hours_saturday', 'min_hours_sunday', 'fuel_surcharge_percentage', 'driver_gratuity_percentage', 'luggage_limit', 'vehicle_capacity', 'vehicle_quantity', 'interior_style', 'onboard_luxury', 'media_capability', 'complimentary', 'name', 'description', 'images', 'vehicle_make', 'vehicle_model');
    require_once './modules/VND_Vechiles/VND_Vechiles.php';
    $vehicle = new VND_Vechiles();
    $vehicle->retrieve(trim($vehicle_id));
    $result = array();
    $multiselect_options = array('interior_style', 'onboard_luxury', 'media_capability', 'complimentary');
    foreach ($vehicle->field_defs as $field => $f_info) {
        if (!in_array($field, $fetch_list)) {
            continue;
        }
        if (isset($f_info['type']) && $f_info['type'] == 'currency' || $f_info['type'] == 'float') {
            $result[$field] = number_format($vehicle->$field, 2, '.', ',');
        } else {
            if (in_array($field, $multiselect_options)) {
                $rdata = str_replace('^', '', $vehicle->$field);
                $arryData = explode(',', $rdata);
                $result[$field] = $arryData;
            } else if ($field == 'images') {
                $result["vehicle_images"] = explode(',', $vehicle->$field);
            } else {
                $result[$field] = $vehicle->$field;
            }
        }
    }

    $rates_object = array();
    if ($vehicle->load_relationship('vnd_special_rates_vnd_vechiles')) {
        $relatedBeans = $vehicle->vnd_special_rates_vnd_vechiles->get();
        if ($relatedBeans) {
            foreach ($relatedBeans as $beanIndx) {
                $rslt = fetchSpecialRates($beanIndx);
                if ($rslt)
                    $rates_object[$beanIndx] = $rslt;
            }
        }
    }
    $result["vehicle_type"] = $vehicle->name;
    $result["vehicle_images"] = explode(',', $vehicle->images);
    $result["vehicle"] = $vehicle->id;
    $result['VEHICLESRATES'] = $rates_object; //'luggage_limit',
    $required_fields = array('vehicle_type', 'vehicle_year', 'vehicle_color', 'vehicle_capacity',  'vehicle_quantity', 'base_hourly_rate', 'base_min_hours');
    $missing_fields = array();
    foreach ($required_fields as $reqval) {
        if (!isset($result[$reqval]) || empty($result[$reqval]))
            $missing_fields[] = '"' . $reqval . '"';
    }
    if (!is_array($result['vehicle_images']) || count($result['vehicle_images']) <= 1)
        $missing_fields[] = '"vehicle_images"';
    $result['MissingFields'] = implode(",", $missing_fields);
    return $result;
}
function fetchSpecialRates($srate_id)
{
    $fetch_list = array('id', 'name', 'custom_rates', 'base_hourly_rate', 'base_additional_hourly', 'hourly_rate_monday', 'hourly_rate_tuesday', 'hourly_rate_wednesday', 'hourly_rate_thursday', 'hourly_rate_friday', 'hourly_rate_saturday', 'hourly_rate_sunday', 'additional_hourly_monday', 'additional_hourly_tuesday', 'additional_hourly_wednesday', 'additional_hourly_thursday', 'additional_hourly_friday', 'additional_hourly_saturday', 'additional_hourly_sunday', 'special_rate_start_from', 'special_rate_end_on', 'base_min_hours', 'min_hours_monday', 'min_hours_tuesday', 'min_hours_wednesday', 'min_hours_thursday', 'min_hours_friday', 'min_hours_saturday', 'min_hours_sunday', 'Special Rate');
    require_once './modules/VND_Special_Rates/VND_Special_Rates.php';
    $srates = new VND_Special_Rates();
    $srates->retrieve(trim($srate_id));
    $rates_object = array();
    foreach ($srates->field_defs as $fName => $fValue) {
        if (!in_array($fName, $fetch_list)) {
            continue;
        }
        $sr_value = $srates->$fName;
        if (isset($fValue['type']) && $fValue['type'] == 'currency' || $fValue['type'] == 'float') {
            $sr_value = number_format($sr_value, 2, '.', ',');
        }
        switch ($fName) {
            case 'id':
                $rates_object['special_rate'] = $sr_value;
                break;
            case 'name':
                $rates_object['name_special_rate'] = $sr_value;
                break;
            case 'special_rate_start_from':
                $rates_object['special_rate_start_from'] = $sr_value;
                break;
            case 'special_rate_end_on':
                $rates_object['special_rate_end_on'] = $sr_value;
                break;
            case 'base_hourly_rate':
                $rates_object['special_base_hourly_rate'] = $sr_value;
                break;
            case 'base_min_hours':
                $rates_object['special_base_min_hours'] = $sr_value;
                break;
            case 'base_additional_hourly':
                $rates_object['special_base_additional_hourly'] = $sr_value;
                break;
            case 'custom_rates':
                $rates_object['custom_special_rates'] = $sr_value;
                break;
            case 'hourly_rate_monday':
                $rates_object['special_hourly_rate_monday'] = $sr_value;
                break;
            case 'hourly_rate_tuesday':
                $rates_object['special_hourly_rate_tuesday'] = $sr_value;
                break;
            case 'hourly_rate_wednesday':
                $rates_object['special_hourly_rate_wednesday'] = $sr_value;
                break;
            case 'hourly_rate_thursday':
                $rates_object['special_hourly_rate_thursday'] = $sr_value;
                break;
            case 'hourly_rate_friday':
                $rates_object['special_hourly_rate_friday'] = $sr_value;
                break;
            case 'hourly_rate_saturday':
                $rates_object['special_hourly_rate_saturday'] = $sr_value;
                break;
            case 'hourly_rate_sunday':
                $rates_object['special_hourly_rate_sunday'] = $sr_value;
                break;
            case 'min_hours_monday':
                $rates_object['special_min_hours_monday'] = $sr_value;
                break;
            case 'min_hours_tuesday':
                $rates_object['special_min_hours_tuesday'] = $sr_value;
                break;
            case 'min_hours_wednesday':
                $rates_object['special_min_hours_wednesday'] = $sr_value;
                break;
            case 'min_hours_thursday':
                $rates_object['special_min_hours_thursday'] = $sr_value;
                break;
            case 'min_hours_friday':
                $rates_object['special_min_hours_friday'] = $sr_value;
                break;
            case 'min_hours_saturday':
                $rates_object['special_min_hours_saturday'] = $sr_value;
                break;
            case 'min_hours_sunday':
                $rates_object['special_min_hours_sunday'] = $sr_value;
                break;
            case 'additional_hourly_monday':
                $rates_object['special_additional_hourly_mon'] = $sr_value;
                break;
            case 'additional_hourly_tuesday':
                $rates_object['special_additional_hourly_tue'] = $sr_value;
                break;
            case 'additional_hourly_wednesday':
                $rates_object['special_additional_hourly_wed'] = $sr_value;
                break;
            case 'additional_hourly_thursday':
                $rates_object['special_additional_hourly_thu'] = $sr_value;
                break;
            case 'additional_hourly_friday':
                $rates_object['special_additional_hourly_fri'] = $sr_value;
                break;
            case 'additional_hourly_saturday':
                $rates_object['special_additional_hourly_sat'] = $sr_value;
                break;
            case 'additional_hourly_sunday':
                $rates_object['special_additional_hourly_sun'] = $sr_value;
                break;
            default:
                if (!is_array($sr_value) && !is_object($sr_value))
                    $rates_object[$fName] = $sr_value;
                break;
        }
    }
    return $rates_object;
}
// function fetchSingleLead($opportunity_id) {
//     $fetch_list = array('lead_source', 'first_name', 'last_name', 'opertunityid_c');
//     require_once './modules/Leads/Lead.php';
//     $lead = new Lead();

//     $result = array();
//     global $db;

// 	$sql = "SELECT leads.id, leads.first_name, leads.last_name,leads.phone_mobile,leads.department, leads_cstm.opertunityid_c, leads_cstm.quoted_c, leads_cstm.agreement_status_c, leads_cstm.vendor_confirmation_c, leads_cstm.duration_c, leads_cstm.distance_c, leads_cstm.eventdate_c FROM leads_cstm INNER JOIN leads ON leads.id=leads_cstm.id_c WHERE leads_cstm.opertunityid_c='".$opportunity_id."'";
// // 		$sql = "SELECT * FROM leads_cstm INNER JOIN leads ON leads.id=leads_cstm.id_c WHERE leads_cstm.opertunityid_c='".$opportunity_id."'";
// 	$sql_results = $db->query($sql);

// 	while ($lead = $db->fetchByAssoc($sql_results)) {
// 		$result[] = array(
// 		    'opertunityid_c' => $lead['opertunityid_c'],
// 		    'first_name' => $lead['first_name'],
// 		    'last_name' => $lead['last_name'],
// 		    'quoted_c' => $lead['quoted_c'],
// 		    'agreement_status_c' => $lead['agreement_status_c'],
// 		    'eventdate_c' => $lead['eventdate_c'],
// 		    'duration_c' => $lead['duration_c'],
// 		    'distance_c' => $lead['distance_c'],
// 		    'phone'=>$lead['phone_mobile'],
// 		    'event_c'=>$lead['event_c'],
// 		    'email1'=>$lead['email1'],
// 		  //  'all'=>$lead[],
// 		    'vendor_confirmation_c' => $lead['vendor_confirmation_c']
// 		);

// 		$sql1 = "SELECT * FROM lead_vnd_cstm WHERE lead_id='".$lead['id']."'";
// 		$sql_results1 = $db->query($sql1);
// 		while ($reply = $db->fetchByAssoc($sql_results1)) {
// 		    $result[count($result) - 1]['vreply'] = $reply['reply'];
// 		}
// 	}

//     return $result;
// }
function fetchSingleLead($opportunity_id)
{
    require_once './modules/Leads/Lead.php';
    $lead = new Lead();

    $result = array();
    global $db;

    $sql = "SELECT * FROM leads_cstm INNER JOIN leads ON leads.id=leads_cstm.id_c WHERE leads_cstm.opertunityid_c='" . $opportunity_id . "'";
    $sql_results = $db->query($sql);

    while ($lead = $db->fetchByAssoc($sql_results)) {
        $result[] = $lead; // Store the entire lead row directly

        $sql1 = "SELECT * FROM lead_vnd_cstm WHERE lead_id='" . $lead['id'] . "'";
        $sql_results1 = $db->query($sql1);
        while ($reply = $db->fetchByAssoc($sql_results1)) {
            $result[count($result) - 1]['vreply'] = $reply['reply'];
        }
    }

    return $result;
}
function updateSingleLead($lead_id, $fuel, $gratuity, $quoted_price, $mileage, $total_cost, $costperperson, $rate_c, $vechiles_name_c, $vehicle_type_c, $total_profit_c)
{
    require_once './modules/Leads/Lead.php';
    $lead = new Lead();

    global $db;
    $result = array();

    $sql = "UPDATE leads_cstm SET fuel_c = '" . $fuel . "', gratuity_c = '" . $gratuity . "' , quoted_c = '" . $quoted_price . "' , mileage_c = '" . $mileage . "' , total_trip_cost_c ='" . $total_cost . "' , costperperson_c = '" . $costperperson . "' , rate_c='" . $rate_c . "' , vechiles_name_c = '" . $vechiles_name_c . "' , vehicle_type_c = '" . $vehicle_type_c . "' , total_profit_c = '" . $total_profit_c . "' WHERE id_c = '" . $lead_id . "'";
    $sql_results = $db->query($sql);

    if ($sql_results) {
        $result['success'] = true;
        $result['message'] = "Lead updated successfully.";
    } else {
        $result['success'] = false;
        $result['message'] = "Failed to update lead.";
    }

    return $result;
}
function leadCharges()
{
    $ChargesPerMile = 0;
    $FuelSarcharge = 0;
    $Gratuity = 0;
    $Vendor_Percentage = 0;
    $configurator = new Configurator();
    $configurator->loadConfig();
    if (!empty($configurator->config['Lead_Charges']) && isset($configurator->config['Lead_Charges'])) {
        $ChargesPerMile = $configurator->config['Lead_Charges']['CHARGES_PER_MILE'];
        $FuelSarcharge = $configurator->config['Lead_Charges']['FUEL_SURCHARGE'];
        $Gratuity = $configurator->config['Lead_Charges']['GRATUITY'];
        $Vendor_Percentage = $configurator->config['Lead_Charges']['VENDOR_PERCENTAGE'];
    }

    // Create an array to hold the data
    $result = array(
        'ChargesPerMile' => $ChargesPerMile,
        'FuelSarcharge' => $FuelSarcharge,
        'Gratuity' => $Gratuity,
        'Vendor_Percentage' => $Vendor_Percentage,
        'message' => "Curl Is Working"
    );
    // $result['name'] = $test;

    return $result;
}
function fetchALLVndVehicles($vndid)
{
    global $db;
    $vehicles_object = array();

    // Query to select vehicle IDs associated with the vendor ID
    $sql2 = "SELECT vnd_vechiles_vnd_vendorsvnd_vechiles_idb FROM vnd_vechiles_vnd_vendors_c WHERE vnd_vechiles_vnd_vendorsvnd_vendors_ida = '" . $vndid . "'";
    $sql_results2 = $db->query($sql2);

    while ($vehicle_id_row = $db->fetchByAssoc($sql_results2)) {
        // Query to select vehicle details based on vehicle ID
        $sql3 = "SELECT * FROM vnd_vechiles WHERE id = '" . $vehicle_id_row['vnd_vechiles_vnd_vendorsvnd_vechiles_idb'] . "' AND deleted = 0";
        $sql_results3 = $db->query($sql3);

        // Fetching vehicle details
        $vehicle_details = $db->fetchByAssoc($sql_results3);

        // If data is fetched, store it in vehicles_object array
        if ($vehicle_details) {
            $vehicles_object[] = $vehicle_details;
        }
    }

    return $vehicles_object;
}
function updateSingleLeadStatus($lead_id, $status)
{
    require_once './modules/Leads/Lead.php';
    $lead = new Lead();

    global $db;
    $result = array();

    $sql = "UPDATE leads_cstm SET agreement_status_c = '" . $status . "' WHERE id_c = '" . $lead_id . "'";
    $sql_results = $db->query($sql);

    if ($sql_results) {
        $result['success'] = true;
        $result['message'] = "Lead Status updated successfully.";
    } else {
        $result['success'] = false;
        $result['message'] = "Failed to update lead.";
    }

    return $result;
}

// function addLeadQuote($lead_id , $vendor_id , $vehicle_id, $opportunity_id, $fuel, $gratuity, $quoted_price, $mileage, $total_cost, $costperperson , $rate_c ,  $vehicle_type_c , $total_profit_c , $vendor_email , $vendor_phone , $lead_type , $service_length )
// {
//     require_once './modules/Leads/Lead.php';
//     $lead = new Lead();

// // Function to generate a random hexadecimal key

//  $randomBytes = random_bytes(16);

//     // Convert random bytes to hexadecimal
//     $hexKey = bin2hex($randomBytes);


//     global $db;
//     $result = array();

//     // Prepare the SQL statement for insertion
//     $sql = "INSERT INTO lead_quote (q_id , lead_id, vendor_id, vehicle_id, opertunity_id, fuel_c, gratuity_c, quoted_c, mileage_c, total_trip_cost, costperperson_c, rate_c, vehicle_type_c, total_profit, vendor_email, vendor_phone, leadtype_c, servicelength_c, date_created) 
//             VALUES ('".$hexkEY."','".$lead_id."', '".$vendor_id."', '".$vehicle_id."', '".$opportunity_id."', '".$fuel."', '".$gratuity."', '".$quoted_price."', '".$mileage."', '".$total_cost."', '".$costperperson."', '".$rate_c."', '".$vehicle_type_c."', '".$total_profit_c."', '".$vendor_email."', '".$vendor_phone."', '".$lead_type."', '".$service_length."', NOW())";
//     // $sql = "INSERT INTO lead_quote (q_id,vendor_id,lead_id)
//     //         VALUES (123 , ".$vendor_id.",".$lead_id.")
//     //         ";
//     // Execute the SQL query
//     // $sql = "
//     // UPDATE lead_quote SET lead_id = ".$lead_id." WHERE q_id = 1
//     // ";
//     $sql_results = $db->query($sql);

//     if ($sql_results) {
//         $result['success'] = true;
//         $result['message'] = "Lead quote added successfully.";
//         // Include input parameters in the response
//         $result['lead_id'] = $lead_id;
//         $result['vendor_id'] = $vendor_id;
//         // $result['vehicle_id'] = $vehicle_id;
//         // $result['opportunity_id'] = $opportunity_id;
//         // $result['fuel'] = $fuel;
//         // $result['gratuity'] = $gratuity;
//         // $result['quoted_price'] = $quoted_price;
//         // $result['mileage'] = $mileage;
//         // $result['total_cost'] = $total_cost;
//         // $result['costperperson'] = $costperperson;
//         // $result['rate_c'] = $rate_c;
//         // $result['vehicle_type_c'] = $vehicle_type_c;
//         // $result['total_profit_c'] = $total_profit_c;
//         // $result['vendor_email'] = $vendor_email;
//         // $result['vendor_phone'] = $vendor_phone;
//         // $result['lead_type'] = $lead_type;
//         // $result['service_length'] = $service_length;
//     } else {
//         $result['success'] = false;
//          $result['lead_id'] = $lead_id;
//         $result['vendor_id'] = $vendor_id;
//         $result['message'] = "Failed to add lead quote.";
//     }

//     return $result;
// }
// function allQuotes()
// {
//     require_once './modules/Leads/Lead.php';
//     $lead = new Lead();

//     global $db;
//     $result = array();

//     // Prepare the SQL statement for selection
//     $sql = "SELECT * FROM lead_quote WHERE q_id = 1";

//     // Execute the SQL query
//     $sql_results = $db->query($sql);

//     if ($sql_results) {
//         // Fetch all rows using fetchByAssoc
//         $vechileid = $db->fetchByAssoc($sql_results);

//         // Check if any rows were found
//         if ($vechileid) {
//             $result['success'] = true;
//             $result['message'] = "Lead quotes fetched successfully.";
//             // Include the fetched data in the response
//             $result['quotes'] = $vechileid;
//         } else {
//             $result['success'] = false;
//             $result['message'] = "No lead quotes found.";
//         }
//     } else {
//         // Log SQL error
//         $errorInfo = $db->errorInfo();
//         $errorMessage = isset($errorInfo[2]) ? $errorInfo[2] : "Unknown database error";
//         error_log("Database error: $errorMessage");

//         $result['success'] = false;
//         $result['message'] = "Failed to fetch lead quotes.";
//     }

//     // Include $db and $lead in the response


//     return $result;
// }
// function testLeadQuote($lead_id, $vendor_id)
// {
//     // require_once './modules/Leads/Lead.php';
//     // $lead = new Lead();

//     global $db;
//     $result = array();
//      $result['lead_id'] = $lead_id;
//         $result['vendor_id'] = $vendor_id;
//     // if(isset($lead_id) && isset($vendor_id)){
// //     $sql = "INSERT INTO lead_quote (q_id , vendor_id , lead_id) VALUES ('12' , '".$vendor_id."' , '".$lead_id."')";

// //  $sql_results = $db->query($sql);
// //     if ($sql_results) {
// //         $result['success'] = true;
// //         $result['message'] = "Lead quote updated successfully.";
// //         // Include input parameters in the response
// //         $result['lead_id'] = $lead_id;
// //         $result['vendor_id'] = $vendor_id;
// //     } else {
// //         $result['success'] = false;
// //         $result['lead_id'] = $lead_id;
// //         $result['vendor_id'] = $vendor_id;
// //         $result['message'] = "Failed to update lead quote.";
// //     }
// // }else{
// //     result['error'] = "Value not found";
// // }
//     return $result;
// }
function allQuotes($lead_id, $vendor_id)
{
    require_once './modules/Leads/Lead.php';
    $lead = new Lead();

    global $db;
    $result = array();

    // Prepare the SQL statement for insertion
    $sql = "INSERT INTO lead_quote (q_id , lead_id, vendor_id) VALUES (43 ," . $lead_id . ", " . $vendor_id . ")";

    // Prepare the SQL query
    $sql_results = $db->query($sql);
    // $stmt->bindParam(':lead_id', $lead_id, PDO::PARAM_INT);
    // $stmt->bindParam(':vendor_id', $vendor_id, PDO::PARAM_INT);

    // // Execute the SQL query
    // $sql_results = $stmt->execute();

    if ($sql_results) {
        $result['success'] = true;
        $result['message'] = "New lead quote added successfully.";
        // Include input parameters in the response
        $result['lead_id'] = $lead_id;
        $result['vendor_id'] = $vendor_id;
    } else {
        $result['success'] = false;
        $result['lead_id'] = $lead_id;
        $result['vendor_id'] = $vendor_id;
        $result['sqlResult'] = $sql_results;
        $result['message'] = "Failed to add new lead quote.";
    }

    return $result;
}

// function xeno($id , $name){
//     global $db;
//     $result = array();

//     $sql = "INSERT INTO xeno (id , name) VALUES (".$id." , ".$name.")";

//       $sql_results = $db->query($sql);
//       if ($sql_results) {
//         $result['success'] = true;
//         $result['message'] = "New lead quote added successfully.";

//     } else {
//         $result['success'] = false;

//         $result['message'] = "Failed to add new lead quote.";
//     }

//     return $result;
// }
// function xeno($id, $name) {
//     global $db;
//     $result = array();

//     // Check if the database connection is successful
//     if (!$db) {
//         $result['success'] = false;
//         $result['message'] = "Failed to connect to the database.";
//         return $result; // Return early if the database connection fails
//     }

//     // Prepare the SQL statement for insertion
//      $sql = "INSERT INTO xeno (id , name) VALUES (".$id." , '".$name."')";
//     // $sql = "SELECT * FROM xeno";
//     // $sql = "UPDATE xeno SET name='".$name."' WHERE id=123";

//       $sql_results = $db->query($sql);

//     if ($sql_results) {
//         //   $data = $db->fetchByAssoc($sql_results);
//         $result['success'] = true;
//         $result['message'] = "New record added successfully.";
//         $result['data'] =$data;
//     } else {
//         $result['success'] = false;
//         $result['message'] = "Failed to add new record.";
//     }

//     return $result;
// }


// function addLeadQuote($lead_id , $vendor_id , $vehicle_id, $opportunity_id, $fuel, $gratuity, $quoted_price, $mileage, $total_cost, $costperperson , $rate_c ,  $vehicle_type_c , $total_profit_c , $vendor_email , $vendor_phone , $lead_type , $service_length )
// {
//     require_once './modules/Leads/Lead.php';
//     $lead = new Lead();

//     // Function to generate a random hexadecimal key
//     $randomBytes = random_bytes(16);

//     // Convert random bytes to hexadecimal
//     $hexKey = bin2hex($randomBytes);

//     global $db;
//     $result = array();

//     // Prepare the SQL statement for insertion
//     $sql = "INSERT INTO lead_quote (q_id, vendor_id, lead_id,  vehicle_id, opertunity_id,servicelength_c, rate_c, fuel_c, gratuity_c, quoted_c,vehicle_type_c, distance_c,total_trip_cost,vendor_trip_cost,  costperperson_c,  total_profit, vendor_email, vendor_phone, leadtype_c,  date_created , mileage_c) 
//             VALUES ('".$hexKey."','".$vendor_id."', '".$lead_id."', '".$vehicle_id."', '".$opertunity_id."','".$service_length."','".$rate_c."', '".$fuel."', '".$gratuity."', '".$quoted_price."','".$vehicle_type_c."','none',  '".$total_cost."','none', '".$costperperson."',   '".$total_profit_c."', '".$vendor_email."', '".$vendor_phone."', '".$lead_type."',  NOW() , '".$mileage."')";

//     // Execute the SQL query
//     $sql_results = $db->query($sql);

//     if ($sql_results) {
//         $result['success'] = true;
//         $result['message'] = "Lead quote added successfully.";
//         // Include input parameters in the response
//         $result['lead_id'] = $lead_id;
//         $result['vendor_id'] = $vendor_id;
//     } else {
//         $result['success'] = false;
//         $result['lead_id'] = $lead_id;
//         $result['vendor_id'] = $vendor_id;
//         $result['message'] = "Failed to add lead quote.";
//     }

//     return $result;
// }


// function xeno($id, $name) {
//     global $db;
//     $result = array();

//     // Check if the database connection is successful
//     if (!$db) {
//         $result['success'] = false;
//         $result['message'] = "Failed to connect to the database.";
//         return $result; // Return early if the database connection fails
//     }

//     // Prepare the SQL statement for insertion
//      $sql = "INSERT INTO lead_quote (q_id , vendor_id) VALUES (".$id." , '".$name."')";
//     // $sql = "SELECT * FROM xeno";
//     // $sql = "UPDATE xeno SET name='".$name."' WHERE id=123";

//       $sql_results = $db->query($sql);

//     if ($sql_results) {
//         //   $data = $db->fetchByAssoc($sql_results);
//         $result['success'] = true;
//         $result['message'] = "New record added successfully.";
//         $result['data'] =$data;
//     } else {
//         $result['success'] = false;
//         $result['message'] = "Failed to add new record.";
//     }

//     return $result;
// }

function loginVendorNew($email, $password)
{
    global $db;
    $result = array();

    $result['uersname'] = $email;
    $result['password'] = $password;

    // Prepare the SQL statement for insertion
    $sql = "SELECT * FROM vnd_vendors WHERE username = '" . $email . "' AND password = '" . $password . "'";
    // $sql = "SELECT * FROM xeno";
    // $sql = "UPDATE xeno SET name='".$name."' WHERE id=123";

    $sql_results = $db->query($sql);

    if ($sql_results) {
        $data = $db->fetchByAssoc($sql_results);
        $result['success'] = true;
        $result['message'] = "Found";
        $result['data'] = $data;
    } else {
        $result['success'] = false;
        $result['message'] = "Not Found";
    }

    return $result;
}

function vendor_cstm($vndid)
{
    global $db;
    $result = array();


    $sql = "SELECT * FROM vnd_vendors_cstm WHERE id_c = '" . $vndid . "' ";


    $sql_results = $db->query($sql);

    if ($sql_results) {
        $data = $db->fetchByAssoc($sql_results);
        $result['success'] = true;
        $result['message'] = "Found";
        $result['data'] = $data;
    } else {
        $result['success'] = false;
        $result['message'] = "Not Found";
    }

    return $result;
}


// function addNewQuote($vendor_id , $lead_id  , $quoted_c , $vehicle_c   , $vendor_notes_c){
//     $results= array();
//     $lead = BeanFactory::getBean('Leads', $lead_id);

// if($lead->id == '') {
// 	echo "Lead not valid";
// 	die;
// }
// $vendor = BeanFactory::getBean('VND_Vendors', $vendor_id);

// if($vendor->id == '') {
// 	echo "Vendor not valid";
// 	die;
// }
//     $total_trip_cost_c = (int) $lead->total_trip_cost_c;

// $bean = BeanFactory::newBean('tnv_VendorQuote');
// $bean->name = $vendor->name .' - ' . $lead->name . ' - ' . $lead->pickuptime_c;
// $bean->leads_tnv_vendorquote_1leads_ida = $lead->id;
// $bean->vnd_vendors_tnv_vendorquote_1vnd_vendors_ida = $vendor->id;
// $bean->vendor_email_c = $vendor->email1;
// $bean->vendor_phone_c = (empty($vendor->phone_alternate)) ? $vendor->phone_office : $vendor->phone_alternate;
// $bean->quoted_price_c = sprintf('%0.2f', $_REQUEST['quoted_price_c']); 
// $bean->vehicle_c = $_REQUEST['vehicle_c'];
// $bean->vendor_notes_c = $_REQUEST['vendor_notes_c'];
// $bean->prioritize_c = $_REQUEST['prioritize_c'];
// $bean->save();
// if($lead->status != 'Converted') {
// 	$vendor_quotes_count = 0;
// 	if ($lead->load_relationship('leads_tnv_vendorquote_1')) {
// 		$vendor_quotes = $lead->leads_tnv_vendorquote_1->getBeans();
// 		$vendor_quotes_count = sizeof($vendor_quotes);
// 		if(!empty($lead->vnd_vendors_id_c) && $vendor_quotes_count==1){
// 			foreach ($vendor_quotes as $vendor_quote) {
// 				$gtotal = (int) $total_trip_cost_c - (int) $vendor_quote->quoted_price_c;
// 				$lead->total_profit_c = $gtotal;
// 				$lead->vendor_trip_cost_c = (int) $vendor_quote->quoted_price_c;
// 				$lead->vendor_email_c = $vendor_quote->vendor_email_c;
// 				$lead->vendor_phone_c = $vendor_quote->vendor_phone_c;
// 				$lead->processed = true;
// 				$lead->save();
// 			}
// 		}
// 		elseif(!empty($lead->vnd_vendors_id_c) && $vendor_quotes_count==0){
// 			$gtotal = (int) $total_trip_cost_c - (int) $vendor_trip_cost_c;
// 			$lead->total_profit_c = $gtotal;
// 			$lead->vendor_trip_cost_c = (int) $vendor_trip_cost_c;
// 			$lead->vendor_email_c = $vendor_email_c;
// 			$lead->vendor_phone_c = $vendor_phone_c;
// 			$sql = "UPDATE leads left join leads_cstm on id= id_c set total_profit_c='" . $gtotal . "', vendor_trip_cost_c = '" . $vendor_trip_cost_c . "', vendor_email_c='".$vendor_email_c."', vendor_phone_c='" .$vendor_phone_c. "'  where id = '" . $lead->id . "'";
// 			$result = $db->query($sql);
// 		} 
// 		elseif($vendor_quotes_count > 1){
// 			$lead_vendor_selection_strategy = $lead->lowest_quote_strategy_c;
// 			$lowest_quote_id_simple = get_lowest_quote_vendor_id($lead->id); 
// 			$lowest_quote_id_priortize = get_priortized_lowest_quote_vendor_id($lead->id);
// 			$lowest_quote_id = (!empty($lowest_quote_id_priortize)) ? $lowest_quote_id_priortize : $lowest_quote_id_simple;
// 			$lowest_quote = BeanFactory::getBean('tnv_VendorQuote', $lowest_quote_id);
// 			$gtotal = (int) $total_trip_cost_c - (int) $lowest_quote->quoted_price_c;
// 			$lead->total_profit_c = $gtotal;
// 			$lead->vendor_trip_cost_c = (int) $lowest_quote->quoted_price_c;
// 			$lead->vendor_email_c = $lowest_quote->vendor_email_c;
// 			$lead->vendor_phone_c = $lowest_quote->vendor_phone_c;
// 			$lead->vnd_vendors_id_c = $lowest_quote->vnd_vendors_tnv_vendorquote_1vnd_vendors_ida; 
// 			$lead->processed = true;
// 			$lead->save(); 
// 		}else{
// 			$lead->vendor_trip_cost_c = $_REQUEST['quoted_price_c'];
// 			$lead->vnd_vendors_id_c = $_REQUEST['vendor_id'];
// 			$lead->vendor_phone_c = (empty($vendor->phone_alternate)) ? $vendor->phone_office : $vendor->phone_alternate;
// 			$lead->vendor_email_c = $vendor->email1;
// 			$lead->save();
// 		}
// 	}

// }
// $results['status'] = "Quoted Successfully";
// return $results;
// }
