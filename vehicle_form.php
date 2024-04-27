<?php //print_r(); //print_r($_POST);
require_once './config.php';
require_once './session.php';
require_once './header.php';
require_once './header_nav.php';
// Assuming $data is the array you provided
$data = $_SESSION;
// print_r($_SESSION['VNDR']['VEHICLES']);


// $images = array();
// // echo "ceoo";
// foreach ($_SESSION['VNDR']['VEHICLES'] as $vindx => $vData) {
//     $image = explode(',', $vData['images']);
//     // print_r($image);
//     if ($image) {
//         // Store images as arrays instead of strings
//         // foreach ($image as $k => $v) {
//         //     if($v){

//         //         $image[$k] = array('images' => $v);
//         //     }
//         // }
//         $images[$vindx]['images'] = $image;
//     }
//     print_r($images);
//     echo "<br>"; 
//     echo "<br>"; 
//     echo "<br>"; 
// }
// // print_r($images);
//     // echo "ceoo";
// // Update the session with the new image data
// foreach ($images as $vindx => $vData) {
//     $_SESSION['VNDR']['VEHICLES'][$vindx]['images'] = $vData['images'];
// }


?>



<style>
    .li-item {
        padding: 8px;
        float: left;
    }

    .li-item:hover {
        background-color: #eee;
    }

    .title {
        width: 70%;
    }

    .remove {
        width: 25%;
    }

    .popup_bal {
        cursor: pointer;
        display: none;
        position: absolute;
        z-index: 10000;
    }

    .popup_bal>div {
        background-color: #fff;
        box-shadow: 10px 10px 60px #555;
        display: inline-block;
        height: auto;
        position: relative;
        border-radius: 8px;
        padding: 15px 7px;
        /* right: 100px; */
    }

    .PopupCloseButton {
        background-color: #fff;
        border-radius: 3px;
        cursor: pointer;
        display: inline-block;
        font-family: arial;
        position: absolute;
        top: 1px;
        right: 1px;
        font-size: 16px;
        line-height: 16px;
        width: 16px;
        height: 16px;
        text-align: center;
    }

    .PopupCloseButton:hover {
        background-color: #eeeeee;
    }

    ul {
        list-style: none;
    }

    p {
        margin: 0px !important;
    }

    .show_popup_bal {
        cursor: pointer;
    }

    .overly_layer {
        background: #ccc;
        width: 100%;
        height: 100%;
        position: fixed;
        display: none;
        top: 0;
        left: 0;
        opacity: 0.1;
    }

    .dfl {
        display: flex !important;
        align-items: center !important;
        justify-content: start !important;
        gap: 10px !important;
        padding: 0px !important;
    }

    .veh-box {
        background: #F9F7E0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .veh-box1 {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .txc {
        text-align: center !important;
    }

    .mb8 {
        margin-bottom: 8px;
    }

    .tableMain th {
        background: #f9f4e8 !important;
    }

    .table-hover tbody tr:nth-child(odd)>td {

        background-color: #E0F7F9 !important;
    }

    .table-hover tbody tr:hover td {
        background-color: #fff !important;
        color: #000;

    }

    .pending {
        /* background: #EF7C8E !important; */
    }

    .images-dropdown.show {
        display: flex !important;
        flex-wrap: wrap;
        width: 200%;
    }

    .f12 {
        font-size: 12px !important;
    }

    .p48 {
        padding: 0px 48px !important;
    }
</style>
<div class="me-auto ms-auto mb-4 container pe-5 ps-5 p48">
    <h2 class="fw-bolder me-auto ms-auto mt-5 text-primary text-start text-uppercase" data-pg-name="vehiclelist">Vehicle List</h2>
    <a href="./addVehical.php">


        <img src="./images/addVehicle.png" alt="">
        <!-- <div class="border-secondary d-inline-grid me-auto modal modal-body modal-content modal-dialog ms-auto pe-auto ps-auto addNewVehicle">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="3em" class="me-auto ms-auto text-secondary" data-pg-name="add vehicle" fill="currentColor">
                <g>
                    <path fill="none" d="M0 0h24v24H0z"></path>
                    <path d="M17 20H7v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-1H3v-8H2V8h1V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v3h1v4h-1v8h-1v1a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1v-1zM5 5v9h14V5H5zm0 11v2h4v-2H5zm10 0v2h4v-2h-4z"></path>
                </g>
            </svg>
            <h3 class="fs-5 fw-normal ms-auto mt-2 text-center text-light-emphasis text-uppercase w-100">Add New Vehicle</h3>
        </div> -->
    </a>
