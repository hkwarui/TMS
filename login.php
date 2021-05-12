<?php
session_start();
require_once "includes/db_config.php";

if (isset($_POST['login_user'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $pass = sha1($password);

    $query = $db->prepare("SELECT *  FROM users WHERE username =? AND `password` = ? ");
    $query->execute([$username, $pass]);
    $count = $query->rowCount();
    $row = $query->fetch();

    // if username/password are correct returns must be 1 row
    if ($count > 0) {
        if ($row['login_status'] == 1) {

            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role_id'] = $row['role_id'];
            $_SESSION['login_status'] = $row['login_status'];
            $_SESSION['msg'] = "You are logged in as " . ucwords($_SESSION['name']);

            header("Location: admin");
            exit;
        }
        if ($row['login_status'] == 2) {
            $msg = "<div class='alert alert-danger p-3'>Account is deactivated. Contact Admin</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger p-3'>Incorrect Username or Password.</div>";
    }
}
