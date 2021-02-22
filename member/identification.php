<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$f_mobile = $_POST['f_mobile'];

$sql = "SELECT * FROM MEMBER WHERE F_MOBILE='{$f_mobile}'";
$result = $conn->query($sql);
$exist = mysqli_num_rows($result);
if ($exist > 0) {
    $row = mysqli_fetch_row($result);
    $sql = "UPDATE MEMBER";
    $sql = $sql." SET F_MOBILE = '$f_mobile' WHERE F_MOBILE = '$row[0]'";
    echo json_encode(array('res'=>'success'));
} else {
    $sql = "INSERT INTO MEMBER (F_MOBILE)";
    $sql = $sql." VALUES('$f_mobile')";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo json_encode(array('res'=>'success'));
    }
}




