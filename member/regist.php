<?php
require_once("../database/dbconfig.php");

$f_name = $_POST['f_name'];
$f_id = $_POST['f_id_new'];
$f_password = base64_encode(hash('sha256', $_POST['f_password_0'], true));

$f_email = $_POST['f_email'];
$f_mobile = $_POST['f_mobile'];
$f_tel = $_POST['f_tel'];

$f_zipcode = $_POST['f_zipcode'];
$f_address = $_POST['f_address'];
$f_address_detail = $_POST['f_address_detail'];

$f_mobile_agree = $_POST['radio'];
$f_email_agree = $_POST['radio2'];

$f_birthday = $_POST['f_birthday'];
$f_authority = $_POST['f_authority'];

$sql = "INSERT INTO MEMBER (F_NAME, F_ID, F_PASSWORD, F_EMAIL, F_MOBILE, F_TEL, F_ZIPCODE, F_ADDRESS, F_ADDRESS_DETAIL, F_MOBILE_AGREE, F_EMAIL_AGREE, F_BIRTHDAY, F_AUTHORITY)";
$sql = $sql." VALUES('$f_name','$f_id','$f_password','$f_email','$f_mobile','$f_tel','$f_zipcode','$f_address','$f_address_detail','$f_mobile_agree','$f_email_agree', '$f_birthday', '$f_authority')";
$result = $conn->query($sql);
$conn->close();

if($result){
    echo "<script> alert('회원가입이 완료되었습니다.'); window.location.href='/member/index.php?mode=complete'</script>";
}else{
    echo "<script> alert('실패'); history.back();</script>";
}