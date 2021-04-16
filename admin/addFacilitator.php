<?php
include_once('../includes/header.php');

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
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
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
        <h1 class="h3 mb-3">Add Facilitator</h1>
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="saveFacilitator.php" method="post" id="add_facilitator">
                            <input type="hidden" class="form-control" value="add_facilitator" name="form_id">
                            <div class="row">
                                <div class="col-12 col-lg-1"></div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-2">
                                        <label class="form-label"><b>Username</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="username">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>FullName</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="fullname" placeholder="Fullname">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>Email</b></label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2"></div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-2">
                                        <label class="form-label"><b> Phone No.</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="phone" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>ID. No / PPT. No</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="passport" placeholder="ID / Passport No.">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>Company</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="company" placeholder="Company">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-1"></div>
                                <div class="text-center mt-4">
                                    <button type="submit" name="login_user" class="btn btn-lg btn-primary"> Add </button>
                                </div>
                            </div>
                        </form>
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

</div>
</div>


<script>
    // VALIDATE FACILITATOR ADD FORM
    $(document).ready(function() {
        $('#add_facilitator').validate({
            rules: {
                username: {
                    required: true,
                    minlength: 3,
                    remote: {
                        url: "check_username.php",
                        type: "post",
                        data: {
                            username: function() {
                                return $("#username").val();
                            }
                        },
                        dataType: 'json'
                    },
                },
                fullname: 'required',
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 12
                },
                passport: {
                    required: true,
                    digits: true
                },
                company: 'required'
            },
            messages: {
                username: {
                    remote: "Username is already taken"
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
    })
</script>

<script src="../static/js/app.js"></script>

</body>

</html>