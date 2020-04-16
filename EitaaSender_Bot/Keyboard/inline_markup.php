<?php 

# -------------------- NEW VALUES -------------------- #

if ($eitaa_channel_one != "")
{
    $new_t_button_delete_one = $t_button_delete;
    $new_eitaa_channel_one = "🔶" . $eitaa_channel_one;
    $new_eitaa_channel_one_title = "🏷" . $eitaa_channel_one_title;
    $new_telegram_channel_one_title = "🔷" . $telegram_channel_one_title;

    if ($telegram_channel_one_status == "غیر فعال")
    $new_telegram_channel_one_status = "🚫" . $telegram_channel_one_status;
    else
    $new_telegram_channel_one_status = "✅" . $telegram_channel_one_status;

    if ($signature_one == "امضا")
    $new_signature_one = "✍️" . $signature_one;
    else 
    $new_signature_one = "✅ثبت شده"; 

    if ($original_text_one == "اصلی")
    $new_original_text_one = "✍️" . $original_text_one;
    else 
    $new_original_text_one = "✅ثبت شده";

    if ($alternative_text_one == "جایگزین")
    $new_alternative_text_one = "✍️" . $alternative_text_one;
    else 
    $new_alternative_text_one = "✅ثبت شده";
}

if ($eitaa_channel_two != "")
{
    $new_t_button_delete_two = $t_button_delete;
    $new_eitaa_channel_two = "🔶" . $eitaa_channel_two;
    $new_eitaa_channel_two_title = "🏷" . $eitaa_channel_two_title;
    $new_telegram_channel_two_title = "🔷" . $telegram_channel_two_title;

    if ($telegram_channel_two_status == "غیر فعال")
    $new_telegram_channel_two_status = "🚫" . $telegram_channel_two_status;
    else
    $new_telegram_channel_two_status = "✅" . $telegram_channel_two_status;

    if ($signature_two == "امضا")
    $new_signature_two = "✍️" . $signature_two;
    else 
    $new_signature_two = "✅ثبت شده"; 

    if ($original_text_two == "اصلی")
    $new_original_text_two = "✍️" . $original_text_two;
    else 
    $new_original_text_two = "✅ثبت شده";

    if ($alternative_text_two == "جایگزین")
    $new_alternative_text_two = "✍️" . $alternative_text_two;
    else 
    $new_alternative_text_two = "✅ثبت شده";
}

if ($eitaa_channel_three != "")
{
    $new_t_button_delete_three = $t_button_delete;
    $new_eitaa_channel_three = "🔶" . $eitaa_channel_three;
    $new_eitaa_channel_three_title = "🏷" . $eitaa_channel_three_title;
    $new_telegram_channel_three_title = "🔷" . $telegram_channel_three_title;

    if ($telegram_channel_three_status == "غیر فعال")
    $new_telegram_channel_three_status = "🚫" . $telegram_channel_three_status;
    else
    $new_telegram_channel_three_status = "✅" . $telegram_channel_three_status;

    if ($signature_three == "امضا")
    $new_signature_three = "✍️" . $signature_three;
    else 
    $new_signature_three = "✅ثبت شده"; 

    if ($original_text_three == "اصلی")
    $new_original_text_three = "✍️" . $original_text_three;
    else 
    $new_original_text_three = "✅ثبت شده";

    if ($alternative_text_three == "جایگزین")
    $new_alternative_text_three = "✍️" . $alternative_text_three;
    else 
    $new_alternative_text_three = "✅ثبت شده";
}

