<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

session_start();

// array(2) {
// ["f_id"]=> string(6) "test01"
// ["f_password"]=> string(9) "dnflwlq12"
// }

$f_id = $_POST['f_id'];
$f_password = base64_encode(hash('sha256', $_POST['f_password'], true));
//var_dump($_POST['f_password']);


$sql = "SELECT * FROM MEMBER WHERE F_ID='$f_id' and F_PASSWORD='$f_password'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$exist = mysqli_num_rows($result);

//var_dump($exist);
//exit;

//var_dump($_SESSION['HACKERS_MAIN']);
//var_dump($_SESSION['HACKERS_SIGNUP']);

// 로그인 성공시 리퍼러를 활용한 페이지 리다이렉트 처리 보통 메인으로 보낸다.
if (substr($_SESSION['HACKERS'],0, 23) == "http://test.hackers.com"){
    if ($exist > 0) {
        $_SESSION['f_name'] = $row['F_NAME'];
        $_SESSION['f_id'] = $f_id;
        $_SESSION['f_authority'] = $row['F_AUTHORITY'];
        echo json_encode(array('res'=>'success'));
    } else {

        $sql = "SELECT * FROM MEMBER WHERE F_ID='$f_id'";
        $result = $conn->query($sql);
        $exist_f_id = mysqli_num_rows($result); // 아이디
        $row = $result->fetch_assoc();

        $sql = "SELECT * FROM MEMBER WHERE F_PASSWORD='$f_password'";
        $result = $conn->query($sql);
        $exist_f_password = mysqli_num_rows($result);
//        var_dump($exist_f_id);
//        var_dump($exist_f_password);
//        exit;
        if ($exist_f_id == 0 && $exist_f_password == 0) {
            echo json_encode(array('res'=>'fail'));
            exit;
        } else if ($exist_f_id == 0 && $exist_f_password != 0) {
            echo json_encode(array('res'=>'fail_f_password'));
            exit;
        } else if ($exist_f_id != 0 && $exist_f_password == 0) {
            echo json_encode(array('res'=>'fail_f_id'));
            exit;
        }
    }
} else {
    echo json_encode(array('res'=>'wrong_path'));
}
