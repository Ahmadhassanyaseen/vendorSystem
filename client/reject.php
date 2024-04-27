<?php
// print_r($_REQUEST);
$crm_url = 'https://unlimitedcharters.com/betacrm/index.php?entryPoint=VendorSystem';
if (isset($_REQUEST)) {
    $lead_id = $_REQUEST['lead_id'];
    $quote_id = $_REQUEST['quote_id'];
    $lead_email = $_REQUEST['lead_email'];
    $opertunity_id = $_REQUEST['opertunity_id'];
    $reason = $_REQUEST['reason'];
    // print_r($_REQUEST);


    $table = "tnv_vendorquote_cstm";
    $id = $quote_id;
    $status_field = 'quote_status_c';

    $status = "Rejected";
    $data["id"] = $id;
    $data['reason'] = $reason;
    $data["table"] = $table;
    $data['status'] = $status;
    $data['status_field'] = $status_field;
    $data['type'] = "1";
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



    $data["lead_id"] = $lead_id;
    $data['lead_email'] = $lead_email;
    $data['lead_opertunityid_c'] = $opertunity_id;
    $data['quote_id'] = $quote_id;
    $data['email_temp'] = '90008454-49bf-1505-ee7e-6601420d5922';
    $data['link'] = 'http://unlimitedcharters.com/vendor24/lead_quotes.php?opertunity_id=' . $opertunity_id;
    $data['reason'] = $reason;
    $data["method"] = "sendQuoteMail";

    $curl = curl_init($crm_url);

    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($curl);

    $result_data = json_decode($response, true);
    // print_r($result_data);

    echo "<script>alert('Rejected Successfully');
          window.location.href = 'https://unlimitedcharters.com';
        </script>";
}
