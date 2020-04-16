<?php

function send_direct_contents()
{
  # TEXT
  if ($GLOBALS['text'])
  {
    $changed_text = change_text($GLOBALS['text']);
    $new_text = add_signature($changed_text);
    send_message_to_eitaa("متن", $new_text, $GLOBALS['used_charge'], $GLOBALS['charge_size']);
  }

  # LOCATION
  else if ($GLOBALS['message_location'])
  {
    $location = "🗺موقعیت مکانی:\nhttps://maps.google.com/maps?q={$GLOBALS['message_location_latitude']},{$GLOBALS['message_location_longitude']}";
    send_message_to_eitaa("موقعیت مکانی", $location, $GLOBALS['used_charge'], $GLOBALS['charge_size']);
  }
  
  # PHOTO
  else if ($GLOBALS['message_photo'])
  {
    global $update_array;
    $diff_size_count = sizeof($update_array["message"]["photo"]);

    for($i=$diff_size_count-1; $i>=0; $i--)
    {
      $photo_size = $update_array["message"]["photo"][$i]["file_size"];

      if($photo_size < 1000000) // 1 MB
      {
        $photo_id = $update_array["message"]["photo"][$i]["file_id"];
        break;
      }
    }
    if ($photo_size < $GLOBALS['charge_size'])
    {
      $file_name = "photo_".time().".jpg";
      $url = get_download_url($photo_id); $time = time();
      $file_path = download_file($url, $file_name); $get_time = time()-$time;
      $changed_text = change_text($GLOBALS['message_caption']);
      $new_text = add_signature($changed_text);
      $total_charge_consumption = $GLOBALS['used_charge'] + $photo_size;
      $charge_remaining = $GLOBALS['charge_size'] - $photo_size;
      send_files_to_eitaa("تصویر", $new_text, $file_path, $get_time, $total_charge_consumption, $charge_remaining);
    
      unlink($file_path);
    }
    else 
    {
      report_message($GLOBALS['charge_not_enough']);
    }
  }

  # STICKER
  else if ($GLOBALS['message_sticker'])
  {
    if ($GLOBALS['message_sticker_size'] < 20971520)
    {    
      if ($GLOBALS['message_sticker_size'] < $GLOBALS['charge_size'])
      {
        $file_name = "sticker_".time().".webp";
        $url = get_download_url($GLOBALS['message_sticker_id']); $time = time();
        $file_path = download_file($url, $file_name); $get_time = time()-$time;
        $total_charge_consumption = $GLOBALS['used_charge'] + $GLOBALS['message_sticker_size'];
        $charge_remaining = $GLOBALS['charge_size'] - $GLOBALS['message_sticker_size'];
        send_files_to_eitaa("استیکر", "", $file_path, $get_time, $total_charge_consumption, $charge_remaining);
      
        unlink($file_path);
      }
      else 
      {
        report_message($GLOBALS['charge_not_enough']);
      }
    }
  }

  # VIDEO
  else if ($GLOBALS['message_video'])
  {
    if ($GLOBALS['message_video_size'] < 20971520)
    {
      if ($GLOBALS['message_video_size'] < $GLOBALS['charge_size'])
      {
        $file_name = "video_".time().".mp4";
        $url = get_download_url($GLOBALS['message_video_id']); $time = time();
        $file_path = download_file($url, $file_name); $get_time = time()-$time;
        $changed_text = change_text($GLOBALS['message_caption']);
        $new_text = add_signature($changed_text);
        $total_charge_consumption = $GLOBALS['used_charge'] + $GLOBALS['message_video_size'];
        $charge_remaining = $GLOBALS['charge_size'] - $GLOBALS['message_video_size'];
        send_files_to_eitaa("ویدئو", $new_text, $file_path, $get_time, $total_charge_consumption, $charge_remaining);
      
        unlink($file_path);
      }
      else
      {
        report_message($GLOBALS['charge_not_enough']);
      }
    }
  }

  # VIDEO NOTE
  else if ($GLOBALS['message_videonote'])
  {
    if ($GLOBALS['message_videonote_size'] < 20971520)
    {
      if ($GLOBALS['message_videonote_size'] < $GLOBALS['charge_size'])
      {
        $file_name = "videonote_".time().".mp4";
        $url = get_download_url($GLOBALS['message_videonote_id']); $time = time();
        $file_path = download_file($url, $file_name); $get_time = time()-$time;
        $changed_text = change_text($GLOBALS['message_caption']);
        $new_text = add_signature($changed_text);
        $total_charge_consumption = $GLOBALS['used_charge'] + $GLOBALS['message_videonote_size'];
        $charge_remaining = $GLOBALS['charge_size'] - $GLOBALS['message_videonote_size'];
        send_files_to_eitaa("پیام ویدئویی", $new_text, $file_path, $get_time, $total_charge_consumption, $charge_remaining);
      
        unlink($file_path);
      }
      else 
      {
        report_message($GLOBALS['charge_not_enough']);
      }
    }
  }

  # ANIMATION
  else if ($GLOBALS['message_animation'])
  {
    if ($GLOBALS['message_animation_size'] < 20971520)
    {
      if ($GLOBALS['message_animation_size'] < $GLOBALS['charge_size'])
      {
        $file_name = "animation_".time().".gif";
        $url = get_download_url($GLOBALS['message_animation_id']); $time = time();
        $file_path = download_file($url, $file_name); $get_time = time()-$time;
        $changed_text = change_text($GLOBALS['message_caption']);
        $new_text = add_signature($changed_text);
        $total_charge_consumption = $GLOBALS['used_charge'] + $GLOBALS['message_animation_size'];
        $charge_remaining = $GLOBALS['charge_size'] - $GLOBALS['message_animation_size'];
        send_files_to_eitaa("گیف", $new_text, $file_path, $get_time, $total_charge_consumption, $charge_remaining);
      
        unlink($file_path);
      }
      else 
      {
        report_message($GLOBALS['charge_not_enough']);
      } 
    }
  }

  # AUDIO
  else if ($GLOBALS['message_audio'])
  {
    if ($GLOBALS['message_audio_size'] < 20971520)
    {
      if ($GLOBALS['message_audio_size'] < $GLOBALS['charge_size'])
      {
        $file_name = $GLOBALS['message_audio_performer']." - ".$GLOBALS['message_audio_title'].".mp3";
        $url = get_download_url($GLOBALS['message_audio_id']); $time = time();
        $file_path = download_file($url, $file_name); $get_time = time()-$time;
        $changed_text = change_text($GLOBALS['message_caption']);
        $new_text = add_signature($changed_text);
        $total_charge_consumption = $GLOBALS['used_charge'] + $GLOBALS['message_audio_size'];
        $charge_remaining = $GLOBALS['charge_size'] - $GLOBALS['message_audio_size'];
        send_files_to_eitaa("موسیقی", $new_text, $file_path, $get_time, $total_charge_consumption, $charge_remaining);
        
        unlink($file_path);
      }
      else 
      {
        report_message($GLOBALS['charge_not_enough']);
      }
    }
  }

  # VOICE
  else if ($GLOBALS['message_voice'])
  {
    if ($GLOBALS['message_voice_size'] < 20971520)
    {
      if ($GLOBALS['message_voice_size'] < $GLOBALS['charge_size'])
      {
        $file_name = "voice_".time().".ogg";
        $url = get_download_url($GLOBALS['message_voice_id']); $time = time();
        $file_path = download_file($url, $file_name); $get_time = time()-$time;
        $changed_text = change_text($GLOBALS['message_caption']);
        $new_text = add_signature($changed_text);
        $total_charge_consumption = $GLOBALS['used_charge'] + $GLOBALS['message_voice_size'];
        $charge_remaining = $GLOBALS['charge_size'] - $GLOBALS['message_voice_size'];
        send_files_to_eitaa("پیام صوتی", $new_text, $file_path, $get_time, $total_charge_consumption, $charge_remaining);
     
        unlink($file_path);
      }
      else 
      {
        report_message($GLOBALS['charge_not_enough']);
      }
    }
  }

  # DOCUMENT
  else if ($GLOBALS['message_document'])
  {
    if ($GLOBALS['message_file_size'] < 20971520)
    {
      if ($GLOBALS['message_file_size'] < $GLOBALS['charge_size'])
      {
        $file_name = $GLOBALS['message_file_name'];
        $url = get_download_url($GLOBALS['message_file_id']); $time = time();
        $file_path = download_file($url, $file_name); $get_time = time()-$time;
        $changed_text = change_text($GLOBALS['message_caption']);
        $new_text = add_signature($changed_text);
        $total_charge_consumption = $GLOBALS['used_charge'] + $GLOBALS['message_file_size'];
        $charge_remaining = $GLOBALS['charge_size'] - $GLOBALS['message_file_size'];
        send_files_to_eitaa("فایل", $new_text, $file_path, $get_time, $total_charge_consumption, $charge_remaining);
      
        unlink($file_path);
      }
      else 
      {
        report_message($GLOBALS['charge_not_enough']);
      }
    }
  }

  else if ($GLOBALS['data'])
  {
    // Nothing : )
  }

  else 
  {
    report_message("⚠️ متاسفانه ایتا از این نوع رسانه پشتیبانی نمی کند");
  }
}

