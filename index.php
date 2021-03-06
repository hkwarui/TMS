<?php
include_once("login.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="static/fontawesome-free/css/all.min.css">
    <link rel="shortcut icon" href="static/img/icons/favicon.png" />
    <title>TMS - Sign In</title>
    <link href="static/css/app.css" rel="stylesheet">

</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto d-table h-100">
                    <div class="d-table-cell">

                        <div class="text-center mt-4">
                            <h1 class="display-6 mt-6 mb-4" style="color:#3275c7;"><b> Training<small>&reg;</small>
                                    Managment </b>
                            </h1>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <form method="post">
                                        <div class="mb-2">
                                            <?php
                                            if (isset($_SESSION['error_msg'])) {
                                                echo $_SESSION['error_msg'];
                                                unset($_SESSION['error_msg']);
                                            }
                                            if (isset($msg)) {
                                                echo $msg;
                                                unset($msg);
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label"><b>Username</b></label>
                                            <div class="input-group">
                                                <div class="input-group-text bg-primary">
                                                    <i class="feather" data-feather="user" style="color:white"></i>
                                                </div>
                                                <input class="form-control form-control-lg" type="text" id="username" name="username" required>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label"><b>Password</b></label>
                                            <div class="input-group">
                                                <div class="input-group-text bg-primary">
                                                    <i class="feather" data-feather="key" style="color:white"></i>
                                                </div>
                                                <input class="form-control form-control-lg" type="password" id="password" name="password" required>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                        </div>

                                        <div class="text-center mt-3">
                                            <button type="submit" name="login_user" class="btn btn-lg btn-primary">Sign
                                                In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="static/js/app.js"></script>

</body>

</html>