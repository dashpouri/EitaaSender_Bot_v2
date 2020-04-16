<?php 

# SHOW MESSAGE
function show_message($message)
{
    $url = $GLOBALS["telegram_bot_url"] . "/sendMessage";
    $post_params = [
        "chat_id" => $GLOBALS["chat_id"],
        "text" => $message,
        "parse_mode" => "HTML"
    ];
    send_to_telegram($url, $post_params);
}

# REPORT MESSAGE
function report_message($message)
{
    $url = $GLOBALS["telegram_bot_url"] . "/sendMessage";
    $post_params = [
        "chat_id" => $GLOBALS["chat_id"],
        "text" => $message,
        "reply_to_message_id" => $GLOBALS['reply_to_message_id'],
        "parse_mode" => "HTML"
    ];
    send_to_telegram($url, $post_params);
}

# SEND TO ADMIN
function send_to_admin($message)
{
    $url = $GLOBALS["telegram_bot_url"] . "/sendMessage";
    $post_params = [
        "chat_id" => "968552906",
        "text" => $message,
        "parse_mode" => "HTML"
    ];
    send_to_telegram($url, $post_params);
}

# SHOW KEYBOARD
function show_keyboard($keyboard, $message)
{
    $json_kb = json_encode($keyboard);
    $url = $GLOBALS['telegram_bot_url'] . "/sendMessage";
    $post_params = [
        "chat_id" => $GLOBALS["chat_id"],
        "text" => $message,
        "reply_markup" => $json_kb
    ];
    $result = send_to_telegram($url, $post_params);
    $result_array = json_decode($result, true);
    $message_id = $result_array["result"]["message_id"];
    update_query("message_id", $message_id);
}

# SET USER POSITION
function user_position($user_position)
{
    global $conn; 
    global $chat_id;
    $sql = mysqli_query($conn, "UPDATE users SET user_position = '$user_position' WHERE chat_id = $chat_id");
}

# CONVERT NUMBERS 
function convert_numbers($string, $to_persian=false)
{
    $en_numbers = array("1", "2", "3", "4", "5", "6", "7", "8", "9");
    $fa_numbers = array("۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹");

    if (!$to_persian)
    return str_replace($en_numbers, $fa_numbers, $string);

    else 
    return str_replace($fa_numbers, $en_numbers, $string);
}

# UPDATE QUERY
function update_query($row, $value, $message="")
{
    global $conn;
    global $chat_id;
    $result = mysqli_query($conn, "UPDATE users SET $row = '$value' WHERE chat_id = $chat_id");

    if ($result)
    {
        show_message($message);
    }
    else
    {
        show_message($GLOBALS['error']);
    }
}

# EDIT INLINE MARKUP 
function edit_inline_keyboard($keyboard_settings)
{
    $jason_kb = json_encode($GLOBALS["$keyboard_settings"]);
    $url = $GLOBALS['telegram_bot_url'] . "/editMessageReplyMarkup";
    $post_params = [
        "chat_id" => $GLOBALS['chat_id'],
        "message_id" => $GLOBALS['message_id'],
        "reply_markup" => $jason_kb
    ];
    send_to_telegram($url, $post_params);
}

# GET DOWNLOAD URL
function get_download_url($file_id)
{
  $update_array = $GLOBALS['update_array'];
  $url = $GLOBALS['telegram_bot_url'] . "/getFile";
  $post_params = ['file_id'=>$file_id];
  $result = send_to_telegram($url, $post_params);
  $result_array = json_decode($result, true);
  $file_path = $result_array["result"]["file_path"];
  $download_url = $GLOBALS['telegram_bot_dl_url'] . "/$file_path";

  return $download_url;
}

# GET CHAT MEMBER
function get_chat_member($chat_id, $user_id)
{
    $get_chat_member = $GLOBALS["telegram_bot_url"] . "/getChatMember?chat_id=$chat_id&user_id=$user_id";
    $result = file_get_contents($get_chat_member);
    $result_array = json_decode($result, true);
    return $result_array;
}