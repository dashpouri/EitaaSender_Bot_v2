<?php 

# INITIAL KEYBOARD
$initial_keyboard = [
    [$key_help]
];
$initial_keyboard_options = [
    "keyboard" => $initial_keyboard,
    "resize_keyboard" => TRUE,
    "one_time_keyboard" => FALSE
];

# ADMIN KEYBOARD
$admin_keyboard = [
    [$key_manage_bot],
    [$key_auto_sender, $key_send_contents],
    [$key_change_text, $key_signature],
    [$key_register_token, $key_register_channel],
    [$key_account, $key_help]
];
$admin_keyboard_options = [
    "keyboard" => $admin_keyboard,
    "resize_keyboard" => TRUE,
    "one_time_keyboard" => FALSE
];

# USERS KEYBOARD
$users_keyboard = [
    [$key_auto_sender, $key_send_contents],
    [$key_change_text, $key_signature],
    [$key_register_token, $key_register_channel],
    [$key_account, $key_help]
];
$users_keyboard_options = [
    "keyboard" => $users_keyboard,
    "resize_keyboard" => TRUE,
    "one_time_keyboard" => FALSE
];

# SEND CONTENTS KEYBOARD
$send_contents_keyboard = [
    [$key_from_url, $key_select_channel, $key_from_telegram],
    [$key_back]
];
$send_contents_keyboard_options = [
    "keyboard" => $send_contents_keyboard,
    "resize_keyboard" => TRUE,
    "one_time_keyboard" => FALSE
];