<?php
function print_error_log($data)
{
    $log_date_time = "[" . date("Y-m-d H:i:s") . "] ";
    $log = "";
    if (is_array($data)) {
        foreach ($_REQUEST as $key => $val)
            if ($key !== 'g-recaptcha-response' && $key !== 'send_lead')
                $log .= $log_date_time . $key . " => " . $val . PHP_EOL;
    } else if (is_string($data)) {
        if ($data == "end_log")
            $log .= '-----------------------------------------' . PHP_EOL;
        else
            $log .= $log_date_time . $data . PHP_EOL;
    } else {
        $log .= $log_date_time . json_encode($data) . PHP_EOL;
    }
    file_put_contents('quote_system_log.txt', $log, FILE_APPEND);
}
