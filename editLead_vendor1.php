<?php
$page = 'dashboard';
require_once './config.php';
require_once './session.php';
require_once './header.php';
require_once './header_nav.php';

$opertunityid_c = $_GET['opertunityid_c'];


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
// print_r($opportunities);


// Your array
// echo "<br/>";
// echo "<br/>";
$vehicle_name = $opportunities[0]['vehicle_type_c'];
// echo $vehicle_name;
if (strpos($vehicle_name, "^") !== false) {
    // echo "String contains '^'";
    $vehicle_name = str_replace("^", "", $vehicle_name);
}
// Loop through the array and echo each key-value pair
// print_r($opportunities[0]['phone']);

$data["vndid"] = $opportunities[0]['vnd_vendors_id_c'];
$data["method"] = "fetchVndVechiles";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$result_data = json_decode($response, true);

// echo "</br>";
// echo "</br>";
// print_r($result_data);
// echo "</br>";
$vehicleData = $result_data;
// echo "</br>";
// print_r($vehicleData);
//  echo $vehicleData[$opportunities[0]['vnd_vendors_id_C']]['name'];
// foreach ($vehicleData as $key => $value) {
//     echo $key;
//     $vehicle[$key] = $value['name'];
//     echo $vehicle[$key];
//     // echo ' <option value="'..'" data-pg-name="Select a Vechicle" class="bg-yellow-200">Select or Add a Vechicle</option>';
// }

$data["vehicle_id"] = $opportunities[0]['vnd_vechiles_id_c'];
$data["method"] = "fetchVehicle";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$result_data = json_decode($response, true);

// print_r($result_data);
$single_vehicle_data = $result_data;
// print_r($single_vehicle_data);
// foreach ($vehicleData as $key => $value) {
//     print_r($value);
//     $vehicle[$key] = $value['name'];
//     if (
//         isset($opportunities[0]['vechiles_name_c']) && isset($vehicle[$key]) && $opportunities[0]['vechiles_name_c'] == $vehicle[$key]
//     ) {



//         break;
//     } else {

//         // break;
//     }
// }
// echo "</br>";
// echo "Xeno";
$data["method"] = "leadCharges";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$leadCharges = json_decode($response, true);
?>

<style>
    h2 {
        font-size: 16px !important;
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" !important;

    }

    .f36 {
        font-size: 36px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
    }

    .f20 {
        font-size: 20px !important;
        font-weight: lighter !important;
    }

    .text-gray-400 {
        color: rgb(156 163 175 / var(--tw-text-opacity)) !important;
    }

    .titleSize {
        font-size: 2.875rem !important;
    }

    .f14 {
        font-size: 14px !important;
    }

    .pd-5 {
        padding: 5px !important;
    }

    .bd-1 {
        border: 1px solid #000 !important;
    }

    .bd-2 {
        border: 2px solid #000 !important;
    }

    .anv {
        padding: 10px 20px !important;
        border: 2px solid #000;
        color: #000;
    }

    .text-LogoBlue-500 {
        color: rgb(101 213 226 / var(--tw-text-opacity)) !important;
    }

    .f24 {
        font-size: 24px !important;
    }

    .f30 {
        font-size: 30px !important;
    }

    .text-yellow-500 {
        color: rgb(245 158 11 / var(--tw-text-opacity)) !important;
    }

    .bg-yellow-100 {
        background-color: rgb(254 243 199 / var(--tw-bg-opacity)) !important;
    }

    .f18 {
        font-size: 18px !important;
        font-weight: 700 !important;
    }

    .p10-20 {
        padding: 10px 20px !important;
    }

    .newPricing::placeholder {
        color: gray !important;
        font-weight: 400 !important;
    }

    .f400 {
        font-weight: 400 !important;
    }

    .imgDiv {
        max-height: 400px;
        border-radius: 10px;
        overflow: hidden;
    }

    .imgDiv>img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        max-height: 400px;
    }

    .selectedItem {
        color: #000;
        background: rgb(101 213 226 / var(--tw-text-opacity)) !important;
    }

    .imgDivMain {
        max-height: 400px;
        max-width: 100%;
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding-bottom: 10px;
    }

    .imgDivMain>img {
        /* max-width: 150px; */
        max-height: 130px;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover;
    }

    .px48 {
        padding: 0px 48px !important;
    }

    #ipt_fsqm_form_wrap_56>div.border-2.my-10.shadow-2xl.text-left.row.w-100.mx-0>div.row.col-md-6>h2 {
        margin: 10px 0px;
    }
