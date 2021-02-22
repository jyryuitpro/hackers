<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//var_dump($_FILES);
//exit;

//array(1) {
//    ["upload_file"]=> array(5) {
//                                ["name"]=> string(16) "첨부파일.txt"
//                                ["type"]=> string(10) "text/plain"
//                                ["tmp_name"]=> string(14) "/tmp/phpGp6mVQ"
//                                ["error"]=> int(0) ["size"]=> int(9)
//                            }
//        }

//$subject = $_POST['subject'];
$tmpfilename = $_FILES['upload_file']['tmp_name'];
$filename = $_FILES['upload_file']['name'];
$filetype = $_FILES['upload_file']['type'];
$filesize = $_FILES['upload_file']['size'];
$destination = "./attachment/" . $filename;
$fileurl = "./attachment/" . $filename;
move_uploaded_file($tmpfilename, $destination);
//write_into_db_filemeta($filename, $destination, $filesize, $filetype, $fileurl);
//업로드한 이름과 파일의 사이즈나 mime / type들을 읽어서 DB에 저장하는 사용자 함수

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Daum에디터 - 이미지 첨부</title>
    <script src="daumeditor/js/popup.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="daumeditor/css/popup.css" type="text/css" charset="utf-8"/>
    <script type="text/javascript">
        // <![CDATA[

        function done() {
            if (typeof(execAttach) == 'undefined') { //Virtual Function
                return;
            }

            var _mockdata = {
                'attachurl': 'http://cfile297.uf.daum.net/attach/207C8C1B4AA4F5DC01A644',
                'filemime': 'image/gif',
                'filename': 'editor_bi.gif',
                'filesize': 640
            };
            execAttach(_mockdata);
            closeWindow();
        }

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
                'filename': '<?=$filename?>',
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
