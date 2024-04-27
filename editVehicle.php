<?php

$page = 'vehicle';
require_once './config.php';
require_once './session.php';
require_once './vehicle_options.php';
require './header.php';
require_once './header_nav.php';
$vehicle_id = $_GET['vehicle_id'];
// print_r($vehicle_id);
$data["vehicle_id"] = $vehicle_id;
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
// print_r($vehicle);
$vehicleImages = explode(',', $vehicle["images"]);
$vehicle['interior_style'] = explode(',', $vehicle['interior_style']);
$io = 0;
while ($io < count($vehicle['interior_style'])) { // Change ">" to "<"
    $vehicle['interior_style'][$io] = str_replace('^', '', $vehicle['interior_style'][$io]);
    $io++;
}
$vehicle['onboard_luxury'] = explode(',', $vehicle['onboard_luxury']);
$io = 0;
while ($io < count($vehicle['onboard_luxury'])) { // Change ">" to "<"
    $vehicle['onboard_luxury'][$io] = str_replace('^', '', $vehicle['onboard_luxury'][$io]);
    $io++;
}
$vehicle['media_capability'] = explode(',', $vehicle['media_capability']);
$io = 0;
while ($io < count($vehicle['media_capability'])) { // Change ">" to "<"
    $vehicle['media_capability'][$io] = str_replace('^', '', $vehicle['media_capability'][$io]);
    $io++;
}
$vehicle['complimentary'] = explode(',', $vehicle['complimentary']);
$io = 0;
while ($io < count($vehicle['complimentary'])) { // Change ">" to "<"
    $vehicle['complimentary'][$io] = str_replace('^', '', $vehicle['complimentary'][$io]);
    $io++;
}
?>
<style>
    .veh-box {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 5px;
    }

    .imgBox {
        max-height: 200px;
    }

    .editVehicle {

        padding: 10px 20px;
        background: #DFCA8B;
        color: #fff !important;
        text-decoration: none !important;
        border-radius: 5px;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.4);
        transition: 0.3s all ease-in-out;
    }

    .editVehicle:hover {
        box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.4);
    }

    @media(max-width:480px) {

        .smwf {
            width: 100% !important;
        }
    }
</style>

