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
        <h1 class="h3 mb-3">Company Facilitators</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Id/Passport</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                //Load Classes info
                                $sth = $db->prepare("SELECT * FROM facilitators ");
                                $sth->execute();
                                $row1 = $sth->fetch();
                                if ($row1) {
                                    while ($result = $sth->fetch()) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo $no++; ?></th>
                                            <td><?php echo ucwords($result['username']); ?></td>
                                            <td><?php echo ucwords($result['fullname']); ?></td>
                                            <td><?php echo $result['email']; ?></td>
                                            <td><?php echo $result['phone']; ?></td>
                                            <td><?php echo $result['passport']; ?></td>
                                            <td><?php echo ucwords($result['company']); ?></td>
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