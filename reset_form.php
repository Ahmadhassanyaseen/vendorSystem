<?php ?>
<style>
    .reset {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loginBtn {
        width: 90%;
    }

    .ipt-uif-custom-material-light-blue .ipt_uif_column .ipt_uif_column_inner {
        /* margin-bottom: 2rem; */
    }
</style>
<form method="post" action="" class="reset" id="reset_form" onsubmit="validate_reset_form(event);">
    <div class="ipt-eform-content ">
        <div data-settings="{&quot;can_previous&quot;:true,&quot;show_progress_bar&quot;:false,&quot;progress_bar_bottom&quot;:false,&quot;block_previous&quot;:false,&quot;any_tab&quot;:true,&quot;type&quot;:&quot;2&quot;,&quot;scroll&quot;:true,&quot;decimal_point&quot;:2,&quot;auto_progress&quot;:false,&quot;auto_progress_delay&quot;:&quot;1500&quot;,&quot;auto_submit&quot;:false,&quot;hidden_buttons&quot;:false,&quot;scroll_on_error&quot;:true}" class="ipt_fsqm_main_tab ipt_uif_tabs horizontal ui-tabs ui-widget ui-widget-content ui-corner-all">

            <div id="ipt_fsqm_form_56_tab_1" class="ipt_fsqm_form_tab_panel ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-2" role="tabpanel" style="" aria-hidden="true">
                <div id="ipt_fsqm_form_56_layout_1_inner" class="ipt-eform-layout-wrapper">
                    <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_main_heading_column">
                        <div class="ipt_uif_column_inner">
                            <h3 class="fw-bolder me-auto ms-auto mt-5 login-cl text-start text-uppercase">
                                <span class="ipt_uif_divider_text">
                                    <i title="" class=" ipticm prefix" data-ipt-icomoon="">
                                    </i>
                                    <span class="ipt_uif_divider_text_inner">
                                        PASSWORD RESET
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
                                if ($ispost == true && sizeof($errors) > 0) {
                                    foreach ($errors as $error) {
                                ?>
                                        <div class="alert alert-danger">
                                            <span><?php echo $error; ?></span>
                                        </div>
                                    <?php
                                    }
                                } else if (sizeof($successes) > 0)
                                    foreach ($successes as $succs) {
                                    ?>
                                    <div class="alert alert-success">
                                        <span><?php echo $succs; ?></span>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="clear-both">
                            </div>
                        </div>
                        <?php
                        if (!empty($successes)) {
                        ?>
                            <a href="login.php" title="Login to Unlimited Charters Vendor System" style="float: right;" class="login-cl">LOGIN HERE</a>
                            <a href="https://unlimitedcharters.com" title="United Coachways" class="login-cl">Unlimited Charters</a>
                        <?php
                        }
                        ?>
                    </div>
                    <?php if (empty($successes)) {
                    ?>
                        <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_p_email" id="ipt_fsqm_form_56_pinfo_5">
                            <div class="ipt_uif_column_inner side_margin">
                                <div class="ipt_uif_question ipt_uif_question_vertical">
                                    <div class="ipt_uif_question_label">
                                        <label class="ipt_uif_question_title ipt_uif_label" for="user_email">Email Address<span class="ipt_uif_question_required">*</span>
                                        </label>
                                        <div class="clear-both">
                                        </div>
                                    </div>
                                    <div class="ipt_uif_question_content">
                                        <div class="input-field has-icon">
                                            <input class="ipt_uif_text" name="user_email" id="user_email" type="email" value="<?php echo $email; ?>" required>
                                            <i title="" class=" ipticm prefix" data-ipt-icomoon="">
                                            </i>
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
                                        <label class="ipt_uif_question_title ipt_uif_label" for="captcha_code">Validation code:<span class="ipt_uif_question_required">*</span>
                                        </label>
                                        <div class="clear-both">
                                        </div>
                                    </div>
                                    <div class="ipt_uif_question_content">
                                        <div class="input-field has-icon ipt-eform-password" style="width: 50%; float: left;">
                                            <input id="captcha_code" name="captcha_code" type="text" placeholder="Enter the code displayed in image" autocomplete="off" required>
                                            <i class=" ipt-icomoon-spell-check ipticm prefix"></i>
                                            <label for="captcha_code">
                                            </label>
                                        </div>
                                        <div class="" style="width: 50%; float: left; padding: 0;">
                                            <img src="captcha.php?rand=<?php // echo rand(); 
                                                                        ?>" id='captchaimg'><br>
                                            Can't read the image? click <a href='javascript: refreshCaptcha();'>HERE</a> to refresh.
                                        </div>
                                        <div class="clear-both">
                                        </div>
                                    </div>
                                </div>
                                <div class="clear-both">
                                </div>
                            </div>
                        </div> -->
                    <?php
                    }
                    ?>
                </div>
                <div class="clear-both">
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <?php if (empty($successes)) {
        ?>
            <div class="eformbutton_container">
                <button class="eformbutton eformbutton_blue loginBtn" name="reset_button" id="reset_button" role="button">
                    <span class="ui-button-text">REQUEST RESET PASSWORD</span>
                </button>
                <div class="clear-both">
                </div>
                <a href="login.php" class="login-cl" title="CLICK HERE TO SIGN IN">SIGN IN</a>
                <span> | </span>
                <a href="registration.php" class="login-cl" title="CLICK HERE TO SIGN UP">SIGN UP</a>
                <div class="clear-both">
                </div>
                <br>
            </div>
        <?php }
        ?>
    </div>
</form>