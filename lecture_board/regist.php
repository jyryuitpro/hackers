<?php
$conn = mysqli_connect('192.168.56.108', 'root', '', 'hackers');

$f_category = $_POST['f_category'];
$f_lecture = $_POST['f_lecture'];
$f_title = $_POST['f_title'];
$f_grade = $_POST['radio'];
$f_contents = $_POST['content'];
$f_name = $_POST['f_name'];
$f_id = $_POST['f_id'];

$sql = "INSERT INTO BOARD (F_CATEGORY, F_LECTURE, F_TITLE, F_GRADE, F_CONTENTS, F_NAME, F_ID)";
$sql = $sql." VALUES('$f_category','$f_lecture','$f_title','$f_grade','$f_contents','$f_name','$f_id')";
$result = mysqli_query($conn, $sql);

if($result){


    Header("Location: /lecture_board/index.php?mode=list");
}else{
    echo 'fail to insert sql '.$sql;
}