# SEND TEXT & LOCATION
function send_message_to_eitaa($content_type, $needle, $total_charge_consumption, $charge_remaining)
{
  $time = time();
  $url = $GLOBALS["eitaa_bot_url"] . $GLOBALS["eitaa_token"] . "/sendMessage";
  $post_params = [
    "chat_id" => $GLOBALS["eitaa_current_channel"], 
    "text" => $needle,
  ];
  $send_result = send_to_eitaa($url, $post_params);
  $result_array = json_decode($send_result, true);
  $error = json_last_error();
  $send_time = time()-$time;

  check_result_and_reply($result_array, $send_time, $content_type, $error, $total_charge_consumption, $charge_remaining);
}

function send_files_to_eitaa($content_type, $needle, $file_path, $get_time, $total_charge_consumption, $charge_remaining)
{
  $time = time();
  $url = $GLOBALS["eitaa_bot_url"] . $GLOBALS["eitaa_token"] . "/sendFile";
  $post_params = [
    "chat_id" => $GLOBALS["eitaa_current_channel"], 
    "file" => new CURLFILE(realpath($file_path)),
    "caption" => $needle,
  ];
  $send_result = send_to_eitaa($url, $post_params);
  $result_array = json_decode($send_result, true);
  $error = json_last_error();
  $send_time = time()-$time;
  $result_time = $get_time + $send_time;

  check_result_and_reply($result_array, $result_time, $content_type, $error, $total_charge_consumption, $charge_remaining);
}

