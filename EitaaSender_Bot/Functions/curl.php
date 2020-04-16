<?php

function send_to_telegram($url, $post_params)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_params);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

function send_to_eitaa($url, $post_params)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_params);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

function download_file($url, $file_name)
{
    $file_path = "Files/" . $file_name;

    $fp = fopen($file_path, 'w+');
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_TIMEOUT, 29);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 29);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_FILE, $fp);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    $exec = curl_exec($curl);
    fclose($fp);

    if($exec === false)
    {
        if (curl_errno($curl) == "3")
        {
            show_reply("URL Error");

        }

        else if (curl_errno($curl) == "28")
        {
            show_reply($GLOBALS['download_time_out']);

        }

        else
        {
            show_reply("خطای ناشناخته ای رخ داد! لطفا به سازنده ربات اطلاع دهید\nDL: " . curl_errno($curl));

        }
    }
    curl_close($curl);
    return $file_path;
}