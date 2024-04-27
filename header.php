<?php ?>

<!DOCTYPE html>
<html class="js no-touch svg inlinesvg svgclippaths no-ie8compat content-loaded" style="" lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor System</title>
    <link rel="stylesheet" href="css/smoothness/jquery-ui.css">
    <link rel="stylesheet" id="ipt-icomoon-fonts-css" href="css/icomoon.css" type="text/css" media="all">
    <link rel="stylesheet" id="material-light-blue_0-css" href="css/light-blue.css" type="text/css" media="all">
    <link rel="stylesheet" id="material-light-blue_0-css" href="css/bootstrap.min.css" type="text/css" media="all" version="3.3.6">
    <link href="//db.onlinewebfonts.com/c/5c773d1586db24bd45dfd4af3a4542e7?family=Shentox+W04+Regular" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/jquery_core.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/core.js"></script>
    <script type="text/javascript" src="js/widget.js"></script>
    <script type="text/javascript" src="js/datepicker.js"></script>
    <script type="text/javascript" src="js/vendors_js.js"></script>
<style>
    .caret{
        display: none!important;
    }
</style>
    <?php
    if (isset($page) && $page == 'vehicle') {
    ?>
        <link rel="stylesheet" href="SmartWizard/dist/css/bootstrap.min.css" media="all" version="4.0">
        <link href="SmartWizard/dist/css/smart_wizard.css" rel="stylesheet" type="text/css" />
        <link href="SmartWizard/dist/css/smart_wizard_theme_arrows.css" rel="stylesheet" type="text/css" />
        <style>
            .ipt_uif_matrix_text {
                width: 80% !important;
            }

            .image-container img {
                width: 100%;
                height: 100%;
            }

            .image-container {
                width: 30%;
                height: 150px;
                line-height: 20px;
                margin: 7px;
                display: inline-block;
                position: relative;
                box-shadow: 0 4px 5px 0 rgba(0, 0, 0, 0.2), 0 3px 5px 0 rgba(0, 0, 0, 0.20);
            }

            .image-container .image-remove {
                position: absolute;
                bottom: 5px;
                right: 5px;
                background-color: #555;
                color: #FFF;
                cursor: pointer;
                border-radius: 3px;
                font-size: 12px;
                padding: 2px 7px;
            }

            .image-container .image-remove:hover {
                background-color: #b53030;
                text-decoration: underline;
            }

            .image-container .image-view {
                position: absolute;
                bottom: 5px;
                left: 5px;
                background-color: #555;
                color: #FFF;
                cursor: pointer;
                border-radius: 3px;
                font-size: 12px;
                padding: 2px 7px;
                text-decoration: none;
            }

            .image-container .image-view:hover {
                color: #FFF;
                background-color: #058e07;
                text-decoration: underline;
            }

            #special_rates_div {
                width: 100%;
            }

            #special_rates_div .ui-state-default,
            .ui-widget-content .ui-state-default,
            .ui-widget-header .ui-state-default,
            .ui-button,
            html .ui-button.ui-state-disabled:hover,
            html .ui-button.ui-state-disabled:active {
                border: 1px solid #c5c5c5;
                background: #f6f6f6;
                font-weight: normal;
                color: #454545;
            }

            #special_rates_div .ui-state-hover,
            .ui-widget-content .ui-state-hover,
            .ui-widget-header .ui-state-hover,
            .ui-state-focus,
            .ui-widget-content .ui-state-focus,
            .ui-widget-header .ui-state-focus,
            .ui-button:hover,
            .ui-button:focus {
                border: 1px solid #cccccc;
                background: #ededed;
                font-weight: normal;
                color: #2b2b2b;
            }

            select.form-control:not([size]):not([multiple]) {
                height: calc(2.25rem + 22px);
            }
        </style>
    <?php
    }
    ?>
    <!-- Wizard Css -->
    <link href="./SmartWizard/dist/css/smart_wizard.css" rel="stylesheet" type="text/css" />

    <!-- Optional SmartWizard theme -->
    <link href="./SmartWizard/dist/css/smart_wizard_theme_circles.css" rel="stylesheet" type="text/css" />
    <link href="./SmartWizard/dist/css/smart_wizard_theme_arrows.css" rel="stylesheet" type="text/css" />
    <link href="./SmartWizard/dist/css/smart_wizard_theme_dots.css" rel="stylesheet" type="text/css" />
    <!-- Smart end -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/blocks.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css//vehicle.css">
    <link rel="stylesheet" href="./system/tailwind_theme/tailwind.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>

