<?php

require_once "../includes/db_config.php";

if (isset($_POST['data'])) {
    $data = $_POST['data'];

    foreach ($data as $d) {
        $q = $db->prepare("UPDATE participants set completion = ? WHERE  id  = ? ");
        $q->execute(["completed", $d]);
    }

    echo 1;
    exit;
} else {
    echo 2;
    exit;
}
