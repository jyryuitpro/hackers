<?php
session_start();
session_destroy();
$str = "<script>";
$str .= "alert('로그아웃 되었습니다.');";
$str .= "location.href = '../index.php';";
$str .= "</script>";
echo $str;
?>