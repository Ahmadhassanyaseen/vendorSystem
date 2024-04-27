<?php
require_once './vehicle_options.php';
// require_once './session.php';
// require_once './header.php';
// require_once './header_nav.php';
// print_r($vehicle_type_options);
// print_r($default_values);
?>
<style>
    .ipt-uif-custom-material-light-blue .ipt_uif_uploader .fileinput-button input {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
    }

    .vehicleAddBtn {
        background: #e3b04b;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        color: #fff;
        width: 30%;
        margin: auto !important;
    }

    #ipt_fsqm_form_52_freetype_15>div {
        display: flex;
        flex-direction: column;
    }

    @media(max-width:480px) {
        .ipt-uif-custom-material-light-blue .ipt_uif_question label.ipt_uif_question_title {
            width: 100% !important;
        }

        .ipt-uif-custom-material-light-blue .ipt_uif_question label.ipt_uif_question_title {
            width: 100% !important;

        }
    }

    /* #ipt_fsqm_form_52_layout_0_inner>div:nth-child(4) {
        min-height: 59px !important;
    }
    #vehicle_year,
    #vehicle_color {
        min-width: 45% !important;
    } */
</style>
<div class="mt-5 container" style="padding:0px 4rem;">
    <form class="w-100" method="post" action="#" id="registration_form" onsubmit="return validate_vehicle(event, 'all');" enctype="multipart/form-data">
        <input type="hidden" name="vehicle" value="<?php if (isset($_REQUEST['vehicle']) && !empty($_REQUEST['vehicle'])) echo $_REQUEST['vehicle']; ?>">
        <input type="hidden" name="vendor" value="<?php if (isset($_SESSION['VNDR']['id']) && !empty($_SESSION['VNDR']['id'])) echo $_SESSION['VNDR']['id']; ?>">
        <div class="container-fluid ipt-eform-content w-100 p-3" style="max-width:100%!important;">
            <?php
            // require_once 'logout_link.php';
            // $has_missing_fields = false;
            // if (isset($vehicle_object['MissingFields']) && !empty($vehicle_object['MissingFields'])) {
            //     $has_missing_fields = true;
            //     $errors[] = "This vehicle is not yet published to be live because following fields are missing. " . PHP_EOL . $vehicle_object['MissingFields'];
            // }
            if (($ispost == true && sizeof($errors) > 0) || $has_missing_fields == true)
                foreach ($errors as $error) {
            ?>
                <!--<div id="ipt_fsqm_form_56_tab_1" class="ipt_fsqm_form_tab_panel ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-2" role="tabpanel" style="" aria-hidden="true">-->
                <!--<div id="ipt_fsqm_form_56_layout_1_inner" class="ipt-eform-layout-wrapper">-->

                <!--<div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_blank_container" id="ipt_fsqm_form_56_design_8">-->
                <div class="ipt_uif_column_inner">
                    <div class="ipt_uif_blank_container">
                        <div class="alert alert-danger">
                            <span><?php echo $error; ?></span>
                        </div>
                    </div>
                    <div class="clear-both">
                    </div>
                </div>
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->
            <?php
                }
                                            // echo "check";
                                            // print_r($vehicle_object);
                                            //     if($vehicle_object['interior_style'] !== " " || count($vehicle_object['interior_style']) > 0){
                                            //     $vehicle_object['interior_style'] = explode(',', $vehicle_object['interior_style']);
                                            //     $io = 0;
                                            //     while ($io < count($vehicle_object['interior_style'])) { // Change ">" to "<"
                                            //         $vehicle_object['interior_style'][$io] = str_replace('^', '', $vehicle_object['interior_style'][$io]);
                                            //         $io++;
                                            //     }
                                            //     $vehicle_object['onboard_luxury'] = explode(',', $vehicle_object['onboard_luxury']);
                                            //     $io = 0;
                                            //     while ($io < count($vehicle_object['onboard_luxury'])) { // Change ">" to "<"
                                            //         $vehicle_object['onboard_luxury'][$io] = str_replace('^', '', $vehicle_object['onboard_luxury'][$io]);
                                            //         $io++;
                                            //     }
                                            //     $vehicle_object['media_capability'] = explode(',', $vehicle_object['media_capability']);
                                            //     $io = 0;
                                            //     while ($io < count($vehicle_object['media_capability'])) { // Change ">" to "<"
                                            //         $vehicle_object['media_capability'][$io] = str_replace('^', '', $vehicle_object['media_capability'][$io]);
                                            //         $io++;
                                            //     }
                                            //     $vehicle_object['complimentary'] = explode(',', $vehicle_object['complimentary']);
                                            //     $io = 0;
                                            //     while ($io < count($vehicle_object['complimentary'])) { // Change ">" to "<"
                                            //         $vehicle_object['complimentary'][$io] = str_replace('^', '', $vehicle_object['complimentary'][$io]);
                                            //         $io++;
                                            //     }
                                            // }
                                            // print_r($vehicle_object);
                                            function removeCarat(&$array)
                                            {
                                                if (!empty($array) && is_array($array)) {
                                                    foreach ($array as $key => &$value) {
                                                        if (is_array($value)) {
                                                            removeCarat($value); // Recursive call for nested arrays
                                                        } else {
                                                            $value = str_replace('^', '', $value);
                                                        }
                                                    }
                                                }
                                            }
                                           if(is_array($vehicle_object['interior_style'])){

                                           }
                                           else{

                                        
            $vehicle_object['interior_style'] = explode(',', $vehicle_object['interior_style']);
                                            $vehicle_object['onboard_luxury'] = explode(',', $vehicle_object['onboard_luxury']);
            $vehicle_object['media_capability'] = explode(',', $vehicle_object['media_capability']);
            $vehicle_object['complimentary'] = explode(',', $vehicle_object['complimentary']);
                $vehicle_object['images'] = explode(',', $vehicle_object['images']);
                
                                            // Call the function for each array in $vehicle_object
                                            removeCarat($vehicle_object['interior_style']);
                                            removeCarat($vehicle_object['onboard_luxury']);
                                            removeCarat($vehicle_object['media_capability']);
                                            removeCarat($vehicle_object['complimentary']);

                                           }
            ?>

            <div id="smartwizard" style="box-shadow: none;">
                <ul style="display: none;">
                    <li><a href="#step-1"><span>DETAILS</span></a></li>
                    <li><a href="#step-2"><span>FEATURES</span></a></li>
                    <li><a href="#step-3"><span>HOURLY RATES</span></a></li>
                    <li><a href="#step-4"><span>SPECIAL RATES (OPTIONAL)</span></a></li>
                    <li><a href="#step-5"><span>SURCHARGES (OPTIONAL)</span></a></li>
                    <li><a href="#step-6"><span>PHOTOS</span></a></li>
                </ul>

                <div>
                    <div id="step-1" class="tab-pane step-content">
                        <div id="ipt_fsqm_form_52_layout_0_inner" class="ipt-eform-layout-wrapper">
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_main_heading_column" style="">
                                <div class="ipt_uif_column_inner">
                                    <h3 class="ipt_fsqm_main_heading ipt_uif_heading ipt_uif_divider ipt_uif_align_left ipt_uif_divider_no_icon ipt_uif_divider_icon_no_bg"> <span class="ipt_uif_divider_text"> <span class="ipt_uif_divider_text_inner"> DETAILS<span class="subtitle">Page 1 of 6</span> </span> </span>
                                    </h3>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional">
                                <div class="ipt_uif_column_inner side_margin">
                                    <p>
                                        <em>Add a vehicle to your fleet inventory using the module below.</em>
                                    </p>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="row  d-flex w-100 m-0">
                                <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_select col-md-3 w-25" id="ipt_fsqm_form_52_mcq_0" style="">
                                    <div class="ipt_uif_column_inner side_margin">
                                        <div class="ipt_uif_question ipt_uif_question_vertical">
                                            <div class="ipt_uif_question_label" style="margin-bottom: 0px;">
                                                <label class="ipt_uif_question_title ipt_uif_label" for="vehicle_type">Vehicle Type<span class="ipt_uif_question_required">*</span></label>
                                                <div class="clear-both"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="xeno col-md-9">


                                    <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_0" style="">
                                        <div class="ipt_uif_column_inner side_margin">
                                            <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                                <div class="ipt_uif_question_content">
                                                    <div class="input-field has-icon">
                                                        <input class="ipt_uif_text" name="vehicle_make" id="vehicle_make" type="text" placeholder="Vehicle Make (optional)" title="Vehicle Make (Optional)" value="<?php echo $vehicle_object['vehicle_make']; ?>">
                                                        <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe559;"></i>
                                                    </div>
                                                    <div class="clear-both"></div>
                                                </div>
                                            </div>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_23" style="">
                                        <div class="ipt_uif_column_inner side_margin">
                                            <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                                <div class="ipt_uif_question_content">
                                                    <div class="input-field has-icon">
                                                        <input class="ipt_uif_text" name="vehicle_model" id="vehicle_model" maxlength="" type="text" placeholder="Vehicle Model (Optional)" title="Vehicle Model (Optional)" value="<?php echo $vehicle_object['vehicle_model']; ?>">
                                                        <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe559;"></i>
                                                    </div>
                                                    <div class="clear-both"></div>
                                                </div>
                                            </div>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_select" id="ipt_fsqm_form_52_mcq_0" styl>
                                        <div class="ipt_uif_column_inner side_margin">
                                            <div class="ipt_uif_question ipt_uif_question_vertical">
                                                <div class="ipt_uif_question_content">
                                                    <?php
                                                    // echo "check";
                                                    // print_r($vehicle_type_options);
                                                    // print_r($default_values);
                                                    // print_r($vehicle_object);

                                                    ?>
                                                    <select class="ipt_uif_select select2-hidden-accessible" name="vehicle_type" id="vehicle_type" data-placeholder="Select Vehicle Type" placeholder="Select Vehicle Type" title="Select Vehicle Type" data-allow-clear="true" data-theme="eform-material eform-select2-boxy" tabindex="-1" aria-hidden="true">

                                                        <?php

                                                        // foreach ($vehicle_type_options as $vehicle) {
                                                        //     echo '<option value="' . $vehicle . '">' . $vehicle . '</option>';
                                                        // }
                                                        foreach ($vehicle_type_options as $vindx => $vval) {
                                                            if ($vehicle_object['name'] == $vindx)
                                                                echo '<option value="' . $vindx . '" selected>' . $vval . '</option>';
                                                            else
                                                                echo '<option value="' . $vindx . '">' . $vval . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="clear-both">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex w-100 m-0">
                                <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_select col-md-3 w-25" id="ipt_fsqm_form_52_mcq_6" style="">
                                    <div class="ipt_uif_column_inner side_margin">
                                        <div class="ipt_uif_question ipt_uif_question_vertical">
                                            <div class="ipt_uif_question_label" style="margin-bottom: 0px;">
                                                <label class="ipt_uif_question_title ipt_uif_label" for="vehicle_year">Vehicle Specifications<span class="ipt_uif_question_required">*</span></label>
                                                <div class="clear-both"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_select w-50" id="ipt_fsqm_form_52_mcq_6" style="">
                                        <div class="ipt_uif_column_inner side_margin">
                                            <div class="ipt_uif_question ipt_uif_question_vertical">
                                                <div class="ipt_uif_question_content">
                                                    <select class="ipt_uif_select select2-hidden-accessible" name="vehicle_year" id="vehicle_year" data-placeholder="Select Vehicle Year" placeholder="Select Vehicle Year" title="Select Vehicle Year" data-allow-clear="true" data-theme="eform-material eform-select2-boxy" tabindex="-1" aria-hidden="true">
                                                        <option value="" selected="selected">Select Vehicle Year</option>
                                                        <?php
                                                        $start = 1900;
                                                        $end = date('Y');
                                                        for ($end; $end >= $start; $end--) {
                                                            if ($vehicle_object['vehicle_year'] == $end)
                                                                echo '<option value="' . $end . '" selected>' . $end . '</option>';
                                                            else
                                                                echo '<option value="' . $end . '" >' . $end . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="clear-both"></div>
                                                </div>
                                            </div>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_select w-50" id="ipt_fsqm_form_52_mcq_14" style="">
                                        <div class="ipt_uif_column_inner side_margin">
                                            <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                                <div class="ipt_uif_question_content">
                                                    <select class="ipt_uif_select select2-hidden-accessible" name="vehicle_color" id="vehicle_color" data-placeholder="Select Vehicle Color" placeholder="Select Vehicle Color" title="Select Vehicle Color" data-allow-clear="true" data-theme="eform-material eform-select2-boxy" tabindex="-1" aria-hidden="true">
                                                        <?php
                                                        foreach ($vehicle_color_options as $vindx => $vval) {
                                                            if ($vehicle_object['vehicle_color'] == $vindx)
                                                                echo '<option value="' . $vindx . '" selected>' . $vval . '</option>';
                                                            else
                                                                echo '<option value="' . $vindx . '">' . $vval . '</option>';
                                                        }
                                                        ?>

                                                    </select>
                                                    <div class="clear-both"></div>
                                                </div>
                                            </div>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row d-flex w-100 m-0">
                                <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_feedback_small col-md-3 w-25" id="ipt_fsqm_form_52_freetype_1" style="">
                                    <div class="ipt_uif_column_inner side_margin">
                                        <div class="ipt_uif_question ipt_uif_question_vertical">
                                            <div class="ipt_uif_question_label" style="margin-bottom: 0px;"> <label class="ipt_uif_question_title ipt_uif_label" for="vehicle_capacity">Vehicle Capacity<span class="ipt_uif_question_required">*</span>
                                                </label>
                                                <div class="clear-both">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small w-50" id="ipt_fsqm_form_52_freetype_1" style="">
                                        <div class="ipt_uif_column_inner side_margin">
                                            <div class="ipt_uif_question ipt_uif_question_vertical">
                                                <div class="ipt_uif_question_content">
                                                    <div class="input-field has-icon">
                                                        <input class="ipt_uif_text" name="vehicle_capacity" id="vehicle_capacity" type="text" placeholder="Passenger Limit (Ex: 20)" title="Passenger Limit (Ex: 20)" value="<?php echo $vehicle_object['vehicle_capacity']; ?>">
                                                        <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe7fd;"></i>
                                                    </div>
                                                    <div class="clear-both"></div>
                                                </div>
                                            </div>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small w-50" id="ipt_fsqm_form_52_freetype_17" style="">
                                        <div class="ipt_uif_column_inner side_margin">
                                            <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                                <div class="ipt_uif_question_content">
                                                    <div class="input-field has-icon">
                                                        <input class="ipt_uif_text" name="luggage_limit" id="luggage_limit" type="text" placeholder="Luggage Limit (Ex: 20)" title="Luggage Limit (Ex: 20)" value="<?php if (!empty($vehicle_object['luggage_limit'])) {
                                                                                                                                                                                                                        echo $vehicle_object['luggage_limit'];
                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                        echo "0";
                                                                                                                                                                                                                    }  ?>">
                                                        <i title="" class="ipticm prefix" data-ipt-icomoon="&#xf290;"></i>
                                                    </div>
                                                    <div class="clear-both"></div>
                                                </div>
                                            </div>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_18" style="">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical">
                                        <div class="ipt_uif_question_label" style="margin-bottom: 0px;">
                                            <label class="ipt_uif_question_title ipt_uif_label" for="vehicle_quantity">Vehicle Quantity<span class="ipt_uif_question_required">*</span></label>
                                            <div class="clear-both"></div>
                                            <div class="ipt_uif_richtext">
                                                <p style="margin: 0px;">
                                                    <em>NOTE:&nbsp;</em>
                                                    <em>Enter "1" to add a single vehicle. Enter "5", for example, to add&nbsp;</em>
                                                    <em>5 identical black 2018 Lincoln Town Cars (same color, year, make, model).</em>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_18" style="">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical">
                                        <div class="ipt_uif_question_content">
                                            <div class="input-field has-icon">
                                                <input class="ipt_uif_text" name="vehicle_quantity" id="vehicle_quantity" type="text" placeholder="Enter Quantity of Identical Vehicles (Ex: 1)" title="Enter Quantity of Identical Vehicles (Ex: 1)" value="<?php echo $vehicle_object['vehicle_quantity']; ?>">
                                                <i title="" class="ipticm prefix" data-ipt-icomoon="#"></i>
                                            </div>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_p_radio" id="ipt_fsqm_form_52_pinfo_5" style="">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical">
                                        <div class="ipt_uif_question_label"> <label class="ipt_uif_question_title ipt_uif_label" for="ipt_fsqm_form_52_pinfo_5">Is This Vehicle Operating &amp; Available For Rental?<span class="ipt_uif_question_required">*</span>
                                            </label>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <div class="ipt_uif_label_column column_random">
                                                <input class="ipt_uif_radio with-gap" name="vehicle_status" id="vehicle_status_yes" value="YES" type="radio" <?php if ($vehicle_object['vehicle_status'] == 'YES') echo 'checked'; ?>>
                                                <label class="eform-label-with-tabindex" tabindex="0" for="vehicle_status_yes" data-labelcon="&#xe18e;"> Yes </label>
                                            </div>
                                            <div class="ipt_uif_label_column column_random">
                                                <input class="ipt_uif_radio with-gap" name="vehicle_status" id="vehicle_status_no" value="NO" type="radio" <?php if ($vehicle_object['vehicle_status'] == 'NO') echo 'checked'; ?>>
                                                <label class="eform-label-with-tabindex" tabindex="0" for="vehicle_status_no" data-labelcon="&#xe18e;"> No </label>
                                            </div>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div id="step-2" class="tab-pane step-content" style="display: none;">
                        <div id="ipt_fsqm_form_52_layout_1_inner" class="ipt-eform-layout-wrapper">
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_main_heading_column">
                                <div class="ipt_uif_column_inner">
                                    <h3 class="ipt_fsqm_main_heading ipt_uif_heading ipt_uif_divider ipt_uif_align_left ipt_uif_divider_no_icon ipt_uif_divider_icon_no_bg"> <span class="ipt_uif_divider_text"> <span class="ipt_uif_divider_text_inner"> FEATURES<span class="subtitle">Page 2 of 6</span> </span> </span>
                                    </h3>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional">
                                <div class="ipt_uif_column_inner side_margin">
                                    <p>
                                        <em>Make <strong>this vehicle</strong> stand out by selecting it's unique features.</em>
                                    </p>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_checkbox" id="ipt_fsqm_form_52_mcq_1">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical">
                                        <div class="ipt_uif_question_label">
                                            <label class="ipt_uif_question_title ipt_uif_label" for="ipt_fsqm_form_52_mcq_1">INTERIOR STYLE</label>
                                            <div class="clear-both"></div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <?php
                                            $c = 0;
                                        //    foreach($interior_style_options as $interior_style){
                                        //         echo '<div class="ipt_uif_label_column column_2"><input  class="filled-in" name="interior_style[]" id="interior_style_' . $c . '" value=" ' . $interior_style . ' " type="checkbox" checked><label class="eform-label-with-tabindex" tabindex="0" for="interior_style_' . $c . '" data-labelcon="&#xe18e;"> ' . $interior_style . ' </label></div>';
                                        //         $c++;
                                        //    }
                                            foreach ($interior_style_options as $iindx ) {
                                                if (in_array($iindx, $vehicle_object['interior_style']))
                                                    echo '<div class="ipt_uif_label_column column_2"><input  class="filled-in" name="interior_style[]" id="interior_style_' . $c . '" value=" ' . $iindx . ' " type="checkbox" checked><label class="eform-label-with-tabindex" tabindex="0" for="interior_style_' . $c . '" data-labelcon="&#xe18e;"> ' . $iindx . ' </label></div>';
                                                else
                                                    echo '<div class="ipt_uif_label_column column_2"><input  class="filled-in" name="interior_style[]" id="interior_style_' . $c . '" value=" ' . $iindx . ' " type="checkbox"><label class="eform-label-with-tabindex" tabindex="0" for="interior_style_' . $c . '" data-labelcon="&#xe18e;"> ' . $iindx . ' </label></div>';
                                                $c++;
                                            }
                                            ?>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_checkbox" id="ipt_fsqm_form_52_mcq_2">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical">
                                        <div class="ipt_uif_question_label">
                                            <label class="ipt_uif_question_title ipt_uif_label" for="ipt_fsqm_form_52_mcq_2">ON-BOARD LUXURY</label>
                                            <div class="clear-both"></div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <?php
                                            $c = 0;
                                            // // foreach($onboard_luxury_options as $onboard_luxury){
                                            // //     echo '<div class="ipt_uif_label_column column_3"><input  class="filled-in" name="onboard_luxury[]" id="onboard_luxury_' . $c . '" value=" ' . $onboard_luxury . ' " type="checkbox" checked><label class="eform-label-with-tabindex" tabindex="0" for="onboard_luxury_' . $c . '" data-labelcon="&#xe18e;"> ' . $onboard_luxury . ' </label></div>';
                                            // //   $c++;
                                            // }
                                            foreach ($onboard_luxury_options as $iindx => $ivalue) {
                                                if (in_array($iindx, $vehicle_object['onboard_luxury']))
                                                    echo '<div class="ipt_uif_label_column column_3"><input  class="filled-in" name="onboard_luxury[]" id="onboard_luxury_' . $c . '" value=" ' . $iindx . ' " type="checkbox" checked><label class="eform-label-with-tabindex" tabindex="0" for="onboard_luxury_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                                                else
                                                    echo '<div class="ipt_uif_label_column column_3"><input  class="filled-in" name="onboard_luxury[]" id="onboard_luxury_' . $c . '" value=" ' . $iindx . ' " type="checkbox"><label class="eform-label-with-tabindex" tabindex="0" for="onboard_luxury_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                                                $c++;
                                            }
                                            ?>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_checkbox" id="ipt_fsqm_form_52_mcq_3">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical">
                                        <div class="ipt_uif_question_label"> <label class="ipt_uif_question_title ipt_uif_label" for="ipt_fsqm_form_52_mcq_3">MEDIA CAPABILITY</label>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <?php
                                            $c = 0;
                                            // foreach($media_capability_options as $media_capability){
                                            //     echo '<div class="ipt_uif_label_column column_3"><input  class="filled-in" name="media_capability[]" id="media_capability_' . $c . '" value=" ' . $media_capability . ' " type="checkbox" checked><label class="eform-label-with-tabindex" tabindex="0" for="media_capability_' . $c . '" data-labelcon="&#xe18e;"> ' . $media_capability . ' </label></div>';
                                            //     $c++;
                                            // }
                                            foreach ($media_capability_options as $iindx => $ivalue) {
                                                if (in_array($iindx, $vehicle_object['media_capability']))
                                                    echo '<div class="ipt_uif_label_column column_3"><input  class="filled-in" name="media_capability[]" id="media_capability_' . $c . '" value=" ' . $iindx . ' " type="checkbox" checked><label class="eform-label-with-tabindex" tabindex="0" for="media_capability_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                                                else
                                                    echo '<div class="ipt_uif_label_column column_3"><input  class="filled-in" name="media_capability[]" id="media_capability_' . $c . '" value=" ' . $iindx . ' " type="checkbox"><label class="eform-label-with-tabindex" tabindex="0" for="media_capability_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                                                $c++;
                                            }
                                            ?>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_checkbox" id="ipt_fsqm_form_52_mcq_4">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical">
                                        <div class="ipt_uif_question_label"> <label class="ipt_uif_question_title ipt_uif_label" for="ipt_fsqm_form_52_mcq_4">COMPLIMENTARY</label>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <?php
                                            $c = 0;
                                           
                                           

                                               
                                           
                                           
                                            foreach ($complimentary_options as $iindx => $ivalue) {
                                                if (in_array($iindx, $vehicle_object['complimentary']))
                                                    echo '<div class="ipt_uif_label_column column_3"><input  class="filled-in" name="complimentary[]" id="complimentary_' . $c . '" value=" ' . $iindx . ' " type="checkbox" checked><label class="eform-label-with-tabindex" tabindex="0" for="complimentary_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                                                else
                                                    echo '<div class="ipt_uif_label_column column_3"><input  class="filled-in" name="complimentary[]" id="complimentary_' . $c . '" value=" ' . $iindx . ' " type="checkbox"><label class="eform-label-with-tabindex" tabindex="0" for="complimentary_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                                                $c++;
                                            }
                                            ?>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div id="step-3" class="tab-pane step-content" style="display: none;">
                        <div id="ipt_fsqm_form_52_layout_2_inner" class="ipt-eform-layout-wrapper">
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_main_heading_column">
                                <div class="ipt_uif_column_inner">
                                    <h3 class="ipt_fsqm_main_heading ipt_uif_heading ipt_uif_divider ipt_uif_align_left ipt_uif_divider_no_icon ipt_uif_divider_icon_no_bg">
                                        <span class="ipt_uif_divider_text">
                                            <span class="ipt_uif_divider_text_inner"> HOURLY RATES<span class="subtitle">Page 3 of 6</span> </span>
                                        </span>
                                    </h3>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <!-- Section 1 -->
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional">
                                <div class="ipt_uif_column_inner side_margin">
                                    <p>
                                        <em style="box-sizing: border-box; font-family: Roboto, 'Noto Sans', Arial, sans-serif; margin: 0px; padding: 0px; outline: none; box-shadow: none; border: 0px none; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline; font-variant-numeric: normal; font-variant-east-asian: normal; color: #424242; font-size: 14px;">Enter hourly pricing <strong>for this vehicle</strong>.</em>
                                    </p>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <!-- Section 2 -->
                            <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_7">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                        <div class="ipt_uif_question_label">
                                            <label class="ipt_uif_question_title ipt_uif_label" for="base_hourly_rate">Base Hourly Rate</label>
                                            <div class="clear-both"></div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <div class="input-field has-icon">
                                                <input class="ipt_uif_text vndr_currency" name="base_hourly_rate" id="base_hourly_rate" type="text" placeholder="Enter Base Hourly Rate" title="Enter Base Hourly Rate" value="<?php echo $vehicle_object['base_hourly_rate']; ?>" required>
                                                <i title="" class="ipticm prefix" data-ipt-icomoon="&#xf155;"></i>
                                            </div>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <!-- Section 3 -->
                            <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_8">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                        <div class="ipt_uif_question_label">
                                            <label class="ipt_uif_question_title ipt_uif_label" for="base_min_hours">Minimum Hours</label>
                                            <div class="clear-both"></div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <div class="input-field has-icon"> <input class="ipt_uif_text" name="base_min_hours" id="base_min_hours" type="text" placeholder="Enter Minimum Hours" title="Enter Minimum Hours" value="<?php echo number_format($vehicle_object['base_min_hours'], 2); 
                                                                                                                                                                                                                                        ?>" required>
                                                <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe082;"></i>
                                            </div>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_9">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                        <div class="ipt_uif_question_label">
                                            <label class="ipt_uif_question_title ipt_uif_label" for="base_additional_hourly">Additional Hourly Rate</label>
                                            <div class="clear-both"></div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <div class="input-field has-icon">
                                                <input class="ipt_uif_text vndr_currency" name="base_additional_hourly" id="base_additional_hourly" type="text" placeholder="Enter Rate (Optional)" title="Enter Hourly Rate For Additional Hours (Optional)" value="<?php echo $vehicle_object['base_additional_hourly']; ?>">
                                                <i title="" class="ipticm prefix" data-ipt-icomoon="&#xf155;"></i>
                                            </div>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <!-- OK -->
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_toggle" id="ipt_fsqm_form_52_mcq_22" style="">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical">
                                        <div class="ipt_uif_question_label"><label class="ipt_uif_question_title ipt_uif_label" for="ipt_fsqm_form_52_mcq_22_value">Set Custom Daily Rates (Optional)</label>
                                            <div class="clear-both"></div>
                                            <div class="ipt_uif_richtext">
                                                <p>
                                                    <em>Use this feature <strong>only</strong> if you have different rates/minimum hours on specific days of the week.</em>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <div class="switch">
                                                <label class="eform-label-with-tabindex" tabindex="0" for="custom_daily_rates" data-on="1" data-off="0"> Off
                                                    <input class="ipt_uif_switch" name="custom_daily_rates" id="custom_daily_rates" <?php if ($vehicle_object['custom_daily_rates'] == 1 || $vehicle_object['custom_daily_rates'] == '1') echo ' checked '; ?> data-on="1" data-off="0" type="checkbox">
                                                    <span class="lever"></span> On
                                                </label>
                                            </div>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <!-- ok -->

                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_feedback_matrix iptUIFCHidden" id="custom_daily_rates_area" <?php
                                                                                                                                                                                if ($vehicle_object['custom_daily_rates'] == 1 || $vehicle_object['custom_daily_rates'] == '1')
                                                                                                                                                                                    echo 'style="display: block;" ';
                                                                                                                                                                                else
                                                                                                                                                                                    echo ' style="display: none;"';
                                                                                                                                                                                ?>>
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                        <div class="ipt_uif_question_content">
                                            <div class="ipt_uif_matrix_container ipt_uif_matrix_feedback">
                                                <table class="ipt_uif_matrix highlight bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" style="width: 23%;"></th>
                                                            <th scope="col" style="width: 11%;">
                                                                <div class="ipt_uif_matrix_div_cell">Monday</div>
                                                            </th>
                                                            <th scope="col" style="width: 11%;">
                                                                <div class="ipt_uif_matrix_div_cell">Tuesday</div>
                                                            </th>
                                                            <th scope="col" style="width: 11%;">
                                                                <div class="ipt_uif_matrix_div_cell">Wednesday</div>
                                                            </th>
                                                            <th scope="col" style="width: 11%;">
                                                                <div class="ipt_uif_matrix_div_cell">Thursday</div>
                                                            </th>
                                                            <th scope="col" style="width: 11%;">
                                                                <div class="ipt_uif_matrix_div_cell">Friday</div>
                                                            </th>
                                                            <th scope="col" style="width: 11%;">
                                                                <div class="ipt_uif_matrix_div_cell">Saturday</div>
                                                            </th>
                                                            <th scope="col" style="width: 11%;">
                                                                <div class="ipt_uif_matrix_div_cell">Sunday</div>
                                                            </th>
                                                        </tr>

                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">
                                                                <div class="ipt_uif_matrix_div_cell">Hourly Rate ($)</div>
                                                            </th>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="hourly_rate_monday" id="hourly_rate_monday" type="text" value="<?php echo $vehicle_object['hourly_rate_monday']; ?>" placeholder="$$" title="Hourly Rate for Monday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="hourly_rate_tuesday" id="hourly_rate_tuesday" type="text" value="<?php echo $vehicle_object['hourly_rate_tuesday']; ?>" placeholder="$$" title="Hourly Rate for Tuesday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="hourly_rate_wednesday" id="hourly_rate_wednesday" type="text" value="<?php echo $vehicle_object['hourly_rate_wednesday']; ?>" placeholder="$$" title="Hourly Rate for Wednesday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="hourly_rate_thursday" id="hourly_rate_thursday" type="text" value="<?php echo $vehicle_object['hourly_rate_thursday']; ?>" placeholder="$$" title="Hourly Rate for Thursday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="hourly_rate_friday" id="hourly_rate_friday" type="text" value="<?php echo $vehicle_object['hourly_rate_friday']; ?>" placeholder="$$" title="Hourly Rate for Friday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="hourly_rate_saturday" id="hourly_rate_saturday" type="text" value="<?php echo $vehicle_object['hourly_rate_saturday']; ?>" placeholder="$$" title="Hourly Rate for Saturday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="hourly_rate_sunday" id="hourly_rate_sunday" type="text" value="<?php echo $vehicle_object['hourly_rate_sunday']; ?>" placeholder="$$" title="Hourly Rate for Sunday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <div class="ipt_uif_matrix_div_cell">Minimum Hours</div>
                                                            </th>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="min_hours_monday" id="min_hours_monday" type="text" value="<?php  echo number_format($vehicle_object['min_hours_monday'], 2); 
                                                                                                                                                                                                    ?>" placeholder="Hours" title="Minimum number of hours for Monday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="min_hours_tuesday" id="min_hours_tuesday" type="text" value="<?php // echo number_format($vehicle_object['min_hours_tuesday'], 0, '.', ','); 
                                                                                                                                                                                                    ?>" placeholder="Hours" title="Minimum number of hours for Tuesday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="min_hours_wednesday" id="min_hours_wednesday" type="text" value="<?php // echo number_format($vehicle_object['min_hours_wednesday'], 0, '.', ','); 
                                                                                                                                                                                                        ?>" placeholder="Hours" title="Minimum number of hours for Wednesday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="min_hours_thursday" id="min_hours_thursday" type="text" value="<?php // echo number_format($vehicle_object['min_hours_thursday'], 0, '.', ','); 
                                                                                                                                                                                                        ?>" placeholder="Hours" title="Minimum number of hours for Thursday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="min_hours_friday" id="min_hours_friday" type="text" value="<?php // echo number_format($vehicle_object['min_hours_friday'], 0, '.', ','); 
                                                                                                                                                                                                    ?>" placeholder="Hours" title="Minimum number of hours for Friday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="min_hours_saturday" id="min_hours_saturday" type="text" value="<?php // echo number_format($vehicle_object['min_hours_saturday'], 0, '.', ','); 
                                                                                                                                                                                                        ?>" placeholder="Hours" title="Minimum number of hours for Saturday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="min_hours_sunday" id="min_hours_sunday" type="text" value="<?php // echo number_format($vehicle_object['min_hours_sunday'], 0, '.', ','); 
                                                                                                                                                                                                    ?>" placeholder="Hours" title="Minimum number of hours for Sunday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <div class="ipt_uif_matrix_div_cell">Rate for Additional Hours ($)</div>
                                                            </th>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="additional_hourly_monday" id="additional_hourly_monday" type="text" value="<?php echo $vehicle_object['additional_hourly_monday']; ?>" placeholder="$$" title="Rate for Additional Hours for Monday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="additional_hourly_tuesday" id="additional_hourly_tuesday" type="text" value="<?php echo $vehicle_object['additional_hourly_tuesday']; ?>" placeholder="$$" title="Rate for Additional Hours for Tuesday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="additional_hourly_wednesday" id="additional_hourly_wednesday" type="text" value="<?php echo $vehicle_object['additional_hourly_wednesday']; ?>" placeholder="$$" title="Rate for Additional Hours for Wednesday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="additional_hourly_thursday" id="additional_hourly_thursday" type="text" value="<?php echo $vehicle_object['additional_hourly_thursday']; ?>" placeholder="$$" title="Rate for Additional Hours for Thursday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="additional_hourly_friday" id="additional_hourly_friday" type="text" value="<?php echo $vehicle_object['additional_hourly_friday']; ?>" placeholder="$$" title="Rate for Additional Hours for Friday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="additional_hourly_saturday" id="additional_hourly_saturday" type="text" value="<?php echo $vehicle_object['additional_hourly_saturday']; ?>" placeholder="$$" title="Rate for Additional Hours for Saturday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ipt_uif_matrix_div_cell">
                                                                    <div class="input-field">
                                                                        <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="additional_hourly_sunday" id="additional_hourly_sunday" type="text" value="<?php echo $vehicle_object['additional_hourly_sunday']; ?>" placeholder="$$" title="Rate for Additional Hours for Sunday">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <!-- ko -->
                        </div>
                    </div>

                    <div id="step-4" class="tab-pane step-content" style="display: none;">
                        <div id="ipt_fsqm_form_52_layout_3_inner" class="ipt-eform-layout-wrapper">
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_main_heading_column">
                                <div class="ipt_uif_column_inner">
                                    <h3 class="ipt_fsqm_main_heading ipt_uif_heading ipt_uif_divider ipt_uif_align_left ipt_uif_divider_no_icon ipt_uif_divider_icon_no_bg">
                                        <span class="ipt_uif_divider_text"><span class="ipt_uif_divider_text_inner"> SPECIAL RATES (OPTIONAL)<span class="subtitle">Page 4 of 6</span> </span> </span>
                                    </h3>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional">
                                <div class="ipt_uif_column_inner side_margin m-0 p-0">
                                    <p>
                                        <em>Create special event pricing <strong>for this vehicle</strong> within specific date ranges (Ex: Prom Rates).&nbsp;</em>
                                        <em style="box-sizing: border-box; font-family: Roboto, 'Noto Sans', Arial, sans-serif; margin: 0px; padding: 0px; outline: none; box-shadow: none; border: 0px none; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline; font-variant-numeric: normal; font-variant-east-asian: normal; font-size: 14px;">If you don't have special rates, you may skip this step.</em>
                                    </p>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <!--special rates - clone this-->
                            <button class="btn btn-primary hide-special-rate-button button_special_rate ff dropdown-toggle" onclick="add_more_special_rates(event);" style="background-color: #e3b04b; border: none; font-size: 14px;">Add New Special Rate</button>
                            <div class="clear-both"></div>
                            <div id="special_rates_removed" style="display: none;"></div>
                            <div id="special_rates_div" style="display: inline-block;">
                                <?php
                                $c = 0;
                                foreach ($vehicle_object['SpeicalRates'] as $sprIndx => $sprVal) {
                                    if ($sprIndx !== 'DefaultValues') {
                                ?>
                                        <h3><?php echo $sprVal['name_special_rate']; ?></h3>
                                        <div>
                                            <div id="special_rates_<?php echo $c; ?>" class="special_rates_div" style="display: inline-block;">
                                                <input type="hidden" name="special_rate[]" id="special_rate_id_<?php echo $c; ?>" value="<?php echo $sprIndx; ?>">
                                                <input type="hidden" name="special_rate_deleted[]" id="special_rate_deleted_<?php echo $c; ?>" value="">
                                                <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_16_<?php echo $c; ?>">
                                                    <div class="ipt_uif_column_inner side_margin">
                                                        <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                                            <div class="ipt_uif_question_label">
                                                                <label class="ipt_uif_question_title ipt_uif_label" style="width: 60%; float: left;" for="name_special_rate_<?php echo $c; ?>">Title (Ex: Prom Rates)</label>
                                                                <button onclick="remove_special_rates(event,<?php echo $c; ?>);" style="color: red; float: right; width: 30%;" title="Remove this Special Rate (<?php echo $sprVal['name_special_rate']; ?>)">Remove Special Rate</button>
                                                                <div class="clear-both"></div>
                                                            </div>
                                                            <div class="ipt_uif_question_content">
                                                                <div class="input-field has-icon">
                                                                    <!--  <input class="ipt_uif_text" name="name_special_rate[]" id="name_special_rate_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['name_special_rate']; ?>" title="Name of Special Rate (Ex: Prom Rates)" placeholder="Enter Rate Title">
                                                                <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe8df;"></i>-->
                                                                    <?php
                                                                    $servicetype = array(
                                                                        "" => "",
                                                                        "Airport" => "Airport",
                                                                        "Bachelor Party" => "Bachelor Party",
                                                                        "Bachelorette Party" => "Bachelorette Party",
                                                                        "Birthday" => "Birthday",
                                                                        "Casino" => "Casino",
                                                                        "Church Function" => "Church Function",
                                                                        "Concert" => "Concert",
                                                                        "Convention" => "Convention",
                                                                        "Corporate Event" => "Corporate Event",
                                                                        "Cruise Transfers" => "Cruise Transfers",
                                                                        "Family Reunion" => "Family Reunion",
                                                                        "General Day Trip" => "General Day Trip",
                                                                        "Golf Outing" => "Golf Outing",
                                                                        "Homecoming" => "Homecoming",
                                                                        "Night out on Town" => "Night out on Town",
                                                                        "Over the Road" => "Over the Road",
                                                                        "Prom" => "Prom",
                                                                        "School Trip" => "School Trip",
                                                                        "Shuttle Service" => "Shuttle Service",
                                                                        "Sports Event" => "Sports Event",
                                                                        "Theme Park" => "Theme Park",
                                                                        "Transfer" => "Transfer",
                                                                        "Wedding" => "Wedding",
                                                                        "Wine Tour" => "Wine Tour",
                                                                    ); ?><select name="name_special_rate[]" id="name_special_rate_<?php echo $c; ?>" class="form-control">
                                                                        <?php
                                                                        foreach ($servicetype as $ind => $key) {
                                                                            if ($ind == $sprVal['name_special_rate'])
                                                                                echo '<option value="' . $ind . '" selected>' . $key . '</option>';
                                                                            else
                                                                                echo '<option value="' . $ind . '">' . $key . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="clear-both"></div>
                                                            </div>
                                                        </div>
                                                        <div class="clear-both"></div>
                                                    </div>
                                                </div>
                                                <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_datetime">
                                                    <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_datetime" id="ipt_fsqm_form_52_pinfo_3_<?php echo $c; ?>">
                                                        <div class="ipt_uif_column_inner side_margin">
                                                            <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                                                <div class="ipt_uif_question_label">
                                                                    <label class="ipt_uif_question_title ipt_uif_label" for="special_rate_start_from_<?php echo $c; ?>">Start Date</label>
                                                                    <div class="clear-both"></div>
                                                                </div>
                                                                <div class="ipt_uif_question_content">
                                                                    <div class="input-field eform-dp-input-field has-icon">
                                                                        <input class="ipt_uif_text datepicker1" name="special_rate_start_from[]" id="special_rate_start_from_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_rate_start_from']; ?>" title="Select Start Date of Special Rate">
                                                                        <i title="" class="ipt-icomoon-calendar ipticm prefix"></i>
                                                                    </div>
                                                                    <div class="clear-both"></div>
                                                                </div>
                                                            </div>
                                                            <div class="clear-both"></div>
                                                        </div>
                                                    </div>
                                                    <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_datetime" id="ipt_fsqm_form_52_pinfo_4_<?php echo $c; ?>">
                                                        <div class="ipt_uif_column_inner side_margin">
                                                            <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                                                <div class="ipt_uif_question_label">
                                                                    <label class="ipt_uif_question_title ipt_uif_label" for="special_rate_end_on_<?php echo $c; ?>">End Date</label>
                                                                    <div class="clear-both"></div>
                                                                </div>
                                                                <div class="ipt_uif_question_content">
                                                                    <div class="input-field eform-dp-input-field has-icon">
                                                                        <input class="ipt_uif_text datepicker2" name="special_rate_end_on[]" id="special_rate_end_on_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_rate_end_on']; ?>" title="Select End Date of Special Rate">
                                                                        <i title="" class="ipt-icomoon-calendar ipticm prefix"></i>
                                                                    </div>
                                                                    <div class="clear-both"></div>
                                                                </div>
                                                            </div>
                                                            <div class="clear-both"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_10_<?php echo $c; ?>">
                                                    <div class="ipt_uif_column_inner side_margin">
                                                        <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                                            <div class="ipt_uif_question_label">
                                                                <label class="ipt_uif_question_title ipt_uif_label" for="special_base_hourly_rate_<?php echo $c; ?>">Special Hourly Rate</label>
                                                                <div class="clear-both"></div>
                                                            </div>
                                                            <div class="ipt_uif_question_content">
                                                                <div class="input-field has-icon">
                                                                    <input class="ipt_uif_text vndr_currency" onkeyup="return update_special_rates(event,<?php echo $c; ?>, 'hourly');" onchange="return update_special_rates(event,<?php echo $c; ?>, 'hourly');" name="special_base_hourly_rate[]" id="special_base_hourly_rate_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_base_hourly_rate']; ?>" title="Enter Special Hourly Rate" placeholder="Enter Hourly Rate">
                                                                    <i title="" class="ipticm prefix" data-ipt-icomoon="&#xf155;"></i>
                                                                </div>
                                                                <div class="clear-both"></div>
                                                            </div>
                                                        </div>
                                                        <div class="clear-both"></div>
                                                    </div>
                                                </div>
                                                <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_11_<?php echo $c; ?>">
                                                    <div class="ipt_uif_column_inner side_margin">
                                                        <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                                            <div class="ipt_uif_question_label">
                                                                <label class="ipt_uif_question_title ipt_uif_label" for="special_base_min_hours_<?php echo $c; ?>">Minimum Hours</label>
                                                                <div class="clear-both"></div>
                                                            </div>
                                                            <div class="ipt_uif_question_content">
                                                                <div class="input-field has-icon">
                                                                    <input class="ipt_uif_text" onkeyup="return update_special_rates(event,<?php echo $c; ?>, 'minhours');" onchange="return update_special_rates(event,<?php echo $c; ?>, 'minhours');" name="special_base_min_hours[]" id="special_base_min_hours_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_base_min_hours']; ?>" title="Enter Minimum Hours" placeholder="Enter Minimum Hours">
                                                                    <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe082;"></i>
                                                                </div>
                                                                <div class="clear-both"></div>
                                                            </div>
                                                        </div>
                                                        <div class="clear-both"></div>
                                                    </div>
                                                </div>
                                                <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_12_<?php echo $c; ?>">
                                                    <div class="ipt_uif_column_inner side_margin">
                                                        <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                                            <div class="ipt_uif_question_label">
                                                                <label class="ipt_uif_question_title ipt_uif_label" for="special_additional_hourly_<?php echo $c; ?>">Additional Hourly Rate</label>
                                                                <div class="clear-both"></div>
                                                            </div>
                                                            <div class="ipt_uif_question_content">
                                                                <div class="input-field has-icon">
                                                                    <input class="ipt_uif_text vndr_currency" onkeyup="return update_special_rates(event,<?php echo $c; ?>, 'additional');" onchange="return update_special_rates(event,<?php echo $c; ?>, 'additional');" name="special_base_additional_hourly[]" id="special_additional_hourly_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_base_additional_hourly']; ?>" title="Enter Hourly Rate For Additional Hours (Optional)" placeholder="Enter Rate (Optional)">
                                                                    <i title="" class="ipticm prefix" data-ipt-icomoon="&#xf155;"></i>
                                                                </div>
                                                                <div class="clear-both"></div>
                                                            </div>
                                                        </div>
                                                        <div class="clear-both"></div>
                                                    </div>
                                                </div>
                                                <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_toggle" id="ipt_fsqm_form_52_mcq_17_<?php echo $c; ?>" style="">
                                                    <div class="ipt_uif_column_inner side_margin">
                                                        <div class="ipt_uif_question ipt_uif_question_vertical">
                                                            <div class="ipt_uif_question_label"> <label class="ipt_uif_question_title ipt_uif_label" for="custom_special_rates_<?php echo $c; ?>">Set Custom Daily Rates (Optional)</label>
                                                                <div class="clear-both"></div>
                                                                <div class="ipt_uif_richtext">
                                                                    <p>
                                                                        <em>Use this feature&nbsp;<strong>only</strong>&nbsp;if you have different rates/minimum hours on specific days of the week.</em>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="ipt_uif_question_content">
                                                                <div class="switch">
                                                                    <label class="eform-label-with-tabindex" tabindex="0" for="custom_special_rates_<?php echo $c; ?>" data-on="1" data-off="0"> Off
                                                                        <input class="ipt_uif_switch" onchange="return update_special_custom_rates(event,<?php echo $c; ?>);" name="custom_special_rates[]" id="custom_special_rates_<?php echo $c; ?>" <?php if ($sprVal['custom_special_rates'] == 1 || $sprVal['custom_special_rates'] == '1') echo ' checked '; ?> data-on="1" data-off="0" type="checkbox">
                                                                        <span class="lever"></span> On </label>
                                                                </div>
                                                                <div class="clear-both"></div>
                                                            </div>
                                                        </div>

                                                        <div class="clear-both"></div>
                                                    </div>
                                                </div>
                                                <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_feedback_matrix iptUIFCHidden" id="custom_special_rates_area_<?php echo $c; ?>" <?php
                                                                                                                                                                                                                        if ($sprVal['custom_special_rates'] == 1 || $sprVal['custom_special_rates'] == '1')
                                                                                                                                                                                                                            echo ' style="display: block;" ';
                                                                                                                                                                                                                        else
                                                                                                                                                                                                                            echo ' style="display: none;" ';
                                                                                                                                                                                                                        ?>>
                                                    <div class="ipt_uif_column_inner side_margin">
                                                        <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                                            <div class="ipt_uif_question_content">
                                                                <div class="ipt_uif_matrix_container ipt_uif_matrix_feedback">
                                                                    <table class="ipt_uif_matrix highlight bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col" style="width: 23%;"></th>
                                                                                <th scope="col" style="width: 11%;">
                                                                                    <div class="ipt_uif_matrix_div_cell">Monday</div>
                                                                                </th>
                                                                                <th scope="col" style="width: 11%;">
                                                                                    <div class="ipt_uif_matrix_div_cell">Tuesday</div>
                                                                                </th>
                                                                                <th scope="col" style="width: 11%;">
                                                                                    <div class="ipt_uif_matrix_div_cell">Wednesday</div>
                                                                                </th>
                                                                                <th scope="col" style="width: 11%;">
                                                                                    <div class="ipt_uif_matrix_div_cell">Thursday</div>
                                                                                </th>
                                                                                <th scope="col" style="width: 11%;">
                                                                                    <div class="ipt_uif_matrix_div_cell">Friday</div>
                                                                                </th>
                                                                                <th scope="col" style="width: 11%;">
                                                                                    <div class="ipt_uif_matrix_div_cell">Saturday</div>
                                                                                </th>
                                                                                <th scope="col" style="width: 11%;">
                                                                                    <div class="ipt_uif_matrix_div_cell">Sunday</div>
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row">
                                                                                    <div class="ipt_uif_matrix_div_cell">Hourly Rate ($)</div>
                                                                                </th>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_hourly_rate_monday[]" id="special_hourly_rate_monday_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_hourly_rate_monday']; ?>" placeholder="$$" title="Hourly Rate for Monday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_hourly_rate_tuesday[]" id="special_hourly_rate_tuesday_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_hourly_rate_tuesday']; ?>" placeholder="$$" title="Hourly Rate for Tuesday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_hourly_rate_wednesday[]" id="special_hourly_rate_wednesday_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_hourly_rate_wednesday']; ?>" placeholder="$$" title="Hourly Rate for Wednesday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_hourly_rate_thursday[]" id="special_hourly_rate_thursday_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_hourly_rate_thursday']; ?>" placeholder="$$" title="Hourly Rate for Thursday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_hourly_rate_friday[]" id="special_hourly_rate_friday_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_hourly_rate_friday']; ?>" placeholder="$$" title="Hourly Rate for Friday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_hourly_rate_saturday[]" id="special_hourly_rate_saturday_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_hourly_rate_saturday']; ?>" placeholder="$$" title="Hourly Rate for Saturday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_hourly_rate_sunday[]" id="special_hourly_rate_sunday_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_hourly_rate_sunday']; ?>" placeholder="$$" title="Hourly Rate for Sunday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">
                                                                                    <div class="ipt_uif_matrix_div_cell">Minimum Hours</div>
                                                                                </th>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="special_min_hours_monday[]" id="special_min_hours_monday_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_min_hours_monday']; ?>" placeholder="Hours" title="Minimum number of hours for Monday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="special_min_hours_tuesday[]" id="special_min_hours_tuesday_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_min_hours_tuesday']; ?>" placeholder="Hours" title="Minimum number of hours for Tuesday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="special_min_hours_wednesday[]" id="special_min_hours_wednesday_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_min_hours_wednesday']; ?>" placeholder="Hours" title="Minimum number of hours for Wednesday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="special_min_hours_thursday[]" id="special_min_hours_thursday_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_min_hours_thursday']; ?>" placeholder="Hours" title="Minimum number of hours for Thursday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="special_min_hours_friday[]" id="special_min_hours_friday_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_min_hours_friday']; ?>" placeholder="Hours" title="Minimum number of hours for Friday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="special_min_hours_saturday[]" id="special_min_hours_saturday_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_min_hours_saturday']; ?>" placeholder="Hours" title="Minimum number of hours for Saturday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="special_min_hours_sunday[]" id="special_min_hours_sunday_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_min_hours_sunday']; ?>" placeholder="Hours" title="Minimum number of hours for Sunday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">
                                                                                    <div class="ipt_uif_matrix_div_cell">Rate for Additional Hours ($)</div>
                                                                                </th>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_additional_hourly_mon[]" id="special_additional_hourly_mon_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_additional_hourly_mon']; ?>" placeholder="$$" title="Rate for Additional Hours for Monday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_additional_hourly_tue[]" id="special_additional_hourly_tue_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_additional_hourly_tue']; ?>" placeholder="$$" title="Rate for Additional Hours for Tuesday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_additional_hourly_wed[]" id="special_additional_hourly_wed_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_additional_hourly_wed']; ?>" placeholder="$$" title="Rate for Additional Hours for Wednesday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_additional_hourly_thu[]" id="special_additional_hourly_thu_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_additional_hourly_thu']; ?>" placeholder="$$" title="Rate for Additional Hours for Thursday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_additional_hourly_fri[]" id="special_additional_hourly_fri_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_additional_hourly_fri']; ?>" placeholder="$$" title="Rate for Additional Hours for Friday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_additional_hourly_sat[]" id="special_additional_hourly_sat_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_additional_hourly_sat']; ?>" placeholder="$$" title="Rate for Additional Hours for Saturday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="ipt_uif_matrix_div_cell">
                                                                                        <div class="input-field">
                                                                                            <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_additional_hourly_sun[]" id="special_additional_hourly_sun_<?php echo $c; ?>" type="text" value="<?php echo $sprVal['special_additional_hourly_sun']; ?>" placeholder="$$" title="Rate for Additional Hours for Sunday">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="clear-both"></div>
                                                            </div>
                                                        </div>
                                                        <div class="clear-both"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                        $c++;
                                    }
                                }
                                ?>
                            </div>
                            <!--<button class="btn btn-primary button_special_rate" onclick="add_more_special_rates(event);" style="background-color: #03a9f4; border: none;">Add New Special Rate</button>-->
                            <!--//special rates - clone this-->
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div id="step-5" class="tab-pane step-content" style="display: none;">
                        <div id="ipt_fsqm_form_52_layout_4_inner" class="ipt-eform-layout-wrapper">
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_main_heading_column">
                                <div class="ipt_uif_column_inner">
                                    <h3 class="ipt_fsqm_main_heading ipt_uif_heading ipt_uif_divider ipt_uif_align_left ipt_uif_divider_no_icon ipt_uif_divider_icon_no_bg"> <span class="ipt_uif_divider_text"> <span class="ipt_uif_divider_text_inner"> SURCHARGES (OPTIONAL)<span class="subtitle">Page 5 of 6</span> </span> </span>
                                    </h3>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional">
                                <div class="ipt_uif_column_inner side_margin">
                                    <p>
                                        <em>If you wish to <strong>not</strong> apply surcharges <strong>for this vehicle</strong>, you may skip this step.</em>
                                    </p>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_13">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                        <div class="ipt_uif_question_label">
                                            <label class="ipt_uif_question_title ipt_uif_label" for="fuel_surcharge_percentage">Fuel Surcharge Percentage</label>
                                            <div class="clear-both"></div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <div class="input-field has-icon">
                                                <input class="ipt_uif_text" name="fuel_surcharge_percentage" id="fuel_surcharge_percentage" type="text" value="<?php echo $vehicle_object['fuel_surcharge_percentage']; ?>" title="Enter Fuel Surcharge Percentage" style="max-width: 60px; padding-left: 10px;">
                                                <i title="" class="ipticm prefix" data-ipt-icomoon="&#xf295;" style="left: 50px;"></i>
                                            </div>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_14">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                        <div class="ipt_uif_question_label">
                                            <label class="ipt_uif_question_title ipt_uif_label" for="driver_gratuity_percentage">Driver Gratuity Percentage</label>
                                            <div class="clear-both"></div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <div class="input-field has-icon">
                                                <input class="ipt_uif_text" name="driver_gratuity_percentage" id="driver_gratuity_percentage" type="text" value="<?php echo $vehicle_object['driver_gratuity_percentage']; ?>" title="Enter Driver Gratuity Percentage" style="max-width: 60px; padding-left: 10px;">
                                                <i title="" class="ipticm prefix" data-ipt-icomoon="&#xf295;" style="left: 50px;"></i>
                                            </div>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div id="step-6" class="tab-pane step-content" style="display: none;">
                        <div id="ipt_fsqm_form_52_layout_5_inner" class="ipt-eform-layout-wrapper">
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_main_heading_column">
                                <div class="ipt_uif_column_inner">
                                    <h3 class="ipt_fsqm_main_heading ipt_uif_heading ipt_uif_divider ipt_uif_align_left ipt_uif_divider_no_icon ipt_uif_divider_icon_no_bg">
                                        <span class="ipt_uif_divider_text"> <span class="ipt_uif_divider_text_inner"> PHOTOS<span class="subtitle">Page 6 of 6</span> </span> </span>
                                    </h3>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional">
                                <div class="ipt_uif_column_inner side_margin">
                                    <p>
                                        <em>Please include at least <strong>one exterior &amp; one interior photo</strong> of this vehicle.</em>
                                    </p>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_upload" id="ipt_fsqm_form_52_freetype_15">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_container ipt_uif_iconbox" data-opened="1">
                                        <div class="ipt_uif_container_head">
                                            <h3> <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe002;">
                                                </i> <span class="ipt_uif_container_label">Upload Vehicle Photos</span>
                                            </h3>
                                        </div>
                                        <div class="ipt_uif_container_inner" id="append_images">
                                            <?php
                                            $countr = 0;
                                            foreach ($vehicle_object['images'] as $img) {
                                                if (file_exists("vehicles/" . $img) && !empty($img)) {
                                            ?>
                                                    <div class="image-container" id="img_<?php echo $img; ?>">
                                                        <input type="hidden" name="uploaded_images[]" id="uploaded_<?php echo $img; ?>" value="<?php echo $img; ?>">
                                                        <img src="vehicles/<?php echo $img; ?>" />
                                                        <a class="image-view" href="vehicles/<?php echo $img; ?>" title="View Image in Full screen" target="_blank">View Full</a>
                                                        <button class="image-remove" onclick="return remove_image(event, '<?php echo $img; ?>');">Remove</button>
                                                    </div>
                                            <?php
                                                    $countr++;
                                                    if ($countr % 3 == 0)
                                                        echo '<div class="clear-both"></div>';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="clear-both"></div>
                                        <div class="ipt_uif_container_inner" id="drop_zone">
                                            <div class="ipt_uif_uploader" data-settings="" data-configuration="" data-formdata="">
                                                <div class="fileinput-dragdrop ui-state-active"> <span>Drag 'n Drop files here</span>

                                                </div>
                                                <div class="ipt_fsqm_fileuploader_list_wrap">
                                                    <table role="presentation" class="ipt_fsqm_fileuploader_list">
                                                        <thead>
                                                            <tr>
                                                                <td>
                                                                    <div class="fileupload-buttonbar">
                                                                        <div class="fileupload-buttons">
                                                                            <span class="fileinput-button secondary-button large ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button" style="padding: 15px 5px; width: 100%;">
                                                                                <span class="ui-button-text"> <span class="select secondary-button">Select Images</span></span>
                                                                                <input class="ipt_uif_uploader_handle" multiple="multiple" name="vehicle_images[]" id="vehicle_images" accept="image/x-png,image/gif,image/jpeg" type="file">
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="files"></tbody>
                                                    </table>
                                                </div>
                                                <div class="fileupload-meta">
                                                    <p>Max file size: 2 MB. | Allowed file types: gif,jpeg,png,jpg | Max number of files: 6 | Min number of file: 1</p>
                                                </div>
                                            </div>
                                            <div class="clear-both"></div>
                                        </div>
                                    </div>
                                    <div class="clear-both"></div>
                                    <input type="submit" value="Submit" class="vehicleAddBtn">
                                </div>
                            </div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <!--        <div id="ipt_fsqm_form_52_button_container" class="ipt_fsqm_form_button_container ipt-eform-material-button-container">
                <div class="eform-button-container-inner">
                    <button type="button" class="ipt_uif_button eform-material-button eform-ripple ipt_fsqm_form_button_prev small primary-button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only waves-effect waves-light ui-button-disabled ui-state-disabled" name="ipt_fsqm_form_52_button_prev" id="ipt_fsqm_form_52_button_prev" role="button" disabled="disabled">
                        <span class="ui-button-text"> Previous </span>
                    </button>
                    <button type="submit" class="ipt_uif_button eform-material-button eform-ripple ipt_fsqm_form_button_submit small primary-button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only waves-effect waves-light ui-button-disabled ui-state-disabled" name="submit_vehicle_info" id="submit_vehicle_info" role="button" disabled="disabled">
                        <span class="ui-button-text"> Submit </span>
                    </button>
                    <button type="button" class="ipt_uif_button eform-material-button eform-ripple ipt_fsqm_form_button_next small primary-button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only waves-effect waves-light" name="ipt_fsqm_form_52_button_next" id="ipt_fsqm_form_52_button_next" role="button">
                        <span class="ui-button-text"> Next </span>
                    </button>
                </div>
            </div>-->
        <div class="clear-both"></div>
    </form>
    <div class="col-12 col-lg-6 col-sm-12 mb-5 w-100 d-flex align-items-end justify-content-end p-0" style="max-width:100%!important;">
        <!-- <label>External Buttons:</label> -->
        
        <div class="btn-group col-lg-6 col-sm-12 p-0 d-flex gap-2" role="group">
            <button class="btn btn-primary f16 ff rounded-1 xeno" id="prev-btn" type="button" style="padding:10px 20px;">Go Previous</button>
            <button class="btn btn-danger f16 ff rounded-1 xeno" id="reset-btn" type="button">Reset Wizard</button>
            <button class="btn btn-secondary f16 ff rounded-1 xeno" id="next-btn" type="button">Go Next</button>
            <button class="btn btn-success f16 ff rounded-1 xeno" id="save-btn" type="button">Save All</button>

        </div>
    </div>
</div>
<script type="text/javascript" src="js/c555t.js"></script>
<script type="text/javascript" src="js/c555y_009.js"></script>
<script type="text/javascript" src="js/c555y_005.js"></script>
<script type="text/javascript" src="js/c555y_006.js"></script>
<script type="text/javascript" src="js/c555x_005.js"></script>
<script type="text/javascript" src="js/c555x_010.js"></script>
<script type="text/javascript" src="js/c555w_003.js"></script>
<script type="text/javascript" src="js/c555w_004.js"></script>
<!-- <script type="text/javascript" src="js/c555v.js"></script>tabs -->
<script type="text/javascript" src="js/c555v_002.js"></script>
<script type="text/javascript" src="js/c555v_004.js"></script>
<script type="text/javascript" src="js/c555v_005.js"></script>
<script type="text/javascript" src="js/c555u.js"></script>
<script type="text/javascript" src="js/c555t_002.js"></script>
<script type="text/javascript" src="js/c555s_002.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="SmartWizard/dist/js/jquery.smartWizard.min.js"></script>

<script>
    document.getElementById('save-btn').addEventListener('click', function() {
        document.getElementById('registration_form').submit();
    });
</script>
<script>
    jQuery(document).ready(function($) {
        document.getElementById('vehicle_images').addEventListener('change', preview_images_upload, false);
        document.getElementById('drop_zone').addEventListener('dragover', handleDragOver, false);
        document.getElementById('drop_zone').addEventListener('drop', preview_images_upload, false);
        format_vndr_currency();
        $(".ipt_fsqm_main_tab").tabs({
            load: function(event, ui) {
                console.log(' ad');
            }
        });
        $('#custom_daily_rates').bind('change', function() {
            var base_hourly = document.getElementById('base_hourly_rate').value;
            var add_rate = document.getElementById('base_additional_hourly').value;
            if (add_rate && add_rate != 0 && add_rate != null && base_hourly && base_hourly != 0 && base_hourly != null) {
                if (document.getElementById('custom_daily_rates').checked) {
                    document.getElementById('custom_daily_rates').value = "1";
                    document.getElementById('custom_daily_rates_area').style.display = 'block';
                } else {
                    document.getElementById('custom_daily_rates').value = "0";
                    document.getElementById('custom_daily_rates_area').style.display = 'none';
                }
            } else {
                if (document.getElementById('custom_daily_rates').checked)
                    document.getElementById('custom_daily_rates').checked = false;
            }
        });
        $('#base_hourly_rate').bind('keyup', function() {
            if (document.getElementById('custom_daily_rates').checked) {
                var hourly_rate = Number(this.value);
                if (hourly_rate == 0 || hourly_rate == "" || hourly_rate == null || hourly_rate == 'undefined') {
                    $('#custom_daily_rates').trigger("click");
                    document.getElementById('custom_daily_rates').value = "0";
                    document.getElementById('custom_daily_rates_area').style.display = 'none';
                }
            } else {
                var hourly_rate = Number(this.value);
                document.getElementById('hourly_rate_monday').value = hourly_rate.toFixed(2);
                document.getElementById('hourly_rate_tuesday').value = hourly_rate.toFixed(2);
                document.getElementById('hourly_rate_wednesday').value = hourly_rate.toFixed(2);
                document.getElementById('hourly_rate_thursday').value = hourly_rate.toFixed(2);
                document.getElementById('hourly_rate_friday').value = hourly_rate.toFixed(2);
                document.getElementById('hourly_rate_saturday').value = hourly_rate.toFixed(2);
                document.getElementById('hourly_rate_sunday').value = hourly_rate.toFixed(2);
            }
        });
        $('#base_min_hours').bind('keyup', function() {
            if (document.getElementById('custom_daily_rates').checked) {

            } else {
                document.getElementById('min_hours_monday').value = this.value;
                document.getElementById('min_hours_tuesday').value = this.value;
                document.getElementById('min_hours_wednesday').value = this.value;
                document.getElementById('min_hours_thursday').value = this.value;
                document.getElementById('min_hours_friday').value = this.value;
                document.getElementById('min_hours_saturday').value = this.value;
                document.getElementById('min_hours_sunday').value = this.value;
            }
        });
        $('#base_additional_hourly').bind('keyup', function() {
            if (document.getElementById('custom_daily_rates').checked) {
                var add_rate = Number(this.value);
                if (add_rate == 0 || add_rate == "" || add_rate == null || add_rate == 'undefined') {
                    $('#custom_daily_rates').trigger("click");
                    document.getElementById('custom_daily_rates').value = "0";
                    document.getElementById('custom_daily_rates_area').style.display = 'none';
                }
            } else {
                var add_rate = Number(this.value);
                document.getElementById('additional_hourly_monday').value = add_rate.toFixed(2);
                document.getElementById('additional_hourly_tuesday').value = add_rate.toFixed(2);
                document.getElementById('additional_hourly_wednesday').value = add_rate.toFixed(2);
                document.getElementById('additional_hourly_thursday').value = add_rate.toFixed(2);
                document.getElementById('additional_hourly_friday').value = add_rate.toFixed(2);
                document.getElementById('additional_hourly_saturday').value = add_rate.toFixed(2);
                document.getElementById('additional_hourly_sunday').value = add_rate.toFixed(2);
            }
        });
        configure_date_range();
        $("#special_rates_div").accordion({
            collapsible: true,
            heightStyle: "fill",
            heightStyle: "content",
            active: "none",
        });
        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
            if (stepPosition === 'first') {
                $("#prev-btn").addClass('disabled');
            } else if (stepPosition === 'final') {
                $("#next-btn").addClass('disabled');
            } else {
                $("#prev-btn").removeClass('disabled');
                $("#next-btn").removeClass('disabled');
            }
        });
        var btnFinish = $('<button type="submit"></button>').text('Finish')
            .addClass('btn btn-info')
            .on('click', function() {

            });
        var btnCancel = $('<button></button>').text('Cancel')
            .addClass('btn btn-danger')
            .on('click', function() {
                $('#smartwizard').smartWizard("reset");
                document.location = "dashboard.php";
            });
        $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'arrows',
            transitionEffect: 'fade',
            showStepURLhash: true,
            toolbarSettings: {
                toolbarPosition: 'bottom',
                toolbarButtonPosition: 'center',
                toolbarExtraButtons: [btnFinish, btnCancel]
            }
        });
        $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
            if (stepDirection === 'forward') {
                if (validate_vehicle(e, stepNumber))
                    return true;
                else
                    return false;
            }
            console.log(stepNumber);
            return true;
        });
    });

    function validateStepFields() {

    }

    function configure_date_range() {
        jQuery.datepicker.setDefaults(jQuery.datepicker.regional["us"]);
        jQuery(".datepicker1").datepicker({
            changeMonth: true,
            changeYear: true,
            onSelect: function(dateText, inst) {
                var the_date = new Date(dateText);
                jQuery(".datepicker2").datepicker('option', 'minDate', the_date);
            }
        });
        jQuery(".datepicker2").datepicker({
            changeMonth: true,
            changeYear: true,
            onSelect: function(dateText, inst) {
                var the_date = new Date(dateText);
                jQuery(".datepicker1").datepicker('option', 'maxDate', the_date);
            }
        });
        jQuery('.datepicker1').on('click', function(e) {
            e.preventDefault();
            jQuery(this).attr("autocomplete", "off");
        });
        jQuery('.datepicker2').on('click', function(e) {
            e.preventDefault();
            jQuery(this).attr("autocomplete", "off");
        });
    }

    function preview_images_upload(evt) {
        if (evt.type === 'change') {
            var files = evt.target.files;
        } else if (evt.type === 'drop') {
            var files = evt.dataTransfer.files;
            evt.stopPropagation();
            evt.preventDefault();
        } else {
            evt.preventDefault();
            return false;
        }
        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    var span = document.createElement('span');
                    span.innerHTML = [
                        '<div class="image-container" id="img_' + escape(theFile.name) + '">' +
                        '<input type="hidden" name="uploaded_images[]" id="uploaded_' + escape(theFile.name) + '" value="' + escape(theFile.name) + '">' +
                        '<img src="' + e.target.result + '" title="' + escape(theFile.name) + '">' +
                        '<button class="image-remove" onclick="return remove_image(event, \'' + escape(theFile.name) + '\');">Remove</button>'
                    ].join('');

                    jQuery('#append_images').append(span);
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }

    function handleDragOver(evt) {
        evt.stopPropagation();
        evt.preventDefault();
        evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {

        // Step show event
        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
            //alert("You are on step "+stepNumber+" now");
            if (stepPosition === 'first') {
                $("#prev-btn").addClass('disabled');
            } else if (stepPosition === 'final') {
                $("#next-btn").addClass('disabled');
            } else {
                $("#prev-btn").removeClass('disabled');
                $("#next-btn").removeClass('disabled');
            }
        });

        // Toolbar extra buttons
        var btnFinish = $('<button></button>').text('Finish')
            .addClass('btn btn-info')
            .on('click', function() {
                alert('Finish Clicked');
            });
        var btnCancel = $('<button></button>').text('Cancel')
            .addClass('btn btn-danger')
            .on('click', function() {
                $('#smartwizard').smartWizard("reset");
            });


        // Smart Wizard
        $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'default',
            transitionEffect: 'fade',
            showStepURLhash: true,
            toolbarSettings: {
                toolbarPosition: 'both',
                toolbarButtonPosition: 'end',
                toolbarExtraButtons: [btnFinish, btnCancel]
            }
        });


        // External Button Events
        $("#reset-btn").on("click", function() {
            // Reset wizard
            $('#smartwizard').smartWizard("reset");
            return true;
        });

        $("#prev-btn").on("click", function() {
            // Navigate previous
            $('#smartwizard').smartWizard("prev");
            return true;
        });

        $("#next-btn").on("click", function() {
            // Navigate next
            $('#smartwizard').smartWizard("next");
            return true;
        });

        $("#theme_selector").on("change", function() {
            // Change theme
            $('#smartwizard').smartWizard("theme", $(this).val());
            return true;
        });

        // Set selected theme on page refresh
        $("#theme_selector").change();
    });
</script>