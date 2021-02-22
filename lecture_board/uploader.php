<?

//var_dump($_FILES);
//exit;
$uploads_dir = './attachment';
$file_name = $_FILES['upload_file']['name'];
$tmp_file = $_FILES['upload_file']['tmp_name'];
$file_url = './attachment/'.$file_name;
$file_size = $_FILES['upload_file']['size'];


if(move_uploaded_file($tmp_file, "$uploads_dir/$file_name"))
{
    echo"파일 업로드 성공<br>";
}
else
{
    echo"파일 업로드 실패<br>";
}
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

        function initUploader(){
            var _opener = PopupUtil.getOpener();
            if (!_opener) {
                alert('잘못된 경로로 접근하셨습니다.');
                return;
            }

            var _attacher = getAttacher('image', _opener);
            registerAction(_attacher);

            if (typeof(execAttach) == 'undefined') { //Virtual Function
                return;
            }

            var _mockdata = {
                'imageurl': './attachment/<?php echo $file_name; ?>',
                'filename': '<?php echo $file_name; ?>',
                'filesize': <?php echo $file_size; ?>,
                'imagealign': 'C',
                'originalurl': './attachment/<?php echo $file_name; ?>',
                'thumburl': './attachment/<?php echo $file_name; ?>',
            };
            parent.execAttach(_mockdata);
            closeWindow();
        }
        // ]]>
    </script>
</head>
<body onload="initUploader();">
</body>
</html>
