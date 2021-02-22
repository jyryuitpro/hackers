<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

session_start();

// UPDATE WHERE 아이디
$f_id = $_SESSION['f_id'];

// UPDATE SET 아디
$f_id_new = $_POST['f_id_new'];
$f_email = $_POST['f_email'];
$f_mobile = $_POST['f_mobile'];
$f_tel = $_POST['f_tel'];
$f_zipcode = $_POST['f_zipcode'];
$f_address = $_POST['f_address'];
$f_address_detail = $_POST['f_address_detail'];
$f_mobile_agree = $_POST['radio'];
$f_email_agree = $_POST['radio2'];

$sql = "UPDATE MEMBER SET F_ID = '$f_id_new', F_EMAIL = '$f_email', F_MOBILE = '$f_mobile', F_TEL = '$f_tel', ";
$sql .= "F_ZIPCODE = '$f_zipcode', F_ADDRESS = '$f_address', F_ADDRESS_DETAIL = '$f_address_detail', ";
$sql .= "F_MOBILE_AGREE = '$f_mobile_agree', F_EMAIL_AGREE = '$f_email_agree' ";

// 변경할 비밀번호가 있는 경우
if ($_POST['f_password_0']) {
    $f_password = base64_encode(hash('sha256', $_POST['f_password_0'], true));
    $sql .= ", F_PASSWORD = '$f_password' ";
}

$sql .= "WHERE F_ID = '$f_id'";

$result = $conn->query($sql);

if($result){
    echo "<script language='javascript'>";
    echo 'alert("정보수정이 완료되었습니다.");';
    echo 'window.location.href = "/member/index.php?mode=modify";';
    echo "</script>";
}else{
    echo 'fail to insert sql '.$sql;
}

/* If success */
session_start();
//session_destroy();
$_SESSION['f_id'] = $f_id_new;