<?php 

# ANSWER CALLBACK QUERY
function answer_callback_query($message)
{
    $url = $GLOBALS['telegram_bot_url'] . "/answerCallbackQuery";
    $post_params = [
        "callback_query_id" => $GLOBALS['callback_query_id'],
        "text" => $message
    ];
    send_to_telegram($url, $post_params);
}

function answer_callback_query_with_alert($message)
{
    $url = $GLOBALS['telegram_bot_url'] . "/answerCallbackQuery";
    $post_params = [
        "callback_query_id" => $GLOBALS['callback_query_id'],
        "text" => $message,
        "show_alert" => true
    ];
    send_to_telegram($url, $post_params);
}

# RECEIVE CALLBACK
function detect_callback_received()
{
    global $data;
    global $chat_id;
    global $conn;
    global $eitaa_token;

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE chat_id = $chat_id");

    foreach ($sql as $row)
    {
        $black_list = $row["black_list"];
        $black_list_reason = $row["black_list_reason"];
        $eitaa_current_channel = $row["eitaa_current_channel"];
        $eitaa_current_channel_title = $row["eitaa_current_channel_title"];
        $user_position = $row["user_position"];
        $message_id = $row["message_id"];
        $charge_size = $row["charge_size"];
        $used_charge = $row["used_charge"];
        $eitaa_token = $row["eitaa_token"];
        $eitaa_channel_one = $row["eitaa_channel_one"];
        $eitaa_channel_two = $row["eitaa_channel_two"];
        $eitaa_channel_three = $row["eitaa_channel_three"];
        $eitaa_channel_four = $row["eitaa_channel_four"];
        $eitaa_channel_five = $row["eitaa_channel_five"];
        $eitaa_channel_one_title = $row["eitaa_channel_one_title"];
        $eitaa_channel_two_title = $row["eitaa_channel_two_title"];
        $eitaa_channel_three_title = $row["eitaa_channel_three_title"];
        $eitaa_channel_four_title = $row["eitaa_channel_four_title"];
        $eitaa_channel_five_title = $row["eitaa_channel_five_title"];
        $telegram_channel_one = $row["telegram_channel_one"];
        $telegram_channel_two = $row["telegram_channel_two"];
        $telegram_channel_three = $row["telegram_channel_three"];
        $telegram_channel_four = $row["telegram_channel_four"];
        $telegram_channel_five = $row["telegram_channel_five"];
        $telegram_channel_one_title = $row["telegram_channel_one_title"];
        $telegram_channel_two_title = $row["telegram_channel_two_title"];
        $telegram_channel_three_title = $row["telegram_channel_three_title"];
        $telegram_channel_four_title = $row["telegram_channel_four_title"];
        $telegram_channel_five_title = $row["telegram_channel_five_title"];
        $telegram_channel_one_status = $row["telegram_channel_one_status"];
        $telegram_channel_two_status = $row["telegram_channel_two_status"];
        $telegram_channel_three_status = $row["telegram_channel_three_status"];
        $telegram_channel_four_status = $row["telegram_channel_four_status"];
        $telegram_channel_five_status = $row["telegram_channel_five_status"];
        $original_text_one = $row["original_text_one"];
        $original_text_two = $row["original_text_two"];
        $original_text_three = $row["original_text_three"];
        $original_text_four = $row["original_text_four"];
        $original_text_five = $row["original_text_five"];
        $alternative_text_one = $row["alternative_text_one"];
        $alternative_text_two = $row["alternative_text_two"];
        $alternative_text_three = $row["alternative_text_three"];
        $alternative_text_four = $row["alternative_text_four"];
        $alternative_text_five = $row["alternative_text_five"];
        $signature_one = $row["signature_one"];
        $signature_two = $row["signature_two"];
        $signature_three = $row["signature_three"];
        $signature_four = $row["signature_four"];
        $signature_five = $row["signature_five"];
    }

    switch ($data)
    {
        # ADD NEW CHANNEL
        case "add_new_channel" : 
            user_position("enterEitaaChannel");
            show_message($GLOBALS['enter_channel']);
        break;

        # CHANGE EITAA CHANNEL
        case "change_eitaa_channel_one" :
            user_position("changeEitaaChannelOne");
            show_message($GLOBALS['enter_new_channel_id']);
        break;

        case "change_eitaa_channel_two" :
            user_position("changeEitaaChannelTwo");
            show_message($GLOBALS['enter_new_channel_id']);
        break;

        case "change_eitaa_channel_three" :
            user_position("changeEitaaChannelThree");
            show_message($GLOBALS['enter_new_channel_id']);
        break;

        case "change_eitaa_channel_four" :
            user_position("changeEitaaChannelFour");
            show_message($GLOBALS['enter_new_channel_id']);
        break;

        case "change_eitaa_channel_five" :
            user_position("changeEitaaChannelFive");
            show_message($GLOBALS['enter_new_channel_id']);
        break;

        # CHANGE EITAA CHANNEL TITLE
        case "change_eitaa_channel_one_title" :
            user_position("changeEitaaChannelOneTitle");
            show_message($GLOBALS['enter_channel_title']);
        break;

        case "change_eitaa_channel_two_title" :
            user_position("changeEitaaChannelTwoTitle");
            show_message($GLOBALS['enter_channel_title']);
        break;

        case "change_eitaa_channel_three_title" :
            user_position("changeEitaaChannelThreeTitle");
            show_message($GLOBALS['enter_channel_title']);
        break;

        case "change_eitaa_channel_four_title" :
            user_position("changeEitaaChannelFourTitle");
            show_message($GLOBALS['enter_channel_title']);
        break;

        case "change_eitaa_channel_five_title" :
            user_position("changeEitaaChannelFiveTitle");
            show_message($GLOBALS['enter_channel_title']);
        break;

        # DELETE EITAA CHANNEL
        case "delete_eitaa_channel_one" :
            $result = delete_eitaa_channel("eitaa_channel_one", "eitaa_channel_one_title", "eitaa_current_channel_title", "eitaa_current_channel");
            
            if ($result)
            {
                user_position("deleteEitaaChannel");
            }
        
        break;

        case "delete_eitaa_channel_two" :
            $result = delete_eitaa_channel("eitaa_channel_two", "eitaa_channel_two_title", "eitaa_current_channel_title", "eitaa_current_channel");
        
            if ($result)
            {
                user_position("deleteEitaaChannel");
            }
        
        break;

        case "delete_eitaa_channel_three" :
            $result = delete_eitaa_channel("eitaa_channel_three", "eitaa_channel_three_title", "eitaa_current_channel_title", "eitaa_current_channel");
        
            if ($result)
            {
                user_position("deleteEitaaChannel");
            }
        break;

        case "delete_eitaa_channel_four" :
            $result = delete_eitaa_channel("eitaa_channel_four", "eitaa_channel_four_title", "eitaa_current_channel_title", "eitaa_current_channel");
        
            if ($result)
            {
                user_position("deleteEitaaChannel");
            }

        break;

        case "delete_eitaa_channel_five" :
            $result = delete_eitaa_channel("eitaa_channel_five", "eitaa_channel_five_title", "eitaa_current_channel_title", "eitaa_current_channel");
        
            if ($result)
            {
                user_position("deleteEitaaChannel");
            }
        
        break;

        # SHOW HELP FOR EITAA (BUTTON)
        case "show_help_for_eitaa_channel" :
            answer_callback_query_with_alert($GLOBALS['channel_help']);
        break;

        # REGISTER SIGNATURE
        case "change_signature_one" :
            user_position("changeSignatureOne");
            show_message($GLOBALS['enter_signature']);
        break;

        case "change_signature_two" :
            user_position("changeSignatureTwo");
            show_message($GLOBALS['enter_signature']);
        break;

        case "change_signature_three" :
            user_position("changeSignatureThree");
            show_message($GLOBALS['enter_signature']);
        break;

        case "change_signature_four" :
            user_position("changeSignatureFour");
            show_message($GLOBALS['enter_signature']);
        break;

        case "change_signature_five" :
            user_position("changeSignatureFive");
            show_message($GLOBALS['enter_signature']);
        break;

        # DELETE SIGNATURE 
        case "delete_signature_one" : 
            if ($signature_one != "امضا")
            {
                $result = delete_signature("signature_one");
            
                if ($result)
                {
                    user_position("deleteSignature");
                }
            }
            else 
            {
                answer_callback_query($GLOBALS['signature_not_exists']);
            }
        break;

        case "delete_signature_two" : 
            if ($signature_two != "امضا")
            {
                $result = delete_signature("signature_two");

                if ($result)
                {
                    user_position("deleteSignature");
                }
            }
            else 
            {
                answer_callback_query($GLOBALS['signature_not_exists']);
            }
        break;

        case "delete_signature_three" : 
            if ($signature_three != "امضا")
            {
                $result = delete_signature("signature_three");

                if ($result)
                {
                    user_position("deleteSignature");
                }
            }
            else
            {
                answer_callback_query($GLOBALS['signature_not_exists']);
            }
        break;

        case "delete_signature_four" : 
            if ($signature_four != "امضا")
            {
                $result = delete_signature("signature_four");

                if ($result)
                {
                    user_position("deleteSignature");
                }
            }
            else 
            {
                answer_callback_query($GLOBALS['signature_not_exists']);
            }
        break;

        case "delete_signature_five" : 
            if ($signature_five != "امضا")
            {
                $result = delete_signature("signature_five");

                if ($result)
                {
                    user_position("deleteSignature");
                }
            }
            else 
            {
                answer_callback_query($GLOBALS['signature_not_exists']);
            }
        break;

        # REGISTER ALTERNATIVE CHANGING TEXT 
        case "change_alternative_changing_text_one" :
            user_position("changeAlternativeChangingTextOne");
            show_message($GLOBALS['enter_alternative_text']);
        break;

        case "change_alternative_changing_text_two" :
            user_position("changeAlternativeChangingTextTwo");
            show_message($GLOBALS['enter_alternative_text']);
        break;

        case "change_alternative_changing_text_three" :
            user_position("changeAlternativeChangingTextThree");
            show_message($GLOBALS['enter_alternative_text']);
        break;

        case "change_alternative_changing_text_four" :
            user_position("changeAlternativeChangingTextFour");
            show_message($GLOBALS['enter_alternative_text']);
        break;

        case "change_alternative_changing_text_five" :
            user_position("changeAlternativeChangingTextFive");
            show_message($GLOBALS['enter_alternative_text']);
        break;

        # REGISTER ORIGINAL CHANGING TEXT 
        case "change_original_changing_text_one" :
            user_position("changeOriginalChangingTextOne");
            show_message($GLOBALS['enter_original_text']);
        break;

        case "change_original_changing_text_two" :
            user_position("changeOriginalChangingTextTwo");
            show_message($GLOBALS['enter_original_text']);
        break;

        case "change_original_changing_text_three" :
            user_position("changeOriginalChangingTextThree");
            show_message($GLOBALS['enter_original_text']);
        break;

        case "change_original_changing_text_four" :
            user_position("changeOriginalChangingTextFour");
            show_message($GLOBALS['enter_original_text']);
        break;

        case "change_original_changing_text_five" :
            user_position("changeOriginalChangingTextFive");
            show_message($GLOBALS['enter_original_text']);
        break;

        # DELETE CHANGING TEXT
        case "delete_changing_text_one" :
            if ($original_text_one != "اصلی" || $alternative_text_one != "جایگزین")
            {
                $result = delete_changing_text("original_text_one", "alternative_text_one");

                if ($result)
                {
                    user_position("deleteChangingText");
                }
            }
            else 
            {
                answer_callback_query($GLOBALS['changing_text_not_exists']);
            }
        break;

        case "delete_changing_text_two" :
            if ($original_text_one != "اصلی" || $alternative_text_one != "جایگزین")
            {
                $result = delete_changing_text("original_text_two", "alternative_text_two");

                if ($result)
                {
                    user_position("deleteChangingText");
                }
            }
            else 
            {
                answer_callback_query($GLOBALS['changing_text_not_exists']);
            }
        break;

        case "delete_changing_text_three" :
            if ($original_text_one != "اصلی" || $alternative_text_one != "جایگزین")
            {
                $result = delete_changing_text("original_text_three", "alternative_text_three");

                if ($result)
                {
                    user_position("deleteChangingText");
                }
            }
            else 
            {
                answer_callback_query($GLOBALS['changing_text_not_exists']);
            }
        break;

        case "delete_changing_text_four" :
            if ($original_text_one != "اصلی" || $alternative_text_one != "جایگزین")
            {
                $result = delete_changing_text("original_text_four", "alternative_text_four");

                if ($result)
                {
                    user_position("deleteChangingText");
                }
            }
            else 
            {
                answer_callback_query($GLOBALS['changing_text_not_exists']);
            }
        break;

        case "delete_changing_text_five" :
            if ($original_text_one != "اصلی" || $alternative_text_one != "جایگزین")
            {
                $result = delete_changing_text("original_text_five", "alternative_text_five");

                if ($result)
                {
                    user_position("deleteChangingText");
                }
            }
            else 
            {
                answer_callback_query($GLOBALS['changing_text_not_exists']);
            }
        break;

        # REGISTER TELEGRAM CHANNEL
        case "change_telegram_channel_one" :
            user_position("changeTelegramChannelOne");
            show_message($GLOBALS['forward_a_post']);
        break;

        case "change_telegram_channel_two" :
            user_position("changeTelegramChannelTwo");
            show_message($GLOBALS['forward_a_post']);
        break;

        case "change_telegram_channel_three" :
            user_position("changeTelegramChannelThree");
            show_message($GLOBALS['forward_a_post']);
        break;

        case "change_telegram_channel_four" :
            user_position("changeTelegramChannelFour");
            show_message($GLOBALS['forward_a_post']);
        break;

        case "change_telegram_channel_five" :
            user_position("changeTelegramChannelFive");
            show_message($GLOBALS['forward_a_post']);
        break;

        ############ CHANGE TELEGRAM CHANNEL STATUS 
        case "change_telegram_channel_one_status" :

            if ($telegram_channel_one_status == "فعال")
            {
                update_query("telegram_channel_one_status", "غیر فعال", answer_callback_query("🚫 غیر فعال شد"));
                user_position("changeTelegramChannelStatus");
            }
            else 
            {
                update_query("telegram_channel_one_status", "فعال", answer_callback_query("✅ فعال شد"));
                user_position("changeTelegramChannelStatus");
            }
        break;

        case "change_telegram_channel_two_status" :

            if ($telegram_channel_two_status == "فعال")
            {
                update_query("telegram_channel_two_status", "غیر فعال", answer_callback_query("🚫 غیر فعال شد"));
                user_position("changeTelegramChannelStatus");
            }
            else 
            {
                update_query("telegram_channel_two_status", "فعال", answer_callback_query("✅ فعال شد"));
                user_position("changeTelegramChannelStatus");
            }
        break;

        case "change_telegram_channel_three_status" :

            if ($telegram_channel_three_status == "فعال")
            {
                update_query("telegram_channel_three_status", "غیر فعال", answer_callback_query("🚫 غیر فعال شد"));
                user_position("changeTelegramChannelStatus");
            }
            else 
            {
                update_query("telegram_channel_three_status", "فعال", answer_callback_query("✅ فعال شد"));
                user_position("changeTelegramChannelStatus");
            }
        break;

        case "change_telegram_channel_four_status" :
            
            if ($telegram_channel_four_status == "فعال")
            {
                update_query("telegram_channel_four_status", "غیر فعال", answer_callback_query("🚫 غیر فعال شد"));
                user_position("changeTelegramChannelStatus");
            }
            else 
            {
                update_query("telegram_channel_four_status", "فعال", answer_callback_query("✅ فعال شد"));
                user_position("changeTelegramChannelStatus");
            }
        break;

        case "change_telegram_channel_five_status" :

            if ($telegram_channel_four_status == "فعال")
            {
                update_query("telegram_channel_five_status", "غیر فعال", answer_callback_query("🚫 غیر فعال شد"));
                user_position("changeTelegramChannelStatus");
            }
            else 
            {
                update_query("telegram_channel_five_status", "فعال", answer_callback_query("✅ فعال شد"));
                user_position("changeTelegramChannelStatus");
            }
            
        break;

        # DELETE TELEGRAM CHANNEL 
        case "delete_telegram_channel_one" :
            if ($telegram_channel_one != "")
            {
                $result = delete_telegram_channel("telegram_channel_one", "telegram_channel_one_title");
            
                if ($result)
                {
                    user_position("deleteTelegramChannel");
                }
            }
            else 
            {
                answer_callback_query($GLOBALS['channel_not_exists']);
            }
        break;

        case "delete_telegram_channel_two" :
            if ($telegram_channel_two != "")
            {
                $result = delete_telegram_channel("telegram_channel_two", "telegram_channel_two_title");
            
                if ($result)
                {
                    user_position("deleteTelegramChannel");
                }
            }
            else 
            {
                answer_callback_query($GLOBALS['channel_not_exists']);
            }
        break;

        case "delete_telegram_channel_three" :
            if ($telegram_channel_three != "")
            {
                $result = delete_telegram_channel("telegram_channel_three", "telegram_channel_three_title");
            
                if ($result)
                {
                    user_position("deleteTelegramChannel");
                }
            }
            else 
            {
                answer_callback_query($GLOBALS['channel_not_exists']);
            }
        break;

        case "delete_telegram_channel_four" :
            if ($telegram_channel_four != "")
            {
                $result = delete_telegram_channel("telegram_channel_four", "telegram_channel_four_title");
            
                if ($result)
                {
                    user_position("deleteTelegramChannel");
                }
            }
            else 
            {
                answer_callback_query($GLOBALS['channel_not_exists']);
            }
        break;

        case "delete_telegram_channel_five" :
            if ($telegram_channel_five != "")
            {
                $result = delete_telegram_channel("telegram_channel_five", "telegram_channel_five_title");
        
                if ($result)
                {
                    user_position("deleteTelegramChannel");
                }
            }
            else 
            {
                answer_callback_query($GLOBALS['channel_not_exists']);
            }
        break;


        # SELECT EITAA CHANNEL
        case "select_eitaa_channel_one" :
            select_eitaa_channel($eitaa_channel_one, $eitaa_channel_one_title);
        break;

        case "select_eitaa_channel_two" :
            select_eitaa_channel($eitaa_channel_two, $eitaa_channel_two_title);
        break;

        case "select_eitaa_channel_three" :
            select_eitaa_channel($eitaa_channel_three, $eitaa_channel_three_title);
        break;

        case "select_eitaa_channel_four" :
            select_eitaa_channel($eitaa_channel_four, $eitaa_channel_four_title);
        break;

        case "select_eitaa_channel_five" :
            select_eitaa_channel($eitaa_channel_five, $eitaa_channel_five_title);
        break;

    }
}