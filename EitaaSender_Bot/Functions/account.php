<?php 

function account_information()
{
    global $eitaa_token;
    global $charge_size;
    global $used_charge;

    $eitaa_bot_information = $GLOBALS['eitaa_bot_url'] . $eitaa_token . "/getMe";
    $json_information = file_get_contents($eitaa_bot_information);
    $array_information = json_decode($json_information, true);

    $id = $array_information["result"]["id"];
    $first_name = $array_information["result"]["first_name"];
    $last_name = $array_information["result"]["last_name"];
    $username = $array_information["result"]["username"];

    $charge_to_mb = round($charge_size/1024/1024, 2);
    $usage_to_mb = round($used_charge/1024/1024, 2);

    $message  = "🔸اطلاعات ایتایار\n";
    $message .= "نام: $first_name $last_name\n";
    $message .= "نام کاربری: $username\n\n";
    $message .= "🔹سایر اطلاعات\n";
    $message .= "حجم باقی مانده: $charge_to_mb از 300 MB\n";
    $message .= "حجم مصرفی: $usage_to_mb MB\n\n";
    $message .= "🔰حجم شما روزانه 300 مگابایت می باشد\n\n";
    $message .= "@EitaaSender_Bot";

    return $message;
}