<?php
//$conn = mysqli_connect('192.168.56.108', 'root', '', 'hackers');
$conn = mysqli_connect('localhost:3307', 'root', 'root', 'hackers');

// 분류
$f_category = $_POST['f_category'];
// 강의명
$f_lecture = $_POST['f_lecture'];
// 강사
$f_instructor = $_POST['f_instructor'];
// 학습시간
$f_learning_time = $_POST['f_learning_time'];
// 강의수
$f_lecture_count = $_POST['f_lecture_count'];
// 학습난이도
$f_grade = $_POST['radio'];

$f_name = $_POST['f_name'];
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
}

// 썸네일 크기 체크
if($thumbnail_info['size'] >= $max_file_size) {
    echo '<script>alert("5MB 까지만 업로드 가능합니다."); history.back();</script>';
}

$f_thumbnail_id = md5(uniqid(rand(), true));
$f_thumbnail_name_ori = $thumbnail_info['name'];
$f_thumbnail_name_crypto = md5(microtime()) . '.' . $ext;

$sql = "INSERT INTO THUMBNAIL (F_THUMBNAIL_ID, F_FILE_NAME_ORI, F_THUMBNAIL_NAME_CRYPTO, F_REG_TIME)";
$sql = $sql." VALUES('$f_thumbnail_id','$f_thumbnail_name_ori','$f_thumbnail_name_crypto', now())";
$result = mysqli_query($conn, $sql);
if(!$result){
    echo '<script> alert("썸네일 등록이 실패하였습니다."); </script>';
} else {
    move_uploaded_file($thumbnail_info['tmp_name'], $thumbnail_directory.$f_thumbnail_name_crypto);
}

$sql = "INSERT INTO LECTURE (F_CATEGORY, F_LECTURE, F_INSTRUCTOR, F_LEARNING_TIME, F_LECTURE_COUNT, F_GRADE, F_ADMIN_ID, F_ADMIN_NAME, F_THUMBNAIL_ID, F_REG_TIME)";
$sql = $sql." VALUES('$f_category','$f_lecture','$f_instructor','$f_learning_time','$f_lecture_count', '$f_grade','$f_id','$f_name', '$f_thumbnail_id', now())";
$result = mysqli_query($conn, $sql);

if($result){
    echo '<script>alert("강의 등록이 완료되었습니다.");</script>';
    Header("Location: /admin/index.php?mode=list");
}else{
    echo 'fail to insert sql '.$sql;
}

