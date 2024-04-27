 <?php
// $crm_url = 'https://unlimitedcharters.com/betacrm/index.php?entryPoint=VendorSystem';


// // echo "Xeno";
// $data["vendor_id"] = "246335eb-7d78-b0d5-17f6-5d35c2ac010b";
// $data["lead_id"] = "68972b47-6c5c-1e56-72d9-65d7a19df291";
// $data['quoted_c'] = "1000";
// $data['vehicle_c']= "Sedan";
// $data['vendor_notes_c']= "Ahmad";
// // echo "Xeno";
// $data["method"] = "addNewQuote";
// $curl = curl_init($crm_url);

// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_HEADER, false);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
// $response = curl_exec($curl);

// echo $response;
// if ($response) {
//     echo 'success';
// } else {
//     echo 'failed';
// }



$crm_url = 'https://unlimitedcharters.com/betacrm/index.php?entryPoint=VendorSystem';

$data["vendor_id"] = "246335eb-7d78-b0d5-17f6-5d35c2ac010b";
$data["lead_id"] = "68972b47-6c5c-1e56-72d9-65d7a19df291";
$data['quoted_c'] = "1000";
$data['vehicle_c']= "Sedan";
$data['vendor_notes_c']= "Ahmad";
// echo "Xeno";
$data["method"] = "addNewQuote";

$curl = curl_init($crm_url);

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($curl);

if ($response !== false) {
    // Check if response contains 'success'
    if (strpos($response, 'success') !== false) {
        echo 'Operation successful '.$response;
    } else {
        // Handle other responses
        echo 'Operation failed: ' . $response;
    }
} else {
    // Handle CURL errors
    echo 'CURL error: ' . curl_error($curl);
}

// Close CURL handle
curl_close($curl);


?>

<!-- <script>
    fetch('<?php // echo $crm_url; ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            "vehicle_id": "a22ce293-fb59-edd8-0896-5f9704644898",
            method: "fetchVehicle"
        })


    }).then((res) => {
        console.log(res);
    })
</script> -->


<!-- 
<td>
    <?php
    // print_r($vData['images']);
    // $images_list = '';
    // foreach ($vData['images'] as $img) {
    //     print_r($img);
    //     if (file_exists("vehicles/" . $img) && !empty($img)) {
    //         $images_list .= '<div class="delImg"><a id="delete-btn" href="./deleteImages.php?vehicle_id=' . $vData['id'] . '&image=' . $img . '" >X</a>
    //                                         <div id="delImg"><img src="vehicles/' . $img . '" width="100" height="100" style="padding:7px; display: inline-block; float: left;" /></div></div>';
    //     }
    // }
    // if ($images_list != '') {
    // ?>
    //     <a class="show_popup_bal" id="image_<?php // echo $count; ?>" style="display: inline-block;height:30px;width:100%;">
    //         VIEW
    //         <img src="vehicles/<?php // echo $vData['images'][0]; ?>" style="width: 100%; height: 100%; object-fit:cover;" />
    //     </a>
    //     <div class="popup_bal" id="popup_image_<?php // echo $count; ?>">
    //         <div style="width: 214px;">
    //             <div class="PopupCloseButton">X</div>
    //             <?php // echo $images_list; ?>
    //         </div>
    //     </div>
    // <?php
    // }
    ?>
</td>  -->