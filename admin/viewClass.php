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
                                <span><i class="align-middle me-1" data-feather="flag"></i> <?php if ($row1['status'] === 'scheduled') {
                                                                                                echo "<span class='badge bg-secondary'>" . ucwords($row1['status']) . "</span>";
                                                                                            }
                                                                                            if ($row1['status'] === 'inProgress') {
                                                                                                echo "<span class='badge bg-info'>" . $row1['status'] . "</span>";
                                                                                            }
                                                                                            if ($row1['status'] === 'cancelled') {
                                                                                                echo "<span class='badge bg-danger'>" . ucwords($row1['status']) . "</span>";
                                                                                            }
                                                                                            if ($row1['status'] === 'done') {
                                                                                                echo "<span class='badge bg-success'>" . ucwords($row1['status']) . "</span>";
                                                                                            }
                                                                                            ?>
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
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title mb-0">Participants Record</h5>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-sm btn-primary" id="completed" type="submit">Completed</button>
                                    <button class="btn btn-sm btn-primary" id="pass" type="submit">Pass</button>
                                    <button class="btn btn-sm btn-primary" id="fail" type="submit">Fail</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="editRecords.php" name="frmUser">
                                <table class="table table-responsive table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">FullName</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">ID/Passport</th>
                                            <th scope="col">Company</th>
                                            <th scope="col">Designation</th>
                                            <th scope="col">Completion</th>
                                            <th scope="col">Perfomance</th>
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
                                                <tr class="myTable">
                                                    <!-- <th scope="row"><?php echo $no++; ?></th> -->
                                                    <td><input type="checkbox" name="users[]" value="<?php echo $result["id"]; ?>"></td>
                                                    <td><?php echo $result['fullname']; ?></td>
                                                    <td><?php echo $result['email']; ?></td>
                                                    <td><?php echo $result['phone']; ?></td>
                                                    <td><?php echo $result['passport']; ?></td>
                                                    <td><?php echo $result['company']; ?></td>
                                                    <td><?php echo $result['designation']; ?></td>
                                                    <td><?php if ($result['completion'] == 'completed') {
                                                            echo '<span class="badge bg-success">' . $result['completion'] . '</span>';
                                                        }
                                                        if ($result['completion'] == 'incomplete') {
                                                            echo '<span class="badge bg-secondary
                                                            
                                                            ">' . $result['completion'] . '</span>';
                                                        }
                                                        ?></td>
                                                    <td><?php if (!$result['perfomance']) {
                                                            echo "-------";
                                                        };
                                                        if ($result['perfomance'] == 'fail') { ?>
                                                            <span class='badge bg-danger'> <?php echo $result['perfomance']; ?> </span>
                                                        <?php  };
                                                        if ($result['perfomance'] == 'pass') { ?>
                                                            <span class='badge bg-success'><?php echo $result['perfomance']; ?> </span>
                                                        <?php }; ?>
                                                    </td>
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
                            </form>
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
        $('#completed').on('click', function() {
            console.log("Completed button clicked ");
            var selectedUser = new Array();
            $('.myTable input[type="checkbox"]:checked').each(function() {
                selectedUser.push(this.value);
            })
            console.log(selectedUser);
            $.ajax({
                url: 'markComplete.php',
                method: 'post',
                data: {
                    data: selectedUser
                },
                success: function(data) {
                    console.log(data);
                    location.reload();
                },
                error: function(data) {
                    console.log(data.responseText)
                }
            })
        });
        $('#pass').on('click', function(e) {
            e.preventDefault();

            console.log("pass button clicked ");
            var selectedUser = new Array();
            $('.myTable input[type="checkbox"]:checked').each(function() {
                selectedUser.push(this.value);
            })
            console.log(selectedUser);
            $.ajax({
                url: 'markPass.php',
                method: 'post',
                data: {
                    data: selectedUser
                },
                success: function(data) {
                    console.log(data);
                    location.reload();

                },
                error: function(data) {
                    console.log(data.responseText)
                }
            })
        });
        $('#fail').on('click', function() {
            console.log("fail button clicked ");
            var selectedUser = new Array();
            $('.myTable input[type="checkbox"]:checked').each(function() {
                selectedUser.push(this.value);
            })
            console.log(selectedUser);
            $.ajax({
                url: 'markFail.php',
                method: 'post',
                data: {
                    data: selectedUser
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    location.reload();
                },
                error: function(data) {
                    console.log(data.responseText);
                }
            })
        })
    })
</script>
</div>
</div>
</body>

</html>