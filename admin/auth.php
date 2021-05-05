<?php
session_start();
require_once '../includes/db_config.php';

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

//If its the facilitator pick the name of the company 
if (isFacilitator()) {
    $stm = $db->prepare("SELECT company FROM facilitators WHERE username  = ?");
    $stm->execute([$username]);
    $company = $stm->fetch();
}
