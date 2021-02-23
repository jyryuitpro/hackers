<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

session_start();

$f_id = $_POST['f_id'];
$f_password = base64_encode(hash('sha256', $_POST['f_password'], true));
//var_dump($_POST['f_password']);

$sql = "SELECT * FROM MEMBER WHERE F_ID='$f_id' and F_PASSWORD='$f_password'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$exist = mysqli_num_rows($result);

//var_dump($_SESSION['HACKERS_MAIN']);
//var_dump($_SESSION['HACKERS_SIGNUP']);

// 로그인 성공시 리퍼러를 활용한 페이지 리다이렉트 처리
if ($_SESSION['HACKERS'] == "http://test.hackers.com/"
    || $_SESSION['HACKERS'] == "http://test.hackers.com/index.php"
    || $_SESSION['HACKERS'] == "http://test.hackers.com/login/find_id_completed.php"
    || $_SESSION['HACKERS'] == "http://test.hackers.com/member/step_04.php"){
    if ($exist > 0) {
        $_SESSION['f_name'] = $row['F_NAME'];
        $_SESSION['f_id'] = $f_id;
        $_SESSION['f_authority'] = $row['F_AUTHORITY'];
        echo json_encode(array('res'=>'success'));
    } else {
        $sql = "SELECT * FROM MEMBER WHERE F_ID='$f_id'";
        $result = $conn->query($sql);
        $exist_f_id = mysqli_num_rows($result);

        $sql = "SELECT * FROM MEMBER WHERE F_PASSWORD='$f_password'";
        $result = $conn->query($sql);
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
} else {
    echo json_encode(array('res'=>'wrong_path'));
}
