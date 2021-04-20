<?php
include_once('../includes/header.php');
require_once '../includes/db_config.php';

//check if values of course and cohort are set
if (isset($_GET['cid']) &&  isset($_GET['id'])) {
    $courseId = $_GET['cid'];
    $cohortId = $_GET['id'];
    $q = $db->prepare("SELECT courseName FROM courses WHERE courseId =?");
    $q->execute([$courseId]);
    $coz = $q->fetch();
}

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
                <h1 class="h3 mb-3">Add Participant</h1>
            </div>
            <div class="col-2">
                <button class="btn btn-sm btn-primary float-right" onclick="history.go(-1)"><i class="align-middle me-1" data-feather="arrow-left"></i>Back </button></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="saveParticipant.php" method="post" id="addParticipant">
                            <input type="hidden" class="form-control" value="addParticipant" name="form_id">
                            <div class="row">
                                <div class="col-12 col-lg-1"></div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-2">
                                        <label class="form-label"><b>FullName</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="fullname" placeholder=" e.g Henry Warui">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>Email</b></label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" name="email" placeholder="e.g  warui@gmail.com">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b> Phone No.</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="phone" placeholder="e.g  0713456985">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>ID. No / PPT. No</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="passport" placeholder="e.g  28572045">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2"></div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-2">
                                        <label class="form-label"><b>Company</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="company" placeholder="e.g  Sharp Technologie ltd.">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>Designation</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="designation" placeholder="e.g  Software Developer">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>Select Course</b></label>
                                        <div class="input-group">
                                            <select class="form-control course" name="course">
                                                <?php if ($courseId) { ?>
                                                    <option value="<?php echo $courseId ?>" readonly><?php echo $coz['courseName'] ?></option>
                                                <?php } else { ?>
                                                    <option value="">Select a course</option>
                                                    <?php
                                                    $sql =  $db->prepare('SELECT courseName, courseId FROM courses');
                                                    $sql->execute();
                                                    while ($row = $sql->fetch()) {
                                                    ?>
                                                        <option value="<?php echo $row['courseId']; ?>"> <?php echo $row['courseName']; ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>Select Class</b></label>
                                        <div class="input-group">
                                            <select class="form-control" id="cohort" name="cohort">
                                                <?php if ($courseId) { ?>
                                                    <option value="<?php echo $cohortId ?>" readonly><?php echo $cohortId ?></option>
                                                <?php } else { ?>
                                                    <option value="">Select a class</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-1"></div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-lg btn-primary"> Add </button>
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
    $(document).ready(function() {

        //Load class field from when you select a course
        $('.course').on("change", function(e) {
            e.preventDefault();
            var partId = $(this).val()

            $.ajax({
                url: 'loadData.php',
                method: 'post',
                data: {
                    partId
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    if (data.length) {
                        $("#cohort option").remove();
                        for (var i = 0; i < data.length; i++) {
                            $('#cohort').append('<option value="' + data[i] + '">' + data[i] + '</option>');
                        }
                    }

                    if (!data.length) {
                        $("#cohort option").remove();
                        $('#cohort').append('<option value=""> No scheduled class. </option>');
                    }
                },
                error: function(data) {
                    console.log(data.responseText);
                }

            })
        })


        //Validate  add participant form
        $('#addParticipant').validate({
            rules: {
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
                company: 'required',
                designation: 'required',
                course: 'required',
                cohort: 'required'
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