<?php
require_once '../includes/db_config.php';

$courseId = $_POST['courseId'];
$status = $_POST['status'];

$stm = $db->prepare("UPDATE cohorts SET `status` = ? WHERE courseId = ?");
if ($stm->execute([$status, $courseId])) {
    echo 1;
    exit;
} else {
    echo 2;
    exit;
}
