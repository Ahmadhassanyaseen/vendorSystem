<?php
$page = 'dashboard';
require_once './config.php';
require_once './session.php';
require_once './header.php';
require_once './header_nav.php';

$opertunityid_c = $_GET['opertunityid_c'];


$data["lead_id"] = '67208894-f1a4-5fea-541e-65f97e8beb5b';
$data["method"] = "fetchSingleLeadById";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
echo $response;
$result_data = json_decode($response, true);
$opportunities = $result_data;
// print_r($opportunities);

// Your array
$array = $opportunities;

// Loop through the array and echo each key-value pair
// print_r($opportunities[0]['phone']);







?>
<style>
    h2 {
        font-size: 14px !important;
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" !important;

    }
</style>
<!-- <div class="border-b-2 flex flex-wrap mx-auto">
    <div class="mx-auto pl-10 pr-0 pt-10 w-1/2">
        <img src="images/Logo-Image.png" class="w-1/2" sizes="100vw,
(min-width: 640px) 296px,
(min-width: 768px) 59vw,
(min-width: 1280px) 616px,
(min-width: 1536px) 744px,
(min-width: 2400px) 31vw">
    </div>
    <div class="mt-10 mx-auto px-4 py-10 text-right w-1/2">
        <h2 class="mt-14 text-3xl w-max"><b class="h-auto mx-auto w-auto">FORMAL QUOTE - ID #&nbsp; $lead_opertunityid_c</b></h2>
    </div>
</div> -->
<div class="container h-auto mt-8 mx-auto pt-8 px-4 shadow-2xl">
    <div class="flex flex-wrap -mx-4">
        <div class="mx-auto pb-10 pr-0 text-center w-screen md:w-1/2">
            <h2 class="font-semibold h-auto mx-auto text-3xl text-65d5e2-500 text-LogoBlue-500 w-auto">INFO</h2>
            <div>
                <h2 class="font-bold mx-auto pt-6 text-gray-400">Name :&nbsp;&nbsp;<?php echo $opportunities[0]['first_name'] . " " . $opportunities[0]['last_name']; ?></h2>
                <h2 class="font-bold mx-auto pt-6 text-gray-400">Phone # :&nbsp;&nbsp;<?php echo $opportunities[0]['phone_mobile']; ?></h2>
                <h2 class="font-bold mx-auto pt-6 text-gray-400">Email Address :&nbsp;&nbsp;<?php echo $opportunities[0]['email']; ?></h2>
            </div>
        </div>
        <div class="mx-auto pl-0 text-center w-full md:w-1/2">
            <div class="mx-auto">
                <h2 class="font-semibold h-auto mx-auto text-3xl text-65d5e2-500 text-LogoBlue-500 text-center w-auto">TRIP DETAILS</h2>
                <h2 class="font-bold mx-auto pt-6 text-gray-400">Event Date :&nbsp;<?php echo $opportunities[0]['eventdate_c']; ?></h2>
                <h2 class="font-bold mx-auto pt-6 text-gray-400">Event Type :&nbsp;<?php echo $opportunities[0]['eventtype_c']; ?></h2>
                <h2 class="font-bold mx-auto pt-6 text-gray-400">Pickup Time : <?php echo $opportunities[0]['pickuptime_c']; ?></h2>
                <h2 class="font-bold mx-auto pt-6 text-gray-400">Hours : <?php echo $opportunities[0]['servicelength_c']; ?> Hours</h2>
                <h2 class="font-bold mx-auto pt-6 text-gray-400">Passenger Count : <?php echo $opportunities[0]['numberofpassengers_c']; ?><br><br><br></h2>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-no-wrap items-center max-w-screen-2xl mx-auto pb-4 pt-10">
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
    <div class="px-10 w-auto">
        <h2 class="font-semibold text-2xl uppercase"><b class="text-4xl text-LogoGold-500 text-dfca8b-500">TRIP ITINERARY</b></h2>
    </div>
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
</div>
<div class="container mt-10 mx-auto px-4 shadow-2xl">
    <div class="-mx-4 flex flex-wrap pt-10">
        <div class="px-4 w-full md:w-1/2">
            <img src="images/36-passenger-party-bus-out.jpg" class="h-auto mx-auto w-auto">
            <p class="mx-auto pt-10 w-80">Vehicle Type :&nbsp;&nbsp;<?php echo $opportunities[0]['vehicle_type_c']; ?></p>
            <p class="mx-auto pt-0 w-80">Vehicle Year :&nbsp; &nbsp;<?php echo $opportunities[0]['vechiles_year_c']; ?></p>
            <p class="mx-auto pt-0 w-80">Vehicle Make :&nbsp;&nbsp;<?php echo $opprortunities[0]['vechiles_make_c']; ?></p>
            <p class="mx-auto w-80">Vehicle Model :&nbsp;&nbsp;<?php echo $opportunities[0]['vechiles_model_c']; ?></p>
        </div>
        <div class="px-4 w-full md:w-1/2">
            <!-- <img src="images/map.png" class="mt-10 mx-auto"> -->

            <div class="mapouter">
                <?php

                $first_city = $opportunities[0]['pickuplocation_c'];

                // Split the string by comma and space
                $words = explode(", ", $first_city);

                // Extract the first word
                $first_word = $words[0];

                // echo $first_word;

                ?>
                <!-- src="https://maps.google.com/maps?q=baltimoreto=washington&t=&z=13&ie=UTF8&iwloc=&output=embed" -->

                <div class="gmap_canvas"><iframe width="820" height="560" id="gmap_canvas" src="<?php echo 'https://maps.google.com/maps?q=' . $first_word . 'to=washington&t=&z=10&ie=UTF8&iwloc=&output=embed'; ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.analarmclock.com/"></a><br><a href="https://www.onclock.net/"></a><br>
                    <style>
                        .mapouter {
                            position: relative;
                            text-align: right;
                            height: 100%;
                            width: 100%;
                        }
                    </style>

                    <style>
                        .gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            height: 100%;
                            width: 100%;
                        }
                    </style>
                </div>
            </div>
            <div>
                <div class="container mx-auto px-4">
                    <div class="-mx-4 flex flex-wrap text-center">
                        <div class="px-4 w-full md:w-1/2">
                            <p>Distance :&nbsp;<?php echo $opportunities[0]['distance_c']; ?></p>
                        </div>
                        <div class="px-4 w-full md:w-1/2">
                            <p>Mileage :&nbsp;<?php echo $opportunities[0]['mileage_c']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-10">
        <div class="mt-16 mx-auto w-10/12">
            <h3 class="text-3xl text-65d5e2-500 text-LogoBlue-500">Pickup&nbsp;&nbsp;</h3>
            <input name="$lead_pickuplocation_c" type="text" value="<?php echo $opportunities[0]['pickuplocation_c']; ?>" class="mt-5 text-2xl w-full">
            <h3 class="mt-10 text-3xl text-65d5e2-500 text-LogoBlue-500">Destination</h3>
            <input class="mt-5 text-2xl w-full" name="$lead_location_c" type="text" value="<?php echo $opportunities[0]['location_c']; ?>">
            <div></div>
            <h3 class="mt-10 text-3xl text-65d5e2-500 text-LogoBlue-500">Client Itinerary</h3>
            <input class="mt-5 text-2xl w-full" name="$leads_clientnotes_c" value="<?php echo $opportunities[0]['clientnotes_c']; ?>">
            <div></div>
        </div>
        <div><br><br><br><br>
        </div>
    </div>
