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

        <div class="row">
            <div class="col-10">
                <h1 class="h3 mb-3">Add Course</h1>
            </div>
            <div class="col-2">
                <button class="btn btn-sm btn-primary float-right" onclick="history.go(-1)"><i class="align-middle me-1" data-feather="arrow-left"></i>Back </button></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"></h5>
                    </div>
                    <div class="card-body">
                        <form action="saveCourse.php" method="post" id="addCourse">
                            <input type="hidden" class="form-control" value="addCourse" name="form_id">
                            <div class="row">
                                <div class="col-12 col-lg-1"></div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-2">
                                        <label class="form-label"><b>Course Name</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="courseName" name="courseName" placeholder="e.g Safety Airside Driving Course">
                                        </div>
                                    </div>
                                    <?php


                                    //Get last insertedID       
                                    $sql = $db->prepare("SELECT max(id) FROM courses");
                                    $sql->execute();
                                    $row = $sql->fetchColumn();
                                    $courseId = $row + 1;
                                    ?>
                                    <div class="mb-2">
                                        <label class="form-label"><b>Course ID</b></label>
                                        <div class="input-group">
                                            <input type='text' class="form-control" value="<?php echo 'SS-' . $courseId ?>" name="courseId" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>Validity (Yrs.)</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="validity" placeholder="e.g 2Yrs ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2"></div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-2">
                                        <label class="form-label"><b>Course Duration (Days)</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="duration" placeholder="e.g 10 Days">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>Cost (Ksh.)</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="cost" placeholder="e.g 10,000">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>Course Instructor</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="instructor" placeholder="e.g Martin Waweru">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-1"></div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-lg btn-primary"> Add Course </button>
                                </div>
                            </div>
                        </form>
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
                    <a href="https://github.com/martin" class="text-muted"><strong>MartinW</strong></a> &copy <?php echo date('Y') . "  "; ?>
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
    // VALIDATE COURSE CREATION FORM
    $(document).ready(function() {
        $('#addCourse').validate({
            rules: {
                courseName: {
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
                validity: {
                    required: true,
                    digits: true
                },
                duration: {
                    required: true,
                    digits: true
                },
                cost: {
                    required: true,
                    digits: true,
                    minlength: 0,
                },
                instructor: 'required',
            },
            messages: {
                courseName: {
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
</body>

</html>