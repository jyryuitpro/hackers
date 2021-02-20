<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
session_start();
//var_dump($_POST);
//exit;

//array(8) {
//    ["f_name"]=> string(9) "류지영"
//    ["f_id"]=> string(12) "jyryujiyoung"
//    ["f_num"]=> string(2) "46"
//    ["f_category"]=> string(12) "공통역량"
//    ["f_lecture"]=> string(53) "[직장생활백서] 관계가 어려운 당신에게"
//    ["f_title"]=> string(35) "대화의 중요성에 대해서..."
//    ["radio"]=> string(1) "1"
//    ["content"]=> string(824) " 강의를 보면서 대화하는 법에 대해 많이 배우고 갑니다." }

$f_category = $_POST['f_category'];
$f_lecture = $_POST['f_lecture'];
$f_title = $_POST['f_title'];
$f_grade = $_POST['radio'];
$f_contents = addslashes(trim($_POST['content']));
$f_name = $_POST['f_name'];
$f_id = $_POST['f_id'];
$f_num = $_POST['f_num'];

if ($_GET['f_gubun'] == 'modify') {
    $sql = "UPDATE BOARD SET F_CATEGORY = '$f_category', F_LECTURE = '$f_lecture', F_TITLE = '$f_title', F_GRADE = '$f_grade', F_CONTENTS = '$f_contents' ";
    $sql .= "WHERE F_NAME = '$f_name' AND F_ID = '$f_id' AND F_NUM = $f_num";
    $result = $conn->query($sql);
    $conn->close();

    if($result){
        echo "<script> alert('수강후기가 수정되었습니다.');window.location.href='/lecture_board/step_03.php?f_num=$f_num'</script>";
    }else{
        echo "<script> alert('실패'); history.back();</script>";
    }

//    if($result){
//        Header("Location: /lecture_board/step_03.php?f_num=".$f_num);
//    }else{
//        echo 'fail to update sql '.$sql;
//    }

} else if ($_GET['f_gubun'] == 'delete') {
    $f_name = $_SESSION['f_name'];
    $f_id = $_SESSION['f_id'];
    $f_num = $_GET['f_num'];

    $sql = "DELETE FROM BOARD WHERE F_NAME = '$f_name' AND F_ID = '$f_id' AND F_NUM = '$f_num'";
    $result = $conn->query($sql);
    $conn->close();

    if($result){
        echo "<script> alert('수강후기가 삭제되었습니다.');window.location.href='/lecture_board/index.php?mode=list'</script>";
    }else{
        echo "<script> alert('실패'); history.back();</script>";
    }
}
