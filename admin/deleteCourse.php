<?php
session_start();
require_once '../includes/db_config.php';

$id = $_GET['id'];
$coz_id = $_GET['coz_id'];

$result = $db->prepare("DELETE FROM courses WHERE id= ?");

$result1 = $db->prepare("DELETE FROM cohorts WHERE courseId = ?");

if ($result->execute([$id]) && $result1->execute([$coz_id])) {
    $_SESSION['msg'] = 'Course and its Classes Deleted !';
    header("location: courses.php");
    exit;
} else {
    $_SESSION['error_msg'] = 'Delete Action Failed !';
    header("location: viewCourse.php?id=" . $coz_id);
    exit;
}
