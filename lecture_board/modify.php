<?php
require_once("../database/dbconfig.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

//var_dump($_POST);
//exit;

//array(10) {
//    ["f_name"]=> string(9) "류지영"
//    ["f_id"]=> string(12) "jyryujiyoung"
//    ["f_num"]=> string(2) "50"
//    ["f_gubun"]=> string(6) "modify"
//    ["f_category_id"]=> string(1) "1"
//    ["f_category"]=> string(20) "어학 및 자격증"
//    ["f_lecture"]=> string(41) "그래머 게이트웨이 인터미디엇"
//    ["f_title"]=> string(35) "수강후기 첨부파일 테스트"
//    ["radio"]=> string(1) "3"
//    ["content"]=> string(74) "수강후기 첨부파일 테스트"
//    ["attach_file"]=> string(54) "./attachment_file/608fa20a0363a5f6bfb4bf6c9358cf1f.txt"
//}

// 분류 아이디
$f_category_id = $_POST['f_category_id'];

// 분류명
$f_category = $_POST['f_category'];

// 강의명
$f_lecture = $_POST['f_lecture'];

// 수강후기 제목
$f_title = $_POST['f_title'];

// 강의 만족도
$f_grade = $_POST['radio'];

// 수강후기 내용
$f_contents = addslashes(trim($_POST['content']));

// 수강후기 내용
$f_name = $_POST['f_name'];

// 수강후기 작성자 아이디
$f_id = $_POST['f_id'];

// 수강후기 작성자 이름
$f_num = $_POST['f_num'];

// 수강후기 첨부파일
$f_attach_file = $_POST['attach_file'];

if ($_POST['f_gubun'] == 'modify') {
    if (isset($_POST['attach_file'])) { // 첨부파일을 새로 업로드한 경우
        // 등록된 첨부파일 파일 삭제를 위한 기존 정보 가져오기
        $sql = 'SELECT F_ATTACH_FILE FROM BOARD WHERE F_NUM = ' . $f_num;
        $result = $conn->query($sql);
        $result = $result->fetch_assoc();

        $f_attach_file_path = $result['F_ATTACH_FILE'];
        $array = explode("/", $f_attach_file_path);
        // 등록된 첨부파일명
        $f_attach_file_name = $array[2];

        $result_unlink = unlink($f_attach_file_path);

        // 첨부파일 삭제 실패
        if(!$result_unlink){
            echo '<script>alert("썸네일 파일 삭제 실패했습니다."); history.back(); </script>';
            return false;
        }

        $sql = "UPDATE BOARD SET F_CATEGORY = '$f_category', F_LECTURE = '$f_lecture', F_TITLE = '$f_title', F_GRADE = '$f_grade', F_CONTENTS = '$f_contents', F_ATTACH_FILE = '$f_attach_file' ";
        $sql .= "WHERE F_NAME = '$f_name' AND F_ID = '$f_id' AND F_NUM = $f_num";
        $result = $conn->query($sql);
        $conn->close();

        if($result){
            echo "<script> alert('수강후기가 수정되었습니다.');window.location.href='/lecture_board/step_03.php?f_num=$f_num'</script>";
        }else{
            echo "<script> alert('실패'); history.back();</script>";
        }
    } else {
        $sql = "UPDATE BOARD SET F_CATEGORY = '$f_category', F_LECTURE = '$f_lecture', F_TITLE = '$f_title', F_GRADE = '$f_grade', F_CONTENTS = '$f_contents'";
        $sql .= "WHERE F_NAME = '$f_name' AND F_ID = '$f_id' AND F_NUM = $f_num";
        $result = $conn->query($sql);
        $conn->close();

        if($result){
            echo "<script> alert('수강후기가 수정되었습니다.');window.location.href='/lecture_board/step_03.php?f_num=$f_num'</script>";
        }else{
            echo "<script> alert('실패'); history.back();</script>";
        }
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

    // 등록된 첨부파일 파일 삭제를 위한 기존 정보 가져오기
    $sql = 'SELECT F_ATTACH_FILE FROM BOARD WHERE F_NUM = ' . $f_num;
    $result = $conn->query($sql);
    $result = $result->fetch_assoc();

    $f_attach_file_path = $result['F_ATTACH_FILE'];
    $array = explode("/", $f_attach_file_path);
    // 등록된 첨부파일명
    $f_attach_file_name = $array[2];

    $result_unlink = unlink($f_attach_file_path);

    // 첨부파일 삭제 실패
    if(!$result_unlink){
        echo '<script>alert("썸네일 파일 삭제 실패했습니다."); history.back(); </script>';
        return false;
    }

    $sql = "DELETE FROM BOARD WHERE F_NAME = '$f_name' AND F_ID = '$f_id' AND F_NUM = '$f_num'";
    $result = $conn->query($sql);
    $conn->close();

    if($result){
        echo "<script> alert('수강후기가 삭제되었습니다.');window.location.href='/lecture_board/index.php?mode=list'</script>";
    }else{
        echo "<script> alert('실패'); history.back();</script>";
    }
}