</div>
<div class="flex flex-no-wrap items-center max-w-screen-2xl mx-auto pb-4 pt-20">
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
    <div class="px-10 w-auto">
        <h2 class="font-semibold text-2xl uppercase"><b class="text-4xl text-LogoGold-500 text-dfca8b-500">Price Breakdown</b></h2>
    </div>
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
</div>
<div class="border-2 mt-10 mx-auto shadow-2xl text-center w-8/12">
    <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-900">Hourly Rate: @ $<?php echo $opportunities[0]['rate_c']; ?> Per Hour</h2>
    <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-900">Subtotal :&nbsp;$0.00</h2>
    <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-400">+ Fuel : $<?php echo $opportunities[0]['fuel_c']; ?></h2>
    <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-400">+ Mileage : $<?php echo $opportunities[0]['mileage_c']; ?></h2>
    <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-400">+ Gratuity : $<?php echo $opportunities[0]['gratuity_c']; ?></h2>
    <h2 class="font-bold mx-auto pt-6 text-2xl text-gray-400">Price Per Person Breakdown: $<?php echo $opportunities[0]['costperperson_c']; ?></h2>
    <h2 class="font-bold mx-auto pt-6 text-3xl text-LogoGold-500 text-dfca8b-500">DEPOSIT AMOUNT : 50%</h2>
    <h2 class="font-extrabold mx-auto pt-6 text-3xl text-65d5e2-500 text-LogoBlue-500">TOTAL TRIP COST : $<?php echo $opportunities[0]['total_trip_cost_c']; ?><br><br><br></h2>
</div>
<div class="flex flex-no-wrap items-center max-w-screen-2xl mx-auto pb-4 pt-16">
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
    <div class="px-10 w-auto">
        <h2 class="font-semibold mx-auto text-2xl uppercase"><b class="text-4xl text-LogoGold-500 text-center text-dfca8b-500">Book Your Vehicle(s)</b></h2>
    </div>
    <div class="bg-gray-500 flex-grow h-px max-w-full"></div>
</div>
<div class="mt-5 mx-auto text-center"><a href="https://unlimitedcharters.com/vendor/system/rental_agreement_sent_automatic.html"><button class="animate-bounce bg-LogoGold-500 bg-dfca8b-400 border-2 border-dfca8b-500 border-gray-700 font-bold leading-normal mt-12 mx-auto px-10 py-2 rounded-full shadow-gray-500 shadow-md text-3xl text-center text-gray-50 uppercase" type="button">Reserve Now</button></a>
</div>
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
</div>


<? require_once './footer.php'; ?>