<?php ?>
<div class="logup-parent">
    <div class="logup-main container">
        <div class="logup-img d-flex align-items-center justify-content-center col-md-12">
            <img src="images/Logo-Image2.png" alt="" class="img-fluid">
        </div>

        <form method="post" action="#" class="col-md-12" id="registration_form" onsubmit="return validate_registration(event);">
            <div class="ipt-eform-content ">
                <div data-settings="" class="ipt_fsqm_main_tab ipt_uif_tabs horizontal ui-tabs ui-widget ui-widget-content ui-corner-all">

                    <div id="ipt_fsqm_form_56_tab_1" class="ipt_fsqm_form_tab_panel ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-2" role="tabpanel" style="" aria-hidden="true">
                        <div id="ipt_fsqm_form_56_layout_1_inner" class="ipt-eform-layout-wrapper">
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_main_heading_column">
                                <div class="ipt_uif_column_inner">
                                    <h3 class="ipt_fsqm_main_heading ipt_uif_heading ipt_uif_divider ipt_uif_align_left ipt_uif_divider_icon_no_bg">
                                        <span class="ipt_uif_divider_text">
                                            <i title="" class="login-cl ipticm prefix" data-ipt-icomoon="">
                                            </i>
                                            <span class="ipt_uif_divider_text_inner">
                                                SIGN UP
                                            </span>
                                        </span>
                                    </h3>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_blank_container" id="ipt_fsqm_form_56_design_8">
                                <div class="ipt_uif_column_inner">
                                    <div class="ipt_uif_blank_container">
                                        <?php
                                        if ($ispost == true && sizeof($errors) > 0)
                                            foreach ($errors as $error) {
                                        ?>
                                            <div class="alert alert-danger">
                                                <span><?php echo $error; ?></span>
                                            </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_p_email" id="ipt_fsqm_form_56_pinfo_5">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical">
                                        <div class="ipt_uif_question_label">
                                            <label class="ipt_uif_question_title ipt_uif_label login-cl" for="user_email">Email Address<span class="ipt_uif_question_required"> </span>
                                            </label>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <div class="input-field has-icon">
                                                <input class="ipt_uif_text login-input" name="user_email" id="user_email" type="email" value="<?php echo $email; ?>" required>
                                                <i title="" class="login-cl ipticm prefix" data-ipt-icomoon="">
                                                </i>
                                                <input type="hidden" id="duplicate_vendor" value="">
                                                <div id="user_duplicate_check" style="line-height: 14px; font-size: 12px; text-align: left; padding-left: 5px; color: #fff; background-color: red; display: none;">Email already exists, Please try to login instead.</div>
                                            </div>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_password" id="ipt_fsqm_form_56_pinfo_6">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical">
                                        <div class="ipt_uif_question_label">
                                            <label class="ipt_uif_question_title ipt_uif_label login-cl" for="user_password">Password<span class="ipt_uif_question_required"> </span>
                                            </label>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <div class="input-field has-icon ipt-eform-password">
                                                <input class="ipt_uif_text ipt_uif_password login-input" name="user_password" id="user_password" value="" type="password" required>
                                                <i class="login-cl ipt-icomoon-unlocked ipticm prefix"></i>
                                                <label for="user_password"></label>
                                                <div id="password_strength" style="line-height: 14px; font-size: 11px; text-align: left; padding-left: 5px; color:#E3B04B;"></div>
                                            </div>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_password" id="ipt_fsqm_form_56_pinfo_7">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical">
                                        <div class="ipt_uif_question_label">
                                            <label class="ipt_uif_question_title ipt_uif_label login-cl" for="confirm_password">Confirm Password<span class="ipt_uif_question_required"> </span>
                                            </label>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <div class="input-field has-icon ipt-eform-password">
                                                <input class="login-input ipt_uif_text ipt_uif_password" name="confirm_password" id="confirm_password" value="" type="password" required>
                                                <i class="login-cl ipt-icomoon-loop2 ipticm prefix"></i>
                                                <label for="confirm_password"></label>
                                                <div id="match_duplicate" style="line-height: 14px; font-size: 11px; text-align: left; padding-left: 5px;"></div>
                                            </div>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_captcha" id="ipt_fsqm_form_56_pinfo_8">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical">
                                        <div class="ipt_uif_question_label">
                                            <label class="ipt_uif_question_title ipt_uif_label login-cl" for="captcha_code">Validation code:<span class="ipt_uif_question_required"> </span>
                                            </label>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <div class="input-field has-icon ipt-eform-captcha" style=" float: left;">
                                                <input id="captcha_code" name="captcha_code" type="text" placeholder="Enter the code displayed in image" autocomplete="off" required>
                                                <i class=" ipt-icomoon-spell-check ipticm prefix login-cl"></i>
                                                <label for="captcha_code">
                                                </label>
                                            </div>
                                            <div class="" style="float: left; padding: 0;">
                                                <img src="captcha.php?rand=<?php echo rand(); ?>" id='captchaimg'><br>
                                                Can't read the image? click <a class="login-cl" href='javascript: refreshCaptcha();'>HERE</a> to refresh.
                                            </div>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div> -->
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_terms" id="ipt_fsqm_form_56_pinfo_9">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical">
                                        <div class="ipt_uif_question_content">
                                            <div class="ipt_uif_label_column column_random">
                                                <input data-num="" class="check_me ipt_uif_checkbox filled-in" name="terms" id="terms"  type="checkbox">
                                                <label class="eform-label-with-tabindex" tabindex="0" for="terms" data-labelcon="" required> I accept the <a href="terms.html" target="_blank" title="Accept Terms & Conditions" class="login-cl">Terms and Conditions</a> </label>
                                            </div>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear-both">
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="eformbutton_container">
                    <input type="submit" class="eformbutton eformbutton_blue loginBtn" name="sign_up_button" id="sign_up_button" role="button" value="SIGN UP">
                    <div class="clear-both">
                    </div>
                    <span>
                        Already have an account? click
                    </span>
                    <a href="login.php" title="CLICK HERE TO SIGN IN" class="login-cl">SIGN IN</a>
                    <div class="clear-both">
                    </div>
                    <br>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    jQuery(document).ready(function($) {
        check_pass();
        $('#user_password').bind('input keyup', function() {
            check_pass();
        });
        $('#confirm_password').bind('input keyup', function() {
            match_duplicate_pass();
        });
        $('#user_email').bind('blur', function() {
            check_duplicate_user();
        });
    });
</script>