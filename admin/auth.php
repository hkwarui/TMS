<?php
session_start();
if (!$_SESSION['role_id'] || !$_SESSION['login_status']) {
    header("Location: ../index.php");
    exit;
}

$username = $_SESSION['username'];

//CHECK IF USER IS INSTRUCTOR
function isInstructor()
{
    if ($_SESSION['role_id'] == 1) {
        return true;
    } else {
        return false;
    }
};


//CHECK IF USER IS INSTRUCTOR
function isFacilitator()
{
    if ($_SESSION['role_id'] == 2) {
        return true;
    } else {
        return false;
    }
};