<div class="me-auto ms-auto mb-5 allVehicles w-100 position-relative">
    <div class="d-flex align-items-end justify-content-end">

        <a class="editVehicle" href="addVehical.php?vehicle=<?php echo $vehicle_id; ?>">Edit Vehicle</a>
    </div>
    <div class="row w-100 mt-4" stye>
        <div class="col-sm-12 col-md-4 ps-auto shadow-sm smwf" id="smwf">
            <h1 class="fst-italic text-secondary vehicleTitle txc  ff"><?php echo $vehicle['name']; ?></h1>

            <h6 class="fst-italic text-light-emphasis mb8">Vehicle Year : <?php echo $vehicle['vehicle_year']; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Vehicle Make : <?php echo $vehicle['vehicle_make']; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Vehicle Model : <?php echo $vehicle['vehicle_model']; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Vehicle Count : <?php echo $vehicle['vehicle_quantity']; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Vehicle Passenger Count : <?php echo $vehicle['vehicle_capacity']; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Luggage Limit : <?php echo $vehicle['luggage_limit']; ?></h6>
            <!-- <img src="https://unlimitedcharters.com/vendor/system/backend/images/24_pax_out_black.png" sizes="4000px" width="425" class="mt-2 w-100"> -->
            <div class="veh-box">
                <?php
                
                foreach ($vehicleImages as $img) {
                    if($img != ""){
                        echo '<div class="imgBox" style="width:100%;height:300px;margin-bottom:10px;">';
                        echo '<img src="./vehicles/' . $img . '" alt="vehicle" style="width:100%;height:100%;objext-fit:cover;">';
                        echo '</div>';
                    }
                  
                }
                ?>


            </div>

        </div>
        <div class="col-sm-12 col-md-4  overflow-auto pe-3 shadow-sm smwf" id="smwf">
            <h1 class="fst-italic text-secondary vehicleTitle txc ff">Vehicle Features</h1>

            <div class="col-md-12 float-end me-auto ms-auto">
                <div class="col-md-7 col-sm-12 m-0 p-0">
                    <label class="form-check-label fs-6 fw-semibold text-primary text-uppercase f16" for="formInput22">
                        <b class="fst-italic fw-bold text-decoration-underline text-uppercase">Interior Style</b>
                    </label>
                    <?php
                    $c = 0;
                    // print_r($interior_style_options);
                    // foreach($interior_style_options as $interior_style){
                        
                        
                    //         echo '<div class="ipt_uif_label_column column_2 d-flex gap-1"><input  class="filled-in" name="interior_style[]" id="interior_style_' . $c . '" value=" ' . $interior_style. ' " type="checkbox" checked><label class="eform-label-with-tabindex" tabindex="0" for="interior_style_' . $c . '" data-labelcon="&#xe18e;"> ' . $interior_style . ' </label></div>';
                       
                    //     $c++;
                    // }
                    foreach ($interior_style_options as $iindx => $ivalue) {
                     
                        if (in_array($iindx, $vehicle['interior_style']))
                            echo '<div class="ipt_uif_label_column column_2 d-flex gap-1"><input  class="filled-in" name="interior_style[]" id="interior_style_' . $c . '" value=" ' . $iindx . ' " type="checkbox" checked><label class="eform-label-with-tabindex" tabindex="0" for="interior_style_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                        else
                            echo '<div class="ipt_uif_label_column column_2 d-flex gap-1"><input  class="filled-in" name="interior_style[]" id="interior_style_' . $c . '" value=" ' . $iindx . ' " type="checkbox"><label class="eform-label-with-tabindex" tabindex="0" for="interior_style_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                        $c++;
                    }
                    ?>
                </div>
                <div class="col-md-5 col-sm-12 m-0 p-0">
                    <b class="fst-italic fw-bold text-decoration-underline text-primary text-uppercase f16">Multi-Media&nbsp;</b>
                    <?php
                    $c = 0;
                    // foreach ($media_capability_options as $media_options) {
                    //     echo '<div class="ipt_uif_label_column column_3 d-flex gap-1"><input  class="filled-in" name="media_capability[]" id="media_capability_' . $c . '" value=" ' . $media_options . ' " type="checkbox"><label class="eform-label-with-tabindex" tabindex="0" for="media_capability_' . $c . '" data-labelcon="&#xe18e;"> ' . $media_options . ' </label></div>';
                    //     $c++;
                    // }
                    foreach ($media_capability_options as $iindx => $ivalue) {
                        if (in_array($iindx, $vehicle['media_capability']))
                            echo '<div class="ipt_uif_label_column column_3 d-flex gap-1"><input  class="filled-in" name="media_capability[]" id="media_capability_' . $c . '" value=" ' . $iindx . ' " type="checkbox" checked><label class="eform-label-with-tabindex" tabindex="0" for="media_capability_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                        else
                            echo '<div class="ipt_uif_label_column column_3 d-flex gap-1"><input  class="filled-in" name="media_capability[]" id="media_capability_' . $c . '" value=" ' . $iindx . ' " type="checkbox"><label class="eform-label-with-tabindex" tabindex="0" for="media_capability_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                        $c++;
                    }
                    ?>
                </div>
                <div class="col-md-7 col-sm-12 m-0 p-0">
                    <b class="fst-italic fw-bold text-decoration-underline text-primary text-uppercase f16">On-Board Luxury</b>
                    <?php
                    $c = 0;
                    // foreach ($onboard_luxury_options as $onboard_luxury) {
                    //     echo '<div class="ipt_uif_label_column column_3 d-flex gap-1"><input  class="filled-in" name="onboard_luxury[]" id="onboard_luxury_' . $c . '" value=" ' . $onboard_luxury . ' " type="checkbox"><label class="eform-label-with-tabindex" tabindex="0" for="onboard_luxury_' . $c . '" data-labelcon="&#xe18e;"> ' . $onboard_luxury . ' </label></div>';
                    //     $c++;
                    // }
                    foreach ($onboard_luxury_options as $iindx => $ivalue) {
                        if (in_array($iindx, $vehicle['onboard_luxury']))
                            echo '<div class="ipt_uif_label_column column_3 d-flex gap-1"><input  class="filled-in" name="onboard_luxury[]" id="onboard_luxury_' . $c . '" value=" ' . $iindx . ' " type="checkbox" checked><label class="eform-label-with-tabindex" tabindex="0" for="onboard_luxury_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                        else
                            echo '<div class="ipt_uif_label_column column_3 d-flex gap-1"><input  class="filled-in" name="onboard_luxury[]" id="onboard_luxury_' . $c . '" value=" ' . $iindx . ' " type="checkbox"><label class="eform-label-with-tabindex" tabindex="0" for="onboard_luxury_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                        $c++;
                    }
                    ?>
                </div>
                <div class="col-md-5 col-sm-12 m-0 p-0">
                    <b class="fst-italic fw-bold text-decoration-underline text-primary text-uppercase f16">Complimentary</b>
                    <?php
                    $c = 0;
                    // foreach ($complimentary_options as $complimentary) {

                    //     echo '<div class="ipt_uif_label_column column_3 d-flex gap-1"><input  class="filled-in" name="complimentary[]" id="complimentary_' . $c . '" value=" ' . $complimentary . ' " type="checkbox"><label class="eform-label-with-tabindex" tabindex="0" for="complimentary_' . $c . '" data-labelcon="&#xe18e;"> ' . $complimentary . ' </label></div>';
                    //     $c++;
                    // }
                    foreach ($complimentary_options as $iindx => $ivalue) {
                        if (in_array($iindx, $vehicle['complimentary']))
                            echo '<div class="ipt_uif_label_column column_3 d-flex gap-1"><input  class="filled-in" name="complimentary[]" id="complimentary_' . $c . '" value=" ' . $iindx . ' " type="checkbox" checked><label class="eform-label-with-tabindex" tabindex="0" for="complimentary_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                        else
                            echo '<div class="ipt_uif_label_column column_3 d-flex gap-1"><input  class="filled-in" name="complimentary[]" id="complimentary_' . $c . '" value=" ' . $iindx . ' " type="checkbox"><label class="eform-label-with-tabindex" tabindex="0" for="complimentary_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                        $c++;
                    }
                    ?>
                </div>

            </div>


        </div>
        <div class="col-sm-12 col-md-4 ps-auto shadow-sm smwf" id="smwf">
            <h1 class="fst-italic text-secondary vehicleTitle txc  ff">Vehicle Pricing</h1>

            <h6 class="fst-italic text-light-emphasis mb8">Base Hourly Rate : $<?php echo number_format($vehicle['base_hourly_rate'],2); ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Base Hours : <?php echo $vehicle['base_min_hours']; ?> Hours</h6>
            <hr style="background: #DFCA8B; height:2px!important;">
            <h1 class="fst-italic text-secondary txc  ff ">Weekly Hourly Rate</h1>
            <h6 class="fst-italic text-light-emphasis mb8">Hourly Rate Monday: $<?php echo number_format($vehicle['hourly_rate_monday'],2); ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Hourly Rate Tuesday: $<?php echo number_format($vehicle['hourly_rate_tuesday'],2);; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Hourly Rate Wednesday : $<?php echo number_format($vehicle['hourly_rate_wednesday'],2);; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Hourly Rate Thursday : $<?php echo number_format($vehicle['hourly_rate_thursday'],2);; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Hourly Rate Friday : $<?php echo number_format($vehicle['hourly_rate_friday'],2);; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Hourly Rate Saturday : $<?php echo number_format($vehicle['hourly_rate_saturday'],2);; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Hourly Rate Sunday : $<?php echo number_format($vehicle['hourly_rate_sunday'],2);; ?></h6>
            <hr style="background: #DFCA8B; height:2px!important;">
            <h1 class="fst-italic text-secondary txc  ff ">Special Rate</h1>


            <h6 class="fst-italic text-light-emphasis mb8">Special Rate For : <?php echo $vehicle['VEHICLESRATES']['a1add3be-4a34-9685-892f-65ec3e749a1c']['name_special_rate']; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Special Rate Monday: $<?php echo $vehicle['VEHICLESRATES']['a1add3be-4a34-9685-892f-65ec3e749a1c']['special_hourly_rate_monday']; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Special Rate Tuesday: $<?php echo $vehicle['VEHICLESRATES']['a1add3be-4a34-9685-892f-65ec3e749a1c']['special_hourly_rate_tuesday']; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Special Rate Wednesday : $<?php echo $vehicle['VEHICLESRATES']['a1add3be-4a34-9685-892f-65ec3e749a1c']['special_hourly_rate_wednesday']; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Special Rate Thursday : $<?php echo $vehicle['VEHICLESRATES']['a1add3be-4a34-9685-892f-65ec3e749a1c']['special_hourly_rate_thursday']; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Special Rate Friday : $<?php echo $vehicle['VEHICLESRATES']['a1add3be-4a34-9685-892f-65ec3e749a1c']['special_hourly_rate_friday']; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Special Rate Saturday : $<?php echo $vehicle['VEHICLESRATES']['a1add3be-4a34-9685-892f-65ec3e749a1c']['special_hourly_rate_saturday']; ?></h6>
            <h6 class="fst-italic text-light-emphasis mb8">Special Rate Sunday : $<?php echo $vehicle['VEHICLESRATES']['a1add3be-4a34-9685-892f-65ec3e749a1c']['special_hourly_rate_sunday']; ?></h6>



        </div>

    </div>
</div>
</div>
<script>
    function addResponsiveClass() {
        var screenWidth = window.innerWidth;
        var myDiv = document.getElementById('smwf');

        if (screenWidth < 480) {
            myDiv.classList.add('smwf');
        } else {
            myDiv.classList.remove('smwf');
        }
    }

    // Initial call
    addResponsiveClass();

    // Event listener for resize
    window.addEventListener('resize', function() {
        addResponsiveClass();
    });
</script>

<?php require './footer.php'; ?>