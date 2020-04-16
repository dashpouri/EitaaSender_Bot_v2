<?php 

function register_eitaa_token()
{
    if ($GLOBALS['text'])
    {
        $converted_token = convert_numbers($GLOBALS['text'], true);

        $eitaa_bot_information = $GLOBALS['eitaa_bot_url'] . $converted_token . "/getMe";
        $json_information = file_get_contents($eitaa_bot_information);
        $array_information = json_decode($json_information, true);

        $information_result = $array_information["ok"];

        if ($information_result == true)
        {
            if ($converted_token != $GLOBALS['eitaa_token'])
            {
                $registered_token = mysqli_query($GLOBALS['conn'], "UPDATE users SET eitaa_token = '$converted_token' WHERE chat_id = '{$GLOBALS['chat_id']}'");

                if ($registered_token)
                {
                    show_message($GLOBALS['token_registered']);
                }
                else 
                {
                    show_message($GLOBALS['error']);
                }
            }
            else 
            {
                show_message($GLOBALS['token_exists']);
            }
        }
        else 
        {
            show_message($GLOBALS['token_invalid']);
        }
    }
}