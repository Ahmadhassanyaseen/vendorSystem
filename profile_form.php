<style>
    .input-group {
        flex-wrap: nowrap !important;
    }

    #basic-addon1 {
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }

    #basic-addon1>svg {
        width: 20px !important;
        height: 20px !important;
    }

    .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
        outline: none !important;
        box-shadow: none !important;
    }

    #update_profile_button {
        padding: 10px 20px !important;
    }
</style>
<style>
    .ruler {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    .ruler span {
        position: relative;
    }

    .ruler span:nth-child(2),
    .ruler span:nth-child(3),
    .ruler span:nth-child(4),
    .ruler span:nth-child(5),
    .ruler span:nth-child(6) {
        left: 12px;
    }

    .ruler span:before {
        content: '';
        position: absolute;
        top: -8px;
        left: 50%;
        width: 1px;
        height: 8px;
        background-color: black;
    }

    .ruler span:last-child:before {
        display: none;
    }
</style>


<?php

                                                                // print_r($_SESSION);





                                                                $data['id'] = $_SESSION['VNDR']['id'];
                                                                $data["method"] = "fetchvendorEmail";
                                                                $curl = curl_init($crm_url);
                                                                curl_setopt($curl, CURLOPT_POST, true);
                                                                curl_setopt($curl, CURLOPT_HEADER, false);
                                                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                                                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                                                                $response = curl_exec($curl);
                                                                // echo $response;
                                                                $vendorEmail = json_decode($response, true);
                                                                // print_r($vendorEmail);
?>
<?php
                                                                                                                                $data["vndid"] = $_SESSION['VNDR']['id'];
                                                                                                                                $data["method"] = "vendor_cstm";

                                                                                                                                // print_r($data);
                                                                                                                                // print_r($_POST);
                                                                                                                                // print_r($data['username']);
                                                                                                                                $curl = curl_init($crm_url);

                                                                                                                                curl_setopt($curl, CURLOPT_POST, true);
                                                                                                                                curl_setopt($curl, CURLOPT_HEADER, false);
                                                                                                                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                                                                                                                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                                                                                                                                $response = curl_exec($curl);

                                                                                                                                // echo $response;
                                                                                                                                // echo 'xeno';
                                                                                                                                $vendor_cstm = json_decode($response, true);
                                                                                                                                // print_r($vendor_cstm);
?>
<div class="container me-auto mh-100 ms-auto mw-100 pe-5 ps-5 w-auto" aria-label="24/7 Dispatch #">

    <div>
        <h2 class="fw-bolder me-auto ms-auto mt-5 text-secondary text-start text-uppercase" data-pg-name="vehiclelist">Profile</h2>
        <h6 class="me-auto ms-auto mt-5 text-dark text-start text-uppercase complete" data-pg-name="vehiclelist">Complete your vendor profile by inputting the following business information.</h6>
    </div>
    <div class="border border-secondary d-flex h-100 me-auto mh-100 ms-auto mt-5 mw-100 row" data-bs-toggle="popover">
    </div>
    <form method="post" action="#" id="profile_form" style="margin-bottom: 40px;" onsubmit="return validate_profile(event);">
        <input type="hidden" name="vid" value="<?php if (isset($_SESSION['VNDR']['id'])) echo $_SESSION['VNDR']['id']; ?>">
        <input type="hidden" name="uvid" value="<?php if (isset($_SESSION['VNDR']['unique_vendor_id'])) echo $_SESSION['VNDR']['unique_vendor_id']; ?>">
        <div class="mt-4 row w-100">
            <label class="fst-italic fw-bold mb-4 text-primary text-uppercase">Business Details<br>
            </label>
            <div class="input-group input-group-lg mb-3"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="1em" height="1em">
                        <g>
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path d="M12 19h2V6l6.394 2.74a1 1 0 0 1 .606.92V19h2v2H1v-2h2V5.65a1 1 0 0 1 .594-.914l7.703-3.424A.5.5 0 0 1 12 1.77V19z"></path>
                        </g>
                    </svg></span>
                <input type="text" name="name" id="name" maxlength="" class="form-control" placeholder="Business Name" aria-label="Business Name" aria-describedby="basic-addon1" data-pg-name="Business Name" value="<?php
                                                                                                                                                                                                                        if (isset($_SESSION['VNDR']['status']) && $_SESSION['VNDR']['status'] == 'Complete_Profile')
                                                                                                                                                                                                                            echo '';
                                                                                                                                                                                                                        else if (isset($_SESSION['VNDR']['name']))
                                                                                                                                                                                                                            echo $_SESSION['VNDR']['name'];
                                                                                                                                                                                                                        else
                                                                                                                                                                                                                            echo '';
                                                                                                                                                                                                                        ?>">
            </div>
            <div class="input-group input-group-lg mb-3 w-50"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                        <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"></path>
                    </svg></span>
                <input type="text" class="form-control" name="website" id="website" maxlength="" placeholder="Website" aria-label="Website" aria-describedby="basic-addon1" data-pg-name="Website" value="<?php if (isset($_SESSION['VNDR']['website'])) echo $_SESSION['VNDR']['website']; ?>">
            </div>
            <div class="input-group input-group-lg mb-3 w-50"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="1em" height="1em">
                        <g>
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path d="M17 20H7v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-1H3v-8H2V8h1V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v3h1v4h-1v8h-1v1a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1v-1zM5 5v9h14V5H5zm0 11v2h4v-2H5zm10 0v2h4v-2h-4z"></path>
                        </g>
                    </svg></span>
                <input type="text" class="form-control" name="dot_number" id="dot_number" maxlength="" placeholder="DOT #" aria-label="DOT #" aria-describedby="basic-addon1" data-pg-name="DOT #" value="<?php if (isset($_SESSION['VNDR']['dot_number'])) echo $_SESSION['VNDR']['dot_number']; ?>">
            </div>
            <label class="fst-italic fw-bold mb-4 mt-2 text-primary text-uppercase">Contact Info<br>
            </label>
            <div class="input-group input-group-lg mb-3 w-50"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="1em" height="1em">
                        <g>
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path d="M2 5.5V3.993A1 1 0 0 1 2.992 3h18.016c.548 0 .992.445.992.993v16.014a1 1 0 0 1-.992.993H2.992A.993.993 0 0 1 2 20.007V19h18V7.3l-8 7.2-10-9zM0 10h5v2H0v-2zm0 5h8v2H0v-2z"></path>
                        </g>
                    </svg></span>
                <input type="email" disabled name="email1" id="email1" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" data-pg-name="Email" value="<?php if (isset($vendorEmail['vendor_email'])) echo $vendorEmail['vendor_email']; ?>">
            </div>
            <div class="input-group input-group-lg mb-3 w-50"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="1em" height="1em">
                        <g>
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path fill-rule="nonzero" d="M9.366 10.682a10.556 10.556 0 0 0 3.952 3.952l.884-1.238a1 1 0 0 1 1.294-.296 11.422 11.422 0 0 0 4.583 1.364 1 1 0 0 1 .921.997v4.462a1 1 0 0 1-.898.995c-.53.055-1.064.082-1.602.082C9.94 21 3 14.06 3 5.5c0-.538.027-1.072.082-1.602A1 1 0 0 1 4.077 3h4.462a1 1 0 0 1 .997.921A11.422 11.422 0 0 0 10.9 8.504a1 1 0 0 1-.296 1.294l-1.238.884zm-2.522-.657l1.9-1.357A13.41 13.41 0 0 1 7.647 5H5.01c-.006.166-.009.333-.009.5C5 12.956 11.044 19 18.5 19c.167 0 .334-.003.5-.01v-2.637a13.41 13.41 0 0 1-3.668-1.097l-1.357 1.9a12.442 12.442 0 0 1-1.588-.75l-.058-.033a12.556 12.556 0 0 1-4.702-4.702l-.033-.058a12.442 12.442 0 0 1-.75-1.588z"></path>
                        </g>
                    </svg></span>
                <input type="text" name="phone_office" id="phone_office" maxlength="" class="form-control" placeholder="Office Phone" aria-label="Office Phone" aria-describedby="basic-addon1" data-pg-name="Office Phone" value="<?php if (isset($_SESSION['VNDR']['phone_office'])) echo $_SESSION['VNDR']['phone_office']; ?>">
            </div>
            <div class="input-group input-group-lg mb-3 w-50"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="1em" height="1em">
                        <g>
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path d="M3 4.995C3 3.893 3.893 3 4.995 3h14.01C20.107 3 21 3.893 21 4.995v14.01A1.995 1.995 0 0 1 19.005 21H4.995A1.995 1.995 0 0 1 3 19.005V4.995zM5 5v14h14V5H5zm2.972 13.18a9.983 9.983 0 0 1-1.751-.978A6.994 6.994 0 0 1 12.102 14c2.4 0 4.517 1.207 5.778 3.047a9.995 9.995 0 0 1-1.724 1.025A4.993 4.993 0 0 0 12.102 16c-1.715 0-3.23.864-4.13 2.18zM12 13a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7zm0-2a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                        </g>
                    </svg></span>
                <input name="ownership" id="ownership" maxlength="" class="form-control" placeholder="Manager Contact" aria-label="Manager Contact" aria-describedby="basic-addon1" data-pg-name="Manager Contact" value="<?php if (isset($_SESSION['VNDR']['ownership'])) echo $_SESSION['VNDR']['ownership']; ?>">
            </div>
            <div class="input-group input-group-lg mb-3 w-50"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="1em" height="1em">
                        <g>
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path d="M21 8a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-1.062A8.001 8.001 0 0 1 12 23v-2a6 6 0 0 0 6-6V9A6 6 0 1 0 6 9v7H3a2 2 0 0 1-2-2v-4a2 2 0 0 1 2-2h1.062a8.001 8.001 0 0 1 15.876 0H21zM7.76 15.785l1.06-1.696A5.972 5.972 0 0 0 12 15a5.972 5.972 0 0 0 3.18-.911l1.06 1.696A7.963 7.963 0 0 1 12 17a7.963 7.963 0 0 1-4.24-1.215z"></path>
                        </g>
                    </svg></span>
                <input name="phone_alternate" id="phone_alternate" maxlength="" type="tel" class="form-control" placeholder="24/7 Dispatch #" aria-label="24/7 Dispatch #" aria-describedby="basic-addon1" data-pg-name="24/7 Dispatch #" value="<?php if (isset($_SESSION['VNDR']['phone_alternate'])) echo $_SESSION['VNDR']['phone_alternate']; ?>">
            </div>
            <label class="fst-italic fw-bold mb-4 mt-2 text-primary text-uppercase">Physical Address<br>
            </label>
            <div class="input-group input-group-lg mb-3"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="1em" height="1em">
                        <g>
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path fill-rule="nonzero" d="M12 13l6 9H6l6-9zm0 3.6L9.74 20h4.52L12 16.6zm-1.06-6.04a1.5 1.5 0 1 1 2.12-2.12 1.5 1.5 0 0 1-2.12 2.12zM5.281 2.783l1.415 1.415a7.5 7.5 0 0 0 0 10.606l-1.415 1.415a9.5 9.5 0 0 1 0-13.436zm13.436 0a9.5 9.5 0 0 1 0 13.436l-1.415-1.415a7.5 7.5 0 0 0 0-10.606l1.415-1.415zM8.11 5.611l1.414 1.414a3.5 3.5 0 0 0 0 4.95l-1.414 1.414a5.5 5.5 0 0 1 0-7.778zm7.778 0a5.5 5.5 0 0 1 0 7.778l-1.414-1.414a3.5 3.5 0 0 0 0-4.95l1.414-1.414z"></path>
                        </g>
                    </svg></span>
                <input class="ipt_uif_text" onFocus="geolocate()" name="billing_address_street" id="billing_address_street" maxlength="" type="text" value="<?php if (isset($_SESSION['VNDR']['billing_address_street'])) echo $_SESSION['VNDR']['billing_address_street']; ?>" placeholder="Street Address">
                <input type="hidden" id="address_lat" name="address_lat" value="">
                <input type="hidden" id="address_lng" name="address_lng" value="">

            </div>
            <div class="input-group input-group-lg mb-3 w-auto"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="1em" height="1em">
                        <g>
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path d="M21 21H3a1 1 0 0 1-1-1v-7.513a1 1 0 0 1 .343-.754L6 8.544V4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1zM9 19h3v-6.058L8 9.454l-4 3.488V19h3v-4h2v4zm5 0h6V5H8v2.127c.234 0 .469.082.657.247l5 4.359a1 1 0 0 1 .343.754V19zm2-8h2v2h-2v-2zm0 4h2v2h-2v-2zm0-8h2v2h-2V7zm-4 0h2v2h-2V7z"></path>
                        </g>
                    </svg></span>
                <input type="text" class="form-control" name="billing_address_city" id="billing_address_city" maxlength="" placeholder="City" aria-label="City" aria-describedby="basic-addon1" data-pg-name="City" value="<?php if (isset($_SESSION['VNDR']['billing_address_city'])) echo $_SESSION['VNDR']['billing_address_city']; ?>">
            </div>
            <div class="input-group input-group-lg mb-3 w-auto"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="1em" height="1em">
                        <g>
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path d="M5 16v6H3V3h9.382a1 1 0 0 1 .894.553L14 5h6a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1h-6.382a1 1 0 0 1-.894-.553L12 16H5zM5 5v9h8.236l1 2H19V7h-6.236l-1-2H5z"></path>
                        </g>
                    </svg></span>
                <input type="text" class="form-control" name="billing_address_state" id="billing_address_state" maxlength="" placeholder="State" aria-label="State" aria-describedby="basic-addon1" data-pg-name="State" value="<?php if (isset($_SESSION['VNDR']['billing_address_state'])) echo $_SESSION['VNDR']['billing_address_state']; ?>">
            </div>
            <div class="input-group input-group-lg mb-3 w-auto"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="1em" height="1em">
                        <g>
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path d="M9.745 21.745C5.308 20.722 2 16.747 2 12 2 6.477 6.477 2 12 2s10 4.477 10 10c0 4.747-3.308 8.722-7.745 9.745L12 24l-2.255-2.255zm-2.733-3.488a7.953 7.953 0 0 0 3.182 1.539l.56.129L12 21.172l1.247-1.247.56-.13a7.956 7.956 0 0 0 3.36-1.686A6.979 6.979 0 0 0 12.16 16c-2.036 0-3.87.87-5.148 2.257zM5.616 16.82A8.975 8.975 0 0 1 12.16 14a8.972 8.972 0 0 1 6.362 2.634 8 8 0 1 0-12.906.187zM12 13a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path>
                        </g>
                    </svg></span>
                <input type="text" class="form-control" name="billing_address_postalcode" id="billing_address_postalcode" placeholder="Zip" aria-label="Zip" aria-describedby="basic-addon1" data-pg-name="Zip" value="<?php if (isset($_SESSION['VNDR']['billing_address_postalcode'])) echo $_SESSION['VNDR']['billing_address_postalcode']; ?>">
            </div>
            <label class="fst-italic fw-normal mb-4 mt-2 text-secondary text-uppercase">
                <p><label for="pinfo_16" class="fw-bold text-primary">Is Your Company Interstate or Intrastate?*</label></p>
                <p><em class="text-dark">NOTE: Interstate companies may operate <strong>across</strong> <strong>state lines</strong>. Intrastate companies operate <strong>within one state only</strong>.</em></p>
            </label>
            <div class="float-start row w-auto d-flex">
                <!-- <div class="form-check me-auto ms-auto text-secondary w-25">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="formInput26" value="option1">
                <label class="form-check-label fs-5 fw-bold" for="ineterstate" data-pg-name="Interstate">Interstate</label>
            </div>
            <div class="form-check ms-auto text-secondary w-25">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="formInput26" value="option1">
                <label class="form-check-label fs-5 fw-bold" for="intastate" data-pg-name="Intrastate">Intrastate</label>
            </div> -->
                <div class="ipt_uif_label_column column_random w-auto ">
                    <input class="ipt_uif_radio with-gap" name="vendors_type" id="vendors_type_0" value="Interstate" type="radio" <?php if (isset($_SESSION['VNDR']['vnd_vendors_type']) && $_SESSION['VNDR']['vnd_vendors_type'] == 'Interstate') echo 'checked'; ?>>
                    <label class="eform-label-with-tabindex" tabindex="0" for="vendors_type_0" data-labelcon="&#xe18e;"> Interstate </label>
                </div>
                <div class="ipt_uif_label_column column_random w-auto">
                    <input class="ipt_uif_radio with-gap" name="vendors_type" id="vendors_type_1" value="Intrastate" type="radio" <?php if (isset($_SESSION['VNDR']['vnd_vendors_type']) && $_SESSION['VNDR']['vnd_vendors_type'] == 'Intrastate') echo 'checked'; ?>>
                    <label class="eform-label-with-tabindex" tabindex="0" for="vendors_type_1" data-labelcon="&#xe18e;"> Intrastate </label>
                </div>
            </div>
            <label class="fst-italic fw-normal mb-4 mt-5 text-primary text-uppercase">
                <p><label for="service_radius" class="fw-bold text-primary">Service Radius*</label></p>
                <p><em class="text-dark" style="background-color: rgba(var(--bs-white-rgb), var(--bs-bg-opacity)); font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);"></em></p>
                <p class="text-dark">Service Radius*
                    Starting at your garage, what is the maximum distance (in miles) your vehicles will travel for pickups?</p>
                <div class="form-group">
                    <!-- <input type="range" class="form-range" min="0" max="300" step="10" name="service_radius" id="service_radius" value="<?php
                                                                                                                                                // if (isset($_SESSION['VNDR']['service_radius']))
                                                                                                                                                //     echo number_format($_SESSION['VNDR']['service_radius'], 0);
                                                                                                                                                // else
                                                                                                                                                //     echo '0';
                                                                                                                                                ?>"> -->
                    <input type="range" class="form-range" min="0" max="300" step="50" name="service_radius" id="service_radius" value="<?php
                                                                                                                                        if (isset($_SESSION['VNDR']['service_radius']))
                                                                                                                                            echo number_format($_SESSION['VNDR']['service_radius'], 0);
                                                                                                                                        else
                                                                                                                                            echo '0';
                                                                                                                                        ?>">

                    <div class="ruler">
                        <?php for ($i = 0; $i <= 300; $i += 50) { ?>
                            <span><?php echo $i; ?></span>
                        <?php } ?>
                    </div>

                    <!-- <span id="service_radius_value">
                        <?php
                        // if (isset($_SESSION['VNDR']['service_radius']))
                        //     echo number_format($_SESSION['VNDR']['service_radius'], 0);
                        // else
                        //     echo '0';
                        ?>
                    </span>

                    <script>
                        var rangeInput = document.getElementById('service_radius');
                        var rangeValue = document.getElementById('service_radius_value');

                        rangeInput.addEventListener('input', function() {
                            rangeValue.textContent = this.value;
                        });
                    </script> -->

                </div>
                <p></p>
            </label>
            <label class="fst-italic fw-normal mb-4  text-primary text-uppercase">
                <p><label for="service_radius" class="fw-bold text-primary">Garage to Garage?</label></p>
                <p><em class="text-dark" style="background-color: rgba(var(--bs-white-rgb), var(--bs-bg-opacity)); font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);"></em></p>
                <p class="text-dark">Are you charging from the start time from when you leave your garage, back to your garage?</p>
                <div class="float-start row w-auto">
                    <div class="ipt_uif_label_column column_random w-auto ">
                        <input class="ipt_uif_radio with-gap" name="allowcharges" id="allowcharges_1" value="on" type="radio" <?php if (isset($_SESSION['VNDR']['allowcharges_c'])) {
                                                                                                                                    if ($_SESSION['VNDR']['allowcharges_c'] == 'on') {
                                                                                                                                        echo "checked";
                                                                                                                                    } else {
                                                                                                                                        echo '';
                                                                                                                                    }
                                                                                                                                } ?>>
                        <label class="eform-label-with-tabindex" tabindex="0" for="allowcharges_1" data-labelcon="&#xe18e;"> Yes </label>
                    </div>
                    <div class="ipt_uif_label_column column_random w-auto">
                        <input class="ipt_uif_radio with-gap" name="allowcharges" id="allowcharges_2" value="off" type="radio" <?php if (isset($_SESSION['VNDR']['allowcharges_c'])) {
                                                                                                                                    if ($_SESSION['VNDR']['allowcharges_c'] == 'off') {
                                                                                                                                        echo "checked";
                                                                                                                                    } else {
                                                                                                                                        echo '';
                                                                                                                                    }
                                                                                                                                } ?>>
                        <label class="eform-label-with-tabindex" tabindex="0" for="allowcharges_2" data-labelcon="&#xe18e;"> No </label>
                    </div>
                </div>
                <p></p>
            </label>
            <label class="fst-italic fw-normal mb-4  text-primary text-uppercase">
                <p><label for="service_radius" class="fw-bold text-primary">Allowed Quotes Per Lead</label></p>
                <p><em class="text-dark" style="background-color: rgba(var(--bs-white-rgb), var(--bs-bg-opacity)); font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);"></em></p>
                <p class="text-dark">You are allowed to send <?php echo $vendor_cstm['data']['quotecounter_c']; ?> quotes to each lead.</p>

                <p></p>
            </label>
            <!-- <input type="submit" name="update_profile_button" class="bg-primary border-black btn btn-light mt-5 shadow w-25"></input> -->
            <input type="submit" class="eformbutton eformbutton_blue bg-primary border-black btn btn-light mt-5 shadow w-25" name="update_profile_button" id="update_profile_button" role="button" value="Submit Profile Changes">
        </div>
    </form>
    <br>
    <br>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="css/jquery-ui-slider-pips.css">
<style>
    #slider {
        margin: 10px;
    }
</style>

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
            (document.getElementById('billing_address_street')), {
                types: ['geocode', 'establishment'],
                componentRestrictions: {
                    country: 'us'
                }
            });
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
            navigator.geolocation.getCurrentPosition(function(position) {
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
    jQuery(document).ready(function($) {
        var start_val = document.getElementById("service_radius").value;
        $("#slider").slider({
            min: 0,
            max: 300,
            step: 10,
            value: start_val,
            change: function(event, ui) {
                document.getElementById("service_radius").value = ui.value;
            },
        }).slider("pips", {
            rest: "label",
            step: 5
        }).slider("float", {});
    });
</script>