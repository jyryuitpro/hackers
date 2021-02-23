<?php
require_once("../database/dbconfig.php");

// 이름
$f_name = $_POST['f_name'];
// 아이디
$f_id = $_POST['f_id_new'];
// 비밀번호는 sha256 암호화처리
$f_password = base64_encode(hash('sha256', $_POST['f_password_0'], true));
// 이메일
$f_email = $_POST['f_email'];
// 휴대폰번호
$f_mobile = $_POST['f_mobile'];
// 전화번호
$f_tel = $_POST['f_tel'];
// 우편번호
$f_zipcode = $_POST['f_zipcode'];
// 주소1
$f_address = $_POST['f_address'];
// 주소2
$f_address_detail = $_POST['f_address_detail'];
// SMS수신
$f_mobile_agree = $_POST['radio'];
// 메일수신
$f_email_agree = $_POST['radio2'];
// 생년월일
$f_birthday = $_POST['f_birthday'];
// 권한 : default 1
$f_authority = $_POST['f_authority'];

$sql = "INSERT INTO MEMBER (F_NAME, F_ID, F_PASSWORD, F_EMAIL, F_MOBILE, F_TEL, F_ZIPCODE, F_ADDRESS, F_ADDRESS_DETAIL, F_MOBILE_AGREE, F_EMAIL_AGREE, F_BIRTHDAY, F_AUTHORITY)";
$sql = $sql." VALUES('$f_name','$f_id','$f_password','$f_email','$f_mobile','$f_tel','$f_zipcode','$f_address','$f_address_detail','$f_mobile_agree','$f_email_agree', '$f_birthday', '$f_authority')";
$result = $conn->query($sql);
$conn->close();

if($result){
    echo "<script> alert('회원가입이 완료되었습니다.'); window.location.href='/member/index.php?mode=complete'</script>";
}else{
    echo "<script> alert('회원가입 실패'); history.back();</script>";
}