</style>

<div class="container h-auto mt-8 mx-auto pt-8 px-4 shadow-2xl">
    <div class="-mx-4 flex flex-wrap">
        <h1 class="fw-bolder me-auto ms-auto mb-5 text-primary text-center text-start text-uppercase  f36">TRIP DETAILS</h1>
        <div class="pl-0 text-left w-full flex row">
            <div class=" col-md-3">
                <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Event Date :&nbsp;<span style="font-weight: 400;"><?php echo $opportunities[0]['eventdate_c'] ?></span></h2>
                <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Event Type :&nbsp;<span style="font-weight: 400;"><?php echo $opportunities[0]['eventtype_c'] ?></span></h2>
                <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Pickup Time : <span style="font-weight: 400;"><?php echo $opportunities[0]['pickuptime_c'] ?></span></h2>
                <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Hours : <span style="font-weight: 400;"><?php echo $opportunities[0]['servicelength_c'] ?> Hours</span></h2>
            </div>
            <div class="  col-md-3">
                <div class=" mx-auto w-10/12">
                    <h2 class="font-bold wsnw pt-6 text-gray-400 mt-0">Pickup :&nbsp;<span style="font-weight: 400;"><?php echo $opportunities[0]['pickuplocation_c'] ?></span></h2>
                    <h2 class="font-bold wsnw pt-6 text-gray-400 mt-0">Destination :&nbsp;<span style="font-weight: 400;"><?php echo $opportunities[0]['location_c'] ?></span></h2>
                    <h2 class="font-bold  pt-6 text-gray-400 mt-0">Client Itinerary : <span style="font-weight: 400;"><?php echo $opportunities[0]['clientnotes_c'] ?></span></h2>
                    <h2 class="font-bold  pt-6 text-gray-400 mt-0">Passenger Count : <span style="font-weight: 400;"><?php echo $opportunities[0]['numberofpassengers_c'] ?></span><br><br><br></h2>


                </div>

            </div>
            <div class="col-md-6 d-flex">
                <div class="cont w-50">

                    <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Vehicle Type :&nbsp;&nbsp;<span id="vehicleType" style="font-weight: 600;"><?php echo $single_vehicle_data['name']; ?></span></h2>
                    <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Vehicle Year :&nbsp; &nbsp;<span id="vehicleYear" style="font-weight: 600;"><?php echo $single_vehicle_data['vehicle_year'] ?></span></h2>
                    <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Vehicle Make :&nbsp;&nbsp;<span id="vehicleMake" style="font-weight: 600;"><?php echo $single_vehicle_data['vehicle_make'] ?></span></h2>
                    <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Vehicle Model :&nbsp;&nbsp;<span id="vehicleModel" style="font-weight: 600;"><?php echo $single_vehicle_data['vehicle_model'] ?></span></h2>
                </div>
                <div class="imgDivMain w-50">
                    <?php

                    $images = explode(',', $single_vehicle_data['images']);
                    // print_r($value['images']);
                    $i = 1;

                    while ($i <= 2) {
                        // Assuming $firstImage contains the image filename
                        if ($images[$i])
                            echo '<img src="./vehicles/' . $images[$i] . '" class="h-auto mx-auto w-auto">';
                        // Exit the loop after displaying the image
                        $i++;
                    }

                    // foreach ($vehicleData as $key => $value) {
                    //     $vehicle[$key] = $value['name'];
                    //     if (isset($opportunities[0]['vechiles_name_c']) && isset($vehicle[$key]) && $opportunities[0]['vechiles_name_c'] == $vehicle[$key]) {
                    //         // Split images by comma and select the first image


                    //         break;
                    //     } else {
                    //         // break;
                    //     }
                    // }

                    ?>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="flex flex-no-wrap items-center max-w-screen-2xl mx-auto pb-0 pt-10">
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
    <div class="px-10 w-auto">
        <h2 class="font-semibold text-2xl uppercase f36"><b class="text-4xl text-LogoGold-500 text-dfca8b-500 f36">Client Route</b></h2>
    </div>
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
</div>
<div class="container mt-10 mx-auto px-4 shadow-2xl">
    <div>
        <h2 class="font-normal text-center text-xl uppercase f20" style="font-weight:400!important;">Client is looking to book the vehicle for the following route.</h2>
    </div>
    <div class="-mx-4 flex flex-wrap pt-10 row px48" style="height: 350px;">
        <div class="px-4 w-full sm:w-1 h-100">
            <div class="mapouter">
                <?php

                $first_city = $opportunities[0]['pickuplocation_c'];
                $second_city = $opportunities[0]['location_c'];
                // echo $first_city;
                // Split the string by comma and space
                $words = explode(", ", $first_city);
                $words2 = explode(", ", $second_city);

                // Extract the first word
                $first_word = $words[0] . "," . $words[1];
                $second_word = $words2[0] . "," . $words2[1];

                // echo $first_word;

                ?>


                <div class="gmap_canvas"><iframe width="100%" height="340" id="gmap_canvas" src="<?php echo 'https://maps.google.com/maps?q=' . $first_word . 'to=' . $second_word . '&t=&z=10&ie=UTF8&iwloc=&output=embed'; ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.analarmclock.com/"></a><br><a href="https://www.onclock.net/"></a><br>
                    <style>
                        .mapouter {
                            position: relative;
                            text-align: right;
                            height: 90%;
                            width: 100%;
                            border-radius: 10px;
                            max-height: 400px;
                        }
                    </style>

                    <style>
                        .gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            height: 100%;
                            width: 100%;
                            border-radius: 10px;
                        }
                    </style>
                </div>
            </div>
            <div class="mt-1">
                <div class="container mx-auto px-4">
                    <div class="-mx-4 flex flex-wrap text-center">
                        <div class="px-4 w-full md:w-1/2">
                            <p>Distance :&nbsp;<?php echo $opportunities[0]['distance_c'] ?></p>
                        </div>
                        <div class="px-4 w-full md:w-1/2">
                            <p>Duration :&nbsp;<?php echo $opportunities[0]['duration_c'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>
<div class="flex flex-no-wrap items-center max-w-screen-2xl mx-auto pb-4 pt-10">
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
    <div class="px-10 w-auto">
        <h2 class="font-semibold text-2xl uppercase"><b class="text-4xl text-LogoGold-500 text-dfca8b-500 f36">Pricing</b></h2>
    </div>
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
</div>
<div class="border-2  my-10 shadow-2xl text-left row w-100 mx-0">
    <div class="px-4 col-md-6" style="border-right:2px solid #E5E7EB; border-left:2px solid #E5E7EB">

        <div class=" text-center h-100 w-100 d-flex align-items-center justify-content-start flex-column">
            <p class="font-extrabold leading-loose text-4xl text-LogoGold-500 text-center uppercase f30 mx-auto pt-6" style="font-weight:800!important;">Update the total trip cost.</p>
            <form method="POST" action="./updateLead1.php" id="vehicleForm" class="w-100">
                <input type="hidden" name="lead_id" value="<?php echo $opportunities[0]['id_c']; ?>">
                <input type="hidden" name="sent_lead_count" value="<?php echo $opportunities[0]['sent_lead_count']; ?>">
                <input type="hidden" name="sent_quote_id" value="<?php echo $opportunities[0]['sent_quote_id_c']; ?>">
                <input type="hidden" name="lead_name" value="<?php echo $opportunities[0]['first_name'] . " " . $opportunities[0]['last_name']; ?>">
                <input type="hidden" name="lead_mobile" value="<?php echo $opportunities[0]['phone_mobile']; ?>">
                <input type="hidden" name="lead_eventdate" value="<?php echo $opportunities[0]['eventdate_c']; ?>">
                <input type="hidden" name="lead_eventtype" value="<?php echo $opportunities[0]['eventtype_c']; ?>">
                <input type="hidden" name="lead_pickuptime" value="<?php echo $opportunities[0]['pickuptime_c']; ?>">
                <input type="hidden" name="lead_pickuplocation" value="<?php echo $opportunities[0]['pickuplocation_c']; ?>">
                <input type="hidden" name="lead_location" value="<?php echo $opportunities[0]['location_c']; ?>">


                <input type="hidden" name="vendor_id" value="<?php echo $opportunities[0]['vnd_vendors_id_c']; ?>">
                <input type="hidden" name="vehicle_type_c" value="<?php echo $opportunities[0]['vehicle_type_c']; ?>">
                <input type="hidden" name="vendor_email_c" value="<?php echo $opportunities[0]['vendor_email_c']; ?>">
                <input type="hidden" name="vendor_phone_c" value="<?php echo $opportunities[0]['vendor_phone_c']; ?>">
                <input type="hidden" name="rate_c" value="<?php echo $opportunities[0]['rate_c']; ?>">

                <input type="hidden" name="leadtype_c" value="<?php echo $opportunities[0]['leadtype_c']; ?>">
                <input type="hidden" name="opertunity_id" value="<?php echo $opertunityid_c; ?>">
                <!-- <input type="hidden" name="quoted_price" value="<?php echo $opportunities[0]['quoted_c']; ?>" > -->
                <input type="hidden" name="distance" value="<?php echo $opportunities[0]['distance_c']; ?>">
                <input type="hidden" name="passengerCount" value="<?php echo $opportunities[0]['numberofpassengers_c']; ?>">
                <input type="hidden" name="distanceTime" value="<?php echo $opportunities[0]['servicelength_c']; ?>">


                <select name="SelectVehicle" id="SelectVehicle" class="w-3/5 bd-1" multiple="multiple">
                    <!-- <option value="SelectVehicle" class="bg-yellow-200 f14 pd-5">Select or Add a Vehicle</option> -->
                    <?php

                    echo "xeno";

                    foreach ($vehicleData as $key => $vehicle) {
                        // Initialize $check for each iteration
                        $check = '';
                        if (
                            isset($vehicle['name']) && !empty($vehicle['name']) && strcasecmp($vehicle['name'], $vehicle_name) === 0
                        ) {
                            // Code here
                            $check = "selectedItem";
                        }
                        // print_r($vehicle);
                        // Check if the vehicle has a name
                        // if ($vehicle['name'] == $vehicle_name) {
                        //     $check = "text-light";
                        // }

                        // Check if the vehicle has a name and is not empty
                        if (isset($vehicle['name']) && !empty($vehicle['name'])) {
                            // Output the <option> element with the appropriate class

                            echo '<option value="' . $key . '" data-pg-name="' . $vehicle['name'] . '"  data-base-hourly-rate="' . $vehicle['base_hourly_rate'] . '"  
                            data-vehicle-make="' . $vehicle['vehicle_make'] . '" data-vehicle-year="' . $vehicle['vehicle_year'] . '" data-vehicle-model="' . $vehicle['vehicle_model'] . '" 
                            class="bg-yellow-200 f14 pd-5 ' . $check . '" id="chooseVehicle">' . $vehicle['name'] . '</option></a>';
                        }
                    }


                    ?>
                </select>

            </form>
            <div class="d-flex justify-content-center align-items-center flex-column gap-1 ">
                <a href="./addVehical.php">
                    <button class=" bg-yellow-50 border-2 border-gray-900 italic mt-5 px-5 shadow-gray-600 shadow-md text-lg uppercase anv f16" type="submit" name="add_new_vehicle">Add New Vehicle</button>
                </a>
                <?php if ($opportunities[0]['status'] == "New") { ?>
                    <button class="animate-bounce bg-65d5e2-500 bg-LogoGold-500 border-2 border-65d5e2-500 border-gray-500 font-extrabold leading-normal mt-5 mx-auto px-10 py-2 rounded-full shadow-gray-500 shadow-md text-3xl text-center text-gray-50 uppercase f30 hidden" type="button" id="updatePriceBTN">Update Price</button></a>
                <?php } ?>

            </div>

        </div>

    </div>
    <div class="row col-md-6">
        <!-- <div class="col-md-6" style="border-right:2px solid #E5E7EB; border-left:2px solid #E5E7EB">
            <h2 class="font-bold mx-auto pt-6 text-2xl text-LogoBlue-500 text-center uppercase f30">Pre-Quoted Price</h2>
            <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24">Hourly Rate @ $<?php  //echo $opportunities[0]['rate_c'] 
                                                                                                        ?> Per Hour</h2>
            <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24">+ Fuel : <span style="font-weight: 600;">$<?php // echo $opportunities[0]['fuel_c'] 
                                                                                                                                ?></span></h2>
            <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24">+ Mileage : <span style="font-weight: 600;">$<?php  //echo $opportunities[0]['mileage_c'] 
                                                                                                                                    ?></span></h2>
            <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24">+ Gratuity : <span style="font-weight: 600;">$<?php  //echo $opportunities[0]['gratuity_c'] 
                                                                                                                                    ?></span></h2>
            <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-900 f24">Subtotal :&nbsp;<span style="font-weight: 600;">$<?php  //echo $opportunities[0]['quoted_c'] 
                                                                                                                                        ?></span></h2>
            <h2 class="font-extrabold mx-auto pt-6 text-3xl text-65d5e2-500 text-LogoBlue-500 text-center f24">TOTAL TRIP COST </br /> <span style="font-weight: 600;">$<?php // echo $opportunities[0]['total_trip_cost_c'] 
                                                                                                                                                                        ?></span><br><br><br></h2>
        </div> -->
        <!-- <div class="col-md-6"> -->
        <h2 class="font-bold mx-auto pt-6 text-2xl text-LogoBlue-500 text-center uppercase f30"><span id="vehicleName" class="font-bold"><?php echo $opportunities[0]['vehicle_type_c']
                                                                                                                                            ?></span></h2>
        <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24">Hourly Rate @ $<span id="perHourRate" class="font-bold"><?php echo $opportunities[0]['rate_c']
                                                                                                                                            ?></span> Per Hour</h2>
        <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24">+ Fuel : <span style="font-weight: 600;">$</span><span id="fuel" style="font-weight: 600;"><?php echo $opportunities[0]['fuel_c']
                                                                                                                                                                                ?></span></h2>
        <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24">+ Mileage : <span style="font-weight: 600;">$</span><span id="mileage" style="font-weight: 600;"><?php echo $opportunities[0]['mileage_c']
                                                                                                                                                                                    ?></span></h2>
        <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24">+ Gratuity : <span style="font-weight: 600;">$</span><span id="gratuity" style="font-weight: 600;"><?php echo $opportunities[0]['gratuity_c']
                                                                                                                                                                                        ?></span></h2>
        <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-900 f24">Subtotal :&nbsp;<span style="font-weight: 600;">$</span><span id="subtotal" style="font-weight: 600;"><?php echo $opportunities[0]['quoted_c']
                                                                                                                                                                                        ?></span></h2>
        <h2 class="font-extrabold mx-auto pt-6 text-3xl text-65d5e2-500 text-LogoBlue-500 text-center f24">TOTAL TRIP COST </br> <span style="font-weight: 600;">$</span><span id="totalPrice" style="font-weight: 600;"><?php echo $opportunities[0]['total_trip_cost_c']
                                                                                                                                                                                                                            ?></span><br><br><br></h2>
        <!-- </div> -->
    </div>
</div>

<section class=" pb-20 pt-20 text-gray-500">
    <div class="font-normal mx-auto px-10 text-center w-10/12">
        <?php if ($opportunities[0]['status'] == "New") { ?>
            <p class="font-extrabold leading-loose text-4xl text-LogoBlue-500 text-center uppercase f36" style="font-weight:800!important;">CLICK THE "SEND AS IS" BUTTON</p>
            <a href="<?php echo "./leadStatus.php?status=1&lead_id=" . $opportunities[0]['id_c'] . ""; ?>
">
                <a href="./sendAsIs.php?lead_id=<?php echo $opportunities[0]['id_c']; ?>&lead_opertunityid_c=<?php echo $opertunityid_c; ?>&vendor_id=<?php echo $opportunities[0]['vnd_vendors_id_c']; ?>&quoted_c=<?php echo $opportunities[0]['quoted_c']; ?>&vehicle_id=<?php echo $opportunities[0]['vnd_vechiles_id_c']; ?>&vehicle_name=<?php echo $opportunities[0]['vechiles_name_c']; ?>&distance=<?php echo $opportunities[0]['distance_c']; ?>" class="inline-block  animate-bounce bg-65d5e2-500 bg-LogoGold-500 border-2 border-65d5e2-500 border-gray-500 font-extrabold leading-normal mt-5 mx-auto px-10 py-2 rounded-full shadow-gray-500 shadow-md text-3xl text-center text-white uppercase f30" name="Reserve Now" type="button">Send As Is</a></a>
            <p class="font-extrabold leading-loose mt-10 text-2xl text-center f30">or</p>

            <!-- <p class="font-extrabold leading-loose mt-14 text-2xl text-center f24">or</p> -->
            <p class="font-extrabold leading-loose text-4xl text-center uppercase f36">Click "Not Available"</p>
            <div class="text-4xl">
                <a href="<?php echo "./leadStatus.php?opertunity_id=" . $opertunityid_c . "&lead_id=" . $opportunities[0]['id_c'] . ""; ?>"><button class="bg-red-600 border-2 border-gray-900 font-extrabold leading-normal mt-5 mx-auto px-10 rounded-full shadow-gray-600 shadow-lg text-3xl text-center text-gray-50 uppercase f36 bd-2" name="No Availability">Not Available</button></a>
            </div>
        <?php } ?>
        <br>
        <p class="font-medium leading-loose text-4xl text-center"></p>
        <p class="font-normal italic leading-loose text-4xl text-center f30 f400">&nbsp;If you have any questions, feel free reply to this email.&nbsp;</p>
        <p class="font-light leading-loose text-4xl text-center f30 f400">Or Call Us - 855.943.1466</p><br>
    </div>
</section>


<script>
    let perHourRate = document.getElementById('perHourRate');
    let chooseVehicle = document.getElementById('SelectVehicle');
    let fuel = document.getElementById('fuel');
    let vehicleName = document.getElementById('vehicleName');
    let vehicleType = document.getElementById('vehicleType');
    let vehicleYear = document.getElementById('vehicleYear');
    let vehicleMake = document.getElementById('vehicleMake');
    let vehicleModel = document.getElementById('vehicleModel');
    let mileage = document.getElementById('mileage');
    let gratuity = document.getElementById('gratuity');
    let subtotal = document.getElementById('subtotal');
    let totalPrice = document.getElementById('totalPrice');
    let leadCharges = <?php echo json_encode($leadCharges);  ?>
    // let distanceTime = <?php echo json_encode($opportunities[0]['servicelength_c']);  ?>;
    let distance = <?php echo json_encode($opportunities[0]['distance_c']);  ?>;
    let updatePrice = document.getElementById('updatePriceBTN');
    // console.log(distanceTime);
    distance = distance.match(/\d+\.\d+/)[0];


    //     // Calculations For Charges
    let fuelCharge = leadCharges.FuelSarcharge / 100;
    let gratuityCharge = leadCharges.Gratuity / 100;
    let trip_Mileage = distance * 2 * leadCharges.ChargesPerMile;


    // console.log(fuelCharge)



    // console.log(perHourRate);


    chooseVehicle.addEventListener('change', function() {
        let baseHourlyRate = chooseVehicle.options[chooseVehicle.selectedIndex].getAttribute('data-base-hourly-rate');
        let vehicleNameVal = chooseVehicle.options[chooseVehicle.selectedIndex].getAttribute('data-pg-name');
        let dataVehicleMake = chooseVehicle.options[chooseVehicle.selectedIndex].getAttribute('data-vehicle-make');
        let dataVehicleModel = chooseVehicle.options[chooseVehicle.selectedIndex].getAttribute('data-vehicle-model');
        let dataVehicleYear = chooseVehicle.options[chooseVehicle.selectedIndex].getAttribute('data-vehicle-year');
        console.log(dataVehicleYear);
        let QuotedPrice = <?php echo json_encode($opportunities[0]['servicelength_c']);  ?> * baseHourlyRate;
        let trip_Fuel = QuotedPrice * fuelCharge;
        let trip_Gratuity = QuotedPrice * gratuityCharge;

        baseHourlyRate = parseFloat(baseHourlyRate).toFixed(2);
        trip_Fuel = parseFloat(trip_Fuel).toFixed(2);
        trip_Mileage = parseFloat(trip_Mileage).toFixed(2);
        trip_Gratuity = parseFloat(trip_Gratuity).toFixed(2);
        let TotalTripCost = parseFloat(QuotedPrice) + parseFloat(trip_Mileage) + parseFloat(trip_Fuel) + parseFloat(trip_Gratuity);

        TotalTripCost = parseFloat(TotalTripCost).toFixed(2);
        // console.log(typeof(QuotedPrice), typeof(trip_Fuel), typeof(trip_Mileage), typeof(trip_Gratuity), typeof(TotalTripCost));
        perHourRate.innerText = baseHourlyRate;
        fuel.innerText = trip_Fuel;
        gratuity.innerText = trip_Gratuity;
        subtotal.innerText = QuotedPrice;
        mileage.innerText = trip_Mileage;
        totalPrice.innerText = TotalTripCost;
        vehicleName.innerText = vehicleNameVal;
        vehicleType.innerText = vehicleNameVal;
        vehicleMake.innerText = dataVehicleMake;
        vehicleModel.innerText = dataVehicleModel;
        vehicleYear.innerText = dataVehicleYear;
        // updatePrice.style.display= "block!important";
        updatePrice.classList.remove("hidden");
    });

    let sent_lead_count = <?php echo json_encode($opportunities[0]['sent_lead_count']); ?>;
    // alert(sent_lead_count);

    updatePrice.addEventListener("click", () => {

        if (sent_lead_count >= 3) {
            alert("You can't send more than 3 quotes. Please contact us for more details.");
        } else {

            let check = confirm("Do you want to change the vehicle?");
            if (check) {

                document.getElementById("vehicleForm").submit();
            }
        }
    })
</script>










<?php require_once './footer.php'; ?>