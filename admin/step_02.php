<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

session_start();
$f_name = $_SESSION['f_name']; // 관리자 이름
$f_id = $_SESSION['f_id']; // 관리자 아이디
$f_gubun = $_GET['f_gubun']; // 강의 등록, 수정 구분 값
$f_num = $_GET['f_num']; // 강의 등록 번호

// 강의 수정 시, DB에 저장된 강의, 썸네일 정보 가져오기
if ($_GET['f_gubun'] == "modify") {

    $sql = "SELECT * FROM LECTURE WHERE F_NUM = " . $f_num;
    $result_normal = $conn->query($sql);
    $row = $result_normal->fetch_assoc();

    $sql_thumbnail = "SELECT F_THUMBNAIL_NAME_CRYPTO FROM LECTURE a JOIN THUMBNAIL b ON a.F_THUMBNAIL_ID = b.F_THUMBNAIL_ID WHERE a.F_NUM = " . $f_num;
    $result_thumbnail = $conn->query($sql_thumbnail);
    $row_thumbnail = $result_thumbnail->fetch_assoc();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<!--[if (IE 7)]><html class="no-js ie7" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko"><![endif]-->
<!--[if (IE 8)]><html class="no-js ie8" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko"><![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" id="X-UA-Compatible" content="IE=EmulateIE8" />
<title>해커스 HRD</title>
<meta name="description" content="해커스 HRD" />
<meta name="keywords" content="해커스, HRD" />

<!-- 파비콘설정 -->
<link rel="shortcut icon" type="image/x-icon" href="http://img.hackershrd.com/common/favicon.ico" />

<!-- xhtml property속성 벨리데이션 오류/확인필요 -->
<meta property="og:title" content="해커스 HRD" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://www.hackershrd.com/" />
<meta property="og:image" content="http://img.hackershrd.com/common/og_logo.png" />

<link type="text/css" rel="stylesheet" href="http://q.hackershrd.com/worksheet/css/common.css" />
<link type="text/css" rel="stylesheet" href="http://q.hackershrd.com/worksheet/css/bxslider.css" />
<link type="text/css" rel="stylesheet" href="http://q.hackershrd.com/worksheet/css/main.css" /><!-- main페이지에만 호출 -->
<link type="text/css" rel="stylesheet" href="http://q.hackershrd.com/worksheet/css/sub.css" /><!-- sub페이지에만 호출 -->
<link type="text/css" rel="stylesheet" href="http://q.hackershrd.com/worksheet/css/login.css" /><!-- login페이지에만 호출 -->

<script type="text/javascript" src="http://q.hackershrd.com/worksheet/js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="http://q.hackershrd.com/worksheet/js/plugins/bxslider/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="http://q.hackershrd.com/worksheet/js/plugins/bxslider/bxslider.js"></script>
<script type="text/javascript" src="http://q.hackershrd.com/worksheet/js/ui.js"></script>
<!--[if lte IE 9]> <script src="/js/common/place_holder.js"></script> <![endif]-->
<script type="text/javascript">
    $(document).ready(function () {
        // 썸네일 파일 업로드 시, 미리보기 기능
        $("#thumbnail").change(function(){
            readURL(this);
        });
    });

    // 썸네일 선택 클릭 시, 파일 업로드 팝업 실행
    function upload_thumbnail() {
        $("#thumbnail").click();
    }

    // 썸네일 파일 업로드 시, 미리보기 기능
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#thumbnail_section').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // 강의 등록, 수정 공통 함수
    function regist_modify_submit() {
        if ($("[id=f_category_id] :selected").val() =="") {
            alert("분류를 선택해주세요.");
            $("#f_category_id").focus();
            return false;
        }

        if ($("#f_lecture").val() == "") {
            alert("강의명을 입력해주세요.");
            $("#f_lecture").focus();
            return false;
        }

        if ($("#f_instructor").val() == "") {
            alert("강사명을 입력해주세요.");
            $("#f_instructor").focus();
            return false;
        }

        if ($("#f_learning_time").val() == "") {
            alert("학습시간을 입력해주세요.");
            $("#f_learning_time").focus();
            return false;
        }

        if ($("#f_lecture_count").val() == "") {
            alert("강의수를 입력해주세요.");
            $("#f_lecture_count").focus();
            return false;
        }

        if (!$('input:radio[name=radio]').is(':checked')) {
            alert("학습난이도를 선택해주세요.");
            $("#f_category").focus();
            return false;
        }

        // 썸네일 파일
        $.urlParam = function(name){
            var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if (results == null){
                return null;
            }
            else{
                return results[1] || 0;
            }
        }
        var f_gubun = $.urlParam('f_gubun');

        var path = document.getElementById("thumbnail").value;
        if(path == "" && f_gubun != "modify") {
            alert("썸네일 파일을 선택해 주세요.");
            return false;
        }
        $("#regist").submit();
    }
</script>
</head><body>
<!-- skip nav -->
<div id="skip-nav">
<a href="#content">본문 바로가기</a>
</div>
<!-- //skip nav -->

<div id="wrap">
    <?php include '../include/header.php'; ?>
<div id="container" class="container">
	<div id="nav-left" class="nav-left">
        <div class="nav-left-tit">
            <span>HRD ADMIN</span>
        </div>
<!--        <ul class="nav-left-lst">-->
<!--            <li class="on"><a href="#">전체</a></li>-->
<!--            <li><a href="#">어학 및 자격증</a></li>-->
<!--            <li><a href="#">공통역량</a></li>-->
<!--            <li><a href="#">일반직무</a></li>-->
<!--            <li><a href="#">산업직무</a></li>-->
<!--        </ul>-->
    </div>

    <div id="content" class="content">
        <div class="tit-box-h3">
            <h3 class="tit-h3">관리자</h3>
            <div class="sub-depth">
                <span><i class="icon-home"><span>홈</span></i></span>
                <span>관리자</span>
                <?php
                if ($_GET['f_gubun'] != 'modify') { // 강의 등록
                ?>
                    <strong>강의 등록</strong>
                <?php
                } else { // 강의 수정
                ?>
                    <strong>강의 수정</strong>
                <?php
                }
                ?>
            </div>
        </div>

<!--        <ul class="tab-list tab5" style="display: table">-->
<!--            <li class="on" style="width:129px;"><a href="#">전체</a></li>-->
<!--            <li style="width:129px;"><a href="#">어학 및 자격증</a></li>-->
<!--            <li style="width:129px;"><a href="#">공통역량</a></li>-->
<!--            <li style="width:129px;"><a href="#">일반직무</a></li>-->
<!--            <li style="width:129px;"><a href="#">산업직무</a></li>-->
<!--            <li style="width:129px;"><a href="#">수강후기</a></li>-->
<!--        </ul>-->

        <?php
        if ($_GET['f_gubun'] != 'modify') { // 강의 등록
        ?>
        <p class="mb15"><strong class="tc-brand fs16">강의 등록</strong></p>
        <?php
        } else { // 강의 수정
        ?>
        <p class="mb15"><strong class="tc-brand fs16">강의 수정</strong></p>
        <?php
        }
        ?>

        <?php
        if ($_GET['f_gubun'] != 'modify') { // 강의 등록
        ?>
        <form name="regist" id="regist" method="post" action="/admin/regist.php" enctype="multipart/form-data" >
        <?php
        } else { // 강의 수정
        ?>
        <form name="regist" id="regist" method="post" action="/admin/modify.php?f_gubun=modify&f_num=<?php echo $f_num ?>" enctype="multipart/form-data" >
        <?php
        }
        ?>
            <input type="hidden" class="input-text" style="width:611px" name="f_name" id="f_name" value="<?php echo $f_name ?>"/>
            <input type="hidden" class="input-text" style="width:611px" name="f_id" id="f_id" value="<?php echo $f_id ?>"/>
            <input type="hidden" class="input-text" style="width:611px" name="f_category_id" id="f_category_id" value=""/>
<!--            <input type="hidden" class="input-text" style="width:611px" name="f_num" id="f_num" value="--><?php //echo $f_num ?><!--"/>-->
            <table border="0" cellpadding="0" cellspacing="0" class="tbl-col">
                <caption class="hidden">강의정보</caption>
                <colgroup>
                    <col style="width:15%"/>
                    <col style="*"/>
                </colgroup>

                <tbody>
                <tr>
                    <th scope="col">분류</th>
                    <td>
                        <select class="input-sel" style="width:160px" name="f_category_id" id="f_category_id">
                            <option value="">선택</option>
                        <?php
                        // 강의 분류 가져오기
                        $sql = "SELECT * FROM CATEGORY";
                        $result_category = $conn->query($sql);
                        while ($row_category = $result_category->fetch_assoc()) {
                        ?>
                            <option value="<?php echo @$row_category['F_CATEGORY_ID']?>" <? if(@$row_category['F_CATEGORY_ID'] == @$_GET['f_category_id']) { echo "selected"; } ?> ><?php echo @$row_category['F_CATEGORY']?></option>
                        <?php
                        }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="col">강의명</th>
                    <td><input type="text" class="input-text" style="width:580px" name="f_lecture" id="f_lecture" value="<?php echo @$row['F_LECTURE'] ?>"/></td>
                </tr>
                <tr>
                    <th scope="col">강사명</th>
                    <td><input type="text" class="input-text" style="width:160px" name="f_instructor" id="f_instructor" value="<?php echo @$row['F_INSTRUCTOR'] ?>"/></td>
                </tr>
                <tr>
                    <th scope="col">학습시간</th>
                    <td><input type="number" class="input-text" style="width:160px" name="f_learning_time" id="f_learning_time" value="<?php echo @$row['F_LEARNING_TIME'] ?>"/> 시간</td>
                </tr>
                <tr>
                    <th scope="col">강의수</th>
                    <td><input type="number" class="input-text" style="width:160px" name="f_lecture_count" id="f_lecture_count" value="<?php echo @$row['F_LECTURE_COUNT'] ?>"/> 강</td>
                </tr>
                <tr>
                    <th scope="col">학습난이도</th>
                    <td>
                        <ul class="list-rating-choice">
                            <?php
                            for ($i = 5; $i > 0; $i--) {
                                ?>
                                <li>
                                    <label class="input-sp ico">
                                        <input type="radio" name="radio" id="f_grade_<?php echo $i; ?>" value="<?php echo $i; ?>" <?php if(@$row['F_GRADE'] == $i) echo 'checked'?> />
                                        <span class="input-txt">만점</span>
                                    </label>
                                    <span class="star-rating">
									 <?php
                                     if ($i == 5) {
                                         ?>
                                         <span class="star-inner" style="width:100%"></span>
                                         <?php
                                     } else if ($i == 4) {
                                         ?>
                                         <span class="star-inner" style="width:80%"></span>
                                         <?php
                                     } else if ($i == 3) {
                                         ?>
                                         <span class="star-inner" style="width:60%"></span>
                                         <?php
                                     } else if ($i == 2) {
                                         ?>
                                         <span class="star-inner" style="width:40%"></span>
                                         <?php
                                     } else if ($i == 1) {
                                         ?>
                                         <span class="star-inner" style="width:20%"></span>
                                         <?php
                                     }
                                     ?>
								</span>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th scope="col">썸네일</th>
                    <td>
                        <a href="javascript:void(0);" class="sample-lecture">
                            <?php
                            if (isset($row_thumbnail)) { // 강의 수정 시, 썸네일 정보 가져오기
                            ?>
                            <img src="./thumbnail/<?php echo @$row_thumbnail['F_THUMBNAIL_NAME_CRYPTO']; ?>" alt="" name="thumbnail_section" id="thumbnail_section" width="144" height="101" />
                            <?php
                            } else { // 강의 등록 시, 썸네일 기본 정보
                            ?>
                            <img src="http://via.placeholder.com/144x101" alt="" name="thumbnail_section" id="thumbnail_section" width="144" height="101" />
                            <?php
                            }
                            ?>
                            <input type="file" name="thumbnail" id="thumbnail" style="display: none"/>
                            <span class="tc-brand" onclick="upload_thumbnail();">썸네일 선택</span>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="box-btn t-r">
                <a href="javascript:history.back();" class="btn-m-gray">목록</a>
                <?php
                if (@$_GET['f_gubun'] != "modify") { // 강의 등록
                ?>
                    <a href="javascript:void(0);" onclick="regist_modify_submit();" class="btn-m ml5">등록</a>
                <?php
                } else { // 강의 수정
                ?>
                    <a href="#" class="btn-m ml5" onclick="regist_modify_submit();">수정</a>
                    <a href="/admin/modify.php?f_gubun=delete&f_num=<?php echo $f_num ?>" class="btn-m-dark">삭제</a>
                <?php
                }
                ?>
            </div>
        </form>
	</div>
</div>
    <?php include '../include/footer.php'; ?>
</div>
</body>
</html>
