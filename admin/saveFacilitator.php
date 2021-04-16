<?php
require_once 'auth.php';
include '../includes/db_config.php';

$form_id = $_POST['form_id'];

//Addfacilitator data
if ($form_id === "add_facilitator") {
    //Get data posted from form
    $a = $_POST['fullname'];
    $b = $_POST['username'];
    $c = $_POST['email'];
    $d = $_POST['phone'];
    $e = $_POST['passport'];
    $f = $_POST['company'];
    $g = 2;
    $i = sha1("Welcome1");

    // query
    $sql = "INSERT INTO facilitators (fullname, username,email,phone,passport,company) VALUES (:a,:b,:c,:d,:e,:f)";
    $q = $db->prepare($sql);
    $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':f' => $f));

    $sql1 = "INSERT INTO users (`name`, username,role_id,`password`) VALUES (:a,:b,:c,:d)";
    $smt = $db->prepare($sql1);
    $smt->execute(array(':a' => $a, ':b' => $b, ':c' => $g, ':d' => $i));

    $_SESSION['msg'] = 'New user successfully created!';
    header("location:viewFacilitator.php");
    exit;
}


//Update Facilitator Data
if ($form_id === "edit_facilitator") {
    //Get data posted from form
    $a = $_POST['fullname'];
    $b = $_POST['username'];
    $c = $_POST['email'];
    $d = $_POST['phone'];
    $e = $_POST['passport'];
    $f = $_POST['company'];
    $g = $_POST['id'];

    // query
    $sql = "UPDATE  facilitators SET fullname=?, username=?, email=?, phone=?, passport=?, company=? WHERE id = ?";
    $q = $db->prepare($sql);

    if ($q->execute(array($a, $b, $c, $d, $e, $f, $g))) {
        $_SESSION['msg'] = 'Facilitator Details Updated successfully!';
        header("location:viewFacilitator.php");
        exit;
    } else {
        $_SESSION['error_msg'] = 'Updated Failed';
        header("location:viewFacilitator.php");
        exit;
    }
}
