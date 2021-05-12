<?php
include_once('../includes/header.php');
require_once '../includes/db_config.php';

//DISPLAY A MESSAGE IF ANY 
if (isset($_SESSION['msg'])) {
    echo '<div class="alert alert-success ml-5 p-1">';
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
    echo "</div>";
} ?>

<script>
    // HIDE MESSAGE AFTER 4 SECS
    $(function() {
        setTimeout(function() {
            $(".alert").hide('slow');
        }, 4000);
    });
</script>

<?php
// count courses
$sth =  $db->prepare('SELECT count(*) FROM courses');
$sth->execute();
$totCourses = $sth->fetchColumn();

//Count participants 

if (isInstructor()) {
    $sth =  $db->prepare('SELECT count(*) FROM participants');
    $sth->execute();
    $totParticipants = $sth->fetchColumn();
}

if (isFacilitator()) {
    $sth =  $db->prepare('SELECT * FROM participants WHERE company = "$company"');
    $sth->execute();
    $totParticipants = $sth->rowCount();
}


//Count Instructors 
$sth =  $db->prepare('SELECT count(*) FROM instructor');
$sth->execute();
$totInstructor = $sth->fetchColumn();
?>

<main class="content">
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Analytics</strong> Dashboard</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Courses</h5>
                        <h1 class="mt-1 mb-3"><?php echo $totCourses ?></h1>
                        <!-- <div class="mb-1">
                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                            <span class="text-muted">Since last week</span>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Participants</h5>
                        <h1 class="mt-1 mb-3"><?php echo $totParticipants ?></h1>
                        <!-- <div class="mb-1">
                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                            <span class="text-muted">Since last week</span>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Instrutors</h5>
                        <h1 class="mt-1 mb-3"><?php echo $totInstructor ?></h1>
                        <!-- <div class="mb-1">
                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                            <span class="text-muted">Since last week</span>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card flex-fill">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Latest Courses</h5>
                    </div>
                    <table class="table table-sm table-hover my-0">
                        <thead>
                            <tr>
                                <th> Course Name</th>
                                <th class="d-none d-md-table-cell">Instructor</th>
                                <th class="d-none d-xl-table-cell">Duration (Days)</th>
                                <th class="d-none d-xl-table-cell">Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stm = $db->prepare("SELECT * FROM courses");
                            $stm->execute();
                            while ($row = $stm->fetch()) {
                            ?>
                                <tr>
                                    <td><?php echo $row['courseId'] . " : " . $row['courseName'] ?></td>
                                    <td class="d-none d-md-table-cell"><?php echo $row['instructor'] ?></td>
                                    <td class="d-none d-xl-table-cell"><?php echo $row['duration'] ?></td>
                                    <td><span class="badge bg-success"></span> <?php echo "Ksh. " . $row['cost'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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
</body>

</html>