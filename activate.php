<?php

$page = 'activate';
require_once './config.php';
require_once './session.php';
if (isset($_REQUEST["v"]) && !empty($_REQUEST["v"]) && isset($_REQUEST["l"]) && !empty($_REQUEST["l"])) {
    $data = array();
    $data["unique_vendor_id"] = trim($_REQUEST["v"]);
    $data["password_reset_link"] = trim($_REQUEST["l"]);
    $data["method"] = "ProfileActivate";
    $curl = curl_init($crm_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($curl);
    if ($response == "success") {
        $status = 'success';
        $successes[] = "Your profile successfully Activated. Please click on link below to login!";
    } else {
        $status = 'error';
        $errors[] = $response;
    }
} else {
    $status = 'error';
    $errors[] = "Invalid Link. Or if you think its correct link, please contact Aministrator to resolve this issue.";
}

require './header.php';
?>
<form method="post" action="#" id="registration_form">
    <div class="ipt-eform-content ">
        <div data-settings="{&quot;can_previous&quot;:true,&quot;show_progress_bar&quot;:false,&quot;progress_bar_bottom&quot;:false,&quot;block_previous&quot;:false,&quot;any_tab&quot;:true,&quot;type&quot;:&quot;2&quot;,&quot;scroll&quot;:true,&quot;decimal_point&quot;:2,&quot;auto_progress&quot;:false,&quot;auto_progress_delay&quot;:&quot;1500&quot;,&quot;auto_submit&quot;:false,&quot;hidden_buttons&quot;:false,&quot;scroll_on_error&quot;:true}" class="ipt_fsqm_main_tab ipt_uif_tabs horizontal ui-tabs ui-widget ui-widget-content ui-corner-all">

            <div id="ipt_fsqm_form_56_tab_1" class="ipt_fsqm_form_tab_panel ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-2" role="tabpanel" style="" aria-hidden="true">
                <div id="ipt_fsqm_form_56_layout_1_inner" class="ipt-eform-layout-wrapper">
                    <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_blank_container" id="ipt_fsqm_form_56_design_8">
                        <?php if ($status == 'error') {
                            ?>
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
                                        }
                                    ?>
                                </div>
                                <a href="login.php" title="Login to Unlimited Charters Vendor System" style="float: right;">LOGIN HERE</a>
                                <a href="https://unlimitedcharters.com" title="Unlimited Charters">Unlimited Charters</a>
                                <div class="clear-both">
                                </div>
                            </div>
                            <?php
                        } else if ($status == 'success') {
                            ?>
                            <div class="ipt_uif_column_inner">
                                <div class="ipt_uif_blank_container">
                                    <?php
                                    if (sizeof($successes) > 0)
                                        foreach ($successes as $success) {
                                            ?>
                                            <div class="alert alert-success">
                                                <span><?php echo $success; ?></span>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <a href="https://unlimitedcharters.com" title="Unlimited Charters">Unlimited Charters</a>
                                <a href="login.php" title="Login to Unlimited Charters Vendor System" style="float: right;">LOGIN HERE</a>
                                <div class="clear-both">
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="clear-both">
                </div>
            </div>
        </div>
    </div>
</form>
<?php
require './footer.php';
?>