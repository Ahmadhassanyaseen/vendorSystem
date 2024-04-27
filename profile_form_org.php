<?php ?>

<form method="post" action="#" id="profile_form" style="margin-bottom: 40px;" onsubmit="return validate_profile(event);">
    <input type="hidden" name="vid" value="<?php if (isset($_SESSION['VNDR']['id'])) echo $_SESSION['VNDR']['id']; ?>">
    <input type="hidden" name="uvid" value="<?php if (isset($_SESSION['VNDR']['unique_vendor_id'])) echo $_SESSION['VNDR']['unique_vendor_id']; ?>">
    <div class="ipt-eform-content">
        <div data-settings="" class="ipt_fsqm_main_tab ipt_uif_tabs horizontal ui-tabs ui-widget ui-widget-content ui-corner-all">
            <?php require_once 'logout_link.php'; ?>
            <div id="tab_0" class="ipt_fsqm_form_tab_panel ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false">
                <div id="layout_0_inner" class="ipt-eform-layout-wrapper">
                    <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_main_heading_column">
                        <div class="ipt_uif_column_inner">
                            <h3 class="ipt_fsqm_main_heading ipt_uif_heading ipt_uif_divider ipt_uif_align_left ipt_uif_divider_icon_no_bg">
                                <span class="ipt_uif_divider_text has-icon ipt-eform-profile">
                                    <i class=" ipt-icomoon-profile ipticm prefix"></i>
                                    <span class="ipt_uif_divider_text_inner">
                                        VENDOR OVERVIEW
                                    </span>
                                </span>
                            </h3>

                            <div class="clear-both">
                            </div>
                        </div>
                    </div>
                    <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional" style="">
                        <div class="ipt_uif_column_inner side_margin">
                            <p>
                                <em>Complete your vendor profile by inputting the following business information.</em>
                            </p>
                            <div class="clear-both">
                            </div>
                        </div>
                    </div>
                    <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_textinput" id="pinfo_0" style="">
                        <div class="ipt_uif_column_inner side_margin">
                            <div class="ipt_uif_question ipt_uif_question_vertical">
                                <div class="ipt_uif_question_label"> 
                                    <label class="ipt_uif_question_title ipt_uif_label" for="name">Vendor Details<span class="ipt_uif_question_required">*</span></label>
                                    <div class="clear-both"></div>
                                </div>
                                <div class="ipt_uif_question_content">
                                    <div class="input-field has-icon">
                                        <input class="ipt_uif_text" name="name" id="name" maxlength="" type="text" value="<?php
                                        if (isset($_SESSION['VNDR']['status']) && $_SESSION['VNDR']['status'] == 'Complete_Profile')
                                            echo '';
                                        else if (isset($_SESSION['VNDR']['name']))
                                            echo $_SESSION['VNDR']['name'];
                                        else
                                            echo '';
                                        ?>" placeholder="Business Name">
                                        <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe84f;"></i> 
                                        <!--                                        <label for="name">Business Name</label>-->
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                    <div class="ipt_uif_column ipt_uif_column_half ipt_uif_conditional ipt_fsqm_container_textinput" id="pinfo_2" style="">
                        <div class="ipt_uif_column_inner side_margin">
                            <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                <div class="ipt_uif_question_content">
                                    <div class="input-field has-icon">
                                        <input class="check_me ipt_uif_text" name="website" id="website" maxlength="" type="text" value="<?php if (isset($_SESSION['VNDR']['website'])) echo $_SESSION['VNDR']['website']; ?>" placeholder="Website">
                                        <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe2cd;"></i>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                    <div class="ipt_uif_column ipt_uif_column_half ipt_uif_conditional ipt_fsqm_container_textinput" id="pinfo_13" style="">
                        <div class="ipt_uif_column_inner side_margin">
                            <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                <div class="ipt_uif_question_content">
                                    <div class="input-field has-icon">
                                        <input class="check_me ipt_uif_text" name="dot_number" id="dot_number" maxlength="" type="text" value="<?php if (isset($_SESSION['VNDR']['dot_number'])) echo $_SESSION['VNDR']['dot_number']; ?>" placeholder="DOT Number">
                                        <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe530;"></i>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                    <div class="ipt_uif_column ipt_uif_column_half ipt_uif_conditional ipt_fsqm_container_email" id="pinfo_5" style="">
                        <div class="ipt_uif_column_inner side_margin">
                            <div class="ipt_uif_question ipt_uif_question_vertical">
                                <div class="ipt_uif_question_label">
                                    <label class="ipt_uif_question_title ipt_uif_label" for="email1">Contact Info<span class="ipt_uif_question_required">*</span></label>
                                    <div class="clear-both"></div>
                                </div>
                                <div class="ipt_uif_question_content">
                                    <div class="input-field has-icon">
                                        <input class="ipt_uif_text" name="email1" id="email1" type="email" value="<?php if (isset($_SESSION['VNDR']['email1'])) echo $_SESSION['VNDR']['email1']; ?>" placeholder="Email Address">
                                        <i title="" class="ipticm prefix" data-ipt-icomoon="&#xf0e0;"></i>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                    <div class="ipt_uif_column ipt_uif_column_half ipt_uif_conditional ipt_fsqm_container_phone" id="pinfo_6" style="">
                        <div class="ipt_uif_column_inner side_margin">
                            <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
							    <div class="ipt_uif_question_label">
                                    <label class="ipt_uif_question_title ipt_uif_label">&nbsp;</label>
                                    <div class="clear-both"></div>
                                </div>
                                <div class="ipt_uif_question_content">
                                    <div class="input-field has-icon">
                                        <input class="ipt_uif_text" name="phone_office" id="phone_office" maxlength="" type="tel" value="<?php if (isset($_SESSION['VNDR']['phone_office'])) echo $_SESSION['VNDR']['phone_office']; ?>" placeholder="Office Phone">
                                        <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe1ef;"></i>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                    <div class="ipt_uif_column ipt_uif_column_half ipt_uif_conditional ipt_fsqm_container_textinput" id="pinfo_7" style="">
                        <div class="ipt_uif_column_inner side_margin">
                            <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                <div class="ipt_uif_question_content">
                                    <div class="input-field has-icon">
                                        <input class="ipt_uif_text" name="ownership" id="ownership" maxlength="" type="text" value="<?php if (isset($_SESSION['VNDR']['ownership'])) echo $_SESSION['VNDR']['ownership']; ?>" placeholder="Manager">
                                        <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe0a0;"></i>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                    <div class="ipt_uif_column ipt_uif_column_half ipt_uif_conditional ipt_fsqm_container_phone" id="pinfo_6" style="">
                        <div class="ipt_uif_column_inner side_margin">
                            <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                <div class="ipt_uif_question_content">
                                    <div class="input-field has-icon">
                                        <input class="ipt_uif_text" name="phone_alternate" id="phone_alternate" maxlength="" type="tel" value="<?php if (isset($_SESSION['VNDR']['phone_alternate'])) echo $_SESSION['VNDR']['phone_alternate']; ?>" placeholder="Manager Phone">
                                        <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe08c;"></i>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                    <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_textinput" id="pinfo_9" style="">
                        <div class="ipt_uif_column_inner side_margin">
                            <div class="ipt_uif_question ipt_uif_question_vertical">
                                <div class="ipt_uif_question_label">
                                    <label class="ipt_uif_question_title ipt_uif_label" for="street_address">Physical Address<span class="ipt_uif_question_required">*</span></label>
                                    <div class="clear-both"></div>
                                </div>
                                <div class="ipt_uif_question_content">
                                    <div class="input-field has-icon">
                                        <input class="ipt_uif_text" onFocus="geolocate()" name="billing_address_street" id="billing_address_street" maxlength="" type="text" value="<?php if (isset($_SESSION['VNDR']['billing_address_street'])) echo $_SESSION['VNDR']['billing_address_street']; ?>" placeholder="Street Address">
                                        <input type="hidden" id="address_lat" name="address_lat" value="">
                                        <input type="hidden" id="address_lng" name="address_lng" value="">
                                        <i title="" class="ipticm prefix" data-ipt-icomoon="&#xf21d;"></i>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                    <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_textinput" id="pinfo_10" style="">
                        <div class="ipt_uif_column_inner side_margin">
                            <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                <div class="ipt_uif_question_content">
                                    <div class="input-field has-icon">
                                        <input class="ipt_uif_text" name="billing_address_city" id="billing_address_city" maxlength="" type="text" value="<?php if (isset($_SESSION['VNDR']['billing_address_city'])) echo $_SESSION['VNDR']['billing_address_city']; ?>" placeholder="City">
                                        <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe7f1;"></i>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                    <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_textinput" id="pinfo_11" style="">
                        <div class="ipt_uif_column_inner side_margin">
                            <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                <div class="ipt_uif_question_content">
                                    <div class="input-field has-icon">
                                        <input class="ipt_uif_text" name="billing_address_state" id="billing_address_state" maxlength="" type="text" value="<?php if (isset($_SESSION['VNDR']['billing_address_state'])) echo $_SESSION['VNDR']['billing_address_state']; ?>" placeholder="State">
                                        <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe07c;"></i>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                    <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_textinput" id="pinfo_12" style="">
                        <div class="ipt_uif_column_inner side_margin">
                            <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">
                                <div class="ipt_uif_question_content">
                                    <div class="input-field has-icon">
                                        <input class="ipt_uif_text" name="billing_address_postalcode" id="billing_address_postalcode" type="text" value="<?php if (isset($_SESSION['VNDR']['billing_address_postalcode'])) echo $_SESSION['VNDR']['billing_address_postalcode']; ?>" placeholder="Zipcode">
                                        <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe07c;"></i>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                    <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_p_radio" id="pinfo_16" style="">
                        <div class="ipt_uif_column_inner side_margin">
                            <div class="ipt_uif_question ipt_uif_question_vertical">
                                <div class="ipt_uif_question_label"> 
                                    <label class="ipt_uif_question_title ipt_uif_label" for="pinfo_16">Is Your Company Interstate or Intrastate?<span class="ipt_uif_question_required">*</span></label>
                                    <div class="clear-both"></div>
                                    <div class="ipt_uif_richtext">
                                        <p>
                                            <em>NOTE: Interstate companies may operate <strong>across</strong> <strong>state lines</strong>. Intrastate companies operate <strong>within one state only</strong>.</em>
                                        </p>
                                    </div>
                                </div>
                                <div class="ipt_uif_question_content">
                                    <div class="ipt_uif_label_column column_random">
                                        <input class="ipt_uif_radio with-gap" name="vendors_type" id="vendors_type_0" value="Interstate" type="radio" <?php if (isset($_SESSION['VNDR']['vnd_vendors_type']) && $_SESSION['VNDR']['vnd_vendors_type'] == 'Interstate') echo 'checked'; ?>>
                                        <label class="eform-label-with-tabindex" tabindex="0" for="vendors_type_0" data-labelcon="&#xe18e;"> Interstate </label>
                                    </div>
                                    <div class="ipt_uif_label_column column_random">
                                        <input class="ipt_uif_radio with-gap" name="vendors_type" id="vendors_type_1" value="Intrastate" type="radio" <?php if (isset($_SESSION['VNDR']['vnd_vendors_type']) && $_SESSION['VNDR']['vnd_vendors_type'] == 'Intrastate') echo 'checked'; ?>>
                                        <label class="eform-label-with-tabindex" tabindex="0" for="vendors_type_1" data-labelcon="&#xe18e;"> Intrastate </label>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                    <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_slider" id="mcq_1" style="">
                        <div class="ipt_uif_column_inner side_margin">
                            <div class="ipt_uif_question ipt_uif_question_vertical">
                                <div class="ipt_uif_question_label">
                                    <label class="ipt_uif_question_title ipt_uif_label" for="service_radius">Service Radius<span class="ipt_uif_question_required">*</span></label>
                                    <div class="clear-both"></div>
                                    <div class="ipt_uif_richtext">
                                        <p>
                                            <em>Starting at your garage, what is the maximum distance (in miles) your vehicles will travel for pickups?</em>
                                        </p>
                                    </div>
                                </div>
                                <div class="ipt_uif_question_content">
                                    <div class="ipt_uif_empty_box ipt_uif_slider_box">
                                        <div id="slider"></div>
                                        <input min="0" max="300" step="10" class="ipt_uif_slider check_me" name="service_radius" id="service_radius" value="<?php
                                        if (isset($_SESSION['VNDR']['service_radius']))
                                            echo number_format($_SESSION['VNDR']['service_radius'], 0);
                                        else
                                            echo '0';
                                        ?>" type="number">
                                        <div class="ipt_uif_slider_count"></div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </div>

                    <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_terms" id="ipt_fsqm_form_56_pinfo_9">
                        <div class="ipt_uif_column_inner side_margin">
                            <div class="ipt_uif_question ipt_uif_question_vertical">
                                <div class="ipt_uif_question_content">
                                    <div class="ipt_uif_label_column column_random"> 
                                        <input data-num="" class="check_me ipt_uif_checkbox filled-in" name="allowcharges" id="allowcharges"  type="checkbox" <?php if (isset($_SESSION['VNDR']['allowcharges_c'])){ 
                                            if($_SESSION['VNDR']['allowcharges_c'] == 'on'){
                                         echo "checked";}
                                         else{
                                         echo '';}}?>> 
                                        <label class="eform-label-with-tabindex" tabindex="0" for="allowcharges" data-labelcon="" required> Garage Time Chargeable? </label>
                                    </div>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="clear-both">
                            </div>
                        </div>
                    </div>
                    <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_terms" id="ipt_fsqm_form_56_pinfo_9">
                        <div class="ipt_uif_column_inner side_margin">
                            <div class="ipt_uif_question ipt_uif_question_vertical">
                                <div class="ipt_uif_question_content">
                                    <div class="ipt_uif_label_column column_random"> 
                                        <input type="number" name="hourstocharge" step="30" min="30" max="100" style="text-align: left;" value="<?php if (isset($_SESSION['VNDR']['hourstocharge_c'])) echo $_SESSION['VNDR']['hourstocharge_c']; ?>">
                                        <label class="eform-label-with-tabindex" tabindex="0" for="hourstocharge" data-labelcon="" required>Increment box </label>
                                    </div>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="clear-both">
                            </div>
                        </div>
                    </div>
                    <div class="clear-both"></div>
                </div>
            </div>
            <div class="clear">
            </div>
            <div class="eformbutton_container">
                <input type="submit" class="eformbutton eformbutton_blue" name="update_profile_button" id="update_profile_button" role="button" value="UPDATE PROFILE">
            </div>
        </div>
    </div>
