<?php
include_once '../includes/header.php';
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

    // Load participant info
    $partId = $_GET['id'];
    $stm = $db->prepare("SELECT * FROM  participants WHERE  id= ?");
    $stm->execute([$partId]);
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
        <div class="row">
            <div class="col-10">
                <h1 class="h3 mb-3  float-right"><?php echo ucfirst($row['fullname']); ?>
            </div>
            <div class="col-2">
                <button class="btn btn-sm btn-primary float-right" onclick="history.go(-1)"><i class="align-middle me-1" data-feather="arrow-left"></i>Back </button></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <h5 class="card-title  mb-0">Participants  Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <span><i class="align-middle me-1" data-feather="at-sign"></i> <?php echo $row['email'] ?></span>
                            </div>
                            <div class="col-12 col-lg-3">
                                <span><i class="align-middle me-1" data-feather="user-check"></i><?php echo ucwords($row['passport']) ?></span>
                            </div>
                            <div class="col-12 col-lg-2">
                                <span><i class="align-middle me-1" data-feather="home"></i> <?php echo $row['company'] ?></span>
                            </div>
                            <div class="col-12 col-lg-2">
                                <span><i class="align-middle me-1" data-feather="user"></i><?php echo  $row['designation']; ?> </span>
                            </div>
                            <div class="col-12 col-lg-2">
                                <?php if (isInstructor()) { ?>
                                    <span> <a title="Edit" href="editCourse.php?id=<?php echo $row['courseId'] ?>"><i class="align-middle me-1" data-feather="edit-2"></i></a><a onclick="return confirm('Please confirm deletion');" title="Delete" href="deleteCourse.php?id=<?php echo $row['id']; ?>?coz_id=<?php echo $row['courseId']; ?>"><i class="align-middle me-1" data-feather="trash-2"></i></a> </span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Records</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-sm" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">class Code</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">Venue</th>
                                        <th scope="col">perfomance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    //Load Classes info
                                    $sth = $db->prepare("SELECT * FROM class_records  WHERE stud_id = ?");
                                    $sth->execute([$row['passport']]);
                                    $count = $sth->rowCount();
                                    if ($count > 0) {
                                        while ($result = $sth->fetch()) {
                                       ?>
                                            <tr>
                                                <th scope="row"><?php echo $no++; ?></th>
                                                <td><?php echo $result['courseId']; ?></td>
                                                <td><?php echo $result['classCode']; ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($result['startDate'])); ?></td>
                                                <td><?php echo $result['venue']; ?></td>
                                                <td>
                                                <?php if (!$result['result']) {
                                                            echo "-------";
                                                        };
                                                        if ($result['result'] == 'fail') { ?>
                                                            <span class='badge bg-danger'> <?php echo ucwords($result['result']); ?> </span>
                                                        <?php  };
                                                        if ($result['result'] == 'pass') { ?>
                                                            <span class='badge bg-success'><?php echo ucwords($result['result']); ?> </span>
                                                        <?php }; ?>
                                                        </td>
                                                                                            </tr>
                                        <?php }
                                    }
                                    if ($count <= 0) { ?>
                                        <tr>
                                            <td colspan="5"> No Scheduled classes in this Course ! </td>
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

</body>

</html>