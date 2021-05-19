<?php
include_once('../includes/header.php');
require_once '../includes/db_config.php';

$id = $_GET['id'];
$stm = $db->prepare("SELECT * FROM cohorts WHERE id = ?");
$stm->execute([$id]);
$row = $stm->fetch();

$stm1 = $db->prepare("SELECT * FROM courses WHERE courseId = ?");
$stm1->execute([$row['courseId']]);
$row1 = $stm1->fetch();

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
                <h1 class="mb-3">Edit class</h1>
            </div>
            <div class="col-2">
                <button class="btn btn btn-info float-right" onclick="history.go(-1)"><i class="align-middle me-1" data-feather="arrow-left"></i>Back </button></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mb-0"><b><?php echo $row1['courseId'] . "  : " . $row1['courseName'] ?></b></h3>
                    </div>
                    <div class="card-body">
                        <form action="saveSheduleClass.php" method="post" class="scheduleClass">
                            <input type="hidden" class="form-control" value="editClass" name="form_id">
                            <input type="hidden" class="form-control" value="<?php echo $row['id'] ?>" name="id">
                            <input type="hidden" class="form-control" value="<?php echo $row1['courseId'] ?>" name="course">
                            <div class="row">
                                <div class="col-12 col-lg-1"></div>
                                <div class="col-12 col-lg-4">
                                    <div class="mb-2">
                                        <label class="form-label"><b>Date</b></label>
                                        <div class="input-group">
                                            <input type='date' value="<?php echo $row['date'] ?>" class="form-control" name="startTime">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>Start Time</b></label>
                                        <div class="input-group">
                                            <input type='time' value="<?php echo $row['startTime'] ?>" class="form-control" name="startTime">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label"><b>Venue</b></label>
                                        <div class="input-group">
                                            <input type="text" value="<?php echo ucwords($row['venue']); ?>" class="form-control" name="venue">
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
                                            <input type="text" class="form-control" value=" <?php echo $row1['instructor'] ?>" id=" instructor" name="instructor" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-1"></div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-lg btn-primary"> Update Class </button>
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
</body>

</html>