</div>

<div class="container h-auto me-auto mh-100 ms-auto mw-100 pe-5 ps-5 w-auto p48">
    <div class="border border-secondary d-flex h-100 me-auto mh-100 ms-auto mt-5 mw-75 row" data-bs-toggle="popover">
    </div>
</div>
<div class=" h-100 me-auto mh-100 ms-auto mt-3 mw-100 row" data-bs-toggle="popover">
    <div class="justify-content-center row">
        <div class="col-md-4 text-center">
            <h1 class="mt-4 text-primary text-uppercase ff f600">All Vehicles</h1>
            <p class="fst-italic ff f16">Here you will find all your vehicle's descriptions, features, and pricing. Please set accordingly.</p>
        </div>
    </div>
</div>


<!-- ALL VEHICLES -->
<div class="me-auto ms-auto mb-5 allVehicles w-100">
    <div class="text-center" style="width: 100%; padding: 0; float: left; border: 1px solid #ddd; border-top: none; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12); margin-bottom:5rem!important;">
        <table data-toggle="table" data-classes="table table-hover table-condensed" data-striped="true" data-sort-name="DateEntered" data-sort-order="desc" data-pagination="true" class="table-hover">
            <thead>
                <tr class="tableMain">
                    <th class="col-xs-1" data-field="Photos">Photos</th>
                    <th class="col-xs-1" data-field="Passenger" data-sortable="true"><i title="" class="ipticm prefix" data-ipt-icomoon="&#xe7fd;" style="font-size:18px;"></th>
                    <th class="col-xs-1" data-field="Vehicle" data-sortable="true">Vehicle Type</th>
                    <th class="col-xs-1" data-field="Make" data-sortable="true">Make</th>
                    <th class="col-xs-1" data-field="Model" data-sortable="true">Model</th>
                    <th class="col-xs-1" data-field="Color" data-sortable="true">Color</th>
                    <th class="col-xs-1" data-field="Features" data-sortable="true">Features</th>
                    <th class="col-xs-1" data-field="Rates" data-sortable="true">Rates</th>
                    <th class="col-xs-1" data-field="Quantity" data-sortable="true">Qty</th>
                    <th class="col-xs-1" data-field="Action">Actions</th>

                </tr>
            </thead>
            <tbody>
                <?php
                // if (isset($vehicle_data))
                if (isset($_SESSION['VNDR']['VEHICLES'])) { //print_r($_SESSION['VNDR']['email1']);
                    $count = 0;
                    foreach ($_SESSION['VNDR']['VEHICLES'] as $vindx => $vData) {
                ?> <?php if (!empty($vData['name'])) : ?>
                            <tr id="tr-id-<?php echo $count; ?>" class="<?php
                                                                        if ($vData['published_c'] == 'Yes')
                                                                            echo 'tr-class-2';
                                                                        else
                                                                            echo 'pending ';
                                                                        ?>">



                                <td>
                                    <?php
                                    // echo "<br/>";
                                    // print_r($vData['images']);
                                    $images1 = explode(',', $vData['images']);
                                    // print_r($images[0]);
                                    $images = array();
                                    $i = 0;
                                    while ($i < count($images1)) {
                                        if ($images1[$i] != '') {

                                            $images[$i] = $images1[$i];
                                        }
                                        $i++;
                                    }



                                    $images_list = '';
                                    foreach ($images as $img) {
                                        if (file_exists("vehicles/" . $img) && !empty($img)) {
                                            $images_list .= '<div class="delImg"><a id="delete-btn" href="./deleteImages.php?vehicle_id=' . $vData['id'] . '&image=' . $img . '" >X</a>
                                            <div id="delImg"><img src="vehicles/' . $img . '" width="100" height="100" style="padding:7px; display: inline-block; float: left;" /></div></div>';
                                            // $images_list .= '<img src="vehicles/' . $img . '" width="100" height="100" style="padding:7px; display: inline-block; float: left;" />';
                                        }
                                        // print_r($images_list);
                                    }
                                    if ($images_list != '') {
                                    ?>
                                        <div class="dropdown">
                                            <a class=" dropdown-toggle xenoDd" type="button" id="dropdownvehicle" data-bs-toggle="dropdown" onclick="" aria-expanded="false"> <img src="vehicles/<?php echo $images[0]; ?>" style="width: 100%; height: 100%; object-fit:cover;" /></a>
                                            <ul class="dropdown-menu images-dropdown" aria-labelledby="dropdownvehicle">
                                                <div class="PopupCloseButton" id="PopupCloseButton">X</div>
                                                <?php echo $images_list; ?>
                                            </ul>
                                        </div>
                                        <!-- <a class="show_popup_bal" id="imagePopup" style="display: inline-block;height:30px;width:100%;">
                                            VIEW
                                            <img src="vehicles/<?php // echo $images[0]; 
                                                                ?>" style="width: 100%; height: 100%; object-fit:cover;" />
                                        </a>
                                        <div class="popup_bal" id="imageBal">
                                            <div style="width: 214px;">
                                                <div class="PopupCloseButton" id="PopupCloseButton">X</div>
                                                <?php // echo $images_list; 
                                                ?>
                                            </div>
                                        </div> -->
                                    <?php
                                    }
                                    ?>
                                </td>





                                <td><?php echo $vData['vehicle_capacity']; ?></td>
                                <td><?php echo $vData['name'] ?></td>
                                <td><?php echo $vData['vehicle_make']; ?></td>
                                <td><?php echo $vData['vehicle_model']; ?></td>
                                <td><?php echo $vData['vehicle_color']; ?></td>
                                <td>
                                    <?php
                                    $features_list = '';
                                    $interior_styles_str = $vData['interior_style'];
                                    $interior_styles_arr = explode('^', trim($interior_styles_str, '^'));
                                    $interior_styles_arr1 = array_filter($interior_styles_arr);
                                    $interior_styles_arr = array();
                                    $i = 0;
                                    while ($i < count($interior_styles_arr1)) {
                                        if ($interior_styles_arr1[$i] != '' && $interior_styles_arr1[$i] != ",") {

                                            $interior_styles_arr[$i] = $interior_styles_arr1[$i];
                                        }
                                        $i++;
                                    }
                                    foreach ($interior_styles_arr as $ftr) {
                                        if (!empty($ftr)) {
                                            $features_list .= '<li><p class="f12"><i title="" class="ipticm prefix" data-ipt-icomoon="&#xe8d0;"></i>' . $ftr . '</p></li>';
                                        }
                                    }

                                    $onboard_luxury_str = $vData['onboard_luxury'];
                                    $onboard_luxury_arr = explode('^', trim($onboard_luxury_str, '^'));
                                    $onboard_luxury_arr1 = array_filter($onboard_luxury_arr);
                                    $onboard_luxury_arr = array();
                                    $i = 0;
                                    while ($i < count($onboard_luxury_arr1)) {
                                        if ($onboard_luxury_arr1[$i] != '' && $onboard_luxury_arr1[$i] != ",") {

                                            $onboard_luxury_arr[$i] = $onboard_luxury_arr1[$i];
                                        }
                                        $i++;
                                    }
                                    foreach ($onboard_luxury_arr as $ftr) {
                                        if (!empty($ftr)) {
                                            $features_list .= '<li><p class="f12"><i title="" class="ipticm prefix" data-ipt-icomoon="&#xe8d0;"></i>' . $ftr . '</p></li>';
                                        }
                                    }
                                    $media_capability_str = $vData['media_capability'];
                                    $media_capability_arr = explode('^', trim($media_capability_str, '^'));
                                    $media_capability_arr1 = array_filter($media_capability_arr);

                                    $media_capability_arr = array();
                                    $i = 0;
                                    while ($i < count($media_capability_arr1)) {
                                        if ($media_capability_arr1[$i] != '' && $media_capability_arr1[$i] != ",") {

                                            $media_capability_arr[$i] = $media_capability_arr1[$i];
                                        }
                                        $i++;
                                    }
                                    foreach ($media_capability_arr as $ftr) {
                                        if (!empty($ftr)) {
                                            $features_list .= '<li><p class="f12"><i title="" class="ipticm prefix" data-ipt-icomoon="&#xe8d0;"></i>' . $ftr . '</p></li>';
                                        }
                                    }
                                    $complimentary_str = $vData['complimentary'];
                                    $complimentary_str = explode('^', trim($complimentary_str, '^'));
                                    $complimentary_str1 = array_filter($complimentary_str);
                                    $complimentary_str = array();
                                    $i = 0;
                                    while ($i < count($complimentary_str1)) {
                                        if ($complimentary_str1[$i] != '' && $complimentary_str1[$i] != ",") {

                                            $complimentary_str[$i] = $complimentary_str1[$i];
                                        }
                                        $i++;
                                    }
                                    foreach ($complimentary_str as $ftr) {
                                        if (!empty($ftr)) {
                                            $features_list .= '<li><p class="f12"><i title="" class="ipticm prefix" data-ipt-icomoon="&#xe8d0;"></i>' . $ftr . '</p></li>';
                                        }
                                    }
                                    if ($features_list != '') {
                                    ?>
                                        <a class="cursor-pointer" type="button" id="dropdownvehicle" data-bs-toggle="dropdown" onclick="" aria-expanded="false">VIEW</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownvehicle">
                                            <?php echo $features_list; ?>
                                        </ul>
                                        <!-- <a class="show_popup_bal" id="feature_<?php // echo $count; 
                                                                                    ?>">VIEW</a>
                                        <div class="popup_bal" id="popup_feature_<?php // echo $count; 
                                                                                    ?>">
                                            <div>
                                                <div class="PopupCloseButton">X</div>
                                                <ul>
                                                    <?php // echo $features_list; 
                                                    ?>
                                                </ul>
                                            </div>
                                        </div> -->
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a type="button" id="dropdownvehicle" data-bs-toggle="dropdown" onclick="" aria-expanded="false">VIEW</a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownvehicle">
                                        <div class="PopupCloseButton">X</div>
                                        <span class="<div class=" PopupCloseButton">
    </div>
    <span class="f12"><strong>Base Hourly: </strong>$<?php echo $vData['base_hourly_rate']; ?></span><br />
    <span class="f12"><strong>Minimum Hours: </strong><?php echo number_format($vData['base_min_hours'], 0, '.', ','); ?> hour(s)</span><br />
    <span class="f12"><strong>Additional Hourly: </strong>$<?php echo $vData['base_additional_hourly']; ?></span><br />
    <span class="f12"><strong>Fuel Surcharge: </strong><?php echo $vData['fuel_surcharge_percentage']; ?>%</span><br />
    <span class="f12"><strong>Driver Gratuity: </strong><?php echo $vData['driver_gratuity_percentage']; ?>%</span><br><span class="f12"><strong>Base Hourly: </strong>$<?php echo $vData['base_hourly_rate']; ?></span><br />
    <span class="f12"><strong>Minimum Hours: </strong><?php echo number_format($vData['base_min_hours'], 0, '.', ','); ?> hour(s)</span><br />
    <span class="f12"><strong>Additional Hourly: </strong>$<?php echo $vData['base_additional_hourly']; ?></span><br />
    <span class="f12"><strong>Fuel Surcharge: </strong><?php echo $vData['fuel_surcharge_percentage']; ?>%</span><br />
    <span class="f12"><strong>Driver Gratuity: </strong><?php echo $vData['driver_gratuity_percentage']; ?>%</span><br />
    </ul>
    <!-- <a class="show_popup_bal" id="rate_<?php // echo $count; 
                                            ?>">VIEW</a>
                                    <div class="popup_bal" id="popup_rate_<?php // echo $count; 
                                                                            ?>">
                                        <div>
                                            <div class="PopupCloseButton">X</div>
                                            <span><strong>Base Hourly: </strong>$<?php // echo $vData['base_hourly_rate']; 
                                                                                    ?></span><br />
                                            <span><strong>Minimum Hours: </strong><?php // echo number_format($vData['base_min_hours'], 0, '.', ','); 
                                                                                    ?> hour(s)</span><br />
                                            <span><strong>Additional Hourly: </strong>$<?php // echo $vData['base_additional_hourly']; 
                                                                                        ?></span><br />
                                            <span><strong>Fuel Surcharge: </strong><?php // echo $vData['fuel_surcharge_percentage']; 
                                                                                    ?>%</span><br />
                                            <span><strong>Driver Gratuity: </strong><?php // echo $vData['driver_gratuity_percentage']; 
                                                                                    ?>%</span><br />
                                        </div>
                                    </div> -->
    </td>
    <td><?php echo $vData['vehicle_quantity']; ?></td>
    <td>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle xenoDd" type="button" id="dropdownvehicle" data-bs-toggle="dropdown" onclick="" aria-expanded="false">EDIT</button>
            <ul class="dropdown-menu" aria-labelledby="dropdownvehicle">
                <li><a href="editVehicle.php?vehicle_id=<?php echo $vData['id']; ?>" title="View <?php echo $vData['name']; ?>" style="margin: 0 auto; display: inline-block; text-align: center;">VIEW</a></li>
                <li><a href="addVehical.php?vehicle=<?php echo $vData['id']; ?>" title="Edit <?php echo $vData['name']; ?>" style="margin: 0 auto; display: inline-block; text-align: center;">EDIT</a></li>
                <li><a class="vdeletebtn" href="delete.php?vehicle=<?php echo $vData['id']; ?>" title="Delete <?php echo $vData['name']; ?>" style="margin: 0 auto; display: inline-block; text-align: center; color: red;" data-id="<?php echo $vData['id']; ?>">DELETE</a></li>
            </ul>
        </div> <!--delete.php?vehicle=<?php echo $vData['id']; ?>-->
    </td>


    </tr>
<?php endif ?>
<?php
                        $count++;
                    }
                }
?>
</tbody>
</table>


</div>
</div>
<!-- all vehicles -->

<script>
    // // Function to close the popup when the close button is clicked
    // document.getElementById("imagePopup").addEventListener('click', function() {
    //     document.getElementById("imageBal").style.display = 'block';
    // });
    // document.getElementById("PopupCloseButton").addEventListener('click', function() {
    //     document.getElementById("imageBal").style.display = 'none';
    // });

    // document.querySelectorAll('.PopupCloseButton').forEach(function(button) {
    //     button.addEventListener('click', function() {
    //         document.querySelectorAll('.popup_bal').forEach(function(popup) {
    //             popup.style.display = 'none';
    //         });
    //     });
    // });
    // Event listener for clicking on imagePopup
    document.querySelectorAll('.show_popup_bal').forEach(function(popup) {
        popup.addEventListener('click', function() {
            document.getElementById("imageBal").style.display = 'block';
        });
    });

    // Event listener for clicking on PopupCloseButton
    document.getElementById("PopupCloseButton").addEventListener('click', function() {
        document.getElementById("imageBal").style.display = 'none';
    });

    // Function to show the popup when the corresponding button is clicked
    document.querySelectorAll('.show_popup_bal').forEach(function(button) {
        button.addEventListener('click', function() {
            // Hide all popups and show the corresponding popup
            document.querySelectorAll('.popup_bal').forEach(function(popup) {
                popup.style.display = 'none';
            });
            document.querySelector('#popup_' + this.id).style.display = 'block';
            document.querySelector('.overly_layer').style.display = 'block';
        });
    });

    // Function to close the popup when the overlay layer is clicked
    document.querySelector('.overly_layer').addEventListener('click', function() {
        document.querySelectorAll('.popup_bal').forEach(function(popup) {
            popup.style.display = 'none';
        });
        this.style.display = 'none';
    });

    jQuery(window).load(function() {
        jQuery('.PopupCloseButton').click(function() {
            jQuery('.popup_bal').hide();
        });
        jQuery('.show_popup_bal').on('click', function() {
            jQuery('.popup_bal').hide();
            jQuery('#popup_' + this.id).show();
            jQuery('.overly_layer').show();
        });
        jQuery('.overly_layer').click(function() {
            jQuery('.popup_bal').hide();
            jQuery('.overly_layer').hide();
        });
        jQuery('.vdeletebtn').click(function() {
            /*return confirm('Are you sure you want to delete this Vehicle?')
                $.ajax({
              url: 'delete.php?vehicle=<?php echo $vData['id']; ?>',
              type: 'DELETE',
              success: function(data) {
                //play with data
              }
            });
            alert(jQuery(this).closest('tr').prop('class'));
            
            jQuery(this).closest('tr').fadeOut();   */
            var vid = jQuery(this).attr('data-id');
            /**/
            if (confirm('Are you sure you want to delete this Vehicle?')) {
                jQuery(this).closest('tr').fadeOut();
                jQuery.ajax({
                    url: 'delete.php?vehicle=' + vid,
                    type: 'DELETE',
                    success: function(data) {
                        //alert(vid);
                        jQuery(this).closest('tr').fadeOut();
                        //play with data
                    }
                });
            }
        });

    });
    /* function deletethis(vid, id){
         //var confirm =  confirm('Are you sure you want to delete this Vehicle?');
         if (confirm('Are you sure you want to delete this Vehicle?')) {
                                 
             jQuery.ajax({
               url: 'delete.php?vehicle='+vid,
               type: 'DELETE',
               success: function(data) {
                 alert(vid);
                 //play with data
               }
             });
         }
         alert(id);

     }*/
</script>

<?php require_once './footer.php'; ?>