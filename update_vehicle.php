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
echo "<br/>";
$vehicle_name = $opportunities[0]['vehicle_type_c'];
// echo $vehicle_name;
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


foreach ($vehicleData as $key => $value) {
    $vehicle[$key] = $value['name'];
    if (
        isset($opportunities[0]['vechiles_name_c']) && isset($vehicle[$key]) && $opportunities[0]['vechiles_name_c'] == $vehicle[$key]
    ) {

        $data["vehicle_id"] = $key;
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

        break;
    } else {

        // break;
    }
}
// echo "</br>";
// echo "Xeno";
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
</style>

<div class="container h-auto mt-8 mx-auto pt-8 px-4 shadow-2xl">
    <div class="-mx-4 flex flex-wrap">
        <h1 class="fw-bolder me-auto ms-auto mb-5 text-primary text-center text-start text-uppercase titleSize">TRIP DETAILS</h1>
        <div class="pl-0 text-left w-full flex row">
            <div class=" col-md-3">
                <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Event Date :&nbsp;<?php echo $opportunities[0]['eventdate_c'] ?></h2>
                <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Event Type :&nbsp;<?php echo $opportunities[0]['eventtype_c'] ?></h2>
                <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Pickup Time : <?php echo $opportunities[0]['pickuptime_c'] ?></h2>
                <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Hours : <?php echo $opportunities[0]['servicelength_c'] ?> Hours</h2>
                <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Passenger Count : <?php echo $opportunities[0]['numberofpassengers_c'] ?><br><br><br></h2>
            </div>
            <div class="  col-md-3">
                <div class=" mx-auto w-10/12">

                    <h3 class="font-bold italic text-3xl text-LogoBlue-500 uppercase mt-0">Pickup</h3>
                    <pre class="font-extrabold  text-gray-400"><?php echo $opportunities[0]['pickuplocation_c'] ?></pre>
                    <h3 class="font-bold italic  text-3xl text-LogoBlue-500 uppercase">Destination</h3>
                    <pre class="font-extrabold  text-gray-400"><?php echo $opportunities[0]['location_c'] ?></pre>
                    <h3 class="font-bold italic  text-3xl text-LogoBlue-500 uppercase">Client Itinerary</h3>
                    <pre class="font-extrabold text-gray-400"><?php echo $opportunities[0]['clientnotes_c'] ?></pre>
                </div>
                <div><br><br><br><br>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="imgDivMain w-50">
                    <?php
                    foreach ($vehicleData as $key => $value) {
                        $vehicle[$key] = $value['name'];
                        if (isset($opportunities[0]['vechiles_name_c']) && isset($vehicle[$key]) && $opportunities[0]['vechiles_name_c'] == $vehicle[$key]) {
                            // Split images by comma and select the first image
                            $images = explode(',', $value['images']);
                            // print_r($value['images']);
                            $i = 1;

                            while ($i <= 2) {
                                // Assuming $firstImage contains the image filename
                                if ($images[$i])
                                    echo '<img src="./vehicles/' . $images[$i] . '" class="h-auto mx-auto w-auto">';
                                // Exit the loop after displaying the image
                                $i++;
                            }

                            break;
                        } else {
                            // break;
                        }
                    }

                    ?>
                </div>
                <div class="cont w-50">

                    <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Vehicle Type :&nbsp;&nbsp;<?php echo $single_vehicle_data['name']; ?></h2>
                    <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Vehicle Year :&nbsp; &nbsp;<?php echo $single_vehicle_data['vehicle_year'] ?></h2>
                    <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Vehicle Make :&nbsp;&nbsp;<?php echo $single_vehicle_data['vehicle_make'] ?></h2>
                    <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Vehicle Model :&nbsp;&nbsp;<?php echo $single_vehicle_data['vehicle_model'] ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-no-wrap items-center max-w-screen-2xl mx-auto pb-0 pt-10">
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
    <div class="px-10 w-auto">
        <h2 class="font-semibold text-2xl uppercase f36"><b class="text-4xl text-LogoGold-500 text-dfca8b-500 f36">Change Vehicle</b></h2>
    </div>
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
</div>
<div class="container mt-10 mx-auto px-4 shadow-2xl">
    <div>
        <h2 class="font-normal text-center text-xl uppercase f20" style="font-weight:400!important;">Client is looking to book the vehicle for the following route.</h2>
    </div>
    <div class="-mx-4 flex flex-wrap pt-10 row px48" style="height: 350px;">
        <div class="px-4 w-full sm:w-1 md:w-1/2 h-100">
            <div class="mapouter">
                <?php

                $first_city = $opportunities[0]['pickuplocation_c'];
                $second_city = $opportunities[0]['location_c'];

                // Split the string by comma and space
                $words = explode(", ", $first_city);
                $words2 = explode(", ", $second_city);

                // Extract the first word
                $first_word = $words[0];
                $second_word = $words2[0];

                // echo $first_word;

                ?>


                <div class="gmap_canvas"><iframe width="820" height="560" id="gmap_canvas" src="<?php echo 'https://maps.google.com/maps?q=' . $first_word . 'to=' . $second_word . '&t=&z=9&ie=UTF8&iwloc=&output=embed'; ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.analarmclock.com/"></a><br><a href="https://www.onclock.net/"></a><br>
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
        <div class="px-4 w-full sm:w-1 md:w-1/2">

            <div class=" text-center h-100 w-100 d-flex align-items-center justify-content-center flex-column">

                <form method="POST" action="./update_vehicle.php?opertunityid_c=<?php echo $opertunityid_c;  ?>" id="vehicleForm" class="w-100">
                    <input type="hidden" name="lead_id" value="<?php echo $opportunities[0]['id_c']; ?>">
                    <input type="hidden" name="vendor_id" value="<?php echo $opportunities[0]['vnd_vendors_id_c']; ?>">
                    <input type="hidden" name="vehicle_type_c" value="<?php echo $opportunities[0]['vehicle_type_c']; ?>">
                    <input type="hidden" name="vendor_email_c" value="<?php echo $opportunities[0]['vendor_email_c']; ?>">
                    <input type="hidden" name="vendor_phone_c" value="<?php echo $opportunities[0]['vendor_phone_c']; ?>">
                    <input type="hidden" name="rate_c" value="<?php echo $opportunities[0]['rate_c']; ?>">

                    <input type="hidden" name="leadtype_c" value="<?php echo $opportunities[0]['leadtype_c']; ?>">
                    <input type="hidden" name="opportunity_id" value="<?php echo $opertunityid_c; ?>">
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

                            // Check if the vehicle has a name
                            // if ($vehicle['name'] == $vehicle_name) {
                            //     $check = "text-light";
                            // }

                            // Check if the vehicle has a name and is not empty
                            if (isset($vehicle['name']) && !empty($vehicle['name'])) {
                                // Output the <option> element with the appropriate class
                                echo '<option value="' . $key . '" data-pg-name="' . $vehicle['name'] . '" class="bg-yellow-200 f14 pd-5 ' . $check . '" id="chooseVehicle">' . $vehicle['name'] . '</option></a>';
                            }
                        }


                        ?>
                    </select>

                </form>
                <div><a href="./addVehical.php">
                        <button class=" bg-yellow-50 border-2 border-gray-900 italic mt-5 px-5 shadow-gray-600 shadow-md text-lg uppercase anv f16" type="submit" name="add_new_vehicle">Add New Vehicle</button></a>
                </div>
            </div>
        </div>

    </div>

