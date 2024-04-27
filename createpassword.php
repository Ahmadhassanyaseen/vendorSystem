<?php
$page = 'createpassword';
require_once './config.php';
require_once './session.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["v"]) && !empty($_POST["v"]) && isset($_POST["l"]) && !empty($_POST["l"]) && isset($_POST["user_password"]) && !empty($_POST["user_password"]) && isset($_POST["confirm_password"]) && !empty($_POST["confirm_password"])) {
    require_once './functions.php';
    $validate_code = validate_captcha_code($_POST, $_SESSION);
    $password_match = validate_match_password($_POST);
    if ($validate_code !== true)
        $errors[] = 'Validation code is empty or incorrect.';
    if ($password_match !== true)
        $errors[] = 'Password doesn\'t match with confirm password.';
    if ($errors != null && sizeof($errors) > 0) {
        $ispost = true;
    } else {
        $data = array();
        $data["email1"] = trim($_POST['e']);
        $data["password"] = md5(trim($_POST['user_password']));
        $data["unique_vendor_id"] = trim($_POST["v"]);
        $data["password_reset_link"] = trim($_POST["l"]);
        $data["method"] = "ValidateResetPassword";
        $curl = curl_init($crm_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        if ($response == "success") {
            $successes[] = "Your password is succesfully reset.";
        } else {
            $errors[] = $response;
        }
    }
}
//else {
//    $link_error[] = "Invalid Link. Or if you think its correct link, please contact Aministrator to resolve this issue.";
//}

