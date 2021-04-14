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


if (isset($_GET['id'])) {

    // Load courses info
    $courseId = $_GET['id'];
    $stm = $db->prepare("SELECT * FROM courses WHERE courseId= ?");
    $stm->execute([$courseId]);
    $row = $stm->fetch();
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
        <h1 class="h3 mb-3  float-right"><?php echo $row['courseId'] . ": " . $row['courseName'] ?></h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title  mb-0">Course Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <span><i class="align-middle me-1" data-feather="activity"></i> Valid for <?php echo $row['validity'] ?> Years.</span>
                            </div>
                            <div class="col-12 col-lg-3">
                                <span><i class="align-middle me-1" data-feather="clock"></i> <?php echo $row['duration'] ?> To complete the Course.</span>
                            </div>
                            <div class="col-12 col-lg-3">
                                <span><i class="align-middle me-1" data-feather="user-check"></i> Taught by <?php echo ucwords($row['instructor']) ?></span>
                            </div>
                            <div class="col-12 col-lg-3">
                                <span><a href="http://"><i class="align-middle me-1" data-feather="edit-2"></i></a><a href="http://"><i class="align-middle me-1" data-feather="trash-2"></i></a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Sheduled Classes </h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Class Name</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Venue</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    //Load Classes info
                                    $sth = $db->prepare("SELECT * FROM cohorts WHERE courseId = ?");
                                    $sth->execute([$courseId]);
                                    $row1 = $sth->fetch();
                                    if ($row1) {
                                        while ($result = $sth->fetch()) {
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $no++; ?></th>
                                                <td><?php echo $result['cohortId']; ?></td>
                                                <td><?php echo $result['startTime']; ?></td>
                                                <td><?php echo $result['venue']; ?></td>
                                                <td> <a href="http://"><i class="align-middle me-1" data-feather="edit-2"></i></a><a href="http://"><i class="align-middle me-1" data-feather="trash-2"></i></a> </td>
                                            </tr>
                                        <?php }
                                    }
                                    if (!$row1) { ?>
                                        <tr>
                                            <td colspan="5"><b> No Scheduled classes in this Course !</b> </td>
                                        </tr>
                                    <?php   } ?>
                                </tbody>
                            </table>
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

</div>
</div>

<script src="../static/js/app.js"></script>

</body>

</html>