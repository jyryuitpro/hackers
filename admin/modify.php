<?php
require_once("../database/dbconfig.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);

//var_dump($_FILES);
//exit;

//array(8) {
//    ["f_name"]=> string(9) "류지영"
//    ["f_id"]=> string(12) "jyryujiyoung"
//    ["f_category_id"]=> string(1) "2"
//    ["f_lecture"]=> string(26) "개인정보 보호 교육"
//    ["f_instructor"]=> string(9) "이준화"
//    ["f_learning_time"]=> string(1) "1"
//    ["f_lecture_count"]=> string(1) "2"
//    ["radio"]=> string(1) "1"
//}

//array(1) {
//    ["thumbnail"]=> array(5) {
//        ["name"]=> string(7) "hac.jpg"
//        ["type"]=> string(10) "image/jpeg"
//        ["tmp_name"]=> string(14) "/tmp/phpl47uMf"
//        ["error"]=> int(0)
//        ["size"]=> int(70215)
//    }
//}


// 강의 분류아이디
$f_category_id = $_POST['f_category_id'];

// POST값으로 넘어오는 강의 분류 아이디로 강의 분류명 세팅
$f_category = "";
if ($f_category_id == '1') $f_category = "어학 및 자격증";
if ($f_category_id == '2') $f_category = "공통역량";
if ($f_category_id == '3') $f_category = "일반직무";
if ($f_category_id == '4') $f_category = "산업직무";

// 강의명
$f_lecture = $_POST['f_lecture'];
// 강사명
$f_instructor = $_POST['f_instructor'];
// 학습시간
$f_learning_time = $_POST['f_learning_time'];
// 강의수
$f_lecture_count = $_POST['f_lecture_count'];
// 학습난이도
$f_grade = $_POST['radio'];
// 관리자 이름
$f_name = $_POST['f_name'];
// 관리자 아이디
$f_id = $_POST['f_id'];
// 강의 등록번호
$f_num = $_GET['f_num'];



if ($_GET['f_gubun'] == 'modify') { // 강의 수정
    if ($_FILES["thumbnail"]["name"] != "") { // 썸네일을 새로 업로드한 경우
        // 썸네일 업로드 정보
        $thumbnail_info = $_FILES['thumbnail'];

//        var_dump($thumbnail_info);
//        exit;

//        array(5) {
//            ["name"]=> string(7) "hac.jpg"
//            ["type"]=> string(10) "image/jpeg"
//            ["tmp_name"]=> string(14) "/tmp/phpxCJfi0"
//            ["error"]=> int(0)
//            ["size"]=> int(70215)
//        }

        // 썸네일을 업로드할 디렉토리
        $thumbnail_directory = './thumbnail/';
        // 썸네일로 업로드 가능한 파일의 확장자 설정 ex) $ext_str = "hwp,xls,doc,xlsx,docx,pdf,jpg,gif,png,txt,ppt,pptx";
        $ext_str = "jpg,gif,png";
        $allowed_extensions = explode(',', $ext_str);
        $max_file_size = 5242880;

        // 썸네일 확장자 추출
        $ext = substr($thumbnail_info['name'], strrpos($thumbnail_info['name'], '.') + 1);

        // 확장자 체크
        if(!in_array($ext, $allowed_extensions)) {
            echo '<script> alert("썸네일은 .jpg, .gif, .png 파일만 업로드 가능합니다."); history.back(); </script>';
            return false;
        }

        // 썸네일 파일 크기 체크
        if($thumbnail_info['size'] >= $max_file_size) {
            echo '<script>alert("5MB 까지만 업로드 가능합니다."); history.back();</script>';
            return false;
        }

        // 썸네일 아이디 생성
        $f_thumbnail_id = md5(uniqid(rand(), true));
        // 썸네일 업로드 파일명
        $f_thumbnail_name_ori = $thumbnail_info['name'];
        // 저장될 썸네일 파일명
        $f_thumbnail_name_crypto = md5(microtime()) . '.' . $ext;

        // 등록된 썸네일 파일 삭제를 위한 기존 정보 가져오기
        $sql_thumbnail = 'SELECT F_THUMBNAIL_NAME_CRYPTO FROM LECTURE a JOIN THUMBNAIL b ON a.F_THUMBNAIL_ID = b.F_THUMBNAIL_ID WHERE a.F_NUM = ' . $f_num;
        $result_thumbnail = $conn->query($sql_thumbnail);
        $row_thumbnail = $result_thumbnail->fetch_assoc();

//        var_dump($sql_thumbnail);
//        exit;

        // 등록된 썸네일 파일명
        $f_thumbnail_name_crypto_pre = $row_thumbnail["F_THUMBNAIL_NAME_CRYPTO"];

        $result_unlink = unlink($thumbnail_directory.$f_thumbnail_name_crypto_pre);

        // 썸네일 파일 삭제 실패
        if(!$result_unlink){
            echo '<script>alert("썸네일 파일 삭제 실패했습니다."); history.back(); </script>';
            return false;
        }

        // 썸네일 파일 삭제 후, 새로 업로드한 썸네일 파일 정보 업데이트
        $sql = "UPDATE THUMBNAIL SET F_THUMBNAIL_ID = '$f_thumbnail_id', F_THUMBNAIL_NAME_ORI = '$f_thumbnail_name_ori', F_THUMBNAIL_NAME_CRYPTO = '$f_thumbnail_name_crypto', F_REG_TIME = now() ";
        $sql = $sql."WHERE F_THUMBNAIL_ID = (SELECT F_THUMBNAIL_ID FROM LECTURE WHERE F_NUM = '$f_num')";
        $result = $conn->query($sql);

        if(!$result){
            echo '<script> alert("썸네일 등록이 실패했습니다."); history.back(); </script>';
            return false;
        } else {
            // 썸네일 파일을 지정한 디렉토리로 업로드
            move_uploaded_file($thumbnail_info['tmp_name'], $thumbnail_directory.$f_thumbnail_name_crypto);
        }

        // 썹네일 파일 삭제 후, 새로 등록한 강의 정보 업데이트
        $sql = "UPDATE LECTURE SET F_CATEGORY = '$f_category', F_LECTURE = '$f_lecture', F_INSTRUCTOR = '$f_instructor', F_LEARNING_TIME = '$f_learning_time',";
        $sql = $sql. "F_LECTURE_COUNT = '$f_lecture_count', F_GRADE = '$f_grade', F_ADMIN_ID = '$f_id', F_ADMIN_NAME = '$f_name', ";
        $sql = $sql. "F_THUMBNAIL_ID = '$f_thumbnail_id', F_REG_TIME = now() ";
        $sql = $sql. "WHERE F_NUM = '$f_num'";
        $result = $conn->query($sql);
        $conn->close();

        if($result){
            echo "<script> alert('강의 정보가 수정되었습니다.');window.location.href='/admin/index.php?mode=list'</script>";
//            echo "<script> alert('강의 정보가 수정되었습니다.');window.location.href=location.href;</script>";
        }else{
            echo "<script> alert('강의 정보 수정이 실패했습니다.'); history.back();</script>";
            return false;
        }
    } else { // 썸네일을 새로 업로드 하지 않은 경우, 썸네일 정보를 제외한 강의 정보를 업데이트
        $sql = "UPDATE LECTURE SET F_CATEGORY_ID = '$f_category_id', F_CATEGORY = '$f_category', F_LECTURE = '$f_lecture', F_INSTRUCTOR = '$f_instructor', F_LEARNING_TIME = '$f_learning_time',";
        $sql = $sql. "F_LECTURE_COUNT = '$f_lecture_count', F_GRADE = '$f_grade', F_ADMIN_ID = '$f_id', F_ADMIN_NAME = '$f_name', F_REG_TIME = now() ";
        $sql = $sql. "WHERE F_NUM = '$f_num'";
        $result = $conn->query($sql);
        $conn->close();

        if($result){
            echo "<script> alert('강의 정보가 수정되었습니다.'); window.location.href='/admin/index.php?mode=list'</script>";
//            echo "<script> alert('강의 정보가 수정되었습니다.'); history.back();</script>";
        }else{
            echo "<script> alert('강의 정보 수정이 실패했습니다.'); history.back();</script>";
            return false;
        }
    }
} else if ($_GET['f_gubun'] == 'delete') { // 강의 삭제
    // 썸네일을 업로드된 디렉토리
    $thumbnail_directory = './thumbnail/';

    // 등록된 썸네일 파일 삭제를 위한 기존 정보 가져오기
    $sql_thumbnail = 'SELECT F_THUMBNAIL_NAME_CRYPTO FROM LECTURE a JOIN THUMBNAIL b ON a.F_THUMBNAIL_ID = b.F_THUMBNAIL_ID WHERE a.F_NUM = ' . $f_num;
    $result_thumbnail = $conn->query($sql_thumbnail);
    $row_thumbnail = $result_thumbnail->fetch_assoc();

    $f_thumbnail_name_crypto_pre = $row_thumbnail["F_THUMBNAIL_NAME_CRYPTO"];

    $result_unlink = unlink($thumbnail_directory.$f_thumbnail_name_crypto_pre);

    // 썸네일 파일 삭제 실패
    if(!$result_unlink){
        echo '<script>alert("썸네일 파일 삭제 실패했습니다."); history.back(); </script>';
        return false;
    }

    // 등록된 썸네일 정보 삭제
    $sql = "DELETE FROM THUMBNAIL WHERE F_THUMBNAIL_ID = (SELECT F_THUMBNAIL_ID FROM LECTURE WHERE F_NUM = '$f_num')";
    $result = $conn->query($sql);

    // 등록된 강의 정보 삭제
    $sql = "DELETE FROM LECTURE WHERE F_NUM = '$f_num'";
    $result = $conn->query($sql);
    $conn->close();

    if($result){
        echo "<script> alert('강의 정보가 삭제되었습니다.'); window.location.href='/admin/index.php?mode=list'</script>";
    }else{
        echo "<script> alert('실패'); history.back();</script>";
    }
}

