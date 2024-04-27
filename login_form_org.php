<?php ?>
<style>
    @media(max-width: 768px) {
        .login-main {
            flex-direction: column;
        }
    }
</style>
<div class="login-parent">
    <div class="login-main container sm-login-main d-flex flex-sm-column flex-lg-row">
        <div class="login-img d-flex align-items-center justify-content-center col">
            <img src="images/Logo-Image2.png" alt="" class="img-fluid">
        </div>

        <form method="post" action="" class="col" id="login_form">
            <div class="ipt-eform-content ">
                <div data-settings="{&quot;can_previous&quot;:true,&quot;show_progress_bar&quot;:false,&quot;progress_bar_bottom&quot;:false,&quot;block_previous&quot;:false,&quot;any_tab&quot;:true,&quot;type&quot;:&quot;2&quot;,&quot;scroll&quot;:true,&quot;decimal_point&quot;:2,&quot;auto_progress&quot;:false,&quot;auto_progress_delay&quot;:&quot;1500&quot;,&quot;auto_submit&quot;:false,&quot;hidden_buttons&quot;:false,&quot;scroll_on_error&quot;:true}" class="ipt_fsqm_main_tab ipt_uif_tabs horizontal ui-tabs ui-widget ui-widget-content ui-corner-all">

                    <div id="ipt_fsqm_form_56_tab_0" class="ipt_fsqm_form_tab_panel ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false">
                        <div id="ipt_fsqm_form_56_layout_0_inner" class="ipt-eform-layout-wrapper">
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_main_heading_column">
                                <div class="ipt_uif_column_inner">
                                    <h3 class="ipt_fsqm_main_heading ipt_uif_heading ipt_uif_divider ipt_uif_align_left ipt_uif_divider_icon_no_bg">
                                        <span class="ipt_uif_divider_text">
                                            <i title="" class="login-cl ipticm prefix" data-ipt-icomoon="">
                                            </i>
                                            <span class="ipt_uif_divider_text_inner">
                                                Sign In
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
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_p_email" id="ipt_fsqm_form_56_pinfo_0">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical">
                                        <div class="ipt_uif_question_label">
                                            <label class="ipt_uif_question_title ipt_uif_label login-cl" for="username">Email Address<span class="ipt_uif_question_required"></span>
                                            </label>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <div class="input-field has-icon">
                                                <input class="login-input check_me validate[required,custom[email]] ipt_uif_text" name="username" id="username" value="<?php echo $email; ?>" type="email">
                                                <i title="" class=" login-cl ipticm prefix" data-ipt-icomoon=""></i>
                                            </div>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear-both">
                                    </div>
                                </div>
                            </div>
                            <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_password" id="ipt_fsqm_form_56_pinfo_1">
                                <div class="ipt_uif_column_inner side_margin">
                                    <div class="ipt_uif_question ipt_uif_question_vertical">
                                        <div class="ipt_uif_question_label">
                                            <label class="login-cl ipt_uif_question_title ipt_uif_label" for="password">Password<span class="ipt_uif_question_required"></span>
                                            </label>
                                            <div class="clear-both">
                                            </div>
                                        </div>
                                        <div class="ipt_uif_question_content">
                                            <div class="input-field has-icon ipt-eform-password">
                                                <input class="login-input check_me validate[required] ipt_uif_text ipt_uif_password" name="password" id="password" value="" type="password">
                                                <i class="login-cl ipt-icomoon-unlocked ipticm prefix">
                                                </i>
                                                <label for="password" class="active">
                                                </label>
                                                <a class="login-cl" style="float: right;margin-top:10px;" href="reset.php" title="">FORGET PASSWORD?</a>
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
                    <button class="eformbutton eformbutton_blue loginBtn" name="sign_in_button" id="sign_in_button" role="button">
                        <span class="ui-button-text">Sign In</span>
                    </button>
                    <div class="clear-both">
                    </div>
                    <span>
                        Don't have an account? click
                    </span>
                    <a class="login-cl" href="registration.php" title="CLICK HERE TO SIGN UP">SIGN UP</a>
                    <div class="clear-both">
                    </div>
                    <br>
                </div>
            </div>
        </form>
    </div>
</div>