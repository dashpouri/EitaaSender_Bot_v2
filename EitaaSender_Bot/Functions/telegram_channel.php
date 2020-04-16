<?php

# REGISTER TELEGRAM CHANNEL
function register_telegram_channel($telegram_channel, $telegram_channel_title)
{
    global $forward_from_chat_id;
    global $forward_from_chat_title;
    
    if ($GLOBALS['text'] || $GLOBALS['message_audio'] || $GLOBALS['message_voice'] || $GLOBALS['message_document'] || $GLOBALS['message_photo'] || $GLOBALS['message_video'] || $GLOBALS['message_sticker'])
    {
        if ($GLOBALS['forward_from_chat_type'] == "channel")
        {
            $get_channel_administratos = $GLOBALS['telegram_bot_url'] . "/getChatAdministrators?chat_id=$forward_from_chat_id";

            $json_information = file_get_contents($get_channel_administratos);
            $array_information = json_decode($json_information, true);
        
            $information_result = $array_information["ok"];
        
            $count = count($array_information);
    
            for ($x=0; $x<$count; $x++)
            {
                $channel_admin_id = $array_information["result"][$x]["user"]["id"];
        
                if ($channel_admin_id == $GLOBALS['chat_id'])
                {
                    break;
                }
            }

            if ($information_result == true)
            {
                if ($channel_admin_id == $GLOBALS['chat_id'])
                {
                    $result = mysqli_query($GLOBALS['conn'], "UPDATE users SET $telegram_channel = '$forward_from_chat_id', $telegram_channel_title = '$forward_from_chat_title' WHERE chat_id = {$GLOBALS['chat_id']}");

                    if ($result)
                    {
                        show_message($GLOBALS['channel_registered']);
                    }
                    else
                    {
                        show_message($GLOBALS['error']);
                    }
                }
                else 
                {
                    show_message($GLOBALS['you_must_be_admin']);
                }
            }
            else 
            {
                show_message($GLOBALS['bot_must_be_admin']);
            }
        }
        else 
        {
            show_message($GLOBALS['please_forward']);
        }
      
    }

}


# CHANGE TELEGRAM CHANNEL STATUS
function change_telegram_channel_status($channel_status, $value)
{
    global $conn;
    global $chat_id;

    $result = mysqli_query($conn, "UPDATE users SET $channel_status = '$value' WHERE chat_id = $chat_id");

    if ($result)
    {
        answer_callback_query("$value شد");
    }
    else
    {
        show_message($GLOBALS['error']);
    }
}

# DELETE TELEGRAM CHANNEL
function delete_telegram_channel($id, $title)
{
    $result = mysqli_query($GLOBALS['conn'], "UPDATE users SET $id = '', 
    $title = 'ثبت کانال' WHERE chat_id = {$GLOBALS['chat_id']}");

    if ($result)
    {
        user_position($GLOBALS['position_delete_telegram_channel']);
        answer_callback_query($GLOBALS['channel_deleted']);
        return true;
    }
    else 
    {
        answer_callback_query($GLOBALS['error']);
    }
}
