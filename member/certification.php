<?php
require_once("../database/dbconfig.php");

// 휴대폰 인증 후, 회원정보입력 페이지에서 휴대폰 번호 세팅을 하기 위해서 세션에 세팅
session_start();
$_SESSION['f_mobile'] = $_POST['f_mobile'];

if(!$_POST['f_gubun']) { // 본인확인 휴대폰 인증
    if ($_SESSION['verification_number'] == $_POST['verification_number']) { // 세션에 세팅된 인증번호와 입력한 인증번호 비교
        echo json_encode(array('res'=>'success'));
    } else {
        echo json_encode(array('res'=>'fail'));
    }
} else if ($_POST['f_gubun'] == 'M') { // 아이디, 비밀번호 찾기 휴대폰 인증
    $f_name = $_POST['f_name'];
    $f_birthday = $_POST['f_birthday'];
    $f_mobile = $_POST['f_mobile'];

    $sql = "SELECT F_NAME, F_ID FROM MEMBER WHERE F_NAME='$f_name' and F_BIRTHDAY='$f_birthday' and F_MOBILE='$f_mobile'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $exist = mysqli_num_rows($result);
    if ($exist > 0 && $_SESSION['verification_number'] == $_POST['verification_number']) { // 세션에 세팅된 인증번호와 입력한 인증번호 비교
        echo json_encode(array('res'=>'success'));
    } else {
        echo json_encode(array('res'=>'fail'));
        exit;
    }
} else if ($_POST['f_gubun'] == 'E') { // 아이디, 비밀번호 찾기 이메일 인증
    $f_name = $_POST['f_name'];
    $f_birthday = $_POST['f_birthday'];
    $f_email = $_POST['f_email'];

    $sql = "SELECT F_NAME, F_ID FROM MEMBER WHERE F_NAME='$f_name' and F_BIRTHDAY='$f_birthday' and F_EMAIL='$f_email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $exist = mysqli_num_rows($result);
    if ($exist > 0 && $_SESSION['verification_number'] == $_POST['verification_number']) { // 세션에 세팅된 인증번호와 입력한 인증번호 비교
        echo json_encode(array('res'=>'success'));
    } else {
        echo json_encode(array('res'=>'fail'));
        exit;
    }
}

/* If success */
// 아이디 조회결과 페이지에서 보여줄 회원이름, 아이디를 세션으로 세팅
$_SESSION['find_name'] = $row['F_NAME'];
$_SESSION['find_id'] = $row['F_ID'];
