<?php
$page = 'dashboard';
require_once './config.php';
require_once './session.php';
require_once './header.php';
?>
<style>
    .li-item{
        padding: 8px;
        float: left;
    }
    .li-item:hover{
        background-color: #eee;
    }
    .title{
        width: 70%;
    }
    .remove{
        width: 25%;
    }
</style>
<form method="post" action="#" id="registration_form" onsubmit="return validate_registration(event);">
    <div class="ipt-eform-content ">
        <div data-settings="" class="ipt_fsqm_main_tab ipt_uif_tabs horizontal ui-tabs ui-widget ui-widget-content ui-corner-all">
            <?php require_once 'logout_link.php'; ?>
            <div id="ipt_fsqm_form_56_tab_1" class="ipt_fsqm_form_tab_panel ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-2" role="tabpanel" style="" aria-hidden="true">
                <div id="ipt_fsqm_form_56_layout_1_inner" class="ipt-eform-layout-wrapper">
                    <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_blank_container" id="ipt_fsqm_form_56_design_8">
                        <div class="ipt_uif_column_inner">
                            <div class="ipt_uif_blank_container">
                                <div class="alert alert-success">
                                    <span>WELCOME TO VENDOR DASHBOARD</span>
                                </div>
                            </div>
                            <a href="https://unlimitedcharters.com" title="Unlimited Charters" style="width: 25%; float: left; display: inline-block; text-align: center;">Unlimited Charters</a>
                            <a href="vehicle.php" title="Add Vehicle | Unlimited Charters Vendor System" style="width: 50%; margin: 0 auto; display: inline-block; text-align: center;">Add Vehicle</a>
                            <a href="profile.php" title="Update Profile | Unlimited Charters Vendor System" style="width: 25%; float: right; display: inline-block; text-align: center;">Update Profile</a>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </div>
                <div class="clear-both">
                </div>
            </div>
        </div>
        <div style="width: 100%; float: left; border: 1px solid #ddd; border-top: none; box-shadow: 2px 1px 1px 1px #ddd;">
            <ul style="list-style: none; padding: 6px;">
                <li class="li-item title" style="border-bottom: 1px solid #ddd;">
                    <strong>VEHICLE TITLE</strong>
                </li>
                <li class="li-item remove" style="border-bottom: 1px solid #ddd;">
                    <strong>ACTION</strong>
                </li>
                <?php
                if (isset($_SESSION['VNDR']['VEHICLES'])) {
                    foreach ($_SESSION['VNDR']['VEHICLES'] as $vindx => $vData) {
                        ?>
                        <li class="li-item title">
                            <a href="vehicle.php?vehicle=<?php echo $vData['id']; ?>" title="View/Edit <?php echo $vData['name']; ?>" style="margin: 0 auto; display: inline-block; text-align: center;"><?php echo $vData['name']; ?></a>
                        </li>
                        <li class="li-item remove">
                            <a href="delete.php?vehicle=<?php echo $vData['id']; ?>" title="Delete <?php echo $vData['name']; ?>" style="margin: 0 auto; display: inline-block; text-align: center; color: red;" onclick="return confirm('Are you sure you want to delete this Vehicle?')">DELETE</a>
                        </li>
                        <div style="clear:both;"></div>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</form>
<?php
require './footer.php';
?>