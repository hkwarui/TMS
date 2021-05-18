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
                <h1 class="h3 mb-3">Courses </h1>
            </div>
            <div class="col-2">
                <button class="btn btn-sm btn-primary float-right" onclick="history.go(-1)"><i class="align-middle me-1" data-feather="arrow-left"></i>Back </button></h1>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12 col-lg-3"></div>
            <div class="col-12 col-lg-6">
                <input class="form-control search" id="searchCourse" type="text" placeholder="Search..." arial-label="Search">
            </div>
            <div class="col-12 col-lg-3"></div>
        </div>

        <div class="search-div">
            <div class="row searchDisplay">
            </div>
        </div>

        <div class="coursesDisplay">
            <div class="row">
                <?php
                $stm = $db->prepare("SELECT * FROM courses");
                $stm->execute();
                while ($row = $stm->fetch()) {
                ?>
                    <div class="col-12 col-lg-3">
                        <a href="viewCourse.php?id=<?php echo $row['courseId']; ?>">
                            <div class="card">
                                <div class="card-body">
                                    <h6><?php echo $row['courseId'] . ":  " . ucwords($row['courseName']); ?></h6>
                                    <hr>
                                    <p><?php echo $row['duration'] . " Hours of content" ?></p>
                                    <p>Cost:<?php echo " Ksh. " . $row['cost'] ?></p>
                                    <p>Instructor:<?php echo $row['instructor'] ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
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
<script>
    $(document).ready(function() {

        // search a course 
        $('#searchCourse').on('keyup', function(e) {
            e.preventDefault();

            var searchTerm = $(this).val();
            $('.coursesDisplay').hide();

            $.ajax({
                url: 'loadData.php',
                method: 'post',
                data: {
                    searchTerm
                },
                dataType: 'json',
                success: function(data) {
                    if (searchTerm && data.length > 0) {

                        $(".coursesDisplay").hide();
                        $('.searchDisplay div').remove();
                        $('.searchDisplay p').remove();
                        data.forEach(element => {
                            $('.searchDisplay').append(`<div class ="col-12 col-lg-3"><a href="viewCourse.php?id=${element.courseId}"><div class ="card"><div class="card-body"><h6> ${element.courseId}: ${element.courseName} </h6><hr><p>${element.duration} Hours of content </p><p> Cost: Ksh. ${element.cost} </p><p> Instructor:${element.instructor}</p></div></div></a></div>`)
                        })
                    }
                    if (!searchTerm && data.length > 0) {
                        // console.log(` Suceessful with  ${data.length} search result`);
                        $(".coursesDisplay").show();
                        $('.searchDisplay div').remove();
                        $('.searchDisplay p').remove();
                    }

                    if (data.length == 0) {
                        // console.log(` Suceessful with  ${data.length} search result`);
                        $(".searchDisplay").html("<p>No search results available !");
                    }
                },
                error: function(data) {
                    console.log(data.responseText)
                }
            })
        })
    })
</script>
</body>

</html>