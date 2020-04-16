<?php

$server = "localhost";
$username = "یوزرنیم دیتابیس";
$password = "پسورد";
$dbname = "نام دیتابیس";

$conn = new mysqli($server, $username, $password, $dbname);

if (!$conn)
{
    echo "Connection Failed!" . $conn->connect_error();
}

$conn->query("SET NAMES utf8mb4");



