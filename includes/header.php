<?php
require_once "../admin/auth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="TMS, Training,Managment,Solution">
    <link rel="shortcut icon" href="../static/img/icons/favicon.png" />
    <title>TMS </title>
    <link href="../static/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="../static/js/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="../static/js/jquery.validate.min.js"></script>
    <script src="../static/js/app.js"></script>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <h2 class="align-middle" style="color:#3275c7;">
                        <b> TMS<small>&reg;</small></b>
                    </h2>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>
                    <?php
                    if (isInstructor()) {
                    ?>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="index.php">
                                <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#facilitator" data-bs-toggle="collapse" class="sidebar-link collapsed">
                                <i class="align-middle" data-feather="users"></i> <span class="align-middle">Facilitator</span>
                            </a>
                            <ul id="facilitator" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                                <li class="sidebar-item"><a class="sidebar-link" href="addFacilitator.php">Add Facilitator</a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="viewFacilitator.php">View Facilitator</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="#course" data-bs-toggle="collapse" class="sidebar-link collapsed">
                                <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Course</span>
                            </a>
                            <ul id="course" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                                <li class="sidebar-item"><a class="sidebar-link" href="addCourse.php">Add Course</a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="courses.php">View Courses</a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="sheduleClass.php">Shedule Class</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="#participant" data-bs-toggle="collapse" class="sidebar-link collapsed">
                                <i class="align-middle" data-feather="users"></i> <span class="align-middle">Participants</span>
                            </a>
                            <ul id="participant" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                                <li class="sidebar-item"><a class="sidebar-link" href="addParticipant.php">Add Participant</a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="viewParticipants.php">View Participant</a></li>
                            </ul>
                        </li>
                    <?php }
                    if (isFacilitator()) {
                    ?>
                        <li class="sidebar-item active">
                            <a class="sidebar-link" href="home.php">
                                <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#course" data-bs-toggle="collapse" class="sidebar-link collapsed">
                                <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Course</span>
                            </a>
                            <ul id="course" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                                <li class="sidebar-item"><a class="sidebar-link" href="courses.php">view Courses</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="#participant" data-bs-toggle="collapse" class="sidebar-link collapsed">
                                <i class="align-middle" data-feather="users"></i> <span class="align-middle">Participants</span>
                            </a>
                            <ul id="participant" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                                <li class="sidebar-item"><a class="sidebar-link" href="addParticipant.php">Add Participant</a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="pages-sign-up.html">Manage Participant</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="../static/img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark"><?php echo ucfirst($username); ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="../admin/profile.php"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <script type="text/javascript">
                $(document).ready(function() {
                    $('.sidebar-nav li').click(function(e) {
                        $(this).siblings().removeClass('active');
                        $(this).addClass('active');
                    });
                });
            </script>