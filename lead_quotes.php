<?php
$page = 'lead_quotes';
require_once('config.php');
require_once('session.php');
require './header.php';
require_once './header_nav.php';

$opertunity_id = $_GET['opertunity_id'];
$data['opertunityid_c'] = $opertunity_id;
$data["method"] = "FetchSingleLead";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$singleLead = json_decode($response, true);


// print_r($singleLead[0]['sent_quote_id_c']);
$leadQuotes = str_replace(' ', '', $singleLead[0]['sent_quote_id_c']);
// print_r($leadQuotes);
// echo $opertunity_id;
$leadQuotes_ids = explode(',', $leadQuotes);
// print_r($leadQuotes_ids);
// echo "<br/>";

// echo "<br/>";

$lead_id = $singleLead[0]['id_c'];
$data['lead_id'] = $lead_id;
$data["method"] = "leadAllQuoteIds";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$singleLeadQuote = json_decode($response, true);

// print_r($singleLeadQuote);
// echo '<br/>';
// foreach ($singleLeadQuote['data'] as $key => $value) {
//     // print_r($value['leads_tnv_vendorquote_1tnv_vendorquote_idb']);
//     // echo '<br/>';
//     $data['quote_id'] = $value['leads_tnv_vendorquote_1tnv_vendorquote_idb'];
//     $data["method"] = "singleLeadQuoteDetail";
//     $curl = curl_init($crm_url);
//     curl_setopt($curl, CURLOPT_POST, true);
//     curl_setopt($curl, CURLOPT_HEADER, false);
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
//     $response = curl_exec($curl);
//     // echo $response;
//     $singleLeadQuoteDetails = json_decode($response, true);
//     // print_r($singleLeadQuoteDetails);

//     // echo '<br/>';
// }
// foreach ($leadQuotes_ids as $key => $value) {
//     // print_r($value['leads_tnv_vendorquote_1tnv_vendorquote_idb']);
//     // echo '<br/>';
//     // echo $value;
//     $data['quote_id'] = $value;
//     $data["method"] = "singleLeadQuoteDetail";
//     $curl = curl_init($crm_url);
//     curl_setopt($curl, CURLOPT_POST, true);
//     curl_setopt($curl, CURLOPT_HEADER, false);
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
//     $response = curl_exec($curl);
//     // echo $response;
//     $singleLeadQuoteDetails = json_decode($response, true);
//     print_r($singleLeadQuoteDetails);

//     echo '<br/>';
// }




?>


<style>
    .accordion-item {
        border-color: transparent !important;
    }

    .p48 {
        padding: 0px 48px;
    }

    .f20 {
        font-size: 20px !important;
    }

    .accordion-item:first-of-type .accordion-button {
        background-color: #E0F7F9;
    }

    .accordion-button:focus {
        border: none !important;
    }

    .accordion-button.text-white::after {}

    .edit-button {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgb(20, 20, 20);
        border: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
        cursor: pointer;
        transition-duration: 0.3s;
        overflow: hidden;
        position: relative;
        text-decoration: none !important;
    }

    .edit-svgIcon {
        width: 17px;
        transition-duration: 0.3s;
    }

    .edit-svgIcon path {
        fill: white;
    }

    .edit-button:hover {
        width: 120px;
        border-radius: 50px;
        transition-duration: 0.3s;
        /* background-color: rgb(255, 69, 69); */
        background-color: #e3b04b;
        align-items: center;
    }

    .edit-button:hover .edit-svgIcon {
        width: 20px;
        transition-duration: 0.3s;
        transform: translateY(60%);
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }

    .edit-button::before {
        display: none;
        content: "Edit";
        color: white;
        transition-duration: 0.3s;
        font-size: 2px;
    }

    .edit-button:hover::before {
        display: block;
        padding-right: 10px;
        font-size: 13px;
        opacity: 1;
        transform: translateY(0px);
        transition-duration: 0.3s;
    }
</style>

