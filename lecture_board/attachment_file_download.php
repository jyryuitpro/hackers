<?php
require_once("../database/dbconfig.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);

$f_attach_file = $_GET['f_attach_file'];

$sql = "SELECT F_ATTACH_FILE FROM BOARD WHERE F_ATTACH_FILE = '$f_attach_file'";

$result = $conn->query($sql);
$result = $result->fetch_assoc();


//$f_thumbnail_name_crypto = $result['F_THUMBNAIL_NAME_CRYPTO'];
//$thumbnail_dir = "./thumbnail/";
$f_attach_file_path = $result['F_ATTACH_FILE'];
$f_attach_file_length = filesize($f_attach_file_path);
$array = explode("/", $f_attach_file_path);
$f_attach_file_name = $array[2];

header("Content-Type: application/octet-stream");
header("Content-Length: $f_attach_file_length");
header("Content-Disposition: attachment; filename=".iconv('utf-8','euc-kr',$f_attach_file_name));
header("Content-Transfer-Encoding: binary");

$f_attach_file_download = fopen($f_attach_file_path, "r");
fpassthru($f_attach_file_download);
$conn->close();
