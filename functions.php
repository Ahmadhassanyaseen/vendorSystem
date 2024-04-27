<?php

function validate_captcha_code($post_data, $session_data) {
    if (empty($session_data['captcha_code']) || strcasecmp($session_data['captcha_code'], $post_data['captcha_code']) != 0) {
        return false;
    } else {
        return true;
    }
}

function validate_required_fields($post_data, $check_fields = array()) {
	//print_r($post_data);
    $missing_fields = array();
    foreach ($check_fields as $chck_f) { //print_r($post_data[$chck_f]);&& $post_data[$chck_f] < 0
        if (!isset($post_data[$chck_f]) || empty(trim($post_data[$chck_f])) )
            $missing_fields[] = $chck_f;
    }
    if($post_data['luggage_limit'] == 0){
         return true;
    }
    
    if ($missing_fields == null || sizeof($missing_fields) <= 0 || $post_data['luggage_limit'] >= 0) {
        return true;
    } else {
        return "Following fields are empty: " . implode(", ", $missing_fields);
    }
}

function validate_match_password($post_data) {
    if (!empty(trim($post_data["user_password"])) && !empty(trim($post_data["confirm_password"])) && trim($post_data["user_password"]) == trim($post_data["confirm_password"])) {
        return true;
    } else {
        return false;
    }
}

function validate_email_address($eaddress) {
    if (!filter_var($eaddress, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else {
        return true;
    }
}

?>