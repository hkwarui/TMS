
<?php
session_start();

if (!$_SESSION['role_id'] || !$_SESSION['login_status']) {
    header("Location: ../index.php");
    exit;
}
// $msg = $_SESSION['msg'];
$username = $_SESSION['username'];
// $name = $_SESSION['name'];

// if ($_SESSION['role_id'] == 2 || $_SESSION['login_status'] == 2) {
//     header("Location: ../");
//     exit;
// }
