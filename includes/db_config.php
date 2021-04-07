<?php

/* ================ MySQLi Connection ==================================================== */

$DBhost = "localhost";
$DBuser = "root";
$DBpass = "";
$DBname = "tms_database";

date_default_timezone_set('Africa/Nairobi');

$DBcon = new MySQLi($DBhost, $DBuser, $DBpass, $DBname);
if ($DBcon->connect_errno) {
    die("ERROR : -> " . $DBcon->connect_error);
};


/*  ========================= PDO CONNECTION  =============================================== */

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_database = 'tms_database';

date_default_timezone_set('Africa/Nairobi');

$db = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