</form>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="css/jquery-ui-slider-pips.css">
<style>#slider { margin: 10px; }	</style>

<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/jquery-ui-slider-pips.js"></script>
<script>
                                            var placeSearch, autocomplete;
                                            var componentForm = {
                                                street_number: 'short_name',
                                                route: 'long_name',
                                                locality: 'long_name',
                                                administrative_area_level_1: 'short_name',
                                                country: 'long_name',
                                                postal_code: 'short_name'
                                            };
                                            function initAutocomplete() {
                                                autocomplete = new google.maps.places.Autocomplete(
                                                        (document.getElementById('billing_address_street')),
                                                        {types: ['geocode', 'establishment'], componentRestrictions: {country: 'us'}});
                                                autocomplete.addListener('place_changed', fillInAddress);
                                            }
                                            function fillInAddress() {
                                                var place = autocomplete.getPlace();
                                                document.getElementById('billing_address_street').value = '';
                                                document.getElementById('billing_address_street').disabled = false;
                                                document.getElementById('billing_address_city').value = '';
                                                document.getElementById('billing_address_city').disabled = false;
                                                document.getElementById('billing_address_state').value = '';
                                                document.getElementById('billing_address_state').disabled = false;
                                                document.getElementById('billing_address_postalcode').value = '';
                                                document.getElementById('billing_address_postalcode').disabled = false;
                                                var s_number = '';
                                                var s_route = '';
                                                document.getElementById("address_lat").value = place.geometry.location.lat();
                                                document.getElementById("address_lng").value = place.geometry.location.lng();
                                                for (var i = 0; i < place.address_components.length; i++) {
                                                    var addressType = place.address_components[i].types[0];
                                                    if (componentForm[addressType]) {
                                                        var val = place.address_components[i][componentForm[addressType]];
                                                        if (addressType == 'locality')
                                                            document.getElementById('billing_address_city').value = val;
                                                        else if (addressType == 'administrative_area_level_1')
                                                            document.getElementById('billing_address_state').value = val;
                                                        else if (addressType == 'postal_code')
                                                            document.getElementById('billing_address_postalcode').value = val;
                                                        else if (addressType == 'street_number')
                                                            s_number = val;
                                                        else if (addressType == 'route')
                                                            s_route = val;
                                                    }
                                                }
                                                var street_add = s_number;
                                                if (street_add && s_route)
                                                    street_add = street_add + ' ' + s_route;
                                                else
                                                    street_add = s_route;
                                                document.getElementById('billing_address_street').value = street_add;
                                            }
                                            function geolocate() {
                                                if (navigator.geolocation) {
                                                    navigator.geolocation.getCurrentPosition(function (position) {
                                                        var geolocation = {
                                                            lat: position.coords.latitude,
                                                            lng: position.coords.longitude
                                                        };
                                                        var circle = new google.maps.Circle({
                                                            center: geolocation,
                                                            radius: position.coords.accuracy
                                                        });
                                                        autocomplete.setBounds(circle.getBounds());
                                                    });
                                                }
                                            }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-XmAtSvNj2CjcYT7VRfnIk58aGsdeh7k&libraries=places&callback=initAutocomplete" async defer></script>

<script>
                                            jQuery(document).ready(function ($) {
                                                var start_val = document.getElementById("service_radius").value;
                                                $("#slider").slider({
                                                    min: 0,
                                                    max: 300,
                                                    step: 10,
                                                    value: start_val,
                                                    change: function (event, ui) {
                                                        document.getElementById("service_radius").value = ui.value;
                                                    },
                                                }).slider("pips", {rest: "label", step: 5}).slider("float", {});
                                            });
</script>