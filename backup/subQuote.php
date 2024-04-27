<?php
$crm_url = 'https://unlimitedcharters.com/betacrm/index.php?entryPoint=VendorSystem';




// $lead_id = 'd8a756be-f538-0cb7-1063-661041189be0';
// $quote_id = '28b8f458-9f4d-594d-5e09-6610e9d84d25';



$lead_id = $_GET['lead_id'];
$quote_id = $_GET['quote_id'];
// $quote_id = $_GET['quote_id'];
// if (isset($_GET['quote_id'])) {

// }
// $quote_id = implode(',', $quote_id);
// typeof($lead_id);
// $data["lead_id"] = 'a2e51685-94df-9a87-ca2b-65fc201d2278';
// echo $lead_id;
// echo '<br/>';
// echo $quote_id;
$data["lead_id"] = $lead_id;
$data["method"] = "fetchSingleLeadById";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$result_data = json_decode($response, true);
$lead = $result_data;
// $quoteIdsString = $lead[0]['sent_quote_id_c'];

// print_r(count($leadQuotes));
// print_r($lead[0]['vendor_email_c']);
// print_r($lead[0]['vnd_vechiles_id_c']);
// print_r($lead[0]['status']);
// echo '<br/>';
// echo '<br/>';










$sent_lead_count = $lead[0]['sent_lead_count'];
// $data["lead_id"] = 'a2e51685-94df-9a87-ca2b-65fc201d2278';
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
// print_r($lead_email);
// $emailAddress = $result[0]['email_address']['email_address'];
// echo $emailAddress;

// print_r($lead[0]['sent_lead_count']);
// $vehicle_id;
// if ($sent_lead_count == 0) {
//     $vehicle_id = $lead[0]['vnd_vechiles_id_c'];
//     // echo '<br/>';
//     // echo "1";
// } elseif (isset($lead[0]['sent_quote_id_c']) && $lead[0]['sent_quote_id_c'] != '') {
//     $quote_ids = explode(',', $lead[0]['sent_quote_id_c']);
//     // echo '<br/>';
//     // echo "2";
//     $quote_id = $quote_ids[$sent_lead_count - 1];
//     // echo $quote_id;

//     $quote_id = trim($quote_id);
//     // echo $trimmedString;  // This will output: '8b5b0cb4-9c88-aa62-a4b8-65fd2a987ef0'


//     // echo "<br/>";

// } else {
//     $vehicle_id = $lead[0]['vnd_vechiles_id_c'];
//     // echo '<br/>';
//     // echo "3";
// }


$data["quote_id"] = $quote_id;
// $data["vehicle_id"] = $vehicle_id;
$data["method"] = "singleLeadQuoteDetail";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;

// echo "<br/>";
// echo "<br/>";
$quote = json_decode($response, true);
// print_r($quote['data']['vehicle_id_c']);

$quoteIdsString = $quote['data']['sub_quote_c'];

// Replace the space after the first comma with an empty string
$quoteIdsString = preg_replace('/,\\s+/', ',', $quoteIdsString);

// echo $quoteIdsString;

// echo gettype($lead[0]['sent_quote_id_c']);
$leadQuotes = explode(',', $quoteIdsString);

// print_r($quote);
$vehicle_id = $quote['data']['vehicle_id_c'];
// $data["vehicle_id"] = $lead[0]['vnd_vechiles_id_c'];
$data["vehicle_id"] = $vehicle_id;
$data["method"] = "fetchVehicle";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$vehicle = json_decode($response, true);
// print_r($vehicle);
// echo '<br/>';
// echo '<br/>';


// print_r($leadQuotes);

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

$distance_org = $lead[0]['distance_c'];
preg_match('/\d+(\.\d+)?/', $distance_org, $matches);
$distance = floatval($matches[0]);
$fuelCharge = $leadCharges['FuelSarcharge'] / 100;
// echo $trip_fuel;
$gratuityCharge = $leadCharges['Gratuity'] / 100;
$mileage = $distance * 2 * $leadCharges['ChargesPerMile'];
$quoted_price = $lead[0]['servicelength_c'] * $vehicle['base_hourly_rate'];

$trip_fuel = $quoted_price * $fuelCharge;
$trip_gratuity = $quoted_price * $gratuityCharge;
$toal_trip_cost = $quoted_price + $trip_fuel + $trip_gratuity + $mileage;

$costperperson = $toal_trip_cost / $lead[0]['numberofpassengers_c'];





