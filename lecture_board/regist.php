<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

// 분류 아이디
$f_category_id = $_POST['f_category_id'];

// 분류
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
// 수강후기 작성자 이름
$f_name = $_POST['f_name'];

// 수강후기 작성자 아이디
$f_id = $_POST['f_id'];

$sql = "INSERT INTO BOARD (F_CATEGORY_ID, F_CATEGORY, F_LECTURE, F_TITLE, F_GRADE, F_CONTENTS, F_ID, F_NAME)";
$sql = $sql." VALUES('$f_category_id','$f_category','$f_lecture','$f_title','$f_grade','$f_contents','$f_id','$f_name')";

$result = mysqli_query($conn, $sql);
$conn->close();

if($result){
    echo "<script> alert('수강후기가 등록되었습니다.');window.location.href='/lecture_board/index.php?mode=list'</script>";
}else{
    echo "<script> alert('실패'); history.back();</script>";
}