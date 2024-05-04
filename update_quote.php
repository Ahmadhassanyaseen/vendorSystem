<?php
$page = 'lead_quotes';
require_once('config.php');
require_once('session.php');
require './header.php';
require_once './header_nav.php';
// print_r($_GET);
$lead_id = $_GET['lead_id'];
$quote_id = $_GET['quote_id'];

$data['quote_id'] = $quote_id;
$data["method"] = "singleLeadQuoteDetail";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$singleLeadQuoteDetails = json_decode($response, true);
// print_r($singleLeadQuoteDetails);
// echo '<br/>';
// echo '<br/>';
$data["vehicle_id"] = $singleLeadQuoteDetails['data']['vehicle_id_c'];
$data["method"] = "fetchVehicle";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$result_data = json_decode($response, true);
$vehicle = $result_data;

// print_r($result_data);
// echo '<br />';
// echo '<br />';
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
// print_r($lead);
// echo '<br />';
// echo '<br />';
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
$fuelCharges = $leadCharges['FuelSarcharge'] / 100;
$gratuity = $leadCharges['Gratuity'] / 100;
$quotedMileage = $distance * 2 * $leadCharges['ChargesPerMile'];

$quoted_price = $singleLeadQuoteDetails['data']['quoted_price_c'];
$quotedFuel = $quoted_price * $fuelCharges;
$quotedGratuity = $quoted_price * $gratuity;
$total_trip_cost_quoted = $quoted_price + $quotedFuel + $quotedGratuity + $quotedMileage;
$costperperson_quoted = $total_trip_cost_quoted / $lead[0]['numberofpassengers_c'];





// echo $total_trip_cost_quoted;




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

    .wsnw {
        /* white-space: nowrap !important; */
    }

    .xen-8 {
        margin: 8px !important;
    }

    .xen-h-80 {
        height: 80px !important;
    }
</style>
<div class="container h-auto mt-8 mx-auto pt-8  px-4 shadow-2xl" style="padding-bottom:2rem;">
    <div class="-mx-4 flex flex-wrap">
        <h1 class="fw-bolder me-auto ms-auto mb-5 text-primary text-center text-center text-uppercase  f36">QUOTE DETAILS</h1>
        <div class="pl-0 text-center w-full flex row ">
            <div class=" col-md-4">
                <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Name :&nbsp;<span style="font-weight: 600;"><?php echo $singleLeadQuoteDetails['data2']['name'] ?></h2>
                <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Quote Price : <span style="font-weight: 600;">$<?php echo $singleLeadQuoteDetails['data']['quoted_price_c'] ?> </h2>
                <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Rejection Reason :&nbsp;<span style="font-weight: 600;"><?php echo $singleLeadQuoteDetails['data']['rejection_reason_c'] ?></h2>
                <h2 class="font-bold ml-24 pt-6 text-gray-400 mt-0">Quote Number : <span style="font-weight: 600;"><?php echo $singleLeadQuoteDetails['data']['quote_number_c'] ?></h2>
            </div>
            <div class="  col-md-4">
                <div class=" mx-auto w-10/12">
                    <h2 class="font-bold wsnw pt-6 text-gray-400 mt-0">Pickup :&nbsp;<span style="font-weight: 600;"><?php echo $lead[0]['pickuplocation_c'] ?></h2>
                    <h2 class="font-bold wsnw pt-6 text-gray-400 mt-0">Destination :&nbsp;<span style="font-weight: 600;"><?php echo $lead[0]['location_c'] ?></h2>
                    <h2 class="font-bold  pt-6 text-gray-400 mt-0">Vehicle : <span style="font-weight: 600;"><?php echo $vehicle['name'] ?></h2>
                    <h2 class="font-bold  pt-6 text-gray-400 mt-0">Event Date : <span style="font-weight: 600;"><?php echo $lead['0']['eventdate_c'] ?><br><br><br></h2>


                </div>

            </div>
            <div class="col-md-4">
                <div class="imgDivMain w-50">
                    <?php

                    $images = explode(',', $vehicle['images']);
                    // print_r($images);
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