if ($eitaa_channel_four != "")
{
    $new_t_button_delete_four = $t_button_delete;
    $new_eitaa_channel_four = "🔶" . $eitaa_channel_four;
    $new_eitaa_channel_four_title = "🏷" . $eitaa_channel_four_title;
    $new_telegram_channel_four_title = "🔷" . $telegram_channel_four_title;

    if ($telegram_channel_four_status == "غیر فعال")
    $new_telegram_channel_four_status = "🚫" . $telegram_channel_four_status;
    else
    $new_telegram_channel_four_status = "✅" . $telegram_channel_four_status;

    if ($signature_four == "امضا")
    $new_signature_four = "✍️" . $signature_four;
    else 
    $new_signature_four = "✅ثبت شده"; 

    if ($original_text_four == "اصلی")
    $new_original_text_four = "✍️" . $original_text_four;
    else 
    $new_original_text_four = "✅ثبت شده";

    if ($alternative_text_four == "جایگزین")
    $new_alternative_text_four = "✍️" . $alternative_text_four;
    else 
    $new_alternative_text_four = "✅ثبت شده";
}

if ($eitaa_channel_five != "")
{
    $new_t_button_delete_five = $t_button_delete;
    $new_eitaa_channel_five = "🔶" . $eitaa_channel_five;
    $new_eitaa_channel_five_title = "🏷" . $eitaa_channel_five_title;
    $new_telegram_channel_five_title = "🔷" . $telegram_channel_five_title;

    if ($telegram_channel_five_status == "غیر فعال")
    $new_telegram_channel_five_status = "🚫" . $telegram_channel_five_status;
    else
    $new_telegram_channel_five_status = "✅" . $telegram_channel_five_status;

    if ($signature_five == "امضا")
    $new_signature_five = "✍️" . $signature_five;
    else 
    $new_signature_five = "✅ثبت شده"; 

    if ($original_text_five == "اصلی")
    $new_original_text_five = "✍️" . $original_text_five;
    else 
    $new_original_text_five = "✅ثبت شده";

    if ($alternative_text_five == "جایگزین")
    $new_alternative_text_five = "✍️" . $alternative_text_five;
    else 
    $new_alternative_text_five = "✅ثبت شده";
}

# -------------------- KEYBOARD -------------------- #

# AUTO SENDER
$auto_sender_keyboard = [
    [
        ["text" => "$new_t_button_delete_one", "callback_data" => "delete_telegram_channel_one"],
        ["text" => "$new_telegram_channel_one_title", "callback_data" => "change_telegram_channel_one"],
        ["text" => "$new_telegram_channel_one_status", "callback_data" => "change_telegram_channel_one_status"],
        ["text" => "$new_eitaa_channel_one", "callback_data" => "show_help_for_eitaa_channel"]
    ],
    [
        ["text" => "$new_t_button_delete_two", "callback_data" => "delete_telegram_channel_two"],
        ["text" => "$new_telegram_channel_two_title", "callback_data" => "change_telegram_channel_two"],
        ["text" => "$new_telegram_channel_two_status", "callback_data" => "change_telegram_channel_two_status"],
        ["text" => "$new_eitaa_channel_two", "callback_data" => "show_help_for_eitaa_channel"]
    ],
    [
        ["text" => "$new_t_button_delete_three", "callback_data" => "delete_telegram_channel_three"],
        ["text" => "$new_telegram_channel_three_title", "callback_data" => "change_telegram_channel_three"],
        ["text" => "$new_telegram_channel_three_status", "callback_data" => "change_telegram_channel_three_status"],
        ["text" => "$new_eitaa_channel_three", "callback_data" => "show_help_for_eitaa_channel"]
    ],
    [
        ["text" => "$new_t_button_delete_four", "callback_data" => "delete_telegram_channel_four"],
        ["text" => "$new_telegram_channel_four_title", "callback_data" => "change_telegram_channel_four"],
        ["text" => "$new_telegram_channel_four_status", "callback_data" => "change_telegram_channel_four_status"],
        ["text" => "$new_eitaa_channel_four", "callback_data" => "show_help_for_eitaa_channel"]
    ],
    [
        ["text" => "$new_t_button_delete_five", "callback_data" => "delete_telegram_channel_five"],
        ["text" => "$new_telegram_channel_five_title", "callback_data" => "change_telegram_channel_five"],
        ["text" => "$new_telegram_channel_five_status", "callback_data" => "change_telegram_channel_five_status"],
        ["text" => "$new_eitaa_channel_five", "callback_data" => "show_help_for_eitaa_channel"]
    ]
];
$auto_sender_keyboard_options = [
    "inline_keyboard" => $auto_sender_keyboard
];

