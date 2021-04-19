<?php

require_once "../includes/db_config.php";

$data = $_POST['data'];

foreach ($data as $d) {
    echo $d;
    $q = $db->prepare("UPDATE participants set perfomance = ? WHERE  id  = ? ");
    $q->execute(["fail", $d]);
}

echo json_encode(1);
exit;
