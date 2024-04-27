 <!-- <select class="ipt_uif_select select2-hidden-accessible" name="vehicle_type" id="vehicle_type" data-placeholder="Select Vehicle Type" placeholder="Select Vehicle Type" title="Select Vehicle Type" data-allow-clear="true" data-theme="eform-material eform-select2-boxy" tabindex="-1" aria-hidden="true">
     <?php
        // foreach ($vehicle_type_options as $vindx => $vval) {
        //     if ($vehicle_object['vehicle_type'] == $vindx)
        //         echo '<option value="' . $vindx . '" selected>' . $vval . '</option>';
        //     else
        //         echo '<option value="' . $vindx . '">' . $vval . '</option>';
        // }
        ?>
 </select>
 <input class="ipt_uif_text" name="vehicle_make" id="vehicle_make" type="text" placeholder="Vehicle Make (optional)" title="Vehicle Make (Optional)" value="<?php echo $vehicle_object['vehicle_make']; ?>">
 <select class="ipt_uif_select select2-hidden-accessible" name="vehicle_year" id="vehicle_year" data-placeholder="Select Vehicle Year" placeholder="Select Vehicle Year" title="Select Vehicle Year" data-allow-clear="true" data-theme="eform-material eform-select2-boxy" tabindex="-1" aria-hidden="true">
     <option value="" selected="selected">Select Vehicle Year</option>
     <?php
        // $start = 1900;
        // $end = date('Y');
        // for ($end; $end >= $start; $end--) {
        //     if ($vehicle_object['vehicle_year'] == $end)
        //         echo '<option value="' . $end . '" selected>' . $end . '</option>';
        //     else
        //         echo '<option value="' . $end . '" >' . $end . '</option>';
        // }
        ?>
 </select>
 <input class="ipt_uif_text" name="vehicle_model" id="vehicle_model" maxlength="" type="text" placeholder="Vehicle Model (Optional)" title="Vehicle Model (Optional)" value="<?php echo $vehicle_object['vehicle_model']; ?>">
 <input class="ipt_uif_text" name="vehicle_quantity" id="vehicle_quantity" type="text" placeholder="Enter Quantity of Identical Vehicles (Ex: 1)" title="Enter Quantity of Identical Vehicles (Ex: 1)" value="<?php echo $vehicle_object['vehicle_quantity']; ?>">
 <input class="ipt_uif_text" name="vehicle_capacity" id="vehicle_capacity" type="text" placeholder="Passenger Limit (Ex: 20)" title="Passenger Limit (Ex: 20)" value="<?php echo $vehicle_object['vehicle_capacity']; ?>">
 <input class="ipt_uif_text" name="luggage_limit" id="luggage_limit" type="text" placeholder="Luggage Limit (Ex: 20)" title="Luggage Limit (Ex: 20)" value="<?php if (!empty($vehicle_object['luggage_limit'])) {
                                                                                                                                                                echo $vehicle_object['luggage_limit'];
                                                                                                                                                            } else {
                                                                                                                                                                echo "0";
                                                                                                                                                            }  ?>">


 Hourly Rate
 <input class="ipt_uif_text vndr_currency" name="base_hourly_rate" id="base_hourly_rate" type="text" placeholder="Enter Base Hourly Rate" title="Enter Base Hourly Rate" value="<?php echo $vehicle_object['base_hourly_rate']; ?>" required>
 <input class="ipt_uif_text" name="base_min_hours" id="base_min_hours" type="text" placeholder="Enter Minimum Hours" title="Enter Minimum Hours" value="<?php // echo number_format($vehicle_object['base_min_hours'], 0, '.', ','); 
                                                                                                                                                        ?>" required>
 <input class="ipt_uif_text vndr_currency" name="base_additional_hourly" id="base_additional_hourly" type="text" placeholder="Enter Rate (Optional)" title="Enter Hourly Rate For Additional Hours (Optional)" value="<?php echo $vehicle_object['base_additional_hourly']; ?>">

 <div class="d-flex align-items-center justify-content-between ">

     <h6 class="fst-italic text-light-emphasis mb8 w40">Vehicle Type : </h6>
     
 </div> -->
 <?php

    // require_once "./config.php";
    //  $data['id'] = "Xeno";                                                                                                                                                       
    //  $data['name'] = "khalil";                                                                                                                                                       
    // $data["method"] = "xeno";
    // $curl = curl_init($crm_url);
    // curl_setopt($curl, CURLOPT_POST, true);
    // curl_setopt($curl, CURLOPT_HEADER, false);
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    // $response = curl_exec($curl);
    // // echo $response;
    // $quoteResponse = json_decode($response, true);
    // // print_r($quoteResponse);
    // print_r($quoteResponse);
    // if(!$response){
    //             echo "error";
    // }



    ?>
 <script>
     // Data to be sent in the request
     const requestData = {
         method: "leadCharges"
     };

     // Configuration for the AJAX request
     const requestOptions = {
         method: 'POST',
         headers: {
             'Content-Type': 'application/json'
         },
         body: JSON.stringify(requestData)
     };

     // URL for the AJAX request
     const url = 'https://unlimitedcharters.com/betacrm/index.php?entryPoint=VendorSystem';

     // Perform the AJAX request
     fetch(url, requestOptions)
         .then(response => {
             if (!response.ok) {
                 throw new Error('Network response was not ok');
             }
             return response.json();
         })
         .then(data => {
             // Handle the response data
             console.log(data);
             // Assuming response is JSON, you can access properties like data.ChargesPerMile, data.FuelSarcharge, etc.
         })
         .catch(error => {
             // Handle errors
             console.log(error);
             console.error('There was an error with the request:', error);
         });
 </script>