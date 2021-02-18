<?php
$conn = mysqli_connect('192.168.56.108', 'root', '', 'hackers');

$f_id = $_POST['f_id'];
$f_password = base64_encode(hash('sha256', $_POST['f_password'], true));
//var_dump($_POST['f_password']);

$sql = "SELECT * FROM MEMBER WHERE F_ID='{$f_id}' and F_PASSWORD='{$f_password}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
//var_dump($row);
$exist = mysqli_num_rows($result);

$refer = $_SERVER['HTTP_REFERER'];

if ($exist > 0 && $refer) {
    echo json_encode(array('res'=>'success'));
} else {
    $sql = "SELECT * FROM MEMBER WHERE F_ID='{$f_id}'";
    $result = mysqli_query($conn, $sql);
    $exist_f_id = mysqli_num_rows($result);

    $sql = "SELECT * FROM MEMBER WHERE F_PASSWORD='{$f_password}'";
    $result = mysqli_query($conn, $sql);
    $exist_f_password = mysqli_num_rows($result);

    if (!$exist_f_id && !$exist_f_password) {
        echo json_encode(array('res'=>'fail'));
        exit;
    } else if (!$exist_f_password) {
        echo json_encode(array('res'=>'fail_f_password'));
        exit;
    } else if (!$exist_f_id) {
        echo json_encode(array('res'=>'fail_f_id'));
        exit;
    }
}

/* If success */
session_start();
//session_destroy();
$_SESSION['f_name'] = $row[0];
$_SESSION['f_id'] = $f_id;
$_SESSION['f_password'] = $f_password;