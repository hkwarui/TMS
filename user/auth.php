
<?php
session_start();

if (!$_SESSION['user_type'] || !$_SESSION['login_status']) {
    header("Location: ../");
    exit;
}
$username = $_SESSION['username'];

if ($_SESSION['user_type'] == 1 || $_SESSION['login_status'] == 2) {
    header("Location: ../");
    exit;
}