<div class="p48 pt-5 mb-5">

    <h2 class="fw-bolder me-auto ms-auto text-primary text-start text-uppercase mt-0 mb-5" data-pg-name="vehiclelist">All Quotes

    </h2>

    <?php

    if (!$leadQuotes_ids || $leadQuotes_ids[0] == '') {
        // if($leadQuotes_ids[0])

        echo ' <h3 class="fw-bold me-auto ms-auto text-center text-uppercase mt-0 mb-5" data-pg-name="vehiclelist">No Quotes Available

    </h3>';
    }

    ?>



    <?php


    $i = 1; // Initialize index variable outside the loop

    foreach ($leadQuotes_ids as $key => $value) {
        if($value){
        $check = ($i == 1) ? 'show' : ''; // Set 'show' for the first item, else empty string

        $data['quote_id'] = $value;
        $data["method"] = "singleLeadQuoteDetail";
        $curl = curl_init($crm_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        $singleLeadQuoteDetails = json_decode($response, true);


        // print_r($singleLeadQuoteDetails);
        $btnBg = '';
        if ($singleLeadQuoteDetails['data']['quote_status_c'] == "Accepted") {
            $btnBg = "bg-success text-white";
        } elseif ($singleLeadQuoteDetails['data']['quote_status_c'] == "Rejected") {
            $btnBg = "bg-danger text-white";
        } else {
            $btnBg = "bg-primary text-white";
        }
        if ($singleLeadQuoteDetails['data']['quote_status_c'] == "Rejected") {

            $reason = '<h3 class="font-bold ml-20  f20 pt-6 text-gray-400 mt-0">Rejection Reason :&nbsp;' . $singleLeadQuoteDetails['data']['rejection_reason_c'] . '</h3>';
            $editBtn = ' <a href="./update_quote.php?quote_id=' . $singleLeadQuoteDetails['data']['id_c'] . '&lead_id=' . $singleLead[0]['id_c'] . '" class="edit-button">
  <svg class="edit-svgIcon" viewBox="0 0 512 512">
                    <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                  </svg>
</a>';
        } else {

            $reason = '';
            $editBtn = '';
        }


    ?>

        <div class="accordion" id="accordionMain">
            <div class="accordion-item">
                <h2 class="accordion-header m-0 " id="<?php echo $singleLeadQuoteDetails['data']['vendor_phone_c']; ?>">
                    <button class="accordion-button collapsed f20 gap-2 <?php echo $btnBg ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $singleLeadQuoteDetails['data']['id_c']; ?>" aria-expanded="false" aria-controls="<?php echo $singleLeadQuoteDetails['data']['id_c']; ?>">
                        <?php echo $singleLeadQuoteDetails['data2']['name'] ?>
                        / <span>
                            <?php echo $singleLeadQuoteDetails['data']['quote_status_c']; ?></span>
                    </button>

                </h2>
                <div id="<?php echo $singleLeadQuoteDetails['data']['id_c']; ?>" class="accordion-collapse collapse <?php echo $check; ?>" aria-labelledby="<?php echo $singleLeadQuoteDetails['data']['vendor_phone_c']; ?>" data-bs-parent="#accordionMain" style="">
                    <div class="accordion-body d-flex justify-content-between ">
                        <div>
                            <?php echo $reason; ?>
                            <h3 class="font-bold ml-20  f20 pt-6 text-gray-400 mt-0">Quote Time :&nbsp;<?php echo $singleLeadQuoteDetails['data2']['date_entered'] ?></h3>
                            <h3 class="font-bold ml-20 f20  pt-6 text-gray-400 mt-0">Quoted Price :&nbsp;<?php echo $singleLeadQuoteDetails['data']['quoted_price_c'] ?> </h3>
                            <h3 class="font-bold ml-20 f20  pt-6 text-gray-400 mt-0">Quoted Vehicle :&nbsp;<?php echo $singleLeadQuoteDetails['data']['vehicle_c'] ?> </h3>
                        </div>
                        <div>
                            <?php echo $editBtn; ?>
                        </div>


                        <div class="accordion" id="accordionChild">

                            <?php

                            // echo $singleLeadQuoteDetails['data']['sub_quote_c'];
                            $subQuoteIds = explode(",", $singleLeadQuoteDetails['data']['sub_quote_c']);
                            // print_r($subQuoteIds);
                            if ($subQuoteIds) {

                                foreach ($subQuoteIds as $subQuoteId) {
                                    if ($subQuoteId != " " && $subQuoteId != null) {
                                        // echo $subQuoteId;
                                        $data['quote_id'] = $subQuoteId;;
                                        $data["method"] = "singleLeadQuoteDetail";
                                        $curl = curl_init($crm_url);
                                        curl_setopt($curl, CURLOPT_POST, true);
                                        curl_setopt($curl, CURLOPT_HEADER, false);
                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                                        $response = curl_exec($curl);
                                        $subQuoteData = json_decode($response, true);
                                // print_r($subQuoteData);
                                // echo '<br>';
                                $btnBgChild = '';
                                if ($subQuoteData['data']['quote_status_c'] == "Accepted") {
                                    $btnBgChild = "bg-success text-white";
                                } elseif ($subQuoteData['data']['quote_status_c'] == "Rejected") {
                                            $reasonChild = '<h3 class="font-bold ml-20  f20 pt-6 text-gray-400 mt-0">Rejection Reason :&nbsp;' . $subQuoteData['data']['rejection_reason_c'] . '</h3>';
                                    $btnBgChild = "bg-danger text-white";
                                } else {
                                    $btnBgChild = "bg-primary text-white";
                                }
                            ?>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header m-0 " id="<?php echo $subQuoteData['data']['vendor_phone_c']; ?>">
                                                <button class="accordion-button collapsed f20 gap-2 <?php echo $btnBgChild ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $subQuoteData['data']['id_c']; ?>" aria-expanded="false" aria-controls="<?php echo $subQuoteData['data']['id_c']; ?>">
                                                    <?php echo $subQuoteData['data2']['name'] ?>
                                                    / <span>
                                                        <?php echo $subQuoteData['data']['quote_status_c']; ?></span>
                                                </button>

                                            </h2>
                                            <div id="<?php echo $subQuoteData['data']['id_c']; ?>" class="accordion-collapse collapse <?php echo $check; ?>" aria-labelledby="<?php echo $subQuoteData['data']['vendor_phone_c']; ?>" data-bs-parent="#accordionChild" style="">
                                                <div class="accordion-body d-flex justify-content-between ">
                                                    <div>
                                                        <?php echo $reasonChild; ?>
                                                        <h3 class="font-bold ml-20  f20 pt-6 text-gray-400 mt-0">Quote Time :&nbsp;<?php echo $subQuoteData['data2']['date_entered'] ?></h3>
                                                        <h3 class="font-bold ml-20 f20  pt-6 text-gray-400 mt-0">Quoted Price :&nbsp;<?php echo $subQuoteData['data']['quoted_price_c'] ?> </h3>
                                                        <h3 class="font-bold ml-20 f20  pt-6 text-gray-400 mt-0">Quoted Vehicle :&nbsp;<?php echo $subQuoteData['data']['vehicle_c'] ?> </h3>
                                                    </div>
                                                   






                                                </div>
                                            </div>


                                        </div>

                            <?php
                                    }
                                }
                            }

                            ?>

                        </div>

                    </div>
                </div>


            </div>


        </div>





    <?php

        $i++; // Increment index variable
    } 
}?>

</div>
<?php
require './footer.php';

?>