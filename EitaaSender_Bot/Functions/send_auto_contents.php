<?php

function send_auto_contents()
{
    $sql = mysqli_query($GLOBALS['conn'], "SELECT * FROM users WHERE telegram_channel_one LIKE '{$GLOBALS['channel_chat_id']}'
    OR telegram_channel_two LIKE '{$GLOBALS['channel_chat_id']}' 
    OR telegram_channel_three LIKE '{$GLOBALS['channel_chat_id']}' 
    OR telegram_channel_four LIKE '{$GLOBALS['channel_chat_id']}' 
    OR telegram_channel_five LIKE '{$GLOBALS['channel_chat_id']}'");

    foreach ($sql as $row)
    {
        $user_id = $row["chat_id"];
        $eitaa_token = $row["eitaa_token"];

        $eitaa_channel_one = $row["eitaa_channel_one"];
        $eitaa_channel_two = $row["eitaa_channel_two"];
        $eitaa_channel_three = $row["eitaa_channel_three"];
        $eitaa_channel_four = $row["eitaa_channel_four"];
        $eitaa_channel_five = $row["eitaa_channel_five"];

        $telegram_channel_one = $row["telegram_channel_one"];
        $telegram_channel_two = $row["telegram_channel_two"];
        $telegram_channel_three = $row["telegram_channel_three"];
        $telegram_channel_four = $row["telegram_channel_four"];
        $telegram_channel_five = $row["telegram_channel_five"];

        $telegram_channel_one_status = $row["telegram_channel_one_status"];
        $telegram_channel_two_status = $row["telegram_channel_two_status"];
        $telegram_channel_three_status = $row["telegram_channel_three_status"];
        $telegram_channel_four_status = $row["telegram_channel_four_status"];
        $telegram_channel_five_status = $row["telegram_channel_five_status"];
    }

    if ($GLOBALS['channel_chat_id'] == "$telegram_channel_one")
    {
        $telegram_channel = $eitaa_channel_one;
        if ($telegram_channel_one_status == "فعال")
        $telegram_channel_status = "فعال"; 
    }

    else if ($GLOBALS['channel_chat_id'] == "$telegram_channel_two")
    {
        $telegram_channel = $eitaa_channel_two;
        if ($telegram_channel_two_status == "فعال")
        $telegram_channel_status = "فعال"; 
    }

    else if ($GLOBALS['channel_chat_id'] == "$telegram_channel_three")
    {
        $telegram_channel = $eitaa_channel_three;
        if ($telegram_channel_three_status == "فعال")
        $telegram_channel_status = "فعال"; 
    }

    else if ($GLOBALS['channel_chat_id'] == "$telegram_channel_four")
    {
        $telegram_channel = $eitaa_channel_four;
        if ($telegram_channel_four_status == "فعال")
        $telegram_channel_status = "فعال"; 
    }

    else if ($GLOBALS['channel_chat_id'] == "$telegram_channel_five")
    {
        $telegram_channel = $eitaa_channel_five;
        if ($telegram_channel_five_status == "فعال")
        $telegram_channel_status = "فعال"; 
    }


    if ($telegram_channel_status == "فعال")
    {
        if ($eitaa_token != "")
        {
            if ($eitaa_channel_one != "" || $eitaa_channel_two != "" || $eitaa_channel_three != "" || $eitaa_channel_four != "" || $eitaa_channel_five != "")
            {
                # TEXT
                if ($GLOBALS["channel_post_text"])
                {
                    auto_send_message_to_eitaa("متن", $eitaa_token, $telegram_channel, $GLOBALS['channel_post_text'], $user_id);

                }

                
                # LOCATION
                else if ($GLOBALS["channel_post_location"])
                {
                    $location = "🗺موقعیت مکانی:\nhttps://maps.google.com/maps?q={$GLOBALS['channel_post_location_latitude']},{$GLOBALS['channel_post_location_longitude']}";
                    auto_send_message_to_eitaa("موقعیت مکانی", $eitaa_token, $telegram_channel, $location, $user_id);
                }

                # PHOTO
                else if ($GLOBALS["channel_post_photo"])
                {
                    global $update_array;
                    $diff_size_count = sizeof($update_array["channel_post"]["photo"]);

                    for($i=$diff_size_count-1; $i>=0; $i--)
                    {
                        $channel_post_photo_size = $update_array["channel_post"]["photo"][$i]["file_size"];
                        if($channel_post_photo_size < 1000000) // 1 MB
                        {
                            $channel_post_photo_id = $update_array["channel_post"]["photo"][$i]["file_id"];
                            break;
                        }
                    }

                    $file_name = "photo_".time().".jpg";
                    $url = get_download_url($channel_post_photo_id); $time = time();
                    $file_path = download_file($url, $file_name); $get_time = time()-$time;
                    auto_send_files_to_eitaa("تصویر", $eitaa_token, $telegram_channel, $file_path, $GLOBALS['channel_post_caption'], $get_time, $user_id);
                    
                }

                # STICKER
                else if ($GLOBALS['channel_post_sticker'])
                {
                    if ($GLOBALS['channel_post_sticker_size'] < 20971520)
                    {
                        $file_name = "sticker_".time().".webp";
                        $url = get_download_url($GLOBALS['channel_post_sticker_id']); $time = time();
                        $file_path = download_file($url, $file_name); $get_time = time()-$time;
                        auto_send_files_to_eitaa("استیکر", $eitaa_token, $telegram_channel, $file_path, "", $get_time, $user_id);
                    }
                }

                # VIDEO
                else if ($GLOBALS['channel_post_video'])
                {
                    if ($GLOBALS['channel_post_video_size'] < 20971520)
                    {
                        $file_name = "video_".time().".mp4";
                        $url = get_download_url($GLOBALS['channel_post_video_id']); $time = time();
                        $file_path = download_file($url, $file_name); $get_time = time()-$time;
                        auto_send_files_to_eitaa("ویدئو", $eitaa_token, $telegram_channel, $file_path, $GLOBALS['channel_post_caption'], $get_time, $user_id);
                    }
                }

                # VIDEO NOTE
                else if ($GLOBALS['channel_post_videonote'])
                {
                    if ($GLOBALS['channel_post_videonote_size'] < 20971520)
                    {
                        $file_name = "videonote_".time().".mp4";
                        $url = get_download_url($GLOBALS['channel_post_videonote_id']); $time = time();
                        $file_path = download_file($url, $file_name); $get_time = time()-$time;
                        auto_send_files_to_eitaa("پیام ویدئویی", $eitaa_token, $telegram_channel, $file_path, $GLOBALS['channel_post_caption'], $get_time, $user_id);
                    }
                }

                # ANIMATION
                else if ($GLOBALS['channel_post_animation'])
                {
                    if ($GLOBALS['channel_post_animation_size'] < 20971520)
                    {
                        $file_name = "animation_".time().".gif";
                        $url = get_download_url($GLOBALS['channel_post_animation_id']); $time = time();
                        $file_path = download_file($url, $file_name); $get_time = time()-$time;
                        auto_send_files_to_eitaa("گیف", $eitaa_token, $telegram_channel, $file_path, $GLOBALS['channel_post_caption'], $get_time, $user_id);
                    }
                }

                # AUDIO
                else if ($GLOBALS['channel_post_audio'])
                {
                    if ($GLOBALS['channel_post_audio_size'] < 20971520)
                    {
                        $file_name = $GLOBALS['$channel_post_audio_performer']." - ".$GLOBALS['$channel_post_audio_title'].".mp3";
                        $url = get_download_url($GLOBALS['channel_post_audio_id']); $time = time();
                        $file_path = download_file($url, $file_name); $get_time = time()-$time;
                        auto_send_files_to_eitaa("موسیقی", $eitaa_token, $telegram_channel, $file_path, $GLOBALS['channel_post_caption'], $get_time, $user_id);
                    } 
                }

                # VOICE
                else if ($GLOBALS['channel_post_voice'])
                {
                    if ($GLOBALS['channel_post_voice_size'] < 20971520)
                    {
                        $file_name = "voice_".time().".ogg";
                        $url = get_download_url($GLOBALS['channel_post_voice_id']); $time = time();
                        $file_path = download_file($url, $file_name); $get_time = time()-$time;
                        auto_send_files_to_eitaa("پیام صوتی", $eitaa_token, $telegram_channel, $file_path, $GLOBALS['channel_post_caption'], $get_time, $user_id);
                    }
                }

                # DOCUMENT
                else if ($GLOBALS['channel_post_file'])
                {
                    if ($GLOBALS['channel_post_file_size'] < 20971520)
                    {
                        $file_name = $GLOBALS['channel_post_file_name'];
                        $url = get_download_url($GLOBALS['channel_post_file_id']); $time = time();
                        $file_path = download_file($url, $file_name); $get_time = time()-$time;
                        auto_send_files_to_eitaa("فایل", $eitaa_token, $telegram_channel, $file_path, $GLOBALS['channel_post_caption'], $get_time, $user_id);
                    }
                }

                else
                {
                    auto_send_message_to_eitaa("⚠️ متاسفانه ایتا از این نوع رسانه پشتیبانی نمی کند", $user_id);
                }
                
            }
            else 
            {
                auto_report_message("شما هیچ کانال ایتایی جهت انتقال خودکار محتوا ثبت نکرده اید!", $user_id);
            }
        }
        else
        {
            auto_report_message("جهت انتقال خودکار محتوا لطفا توکن ایتایار خود را ثبت کنید", $user_id);
        }
    }
}


//-----------------------------------------------

function auto_send_message_to_eitaa($content_type, $eitaa_token, $eitaa_channel, $needle, $user_id)
{
    $time = time();
    $url = $GLOBALS["eitaa_bot_url"] . $eitaa_token . "/sendMessage";
    $post_params = [
        "chat_id" => $eitaa_channel,
        "text" => $needle
    ];
    $send_result = send_to_eitaa($url, $post_params);
    $result_array = json_decode($send_result, true);
    $error = json_last_error();
    $send_time = time()-$time;

    auto_check_result_and_reply($result_array, $send_time, $content_type, $error, $user_id, $eitaa_channel);
}

function auto_send_files_to_eitaa($content_type, $eitaa_token, $eitaa_channel, $file_path, $caption, $get_time, $user_id)
{
    $time = time();
    $url = $GLOBALS["eitaa_bot_url"] . $eitaa_token . "/sendFile";
    $post_params = [
        "chat_id" => $eitaa_channel,
        "file" => new CURLFILE(realpath($file_path)),
        "caption" => $caption
    ];
    $send_result = send_to_eitaa($url, $post_params);
    $result_array = json_decode($send_result, true);
    $error = json_last_error();
    $send_time = time()-$time;
    $result_time = $get_time + $send_time;

    auto_check_result_and_reply($result_array, $result_time, $content_type, $error, $user_id, $eitaa_channel);
}

// ------------------------------------

function auto_check_result_and_reply($result_array, $send_time, $content_type, $error, $user_id, $eitaa_channel)
{
    $json_error_codes = array(1,2,3,4,5,6,7,8,9);

    if ($result_array["ok"])
    {
        auto_report_message("✅$content_type منتقل شد\n⌛️زمان انتقال: $send_time ثانیه\n\n🔹از کانال: {$GLOBALS['channel_chat_title']}\n🔸به کانال: $eitaa_channel", $user_id);
    }
  
    else if (in_array($error, $json_error_codes))
    {
        auto_report_message("🚫متاسفانه $content_type منتقل نشد!\nدر ارسال به ایتا خطایی پیش آمد!\nJsonErrorCode: $error\n".json_last_error_msg(), $user_id);
    }
  
    else if (strpos($result_array["description"], "Unauthorized") !== false)
    {
        auto_report_message("🚫متاسفانه $content_type منتقل نشد!\nبه نظر می آید توکن ایتایار شما منقضی شده است لطفا آخرین توکن تولید شده در سایت اتایار را در ربات ثبت کنید", $user_id);
    }
  
    else if (strpos($result_array["description"], "chat") !== false)
    {
        auto_report_message("🚫متاسفانه $content_type منتقل نشد!\nبه نظر می آید کانال ایتا حذف شده باشد لطفا در همین ربات و پیامرسان ایتا و همچنین در سایت ایتایار وضعیت کانال خود را بررسی کنید.\neitaayar.ir", $user_id);
    }
  
    else if (strpos($result_array["description"], "member") !== false)
    {
        auto_report_message("🚫متاسفانه $content_type منتقل نشد!\nبنظر می آید ربات Sender در کانال ایتایی ادمین نیست! لطفا این ربات را در کانال خود ادمین کرده و سپس در سایت ایتایار در بخش «کانال ها» وضعیت کانال خود را بررسی کنید", $user_id);
    }
  
    else if (strpos($result_array["description"], "file") !== false)
    {
        auto_report_message("🚫متاسفانه $content_type منتقل نشد!\nدر ارسال به ایتا خطایی پیش آمد!\nfile invalid!", $user_id);
    }
  
    else 
    {
        auto_report_message("🚫متاسفانه $content_type منتقل نشد!\nخطای ناشناخته ای رخ داد!", $user_id);
    }

}

function auto_report_message($message, $chat_id)
{
    if ($GLOBALS['channel_chat_username'] != "")
    {
        auto_select_keyboard($message, "report_message_public_keyboard_options", $chat_id);

    }
  
    else
    {
        auto_select_keyboard($message, "report_message_private_keyboard_options", $chat_id);

    }
}

function auto_select_keyboard($message, $inline, $chat_id)
{
  $json_kb = json_encode($GLOBALS["$inline"]);
  $url = $GLOBALS['telegram_bot_url'] . "/sendMessage";
  $post_params = [
      "chat_id" => $chat_id,
      "text" => $message,
      "reply_markup" => $json_kb
  ];
  send_to_telegram($url, $post_params);
}

