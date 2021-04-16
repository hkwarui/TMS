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

    $courseId = $_GET['cid'];
    $cohortId = $_GET['id'];
    // Load courses info

    $stm = $db->prepare("SELECT * FROM courses WHERE courseId= ?");
    $stm->execute([$courseId]);
    $row = $stm->fetch();

    //Load cohorts info

    $stm1 = $db->prepare("SELECT * FROM cohorts WHERE cohortId= ?");
    $stm1->execute([$cohortId]);
    $row1 = $stm1->fetch();
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
        <h1 class="h3 mb-3  float-right">Class: <?php echo $cohortId; ?></h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title  mb-0"><?php echo $row['courseId'] . "  " . $row['courseName'] ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <span><i class="align-middle me-1" data-feather="clock"></i> <?php echo $row1['startTime'] ?> Hrs.</span>
                            </div>
                            <div class="col-12 col-lg-3">
                                <span><i class="align-middle me-1" data-feather="user-check"></i> Taught by <?php echo ucwords($row['instructor']) ?></span>
                            </div>
                            <div class="col-12 col-lg-2">
                                <span><i class="align-middle me-1" data-feather="home"></i> <?php echo $row1['venue'] ?> </span>
                            </div>

                            <div class="col-12 col-lg-2">
                                <span> <a title="Edit" href="editCourse.php?id=<?php echo $row['courseId'] ?>"><i class="align-middle me-1" data-feather="edit-2"></i></a><a onclick="return confirm('Please confirm deletion');" title="Delete" href="deleteCourse.php?id=<?php echo $row['id']; ?>?coz_id=<?php echo $row['courseId']; ?>"><i class="align-middle me-1" data-feather="trash-2"></i></a> </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Participants</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-sm" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">FullName</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">ID/Passport</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    //Load Classes info
                                    $sth = $db->prepare("SELECT * FROM participants WHERE cohortId = ?");
                                    $sth->execute([$cohortId]);
                                    $count = $sth->rowCount();
                                    if ($count > 0) {
                                        while ($result = $sth->fetch()) {
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $no++; ?></th>
                                                <td><?php echo $result['fullname']; ?></td>
                                                <td><?php echo $result['email']; ?></td>
                                                <td><?php echo $result['phone']; ?></td>
                                                <td><?php echo $result['passport']; ?></td>
                                                <td><?php echo $result['company']; ?></td>
                                                <td><?php echo $result['designation']; ?></td>
                                                <td> <a title="Edit" href="editClass.php?id=<?php echo $result['id'] ?>"><i class="align-middle me-1" data-feather="edit-2"></i></a><a onclick="return confirm('Please confirm deletion');" title="Delete" href="deleteClass.php?id=<?php echo $result['id']; ?>?coz_id=<?php echo $result['courseId']; ?>"><i class="align-middle me-1" data-feather="trash-2"></i></a> </td>
                                            </tr>
                                        <?php }
                                    }
                                    if ($count <= 0) { ?>
                                        <tr>
                                            <td colspan="8"> No Participants in this Class ! </td>
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
</body>

</html>