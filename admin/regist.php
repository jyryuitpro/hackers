<?php
$conn = mysqli_connect('192.168.56.108', 'root', '', 'hackers');

//var_dump($_FILES);
//var_dump($_POST);

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

$file = $_FILES['upfile'];
$upload_directory = './thumbnail/';
$ext_str = "hwp,xls,doc,xlsx,docx,pdf,jpg,gif,png,txt,ppt,pptx";
$allowed_extensions = explode(',', $ext_str);
$max_file_size = 5242880;
$ext = substr($file['name'], strrpos($file['name'], '.') + 1);

// 확장자 체크
if(!in_array($ext, $allowed_extensions)) {
    echo '<script>alert("업로드할 수 없는 확장자 입니다."); history.back();</script>';
}

// 파일 크기 체크
if($file['size'] >= $max_file_size) {
    echo '<script>alert("5MB 까지만 업로드 가능합니다."); history.back();</script>';
}

$path = md5(microtime()) . '.' . $ext;
$file_id = md5(uniqid(rand(), true));
$name_orig = $file['name'];

if(move_uploaded_file($file['tmp_name'], $upload_directory.$path)) {
    $sql = "INSERT INTO THUMBNAIL (F_ADMIN_ID, F_ADMIN_NAME,  F_LECTURE, F_INSTRUCTOR, F_LEARNING_TIME, F_LECTURE_COUNT, F_FIEL_ID, F_FILE_NAME_ORI, F_FILE_NAME_CP, F_REG_TIME)";
    $sql = $sql." VALUES('$f_id','$f_name','$f_lecture','$f_instructor','$f_learning_time','$f_lecture_count','$file_id','$name_orig','$path',now())";

//    var_dump($sql);

    $stmt = mysqli_prepare($conn, $sql);
    $bind = mysqli_stmt_bind_param($stmt, "sss", $file_id, $name_orig, $name_save);
    $exec = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

$sql = "INSERT INTO LECTURE (F_CATEGORY, F_LECTURE, F_INSTRUCTOR, F_LEARNING_TIME, F_LECTURE_COUNT, F_GRADE, F_ADMIN_NAME, F_ADMIN_ID, F_FIEL_ID, F_FILE_NAME_ORI)";
$sql = $sql." VALUES('$f_category','$f_lecture','$f_instructor','$f_learning_time','$f_lecture_count', '$f_grade','$f_name','$f_id', '$file_id', '$name_orig')";
$result = mysqli_query($conn, $sql);

if($result){
    echo '<script>alert("강의 등록이 완료되었습니다.");</script>';
    Header("Location: /admin/index.php?mode=list");
}else{
    echo 'fail to insert sql '.$sql;
}

