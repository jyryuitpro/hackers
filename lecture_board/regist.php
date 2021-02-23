<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

var_dump($_POST);
exit;

// 예시
//array(10) {
//    ["f_name"]=> string(9) "테스트"
//    ["f_id"]=> string(6) "test01"
//    ["f_num"]=> string(0) ""
//    ["f_gubun"]=> string(0) ""
//    ["f_category_id"]=> string(1) "1"
//    ["f_lecture"]=> string(41) "그래머 게이트웨이 인터미디엇"
//    ["f_title"]=> string(35) "수강후기 첨부파일 테스트"
//    ["radio"]=> string(1) "5"
//    ["content"]=> string(74) "수강후기 첨부파일 테스트"
//    ["attach_file"]=> string(54) "첨부파일1.txt|7648b1851fc29c07c06adb1fea86432f.txt"
//}

// 분류 아이디
$f_category_id = $_POST['f_category_id'];

// 분류명
$f_category = "";
if ($f_category_id == '1') $f_category = "어학 및 자격증";
if ($f_category_id == '2') $f_category = "공통역량";
if ($f_category_id == '3') $f_category = "일반직무";
if ($f_category_id == '4') $f_category = "산업직무";

// 강의명
$f_lecture = $_POST['f_lecture'];

// 수강후기 제목
$f_title = $_POST['f_title'];

// 강의 만족도
$f_grade = $_POST['radio'];

// 수강후기 내용
$f_contents = addslashes(trim($_POST['content']));

// 수강후기 작성자 아이디
$f_id = $_POST['f_id'];

// 수강후기 작성자 이름
$f_name = $_POST['f_name'];

// 수강후기 첨부파일
$array = explode("|", $_POST['attach_file']);
// 원본 파일명
$f_attach_file_ori = $array[0];
// 변환 파일명
$f_attach_file_crypto = $array[1];

$sql = "INSERT INTO BOARD (F_CATEGORY_ID, F_CATEGORY, F_LECTURE, F_TITLE, F_GRADE, F_CONTENTS, F_ID, F_NAME, F_ATTACH_FILE_ORI, F_ATTACH_FILE_CRYPTO, F_REG_TIME)";
$sql = $sql." VALUES('$f_category_id','$f_category','$f_lecture','$f_title','$f_grade','$f_contents','$f_id','$f_name','$f_attach_file_ori', '$f_attach_file_crypto', now())";

//var_dump($sql);
//exit;

$result = $conn->query($sql);
$conn->close();

if($result){
    echo "<script> alert('수강후기가 등록되었습니다.');window.location.href='/lecture_board/index.php?mode=list'</script>";
}else{
    echo "<script> alert('실패'); history.back();</script>";
}