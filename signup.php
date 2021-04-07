<?php
include_once("login.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="Tangla, Gardens, Farm, admin, Poulty, Farming, Transport, greenhouse ">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="static/fontawesome-free/css/all.min.css">
    <link rel="shortcut icon" href="static/img/icons/favicon.png" />
    <title>TMS - Sign In</title>
    <link href="static/css/app.css" rel="stylesheet">
    <script src="static/js/jquery.min.js"></script>
    <script src="static/js/jquery.validate.min.js"></script>
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
                                    <form method="post" id="admin_signup">
                                        <div class="mb-2">
                                            <label class="form-label"><b>Username</b></label>
                                            <div class="input-group">
                                                <div class="input-group-text bg-primary">
                                                    <span class="fas fa-user" style="color:white"></span>
                                                </div>
                                                <input class="form-control form-control-lg" type="text" id="username" name="username">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"><b> Full Name</b></label>
                                            <div class="input-group">
                                                <div class="input-group-text bg-primary">
                                                    <span class="fas fa-user" style="color:white"></span>
                                                </div>
                                                <input class="form-control form-control-lg" type="text" id="fullname" name="fullname">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"><b>Company</b></label>
                                            <div class="input-group">
                                                <div class="input-group-text bg-primary">
                                                    <span class="fas fa-home" style="color:white"></span>
                                                </div>
                                                <input class="form-control form-control-lg" type="text" id="company" name="company">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"><b>Email</b></label>
                                            <div class="input-group">
                                                <div class="input-group-text bg-primary">
                                                    <span class="fas fa-envelope" style="color:white"></span>
                                                </div> <input class="form-control form-control-lg" type="email" id="email" name="email">
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label"><b>Password</b></label>
                                            <div class="input-group">
                                                <div class="input-group-text bg-primary">
                                                    <span class="fas fa-lock" style="color:white"></span>
                                                </div>
                                                <input class="form-control form-control-lg" type="password" id="password" name="password">
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label"><b> Confirm Password</b></label>
                                            <div class="input-group">
                                                <div class="input-group-text bg-primary">
                                                    <span class="fas fa-lock" style="color:white"></span>
                                                </div>
                                                <input class="form-control form-control-lg" type="password" id="confirm_password" name="confirm_password">
                                            </div>
                                        </div>
                                        <small>
                                            <a href="index.php"><b> Have an account ? Login </b></a>
                                        </small>
                                        <div class="text-center mt-2">
                                            <!-- <a href="index.html" class="btn btn-lg btn-primary">Sign in</a> -->
                                            <button type="submit" name="signup_user" class="btn btn-lg btn-primary">Sign
                                                in</button>
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
    <script>
        // SIGN UP FORM VALIDATION 
        $(document).ready(function() {
            $('#admin_signup').validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 5
                    },
                    fullname: 'required',
                    email: {
                        required: true,
                        email: true
                    },
                    company: "required",
                    password: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: '#password'
                    }
                },
                messages: {
                    username: {
                        required: 'username is required',
                    },
                    // fullname: "Name is required",
                    // company: 'Company is required',
                    // password: {
                    //     required: "Password is required",
                    // },
                    // confirm_password: {
                    //     required: 'Repeat password is required',
                    //     equalTo: 'Must be the same as password'
                    // }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhihlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    error.reClass('invalid-feedback');
                    // $(element).addClass('valid');
                },
                submitHandler: function(form) {
                    form.submit();
                }
            })
        })
    </script>

    <script src="static/js/app.js"></script>

</body>

</html>