?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="./css/tailwind.css" rel="stylesheet" type="text/css" />

    <script>
        /* Pinegrow Interactions, do not remove */
        (function() {
            try {
                if (!document.documentElement.hasAttribute('data-pg-ia-disabled')) {
                    window.pgia_small_mq = typeof pgia_small_mq == 'string' ? pgia_small_mq : '(max-width:767px)';
                    window.pgia_large_mq = typeof pgia_large_mq == 'string' ? pgia_large_mq : '(min-width:768px)';
                    var style = document.createElement('style');
                    var pgcss = 'html:not(.pg-ia-no-preview) [data-pg-ia-hide=""] {opacity:0;visibility:hidden;}html:not(.pg-ia-no-preview) [data-pg-ia-show=""] {opacity:1;visibility:visible;display:block;}';
                    if (document.documentElement.hasAttribute('data-pg-id') && document.documentElement.hasAttribute('data-pg-mobile')) {
                        pgia_small_mq = '(min-width:0)';
                        pgia_large_mq = '(min-width:99999px)'
                    }
                    pgcss += '@media ' + pgia_small_mq + '{ html:not(.pg-ia-no-preview) [data-pg-ia-hide="mobile"] {opacity:0;visibility:hidden;}html:not(.pg-ia-no-preview) [data-pg-ia-show="mobile"] {opacity:1;visibility:visible;display:block;}}';
                    pgcss += '@media ' + pgia_large_mq + '{html:not(.pg-ia-no-preview) [data-pg-ia-hide="desktop"] {opacity:0;visibility:hidden;}html:not(.pg-ia-no-preview) [data-pg-ia-show="desktop"] {opacity:1;visibility:visible;display:block;}}';
                    style.innerHTML = pgcss;
                    document.querySelector('head').appendChild(style);
                }
            } catch (e) {
                console && console.log(e);
            }
        })()
    </script>
    <title>client_quote_from_vendor</title>
    <link rel="icon" href="images/ico.jpg" type="image/jpeg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <style>
        body {
            overflow-x: hidden;
        }

        #quote-form-div {
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            top: 0;
            left: 0;
            align-items: center;
            justify-content: center;
        }

        .formCard {
            height: 200px;
            background: whitesmoke;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            flex-direction: column;
            position: relative;
        }

        .reason-form {
            padding-top: 4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            flex-direction: column;
        }

        .reason-form>textarea {
            width: 83%;
            height: 150px;
            border-radius: 10px;
            border: 2px solid gray;
        }

        .reason-form>textarea:active,
        .reason-form>textarea:focus {
            outline: none;
            box-shadow: none;
        }

        #reserve {
            background-color: rgb(223 202 139 / var(--tw-bg-opacity)) !important;
        }

        .cross {
            width: 35px;
            height: 35px;
            position: absolute;
            top: -7%;
            right: -3%;
            background: #fff;
            padding: 10px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .history {
            position: fixed;
            z-index: 999;
            width: 40px;
            height: 40px;
            padding: 8px;
            border-top-left-radius: 50%;
            top: 40%;
            right: 0%;
            border-bottom-left-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .history>a {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .history>a>span {
            display: none;
            opacity: 0;
            transition: all 0.3s ease;
            color: #fff;
            white-space: nowrap;

        }

        .history>a>svg {
            fill: #fff;
            max-width: 100%;
            max-height: 100%;
        }

        .history:hover {
            width: 150px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .history:hover>a>span {
            display: block;
            opacity: 1;

        }
    </style>
</head>

<body class="text-left">
    <div class="border-b-2 flex flex-wrap mx-auto">
        <div class="mx-auto pl-10 pr-0 pt-10 w-1/2">
            <img src="./images//Logo-Image2.png" class="w-1/2" sizes="100vw,
(min-width: 640px) 296px,
(min-width: 768px) 59vw,
(min-width: 1280px) 616px,
(min-width: 1536px) 744px,
(min-width: 2400px) 31vw">
        </div>

        <div class="bg-red-500 history">
            <a href="./all_Leads.php?lead_email=<?php echo $lead_email[0]['email_address']['email_address']; ?>&first=<?php echo $lead[0]['first_name']; ?>&last=<?php echo $lead[0]['last_name']; ?>&page=1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">

                    <path d="M32 32c17.7 0 32 14.3 32 32V400c0 8.8 7.2 16 16 16H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H80c-44.2 0-80-35.8-80-80V64C0 46.3 14.3 32 32 32zM160 224c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32s-32-14.3-32-32V256c0-17.7 14.3-32 32-32zm128-64V320c0 17.7-14.3 32-32 32s-32-14.3-32-32V160c0-17.7 14.3-32 32-32s32 14.3 32 32zm64 32c17.7 0 32 14.3 32 32v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V224c0-17.7 14.3-32 32-32zM480 96V320c0 17.7-14.3 32-32 32s-32-14.3-32-32V96c0-17.7 14.3-32 32-32s32 14.3 32 32z" />
                </svg>
                <span>View History</span>
            </a>
        </div>

        <!-- Test -->
        <div class="mt-10 mx-auto px-4 py-10 text-right w-1/2 pl-0">
            <h2 class=" text-3xl w-max"><b class="h-auto mx-auto w-auto">FORMAL QUOTE - ID #&nbsp; <?php echo $lead[0]['opertunityid_c']; ?></b></h2>
        </div>
    </div>
    <!-- Header Ends Here -->
    <div class="container h-auto mt-8 mx-auto pt-8 px-4 shadow-2xl">
        <h2 class="font-semibold h-auto mx-auto text-center text-4xl text-65d5e2-500 text-LogoBlue-500 w-auto">TRIP DETAILS</h2>
        <div class="flex -mx-4">
            <div class="mx-auto pb-10 pr-0 text-center w-screen md:w-1/2">
                <div>
                    <h2 class="font-bold mx-auto pt-6 text-gray-400">Name :&nbsp;&nbsp;<?php echo $lead[0]['first_name'] . ' ' . $lead[0]['last_name']; ?></h2>
                    <h2 class="font-bold mx-auto pt-6 text-gray-400">Phone # :&nbsp;&nbsp;<?php echo $lead[0]['phone_mobile']; ?></h2>
                    <h2 class="font-bold mx-auto pt-6 text-gray-400">Email Address :&nbsp;&nbsp;<?php echo $lead_email[0]['email_address']['email_address'] ?></h2>
                    <h2 class="font-bold mx-auto pt-6 text-gray-400">Passenger Count : <?php echo $lead[0]['numberofpassengers_c']; ?><br><br><br></h2>
                </div>
            </div>
            <div class="mx-auto pl-0 text-center  md:w-1/2">
                <div class="mx-auto">
                    <!-- <h2 class="font-semibold h-auto mx-auto text-3xl text-65d5e2-500 text-LogoBlue-500 text-center w-auto">TRIP DETAILS</h2> -->
                    <h2 class="font-bold mx-auto pt-6 text-gray-400">Event Date :&nbsp;<?php echo $lead[0]['eventdate_c']; ?></h2>
                    <h2 class="font-bold mx-auto pt-6 text-gray-400">Event Type :&nbsp;<?php echo $lead[0]['eventtype_c']; ?></h2>
                    <h2 class="font-bold mx-auto pt-6 text-gray-400">Pickup Time : <?php echo $lead[0]['pickuptime_c']; ?></h2>
                    <h2 class="font-bold mx-auto pt-6 text-gray-400">Hours : <?php echo $lead[0]['servicelength_c']; ?> Hours</h2>

                </div>
            </div>
            <div class="mx-auto pl-0 text-center  md:w-1/2">
                <div class="mx-auto">
                    <!-- <h2 class="font-semibold h-auto mx-auto text-3xl text-65d5e2-500 text-LogoBlue-500 text-center w-auto"> DETAILS</h2> -->
                    <h2 class="font-bold mx-auto pt-6 text-gray-400">PickUp :&nbsp;<?php echo $lead[0]['pickuplocation_c']; ?></h2>
                    <h2 class="font-bold mx-auto pt-6 text-gray-400">Destination :&nbsp;<?php echo $lead[0]['location_c']; ?></h2>
                    <h2 class="font-bold mx-auto pt-6 text-gray-400">Client Itinerary : <?php echo $lead[0]['clientnotes_c']; ?></h2>

                </div>
            </div>
        </div>
    </div>
    <!-- Test -->
    <div class="container mt-10 mx-auto px-4 ">
        <div>
            <h2 class="font-semibold h-auto mx-auto text-center text-4xl text-65d5e2-500 text-LogoBlue-500 w-auto uppercase">TRIP ROUTE</h2>
        </div>
        <div class="-mx-4 flex flex-wrap pt-10 row px48">
            <div class="px-4 w-full sm:w-1 h-100" style="min-height:350px;">
                <div class="mapouter">
                    <?php

                    $first_city = $lead[0]['pickuplocation_c'];
                    $second_city = $lead[0]['location_c'];
                    // echo $first_city;
                    // Split the string by comma and space
                    $words = explode(", ", $first_city);
                    $words2 = explode(", ", $second_city);

                    // Extract the first word
                    $first_word = $words[0] . "," . $words[1];
                    $second_word = $words2[0] . "," . $words2[1];

                    // echo $first_word;

                    ?>


                    <div class="gmap_canvas"><iframe width="100%" height="100%" id="gmap_canvas" src="<?php echo 'https://maps.google.com/maps?q=' . $first_word . 'to=' . $second_word . '&t=&z=9&ie=UTF8&iwloc=&output=embed'; ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.analarmclock.com/"></a><br><a href="https://www.onclock.net/"></a><br>
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
                        <div class="-mx-4 flex  text-center">
                            <div class="px-4 w-full md:w-1/2">
                                <p>Distance :&nbsp;<?php echo $lead[0]['distance_c'] ?></p>
                            </div>
                            <div class="px-4 w-full md:w-1/2">
                                <p>Duration :&nbsp;<?php echo $lead[0]['duration_c'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <?php if (count($leadQuotes) > 0 && isset($leadQuotes) && $leadQuotes) { ?>
        <div class="container h-auto mt-8 mx-auto  px-4 ">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                    <!-- <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="prequoted-tab" data-tabs-target="#prequoted" type="button" role="tab" aria-controls="prequoted" aria-selected="false">Pre-Quoted Price</button>
                </li> -->

                    <?php
                    // print_r($leadQuotes);
                    if ($leadQuotes != null && $leadQuotes !== "") {


                        $i = 1;
                        foreach ($leadQuotes as $leadQuote) {
                            if ($leadQuote) {
                                // echo $leadQuote;
                                if ($i == 1) {
                                    $id = "PreQuoted";
                                } elseif ($i == 2) {
                                    $id = "One";
                                } elseif ($i == 3) {
                                    $id = "Two";
                                } elseif ($i == 4) {
                                    $id = "Three";
                                } elseif ($i == 5) {
                                    $id = "Four";
                                } elseif ($i == 6) {
                                    $id = "Five";
                                } elseif ($i == 7) {
                                    $id = "Six";
                                } elseif ($i == 8) {
                                    $id = "Seven";
                                } elseif ($i == 9) {
                                    $id = "Eight";
                                } elseif ($i == 10) {
                                    $id = "Nine";
                                } elseif ($i == 11) {
                                    $id = "Ten";
                                }



                    ?>
                                <li role="presentation">
                                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="<?php echo $id; ?>-tab" data-tabs-target="#<?php echo $id; ?>" type="button" role="tab" aria-controls="<?php echo $id; ?>" aria-selected="false">Quote <?php echo $id; ?></button>
                                </li>
                    <?php
                                $i++;
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
            <div id="default-tab-content">



                <?php
                $j = 1;


                foreach ($leadQuotes as $leadQuote) {
                    if ($leadQuote) {
                        if ($j == 1) {
                            $id = "PreQuoted";
                        } elseif ($j == 2) {
                            $id = "One";
                        } elseif ($j == 3) {
                            $id = "Two";
                        } elseif ($j == 4) {
                            $id = "Three";
                        } elseif ($j == 4) {
                            $id = "Three";
                        } elseif ($j == 5) {
                            $id = "Four";
                        } elseif ($j == 6) {
                            $id = "Five";
                        } elseif ($j == 7) {
                            $id = "Six";
                        } elseif ($j == 8) {
                            $id = "Seven";
                        } elseif ($j == 9) {
                            $id = "Eight";
                        } elseif ($j == 10) {
                            $id = "Nine";
                        } elseif ($j == 11) {
                            $id = "Ten";
                        }
                        $data["quote_id"] = $leadQuote;
                        $data["method"] = "fetchSingleQuote";
                        $curl = curl_init($crm_url);
                        curl_setopt($curl, CURLOPT_POST, true);
                        curl_setopt($curl, CURLOPT_HEADER, false);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                        $response = curl_exec($curl);
                        // echo $response;
                        $quote_data = json_decode($response, true);
                        // print_r($quote_data);
                        // echo "<br/>";
                        // if($quote_data['data']['quote_status_c']){
                        //     echo "ok";
                        // }else{
                        //     echo "error";
                        // }
                        // echo "<br/>";
                        if ($quote_data['data']['quote_status_c'] == "Pending") {
                            $btnBg = 'bg-blue-500 text-white';
                        } elseif ($quote_data['data']['quote_status_c'] == "Rejected") {
                            $btnBg = 'bg-red-500 text-white';
                        } elseif ($quote_data['data']['quote_status_c'] == "Accepted") {
                            $btnBg = 'bg-green-500 text-white';
                        }

                        if ($quote_data['success'] == "Success") {
                            $data["vehicle_id"] = $quote_data['data']['vehicle_id_c'];
                            $data["method"] = "fetchVehicle";
                            $curl = curl_init($crm_url);
                            curl_setopt($curl, CURLOPT_POST, true);
                            curl_setopt($curl, CURLOPT_HEADER, false);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                            $response = curl_exec($curl);
                            // echo $response;
                            $quoted_vehicle = json_decode($response, true);
                            // print_r($quoted_vehicle);
                            $vehicle_image = explode(',', $quoted_vehicle['images']);
                            // echo "<br/>";
                            // echo "<br/>";
                            // $quotedPrice = $lead[0]['servicelength_c'] * $quoted_vehicle['base_hourly_rate'];
                            $quotedPrice = $quote_data['data']['quoted_price_with_profit_c'];

                            $quotedHourlyRate = $quotedPrice / $lead[0]['numberofpassengers_c'];
                            $quoted_trip_fuel = $quotedPrice * $fuelCharge;
                            $quoted_trip_gratuity = $quotedPrice * $gratuityCharge;
                            $quoted_total_trip_cost = $quotedPrice + $quoted_trip_fuel + $quoted_trip_gratuity + $mileage;

                            $quoted_costperperson = $quoted_total_trip_cost / $lead[0]['numberofpassengers_c'];
                ?>
                            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="<?php echo $id; ?>" role="tabpanel" aria-labelledby="<?php echo $id; ?>-tab">
                                <div class="flex flex-no-wrap items-center max-w-screen-2xl mx-auto pb-4 pt-10">
                                    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
                                    <div class="px-10 w-auto">
                                        <h2 class="font-semibold text-2xl uppercase"><b class="text-4xl text-LogoGold-500 text-dfca8b-500">QUOTE <?php echo $id;  ?></b></h2>
                                    </div>
                                    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
                                </div>
                                <div class="container mt-10 mx-auto px-4 shadow-2xl">
                                    <div class="-mx-4 flex ">
                                        <div class="px-4 w-full md:w-1/2 mx-auto ">

                                            <img src="https://unlimitedcharters.com/vendor24/vehicles/<?php echo $vehicle_image[0]; ?>" class="h-auto mx-auto w-auto" style="max-height:320px;">
                                            <p class="mx-auto pt-10 w-80">Vehicle Type :&nbsp;&nbsp;<?php echo $quoted_vehicle['name']; ?></p>
                                            <p class="mx-auto pt-0 w-80">Vehicle Year :&nbsp; &nbsp;<?php echo $quoted_vehicle['vehicle_year']; ?></p>
                                            <p class="mx-auto pt-0 w-80">Vehicle Make :&nbsp;&nbsp;<?php echo $quoted_vehicle['vehicle_make']; ?></p>
                                            <p class="mx-auto w-80">Vehicle Model :&nbsp;&nbsp;<?php echo $quoted_vehicle['vehicle_model']; ?></p>
                                        </div>
                                        <div class="mx-auto shadow-2xl text-center px-4 w-full md:w-1/2">
                                            <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-900">Hourly Rate: @ $ <?php echo $quotedHourlyRate; ?> Per Hour</h2>
                                            <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-900">Subtotal :&nbsp;$<?php echo $quotedPrice; ?></h2>
                                            <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-400">+ Fuel : $<?php echo $quoted_trip_fuel; ?></h2>
                                            <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-400">+ Mileage : $<?php echo $mileage; ?></h2>
                                            <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-400">+ Gratuity : $<?php echo $quoted_trip_gratuity; ?></h2>
                                            <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-400">Price Per Person Breakdown: $<?php echo $quoted_costperperson; ?></h2>
                                            <h2 class="font-bold mx-auto pt-6 text-3xl text-LogoGold-500 text-dfca8b-500">DEPOSIT AMOUNT : 50%</h2>
                                            <h2 class="font-extrabold mx-auto pt-6 text-3xl text-65d5e2-500 text-LogoBlue-500">TOTAL TRIP COST : $<?php echo $quoted_total_trip_cost; ?><br><br><br></h2>
                                        </div>
                                    </div>

                                </div>
                                <?php if ($quote_data['data']['quote_status_c'] == "Pending") { ?>
                                    <div class="flex flex-no-wrap items-center max-w-screen-2xl mx-auto pb-4 pt-16">
                                        <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
                                        <div class="px-10 w-auto">
                                            <h2 class="font-semibold mx-auto text-2xl uppercase"><b class="text-4xl text-LogoGold-500 text-center text-dfca8b-500">Book Your Vehicle(s)</b></h2>
                                        </div>
                                        <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
                                    </div>
                                    <div class="mt-5 mx-auto text-center pt-5">
                                        <!-- <a href="https://unlimitedcharters.com/vendor/system/rental_agreement_sent_automatic.html"> -->
                                        <a href="./reserve.php?lead_id=<?php echo $lead_id; ?>&quote_id=<?php echo $leadQuote; ?>&opertunity_id=<?php echo $lead[0]['opertunityid_c']; ?>&vendor_email=<?php echo $lead[0]['vendor_email_c']; ?>" class="inline-block animate-bounce bg-LogoGold-500 bg-dfca8b-400 border-2 border-dfca8b-500 border-gray-700 font-bold leading-normal  px-10 py-2 rounded-full shadow-gray-500 shadow-md text-3xl text-center text-gray-50 uppercase" id="reserve">Reserve Now</a>

                                        <button class="animate-bounce bg-red-500 bg-dfca8b-400 border-2 border-dfca8b-500 border-gray-700 font-bold leading-normal  px-10 py-2 rounded-full shadow-gray-500 shadow-md text-3xl text-center text-gray-50 uppercase" type="button" id="reject-<?php echo $id; ?>">Reject QUOTE</button>
                                        <!-- </a> -->
                                    </div>

                                <?php } else { ?>
                                    <div class="flex flex-no-wrap items-center max-w-screen-2xl mx-auto pb-4 pt-16">
                                        <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
                                        <div class="px-10 w-auto">
                                            <?php if ($lead[0]['status'] != "New" && $quote_data['data']['quote_status_c'] == "Pending") { ?>
                                                <h2 class="font-semibold mx-auto text-2xl uppercase"><b class="text-4xl text-LogoGold-500 text-center text-dfca8b-500">This Lead is <?php echo $lead[0]['status'];  ?></b></h2>
                                            <?php } else { ?>
                                                <h2 class="font-semibold mx-auto text-2xl uppercase"><b class="text-4xl text-LogoGold-500 text-center text-dfca8b-500">This Quote is <?php echo $quote_data['data']['quote_status_c'];  ?></b></h2>

                                            <?php   } ?>
                                        </div>
                                        <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
                                    </div>
                                    <?php if ($quote_data['data']['rejection_reason_c']) { ?>
                                        <div class="flex flex-no-wrap items-center max-w-screen-2xl mx-auto pb-4 pt-16">
                                            <!-- <div class="bg-gray-500 flex-grow h-px max-w-full"></div> -->
                                            <div class="px-10 w-full">
                                                <p class="mx-auto text-center text-red-500 text-2xl uppercase">Reason: <?php echo $quote_data['data']['rejection_reason_c'];  ?></p>
                                            </div>
                                            <!-- <div class="bg-gray-500 flex-grow h-px max-w-full"></div> -->
                                        </div>
                                <?php }
                                } ?>
                                <div id="quote-form-div-<?php echo $id; ?>" style=" display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            top: 0;
            left: 0;
            align-items: center;
            justify-content: center;">
                                    <form class="reason-form mt-5" action="./reject.php" method="post">
                                        <!-- <textarea name="reason" id="reason" cols="30" rows="10" placeholder="Reason for Rejecting Quote" class="w-[80%] h-[150px]" required></textarea> -->
                                        <div class="formCard">
                                            <div class="cross" id="cross-<?php echo $id; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">

                                                    <path d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" />
                                                </svg></div>
                                            <h1 class="text-center text-3xl">Reason for Rejecting Quote</h1>
                                            <input type="hidden" name="lead_id" value="<?php echo $lead[0]['id']; ?>" />
                                            <input type="hidden" name="opertunity_id" value="<?php echo $lead[0]['opertunityid_c']; ?>" />
                                            <input type="hidden" name="lead_email" value="<?php echo $lead[0]['vendor_email_c']; ?>" />
                                            <select name="reason" id="reason">
                                                <option value="Already booked elsewhere">Already booked elsewhere</option>
                                                <option value="Not ready to book just yet">Not ready to book just yet</option>
                                                <option value="Too expensive / Out of our budget">Too expensive / Out of our budget</option>
                                                <option value="Got a lower quote">Got a lower quote</option>
                                            </select>
                                            <input type="hidden" name="quote_id" value="<?php echo $leadQuote;  ?>">
                                        </div>
                                        <button type=" submit" name="submit" id="submit" class="animate-bounce bg-red-500 bg-dfca8b-400 border-2 border-dfca8b-500 border-gray-700 font-bold leading-normal  px-10 py-2 rounded-full shadow-gray-500 shadow-md text-3xl text-center text-gray-50 uppercase cursor-pointer" value="Submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                            <script>
                                let reject_<?php echo $id; ?> = document.getElementById('reject-<?php echo $id; ?>');
                                let cross_<?php echo $id; ?> = document.getElementById('cross-<?php echo $id; ?>');
                                let rejection_div_<?php echo $id; ?> = document.getElementById('quote-form-div-<?php echo $id; ?>');
                                reject_<?php echo $id; ?>.addEventListener('click', () => {

                                    rejection_div_<?php echo $id; ?>.style.display = 'flex';
                                })
                                cross_<?php echo $id; ?>.addEventListener('click', () => {
                                    rejection_div_<?php echo $id; ?>.style.display = 'none';
                                })
                            </script>

                <?php
                            $j++;
                        }
                    }
                }

                ?>
            </div>
        </div>
    <?php } else { ?>

        <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="PreQuoted" role="tabpanel" aria-labelledby="PreQuoted-tab" element-id="133">
            <div class="flex flex-no-wrap items-center max-w-screen-2xl mx-auto pb-4 pt-10" element-id="132">
                <div class="bg-gray-500 flex-grow h-px max-w-full" element-id="131"></div>
                <div class="px-10 w-auto" element-id="130">
                    <h2 class="font-semibold text-2xl uppercase" element-id="129"><b class="text-4xl text-LogoGold-500 text-dfca8b-500" element-id="128">PreQuoted</b></h2>
                </div>
                <div class="bg-gray-500 flex-grow h-px max-w-full" element-id="127"></div>
            </div>
            <div class="container mt-10 mx-auto px-4 shadow-2xl" element-id="126">
                <div class="-mx-4 flex " element-id="125">
                    <div class="px-4 w-full md:w-1/2 mx-auto " element-id="124">

                        <img src="https://unlimitedcharters.com/vendor24/vehicles/3258f4fe9e3d934296b7571deea70d32.jpg" class="h-auto mx-auto w-auto" style="max-height:320px;" element-id="123">
                        <p class="mx-auto pt-10 w-80" element-id="122">Vehicle Type :&nbsp;&nbsp;<?php echo $vehicle['name'] ?></p>
                        <p class="mx-auto pt-0 w-80" element-id="121">Vehicle Year :&nbsp; &nbsp;<?php echo $vehicle['vehicle_year'] ?></p>
                        <p class="mx-auto pt-0 w-80" element-id="120">Vehicle Make :&nbsp;&nbsp;<?php echo $vehicle['vehicle_make'] ?></p>
                        <p class="mx-auto w-80" element-id="119">Vehicle Model :&nbsp;&nbsp;<?php echo $vehicle['vehicle_model'] ?></p>
                    </div>
                    <div class="mx-auto shadow-2xl text-center px-4 w-full md:w-1/2" element-id="118">
                        <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-900" element-id="117">Hourly Rate: @ $<?php echo number_format($vehicle['base_hourly_rate'], 2) ?> Per Hour</h2>
                        <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-900" element-id="116">Subtotal :&nbsp;$<?php echo number_format($quoted_price, 2) ?></h2>
                        <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-400" element-id="115">+ Fuel : $<?php echo number_format($trip_fuel, 2) ?></h2>
                        <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-400" element-id="114">+ Mileage : $<?php echo number_format($mileage, 2) ?></h2>
                        <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-400" element-id="113">+ Gratuity : $<?php echo number_format($trip_gratuity, 2) ?></h2>
                        <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-400" element-id="112">Price Per Person Breakdown: $<?php echo number_format($costperperson, 2) ?></h2>
                        <h2 class="font-bold mx-auto pt-6 text-3xl text-LogoGold-500 text-dfca8b-500" element-id="111">DEPOSIT AMOUNT : 50%</h2>
                        <h2 class="font-extrabold mx-auto pt-6 text-3xl text-65d5e2-500 text-LogoBlue-500" element-id="110">TOTAL TRIP COST : $<?php echo number_format($toal_trip_cost, 2) ?><br element-id="109"><br element-id="108"><br element-id="107"></h2>
                    </div>
                </div>

            </div>
            <div class="flex flex-no-wrap items-center max-w-screen-2xl mx-auto pb-4 pt-16" element-id="106">
                <div class="bg-gray-500 flex-grow h-px max-w-full" element-id="105"></div>
                <div class="px-10 w-auto" element-id="104">
                    <h2 class="font-semibold mx-auto text-2xl uppercase" element-id="103"><b class="text-4xl text-LogoGold-500 text-center text-dfca8b-500" element-id="102">This Lead is <?php echo  $lead[0]['status']; ?></b></h2>

                </div>
                <div class="bg-gray-500 flex-grow h-px max-w-full" element-id="101"></div>
            </div>
            <div id="quote-form-div-PreQuoted" style=" display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            top: 0;
            left: 0;
            align-items: center;
            justify-content: center;" element-id="100">
                <form class="reason-form mt-5" action="./reject.php" method="post" element-id="99">
                    <!-- <textarea name="reason" id="reason" cols="30" rows="10" placeholder="Reason for Rejecting Quote" class="w-[80%] h-[150px]" required></textarea> -->
                    <div class="formCard" element-id="98">
                        <div class="cross" id="cross-PreQuoted" element-id="97"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" element-id="96">

                                <path d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" element-id="95"></path>
                            </svg></div>
                        <h1 class="text-center text-3xl" element-id="94">Reason for Rejecting Quote</h1>
                        <input type="hidden" name="lead_id" value="70ae2071-067e-1cd5-7355-66026b35f3f6" element-id="93">
                        <input type="hidden" name="opertunity_id" value="3428599" element-id="92">
                        <input type="hidden" name="lead_email" value="ahmadhassanyaseen@gmail.com" element-id="91">
                        <select name="reason" id="reason" element-id="90">
                            <option value="Already booked elsewhere" element-id="89">Already booked elsewhere</option>
                            <option value="Not ready to book just yet" element-id="88">Not ready to book just yet</option>
                            <option value="Too expensive / Out of our budget" element-id="87">Too expensive / Out of our budget</option>
                            <option value="Got a lower quote" element-id="86">Got a lower quote</option>
                        </select>
                        <input type="hidden" name="quote_id" value="6866a98d-2119-e7de-8101-66026b3d2437" element-id="85">
                    </div>
                    <button type=" submit" name="submit" id="submit" class="animate-bounce bg-red-500 bg-dfca8b-400 border-2 border-dfca8b-500 border-gray-700 font-bold leading-normal  px-10 py-2 rounded-full shadow-gray-500 shadow-md text-3xl text-center text-gray-50 uppercase cursor-pointer" value="Submit" element-id="84">Submit</button>
                </form>
            </div>
        </div>




    <?php


    } ?>
    <!-- Test -->




    <div class="mt-10">
        <section class="bg-white pb-20 pt-5 text-gray-500">
            <div class="font-normal mx-auto pt-0 px-10 shadow-2xl text-center w-10/12">
                <p class="font-extrabold leading-loose mx-auto pt-10 text-2xl text-65d5e2-500 text-LogoBlue-500 text-center uppercase">Click the &quot;RESERVE NOW&quot; button to receive the rental agreement.&nbsp;</p>
                <p class="font-extrabold leading-loose mx-auto text-2xl">Once that is signed we can finalize your booking!&nbsp;</p>
                <p class="font-medium leading-loose mx-auto text-2xl text-center">Due to it being the start of homecoming, prom and wedding season, we can not guarantee availability without a signed agreement.</p>
                <p class="leading-loose mx-auto text-center text-red-500 text-xl uppercase">***Please note, we also can not hold vehicles without a signed rental agreement.***</p>
                <p class="font-extrabold italic leading-loose mx-auto text-2xl text-65d5e2-500 text-LogoBlue-500 text-center uppercase">Please Consider:</p>
                <p class="font-medium leading-loose mx-auto text-2xl text-left">1. Vehicles are based on a first come first serve basis.&nbsp;</p>
                <p class="font-medium leading-loose mx-auto text-2xl text-left">2. Pricing may change at anytime (without a signed agreement).</p>
                <p class="font-medium leading-loose mx-auto text-2xl text-left">3. Available vehicles may be booked by other clients at any moment!</p>
                <p class="font-medium leading-loose mx-auto text-2xl text-left">4. Vehicles are not fully booked until after the rental agreement is signed and you get a confirmation email from us.</p>
                <p class="font-medium leading-loose mx-auto text-2xl text-left">5. We will not run any funds if we have to cancel your agreement due to a vehicle loss or if someone else has booked that vehicle before you signed your agreement.</p><br>
                <div>
                    <p class="font-extrabold leading-loose mx-auto text-2xl text-LogoBlue-500 text-center">&nbsp;If you have any questions, feel free to email us at:&nbsp;</p>
                    <p class="font-extrabold leading-loose mx-auto text-2xl text-center text-gray-500"><a href="mailto:quotes@unlimitedcharters.com" class="text-LogoGold-500 text-dfca8b-500">quotes@unlimitedcharters.com</a></p>
                    <p class="font-extrabold leading-loose pb-10 text-2xl text-65d5e2-500 text-center"><a href="tel:8559431466">Or Call Us - 855.943.1466</a></p>
                </div>
            </div>
        </section>
    </div><br>
    <br>
    <br>
    <br>
    <br>

    <script>
        let reject = document.getElementById('reject');
        let cross = document.getElementById('cross');
        let rejection_div = document.getElementById('quote-form-div');
        reject.addEventListener('click', () => {

            rejection_div.style.display = 'flex';
        })
        cross.addEventListener('click', () => {

            rejection_div.style.display = 'none';
        })
    </script>
</body>

</html>