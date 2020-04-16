<?php 
/**
 * نمونه ربات پیشرفته انتقال محتوا از تلگرام به ایتا.
 * نسخه 2.0
 *
 * کپی رایت - 2020 - پوریا ب
 *
 * این فایل یک ربات تلگرامی جهت انتقال محتوا می باشد
 * این برنامه رایگان می باشد و شما میتوانید آن را طبق شرایط کپی رایت ویرایش و استفاده نمایید (GNU Affero General Public License version 3 طبق شرایط)
 * امیدواریم این برنامه مفید واقع شود
 *
 * @author    Pouria B <po.pooria@gmail.com>
 * @copyright 2020 - Pouria B <po.pooria@gmail.com>
 * @license   https://opensource.org/licenses/AGPL-3.0 AGPLv3
 *
 * @link https://eitaa.com/Anonymous_Devz ارتباط با برنامه نویس در پیامرسان ایتا
 * @link https://t.me/EitaaSender_Bot     آیدی ربات نمونه انتقال محتوا در تلگرام
 *
 * راهنمای استفاده از این سورس در فایل 
 * Help.txt
 * قرار دارد
 */

require("connection.php");
require("variables.php");

require("Functions/account.php");
require("Functions/bot_help.php");
require("Functions/callback_data.php");
require("Functions/change_text.php");
require("Functions/curl.php");
require("Functions/eitaa_channel.php");
require("Functions/eitaa_token.php");
require("Functions/public.php");
require("Functions/send_direct_contents.php");
require("Functions/send_auto_contents.php");
require("Functions/signature.php");
require("Functions/telegram_channel.php");

$telegram_bot_url = "https://api.telegram.org/bot[********TOKEN********]";
$telegram_bot_dl_url = "https://api.telegram.org/file/[********TOKEN********]";
$eitaa_bot_url = "https://eitaayar.ir/api/";

$update = file_get_contents("php://input");
$update_array = json_decode($update, true);

