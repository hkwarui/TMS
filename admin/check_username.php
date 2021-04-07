<?php
require_once "auth.php";
require_once "../includes/db_config.php";


$requestedUsername = $_POST['username'];

$sth = $db->prepare("SELECT username FROM users");
$sth->execute();
$result = $sth->fetchAll();

// CHECK IF EMAIL EXIST IN DB
if (in_array($requestedUsername, $result)) {
    echo json_encode(false);
} else {
    echo json_encode(true);
}
