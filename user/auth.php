
<?php
session_start();

if (!$_SESSION['role_id'] || !$_SESSION['login_status']) {
    header("Location: ../index.php");
    exit;
}
$username = $_SESSION['username'];

// if ($_SESSION['role_id'] == 2 || $_SESSION['login_status'] == 1) {
//     header("Location: ../user");
//     exit;
// }
