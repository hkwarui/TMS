<?php
require_once 'auth.php';
include '../includes/db_config.php';

$form_id = $_POST['form_id'];

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
    header("location:add_facilitator.php");
    exit;
}

// if ($form_id === "edit_user") {
//     //Get data posted from form
//     $id = $_POST['user_id'];
//     $a = $_POST['fullname'];
//     $b = $_POST['username'];
//     $c = $_POST['email'];
//     $d = $_POST['phone'];
//     $e = $_POST['user_type'];
//     $f = $_POST['start_date'];

//     // query
//     $sql = "UPDATE users
//         SET fullname=?, username=?, email=?,phone=?, user_type=?,`start_date`=?
// 		WHERE id=?";
//     $q = $db->prepare($sql);
//     if ($q->execute(array($a, $b, $c, $d, $e, $f, $id))) {
//         $_SESSION['add_user'] = '<div class="alert alert-success p-1" role="alert">
//     User Details updated successfully!
// </div>';
//     } else {

//         $_SESSION['add_user'] = '<div class="alert alert-danger p-1" role="alert">
//     Details Update failed !
// </div>';
//     }

//     header("location: users.php");
// }
