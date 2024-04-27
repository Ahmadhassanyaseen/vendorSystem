 <?php
    $crm_url = 'https://unlimitedcharters.com/betacrm/index.php?entryPoint=VendorSystem';
    $lead_id = $_GET['lead_id'];
    $quote_id = $_GET['quote_id'];
    $opertunity_id = $_GET['opertunity_id'];
    $vendor_email = $_GET['vendor_email'];


    // print_r($_GET);
    $data["lead_id"] = $lead_id;
    $data['status'] = 'Reserved';
    $data["method"] = "updateSingleLeadStatus";
    $curl = curl_init($crm_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($curl);
    // echo $response;
    $result_data = json_decode($response, true);

    $table = "tnv_vendorquote_cstm";
    $id = $quote_id;
    $status_field = 'quote_status_c';

    $data["id"] = $id;
    // $data['reason'] = $reason;
    $data["table"] = $table;
    $data['status'] = "Accepted";
    $data['status_field'] = $status_field;
    $data['type'] = "2";
    $data["method"] = "updateQuoteStatus";
    $curl = curl_init($crm_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($curl);
    // echo $response;
    $result_data = json_decode($response, true);
    // print_r($result_data);
    // echo "<br>";



    $data['lead_opertunityid_c'] = $opertunity_id;
    $data["lead_id"] = $lead_id;
    $data['email_temp'] = '815e4d9b-516d-045f-8cbf-6600665695a0';
    $data['lead_email'] = $vendor_email;
    $data['link'] = 'http://unlimitedcharters.com/vendor24/lead_quotes.php?opertunity_id=' . $opertunity_id;
    $data["method"] = "sendQuoteMail";

    $curl = curl_init($crm_url);

    curl_setopt(
        $curl,
        CURLOPT_POST,
        true
    );
    curl_setopt(
        $curl,
        CURLOPT_HEADER,
        false
    );
    curl_setopt(
        $curl,
        CURLOPT_RETURNTRANSFER,
        true
    );
    curl_setopt(
        $curl,
        CURLOPT_POSTFIELDS,
        $data
    );

    $response = curl_exec($curl);

    $result_data = json_decode($response, true);


    header("Location: https://unlimitedcharters.com/vendor/system/rental_agreement_sent_automatic.html");
    // exit; // Make sure subsequent code is not executed after redirection



    ?>
 <script>
     window.location.href = 'https://unlimitedcharters.com/vendor/system/rental_agreement_sent_automatic.html';
 </script>