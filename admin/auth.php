
<?php
session_start();

if (!$_SESSION['user_type'] || !$_SESSION['login_status']) {
    header("Location: ../");
    exit;
}
// $msg = $_SESSION['msg'];
$username = $_SESSION['username'];

if ($_SESSION['user_type'] == 2 || $_SESSION['login_status'] == 2) {
    header("Location: ../");
    exit;
}
