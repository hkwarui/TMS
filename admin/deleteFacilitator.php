<?php
session_start();
require_once '../includes/db_config.php';

$id = $_GET['id'];
$username = $_GET['username'];
$result = $db->prepare("DELETE FROM facilitators WHERE id= ?");
$result1 = $db->prepare("DELETE FROM users WHERE username= ?");

if ($result->execute([$id]) && $result1->execute([$username])) {
    $_SESSION['msg'] = 'Facilitator Deleted !';
    header("location: viewFacilitator.php");
    exit;
} else {
    $_SESSION['error_msg'] = 'Delete Action Failed !';
    header("location: viewFacilitator.php");
    exit;
}