<body>
    <div id="fsqm_form">
        <div id="eform-inner">
            <style type="text/css">
                #ipt_fsqm_form_wrap_56 .ipt-eform-content,
                #ipt_fsqm_form_wrap_56 .eform-ui-estimator {
                    max-width: 768px;
                }

                .eformbutton_container {
                    text-align: center;
                }

                .eformbutton {
                    background-color: #008CBA;
                    border: 2px solid #008CBA;
                    color: white;
                    padding: 16px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 18px;
                    margin: 4px 2px;
                    -webkit-transition-duration: 0.4s;
                    transition-duration: 0.4s;
                    cursor: pointer;
                }

                .eformbutton_blue:hover {
                    background-color: white;
                    border: 2px solid #008CBA;
                    color: black;
                }

                .eformbutton_blue {
                    background-color: #008CBA;
                    border: 2px solid #008CBA;
                    color: white;
                }

                #password_strength,
                #results {
                    width: 300px;
                    padding: 3px 0;
                    height: 20px;
                    color: #000;
                    font-size: 14px;
                    text-align: center;
                }

                #results {
                    margin: 30px 0 20px 0;
                }

                .default {
                    background-color: #CCC;
                }

                .weak {
                    background-color: #FF5353;
                }

                .strong {
                    background-color: #FAD054;
                }

                .stronger {
                    background-color: #93C9F4;
                }

                .strongest {
                    background-color: #B6FF6C;
                }

                span.value {
                    font-weight: bold;
                    float: right;
                }
            </style>
            <style>
                ::-webkit-input-placeholder {
                    /* WebKit, Blink, Edge */
                    color: #a0a0a0;
                }

                :-moz-placeholder {
                    /* Mozilla Firefox 4 to 18 */
                    color: #a0a0a0;
                    opacity: 1;
                }

                ::-moz-placeholder {
                    /* Mozilla Firefox 19+ */
                    color: #a0a0a0;
                    opacity: 1;
                }

                :-ms-input-placeholder {
                    /* Internet Explorer 10-11 */
                    color: #a0a0a0;
                }

                ::-ms-input-placeholder {
                    /* Microsoft Edge */
                    color: #a0a0a0;
                }

                ::placeholder {
                    /* Most modern browsers support this now. */
                    color: #a0a0a0;
                }
            </style>
            <div id="ipt_fsqm_form_wrap_56" class="ipt_uif_front ipt_uif_common ipt_fsqm_form type_2 ui-front eform-ltr eform-override-element-boxy eform-override-alignment-inherit ipt-uif-custom-material-light-blue" data-fsqmsayt="{&quot;auto_save&quot;:false,&quot;show_restore&quot;:true,&quot;restore&quot;:false,&quot;admin_override&quot;:false,&quot;user_update&quot;:false,&quot;interval_save&quot;:false,&quot;interval&quot;:&quot;30&quot;}" data-ui-type="2" data-ui-theme="[&quot;css\/light-blue.css&quot;]" data-ui-theme-id="material-light-blue" data-eformanim="1" data-fsqmga="{&quot;enabled&quot;:false,&quot;manual_load&quot;:false,&quot;tracking_id&quot;:&quot;&quot;,&quot;cookie&quot;:&quot;auto&quot;,&quot;user_update&quot;:false,&quot;name&quot;:&quot;Sign In Form&quot;,&quot;form_id&quot;:56}" data-fsqmreset="{&quot;reset&quot;:false,&quot;delay&quot;:10}" data-eformreg="{&quot;enabled&quot;:false,&quot;username_id&quot;:&quot;&quot;,&quot;password_id&quot;:&quot;&quot;,&quot;hide_pinfo&quot;:false,&quot;hide_meta&quot;:false,&quot;meta&quot;:[]}" data-eformscroll="{&quot;progress&quot;:true,&quot;message&quot;:true,&quot;offset&quot;:&quot;0&quot;}" data-eform-cookie="0" data-subscription-form="false">
                <noscript>
                    <div class="ipt_fsqm_form_message_noscript ui-widget ui-widget-content ui-corner-all">
                        <div class="ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
                            <h3>Javascript is disabled</h3>
                        </div>
                        <div class="ui-widget-content ui-corner-bottom">
                            <p>Javascript is disabled on your browser. Please enable it in order to use this form.</p>
                        </div>
                    </div>
                </noscript>
                <div class="ipt_uif_init_loader ipt-eform-preloader-inline ipt_uif_ajax_loader" style="display: none;">
                    <div class="ipt-eform-preloader-inner">
                        <div class="ipt-eform-preloader-circle">
                            <div class="preloader-wrapper active">
                                <div class="spinner-layer spinner-blue">
                                    <div class="circle-clipper left">
                                        <div class="circle">
                                        </div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle">
                                        </div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle">
                                        </div>
                                    </div>
                                </div>
                                <div class="spinner-layer spinner-red">
                                    <div class="circle-clipper left">
                                        <div class="circle">
                                        </div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle">
                                        </div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle">
                                        </div>
                                    </div>
                                </div>
                                <div class="spinner-layer spinner-yellow">
                                    <div class="circle-clipper left">
                                        <div class="circle">
                                        </div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle">
                                        </div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle">
                                        </div>
                                    </div>
                                </div>
                                <div class="spinner-layer spinner-green">
                                    <div class="circle-clipper left">
                                        <div class="circle">
                                        </div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle">
                                        </div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ipt-eform-preloader-text">
                            <div class="ipt-eform-preloader-text-inner ipt_uif_ajax_loader_text">Loading</div>
                        </div>
                        <div class="clear">
                        </div>
                    </div>
                </div>


                <!-- <div class="ipt_fsqm_form_logo">
                        <a href="index.php">
                            <img src="images/Logo-Image2.png" alt="Unlimited Charters Vendor System">
                        </a>
                    </div> -->