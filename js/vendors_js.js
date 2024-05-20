function refreshCaptcha() {
  var img = document.images["captchaimg"];
  img.src =
    img.src.substring(0, img.src.lastIndexOf("?")) +
    "?rand=" +
    Math.random() * 1000;
}
function validate_registration(e) {
  document.getElementById("sign_up_button").disabled = false;
  var email = document.getElementById("user_email").value;
  var has_errors = false;
  if (email != null && email != "undefined") {
    if (validateEmail(email)) {
    } else {
      alert("Please enter a valid email address to continue!");
      document.getElementById("user_email").focus();
      document.getElementById("sign_up_button").removeAttribute("disabled");
      has_errors = true;
    }
  } else if (has_errors == false) {
    alert("Please enter a valid email address to continue!");
    document.getElementById("user_email").focus();
    document.getElementById("sign_up_button").removeAttribute("disabled");
    has_errors = true;
  }
  var duplicate_vendor = document.getElementById("duplicate_vendor").value;
  if (duplicate_vendor == "YES") {
    alert("Email already exists, Please try to login instead!");
    document.getElementById("user_email").focus();
    has_errors = true;
  }
  var password = document.getElementById("user_password").value;
  if (password != null && password != "undefined") {
  } else if (has_errors == false) {
    alert("Please enter a valid password to continue!");
    document.getElementById("user_password").focus();
    document.getElementById("sign_up_button").removeAttribute("disabled");
    has_errors = true;
  }
  var confirm_password = document.getElementById("confirm_password").value;
  if (confirm_password != null && confirm_password != "undefined") {
    if (confirm_password !== password && has_errors == false) {
      alert("Password doesn't match with confirm password!");
      document.getElementById("confirm_password").focus();
      document.getElementById("sign_up_button").removeAttribute("disabled");
      has_errors = true;
    }
  } else if (has_errors == false) {
    alert("Please enter confirm password to continue!");
    document.getElementById("confirm_password").focus();
    document.getElementById("sign_up_button").removeAttribute("disabled");
    has_errors = true;
  }
  // var captcha_code = document.getElementById("captcha_code").value;
  // if (captcha_code != null && captcha_code != 'undefined') {
  //     jQuery.ajax({
  //         url: "validate_captcha.php",
  //         type: "POST",
  //         async: false,
  //         data: {captcha_code: captcha_code},
  //         success: function (result) {
  //             if (result == 'failed' && has_errors == false) {
  //                 alert("Please enter correct validation code displayed in image!");
  //                 document.getElementById("captcha_code").focus();
  //                 document.getElementById("sign_up_button").removeAttribute('disabled');
  //                 has_errors = true;
  //             } else if (result == 'empty' && has_errors == false) {
  //                 alert("Please enter validation code displayed in image!");
  //                 document.getElementById("captcha_code").focus();
  //                 document.getElementById("sign_up_button").removeAttribute('disabled');
  //                 has_errors = true;
  //             } else if (result == 'passed') {

  //             }
  //         }
  //     });
  // } else if (has_errors == false) {
  //     alert("Please enter validation code displayed in image!");
  //     document.getElementById("captcha_code").focus();
  //     document.getElementById("sign_up_button").removeAttribute('disabled');
  //     has_errors = true;
  // }

  if (document.getElementById("terms").checked != true && has_errors == false) {
    alert("You have to agree on terms and conditions");
    document.getElementById("terms").focus();
    document.getElementById("sign_up_button").removeAttribute("disabled");
    has_errors = true;
  }
  if (has_errors == true) {
    e.preventDefault();
  } else {
    return true;
  }
}
function validateEmail(email) {
  var re =
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
function check_pass() {
  var entered_password = document.getElementById("user_password").value;
  var meter = document.getElementById("password_strength");
  var no = 0;
  if (entered_password != "") {
    if (entered_password.length < 6) no = 1;
    if (
      entered_password.length >= 6 &&
      (entered_password.match(/[a-z]/) ||
        entered_password.match(/\d+/) ||
        entered_password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))
    )
      no = 2;
    if (
      entered_password.length > 6 &&
      ((entered_password.match(/[a-z]/) && entered_password.match(/\d+/)) ||
        (entered_password.match(/\d+/) &&
          entered_password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) ||
        (entered_password.match(/[a-z]/) &&
          entered_password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))
    )
      no = 3;
    if (
      entered_password.length > 6 &&
      entered_password.match(/[a-z]/) &&
      entered_password.match(/\d+/) &&
      entered_password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)
    )
      no = 4;
    if (no == 1) {
      jQuery("#password_strength").animate({ width: "100px" }, 400);
      meter.style.backgroundColor = "red";
      meter.style.color = "#fff";
      meter.innerHTML = "Very Weak";
    }
    if (no == 2) {
      jQuery("#password_strength").animate({ width: "100px" }, 400);
      meter.style.backgroundColor = "#F5BCA9";
      meter.style.color = "#000";
      meter.innerHTML = "Weak";
    }
    if (no == 3) {
      jQuery("#password_strength").animate({ width: "100px" }, 400);
      meter.style.backgroundColor = "#FF8000";
      meter.style.color = "#000";
      meter.innerHTML = "Good";
    }
    if (no == 4) {
      jQuery("#password_strength").animate({ width: "100px" }, 400);
      meter.style.backgroundColor = "#00FF40";
      meter.style.color = "#000";
      meter.innerHTML = "Strong";
    }
  } else {
    jQuery("#password_strength").animate({ width: "100%" }, "100%");
    meter.style.backgroundColor = "#fff";
    meter.style.color = "#00b0ff";
    meter.innerHTML =
      "Use minimum 6 characters. Besides letters, atleast a number or symbol. Passord is case sensitive.";
  }
  match_duplicate_pass();
}
function match_duplicate_pass() {
  var entered_password = document.getElementById("user_password").value;
  var confirm_password = document.getElementById("confirm_password").value;
  var meter = document.getElementById("match_duplicate");
  if (
    entered_password == confirm_password &&
    confirm_password != "" &&
    confirm_password != null &&
    confirm_password != "undefined"
  ) {
    meter.style.backgroundColor = "#FFFFFF";
    meter.style.color = "#FFFFFF";
    meter.innerHTML = "";
  } else if (
    confirm_password != "" &&
    confirm_password != null &&
    confirm_password != "undefined"
  ) {
    jQuery("#match_duplicate").animate({ width: "150px" }, 400);
    meter.style.backgroundColor = "red";
    meter.style.color = "#FFFFFF";
    meter.innerHTML = "Password doesn't match";
  }
}
function check_duplicate_user() {
  var user_email = document.getElementById("user_email").value;
  if (user_email != null && user_email != "undefined") {
    jQuery.ajax({
      url: "duplicate_check.php",
      type: "POST",
      async: false,
      data: { user_email: user_email },
      success: function (result) {
        if (result == "exists") {
          alert("Email already exists, Please try to login instead.");
          document.getElementById("user_duplicate_check").innerHTML =
            "Email already exists, Please try to login instead.";
          document.getElementById("duplicate_vendor").value = "YES";
          document.getElementById("user_duplicate_check").style.display =
            "block";
          has_errors = true;
        } else {
          document.getElementById("duplicate_vendor").value = "NO";
          document.getElementById("user_duplicate_check").style.display =
            "none";
        }
      },
    });
  }
}
function validate_reset_password(e) {
  document.getElementById("reset_pass_button").disabled = false;
  var has_errors = false;
  var password = document.getElementById("user_password").value;
  if (password != null && password != "undefined") {
  } else if (has_errors == false) {
    alert("Please enter a valid password to continue!");
    document.getElementById("user_password").focus();
    document.getElementById("reset_pass_button").removeAttribute("disabled");
    has_errors = true;
  }
  var confirm_password = document.getElementById("confirm_password").value;
  if (confirm_password != null && confirm_password != "undefined") {
    if (confirm_password !== password && has_errors == false) {
      alert("Password doesn't match with confirm password!");
      document.getElementById("confirm_password").focus();
      document.getElementById("reset_pass_button").removeAttribute("disabled");
      has_errors = true;
    }
  } else if (has_errors == false) {
    alert("Please enter confirm password to continue!");
    document.getElementById("confirm_password").focus();
    document.getElementById("reset_pass_button").removeAttribute("disabled");
    has_errors = true;
  }
  var captcha_code = document.getElementById("captcha_code").value;
  if (captcha_code != null && captcha_code != "undefined") {
    jQuery.ajax({
      url: "validate_captcha.php",
      type: "POST",
      async: false,
      data: { captcha_code: captcha_code },
      success: function (result) {
        if (result == "failed" && has_errors == false) {
          alert("Please enter correct validation code displayed in image!");
          document.getElementById("captcha_code").focus();
          document
            .getElementById("reset_pass_button")
            .removeAttribute("disabled");
          has_errors = true;
        } else if (result == "empty" && has_errors == false) {
          alert("Please enter validation code displayed in image!");
          document.getElementById("captcha_code").focus();
          document
            .getElementById("reset_pass_button")
            .removeAttribute("disabled");
          has_errors = true;
        } else if (result == "passed") {
        }
      },
    });
  } else if (has_errors == false) {
    alert("Please enter validation code displayed in image!");
    document.getElementById("captcha_code").focus();
    document.getElementById("reset_pass_button").removeAttribute("disabled");
    has_errors = true;
  }
  if (has_errors == true) {
    e.preventDefault();
  } else {
    return true;
  }
}
function validate_reset_form(e) {
  document.getElementById("reset_button").disabled = false;
  var has_errors = false;
  var email = document.getElementById("user_email").value;
  if (email != null && email != "undefined") {
    if (validateEmail(email)) {
    } else {
      alert("Please enter a valid email address to continue!");
      document.getElementById("user_email").focus();
      document.getElementById("sign_up_button").removeAttribute("disabled");
      has_errors = true;
    }
  } else if (has_errors == false) {
    alert("Please enter a valid email address to continue!");
    document.getElementById("user_email").focus();
    document.getElementById("sign_up_button").removeAttribute("disabled");
    has_errors = true;
  }
  var captcha_code = document.getElementById("captcha_code").value;
  if (captcha_code != null && captcha_code != "undefined") {
    jQuery.ajax({
      url: "validate_captcha.php",
      type: "POST",
      async: false,
      data: { captcha_code: captcha_code },
      success: function (result) {
        if (result == "failed" && has_errors == false) {
          alert("Please enter correct validation code displayed in image!");
          document.getElementById("captcha_code").focus();
          document
            .getElementById("reset_pass_button")
            .removeAttribute("disabled");
          has_errors = true;
        } else if (result == "empty" && has_errors == false) {
          alert("Please enter validation code displayed in image!");
          document.getElementById("captcha_code").focus();
          document
            .getElementById("reset_pass_button")
            .removeAttribute("disabled");
          has_errors = true;
        } else if (result == "passed") {
        }
      },
    });
  } else if (has_errors == false) {
    alert("Please enter validation code displayed in image!");
    document.getElementById("captcha_code").focus();
    document.getElementById("reset_pass_button").removeAttribute("disabled");
    has_errors = true;
  }
  if (has_errors == true) {
    e.preventDefault();
  } else {
    return true;
  }
}
function validate_profile(e) {
  document.getElementById("update_profile_button").disabled = false;
  var name = document.getElementById("name").value.trim();
  var has_errors = false;
  if (name != "" && name != null && name != "undefined") {
  } else if (has_errors == false) {
    alert("Please enter a valid business name to continue!");
    document.getElementById("name").focus();
    document
      .getElementById("update_profile_button")
      .removeAttribute("disabled");
    has_errors = true;
  }
  var email = document.getElementById("email1").value;
  if (email != "" && email != null && email != "undefined") {
    if (validateEmail(email)) {
    } else {
      alert("Please enter a valid email address to continue!");
      document.getElementById("email1").focus();
      document
        .getElementById("update_profile_button")
        .removeAttribute("disabled");
      has_errors = true;
    }
  } else if (has_errors == false) {
    alert("Please enter a valid email address to continue!");
    document.getElementById("email1").focus();
    document
      .getElementById("update_profile_button")
      .removeAttribute("disabled");
    has_errors = true;
  }
  var phone_office = document.getElementById("phone_office").value;
  if (
    phone_office != "" &&
    phone_office != null &&
    phone_office != "undefined"
  ) {
  } else if (has_errors == false) {
    alert("Please enter a valid office phone to continue!");
    document.getElementById("phone_office").focus();
    document
      .getElementById("update_profile_button")
      .removeAttribute("disabled");
    has_errors = true;
  }
  var billing_address_street = document.getElementById(
    "billing_address_street"
  ).value;
  if (
    billing_address_street != "" &&
    billing_address_street != null &&
    billing_address_street != "undefined"
  ) {
  } else if (has_errors == false) {
    alert("Please enter street address to continue!");
    document.getElementById("billing_address_street").focus();
    document
      .getElementById("update_profile_button")
      .removeAttribute("disabled");
    has_errors = true;
  }
  var billing_address_city = document.getElementById(
    "billing_address_city"
  ).value;
  if (
    billing_address_city != "" &&
    billing_address_city != null &&
    billing_address_city != "undefined"
  ) {
  } else if (has_errors == false) {
    alert("Please enter address city to continue!");
    document.getElementById("billing_address_city").focus();
    document
      .getElementById("update_profile_button")
      .removeAttribute("disabled");
    has_errors = true;
  }
  var billing_address_state = document.getElementById(
    "billing_address_state"
  ).value;
  if (
    billing_address_state != "" &&
    billing_address_state != null &&
    billing_address_state != "undefined"
  ) {
  } else if (has_errors == false) {
    alert("Please enter address state to continue!");
    document.getElementById("billing_address_state").focus();
    document
      .getElementById("update_profile_button")
      .removeAttribute("disabled");
    has_errors = true;
  }
  var billing_address_postalcode = document.getElementById(
    "billing_address_postalcode"
  ).value;
  if (
    billing_address_postalcode != "" &&
    billing_address_postalcode != null &&
    billing_address_postalcode != "undefined"
  ) {
  } else if (has_errors == false) {
    alert("Please enter address postalcode to continue!");
    document.getElementById("billing_address_postalcode").focus();
    document
      .getElementById("update_profile_button")
      .removeAttribute("disabled");
    has_errors = true;
  }

  if (
    document.getElementById("vendors_type_0").checked ||
    document.getElementById("vendors_type_1").checked
  ) {
  } else if (has_errors == false) {
    alert("Please select between Interstate or Intrastate to continue!");
    document
      .getElementById("update_profile_button")
      .removeAttribute("disabled");
    has_errors = true;
  }
  var service_radius = document.getElementById("service_radius").value;
  if (
    service_radius != "" &&
    service_radius != null &&
    service_radius != 0 &&
    service_radius != "undefined"
  ) {
  } else if (has_errors == false) {
    alert("Please set service area radius to continue!");
    document.getElementById("service_radius").focus();
    document
      .getElementById("update_profile_button")
      .removeAttribute("disabled");
    has_errors = true;
  }

  if (has_errors == true) {
    e.preventDefault();
  } else {
    return true;
  }
}
function add_more_special_rates(e) {
  e.preventDefault();
  var numItems = jQuery(".special_rates_div").length;
  var default_html =
    '<h3 id="special_rates_heading_' +
    numItems +
    '">NEW RATE</h3><div><div id="special_rates_' +
    numItems +
    '" class="special_rates_div" style="display: inline-block;">' +
    '                       <input type="hidden" name="special_rate[]" id="special_rate_id_' +
    numItems +
    '" value="' +
    numItems +
    '" >' +
    '                       <input type="hidden" name="special_rate_deleted[]" id="special_rate_deleted_' +
    numItems +
    '" value="' +
    numItems +
    '" >' +
    '                       <input type="hidden" name="special_rate_deleted_id[]" id="special_rate_deleted_id_' +
    numItems +
    '" value="' +
    numItems +
    '" >' +
    '                        <div class="ipt_uif_column ipt_uif_column_three_forth ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_16_' +
    numItems +
    '">' +
    '                            <div class="ipt_uif_column_inner side_margin">' +
    '                                <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">' +
    '                                    <div class="ipt_uif_question_label">' +
    '                                        <label class="ipt_uif_question_title ipt_uif_label" style="width: 60%; float: left;" for="name_special_rate_' +
    numItems +
    '">Title (Ex: Prom Rates)</label>' +
    '                                        <button onclick="remove_special_rates(event,' +
    numItems +
    ');" style="color: red; float: right; width: 30%;" title="Remove this Special Rate">Remove Special Rate</button>' +
    '                                        <div class="clear-both"></div>' +
    "                                    </div>" +
    '                                    <div class="ipt_uif_question_content">' +
    '                                        <div class="input-field has-icon"> ' +
    '<select name="name_special_rate[]" id="name_special_rate_' +
    numItems +
    '" class="form-control" required>                                                            <option value="" selected=""></option><option value="Airport">Airport</option><option value="Bachelor Party">Bachelor Party</option><option value="Bachelorette Party">Bachelorette Party</option><option value="Birthday">Birthday</option><option value="Casino">Casino</option><option value="Church Function">Church Function</option><option value="Concert">Concert</option><option value="Convention">Convention</option><option value="Corporate Event">Corporate Event</option><option value="Cruise Transfers">Cruise Transfers</option><option value="Family Reunion">Family Reunion</option><option value="General Day Trip">General Day Trip</option><option value="Golf Outing">Golf Outing</option><option value="Homecoming">Homecoming</option><option value="Night out on Town">Night out on Town</option><option value="Over the Road">Over the Road</option><option value="Prom">Prom</option><option value="School Trip">School Trip</option><option value="Shuttle Service">Shuttle Service</option><option value="Sports Event">Sports Event</option><option value="Theme Park">Theme Park</option><option value="Transfer">Transfer</option><option value="Wedding">Wedding</option><option value="Wine Tour">Wine Tour</option>                                                        </select>' +
    "                                        </div>" +
    '                                        <div class="clear-both"></div>' +
    "                                    </div>" +
    "                                </div>" +
    '                                <div class="clear-both"></div>' +
    "                            </div>" +
    "                        </div>" +
    '                        <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_datetime" id="ipt_fsqm_form_52_pinfo_3_' +
    numItems +
    '">' +
    '                            <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_datetime" id="ipt_fsqm_form_52_pinfo_3_' +
    numItems +
    '">' +
    '                                <div class="ipt_uif_column_inner side_margin">' +
    '                                    <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">' +
    '                                        <div class="ipt_uif_question_label">' +
    '                                            <label class="ipt_uif_question_title ipt_uif_label" for="special_rate_start_from_' +
    numItems +
    '">Start Date</label>' +
    '                                            <div class="clear-both"></div>' +
    "                                        </div>" +
    '                                        <div class="ipt_uif_question_content">' +
    '                                            <div class="input-field eform-dp-input-field has-icon">' +
    '                                                <input class="ipt_uif_text datepicker1" name="special_rate_start_from[]" id="special_rate_start_from_' +
    numItems +
    '" type="date" value="" title="Select Start Date of Special Rate" required> ' +
    '                                                <i title="" class="ipt-icomoon-calendar ipticm prefix"></i> ' +
    "                                            </div>" +
    '                                            <div class="clear-both"></div>' +
    "                                        </div>" +
    "                                    </div>" +
    '                                    <div class="clear-both"></div>' +
    "                                </div>" +
    "                            </div>" +
    '                            <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_datetime" id="ipt_fsqm_form_52_pinfo_4_' +
    numItems +
    '">' +
    '                                <div class="ipt_uif_column_inner side_margin">' +
    '                                    <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">' +
    '                                        <div class="ipt_uif_question_label">' +
    '                                            <label class="ipt_uif_question_title ipt_uif_label" for="special_rate_end_on_' +
    numItems +
    '">End Date</label>' +
    '                                            <div class="clear-both"></div>' +
    "                                        </div>" +
    '                                        <div class="ipt_uif_question_content">' +
    '                                            <div class="input-field eform-dp-input-field has-icon">' +
    '                                                <input class="ipt_uif_text datepicker2" name="special_rate_end_on[]" id="special_rate_end_on_' +
    numItems +
    '" type="date" value="" title="Select End Date of Special Rate" required> ' +
    '                                                <i title="" class="ipt-icomoon-calendar ipticm prefix"></i>' +
    "                                            </div>" +
    '                                            <div class="clear-both"></div>' +
    "                                        </div>" +
    "                                    </div>" +
    '                                    <div class="clear-both"></div>' +
    "                                </div>" +
    "                            </div>" +
    "                        </div>" +
    '                        <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_10_' +
    numItems +
    '">' +
    '                            <div class="ipt_uif_column_inner side_margin">' +
    '                                <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">' +
    '                                    <div class="ipt_uif_question_label">' +
    '                                        <label class="ipt_uif_question_title ipt_uif_label" for="special_base_hourly_rate_' +
    numItems +
    '">Special Hourly Rate</label>' +
    '                                        <div class="clear-both"></div>' +
    "                                    </div>" +
    '                                    <div class="ipt_uif_question_content">' +
    '                                        <div class="input-field has-icon">' +
    '                                            <input class="ipt_uif_text vndr_currency" onkeyup="return update_special_rates(event,' +
    numItems +
    ',\'hourly\');" name="special_base_hourly_rate[]" id="special_base_hourly_rate_' +
    numItems +
    '" type="number" value="" title="Enter Special Hourly Rate" placeholder="Enter Hourly Rate" required>' +
    '                                            <i title="" class="ipticm prefix" data-ipt-icomoon="&#xf155;"></i>' +
    "                                        </div>" +
    '                                        <div class="clear-both"></div>' +
    "                                    </div>" +
    "                                </div>" +
    '                                <div class="clear-both"></div>' +
    "                            </div>" +
    "                        </div>" +
    '                        <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_11_' +
    numItems +
    '">' +
    '                            <div class="ipt_uif_column_inner side_margin">' +
    '                                <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">' +
    '                                    <div class="ipt_uif_question_label">' +
    '                                        <label class="ipt_uif_question_title ipt_uif_label" for="special_base_min_hours_' +
    numItems +
    '">Minimum Hours</label>' +
    '                                        <div class="clear-both"></div>' +
    "                                    </div>" +
    '                                    <div class="ipt_uif_question_content">' +
    '                                        <div class="input-field has-icon">' +
    '                                            <input class="ipt_uif_text" onkeyup="return update_special_rates(event,' +
    numItems +
    ',\'minhours\');" name="special_base_min_hours[]" id="special_base_min_hours_' +
    numItems +
    '" type="number" value="" title="Enter Minimum Hours" placeholder="Enter Minimum Hours" required>' +
    '                                            <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe082;"></i>' +
    "                                        </div>" +
    '                                        <div class="clear-both"></div>' +
    "                                    </div>" +
    "                                </div>" +
    '                                <div class="clear-both"></div>' +
    "                            </div>" +
    "                        </div>" +
    '                        <div class="ipt_uif_column ipt_uif_column_third ipt_uif_conditional ipt_fsqm_container_feedback_small" id="ipt_fsqm_form_52_freetype_12_' +
    numItems +
    '">' +
    '                            <div class="ipt_uif_column_inner side_margin">' +
    '                                <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">' +
    '                                    <div class="ipt_uif_question_label">' +
    '                                        <label class="ipt_uif_question_title ipt_uif_label" for="special_additional_hourly_' +
    numItems +
    '">Additional Hourly Rate</label>' +
    '                                        <div class="clear-both"></div>' +
    "                                    </div>" +
    '                                    <div class="ipt_uif_question_content">' +
    '                                        <div class="input-field has-icon">' +
    '                                            <input class="ipt_uif_text vndr_currency" onkeyup="return update_special_rates(event,' +
    numItems +
    ',\'additional\');" name="special_base_additional_hourly[]" id="special_additional_hourly_' +
    numItems +
    '" type="number" value="" title="Additional Hourly Rate (Optional)" placeholder="Enter Rate (Optional)" required>' +
    '                                            <i title="" class="ipticm prefix" data-ipt-icomoon="&#xf155;"></i>' +
    "                                        </div>" +
    '                                        <div class="clear-both"></div>' +
    "                                    </div>" +
    "                                </div>" +
    '                                <div class="clear-both"></div>' +
    "                            </div>" +
    "                        </div>" +
    '                        <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_toggle" id="ipt_fsqm_form_52_mcq_17_' +
    numItems +
    '" style="">' +
    '                            <div class="ipt_uif_column_inner side_margin">' +
    '                                <div class="ipt_uif_question ipt_uif_question_vertical">' +
    '                                    <div class="ipt_uif_question_label"> <label class="ipt_uif_question_title ipt_uif_label" for="custom_special_rates_' +
    numItems +
    '">Set Custom Daily Rates (Optional)</label>' +
    '                                        <div class="clear-both"></div>' +
    '                                        <div class="ipt_uif_richtext">' +
    "                                            <p>" +
    "                                                <em>Use this feature&nbsp;<strong>only</strong>&nbsp;if you have different rates/minimum hours on specific days of the week.</em>" +
    "                                            </p>" +
    "                                        </div>" +
    "                                    </div>" +
    '                                    <div class="ipt_uif_question_content">' +
    '                                        <div class="switch">' +
    '                                            <label class="eform-label-with-tabindex" tabindex="0" for="custom_special_rates_' +
    numItems +
    '" data-on="1" data-off="0"> Off ' +
    '                                                <input class="ipt_uif_switch" onchange="return update_special_custom_rates(event,' +
    numItems +
    ');" name="custom_special_rates[]" id="custom_special_rates_' +
    numItems +
    '" value="1" data-on="1" data-off="0" type="checkbox">' +
    '                                                <span class="lever"></span> On </label>' +
    "                                        </div>" +
    '                                        <div class="clear-both"></div>' +
    "                                    </div>" +
    "                                </div>" +
    '                                <div class="clear-both"></div>' +
    "                            </div>" +
    "                        </div>" +
    '                        <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_feedback_matrix iptUIFCHidden" id="custom_special_rates_area_' +
    numItems +
    '" style="display: none;">' +
    '                            <div class="ipt_uif_column_inner side_margin">' +
    '                                <div class="ipt_uif_question ipt_uif_question_vertical ipt_uif_question_full">' +
    '                                    <div class="ipt_uif_question_content">' +
    '                                        <div class="ipt_uif_matrix_container ipt_uif_matrix_feedback">' +
    '                                            <table class="ipt_uif_matrix highlight bordered">' +
    "                                                <thead>" +
    "                                                    <tr>" +
    '                                                        <th scope="col" style="width: 23%;"></th>' +
    '                                                        <th scope="col" style="width: 11%;"><div class="ipt_uif_matrix_div_cell">Monday</div></th>' +
    '                                                        <th scope="col" style="width: 11%;"><div class="ipt_uif_matrix_div_cell">Tuesday</div></th>' +
    '                                                        <th scope="col" style="width: 11%;"><div class="ipt_uif_matrix_div_cell">Wednesday</div></th>' +
    '                                                        <th scope="col" style="width: 11%;"><div class="ipt_uif_matrix_div_cell">Thursday</div></th>' +
    '                                                        <th scope="col" style="width: 11%;"><div class="ipt_uif_matrix_div_cell">Friday</div></th>' +
    '                                                        <th scope="col" style="width: 11%;"><div class="ipt_uif_matrix_div_cell">Saturday</div></th>' +
    '                                                        <th scope="col" style="width: 11%;"><div class="ipt_uif_matrix_div_cell">Sunday</div></th>' +
    "                                                    </tr>" +
    "                                                </thead>" +
    "                                                <tbody>" +
    "                                                    <tr>" +
    '                                                        <th scope="row"><div class="ipt_uif_matrix_div_cell">Hourly Rate</div></th>' +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_hourly_rate_monday[]" id="special_hourly_rate_monday_' +
    numItems +
    '" type="number" value="0" placeholder="$$" title="Hourly Rate for Monday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_hourly_rate_tuesday[]" id="special_hourly_rate_tuesday_' +
    numItems +
    '" type="number" value="0" placeholder="$$" title="Hourly Rate for Tuesday"> ' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_hourly_rate_wednesday[]" id="special_hourly_rate_wednesday_' +
    numItems +
    '" type="number" value="0" placeholder="$$" title="Hourly Rate for Wednesday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_hourly_rate_thursday[]" id="special_hourly_rate_thursday_' +
    numItems +
    '" type="number" value="0" placeholder="$$" title="Hourly Rate for Thursday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_hourly_rate_friday[]" id="special_hourly_rate_friday_' +
    numItems +
    '" type="number" value="0" placeholder="$$" title="Hourly Rate for Friday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_hourly_rate_saturday[]" id="special_hourly_rate_saturday_' +
    numItems +
    '" type="number" value="0" placeholder="$$" title="Hourly Rate for Saturday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_hourly_rate_sunday[]" id="special_hourly_rate_sunday_' +
    numItems +
    '" type="number" value="0" placeholder="$$" title="Hourly Rate for Sunday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                    </tr>" +
    "                                                    <tr>" +
    '                                                        <th scope="row">' +
    '                                                            <div class="ipt_uif_matrix_div_cell">Minimum Hours</div>' +
    "                                                        </th>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="special_min_hours_monday[]" id="special_min_hours_monday_' +
    numItems +
    '" type="number" value="0" placeholder="Hours" title="Minimum number of hours for Monday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="special_min_hours_tuesday[]" id="special_min_hours_tuesday_' +
    numItems +
    '" type="number" value="0" placeholder="Hours" title="Minimum number of hours for Tuesday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="special_min_hours_wednesday[]" id="special_min_hours_wednesday_' +
    numItems +
    '" type="number" value="0" placeholder="Hours" title="Minimum number of hours for Wednesday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="special_min_hours_thursday[]" id="special_min_hours_thursday_' +
    numItems +
    '" type="number" value="0" placeholder="Hours" title="Minimum number of hours for Thursday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="special_min_hours_friday[]" id="special_min_hours_friday_' +
    numItems +
    '" type="number" value="0" placeholder="Hours" title="Minimum number of hours for Friday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="special_min_hours_saturday[]" id="special_min_hours_saturday_' +
    numItems +
    '" type="number" value="0" placeholder="Hours" title="Minimum number of hours for Saturday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field"> ' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text" name="special_min_hours_sunday[]" id="special_min_hours_sunday_' +
    numItems +
    '" type="number" value="0" placeholder="Hours" title="Minimum number of hours for Sunday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                    </tr>" +
    "                                                    <tr>" +
    '                                                        <th scope="row">' +
    '                                                            <div class="ipt_uif_matrix_div_cell">Rate for Additional Hours</div>' +
    "                                                        </th>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_additional_hourly_mon[]" id="special_additional_hourly_mon_' +
    numItems +
    '" type="number" value="0" placeholder="$$" title="Rate for Additional Hours for Monday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_additional_hourly_tue[]" id="special_additional_hourly_tue_' +
    numItems +
    '" type="number" value="0" placeholder="$$" title="Rate for Additional Hours for Tuesday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_additional_hourly_wed[]" id="special_additional_hourly_wed_' +
    numItems +
    '" type="number" value="0" placeholder="$$" title="Rate for Additional Hours for Wednesday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_additional_hourly_thu[]" id="special_additional_hourly_thu_' +
    numItems +
    '" type="number" value="0" placeholder="$$" title="Rate for Additional Hours for Thursday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_additional_hourly_fri[]" id="special_additional_hourly_fri_' +
    numItems +
    '" type="number" value="0" placeholder="$$" title="Rate for Additional Hours for Friday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_additional_hourly_sat[]" id="special_additional_hourly_sat_' +
    numItems +
    '" type="number" value="0" placeholder="$$" title="Rate for Additional Hours for Saturday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                        <td>" +
    '                                                            <div class="ipt_uif_matrix_div_cell">' +
    '                                                                <div class="input-field">' +
    '                                                                    <input class="ipt_uif_matrix_text check_me ipt_uif_text vndr_currency" name="special_additional_hourly_sun[]" id="special_additional_hourly_sun_' +
    numItems +
    '" type="number" value="0" placeholder="$$" title="Rate for Additional Hours for Sunday">' +
    "                                                                </div>" +
    "                                                            </div>" +
    "                                                        </td>" +
    "                                                    </tr>" +
    "                                                </tbody>" +
    "                                            </table>" +
    "                                        </div>" +
    '                                        <div class="clear-both"></div>' +
    "                                    </div>" +
    "                                </div>" +
    '                                <div class="clear-both"></div>' +
    "                            </div>" +
    "                        </div>" +
    "                    </div></div>";
  var last_id = numItems - 1;
  jQuery("#special_rates_div").append(default_html).accordion("refresh");
  format_vndr_currency();
  configure_date_range();
}
function format_vndr_currency() {
  jQuery(".vndr_currency").on("blur, change", function () {
    var currency_value = Number(this.value);
    this.value = currency_value.toFixed(2);
  });
}
function update_special_custom_rates(e, i) {
  e.preventDefault();
  var s_hourly = document.getElementById("special_base_hourly_rate_" + i).value;
  var s_hours = document.getElementById("special_base_min_hours_" + i).value;
  if (
    s_hours &&
    s_hours != 0 &&
    s_hours != null &&
    s_hourly &&
    s_hourly != 0 &&
    s_hourly != null
  ) {
    if (document.getElementById("custom_special_rates_" + i).checked)
      document.getElementById("custom_special_rates_area_" + i).style.display =
        "block";
    else
      document.getElementById("custom_special_rates_area_" + i).style.display =
        "none";
  } else {
    if (document.getElementById("custom_special_rates_" + i).checked)
      document.getElementById("custom_special_rates_" + i).checked = false;
  }
}
function update_special_rates(e, i, id) {
  e.preventDefault();
  if (document.getElementById("custom_special_rates_" + i).checked) {
    document.getElementById("custom_special_rates_" + i).value = "1";
    if (id === "hourly") {
      var hourly_rate = Number(
        document.getElementById("special_base_hourly_rate_" + i).value
      );
      if (
        hourly_rate == 0 ||
        hourly_rate == "" ||
        hourly_rate == null ||
        hourly_rate == "undefined"
      ) {
        document.getElementById(
          "custom_special_rates_area_" + i
        ).style.display = "none";
        jQuery("#custom_special_rates_" + i).trigger("click");
      }
    } else if (id === "additional") {
      var additional = Number(
        document.getElementById("special_additional_hourly_" + i).value
      );
      if (
        additional == 0 ||
        additional == "" ||
        additional == null ||
        additional == "undefined"
      ) {
        document.getElementById(
          "custom_special_rates_area_" + i
        ).style.display = "none";
        jQuery("#custom_special_rates_" + i).trigger("click");
      }
    }
  } else {
    document.getElementById("custom_special_rates_" + i).value = "0";
    if (id === "hourly") {
      var hourly_rate = Number(
        document.getElementById("special_base_hourly_rate_" + i).value
      );
      document.getElementById("special_hourly_rate_monday_" + i).value =
        hourly_rate.toFixed(2);
      document.getElementById("special_hourly_rate_tuesday_" + i).value =
        hourly_rate.toFixed(2);
      document.getElementById("special_hourly_rate_wednesday_" + i).value =
        hourly_rate.toFixed(2);
      document.getElementById("special_hourly_rate_thursday_" + i).value =
        hourly_rate.toFixed(2);
      document.getElementById("special_hourly_rate_friday_" + i).value =
        hourly_rate.toFixed(2);
      document.getElementById("special_hourly_rate_saturday_" + i).value =
        hourly_rate.toFixed(2);
      document.getElementById("special_hourly_rate_sunday_" + i).value =
        hourly_rate.toFixed(2);
      return true;
    } else if (id === "minhours") {
      var min_hours = document.getElementById(
        "special_base_min_hours_" + i
      ).value;
      document.getElementById("special_min_hours_monday_" + i).value =
        min_hours;
      document.getElementById("special_min_hours_tuesday_" + i).value =
        min_hours;
      document.getElementById("special_min_hours_wednesday_" + i).value =
        min_hours;
      document.getElementById("special_min_hours_thursday_" + i).value =
        min_hours;
      document.getElementById("special_min_hours_friday_" + i).value =
        min_hours;
      document.getElementById("special_min_hours_saturday_" + i).value =
        min_hours;
      document.getElementById("special_min_hours_sunday_" + i).value =
        min_hours;
      return true;
    } else if (id === "additional") {
      var additional = Number(
        document.getElementById("special_additional_hourly_" + i).value
      );
      document.getElementById("special_additional_hourly_mon_" + i).value =
        additional.toFixed(2);
      document.getElementById("special_additional_hourly_tue_" + i).value =
        additional.toFixed(2);
      document.getElementById("special_additional_hourly_wed_" + i).value =
        additional.toFixed(2);
      document.getElementById("special_additional_hourly_thu_" + i).value =
        additional.toFixed(2);
      document.getElementById("special_additional_hourly_fri_" + i).value =
        additional.toFixed(2);
      document.getElementById("special_additional_hourly_sat_" + i).value =
        additional.toFixed(2);
      document.getElementById("special_additional_hourly_sun_" + i).value =
        additional.toFixed(2);
      return true;
    }
  }
  return false;
}
function validate_vehicle(e, step) {
  var has_errors = false;
  var failed_step = -1;
  if (failed_step == -1 && (step == "all" || step == 0)) {
    var vehicle_type = document.getElementById("vehicle_type").value.trim();
    if (
      vehicle_type != "" &&
      vehicle_type != null &&
      vehicle_type != "undefined"
    ) {
    } else if (has_errors == false) {
      alert("Please select vehicle type to continue!");
      document.getElementById("vehicle_type").focus();
      has_errors = true;
      failed_step = 0;
    }
    var vehicle_year = document.getElementById("vehicle_year").value.trim();
    if (
      vehicle_year != "" &&
      vehicle_year != null &&
      vehicle_year != "undefined"
    ) {
    } else if (has_errors == false) {
      alert("Please select vehicle year to continue!");
      document.getElementById("vehicle_year").focus();
      has_errors = true;
      failed_step = 0;
    }
    var vehicle_color = document.getElementById("vehicle_color").value.trim();
    if (
      vehicle_color != "" &&
      vehicle_color != null &&
      vehicle_color != "undefined"
    ) {
    } else if (has_errors == false) {
      alert("Please select vehicle color to continue!");
      document.getElementById("vehicle_color").focus();
      has_errors = true;
      failed_step = 0;
    }
    var vehicle_capacity = document
      .getElementById("vehicle_capacity")
      .value.trim();
    if (
      vehicle_capacity != "" &&
      vehicle_capacity != null &&
      vehicle_capacity != "undefined"
    ) {
    } else if (has_errors == false) {
      alert("Please enter passenger capacity to continue!");
      document.getElementById("vehicle_capacity").focus();
      has_errors = true;
      failed_step = 0;
    }
    var luggage_limit = document.getElementById("luggage_limit").value.trim();
    if (
      luggage_limit != "" &&
      luggage_limit != null &&
      luggage_limit != "undefined"
    ) {
    } else if (has_errors == false) {
      alert("Please enter luggage limit to continue!");
      document.getElementById("luggage_limit").focus();
      has_errors = true;
      failed_step = 0;
    }
    var vehicle_quantity = document
      .getElementById("vehicle_quantity")
      .value.trim();
    if (
      vehicle_quantity != "" &&
      vehicle_quantity != null &&
      vehicle_quantity != "undefined"
    ) {
    } else if (has_errors == false) {
      alert("Please enter identical vehicle(s) quantity to continue!");
      document.getElementById("vehicle_quantity").focus();
      has_errors = true;
      failed_step = 0;
    }
  }
  if (failed_step == -1 && (step == "all" || step == 2)) {
    var base_hourly_rate = document
      .getElementById("base_hourly_rate")
      .value.trim();
    if (
      base_hourly_rate != 0 &&
      base_hourly_rate != "" &&
      base_hourly_rate != null &&
      base_hourly_rate != "undefined"
    ) {
    } else if (has_errors == false) {
      alert("Please enter base hourly rate to continue!");
      document.getElementById("base_hourly_rate").focus();
      has_errors = true;
      failed_step = 2;
    }
    var base_min_hours = document.getElementById("base_min_hours").value.trim();
    if (
      base_min_hours != 0 &&
      base_min_hours != "" &&
      base_min_hours != null &&
      base_min_hours != "undefined"
    ) {
    } else if (has_errors == false) {
      alert("Please enter base minimum hours to continue!");
      document.getElementById("base_min_hours").focus();
      has_errors = true;
      failed_step = 2;
    }
    var base_additional_hourly = document
      .getElementById("base_additional_hourly")
      .value.trim();
    if (
      base_additional_hourly != 0 &&
      base_additional_hourly != "" &&
      base_additional_hourly != null &&
      base_additional_hourly != "undefined"
    ) {
    } else if (has_errors == false) {
      alert("Please enter additional hourly rate to continue!");
      document.getElementById("base_additional_hourly").focus();
      has_errors = true;
      failed_step = 2;
    }
  }
  if (failed_step == -1 && (step == "all" || step == 5)) {
    var images_counter = 0;
    if (document.querySelector(".image-container") !== null) {
      var images_counter = document.querySelectorAll(
        "#append_images .image-container"
      ).length;
    }
    if (
      images_counter &&
      images_counter != null &&
      images_counter != "undefined" &&
      images_counter > 1
    ) {
      //has some images
    } else {
      if (
        confirm(
          "This vehicle will not publish untill you upload images. Please upload at least two images. Click OK to continue without uploading image!"
        )
      ) {
      } else {
        has_errors = true;
        failed_step = 5;
      }
    }
  }
  if (has_errors == true) {
    //        console.log(failed_step);
    //        console.log(step);
    //        if (failed_step != -1 && failed_step!=step) {
    //            jQuery('#smartwizard').smartWizard("reset");
    //        }
    e.preventDefault();
  } else {
    return true;
  }
}
// function remove_special_rates(e, lineNumber) {
//     e.preventDefault();
//     if (confirm('Are you sure you want to remove this special rate? You can\'t undo this action!')) {
//         var header_id = document.getElementById('special_rates_' + lineNumber).parentElement.getAttribute('aria-labelledby');
//         var special_rate_id = document.getElementById('special_rate_id_' + lineNumber).value;
//         // alert(special_rate_id);
//         if (special_rate_id && special_rate_id != null && special_rate_id != "") {
//             var vehicle_id = document.getElementById('registration_form').vehicle.value;

