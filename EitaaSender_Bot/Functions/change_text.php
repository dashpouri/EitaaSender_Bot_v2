<?php 

# REGISTER CHANGING TEXT
function register_changing_text($row, $value, $message)
{
    if ($GLOBALS['text'])
    {
        update_query($row, $value, $message);
        user_position("registeredChangingText");
    }
}

# DELETE CHANGING TEXT
function delete_changing_text($original, $alternative)
{
    $result = mysqli_query($GLOBALS['conn'], "UPDATE users SET $original = 'اصلی',
    $alternative = 'جایگزین' WHERE chat_id = {$GLOBALS['chat_id']}");

    if ($result)
    {
        user_position($GLOBALS['position_delete_changing_text']);
        answer_callback_query($GLOBALS['changing_text_deleted']);
        return true;
    }
    else 
    {
        answer_callback_query($GLOBALS['error']);
    }
}

# CHANGE TEXT
function change_text($text)
{
    // 1
    if ($GLOBALS['eitaa_current_channel'] == $GLOBALS['eitaa_channel_one'] && $GLOBALS['original_text_one'] != "اصلی" && $GLOBALS['alternative_text_one'] != "جایگزین")
    $changed_text = str_ireplace($GLOBALS['original_text_one'], $GLOBALS['alternative_text_one'], $text);

    // 2
    else if ($GLOBALS['eitaa_current_channel'] == $GLOBALS['eitaa_channel_two'] && $GLOBALS['original_text_two'] != "اصلی" && $GLOBALS['alternative_text_two'] != "جایگزین")
    $changed_text = str_ireplace($GLOBALS['original_text_two'], $GLOBALS['alternative_text_two'], $text);

    // 3
    else if ($GLOBALS['eitaa_current_channel'] == $GLOBALS['eitaa_channel_three'] && $GLOBALS['original_text_three'] != "اصلی" && $GLOBALS['alternative_text_three'] != "جایگزین")
    $changed_text = str_ireplace($GLOBALS['original_text_three'], $GLOBALS['alternative_text_three'], $text);

    // 4
    else if ($GLOBALS['eitaa_current_channel'] == $GLOBALS['eitaa_channel_four'] && $GLOBALS['original_text_four'] != "اصلی" && $GLOBALS['alternative_text_four'] != "جایگزین")
    $changed_text = str_ireplace($GLOBALS['original_text_four'], $GLOBALS['alternative_text_four'], $text);
   
    // 5
    else if ($GLOBALS['eitaa_current_channel'] == $GLOBALS['eitaa_channel_five'] && $GLOBALS['original_text_five'] != "اصلی" && $GLOBALS['alternative_text_five'] != "جایگزین")
    $changed_text = str_ireplace($GLOBALS['original_text_five'], $GLOBALS['alternative_text_five'], $text);

    else 
    $changed_text = $text;

    return $changed_text;
}