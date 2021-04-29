<?php
session_start();
require_once '../includes/db_config.php';

$form_id = $_POST['form_id'];


//Change password
if ($form_id == 'password_change') {

    $username = $_POST['username'];
    $pass = sha1($_POST['password']);
    $pass_hash = sha1($_POST['old_password']);

    $stm = $db->prepare("SELECT `password` FROM users WHERE username = ?");
    $stm->execute([$username]);
    $result = $stm->fetch();
    $db_old_pass = $result['password'];

    if ($db_old_pass === $pass_hash) {
        $sth = $db->prepare("UPDATE users SET `password` = ? WHERE username = ? ");

        if ($sth->execute([$pass, $username])) {
            $_SESSION['msg'] = 'Password successfully updated';
            header('location:profile.php');
            exit;
        } else {
            $_SESSION['error_msg'] = 'Password updated failed';
            header('location:profile.php');
            exit;
        }
    } else {
        $_SESSION['error_msg'] = 'Current Password Incorrect';
        header('location:profile.php');
        exit;
    }
}

// Delete account

if ($form_id == 'delete_account') {

    $username = $_POST['username'];
    $pass = sha1($_POST['password']);

    $stm = $db->prepare("SELECT `password` FROM users WHERE username = ?");
    $stm->execute([$username]);
    $result = $stm->fetch();
    $db_old_pass = $result['password'];

    if ($db_old_pass === $pass) {
        $sth = $db->prepare("DELETE FROM users WHERE username = ?");
        $sth->execute([$username]); {
            session_unset();
            session_destroy();

            session_start();
            $_SESSION['error_msg'] = $msg = "<div class='alert alert-danger p-3'> Your Account Was Deleted. Sorry to see you go ! </div>";
            header("Location: ../index.php");
            exit;
        }
    } else {

        $_SESSION['error_msg'] = ' Account Deletion Failed . Current Password Incorrect';
        header('location:profile.php');
        exit;
    }
}

//Update  profile info

if ($form_id === "profile_info") {
    //Get data posted from form
    $a = $_POST['fullname'];
    $b = $_POST['username'];
    $c = $_POST['email'];
    $d = $_POST['phone'];
    $e = $_POST['passport'];
    $f = $_POST['company'];
    $g = $_POST['city'];
    $h = $_POST['address'];
    $i = $_POST['state'];

    // query
    $sql = "UPDATE  facilitators SET fullname=?,email=?, phone=?, passport=?, company=?,city=?,`address`=?, `state`=? WHERE username = ?";
    $q = $db->prepare($b);

    $sql = "UPDATE  facilitators SET fullname=?,email=?, phone=?, passport=?, company=?,city=?,`address`=?, `state`=? WHERE username = ?";
    $q = $db->prepare($b);

    if ($q->execute(array($a, $c, $d, $e, $f, $g, $h, $i, $b))) {
        $_SESSION['msg'] = 'Profile Details Updated successfully!';
        header("location:viewFacilitator.php");
        exit;
    } else {
        $_SESSION['error_msg'] = 'Updated Failed';
        header("location:viewFacilitator.php");
        exit;
    }
}