<div class="border-2  my-10 shadow-2xl text-left row w-100 mx-0">
    <div class="px-4 col-md-4">

        <div class=" text-center h-100 w-100 d-flex align-items-center justify-content-center gap-5 flex-column">
            <p class="font-extrabold leading-loose text-4xl text-LogoGold-500 text-center uppercase f30 mx-auto pt-6" style="font-weight:800!important;">Update the total trip cost.</p>
            <form method="POST" action="./update_quote_price.php" id="quotedForm" class="w-100">

                <input type="hidden" name="lead_id" value="<?php echo $lead_id ?>">
                <input type="hidden" name="opertunity_id" value="<?php echo $lead[0]['opertunityid_c'] ?>">

                <input type="hidden" name="vendor_id" value="<?php echo $lead[0]['vnd_vendors_id_c'] ?>">
                <input type="hidden" name="vehicle_id" value="<?php echo $vehicle['id'] ?>">
                <input type="hidden" name="vehicle_name" value="<?php echo $vehicle['name'] ?>">
                <input type="hidden" name="quote_id" value="<?php echo $quote_id ?>">
                <input type="hidden" name="sub_quote_id" value="<?php echo $singleLeadQuoteDetails['data']['sub_quote_c'] ?>">

                <!-- <input type="text" name="updatedPrice" class="text-center" style="max-width: 70%; font-size:16px;" id="updatedPrice"> -->
                <input type="text" placeholder="$<?php echo $quoted_price ?>" value="" name="updatedPrice" class="text-center" style="max-width: 70%; font-size:16px;" id="updatedPrice">
                <br>
                <span id="priceError" style="color: red;"></span>





            </form>
            <div class="d-flex justify-content-center align-items-center flex-column gap-1 ">
                <button class="animate-bounce bg-65d5e2-500 bg-LogoGold-500 border-2 border-65d5e2-500 border-gray-500 font-extrabold leading-normal mt-5 mx-auto px-10 py-2 rounded-full shadow-gray-500 shadow-md text-3xl text-center text-gray-50 uppercase f30 " type="button" id="updatePriceBTN">Update Price</button>

            </div>

        </div>

    </div>
    <div class="row col-md-8">
        <div class="col-md-6">
            <h2 class="font-bold xen-8 pt-6 text-2xl text-LogoBlue-500 text-center uppercase f30">Original Price</h2>
            <!-- <h2 class="font-bold mx-auto pt-0 text-2xl text-center text-yellow-500 uppercase"><a href="https://unlimitedcharters.com/vendor" target="_blank" class="text-base text-yellow-500 f18">(update / Change your Future Rates - Click Here)</a></h2> -->
            <h2 class="font-bold xen-8 pt-6 text-2xl text-center text-gray-400 f24">Hourly Rate @ $<?php echo number_format($vehicle['base_hourly_rate'], 2) ?> Per Hour</h2>
            <h2 class="font-bold xen-8 pt-6 text-2xl text-center text-gray-900 f24">Quoted Price :&nbsp;<span style="font-weight: 600;">$<?php echo number_format($quoted_price, 2) ?></span></h2>
            <h2 class="font-bold xen-8 pt-6 text-2xl text-center text-gray-400 f24">+ Fuel : <span style="font-weight: 600;">$<?php echo number_format($quotedFuel, 2) ?></span></h2>
            <h2 class="font-bold xen-8 pt-6 text-2xl text-center text-gray-400 f24">+ Mileage : <span style="font-weight: 600;">$<?php echo number_format($quotedMileage, 2) ?></span></h2>
            <h2 class="font-bold xen-8 pt-6 text-2xl text-center text-gray-400 f24">+ Gratuity : <span style="font-weight: 600;">$<?php echo number_format($quotedGratuity, 2) ?></span></h2>
            <h2 class="font-extrabold xen-8 pt-6 text-3xl text-65d5e2-500 text-LogoBlue-500 text-center f24 xen-h-80">TOTAL TRIP COST <br> <span style="font-weight: 600;">$<?php echo number_format($total_trip_cost_quoted, 2); ?></span><br><br><br></h2>
        </div>
        <div class="col-md-6">
            <h2 class="font-bold xen-8 pt-6 text-2xl text-LogoBlue-500 text-center uppercase f30">Updated Price</h2>
            <!-- <h2 class="font-bold mx-auto pt-0 text-2xl text-center text-yellow-500 uppercase"><a href="https://unlimitedcharters.com/vendor" target="_blank" class="text-base text-yellow-500 f18">(update / Change your Future Rates - Click Here)</a></h2> -->
            <h2 class="font-bold xen-8 pt-6 text-2xl text-center text-gray-400 f24">Hourly Rate @ $<span class="font-bold" id="newHourlyRate">0.00</span> Per Hour</h2>
            <h2 class="font-bold xen-8 pt-6 text-2xl text-center text-gray-900 f24">Quoted Price :&nbsp;$<span style="font-weight: 600;" id="newSubtotalRate">0.00</span></h2>
            <h2 class="font-bold xen-8 pt-6 text-2xl text-center text-gray-400 f24">+ Fuel : $<span style="font-weight: 600;" id="newFuelRate">0.00</span></h2>
            <h2 class="font-bold xen-8 pt-6 text-2xl text-center text-gray-400 f24">+ Mileage : $<span style="font-weight: 600;" id="newMileageRate">0.00</span></h2>
            <h2 class="font-bold xen-8 pt-6 text-2xl text-center text-gray-400 f24">+ Gratuity : $<span style="font-weight: 600;" id="newGratuityRate">0.00</span></h2>
            <h2 class="font-extrabold xen-8 pt-6 text-3xl text-65d5e2-500 text-LogoBlue-500 text-center f24 xen-h-80">TOTAL TRIP COST <br> $<span style="font-weight: 600;" id="newTotalPrice">0.00</span><br><br><br></h2>
        </div>
    </div>
