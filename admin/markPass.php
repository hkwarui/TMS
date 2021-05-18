<?php
require_once "../includes/db_config.php";

if (isset($_POST['data'])) {
    $data = $_POST['data'];

    foreach ($data as $d) {

         //pick participant info 
         $q1 = $db->prepare("SELECT  passport FROM participants WHERE  id  = ? ");
         $q1->execute([$d]);
         $stud_id = $q1->fetchColumn();

        $q = $db->prepare("UPDATE participants set perfomance = ? WHERE id = ? ");
        $q->execute(["pass", $d]);

        $q = $db->prepare("UPDATE class_records set result = ? WHERE  stud_id  = ? ");
        $q->execute(["pass", $stud_id]);
    }
    echo 1;
    exit;
} else {
    echo 2;
    exit;
}