//              var specialRateElement = document.getElementById(
//                "special_rates_" + lineNumber
//              ).parentElement;
//              var specialRateHeading = document.getElementById(
//                "special_rates_heading_" + lineNumber
//              );
//              let deletedSpId = (document.getElementById(
//                "special_rate_deleted_id_" + lineNumber
//              ).value = lineNumber);
//  if (specialRateElement && specialRateHeading) {
//    specialRateElement.parentElement.removeChild(specialRateHeading);
//    specialRateElement.parentElement.removeChild(specialRateElement);
//  }
//             // jQuery.ajax({
//             //     url: "remove_special_rate.php",
//             //     type: "POST",
//             //     async: false,
//             //     data: {special_rate: special_rate_id, vehicle: vehicle_id},
//             //     success: function (result) {
//             //         if (result == 'failed') {
//             //             alert("An error occurred while removing special rate. Refresh page and try again!");
//             //         } else if (result == 'success') {
//             //             document.getElementById(header_id).style.display = 'none';
//             //             document.getElementById('special_rates_' + lineNumber).style.display='none';
//             //             alert('done');
//             //             jQuery('#special_rates_div').accordion("refresh");
//             //         }
//             //     }
//             // });
//         } else {
//             // alert(document.getElementById(header_id));

//             console.log("we are here");
//             // document.getElementById(
//             //   "special_rates_" + lineNumber
//             // ).parentElement.style.display = "none";
//             // document.getElementById("special_rates_heading_" + lineNumber).style.display="none";
//             // document.getElementById(header_id).remove();
//             // document.getElementById('special_rates_' + lineNumber).parentElement.style.display='none';
//             var specialRateElement = document.getElementById(
//               "special_rates_" + lineNumber
//             ).parentElement;
//             var specialRateHeading = document.getElementById(
//               "special_rates_heading_" + lineNumber
//             );

