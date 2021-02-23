<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

//var_dump($_SESSION);
//exit;

//array(1) {
//    ["upload_file"]=> array(5) {
//                                ["name"]=> string(16) "첨부파일.txt"
//                                ["type"]=> string(10) "text/plain"
//                                ["tmp_name"]=> string(14) "/tmp/phpGp6mVQ"
//                                ["error"]=> int(0)
//                                ["size"]=> int(9)
//                            }
//        }

// 임시 파일명
$tmpfilename = $_FILES['upload_file']['tmp_name'];
// 원본 파일명, 파일첨부박스에서 보여질 파일명
$file_name_ori = $_FILES['upload_file']['name'];
// 원본 파일 확장자 가져오기
$ext = substr($_FILES['upload_file']['name'], strrpos($_FILES['upload_file']['name'], '.') + 1);
// 변환 파일명
$filename = md5(microtime()) . '.' . $ext;
// 파일 타입
$filetype = $_FILES['upload_file']['type'];
// 파일 사이즈
$filesize = $_FILES['upload_file']['size'];
// 저장될 디렉토리 경로
$destination = "./attachment_file/" . $filename;
// 수강후기 등록 시, 전달되는 $_POST['attach_file'] 값
$fileurl = $file_name_ori . "|" . $filename;
// 변환 파일명으로 저장
move_uploaded_file($tmpfilename, $destination);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Daum에디터 - 파일 첨부</title>
    <script src="daumeditor/js/popup.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="daumeditor/css/popup.css" type="text/css" charset="utf-8"/>
    <script type="text/javascript">
        function initUploader(){
            var _opener = PopupUtil.getOpener();
            if (!_opener) {
                alert('잘못된 경로로 접근하셨습니다.');
                return;
            }

            var _attacher = getAttacher('file', _opener);
            registerAction(_attacher);

            if (typeof(execAttach) == 'undefined') { //Virtual Function
                return;
            }

            var _mockdata = {
                'attachurl': '<?=$fileurl?>',
                'filemime': '<?=$filetype?>',
                'filename': '<?=$file_name_ori?>',
                'filesize': <?=$filesize?>
            };

            execAttach(_mockdata);
            closeWindow();
        }
    </script>
</head>
<body onload="initUploader();">
</body>
</html>
