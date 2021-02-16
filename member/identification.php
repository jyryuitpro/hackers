<?php
$f_mobile = $_POST['f_mobile'];
$conn = mysqli_connect('192.168.56.108', 'root', '', 'hackers');

$sql = "SELECT * FROM MEMBER WHERE F_MOBILE='{$f_mobile}'";
$result = mysqli_query($conn, $sql);
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




