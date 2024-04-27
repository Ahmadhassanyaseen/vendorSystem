<div class="mt-5 container" style="padding:0px 4rem;">
    <!-- Testing -->
    <style>
        .w60 {
            width: 50% !important;
            max-width: 50% !important;
        }

        .w40 {
            width: 50% !important;
            max-width: 50% !important;

        }

        #registration_form>div>div.col-sm-12.col-md-4.ps-auto.shadow-sm>div.d-flex.align-items-center.justify-content-between>span {
            width: 55% !important;
            max-width: 55% !important;
        }
    </style>
    <div class="me-auto ms-auto mb-5 allVehicles w-100">
        <form class="w-100" method="post" action="#" id="registration_form" onsubmit="return validate_vehicle(event, 'all');" enctype="multipart/form-data">
            <input type="hidden" name="vehicle" value="<?php if (isset($_REQUEST['vehicle']) && !empty($_REQUEST['vehicle'])) echo $_REQUEST['vehicle']; ?>">
            <input type="hidden" name="vendor" value="<?php if (isset($_SESSION['VNDR']['id']) && !empty($_SESSION['VNDR']['id'])) echo $_SESSION['VNDR']['id']; ?>">
            <div class="row w-100 " stye>
                <div class="col-sm-12 col-md-4 ps-auto shadow-sm">
                    <h1 class="fst-italic text-secondary vehicleTitle txc ff ">Vehicle Data</h1>
                    <div class="d-flex align-items-center justify-content-between mb-2">

                        <h6 class="fst-italic text-light-emphasis mb8 w40">Vehicle Type : </h6>
                        <select class="ipt_uif_select select2-hidden-accessible w60" name="vehicle_type" id="vehicle_type" data-placeholder="Select Vehicle Type" placeholder="Select Vehicle Type" title="Select Vehicle Type" data-allow-clear="true" data-theme="eform-material eform-select2-boxy" tabindex="-1" aria-hidden="true">
                            <?php
                            foreach ($vehicle_type_options as $vindx => $vval) {
                                if ($vehicle_object['vehicle_type'] == $vindx)
                                    echo '<option value="' . $vindx . '" selected>' . $vval . '</option>';
                                else
                                    echo '<option value="' . $vindx . '">' . $vval . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">

                        <h6 class="fst-italic text-light-emphasis mb8 w40">Vehicle Make : </h6>

                        <input class="ipt_uif_text w60" name="vehicle_make" id="vehicle_make" type="text" placeholder="Vehicle Make (optional)" title="Vehicle Make (Optional)" value="<?php echo $vehicle_object['vehicle_make']; ?>">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">

                        <h6 class="fst-italic text-light-emphasis mb8 w40">Vehicle Year : </h6>

                        <select class="ipt_uif_select select2-hidden-accessible w60" name="vehicle_year" id="vehicle_year" data-placeholder="Select Vehicle Year" placeholder="Select Vehicle Year" title="Select Vehicle Year" data-allow-clear="true" data-theme="eform-material eform-select2-boxy" tabindex="-1" aria-hidden="true">
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
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">

                        <h6 class="fst-italic text-light-emphasis mb8 w40">Vehicle Model : </h6>

                        <input class="ipt_uif_text w60" name="vehicle_model" id="vehicle_model" maxlength="" type="text" placeholder="Vehicle Model (Optional)" title="Vehicle Model (Optional)" value="<?php echo $vehicle_object['vehicle_model']; ?>">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">

                        <h6 class="fst-italic text-light-emphasis mb8 w40">Vehicle Quantity : </h6>

                        <input class="ipt_uif_text w60" name="vehicle_quantity" id="vehicle_quantity" type="text" placeholder="Enter Quantity of Identical Vehicles (Ex: 1)" title="Enter Quantity of Identical Vehicles (Ex: 1)" value="<?php echo $vehicle_object['vehicle_quantity']; ?>">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">

                        <h6 class="fst-italic text-light-emphasis mb8 w40">Vehicle Capacity : </h6>

                        <input class="ipt_uif_text w60" name="vehicle_capacity" id="vehicle_capacity" type="text" placeholder="Passenger Limit (Ex: 20)" title="Passenger Limit (Ex: 20)" value="<?php echo $vehicle_object['vehicle_capacity']; ?>">
                    </div>
                     <div class="d-flex align-items-center justify-content-between mb-2">

     <h6 class="fst-italic text-light-emphasis mb8 w40">Luggage Limit : </h6>
     
                    <input class="ipt_uif_text w60" name="luggage_limit" id="luggage_limit" type="text" placeholder="Luggage Limit (Ex: 20)" title="Luggage Limit (Ex: 20)" value="<?php if (!empty($vehicle_object['luggage_limit'])) {
                                                                                                                                                                                    echo $vehicle_object['luggage_limit'];
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo "0";
                                                                                                                                                                                }  ?>">
 </div>
                   
                   <!-- <img src="https://unlimitedcharters.com/vendor/system/backend/images/24_pax_out_black.png" sizes="4000px" width="425" class="mt-2 w-100"> -->
                    <div class="veh-box">
                        <?php
                        $countr = 0;
                        foreach ($vehicle_object['vehicle_images'] as $img) {
                            if (file_exists("vehicles/" . $img) && !empty($img)) {
                        ?>
                                <div class="image-container" style="width:100%;" id="img_<?php echo $img; ?>">
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

                        <div class="fileupload-buttonbar">
                            <div class="fileupload-buttons">
                                <span class="fileinput-button secondary-button large ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button" style="padding: 15px 5px; width: 100%;">
                                    <span class="ui-button-text"> <span class="select secondary-button">Select Images</span></span>
                                    <input class="ipt_uif_uploader_handle" multiple="multiple" name="vehicle_images[]" id="vehicle_images" accept="image/x-png,image/gif,image/jpeg" type="file">
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-12 col-md-4  overflow-auto pe-3 shadow-sm">
                    <h1 class="fst-italic text-secondary vehicleTitle txc ff">Vehicle Features</h1>

                    <div class="col-md-12 float-end me-auto ms-auto">
                        <div class="col-md-7 col-sm-12 m-0 p-0">
                            <label class="form-check-label fs-6 fw-semibold text-primary text-uppercase f16" for="formInput22">
                                <b class="fst-italic fw-bold text-decoration-underline text-uppercase">Interior Style</b>
                            </label>
                            <?php
                            $c = 0;
                            foreach ($interior_style_options as $iindx => $ivalue) {
                                if (in_array($iindx, $vehicle_object['interior_style']))
                                    echo '<div class="ipt_uif_label_column column_2"><input  class="filled-in" name="interior_style[]" id="interior_style_' . $c . '" value=" ' . $iindx . ' " type="checkbox" checked><label class="eform-label-with-tabindex" tabindex="0" for="interior_style_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                                else
                                    echo '<div class="ipt_uif_label_column column_2"><input  class="filled-in" name="interior_style[]" id="interior_style_' . $c . '" value=" ' . $iindx . ' " type="checkbox"><label class="eform-label-with-tabindex" tabindex="0" for="interior_style_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                                $c++;
                            }
                            ?>
                        </div>
                        <div class="col-md-5 col-sm-12 m-0 p-0">
                            <b class="fst-italic fw-bold text-decoration-underline text-primary text-uppercase f16">Multi-Media&nbsp;</b>
                            <?php
                            $c = 0;
                            foreach ($media_capability_options as $iindx => $ivalue) {
                                if (in_array($iindx, $vehicle_object['media_capability']))
                                    echo '<div class="ipt_uif_label_column column_3"><input  class="filled-in" name="media_capability[]" id="media_capability_' . $c . '" value=" ' . $iindx . ' " type="checkbox" checked><label class="eform-label-with-tabindex" tabindex="0" for="media_capability_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                                else
                                    echo '<div class="ipt_uif_label_column column_3"><input  class="filled-in" name="media_capability[]" id="media_capability_' . $c . '" value=" ' . $iindx . ' " type="checkbox"><label class="eform-label-with-tabindex" tabindex="0" for="media_capability_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                                $c++;
                            }
                            ?>
                        </div>
                        <div class="col-md-7 col-sm-12 m-0 p-0">
                            <b class="fst-italic fw-bold text-decoration-underline text-primary text-uppercase f16">On-Board Luxury</b>
                            <?php
                            $c = 0;
                            foreach ($onboard_luxury_options as $iindx => $ivalue) {
                                if (in_array($iindx, $vehicle_object['onboard_luxury']))
                                    echo '<div class="ipt_uif_label_column column_3"><input  class="filled-in" name="onboard_luxury[]" id="onboard_luxury_' . $c . '" value=" ' . $iindx . ' " type="checkbox" checked><label class="eform-label-with-tabindex" tabindex="0" for="onboard_luxury_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                                else
                                    echo '<div class="ipt_uif_label_column column_3"><input  class="filled-in" name="onboard_luxury[]" id="onboard_luxury_' . $c . '" value=" ' . $iindx . ' " type="checkbox"><label class="eform-label-with-tabindex" tabindex="0" for="onboard_luxury_' . $c . '" data-labelcon="&#xe18e;"> ' . $ivalue . ' </label></div>';
                                $c++;
                            }
                            ?>
                        </div>
                        <div class="col-md-5 col-sm-12 m-0 p-0">
                            <b class="fst-italic fw-bold text-decoration-underline text-primary text-uppercase f16">Complimentary</b>
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
                        </div>

                    </div>


                </div>
                <div class="col-sm-12 col-md-4  pe-auto shadow-sm">
                    <h1 class="fst-italic text-secondary vehicleTitle txc ff">Vehicle Pricing</h1>
                    <!-- <u class="text-start ff underLine">Set your vehicle pricing.</u> -->
                    <input class="ipt_uif_text vndr_currency" name="base_hourly_rate" id="base_hourly_rate" type="text" placeholder="Enter Base Hourly Rate" title="Enter Base Hourly Rate" value="<?php echo $vehicle_object['base_hourly_rate']; ?>" required>
                    <input class="ipt_uif_text" name="base_min_hours" id="base_min_hours" type="text" placeholder="Enter Minimum Hours" title="Enter Minimum Hours" value="<?php echo number_format($vehicle_object['base_min_hours'], 0, '.', ',');
                                                                                                                                                                            ?>" required>
                    <input class="ipt_uif_text vndr_currency" name="base_additional_hourly" id="base_additional_hourly" type="text" placeholder="Enter Rate (Optional)" title="Enter Hourly Rate For Additional Hours (Optional)" value="<?php echo $vehicle_object['base_additional_hourly']; ?>">

                </div>
                <input type="submit" value="Submit" class="vehicleAddBtn">
        </form>
    </div>
</div>
<!-- Testing -->

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