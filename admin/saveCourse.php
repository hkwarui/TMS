<?php

require_once 'auth.php';
include '../includes/db_config.php';

$form_id = $_POST['form_id'];

if ($form_id === "addCourse") {
    //Get data posted from course for
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
