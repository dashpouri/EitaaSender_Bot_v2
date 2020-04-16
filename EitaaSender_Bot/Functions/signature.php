<?php 

# REGISTER SIGNATURE
function register_signature($row, $value, $message)
{
    if ($GLOBALS['text'])
    {
        update_query($row, $value, $message);
        user_position("registeredSignature");
    }
}

# DELETE SIGNATURE
function delete_signature($signature)
{
    $result = mysqli_query($GLOBALS['conn'], "UPDATE users SET $signature = 'امضا'
    WHERE chat_id = {$GLOBALS['chat_id']}");

    if ($result)
    {
        user_position($GLOBALS['position_delete_signature']);
        answer_callback_query($GLOBALS['signature_deleted']);
        return true;
    }
    else 
    {
        answer_callback_query($GLOBALS['error']);
    }
    
}

# Add Signature
function add_signature($text)
{
    // 1
    if ($GLOBALS['eitaa_current_channel'] == $GLOBALS['eitaa_channel_one'] && $GLOBALS['signature_one'] != "امضا")
    $new_text = $text . "\n" . $GLOBALS['signature_one'];

    // 2
    else if ($GLOBALS['eitaa_current_channel'] == $GLOBALS['eitaa_channel_two'] && $GLOBALS['signature_two'] != "امضا")
    $new_text = $text . "\n" . $GLOBALS['signature_two'];

    // 3
    else if ($GLOBALS['eitaa_current_channel'] == $GLOBALS['eitaa_channel_three'] && $GLOBALS['signature_three'] != "امضا")
    $new_text = $text . "\n" . $GLOBALS['signature_three'];

    // 4
    else if ($GLOBALS['eitaa_current_channel'] == $GLOBALS['eitaa_channel_four'] && $GLOBALS['signature_four'] != "امضا")
    $new_text = $text . "\n" . $GLOBALS['signature_four'];

    // 5
    else if ($GLOBALS['eitaa_current_channel'] == $GLOBALS['eitaa_channel_five'] && $GLOBALS['signature_five'] != "امضا")
    $new_text = $text . "\n" . $GLOBALS['signature_five'];

    // Default
    else
    $new_text = $text;

    return $new_text;
}
