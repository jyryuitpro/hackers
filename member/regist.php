<?php
require_once("../database/dbconfig.php");

//var_dump($_POST);
//exit;

//array(11) {
//    ["f_name"]=> string(9) "테스트"
//    ["f_birthday"]=> string(8) "19500101"
//    ["f_id_new"]=> string(6) "test01"
//    ["f_password_0"]=> string(9) "dnflwlq12"
//    ["f_email"]=> string(9) "테스트"
//    ["f_mobile"]=> string(11) "01093789025"
//    ["f_tel"]=> string(0) ""
//    ["f_zipcode"]=> string(5) "16873"
//    ["f_address"]=> string(67) "경기 용인시 수지구 대지로 64 (도담마을 롯데캐슬)"
//    ["f_address_detail"]=> string(14) "304동 1001호"
//    ["f_authority"]=> string(1) "1"
//}

// POST 전송 후, 유효성 검사 (아이디, 비밀번호)

// 이름
$f_name = $_POST['f_name'];
// 생년월일
$f_birthday = $_POST['f_birthday'];
// 아이디
$f_id = "";
// 성공 1, 실패 0
$f_id_check = preg_match('/^[a-z]+[a-z0-9]{3,14}$/',$_POST['f_id_new']);
if ($f_id_check) {
    if (strlen($_POST['f_id_new']) < 3 || strlen($_POST['f_id_new']) > 16) {
        echo json_encode(array('res'=>'f_id_fail'));
        exit;
    }
    $f_id = $_POST['f_id_new'];
} else {
    echo json_encode(array('res'=>'f_id_fail'));
    exit;
}

//비밀번호
$f_password = "";
$f_password_0_check = preg_match('/^[a-zA-Z0-9]{8,15}$/',$_POST['f_password_0']);
if ($f_password_0_check) {
    // 비밀번호는 sha256 암호화처리
    $f_password = base64_encode(hash('sha256', $_POST['f_password_0'], true));
} else {
    echo json_encode(array('res'=>'f_password_fail'));
    exit;
}

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
// 권한 : default 1
$f_authority = $_POST['f_authority'];

$sql = "INSERT INTO MEMBER (F_NAME, F_ID, F_PASSWORD, F_EMAIL, F_MOBILE, F_TEL, F_ZIPCODE, F_ADDRESS, F_ADDRESS_DETAIL, F_MOBILE_AGREE, F_EMAIL_AGREE, F_BIRTHDAY, F_AUTHORITY)";
$sql = $sql." VALUES('$f_name','$f_id','$f_password','$f_email','$f_mobile','$f_tel','$f_zipcode','$f_address','$f_address_detail','$f_mobile_agree','$f_email_agree', '$f_birthday', '$f_authority')";
$result = $conn->query($sql);
$conn->close();

if($result){
    echo json_encode(array('res'=>'success'));
}else{
    echo json_encode(array('res'=>'fail'));
}