//             if (specialRateElement && specialRateHeading) {
//               specialRateElement.parentElement.removeChild(specialRateHeading);
//               specialRateElement.parentElement.removeChild(specialRateElement);
//             }

//             jQuery('#special_rates_div').accordion("refresh");
//         }
//     }
// }

function remove_special_rates(e, lineNumber) {
  e.preventDefault();
  if (
    confirm(
      "Are you sure you want to remove this special rate? You can't undo this action!"
    )
  ) {
    var header_id = document
      .getElementById("special_rates_" + lineNumber)
      .parentElement.getAttribute("aria-labelledby");
    var special_rate_id = document.getElementById(
      "special_rate_id_" + lineNumber
    ).value;
    var deletedSpId = document.getElementById(
      "special_rate_deleted_id_" + lineNumber
    );
    var deletedSpName = document.getElementById(
      "special_rate_deleted_name_" + lineNumber
    );

    if (special_rate_id && special_rate_id != null && special_rate_id != "") {
      var vehicle_id =
        document.getElementById("registration_form").vehicle.value;

      var specialRateElement = document.getElementById(
        "special_rates_" + lineNumber
      ).parentElement;
      var specialRateHeading = document.getElementById(
        "special_rates_heading_" + lineNumber
      );

      if (specialRateElement && specialRateHeading) {
        specialRateElement.parentElement.removeChild(specialRateHeading);
        specialRateElement.parentElement.removeChild(specialRateElement);
      }

      // Append the lineNumber and special rate name to the deletedSpId and deletedSpName variables
      deletedSpId.value = special_rate_id;
      deletedSpName.value = lineNumber;

      jQuery("#special_rates_div").accordion("refresh");
    } else {
      var specialRateElement = document.getElementById(
        "special_rates_" + lineNumber
      ).parentElement;
      var specialRateHeading = document.getElementById(
        "special_rates_heading_" + lineNumber
      );

      if (specialRateElement && specialRateHeading) {
        specialRateElement.parentElement.removeChild(specialRateHeading);
        specialRateElement.parentElement.removeChild(specialRateElement);
      }

      deletedSpId.value = lineNumber;
      deletedSpName.value = lineNumber;

      jQuery("#special_rates_div").accordion("refresh");
    }
  }
}
function remove_image(e, img) {
  e.preventDefault();
  document.getElementById("uploaded_" + img).value =
    "removed_" + document.getElementById("uploaded_" + img).value;
  document.getElementById("img_" + img).className = "removed";
  document.getElementById("img_" + img).style.display = "none";
}

// function validateSpecialRates() {
//   const specialRatesDiv = jQuery("#special_rates_div");
//   const inputs = specialRatesDiv.find(
//     "input[type='text'], input[type='number'], select"
//   );
//   let isValid = true;

//   inputs.each(function () {
//     const input = jQuery(this);
//     if (input.val() === "") {
//       isValid = false;
//       input.addClass("error");
//     } else {
//       input.removeClass("error");
//     }
//   });

//   return isValid;
// }

// function addMoreSpecialRates(e) {
//   e.preventDefault();
//   if (validateSpecialRates()) {
//     // submit the form or perform the desired action
//   } else {
//     alert("Please fill in all the fields");
//   }
// }