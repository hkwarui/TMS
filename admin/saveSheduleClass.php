<?php

require_once 'auth.php';
include '../includes/db_config.php';

$form_id = $_POST['form_id'];

if ($form_id === "sheduleClass") {
    //Get data posted from course for
    $a = $_POST['course'];
    $b = $_POST['cohort'];
    $c = $_POST['startTime'];
    $d = $_POST['venue'];

    // query
    $sql = "INSERT INTO cohorts (courseId, cohortId, startTime, venue) VALUES (:a,:b,:c,:d)";
    $q = $db->prepare($sql);
    $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d));

    $_SESSION['msg'] = 'New Cohort Added Successfully !';
    header("location:sheduleClass.php");
    exit;
}
