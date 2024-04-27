<?php

require_once './config.php';
$result = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["captcha_code"]) && !empty($_POST["captcha_code"])) {
    if (empty($_SESSION['captcha_code']) || strcasecmp($_SESSION['captcha_code'], $_POST["captcha_code"]) != 0) {
        $result = 'failed';
    } else {
        $result = 'passed';
    }
} else {
    $result = 'empty';
}
echo $result;
?>