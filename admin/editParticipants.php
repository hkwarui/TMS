 <?php
    include_once('../includes/header.php');
    require_once '../includes/db_config.php';

    //Load  Participants data 
    $partId = $_GET['id'];
    $stm = $db->prepare("SELECT * FROM participants WHERE id= ?");
    $stm->execute([$partId]);
    $row = $stm->fetch();

    $stud_id = $row['passport'];

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
                 <h1 class="mb-3">Update Facilitator Details</h1>
             </div>
             <div class="col-2">
                 <button class="btn btn btn-info float-right" onclick="history.go(-1)"><i class="align-middle me-1" data-feather="arrow-left"></i>Back </button></h1>
             </div>
         </div>
         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-header">
                         <h5 class="card-title mb-0">Personal Info</h5>
                     </div>
                     <div class="card-body">
                         <form action="saveParticipant.php" method="post" id="addParticipant">
                             <input type="hidden" class="form-control" value="editParticipant" name="form_id">
                             <input type="hidden" class="form-control" value="<?php echo $row['id'] ?>" name="id">
                             <div class="row">
                                 <div class="col-12 col-lg-4">
                                     <div class="mb-2">
                                         <label class="form-label"><b>FullName</b></label>
                                         <div class="input-group">
                                             <input type="text" class="form-control" value="<?php echo $row['fullname'] ?>" name="fullname" readonly>
                                         </div>
                                     </div>
                                     <div class="mb-2">
                                         <label class="form-label"><b>Email</b></label>
                                         <div class="input-group">
                                             <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-12 col-lg-4">
                                     <div class="mb-2">
                                         <label class="form-label"><b> Phone No.</b></label>
                                         <div class="input-group">
                                             <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'] ?>">
                                         </div>
                                     </div>
                                     <div class="mb-2">
                                         <label class="form-label"><b>ID. / Passport</b></label>
                                         <div class="input-group">
                                             <input type="text" class="form-control" name="passport" value="<?php echo $row['passport'] ?>" readonly>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-12 col-lg-4">
                                     <div class="mb-2">
                                         <label class="form-label"><b>Company</b></label>
                                         <div class="input-group">
                                             <input type="text" class="form-control" value="<?php echo $row['company'] ?>" name="company">
                                         </div>
                                     </div>
                                     <div class="mb-2">
                                         <label class="form-label"><b>Designation</b></label>
                                         <div class="input-group">
                                             <input type="text" class="form-control" name="designation" value="<?php echo $row['designation'] ?>">
                                         </div>
                                     </div>
                                 </div>
                                 <div class="text-center mt-4">
                                     <button type="submit" class="btn btn-lg btn-primary"> Update </button>
                                 </div>
                             </div>
                         </form>
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
                     <a href="https://github.com/Martin" class="text-muted"><strong>MartinW</strong></a> &copy <?php echo date('Y') . "  "; ?>
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

         //Load class field from when you select a course
         $('.course').on("change", function(e) {
             e.preventDefault();
             var partId = $(this).val()

             $.ajax({
                 url: 'loadData.php',
                 method: 'post',
                 data: {
                     partId
                 },
                 dataType: 'json',
                 success: function(data) {
                     console.log(data)
                     if (data.length) {
                         $("#cohort option").remove();
                         for (var i = 0; i < data.length; i++) {
                             $('#cohort').append('<option value="' + data[i] + '">' + data[i] + '</option>');
                         }
                     }

                     if (!data.length) {
                         $("#cohort option").remove();
                         $('#cohort').append('<option value=""> No scheduled class. </option>');
                     }
                 },
                 error: function(data) {
                     console.log(data.responseText);
                 }

             })
         })


         //Validate  add participant form
         $('#addParticipant').validate({
             rules: {
                 fullname: 'required',
                 email: {
                     required: true,
                     email: true
                 },
                 phone: {
                     required: true,
                     digits: true,
                     minlength: 10,
                     maxlength: 12
                 },
                 passport: {
                     required: true,
                     digits: true
                 },
                 company: 'required',
                 designation: 'required',
                 course: 'required',
                 cohort: 'required'
             },


             errorElement: 'span',
             errorPlacement: function(error, element) {
                 error.addClass('invalid-feedback');
                 element.closest('.input-group').append(error);
             },
             highlight: function(element, errorClass, validClass) {
                 $(element).addClass('is-invalid');
             },
             unhighlight: function(element, errorClass, validClass) {
                 $(element).removeClass('is-invalid');
             },
             submitHandler: function(form) {
                 form.submit();
             }

         })
     })
 </script>
 </body>

 </html>