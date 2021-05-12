<?php

require_once 'auth.php';
include '../includes/db_config.php';

$form_id = $_POST['form_id'];

//Save schedule class
if ($form_id === "sheduleClass") {
    //Get data posted from course for
    $a = $_POST['course'];
    $b = $_POST['classCode'];
    $c = $_POST['startTime'];
    $d = $_POST['venue'];
    $e = $_POST['date'];

    // query
    $sql = "INSERT INTO cohorts (courseId, classCode, startTime, venue, `date`) VALUES (:a,:b,:c,:d,:e)";
    $q = $db->prepare($sql);
    $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e));

    $_SESSION['msg'] = 'New Cohort Added Successfully !';
    header("location:viewCourse.php?id=" . $a);
    exit;
}

//Edit Scheedule Class
if ($form_id === "editClass") {

    $a = $_POST['startTime'];
    $b = $_POST['venue'];
    $c = $_POST['id'];
    $d = $_POST['course'];
    $e = $_POST['date'];

    // query
    $sql = "UPDATE cohorts  SET startTime = ?, venue= ?,`date`=? WHERE id= ?";
    $q = $db->prepare($sql);
    if ($q->execute([$a, $b, $c, $e])) {
        $_SESSION['msg'] = 'Class Updated Successfully !';
        header("location:viewCourse.php?id=" . $d);
        exit;
    } else {
        $_SESSION['erro_msg'] = 'Updated Failed!';
        header("location:viewCourse.php?id=" . $d);
        exit;
    }
}