# SIGNATURE 
$signature_keyboard = [
    [
        ["text" => "$new_t_button_delete_one", "callback_data" => "delete_signature_one"],
        ["text" => "$new_signature_one", "callback_data" => "change_signature_one"],
        ["text" => "$new_eitaa_channel_one", "callback_data" => "show_help_for_eitaa_channel"]
    ],
    [
        ["text" => "$new_t_button_delete_two", "callback_data" => "delete_signature_two"],
        ["text" => "$new_signature_two", "callback_data" => "change_signature_two"],
        ["text" => "$new_eitaa_channel_two", "callback_data" => "show_help_for_eitaa_channel"]
    ],
    [
        ["text" => "$new_t_button_delete_three", "callback_data" => "delete_signature_three"],
        ["text" => "$new_signature_three", "callback_data" => "change_signature_three"],
        ["text" => "$new_eitaa_channel_three", "callback_data" => "show_help_for_eitaa_channel"]
    ],
    [
        ["text" => "$new_t_button_delete_four", "callback_data" => "delete_signature_four"],
        ["text" => "$new_signature_four", "callback_data" => "change_signature_four"],
        ["text" => "$new_eitaa_channel_four", "callback_data" => "show_help_for_eitaa_channel"]
    ],
    [
        ["text" => "$new_t_button_delete_five", "callback_data" => "delete_signature_five"],
        ["text" => "$new_signature_five", "callback_data" => "change_signature_five"],
        ["text" => "$new_eitaa_channel_five", "callback_data" => "show_help_for_eitaa_channel"]
    ],
];
$signature_keyboard_options = [
    "inline_keyboard" => $signature_keyboard
];

# CHANGE TEXT
$change_text_keyboard = [
    [
        ["text" => "$new_t_button_delete_one", "callback_data" => "delete_changing_text_one"],
        ["text" => "$new_alternative_text_one", "callback_data" => "change_alternative_changing_text_one"],
        ["text" => "$new_original_text_one", "callback_data" => "change_original_changing_text_one"],
        ["text" => "$new_eitaa_channel_one", "callback_data" => "show_help_for_eitaa_channel"]
    ],
    [
        ["text" => "$new_t_button_delete_two", "callback_data" => "delete_changing_text_two"],
        ["text" => "$new_alternative_text_two", "callback_data" => "change_alternative_changing_text_two"],
        ["text" => "$new_original_text_two", "callback_data" => "change_original_changing_text_two"],
        ["text" => "$new_eitaa_channel_two", "callback_data" => "show_help_for_eitaa_channel"]
    ],
    [
        ["text" => "$new_t_button_delete_three", "callback_data" => "delete_changing_text_three"],
        ["text" => "$new_alternative_text_three", "callback_data" => "change_alternative_changing_text_three"],
        ["text" => "$new_original_text_three", "callback_data" => "change_original_changing_text_three"],
        ["text" => "$new_eitaa_channel_three", "callback_data" => "show_help_for_eitaa_channel"]
    ],
    [
        ["text" => "$new_t_button_delete_four", "callback_data" => "delete_changing_text_four"],
        ["text" => "$new_alternative_text_four", "callback_data" => "change_alternative_changing_text_four"],
        ["text" => "$new_original_text_four", "callback_data" => "change_original_changing_text_four"],
        ["text" => "$new_eitaa_channel_four", "callback_data" => "show_help_for_eitaa_channel"]
    ],
    [
        ["text" => "$new_t_button_delete_five", "callback_data" => "delete_changing_text_five"],
        ["text" => "$new_alternative_text_five", "callback_data" => "change_alternative_changing_text_five"],
        ["text" => "$new_original_text_five", "callback_data" => "change_original_changing_text_five"],
        ["text" => "$new_eitaa_channel_five", "callback_data" => "show_help_for_eitaa_channel"]
    ],

];
$change_text_keyboard_options = [
    "inline_keyboard" => $change_text_keyboard
];

