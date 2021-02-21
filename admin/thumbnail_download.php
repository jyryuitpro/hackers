<?php
require_once("../database/dbconfig.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);

$f_thumbnail_name_crypto = $_GET['f_thumbnail_name_crypto'];

$sql = "SELECT F_THUMBNAIL_NAME_CRYPTO FROM THUMBNAIL WHERE F_THUMBNAIL_NAME_CRYPTO = '$f_thumbnail_name_crypto'";
$result = $conn->query($sql);
$result = $result->fetch_assoc();

$f_thumbnail_name_crypto = $result['F_THUMBNAIL_NAME_CRYPTO'];
$thumbnail_dir = "./thumbnail/";
$thumbnail_path = $thumbnail_dir.$f_thumbnail_name_crypto;
$thumbnail_length = filesize($thumbnail_path);

header("Content-Type: application/octet-stream");
header("Content-Length: $thumbnail_length");
header("Content-Disposition: attachment; filename=".iconv('utf-8','euc-kr',$f_thumbnail_name_crypto));
header("Content-Transfer-Encoding: binary");

$thumbnail_download = fopen($thumbnail_path, "r");
fpassthru($thumbnail_download);
$conn->close();
