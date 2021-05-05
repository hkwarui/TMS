<?php
include_once('../includes/header.php');
require_once '../includes/db_config.php';

//DISPLAY SUCCESS MESSAGE IF ANY
if (isset($_SESSION['msg'])) {
    echo '<div class="alert alert-success ml-5 p-1">';
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
    echo "</div>";
};

//DISPLAY ERROR MESSAGE IF ANY
if (isset($_SESSION['error_msg'])) {
    echo '<div class="alert alert-danger ml-5 p-1">';
    echo $_SESSION['error_msg'];
    unset($_SESSION['error_msg']);
    echo "</div>";
}
?>

<script>
    // HIDE MESSAGE AFTER 4 SECS
    $(function() {
        setTimeout(function() {
            $(".alert").hide('slow');
        }, 4000);
    });
</script>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Settings</h1>

        <div class="row">
            <div class="col-md-3 col-xl-2">

                <div class="card">
                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
                            Account
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
                            Change Password
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#delete" role="tab">
                            Delete account
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-xl-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">
                        <?php if (isInstructor()) {
                            $sth = $db->prepare("SELECT * FROM instructor  WHERE username = ?");
                            $sth->execute([$username]);
                            $row = $sth->fetch();
                        }
                        if (isFacilitator()) {
                            $sth = $db->prepare("SELECT * FROM facilitators  WHERE username = ?");
                            $sth->execute([$username]);
                            $row = $sth->fetch();
                        }
                        ?>

                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Public info</h5>
                            </div>
                            <div class="card-body">
                                <form action="saveProfile.php" method="post">
                                    <input type="hidden" name="form_id" value="public_info">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label" for="inputUsername">Username</label>
                                                <input type="text" class="form-control" value="<?php echo $username; ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="inputUsername">Biography</label>
                                                <textarea rows="2" class="form-control" id="inputBio" name="bio" placeholder="Tell something about yourself"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <img alt="Charles Hall" src="../static/img/avatars/avatar.jpg" class="rounded-circle img-responsive mt-2" width="128" height="128" />
                                                <div class="mt-2">
                                                    <span class="btn btn-primary">Upload</span>
                                                </div>
                                                <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Private info</h5>
                            </div>
                            <div class="card-body">
                                <form id='profile_info' method="post" action="saveProfile.php">
                                    <input type="hidden" class="form-control" name="form_id" value="profile_info">
                                    <input type="hidden" class="form-control" name="username" value="<?php echo $username ?>">

                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="FirstName">First name</label>
                                            <div class="input-group">
                                                <input type="text" name="fullname" class="form-control" value="<?php if (isset($row['fullname'])) {
                                                                                                                    echo $row['fullname'];
                                                                                                                } ?>" id="inputFirstName">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="passport">ID. /Passport no.</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="<?php if (isset($row['passport'])) {
                                                                                                    echo $row['passport'];
                                                                                                }; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class=" form-label" for="email">Email</label>
                                            <div class="input-group">
                                                <input type="email" name='email' class="form-control" value="<?php if (isset($row['email'])) {
                                                                                                                    echo $row['email'];
                                                                                                                }; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class=" form-label" for="phone">Phone</label>
                                            <div class="input-group">
                                                <input type="phone" name="phone" class="form-control" value="<?php if (isset($row['phone'])) {
                                                                                                                    echo $row['phone'];
                                                                                                                }; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class=" form-label" for="company">Company</label>
                                            <div class="input-group">
                                                <input type="text" name="company" readonly class="form-control" value="<?php if (isset($row['company'])) {
                                                                                                                            echo $row['company'];
                                                                                                                        }; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class=" form-label" for="designation">Designation</label>
                                            <div class="input-group">
                                                <input type="text" name='designation' n class="form-control" value="<?php if (isset($row['designation'])) {
                                                                                                                        echo $row['designation'];
                                                                                                                    }; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label" for="address">Address</label>
                                            <div class="input-group">
                                                <input type="text" name="address" class="form-control" value="<?php if (isset($row['address'])) {
                                                                                                                    echo $row['address'];
                                                                                                                }; ?>">
                                            </div>
                                        </div>
                                        <div class=" mb-3 col-md-4">
                                            <label class="form-label" for="city">City</label>
                                            <div class="input-group">
                                                <input type="text" value="<?php if (isset($row['city'])) {
                                                                                echo $row['city'];
                                                                            }; ?>" name="city" class=" form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label" for="state">State</label>
                                            <div class="input-group">
                                                <input type="text" name="state" value="<?php if (isset($row['state'])) {
                                                                                            echo $row['state'];
                                                                                        }; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>

                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" id='password_change' action="saveProfile.php">
                                    <input type="hidden" class="form-control" name="form_id" value="password_change">
                                    <input type="hidden" class="form-control" name="username" value="<?php echo $username ?>">

                                    <div class="mb-3">
                                        <label class="form-label" for="inputPasswordCurrent">Current password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="old_password">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="inputPasswordNew">New password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id='new_password' name="password">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="inputPasswordNew2">Verify password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password_confirm">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="delete" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 style="color:red">Type your password to delete your account. This action is irreversible</h5>
                            </div>
                            <div class="card-body">
                                <form method="post" id='delete_account' action="saveProfile.php">
                                    <input type="hidden" class="form-control" name="form_id" value="delete_account">
                                    <input type="hidden" class="form-control" name="username" value="<?php echo $username ?>">

                                    <div class="mb-3">
                                        <label style="color:red" class="form-label" for="inputPasswordCurrent">Current password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-6 text-start">
                <p class="mb-0">
                    <a href="https://github.com/hkwarui" class="text-muted"><strong>hkwarui</strong></a> &copy <?php echo date('Y') . "  "; ?>
                </p>
            </div>
            <div class="col-6 text-end">
            </div>
        </div>
    </div>
</footer>

<script>
    $(document).ready(function() {

        // Validate password reset form
        $('#password_change').validate({
            rules: {
                old_password: 'required',
                password: {
                    required: true,
                    minlength: 6,
                },
                password_confirm: {
                    equalTo: '#new_password',
                    minlength: 6,
                    required: true,
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                form.submit();
            }
        })

        //Validate  delete account form

        $('#delete_account').validate({
            rules: {
                password: 'required',
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                form.submit();
            }
        })

        //Validate  profile info form

        $('#profile_info').validate({
            rules: {
                fullname: 'required',
                email: {
                    email: true,
                    required: true
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 13
                },
                company: 'required',
                designation: 'required'
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                form.submit();
            }
        })
    })
</script>

</div>
</div>
</body>

</html>