# REGISTER EITAA CHANNEL
$register_channel_keyboard = [
    [
        ["text" => "$new_t_button_delete_one", "callback_data" => "delete_eitaa_channel_one"],
        ["text" => "$new_eitaa_channel_one_title", "callback_data" => "change_eitaa_channel_one_title"],
        ["text" => "$new_eitaa_channel_one", "callback_data" => "change_eitaa_channel_one"]
    ],
    [
        ["text" => "$new_t_button_delete_two", "callback_data" => "delete_eitaa_channel_two"],
        ["text" => "$new_eitaa_channel_two_title", "callback_data" => "change_eitaa_channel_two_title"],
        ["text" => "$new_eitaa_channel_two", "callback_data" => "change_eitaa_channel_two"]
    ],
    [
        ["text" => "$new_t_button_delete_three", "callback_data" => "delete_eitaa_channel_three"],
        ["text" => "$new_eitaa_channel_three_title", "callback_data" => "change_eitaa_channel_three_title"],
        ["text" => "$new_eitaa_channel_three", "callback_data" => "change_eitaa_channel_three"]
    ],
    [
        ["text" => "$new_t_button_delete_four", "callback_data" => "delete_eitaa_channel_four"],
        ["text" => "$new_eitaa_channel_four_title", "callback_data" => "change_eitaa_channel_four_title"],
        ["text" => "$new_eitaa_channel_four", "callback_data" => "change_eitaa_channel_four"]
    ],
    [
        ["text" => "$new_t_button_delete_five", "callback_data" => "delete_eitaa_channel_five"],
        ["text" => "$new_eitaa_channel_five_title", "callback_data" => "change_eitaa_channel_five_title"],
        ["text" => "$new_eitaa_channel_five", "callback_data" => "change_eitaa_channel_five"]
    ],
    [
        ["text" => "$add_new_channel", "callback_data" => "add_new_channel"],
    ],
];
$register_channel_keyboard_options = [
    "inline_keyboard" => $register_channel_keyboard
];

# ACCOUNT
$account_keyboard = [
    [
        ["text" => "delete", "callback_data" => "deleteinfo"],
        ["text" => "update", "callback_data" => "updateinfo"]
    ]
];
$account_keyboard_options = [
    "inline_keyboard" => $account_keyboard
];

# SELECT CHANNEL 
$select_channel_keyboard = [
    [
        ["text" => "$new_eitaa_channel_one", "callback_data" => "select_eitaa_channel_one"],
        ["text" => "$new_eitaa_channel_two", "callback_data" => "select_eitaa_channel_two"]
    ],
    [
        ["text" => "$new_eitaa_channel_three", "callback_data" => "select_eitaa_channel_three"],
        ["text" => "$new_eitaa_channel_four", "callback_data" => "select_eitaa_channel_four"]
    ],
    [
        ["text" => "$new_eitaa_channel_five", "callback_data" => "select_eitaa_channel_five"]
    ],
];
$select_channel_keyboard_options = [
    "inline_keyboard" => $select_channel_keyboard
];

# SHOW REPORT MESSAGE FOR SEND AUTO CONTENTS (PUBLIC)
$report_message_public_keyboard = [
    [
        ["text"=>"نمایش پست", "url"=>"https://t.me/$channel_chat_username/$channel_message_id"],
    ]
];
$report_message_public_keyboard_options = [
    "inline_keyboard" => $report_message_public_keyboard
];

# SHOW REPORT MESSAGE FOR SEND AUTO CONTENTS (PRIVATE)
$report_message_private_keyboard = [
    [
        ["text"=>"نمایش پست", "url"=>"https://t.me/c/".substr($channel_chat_id, 4)."/$channel_message_id"],
    ]
];
$report_message_private_keyboard_options = [
    "inline_keyboard" => $report_message_private_keyboard
];