if (isset($update_array["callback_query"]))
{
    $data              = $update_array["callback_query"]["data"];
    $callback_query_id = $update_array["callback_query"]["id"];
    $chat_id           = $update_array["callback_query"]["message"]["chat"]["id"];

    detect_callback_received();
}
else if (isset($update_array["message"]))
{
    $text                           = $update_array["message"]["text"];
    $chat_id                        = $update_array["message"]["chat"]["id"];
    $first_name                     = $update_array["message"]["chat"]["first_name"];
    $last_name                      = $update_array["message"]["chat"]["last_name"];
    $user_name                      = $update_array["message"]["chat"]["username"];
    $reply_to_message_id            = $update_array["message"]["message_id"];
    $from_id                        = $update_array["message"]["from"]["id"];
  
    $message_file_id                = $update_array["message"]["document"]["file_id"];
    $message_file_size              = $update_array["message"]["document"]["file_size"];
    $message_file_name              = $update_array["message"]["document"]["file_name"];
  
    $message_audio_id               = $update_array["message"]["audio"]["file_id"];
    $message_audio_size             = $update_array["message"]["audio"]["file_size"];
    $message_audio_title            = $update_array["message"]["audio"]["title"];
    $message_audio_performer        = $update_array["message"]["audio"]["performer"];
  
    $message_voice_id               = $update_array["message"]["voice"]["file_id"];
    $message_voice_size             = $update_array["message"]["voice"]["file_size"];
  
    $message_video_id               = $update_array["message"]["video"]["file_id"];
    $message_video_size             = $update_array["message"]["video"]["file_size"];
  
    $message_sticker_id             = $update_array["message"]["sticker"]["file_id"];
    $message_sticker_size           = $update_array["message"]["sticker"]["file_size"];
  
    $message_location_latitude      = $update_array["message"]["location"]["latitude"];
    $message_location_longitude     = $update_array["message"]["location"]["longitude"];
  
    $message_photo_id               = $update_array["message"]["photo"]["file_id"];
    $message_photo_size             = $update_array["message"]["photo"]["file_size"];
  
    $message_photo_id               = $update_array["message"]["photo"]["file_id"];
    $message_photo_size             = $update_array["message"]["photo"]["file_size"];
  
    $message_animation_id           = $update_array["message"]["animation"]["file_id"];
    $message_animation_size         = $update_array["message"]["animation"]["file_size"];
  
    $message_videonote_id           = $update_array["message"]["video_note"]["file_id"];
    $message_videonote_size         = $update_array["message"]["video_note"]["file_size"];
  
    $message_document               = $update_array["message"]["document"];
    $message_photo                  = $update_array["message"]["photo"];
    $message_sticker                = $update_array["message"]["sticker"];
    $message_location               = $update_array["message"]["location"];
    $message_video                  = $update_array["message"]["video"];
    $message_videonote              = $update_array["message"]["video_note"];
    $message_animation              = $update_array["message"]["animation"];
    $message_voice                  = $update_array["message"]["voice"];
    $message_audio                  = $update_array["message"]["audio"];
    $message_caption                = $update_array["message"]["caption"];
  
    // اطلاعات کانال یا گروه
    $forward_from_chat_id           = $update_array["message"]["forward_from_chat"]["id"];
    $forward_from_chat_username     = $update_array["message"]["forward_from_chat"]["username"];
    $forward_from_chat_title        = $update_array["message"]["forward_from_chat"]["title"];
    $forward_from_chat_message_id   = $update_array["message"]["forward_from_message_id"];
    $forward_from_chat_type         = $update_array["message"]["forward_from_chat"]["type"];
}
else if (isset($update_array["channel_post"]))
{
    $channel_message_id           = $update_array["channel_post"]["message_id"];
    $channel_chat_id              = $update_array["channel_post"]["chat"]["id"];
    $channel_chat_title           = $update_array["channel_post"]["chat"]["title"];
    $channel_chat_username        = $update_array["channel_post"]["chat"]["username"];
    $channel_chat_type            = $update_array["channel_post"]["chat"]["type"];
    $channel_post_text            = $update_array["channel_post"]["text"];
    $channel_post_caption         = $update_array["channel_post"]["caption"];
  
    $channel_post_photo           = $update_array["channel_post"]["photo"];
    $channel_post_photo_id        = $update_array["channel_post"]["photo"]["file_id"];
    $channel_post_photo_size      = $update_array["channel_post"]["photo"]["file_size"];
  
    $channel_post_sticker         = $update_array["channel_post"]["sticker"];
    $channel_post_sticker_id      = $update_array["channel_post"]["sticker"]["file_id"];
    $channel_post_sticker_size    = $update_array["channel_post"]["sticker"]["file_size"];
  
    $channel_post_video           = $update_array["channel_post"]["video"];
    $channel_post_video_id        = $update_array["channel_post"]["video"]["file_id"];
    $channel_post_video_size      = $update_array["channel_post"]["video"]["file_size"];
  
    $channel_post_videonote       = $update_array["channel_post"]["video_note"];
    $channel_post_videonote_id    = $update_array["channel_post"]["video_note"]["file_id"];
    $channel_post_videonote_size  = $update_array["channel_post"]["video_note"]["file_size"];

    $channel_post_animation       = $update_array["channel_post"]["animation"];
    $channel_post_animation_id    = $update_array["channel_post"]["animation"]["file_id"];
    $channel_post_animation_size  = $update_array["channel_post"]["animation"]["file_size"];
  
    $channel_post_voice           = $update_array["channel_post"]["voice"];
    $channel_post_voice_id        = $update_array["channel_post"]["voice"]["file_id"];
    $channel_post_voice_size      = $update_array["channel_post"]["voice"]["file_size"];
  
    $channel_post_audio           = $update_array["channel_post"]["audio"];
    $channel_post_audio_title     = $update_array["channel_post"]["audio"]["title"];
    $channel_post_audio_performer = $update_array["channel_post"]["audio"]["performer"];
    $channel_post_audio_id        = $update_array["channel_post"]["audio"]["file_id"];
    $channel_post_audio_size      = $update_array["channel_post"]["audio"]["file_size"];
  
    $channel_post_file            = $update_array["channel_post"]["document"];
    $channel_post_file_id         = $update_array["channel_post"]["document"]["file_id"];
    $channel_post_file_size       = $update_array["channel_post"]["document"]["file_size"];
    $channel_post_file_name       = $update_array["channel_post"]["document"]["file_name"];
  
    $channel_post_location           = $update_array["channel_post"]["location"];
    $channel_post_location_latitude  = $update_array["channel_post"]["location"]["latitude"];
    $channel_post_location_longitude = $update_array["channel_post"]["location"]["longitude"];

    
}

require("Keyboard/reply_markup.php");

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

require("Keyboard/inline_markup.php");

