<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

//var_dump($_POST);
//exit;

//array(9) {
//    ["f_name"]=> string(9) "류지영"
//    ["f_id"]=> string(12) "jyryujiyoung"
//    ["f_category_id"]=> string(0) ""
//    ["f_category"]=> string(1) "1"
//    ["f_lecture"]=> string(68) "[OA국가공인자격] ITQ Master! OA기초부터 실무활용까지"
//    ["f_instructor"]=> string(9) "이지현"
//    ["f_learning_time"]=> string(2) "25"
//    ["f_lecture_count"]=> string(2) "25"
//    ["radio"]=> string(1) "5"
//}

// 강의 분류아이디
$f_category_id = $_POST['f_category_id'];

// 강의 분류명
$f_category = "";
if ($f_category_id == '1') $f_category = "어학 및 자격증";
if ($f_category_id == '2') $f_category = "공통역량";
if ($f_category_id == '3') $f_category = "일반직무";
if ($f_category_id == '4') $f_category = "산업직무";

//var_dump($f_category_id);
//exit;

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

// 썸네일 업로드
$thumbnail_info = $_FILES['thumbnail'];

//array(5) {
//    ["name"]=> string(77) "168431621_Jezwfprt_EAB28CEC9DB4ED8AB8EC9BA8EC9DB4EC9DB8ED84B0EC9DBCEBB098.png"
//    ["type"]=> string(9) "image/png"
//    ["tmp_name"]=> string(45) "C:\Users\jyryu\AppData\Local\Temp\phpAA92.tmp"
//    ["error"]=> int(0)
//    ["size"]=> int(22040)
//}

$thumbnail_directory = './thumbnail/';
$ext_str = "hwp,xls,doc,xlsx,docx,pdf,jpg,gif,png,txt,ppt,pptx";
$allowed_extensions = explode(',', $ext_str);
$max_file_size = 5242880;

// 썸네일 확장자 추출
$ext = substr($thumbnail_info['name'], strrpos($thumbnail_info['name'], '.') + 1);
// 확장자 체크 (2차)
if(!in_array($ext, $allowed_extensions)) {
    echo '<script> alert("업로드할 수 없는 확장자 입니다."); history.back(); </script>';
    return false;
}

// 썸네일 크기 체크
if($thumbnail_info['size'] >= $max_file_size) {
    echo '<script>alert("5MB 까지만 업로드 가능합니다."); history.back();</script>';
    return false;
}

$f_thumbnail_id = md5(uniqid(rand(), true));
$f_thumbnail_name_ori = $thumbnail_info['name'];
$f_thumbnail_name_crypto = md5(microtime()) . '.' . $ext;

$sql = "INSERT INTO THUMBNAIL (F_THUMBNAIL_ID, F_THUMBNAIL_NAME_ORI, F_THUMBNAIL_NAME_CRYPTO, F_REG_TIME)";
$sql = $sql." VALUES('$f_thumbnail_id','$f_thumbnail_name_ori','$f_thumbnail_name_crypto', now())";
$result = $conn->query($sql);
if(!$result){
    $conn->close();
    echo '<script> alert("썸네일 등록이 실패하였습니다."); </script>';
    return false;
} else {
    move_uploaded_file($thumbnail_info['tmp_name'], $thumbnail_directory.$f_thumbnail_name_crypto);
}

$sql = "INSERT INTO LECTURE (F_CATEGORY_ID, F_CATEGORY, F_LECTURE, F_INSTRUCTOR, F_LEARNING_TIME, F_LECTURE_COUNT, F_GRADE, F_ADMIN_ID, F_ADMIN_NAME, F_THUMBNAIL_ID, F_REG_TIME)";
$sql = $sql." VALUES('$f_category_id','$f_category','$f_lecture','$f_instructor','$f_learning_time','$f_lecture_count', '$f_grade','$f_id','$f_name', '$f_thumbnail_id', now())";
$result = $conn->query($sql);
$conn->close();

if($result){
    echo "<script> alert('강의 등록이 완료되었습니다.');window.location.href='/admin/index.php?mode=list'</script>";
}else{
    echo "<script> alert('실패'); history.back();</script>";
}

