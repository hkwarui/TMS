
<?php
session_start();
require_once "db_config.php";

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
            if ($row['user_type'] == 1) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_type'] = $row['user_type'];
                $_SESSION['login_status'] = $row['login_status'];
                $_SESSION['msg'] = "<div class='alert alert-success p-1'>You are logged in as " . ucfirst($_SESSION['username']) . "</div>";

                header("Location: admin");
                exit;
            }
            if ($row['user_type'] == 2) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_type'] = $row['user_type'];
                $_SESSION['login_status'] = $row['login_status'];
                $_SESSION['msg'] = "<div class='alert alert-success p-1'>You are logged in as " . ucfirst($_SESSION['username']) . "</div>";

                header("Location: user");
                exit;
            }
        }
        if ($row['login_status'] == 2) {
            $msg = "<div class='alert alert-danger'>Account is deactivated. Contact Admin</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Incorrect Username or Password.</div>";
    }
}
?>