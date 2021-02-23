<?php
session_start();
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$f_name = $_SESSION['find_name'];
$f_id = $_SESSION['find_id'];
$f_password = base64_encode(hash('sha256', $_POST['f_password'], true));

$sql = "UPDATE MEMBER SET F_PASSWORD = '$f_password' WHERE F_NAME = '$f_name' AND F_ID = '$f_id'";
$result = $conn->query($sql);
$conn->close();

if($result){
    echo json_encode(array('res'=>'success'));
}else{
    echo 'fail to insert sql '.$sql;
}