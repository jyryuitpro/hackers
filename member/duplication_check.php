<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

// SQL인젝션
$f_id = $_POST['f_id'];
$sql = "SELECT * FROM MEMBER WHERE F_ID='{$f_id}'";
$result = $conn->query($sql);
$exist = mysqli_num_rows($result);

if ($exist > 0) {
    echo json_encode(array('res'=>'duplication'));
} else {
    echo json_encode(array('res'=>'available'));
}
