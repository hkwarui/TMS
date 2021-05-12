<?php
require_once '../includes/db_config.php';

// Load  course info for class shedule
if (isset($_POST['courseId'])) {
    $courseId = $_POST['courseId'];

    $sql = $db->prepare("SELECT * FROM courses WHERE courseId = ?");
    $sql->execute([$courseId]);
    $row = $sql->fetch();

    echo json_encode($row);
    exit;
}


// Load  course info for add participant

if (isset($_POST['partId'])) {
    $partId = $_POST['partId'];

    $sth = $db->prepare("SELECT classCode FROM cohorts WHERE courseId = ?");
    $sth->execute([$partId]);;
    $result = [];
    // fetch an array
    while ($row = $sth->fetch()) {
        $result[] = $row['classCode'];
    };
    echo json_encode($result);
    exit;
}

//Search course data 
if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];

    $sth = $db->prepare("SELECT * FROM courses WHERE courseName LIKE ? OR courseId  LIKE ?");
    $params = array("%$searchTerm%", "%$searchTerm%");
    $sth->execute($params);

    $result = [];
    while ($row = $sth->fetch()) {
        $result[] = $row;
    };

    echo json_encode($result);
    exit;
}
