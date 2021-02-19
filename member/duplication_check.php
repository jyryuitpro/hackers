<?php
//$conn = mysqli_connect('192.168.56.108', 'root', '', 'hackers');
$conn = mysqli_connect('localhost:3307', 'root', 'root', 'hackers');

$f_id = $_POST['f_id'];
$sql = "SELECT * FROM MEMBER WHERE F_ID='{$f_id}'";
$result = mysqli_query($conn, $sql);
$exist = mysqli_num_rows($result);

if ($exist > 0) {
    echo json_encode(array('res'=>'duplication'));
} else {
    echo json_encode(array('res'=>'available'));
}
