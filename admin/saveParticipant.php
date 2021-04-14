<?php
require_once 'auth.php';
include '../includes/db_config.php';

$form_id = $_POST['form_id'];

if ($form_id === "addParticipant") {
    //Get data posted from form
    $a = $_POST['fullname'];
    $b = $_POST['email'];
    $c = $_POST['phone'];
    $d = $_POST['passport'];
    $e = $_POST['company'];
    $f = $_POST['designation'];
    $g = $_POST['course'];
    $h = $_POST['cohort'];

    // query
    $sql = "INSERT INTO participants (fullname,email,phone,passport,company, designation,courseId, cohortId) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
    $q = $db->prepare($sql);
    $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':f' => $f, ':g' => $g, ':h' => $h));

    $_SESSION['msg'] = 'New Participant successfully created!';
    header("location:addParticipant.php");
    exit;
}
