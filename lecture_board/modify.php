<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$f_category = $_POST['f_category'];
$f_lecture = $_POST['f_lecture'];
$f_title = $_POST['f_title'];
$f_grade = $_POST['radio'];
$f_contents = addslashes(trim($_POST['content']));
$f_name = $_POST['f_name'];
$f_id = $_POST['f_id'];
$f_num = $_POST['f_num'];

$sql = "UPDATE BOARD SET F_CATEGORY = '$f_category', F_LECTURE = '$f_lecture', F_TITLE = '$f_title', F_GRADE = '$f_grade', F_CONTENTS = '$f_contents' ";
$sql .= "WHERE F_NAME = '$f_name' AND F_ID = '$f_id' AND F_NUM = $f_num";

$result = mysqli_query($conn, $sql);

if($result){
    Header("Location: /lecture_board/step_03.php?f_num=".$f_num);
}else{
    echo 'fail to update sql '.$sql;
}