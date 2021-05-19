<?php
require_once "../includes/db_config.php";

if (isset($_POST['data'])) {
    $data = $_POST['data'];

    foreach ($data as $d) {

        //pick participant info 
        $q1 = $db->prepare("SELECT  passport FROM participants WHERE  id  = ? ");
        $q1->execute([$d]);
        $stud_id = $q1->fetchColumn();


        $q = $db->prepare("DELETE FROM class_records WHERE id= ?");
        $q->execute([$d]);
    }
    echo 1;
    exit;
} else {
    echo 2;
    exit;
}
