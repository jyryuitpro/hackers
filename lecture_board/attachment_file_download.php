<?php
require_once("../database/dbconfig.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);

//var_dump($_GET);
//exit;

//array(2) {
//    ["f_attach_file_ori"]=> string(17) "첨부파일2.txt"
//    ["f_attach_file_crypto"]=> string(36) "60a3f1b21986c3acec2ce89050f3bc1b.txt"
//}

// 원본 파일명
$f_attach_file_ori = $_GET['f_attach_file_ori'];
// 변환 파일명
$f_attach_file_crypto = $_GET['f_attach_file_crypto'];

$sql = "SELECT F_ATTACH_FILE_CRYPTO FROM BOARD WHERE F_ATTACH_FILE_ORI = '$f_attach_file_ori' AND F_ATTACH_FILE_CRYPTO = '$f_attach_file_crypto'";

$result = $conn->query($sql);
$result = $result->fetch_assoc();

$attachment_file_dir = "./attachment_file/";
$attachment_file_path = $attachment_file_dir.$f_attach_file_crypto;
$attachment_file_length = filesize($attachment_file_path);

header("Content-Type: application/octet-stream");
header("Content-Length: $attachment_file_length");
header("Content-Disposition: attachment; filename=".iconv('utf-8','euc-kr',$f_attach_file_ori));
header("Content-Transfer-Encoding: binary");

$f_attach_file_download = fopen($attachment_file_path, "r");
fpassthru($f_attach_file_download);
$conn->close();