# CHECK RESULT
function check_result_and_reply($result_array, $send_time, $content_type, $error, $total_charge_consumption, $charge_remaining)
{
  $json_error_codes = array(1,2,3,4,5,6,7,8,9);

  if ($result_array["ok"])
  {
    report_message("✅$content_type منتقل شد\n⌛️زمان انتقال: $send_time ثانیه");
    mysqli_query($GLOBALS['conn'], "UPDATE users SET used_charge = '$total_charge_consumption', charge_size = '$charge_remaining'");
  }

  else if (in_array($error, $json_error_codes))
  {
    report_message("🚫متاسفانه $content_type منتقل نشد!\nدر ارسال به ایتا خطایی پیش آمد!\nJsonErrorCode: $error\n".json_last_error_msg());
  }

  else if (strpos($result_array["description"], "Unauthorized") !== false)
  {
    report_message("🚫متاسفانه $content_type منتقل نشد!\nبه نظر می آید توکن ایتایار شما منقضی شده است لطفا آخرین توکن تولید شده در سایت اتایار را در ربات ثبت کنید");
  }

  else if (strpos($result_array["description"], "chat") !== false)
  {
    report_message("🚫متاسفانه $content_type منتقل نشد!\nبه نظر می آید کانال ایتا حذف شده باشد لطفا در همین ربات و پیامرسان ایتا و همچنین در سایت ایتایار وضعیت کانال خود را بررسی کنید.\neitaayar.ir");
  }

  else if (strpos($result_array["description"], "member") !== false)
  {
    report_message("🚫متاسفانه $content_type منتقل نشد!\nبنظر می آید ربات Sender در کانال ایتایی ادمین نیست! لطفا این ربات را در کانال خود ادمین کرده و سپس در سایت ایتایار در بخش «کانال ها» وضعیت کانال خود را بررسی کنید");
  }

  else if (strpos($result_array["description"], "file") !== false)
  {
    report_message("🚫متاسفانه $content_type منتقل نشد!\nدر ارسال به ایتا خطایی پیش آمد!\nfile invalid!");
  }

  else 
  {
    report_message("🚫متاسفانه $content_type منتقل نشد!\nخطای ناشناخته ای رخ داد!");
  }
}