</div>
<div class="flex flex-no-wrap items-center max-w-screen-2xl mx-auto pb-4 pt-10">
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
    <div class="px-10 w-auto">
        <h2 class="font-semibold text-2xl uppercase"><b class="text-4xl text-LogoGold-500 text-dfca8b-500 f36">PRE Quoted Price</b></h2>
    </div>
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
</div>
<div class="border-2  my-10 shadow-2xl text-left ">
    <div class="row w-100">
        <div class="col-md-6">
            <h2 class="font-bold mx-auto pt-6 text-2xl text-LogoBlue-500 text-center uppercase f24">As per rates you set in the vendor system:</h2>
            <h2 class="font-bold mx-auto pt-0 text-2xl text-center text-yellow-500 uppercase"><a href="https://unlimitedcharters.com/vendor" target="_blank" class="text-base text-yellow-500 f18">(update / Change your Future Rates - Click Here)</a></h2>
            <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24">Hourly Rate @ $<?php echo $opportunities[0]['rate_c'] ?> Per Hour</h2>
            <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24">+ Fuel : $<?php echo $opportunities[0]['fuel_c'] ?></h2>
            <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24">+ Mileage : $<?php echo $opportunities[0]['mileage_c'] ?></h2>
            <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24">+ Gratuity : $<?php echo $opportunities[0]['gratuity_c'] ?></h2>
            <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-900 f24">Subtotal :&nbsp;$<?php echo $opportunities[0]['quoted_c'] ?></h2>
            <h2 class="font-extrabold mx-auto pt-6 text-3xl text-65d5e2-500 text-LogoBlue-500 text-center f30">TOTAL TRIP COST : $<?php echo $opportunities[0]['total_trip_cost_c'] ?><br><br><br></h2>
        </div>
        <div class="col-md-6">
            <h2 class="font-bold mx-auto pt-6 text-2xl text-LogoBlue-500 text-center uppercase f24">As per rates you set in the vendor system:</h2>
            <h2 class="font-bold mx-auto pt-0 text-2xl text-center text-yellow-500 uppercase"><a href="https://unlimitedcharters.com/vendor" target="_blank" class="text-base text-yellow-500 f18">(update / Change your Future Rates - Click Here)</a></h2>

            <?php
            $selected_vehicle_id = $_POST['SelectVehicle'];
            $data["method"] = "leadCharges";
            $curl = curl_init($crm_url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($curl);
            // echo $response;
            $leadCharges = json_decode($response, true);

            $data["vehicle_id"] = $_POST['SelectVehicle'];
            $data["method"] = "fetchVehicle";
            $curl = curl_init($crm_url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($curl);
            // echo $response;
            $selected_vehicle_data = json_decode($response, true);



            $distance_org = $opportunities[0]['distance_c'];
            preg_match('/\d+(\.\d+)?/', $distance_org, $matches);
            $distance = floatval($matches[0]);
            $distanceTime = $opportunities[0]['servicelength_c'];
            $fuel = $leadCharges['FuelSarcharge'] / 100;
            $gratuity = $leadCharges['Gratuity'] / 100;
            $profit = $leadCharges['Vendor_Percentage'] / 100;
            $QuotedPrice = $distanceTime * $selected_vehicle_data['base_hourly_rate'];
            $garagecharges = 0;
            $trip_Mileage = $distance * 2 * $leadCharges['ChargesPerMile'];
            $trip_Fuel = $QuotedPrice * $fuel;
            $trip_Gratuity = $QuotedPrice * $gratuity;
            $TotalTripCost = $QuotedPrice + $trip_Mileage + $trip_Fuel + $trip_Gratuity + $garagecharges;
            // $CostPerPerson = $TotalTripCost / $passengerCount;


            echo ' <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24" id="perHourRate">Hourly Rate @ $' . $selected_vehicle_data['base_hourly_rate'] . ' Per Hour</h2>
            <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24">+ Fuel : $' . $trip_Fuel . '</h2>
            <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24">+ Mileage : $' . $trip_Mileage . '</h2>
            <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-400 f24">+ Gratuity : $' . $trip_Gratuity . '</h2>
            <h2 class="font-bold mx-auto pt-6 text-2xl text-center text-gray-900 f24">Subtotal :&nbsp;$' . $QuotedPrice . '</h2>
            <h2 class="font-extrabold mx-auto pt-6 text-3xl text-65d5e2-500 text-LogoBlue-500 text-center f30">TOTAL TRIP COST : $' . $TotalTripCost . '<br><br><br></h2>
    
        ';



            ?>
        </div>
    </div>
</div>
<div class="flex flex-no-wrap items-center max-w-screen-2xl mx-auto py-10">
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
    <div class="px-10 w-auto">
        <h2 class="font-semibold text-2xl uppercase"><b class="text-4xl text-LogoGold-500 text-dfca8b-500 f36">Available?</b></h2>
    </div>
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
</div>
<div class="mt-10">
</div>
<section class="bg-white pb-20 pt-0 text-gray-500">
    <div class="font-normal mx-auto px-10 shadow-2xl text-center w-10/12">
        <p class="font-extrabold leading-loose text-4xl text-LogoBlue-500 text-center uppercase f36" style="font-weight:800!important;">CLICK THE "SEND AS IS" BUTTON</p><a href="<?php echo "./leadStatus.php?status=1&lead_id=" . $opportunities[0]['id_c'] . ""; ?>
"><button class="animate-bounce bg-65d5e2-500 bg-LogoGold-500 border-2 border-65d5e2-500 border-gray-500 font-extrabold leading-normal mt-5 mx-auto px-10 py-2 rounded-full shadow-gray-500 shadow-md text-3xl text-center text-gray-50 uppercase f30" name="Reserve Now" type="button">Send As Is</button></a>
        <p class="font-extrabold leading-loose mt-10 text-2xl text-center f30">or</p>
        <div class="shadow-2xl">
            <p class="font-extrabold leading-loose mt-10 pt-10 text-4xl text-LogoGold-500 text-center uppercase f36" style="font-weight:800!important;">Update the total trip cost.</p>
            <p class="font-bold text-2xl text-red-500 f24">*** Please Provide an all inclusive pricing ***</p>
            <p class="font-normal mt-1 text-red-500 text-xl f20">(fuel, mileage, gratuity, tax, etc.)</p>
            <form action="./updateLead1.php" method="post">
                <input type="hidden" name="lead_id" value="<?php echo $opportunities[0]['id_c']; ?>">
                <input type="hidden" name="vendor_id" value="<?php echo $opportunities[0]['vnd_vendors_id_c']; ?>">
                <input type="hidden" name="vehicle_type_c" value="<?php echo $opportunities[0]['vehicle_type_c']; ?>">
                <input type="hidden" name="vendor_email_c" value="<?php echo $opportunities[0]['vendor_email_c']; ?>">
                <input type="hidden" name="vendor_phone_c" value="<?php echo $opportunities[0]['vendor_phone_c']; ?>">
                <input type="hidden" name="rate_c" value="<?php echo $opportunities[0]['rate_c']; ?>">

                <input type="hidden" name="leadtype_c" value="<?php echo $opportunities[0]['leadtype_c']; ?>">
                <input type="hidden" name="opportunity_id" value="<?php echo $opertunityid_c; ?>">
                <!-- <input type="hidden" name="quoted_price" value="<?php echo $opportunities[0]['quoted_c']; ?>" > -->
                <input type="hidden" name="distance" value="<?php echo $opportunities[0]['distance_c']; ?>">
                <input type="hidden" name="passengerCount" value="<?php echo $opportunities[0]['numberofpassengers_c']; ?>">
                <input type="hidden" name="distanceTime" value="<?php echo $opportunities[0]['servicelength_c']; ?>">
                <input type="hidden" name="SelectVehicle" value="<?php echo $selected_vehicle_id; ?>">

                <div class="mb-10 mt-5">
                    <input name="vnd_updated_pricing" placeholder="$ New Pricing" value="$<?php echo $TotalTripCost; ?>" class="bg-yellow-100 f18 italic text-xl w-auto newPricing" style="color:#000!important;">
                </div>
                <div class="font-normal pb-10">
                    <button name="Update Pricing" class="bg-yellow-300 border-2 border-gray-900 font-semibold px-5 shadow-gray-500 shadow-md text-xl uppercase f20 p10-20 bd-1" type="submit">Update Pricing</button>
                </div>
            </form>
            <p></p>
        </div>
        <p class="font-extrabold leading-loose mt-14 text-2xl text-center f24">or</p>
        <p class="font-extrabold leading-loose text-4xl text-center uppercase f36">Click "Not Available"</p>
        <div class="text-4xl">
            <a href="<?php echo "./leadStatus.php?status=0&lead_id=" . $opportunities[0]['id_c'] . ""; ?>"><button class="bg-red-600 border-2 border-gray-900 font-extrabold leading-normal mt-5 mx-auto px-10 rounded-full shadow-gray-600 shadow-lg text-3xl text-center text-gray-50 uppercase f36 bd-2" name="No Availability">Not Available</button></a>
        </div>
        <br>
        <p class="font-medium leading-loose text-4xl text-center"></p>
        <p class="font-normal italic leading-loose text-4xl text-center f30 f400">&nbsp;If you have any questions, feel free reply to this email.&nbsp;</p>
        <p class="font-light leading-loose text-4xl text-center f30 f400">Or Call Us - 855.943.1466</p><br>
    </div>
</section>



<script>
    document.getElementById("SelectVehicle").addEventListener("change", function() {
        // Submit the form when an option is selected
        let check = confirm("Do you want to change the vehicle?");
        if (check) {

            document.getElementById("vehicleForm").submit();
        }
    });
</script>








<?php require_once './footer.php'; ?>