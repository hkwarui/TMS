<?php
session_start();
require_once '../includes/db_config.php';

$id = $_GET['id'];
$coz_id = $_GET['coz_id'];

$result = $db->prepare("DELETE FROM cohorts WHERE id= ?");

if ($result->execute([$id])) {
    $_SESSION['msg'] = 'Facilitator Deleted !';
    header("location: viewCourse.php?=" . $coz_id);
    exit;
} else {
    $_SESSION['error_msg'] = 'Delete Action Failed !';
    header("location: viewCourse.php?id=" . $coz_id);
    exit;
}
