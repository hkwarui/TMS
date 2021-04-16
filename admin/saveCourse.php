<?php

require_once 'auth.php';
include '../includes/db_config.php';

$form_id = $_POST['form_id'];

//SAVE COURSE DETAILS
if ($form_id === "addCourse") {

    $a = ucwords($_POST['courseName']);
    $b = $_POST['courseId'];
    $c = $_POST['validity'];
    $d = $_POST['duration'];
    $e = $_POST['cost'];
    $f = $_POST['instructor'];

    // query
    $sql = "INSERT INTO courses (courseName, courseID, validity, duration, cost, instructor) VALUES (:a,:b,:c,:d,:e,:f)";
    $q = $db->prepare($sql);
    $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':f' => $f));

    $_SESSION['msg'] = 'New Course Created  Successfully !';
    header("location:courses.php");
    exit;
}

// UPDATE COURSE DETAILS
if ($form_id === "editCourse") {

    $a = ucwords($_POST['courseName']);
    $b = $_POST['courseId'];
    $c = $_POST['validity'];
    $d = $_POST['duration'];
    $e = $_POST['cost'];
    $f = $_POST['instructor'];

    $sql = "UPDATE courses SET courseName=?, validity=?, duration=?, cost=?, instructor=? WHERE courseId = ?";
    $q = $db->prepare($sql);

    if ($q->execute([$a, $c, $d, $e, $f, $b])) {
        $_SESSION['msg'] = 'Course Updated  Successfully !';
        header("location:viewCourse.php?id=" . $b);
        exit;
    } else {
        $_SESSION['error_msg'] = 'Update Failed!';
        header("location:course.php?id=" . $b);
        exit;
    }
}
