<?php
session_start();
$conn = mysqli_connect('192.168.56.108', 'root', '', 'hackers');

$f_name = $_SESSION['find_name'];
$f_id = $_SESSION['find_id'];
$f_password = base64_encode(hash('sha256', $_POST['f_password'], true));
//var_dump($_POST['f_password']);

$sql = "UPDATE MEMBER SET F_PASSWORD = '$f_password' WHERE F_NAME = '$f_name' AND F_ID = '$f_id'";
$result = mysqli_query($conn, $sql);

if($result){
//    Header("Location: /member/index.php?mode=complete");
//    var_dump($f_password);
    echo json_encode(array('res'=>'success'));
}else{
    echo 'fail to insert sql '.$sql;
}