if ($text AND $chat_id == $admin)
{
    if ($text == "/on")
    {
        $set_status = file_put_contents("Text/status.txt", "on");

        if ($set_status)
        show_message($bot_is_now_on);
    }
    else if ($text == "/off")
    {
        $set_status = file_put_contents("Text/status.txt", "off");

        if ($set_status)
        show_message($bot_is_now_off);
    }
}

$status = file_get_contents("Text/status.txt");

if ($status == "on")
{
    if ($black_list == 0)
    {
        # START
        if ($text == "/start")
        {
            if (in_array($chat_id, $admin))
            {
                show_keyboard($admin_keyboard_options, $welcome_to_admin);
            }
            else
            {
                if ($eitaa_token == "")
                {
                    if (!mysqli_num_rows($sql) > 0)
                    {
                        $register = mysqli_query($conn, "INSERT INTO `users` (`id`, `chat_id`, `black_list`, `black_list_reason`, `eitaa_current_channel`, `eitaa_current_channel_title`, `user_position`, `message_id`, `charge_size`, `used_charge`, `notifications`, `delete_tags`, `eitaa_token`, `eitaa_channel_one`, `eitaa_channel_two`, `eitaa_channel_three`, `eitaa_channel_four`, `eitaa_channel_five`, `eitaa_channel_one_title`, `eitaa_channel_two_title`, `eitaa_channel_three_title`, `eitaa_channel_four_title`, `eitaa_channel_five_title`, `telegram_channel_one`, `telegram_channel_two`, `telegram_channel_three`, `telegram_channel_four`, `telegram_channel_five`, `telegram_channel_one_title`, `telegram_channel_two_title`, `telegram_channel_three_title`, `telegram_channel_four_title`, `telegram_channel_five_title`, `telegram_channel_one_status`, `telegram_channel_two_status`, `telegram_channel_three_status`, `telegram_channel_four_status`, `telegram_channel_five_status`, `original_text_one`, `original_text_two`, `original_text_three`, `original_text_four`, `original_text_five`, `alternative_text_one`, `alternative_text_two`, `alternative_text_three`, `alternative_text_four`, `alternative_text_five`, `signature_one`, `signature_two`, `signature_three`, `signature_four`, `signature_five`) 
                        VALUES (NULL, '$chat_id', '0', '', '', '', '', '0', '314572800', '0', 'فعال', 'غیر فعال', '', '', '', '', '', '', 'عنوان', 'عنوان', 'عنوان', 'عنوان', 'عنوان', '', '', '', '', '', 'ثبت کانال', 'ثبت کانال', 'ثبت کانال', 'ثبت کانال', 'ثبت کانال', 'فعال', 'فعال', 'فعال', 'فعال', 'فعال', 'اصلی', 'اصلی', 'اصلی', 'اصلی', 'اصلی', 'جایگزین', 'جایگزین', 'جایگزین', 'جایگزین', 'جایگزین', 'امضا', 'امضا', 'امضا', 'امضا', 'امضا');");
                        
                        if (!$register)
                        {
                            show_message("کاربر عزیز متاسفانه ثبت اکانت شما در ربات با خطا مواجه شد! لطفا به سازنده ربات اطلاع دهید و بعد از برطرف شدن مشکل دوباره دستور /start را لمس کنید");
                        }

                    }
                }
                show_keyboard($users_keyboard_options, $welcome_to_users);
            }
        }

        # AUTO SENDER
        else if ($text == $key_auto_sender)
        {
            if ($eitaa_token != "")
            {
                if ($eitaa_channel_one != "" || $eitaa_channel_two != "" || $eitaa_channel_three != "" || $eitaa_channel_four != "" || $eitaa_channel_five != "")
                {
                    if (in_array($chat_id, $admin))
                    {
                        user_position("autoSender");
                        show_keyboard($auto_sender_keyboard_options, $about_auto_sender);
                    }
                    else 
                    {
                        show_message("این بخش در حال به روز رسانی می باشد.");
                    }
                }
                else 
                {
                    show_message($please_register_channel);
                }
            }
            else 
            {
                show_message($please_register_token);
            }
        }

        # SEND CONTENTS
        else if ($text == $key_send_contents || $text == $key_from_telegram)
        {
            if ($eitaa_token != "")
            {
                if ($eitaa_channel_one != "" || $eitaa_channel_two != "" || $eitaa_channel_three != "" || $eitaa_channel_four != "" || $eitaa_channel_five != "")
                {
                    user_position("sendContents");
                    show_keyboard($send_contents_keyboard_options, $send_contents_message . $eitaa_current_channel_title . " " . $eitaa_current_channel);
                }
                else 
                {
                    show_message($please_register_channel);
                }
            }
            else
            {
                show_message($please_register_token);
            }
        }

        # CHANGE TEXT
        else if ($text == $key_change_text)
        {
            if ($eitaa_token != "")
            {
                if ($eitaa_channel_one != "" || $eitaa_channel_two != "" || $eitaa_channel_three != "" || $eitaa_channel_four != "" || $eitaa_channel_five != "")
                {
                    user_position("changeText");
                    show_keyboard($change_text_keyboard_options, $about_change_text);
                }
                else 
                {
                    show_message($please_register_channel);
                }
            }
            else
            {
                show_message($please_register_token);
            }
        }

        # SIGNATURE
        else if ($text == $key_signature)
        {
            if ($eitaa_token != "")
            {
                if ($eitaa_channel_one != "" || $eitaa_channel_two != "" || $eitaa_channel_three != "" || $eitaa_channel_four != "" || $eitaa_channel_five != "")
                {
                    user_position("signature");
                    show_keyboard($signature_keyboard_options, $about_signature);
                }
                else 
                {
                    show_message($please_register_channel);
                }
            }
            else
            {
                show_message($please_register_token);
            }
        }

        # TOKEN
        else if ($text == $key_register_token)
        {
            user_position("enterEitaaToken");
            show_message($enter_token);
        }

        # CHANNEL
        else if ($text == $key_register_channel)
        {
            user_position("channel");
            show_keyboard($register_channel_keyboard_options, $channel_message);
        }

        # ACCOUNT
        else if ($text == $key_account)
        {
            user_position("account");
            $info = account_information();
            show_message($info);
            //show_keyboard($account_keyboard_options, $info);
        }

        # HELP
        else if ($text == $key_help)
        {
            show_help();
        }

        else if ($text == "/helpGetToken")
        {
            help_get_token();
        }

        else if ($text == "/helpDownloadFromLink")
        {
            help_download_from_link();
        }

        else if ($text == "/helpAutoSender")
        {
            help_auto_sender();
        }

        # BACK
        else if ($text == $key_back)
        {
            if (in_array($chat_id, $admin))
            {
                show_keyboard($admin_keyboard_options, $return_home_page);
            }
            else 
            {
                show_keyboard($users_keyboard_options, $return_home_page);
            }
        }

        # SELECT CHANNEL
        else if ($text == $key_select_channel)
        {
            show_keyboard($select_channel_keyboard_options, $which_channel);
        }

        # FROM LINK
        else if ($text == $key_from_url)
        {
            show_message($in_future);
        }

        # REGISTER EITAA TOKEN
        else if ($user_position == "enterEitaaToken")
        {
            register_eitaa_token();
        }

        # REGISTER EITAA CHANNEL
        else if ($user_position == "enterEitaaChannel")
        {
            register_eitaa_channel();
        }

        # EDIT EITAA CHANNEL
        else if ($user_position == "changeEitaaChannelOne")
        {
            edit_eitaa_channel();
        }

        else if ($user_position == "changeEitaaChannelTwo")
        {
            edit_eitaa_channel();
        }

        else if ($user_position == "changeEitaaChannelThree")
        {
            edit_eitaa_channel();
        }

        else if ($user_position == "changeEitaaChannelFour")
        {
            edit_eitaa_channel();
        }

        else if ($user_position == "changeEitaaChannelFive")
        {
            edit_eitaa_channel();
        }

        # CHANGE EITAA CHANNEL TITLE
        else if ($user_position == "changeEitaaChannelOneTitle")
        {
            register_eitaa_channel_title("eitaa_channel_one_title", "eitaa_current_channel_title");
        }

        else if ($user_position == "changeEitaaChannelTwoTitle")
        {
            register_eitaa_channel_title("eitaa_channel_two_title", "eitaa_current_channel_title");
        }

        else if ($user_position == "changeEitaaChannelThreeTitle")
        {
            register_eitaa_channel_title("eitaa_channel_three_title", "eitaa_current_channel_title");
        }

        else if ($user_position == "changeEitaaChannelFourTitle")
        {
            register_eitaa_channel_title("eitaa_channel_four_title", "eitaa_current_channel_title");
        }

        else if ($user_position == "changeEitaaChannelFiveTitle")
        {
            register_eitaa_channel_title("eitaa_channel_five_title", "eitaa_current_channel_title");
        }

        # DELETE EITAA CHANNEL & EDIT KEYBOARD
        else if ($user_position == "deleteEitaaChannel")
        {
            edit_inline_keyboard("register_channel_keyboard_options");
        }

        # REGISTER SIGNATURE
        else if ($user_position == "changeSignatureOne")
        {
            register_signature("signature_one", $text, $signature_registered);
        }

        else if ($user_position == "changeSignatureTwo")
        {
            register_signature("signature_two", $text, $signature_registered);
        }

        else if ($user_position == "changeSignatureThree")
        {
            register_signature("signature_three", $text, $signature_registered);
        }

        else if ($user_position == "changeSignatureFour")
        {
            register_signature("signature_four", $text, $signature_registered);
        }

        else if ($user_position == "changeSignatureFive")
        {
            register_signature("signature_five", $text, $signature_registered);
        }

        # REGISTER ALTERNATIVE CHANGING TEXT 
        else if ($user_position == "changeAlternativeChangingTextOne")
        {
            register_changing_text("alternative_text_one", $text, $alternative_text_registered);
        }

        else if ($user_position == "changeAlternativeChangingTextTwo")
        {
            register_changing_text("alternative_text_two", $text, $alternative_text_registered);
        }

        else if ($user_position == "changeAlternativeChangingTextThree")
        {
            register_changing_text("alternative_text_three", $text, $alternative_text_registered);
        }

        else if ($user_position == "changeAlternativeChangingTextFour")
        {
            register_changing_text("alternative_text_four", $text, $alternative_text_registered);
        }

        else if ($user_position == "changeAlternativeChangingTextFive")
        {
            register_changing_text("alternative_text_five", $text, $alternative_text_registered);
        }

        # REGISTER ORIGINAL CHANGING TEXT 
        else if ($user_position == "changeOriginalChangingTextOne")
        {
            register_changing_text("original_text_one", $text, $original_text_registered);
        }

        else if ($user_position == "changeOriginalChangingTextTwo")
        {
            register_changing_text("original_text_two", $text, $original_text_registered);
        }

        else if ($user_position == "changeOriginalChangingTextThree")
        {
            register_changing_text("original_text_three", $text, $original_text_registered);
        }

        else if ($user_position == "changeOriginalChangingTextFour")
        {
            register_changing_text("original_text_four", $text, $original_text_registered);
        }

        else if ($user_position == "changeOriginalChangingTextFive")
        {
            register_changing_text("original_text_five", $text, $original_text_registered);
        }

        # REGISTER TELEGRAM CHANNEL
        else if ($user_position == "changeTelegramChannelOne")
        {
            register_telegram_channel("telegram_channel_one", "telegram_channel_one_title");
        }

        else if ($user_position == "changeTelegramChannelTwo")
        {
            register_telegram_channel("telegram_channel_two", "telegram_channel_two_title");
        }

        else if ($user_position == "changeTelegramChannelThree")
        {
            register_telegram_channel("telegram_channel_three", "telegram_channel_three_title");
        }

        else if ($user_position == "changeTelegramChannelFour")
        {
            register_telegram_channel("telegram_channel_four", "telegram_channel_four_title");
        }

        else if ($user_position == "changeTelegramChannelFive")
        {
            register_telegram_channel("telegram_channel_five", "telegram_channel_five_title");
        }

        else if ($user_position == "changeTelegramChannelStatus")
        {
            edit_inline_keyboard("auto_sender_keyboard_options");
        }

        else if ($user_position == "deleteTelegramChannel")
        {
            edit_inline_keyboard("auto_sender_keyboard_options");
        }

        else if ($user_position == "deleteSignature")
        {
            edit_inline_keyboard("signature_keyboard_options");
        }

        else if ($user_position == "deleteChangingText")
        {
            edit_inline_keyboard("change_text_keyboard_options");
        }

        else if ($user_position == "sendContents")
        {
            send_direct_contents();
        }

        # ELSE
        else
        {
            if ($update_array["message"])
            {
                if (in_array($chat_id, $admin))
                {
                    show_keyboard($admin_keyboard_options, $use_keyboard);
                }
                else 
                {
                    show_keyboard($users_keyboard_options, $use_keyboard);
                }

            }
        }

        send_auto_contents();
    }
    else 
    {
        show_message($you_are_blocked . "\nبه علت: $black_list_reason");
    }
}
else 
{
    show_message($bot_updating_message);
}

mysqli_close($conn);