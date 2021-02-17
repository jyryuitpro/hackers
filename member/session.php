<?php
session_start();
$_SESSION['f_mobile'] = $_POST['f_mobile'];
//var_dump($_POST);
$conn = mysqli_connect('192.168.56.108', 'root', '', 'hackers');

if(!$_POST['f_gubun']) {
    if ($_SESSION['verification_number'] == $_POST['verification_number']) {
        echo json_encode(array('res'=>'success'));
    } else {
        echo json_encode(array('res'=>'fail'));
    }
} else if ($_POST['f_gubun'] == 'M') {
    $f_name = $_POST['f_name'];
    $f_birthday = $_POST['f_birthday'];
    $f_mobile = $_POST['f_mobile'];

    $sql = "SELECT F_NAME, F_ID FROM MEMBER WHERE F_NAME='{$f_name}' and F_BIRTHDAY='{$f_birthday}' and F_MOBILE='{$f_mobile}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);

    $exist = mysqli_num_rows($result);

    if ($exist > 0 && $_SESSION['verification_number'] == $_POST['verification_number']) {
        echo json_encode(array('res'=>'success'));
    } else {
        echo json_encode(array('res'=>'fail'));
        exit;
    }
}

/* If success */
session_start();
//session_destroy();
$_SESSION['find_name'] = $row[0];
$_SESSION['find_id'] = $row[1];
