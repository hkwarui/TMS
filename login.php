<?php
session_start();
require_once "includes/db_config.php";

if (isset($_POST['login_user'])) {


    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);

    $username = $DBcon->real_escape_string($username);
    $password = $DBcon->real_escape_string($password);

    $pass = sha1($password);

    $query = $DBcon->query("SELECT *  FROM users WHERE username ='$username' AND `password` = '$pass' ");
    $row = $query->fetch_array();
    $count = $query->num_rows; // if username/password are correct returns must be 1 row
    if ($count > 0) {

        if ($row['login_status'] == 1) {
            if ($row['role_id'] == 1) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['role_id'] = $row['role_id'];
                $_SESSION['login_status'] = $row['login_status'];
                $_SESSION['msg'] = "You are logged in as " . ucwords($_SESSION['name']);

                header("Location: admin");
                exit;
            }
            if ($row['role_id'] == 2) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['role_id'] = $row['role_id'];
                $_SESSION['login_status'] = $row['login_status'];
                $_SESSION['msg'] = "You are logged in as " . ucwords($_SESSION['name']);

                header("Location: admin");
                exit;
            }
        }
        if ($row['login_status'] == 2) {
            $msg = "<div class='alert alert-danger p-3'>Account is deactivated. Contact Admin</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger p-3'>Incorrect Username or Password.</div>";
    }
}
