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

<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-10">
                <h1 class="h3 mb-3">Participants</h1>
            </div>
            <div class="col-2">
                <button class="btn btn-sm btn-primary float-right" onclick="history.go(-1)"><i class="align-middle me-1" data-feather="arrow-left"></i>Back </button></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-sm" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">ID./Passport</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if (isFacilitator()) {
                                    $sth = $db->prepare("SELECT * FROM participants WHERE company = ? ORDER BY fullname ASC");
                                    $sth->execute([$company['company']]);
                                }
                                if (isInstructor()) {
                                    $sth = $db->prepare("SELECT * FROM participants ORDER BY fullname ASC");
                                    $sth->execute();
                                }

                                $count = $sth->rowCount();
                                if ($count > 0) {
                                    while ($result = $sth->fetch()) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo $no++; ?></th>
                                            <td><?php echo ucwords($result['fullname']); ?></td>
                                            <td><?php echo $result['email']; ?></td>
                                            <td><?php echo $result['phone']; ?></td>
                                            <td><?php echo $result['passport']; ?></td>
                                            <td><?php echo ucwords($result['company']); ?></td>
                                            <td><?php echo ucwords($result['designation']); ?></td>
                                            <td>
                                                <a title="View" href="viewRecords.php?id=<?php echo $result['id'] ?>"><i class="align-middle me-1" data-feather="eye"></i></a><a title="Edit" href="editParticipants.php?id=<?php echo $result['id'] ?>"><i class="align-middle me-1" data-feather="edit-2"></i></a>
                                            </td>
                                        </tr>
                                    <?php }
                                }
                                if ($count <= 0) { ?>
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
</main>

<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-6 text-start">
                <p class="mb-0">
                    <a href="https://github.com/hkwarui" class="text-muted"><strong>MartinW</strong></a> &copy <?php echo date('Y') . "  "; ?>
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
        $('#myTable').dataTable({})
    })
</script>

</body>

</html>