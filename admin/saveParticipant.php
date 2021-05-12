<?php
require_once 'auth.php';
include '../includes/db_config.php';

$form_id = $_POST['form_id'];


//ADD PARTICIPANT
if ($form_id === "addParticipant") {

    $a = $_POST['fullname'];
    $b = $_POST['email'];
    $c = $_POST['phone'];
    $d = $_POST['passport'];
    $e = $_POST['company'];
    $f = $_POST['designation'];
    $g = $_POST['course'];
    $h = $_POST['classCode'];

    $sql = "INSERT INTO participants (fullname,email,phone,passport,company, designation,courseId, classCode) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
    $sql1 = "INSERT INTO class_records (stud_id, courseId, classCode) VALUES (:d,:g,:h)";

    $q = $db->prepare($sql);
    $q1 = $db->prepare($sql1);

    if (($q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':f' => $f, ':g' => $g, ':h' => $h))) &&   ($q1->execute(array(':d' => $d, ':g' => $g, ':h' => $h)))) {
        $_SESSION['msg'] = 'New Participant successfully created!';
        header("location:viewClass.php?id=" . $h . "&&cid=" . $g);
        exit;
    } else {

        $_SESSION['error_msg'] = 'User Creation Failed!';
        header("location:viewClass.php?id=" . $h . "&&cid=" . $g);
        exit;
    }
}


//Update participant
if ($form_id === "editParticipant") {
    //Get data posted from form
    $a = $_POST['fullname'];
    $b = $_POST['email'];
    $c = $_POST['phone'];
    $d = $_POST['passport'];
    $e = $_POST['company'];
    $f = $_POST['designation'];
    $g = $_POST['id'];

    $sql = " UPDATE participants SET fullname=?,email=? ,phone=?,passport=?,company=?, designation=? WHERE id =?";
    $q = $db->prepare($sql);

    if ($q->execute([$a, $b, $c, $d, $e, $f, $g])) {
        $_SESSION['msg'] = ' Participant Update  successfully created!';
        header("location:viewParticipants.php");
        exit;
    } else {

        $_SESSION['error_msg'] = 'Update Failed!';
        header("location:viewParticipants.php");
        exit;
    }
}
