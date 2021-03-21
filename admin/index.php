<?php
session_start();
include_once('../includes/header.php')
 ?>


<main class="content">
    <?php if(isset($_SESSION['msg'])){ ?>
    <div class="alert alert-success">
        <?php  echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            header('refresh:3');
            ?>

    </div>
    <?php } ?>
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Blank Page</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Empty card</h5>
                    </div>
                    <div class="card-body">
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
                    <a href="index.html" class="text-muted"><strong>AdminKit Demo</strong></a> &copy;
                </p>
            </div>
            <div class="col-6 text-end">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Support</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Help Center</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Privacy</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Terms</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</div>
</div>

<script src="../static/js/app.js"></script>

</body>

</html>