</div>
<script>
    let newHourlyRate = document.getElementById('newHourlyRate');
    let newFuelRate = document.getElementById('newFuelRate');
    let newMileageRate = document.getElementById('newMileageRate');
    let newGratuityRate = document.getElementById('newGratuityRate');
    let newSubtotalRate = document.getElementById('newSubtotalRate');
    let newTotalPrice = document.getElementById('newTotalPrice');
    let serviceLength = <?php echo $lead[0]['servicelength_c']; ?>

    let fuelPercentage = <?php echo $fuelCharges;  ?>


    // console.log(<?php //echo $fuelCharges; 
                    ?>)
    // console.log(fuelPercentage);
    // console.log(<?php //echo $gratuity;  
                    ?>);


    let formSubmitCheck = false;
    document.getElementById('updatedPrice').addEventListener('input', function() {
        var priceInput = this.value.trim();
        var priceError = document.getElementById('priceError');

        var priceValue = parseInt(priceInput, 10);
        // Check if input contains only numbers
        if (!/^\d*$/.test(priceInput)) {
            priceError.textContent = 'Price should contain only numbers';
            formSubmitCheck = false;
            return;
        } else if (priceValue >= <?php echo  $quoted_price; ?>) {
            priceError.textContent = 'Price should be lower than $<?php echo  $quoted_price; ?>';
            formSubmitCheck = false;

        } else {
            priceError.textContent = '';
            formSubmitCheck = true;
        }


        newHourlyRate.textContent = (priceValue / serviceLength).toFixed(2);
        newFuelRate.textContent = (priceValue * fuelPercentage).toFixed(2);
        newMileageRate.textContent = (<?php echo $quotedMileage;
                                        ?>).toFixed(2);
        newGratuityRate.textContent = (priceValue * <?php echo $gratuity;  ?>).toFixed(2);
        newSubtotalRate.textContent = (priceValue).toFixed(2);
        // newTotalPrice.textContent = priceValue + newFuelRate.textContent + newMileageRate.textContent + newGratuityRate.textContent;


        // Convert string values to numbers using parseFloat()
        const price = parseFloat(priceValue);
        const fuelRate = parseFloat(newFuelRate.textContent);
        const mileageRate = parseFloat(newMileageRate.textContent);
        const gratuityRate = parseFloat(newGratuityRate.textContent);

        // Add the numeric values
        const total = price + fuelRate + mileageRate + gratuityRate;

        // Convert the total back to a string for display
        const totalString = total.toFixed(2);
        newTotalPrice.textContent = totalString;

        // Display the total
        // console.log(totalString); // or wherever you want to display it


    });


    let updatedPrice = document.getElementById('updatedPrice');
    let updatePriceBTN = document.getElementById('updatePriceBTN');
    let quotedForm = document.getElementById('quotedForm');
    updatePriceBTN.addEventListener('click', function() {
        if (!formSubmitCheck) {
            alert('Please enter valid price');
        } else if (updatedPrice.value == '') {
            alert('Please enter price');
        } else {
            let check = confirm("Do you want to change the price?");
            if (check) {
                quotedForm.submit();
            }
        }
    })
</script>



<?php
require './footer.php';

?>