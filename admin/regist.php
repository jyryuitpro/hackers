<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

//var_dump($_POST);
//exit;

// 강의 등록 시, POST로 넘어오는 값 확인
//array(8) {
//    ["f_name"]=> string(9) "류지영" -- 관리자 이름
//    ["f_id"]=> string(12) "jyryujiyoung" -- 관리자 아이디
//    ["f_category_id"]=> string(1) "1" -- 강의 분류 아이디
//    ["f_lecture"]=> string(23) "강의 등록 테스트" -- 강의명
//    ["f_instructor"]=> string(9) "테스트" -- 강사명
//    ["f_learning_time"]=> string(2) "12" -- 학습시간
//    ["f_lecture_count"]=> string(2) "12" -- 강의수
//    ["radio"]=> string(1) "5" -- 학습난이도
//}

// 강의 분류 아이디
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

// 썸네일 업로드 정보
$thumbnail_info = $_FILES['thumbnail'];

//var_dump($thumbnail_info);
//exit;

// 강의 등록 시, POST로 넘어오는 값 확인
//array(5) {
//    ["name"]=> string(7) "hac.jpg"
//    ["type"]=> string(10) "image/jpeg"
//    ["tmp_name"]=> string(14) "/tmp/phpVQ8yp0"
//    ["error"]=> int(0)
//    ["size"]=> int(70215)
//}

// 썸네일을 업로드할 디렉토리
$thumbnail_directory = './thumbnail/';
// 썸네일로 업로드 가능한 파일의 확장자 설정 ex) $ext_str = "hwp,xls,doc,xlsx,docx,pdf,jpg,gif,png,txt,ppt,pptx";
$ext_str = "jpg,gif,png";
$allowed_extensions = explode(',', $ext_str);
$max_file_size = 5242880;

// 관리자가 업로드한 썸네일의 확장자 가져오기
$ext = substr($thumbnail_info['name'], strrpos($thumbnail_info['name'], '.') + 1);
// 썸네일 확장자 확인
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

// 썸네일 파일 정보 등록
$sql = "INSERT INTO THUMBNAIL (F_THUMBNAIL_ID, F_THUMBNAIL_NAME_ORI, F_THUMBNAIL_NAME_CRYPTO, F_REG_TIME)";
$sql = $sql." VALUES('$f_thumbnail_id','$f_thumbnail_name_ori','$f_thumbnail_name_crypto', now())";
$result = $conn->query($sql);

//var_dump($sql);
//exit;

if(!$result){
    $conn->close();
    echo '<script> alert("썸네일 등록이 실패하였습니다."); history.back();</script>';
    return false;
} else {
    // 썸네일 파일을 지정한 디렉토리로 업로드
    move_uploaded_file($thumbnail_info['tmp_name'], $thumbnail_directory.$f_thumbnail_name_crypto);
}

// 강의 정보 등록
$sql = "INSERT INTO LECTURE (F_CATEGORY_ID, F_CATEGORY, F_LECTURE, F_INSTRUCTOR, F_LEARNING_TIME, F_LECTURE_COUNT, F_GRADE, F_ADMIN_ID, F_ADMIN_NAME, F_THUMBNAIL_ID, F_REG_TIME)";
$sql = $sql." VALUES('$f_category_id','$f_category','$f_lecture','$f_instructor','$f_learning_time','$f_lecture_count', '$f_grade','$f_id','$f_name', '$f_thumbnail_id', now())";
$result = $conn->query($sql);
$conn->close();

if($result){
    echo "<script> alert('강의 등록이 완료되었습니다.'); window.location.href='/admin/index.php?mode=list'</script>";
}else{
    echo "<script> alert('강의 등록이 실패했습니다.'); history.back();</script>";
}