require './header.php';
?>
<form method="post" action="#" id="password_reset_form" onsubmit="validate_reset_password(event);">
    <div class="ipt-eform-content ">
        <div data-settings="{&quot;can_previous&quot;:true,&quot;show_progress_bar&quot;:false,&quot;progress_bar_bottom&quot;:false,&quot;block_previous&quot;:false,&quot;any_tab&quot;:true,&quot;type&quot;:&quot;2&quot;,&quot;scroll&quot;:true,&quot;decimal_point&quot;:2,&quot;auto_progress&quot;:false,&quot;auto_progress_delay&quot;:&quot;1500&quot;,&quot;auto_submit&quot;:false,&quot;hidden_buttons&quot;:false,&quot;scroll_on_error&quot;:true}" class="ipt_fsqm_main_tab ipt_uif_tabs horizontal ui-tabs ui-widget ui-widget-content ui-corner-all">

            <div id="ipt_fsqm_form_56_tab_1" class="ipt_fsqm_form_tab_panel ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-2" role="tabpanel" style="" aria-hidden="true">
                <div id="ipt_fsqm_form_56_layout_1_inner" class="ipt-eform-layout-wrapper">
                    <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_blank_container" id="ipt_fsqm_form_56_design_8">
                        <div class="ipt_uif_column_inner">
                            <div class="ipt_uif_blank_container">
                                <?php
                                if (sizeof($errors) > 0)
                                    foreach ($errors as $error) {
                                        ?>
                                        <div class="alert alert-danger">
                                            <span><?php echo $error; ?></span>
                                        </div>
                                        <?php
                                    } else if (sizeof($successes) > 0)
                                    foreach ($successes as $sucss) {
                                        ?>
                                        <div class="alert alert-success">
                                            <span><?php echo $sucss; ?></span>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class="clear-both">
                            </div>
                        </div>
                        <div class="ipt_uif_blank_container">
                            <?php
                            if (sizeof($successes) > 0)
                                
                                ?>
                            <a href="login.php" title="Login to Unlimited Charters Vendor System" style="float: right;">LOGIN HERE</a>
                            <a href="https://unlimitedcharters.com" title="Unlimited Charters">Unlimited Charters</a>
                            <?php ?>
                        </div>
                    </div>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] != 'POST' && isset($_REQUEST["v"]) && !empty($_REQUEST["v"]) && isset($_REQUEST["l"]) && !empty($_REQUEST["l"])) {
                        ?>
                        <input type="hidden" name="v" value="<?php echo $_REQUEST["v"] ?>">
                        <input type="hidden" name="l" value="<?php echo $_REQUEST["l"] ?>">
                        <input type="hidden" name="e" value="<?php if ($_REQUEST["e"]) echo $_REQUEST["e"] ?>">
                        <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_password" id="ipt_fsqm_form_56_pinfo_6">
                            <div class="ipt_uif_column_inner side_margin">
                                <div class="ipt_uif_question ipt_uif_question_vertical">
                                    <div class="ipt_uif_question_label">
                                        <label class="ipt_uif_question_title ipt_uif_label" for="user_password">Password<span class="ipt_uif_question_required">*</span>
                                        </label>
                                        <div class="clear-both">
                                        </div>
                                    </div>
                                    <div class="ipt_uif_question_content">
                                        <div class="input-field has-icon ipt-eform-password">
                                            <input class="ipt_uif_text ipt_uif_password" name="user_password" id="user_password" value="" type="password" required>
                                            <i class=" ipt-icomoon-unlocked ipticm prefix"></i>
                                            <label for="user_password"></label>
                                            <div id="password_strength" style="line-height: 14px; font-size: 11px; text-align: left; padding-left: 5px;"></div>
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
                                        <label class="ipt_uif_question_title ipt_uif_label" for="confirm_password">Confirm Password<span class="ipt_uif_question_required">*</span>
                                        </label>
                                        <div class="clear-both">
                                        </div>
                                    </div>
                                    <div class="ipt_uif_question_content">
                                        <div class="input-field has-icon ipt-eform-password">
                                            <input class="ipt_uif_text ipt_uif_password" name="confirm_password" id="confirm_password" value="" type="password" required>
                                            <i class=" ipt-icomoon-loop2 ipticm prefix"></i>
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
                        <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_captcha" id="ipt_fsqm_form_56_pinfo_8">
                            <div class="ipt_uif_column_inner side_margin">
                                <div class="ipt_uif_question ipt_uif_question_vertical">
                                    <div class="ipt_uif_question_label">
                                        <label class="ipt_uif_question_title ipt_uif_label" for="captcha_code">Validation code:<span class="ipt_uif_question_required">*</span>
                                        </label>
                                        <div class="clear-both">
                                        </div>
                                    </div>
                                    <div class="ipt_uif_question_content">
                                        <div class="input-field has-icon ipt-eform-captcha" style="width: 50%; float: left;">
                                            <input id="captcha_code" name="captcha_code" type="text" placeholder="Enter the code displayed in image" autocomplete="off" required>
                                            <i class=" ipt-icomoon-spell-check ipticm prefix"></i>
                                            <label for="captcha_code">
                                            </label>
                                        </div>
                                        <div class="" style="width: 50%; float: left; padding: 0;">
                                            <img src="captcha.php?rand=<?php echo rand(); ?>" id='captchaimg'><br>
                                            Can't read the image? click <a href='javascript: refreshCaptcha();'>HERE</a> to refresh.
                                        </div>
                                        <div class="clear-both">
                                        </div>
                                    </div>
                                </div>
                                <div class="clear-both">
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="clear-both">
                </div>
            </div>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] != 'POST' && isset($_REQUEST["v"]) && !empty($_REQUEST["v"]) && isset($_REQUEST["l"]) && !empty($_REQUEST["l"])) {
            ?>
            <div class="eformbutton_container">
                <input type="submit" class="eformbutton eformbutton_blue" name="reset_pass_button" id="reset_pass_button" role="button" value="CREATE NEW PASSWORD">
                <div class="clear-both">
                </div>
                <span>
                    Already have an account? click 
                </span>
                <a href="login.php" title="CLICK HERE TO SIGN IN">SIGN IN</a>
                <div class="clear-both">
                </div>
                <br>
            </div>
            <?php
        }
        ?>
    </div>
</form>
<script>
    jQuery(document).ready(function ($) {
        check_pass();
        $('#user_password').bind('input keyup', function () {
            check_pass();
        });
        $('#confirm_password').bind('input keyup', function () {
            match_duplicate_pass();
        });
    });
</script>
<?php
require './footer.php';
?>