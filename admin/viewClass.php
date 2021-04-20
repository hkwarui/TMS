<?php
include_once('../includes/header.php');
require_once '../includes/db_config.php'; ?>

<span id="alertMsg">
</span>

<?php
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

        <div class="row">
            <div class="col-10">
                <h1 class="h3 mb-3  float-right">Class: <?php echo $cohortId; ?></h1>
            </div>
            <div class="col-2">
                <button class="btn btn-sm btn-primary float-right" onclick="history.go(-1)"><i class="align-middle me-1" data-feather="arrow-left"></i>Back </button></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title  mb-0"><?php echo $row['courseId'] . "  " . $row['courseName'] ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-2">
                                <span><i class="align-middle me-1" data-feather="clock"></i> <?php echo $row1['startTime'] ?> Hrs.</span>
                            </div>
                            <div class="col-12 col-lg-2">
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
                            <div class="col-12 col-lg-4">
                                <button class="btn btn-sm btn-primary" id="inProgress"><i class="align-middle me-1" data-feather="loader"></i>InProgres</button>
                                <button class="btn btn-sm btn-primary" id="done"><i class="align-middle me-1" data-feather="check-circle"></i>Done</button>
                                <button class="btn btn-sm btn-primary" id="cancelled"><i class="align-middle me-1" data-feather="alert-triangle"></i>Cancelled</button>
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
                                <div class="col-4">
                                    <input type="hidden" id="courseId" value="<?php echo $courseId ?>">
                                    <button class="btn btn-sm btn-primary" id="completed" type="submit"><i class="align-middle me-1" data-feather="award"></i>Completed</button>
                                    <button class="btn btn-sm btn-primary" id="pass" type="submit"><i class="align-middle me-1" data-feather="user-check"></i>Pass</button>
                                    <button class="btn btn-sm btn-primary" id="fail" type="submit"><i class="align-middle me-1" data-feather="user-x"></i>Fail</button>
                                </div>
                                <div class="col-2">
                                    <a href="addParticipant.php?cid=<?php echo $courseId ?>&&id=<?php echo $cohortId ?>"> <button class="btn btn-sm btn-primary" id="completed" type="submit"><i class="align-middle me-1" data-feather="plus"></i>Add</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="editRecords.php" name="frmUser">
                                <table class="table table-responsive table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col"><input type="checkbox" id="checkAll"> </th>
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
                                                            echo '<span class="badge bg-success">' . ucwords($result['completion']) . '</span>';
                                                        }
                                                        if ($result['completion'] == 'incomplete') {
                                                            echo '<span class="badge bg-secondary">' . ucwords($result['completion']) . '</span>';
                                                        }
                                                        ?></td>
                                                    <td><?php if (!$result['perfomance']) {
                                                            echo "-------";
                                                        };
                                                        if ($result['perfomance'] == 'fail') { ?>
                                                            <span class='badge bg-danger'> <?php echo ucwords($result['perfomance']); ?> </span>
                                                        <?php  };
                                                        if ($result['perfomance'] == 'pass') { ?>
                                                            <span class='badge bg-success'><?php echo ucwords($result['perfomance']); ?> </span>
                                                        <?php }; ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        }
                                        if ($count <= 0) { ?>
                                            <tr>
                                                <td colspan="9"> No Participants in this Class ! </td>
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

        // mark class in progress
        $('#inProgress, #done ,#cancelled').on('click', function() {
            var status = $(this).attr('id');
            var courseId = $('#courseId').val()
            console.log(courseId);
            console.log(status);
            $.ajax({
                url: 'changeStatus.php',
                method: 'post',
                data: {
                    courseId,
                    status
                },
                success: function(data) {
                    $('#alertMsg').html('<div class="alert alert-success ml-5 p-1">Class status updated</div>');
                    setTimeout(function() {
                        location.reload();
                    }, 4000);
                },
                error: function(data) {
                    $('#alertMsg').html('<div class="alert alert-danger ml-5 p-1">Class status failed to update</div>');
                    setTimeout(function() {
                        location.reload();
                    }, 4000)
                }
            })
        })

        // mark completed
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
                success: function(res) {
                    console.log(res);
                    if (res == 1) {
                        $('#alertMsg').html('<div class="alert alert-success ml-5 p-1">Completion status updated</div>');
                        setTimeout(function() {
                            location.reload();
                        }, 4000);
                    }
                    if (res == 2) {
                        $('#alertMsg').html('<div class="alert alert-danger ml-5 p-1">No checkbox selected</div>');
                        setTimeout(function() {
                            location.reload();
                        }, 4000)
                    }
                },
                error: function(data) {
                    $('#alertMsg').html('<div class="alert alert-danger ml-5 p-1">No checkbox selected</div>');
                    setTimeout(function() {
                        location.reload();
                    }, 4000)
                }
            })
        });

        //Mark passed
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
                success: function(res) {
                    console.log(res);
                    if (res == 1) {
                        $('#alertMsg').html('<div class="alert alert-success ml-5 p-1">Performance status updated</div>');
                        setTimeout(function() {
                            location.reload();
                        }, 4000);
                    }
                    if (res == 2) {
                        $('#alertMsg').html('<div class="alert alert-danger ml-5 p-1">No checkbox selected</div>');
                        setTimeout(function() {
                            location.reload();
                        }, 4000)
                    }
                },
                error: function(data) {
                    console.log(data.responseText)
                }
            })
        });

        // mark failed
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
                success: function(res) {
                    console.log(res);
                    if (res == 1) {
                        $('#alertMsg').html('<div class="alert alert-success ml-5 p-1">Performance status updated</div>');
                        setTimeout(function() {
                            location.reload();
                        }, 4000);
                    }
                    if (res == 2) {
                        $('#alertMsg').html('<div class="alert alert-danger ml-5 p-1">No checkbox selected</div>');
                        setTimeout(function() {
                            location.reload();
                        }, 4000)
                    }
                },
                error: function(data) {
                    console.log(data.responseText);
                }
            })
        })

        //Select all participants
        $('#checkAll').click(function() {
            $('input:checkbox').prop('checked', this.checked);
        });
    })
</script>
</div>
</div>
</body>

</html>