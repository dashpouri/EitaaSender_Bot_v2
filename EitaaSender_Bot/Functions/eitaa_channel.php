<?php

# REGISTER CHANNEL
function register_eitaa_channel()
{
    if ($GLOBALS['text'])
    {
        if (strpos($GLOBALS['text'], "@") !== 0)
        {
            if ($GLOBALS['text'] != $GLOBALS['eitaa_channel_one'] && $GLOBALS['text'] != $GLOBALS['eitaa_channel_two'] && $GLOBALS['text'] != $GLOBALS['eitaa_channel_three'] && $GLOBALS['text'] != $GLOBALS['eitaa_channel_four'] && $GLOBALS['text'] != $GLOBALS['eitaa_channel_five'])
            {
                $converted_id = convert_numbers($GLOBALS['text'], true);

                $check_channel = $GLOBALS['eitaa_bot_url'] . $GLOBALS['eitaa_token'] . "/sendMessage?chat_id=$converted_id&text=.";

                $json_check_channel = file_get_contents($check_channel);
                $array_check_channel = json_decode($json_check_channel, true);

                $check_result = $array_check_channel["ok"];

                if ($check_result == true)
                {
                    if ($GLOBALS['eitaa_channel_one'] == "")
                    {
                        $result = mysqli_query($GLOBALS['conn'], "UPDATE users SET eitaa_channel_one = '$converted_id', eitaa_current_channel = '$converted_id' WHERE chat_id = {$GLOBALS['chat_id']}");
                        
                        if ($result)
                        {
                            show_message($GLOBALS['channel_registered']);
                        }
                        else 
                        {
                            show_message($GLOBALS['error']);
                        }
                    }

                    else if ($GLOBALS['eitaa_channel_two'] == "")
                    {
                        $result = mysqli_query($GLOBALS['conn'], "UPDATE users SET eitaa_channel_two = '$converted_id', eitaa_current_channel = '$converted_id' WHERE chat_id = {$GLOBALS['chat_id']}");
                        
                        if ($result)
                        {
                            show_message($GLOBALS['channel_registered']);
                        }
                        else 
                        {
                            show_message($GLOBALS['error']);
                        }
                    }

                    else if ($GLOBALS['eitaa_channel_three'] == "")
                    {
                        $result = mysqli_query($GLOBALS['conn'], "UPDATE users SET eitaa_channel_three = '$converted_id', eitaa_current_channel = '$converted_id' WHERE chat_id = {$GLOBALS['chat_id']}");
                        
                        if ($result)
                        {
                            show_message($GLOBALS['channel_registered']);
                        }
                        else 
                        {
                            show_message($GLOBALS['error']);
                        }
                    }

                    else if ($GLOBALS['eitaa_channel_four'] == "")
                    {
                        $result = mysqli_query($GLOBALS['conn'], "UPDATE users SET eitaa_channel_four = '$converted_id', eitaa_current_channel = '$converted_id' WHERE chat_id = {$GLOBALS['chat_id']}");
                        
                        if ($result)
                        {
                            show_message($GLOBALS['channel_registered']);
                        }
                        else 
                        {
                            show_message($GLOBALS['error']);
                        }
                    }

                    else if ($GLOBALS['eitaa_channel_five'] == "")
                    {
                        $result = mysqli_query($GLOBALS['conn'], "UPDATE users SET eitaa_channel_five = '$converted_id', eitaa_current_channel = '$converted_id' WHERE chat_id = {$GLOBALS['chat_id']}");
                        
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
                        show_message("شما فقط می توانید 5 کانال ثبت کنید");
                    }
                }
                else 
                {
                    show_message($GLOBALS['channel_invalid']);
                }
            }
            else 
            {
                show_message($GLOBALS['channel_exists']);
            }
        }
        else 
        {
            show_message($GLOBALS['no_addsign']);
        }
    }
}

# CHANGE CHANNEL
function edit_eitaa_channel()
{
    if ($GLOBALS['text'])
    {
        if (strpos($GLOBALS['text'], "@") !== 0)
        {
            $converted_id = convert_numbers($GLOBALS['text'], true);

            $check_channel = $GLOBALS['eitaa_bot_url'] . $GLOBALS['eitaa_token'] . "/sendMessage?chat_id=$converted_id&text=.";

            $json_check_channel = file_get_contents($check_channel);
            $array_check_channel = json_decode($json_check_channel, true);

            $check_result = $array_check_channel["ok"];

            if ($check_result == true)
            {
                if ($GLOBALS['user_position'] == "changeEitaaChannelOne")
                {
                    update_query("eitaa_channel_one", $converted_id, $GLOBALS['channel_changed']);
                }

                else if ($GLOBALS['user_position'] == "changeEitaaChannelTwo")
                {
                    update_query("eitaa_channel_two", $converted_id, $GLOBALS['channel_changed']);
                }

                else if ($GLOBALS['user_position'] == "changeEitaaChannelThree")
                {
                    update_query("eitaa_channel_three", $converted_id, $GLOBALS['channel_changed']);
                }

                else if ($GLOBALS['user_position'] == "changeEitaaChannelFour")
                {
                    update_query("eitaa_channel_four", $converted_id, $GLOBALS['channel_changed']);
                }

                else if ($GLOBALS['user_position'] == "changeEitaaChannelFive")
                {
                    update_query("eitaa_channel_five", $converted_id, $GLOBALS['channel_changed']);
                }
            }
            else 
            {
                show_message($GLOBALS['channel_invalid']);
            }
        }
        else 
        {
            show_message($GLOBALS['no_addsign']);
        }
    }
}

# REGISTER CHANNEL TITLE
function register_eitaa_channel_title($channel, $current_title)
{
    global $conn;
    global $chat_id;
    global $text;
    global $user_position;

    if ($text)
    {

        $result = mysqli_query($conn, "UPDATE users SET $channel = '$text', $current_title = '$text' WHERE chat_id = $chat_id");

        if ($result)
        {
            user_position($position_channel_title_registered);
            show_message($GLOBALS['channel_title_registered']);
        }
        else
        {
            show_message($GLOBALS['error']);
        }
        
    }
}

# DELETE EITAA CHANNEL 
function delete_eitaa_channel($channel, $title, $current_channel, $current_title)
{
    $result = mysqli_query($GLOBALS['conn'], "UPDATE users SET $channel = '', 
    $title = '', $current_channel = '', $current_title = '' 
    WHERE chat_id = {$GLOBALS['chat_id']}");

    if ($result)
    {
        user_position($GLOBALS['position_delete_eitaa_channel']);
        answer_callback_query($GLOBALS['channel_deleted']);
        return true;
    }
    else 
    {
        answer_callback_query($GLOBALS['error']);
    }
}

# SELECT EITAA CHANNEL
function select_eitaa_channel($id, $title)
{
    global $conn;
    global $chat_id;
    
    $result = mysqli_query($conn, "UPDATE users SET eitaa_current_channel = '$id', 
    eitaa_current_channel_title = '$title' WHERE chat_id = $chat_id");

    if ($result)
    {
        show_message($GLOBALS['channel_selected'] . $id . " " . $title);
    }
    else 
    {
        show_message($GLOBALS['error']);
    }
}