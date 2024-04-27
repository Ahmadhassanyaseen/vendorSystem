<?php
require './header.php';
?>
<?php ?>
<style>
    .submitted {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loginBtn {
        width: 20%;
        text-align: center;
        color: #fff !important;
    }

    .loginBtn:hover{
        text-decoration: none!important;
    }
</style>
<form method="post" class="submitted" action="" id="registration_form">
    <div class="ipt-eform-content ">
        <div data-settings="" class="ipt_fsqm_main_tab ipt_uif_tabs horizontal ui-tabs ui-widget ui-widget-content ui-corner-all">
            <div id="ipt_fsqm_form_56_tab_1" class="ipt_fsqm_form_tab_panel ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-2" role="tabpanel" style="" aria-hidden="true">
                <div id="ipt_fsqm_form_56_layout_1_inner" class="ipt-eform-layout-wrapper">
                    <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_main_heading_column">
                        <div class="ipt_uif_column_inner">
                            <h2 class="fw-bolder me-auto ms-auto mt-5 login-cl text-center text-uppercase ">
                                <span class="ipt_uif_divider_text">
                                    <span class="ipt_uif_divider_text_inner" style="margin: 0 auto;">
                                        THANK YOU!
                                    </span>
                                </span>
                            </h2>
                            <br>
                            <h4 class="text-center">We have successfully processed your request and sent you a verification email. Please open that email and click on verification link to activate your Profile.</h4>
                            <br>
                            <div class="d-flex align-items-center justify-content-center">

                                <a href="https://unlimitedcharters.com/vendor24" class="loginBtn">Login</a>
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
    </div>
</form>

<?php
require './footer.php';
