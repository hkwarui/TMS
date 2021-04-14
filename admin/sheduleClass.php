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
        <h1 class="h3 mb-3"> Shedule class</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="saveSheduleClass.php" method="post" class="scheduleClass">
                            <input type="hidden" class="form-control" value="sheduleClass" name="form_id">
                            <div class="row">
                                <div class="col-12 col-lg-1"></div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-2">
                                        <label class="form-label"><b>Select Course </b></label>
                                        <div class="input-group">
                                            <select class="form-control course" id="course" name="course">
                                                <?php
                                                $sql = $db->prepare("SELECT * FROM courses");
                                                $sql->execute();
                                                while ($row = $sql->fetch()) {;
                                                ?>
                                                    <option value="<?php echo $row['courseId'] ?>"><?php echo $row['courseName'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>Start Time</b></label>
                                        <div class="input-group">
                                            <input type='time' class="form-control" name="startTime">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>Venue</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="venue" placeholder="e.g Online ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2"></div>
                                <?php
                                $sql2 = $db->prepare("SELECT max(id) FROM cohorts");
                                $sql2->execute();
                                $row2 = $sql2->fetchColumn();
                                $cohortId = $row2 + 1;
                                ?>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-2">
                                        <label class="form-label"><b>Cohort</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="cohort" value="<?php echo "Cohort-0" . $cohortId . "/" . date('Y') ?>" placeholder="e.g Cohort01/2021" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>Course Instructor</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="instructor" name="instructor" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-1"></div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-lg btn-primary"> Schedule Class </button>
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
        // Populate Instructor field when you select a course
        $('.course').on("change", function(e) {
            e.preventDefault();
            var courseId = $(this).val();

            $.ajax({
                url: 'loadData.php',
                method: 'post',
                data: {
                    courseId: courseId
                },
                dataType: 'json',
                success: function(data) {
                    $('#instructor').val(data['instructor'])
                },
                error: function(data) {
                    console.log(data);
                }

            })
        });
        // Validate schedule class form 

        $('.scheduleClass').validate({
            rules: {
                course: 'required',
                startTime: 'required',
                venue: 'required',
                cohort: 'required',
                instructor: 'required',
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