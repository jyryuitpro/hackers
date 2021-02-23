<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
session_start();
$f_name = $_SESSION['f_name'];
$f_id = $_SESSION['f_id'];
$f_category_id = $_GET['f_category_id'];

//var_dump($f_name);
//var_dump($f_id);
//var_dump($f_category_id);

if (isset($_GET['f_num']) && isset($_GET['f_gubun'])) {
    $f_num = $_GET['f_num'];

    // 일반 게시글
    $sql = 'SELECT * FROM BOARD WHERE F_NUM = ' . $f_num;
    $result_normal = $conn->query($sql);
    $row = $result_normal->fetch_assoc();
//    var_dump($row);
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
    <link rel="stylesheet" href="./daumEditor/css/editor.css" type="text/css" charset="utf-8"/>
    <script src="./daumEditor/js/editor_loader.js?environment=development" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // DB 글 내용 가져오기
            loadContent();

            $("#f_category_id").change(function(){
                var f_category_id = $(this).val(); // 선택한 구분1
                $.ajax({
                    url  : "/lecture_board/search.php",
                    type : "GET",
                    data : "f_category_id="+f_category_id,
                    success:function(data) {
                        var res = $.parseJSON(data);
                        $("#f_lecture").empty();
                        $('#f_lecture').append('<option value="">강의명</option>');
                        $.each(res, function(index, value){
                            $('#f_lecture').append('<option value="' + value + '">' + value + '</option>');
                        });
                    },
                    error:function(){
                    }
                });
            });
        });

        // 글 내용 저장
        function saveContent() {
            if (!$("#f_category_id > option:selected").val()) {
                alert("강의 분류를 선택해주세요.");
                return false;
            }

            if (!$("#f_lecture > option:selected").val()) {
                alert("강의명을 선택해주세요.");
                return false;
            }

            if (!$("#f_title").val()) {
                alert("제목을 입력해주세요.");
                return false;
            }

            if (!$('input:radio[name=radio]').is(':checked')) {
                alert("강의 만족도를 선택해주세요.");
                return false;
            }

            Editor.save(); // 이 함수를 호출하여 글을 등록하면 된다.
        }

        // 글 내용 수정
        function editContent() {
            if (!$("#f_category_id > option:selected").val()) {
                alert("강의 분류를 선택해주세요.");
                return false;
            }

            if (!$("#f_lecture > option:selected").val()) {
                alert("강의명을 선택해주세요.");
                return false;
            }

            if (!$("#f_title").val()) {
                alert("제목을 입력해주세요.");
                return false;
            }

            if (!$('input:radio[name=radio]').is(':checked')) {
                alert("강의 만족도를 선택해주세요.");
                return false;
            }

            Editor.save(); // 이 함수를 호출하여 글을 등록하면 된다.
        }

        // DB 글 내용 가져오기
        function loadContent() {
            var attachments = {};
            Editor.modify({
                "attachments": function () { /* 저장된 첨부가 있을 경우 배열로 넘김, 위의 부분을 수정하고 아래 부분은 수정없이 사용 */
                    var allattachments = [];
                    for (var i in attachments) {
                        allattachments = allattachments.concat(attachments[i]);
                    }
                    return allattachments;
                }(),
                "content": document.getElementById("sample_contents_source") /* 내용 문자열, 주어진 필드(textarea) 엘리먼트 */
            });
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
        <?php include '../include/left.php'; ?>

        <div id="content" class="content">
            <div class="tit-box-h3">
                <h3 class="tit-h3">수강후기</h3>
                <div class="sub-depth">
                    <span><i class="icon-home"><span>홈</span></i></span>
                    <span>직무교육 안내</span>
                    <strong>수강후기</strong>
                </div>
            </div>

            <div class="user-notice">
                <strong class="fs16">유의사항 안내</strong>
                <ul class="list-guide mt15">
                    <li class="tc-brand">수강후기는 신청하신 강의의 학습진도율 25%이상 달성시 작성가능합니다. </li>
                    <li>욕설(욕설을 표현하는 자음어/기호표현 포함) 및 명예훼손, 비방,도배글, 상업적 목적의 홍보성 게시글 등 사회상규에 반하는 게시글 및 강의내용과 상관없는 서비스에 대해 작성한 글들은 삭제 될 수 있으며, 법적 책임을 질 수 있습니다.</li>
                </ul>
            </div>
        <!-- form 시작 -->
        <?php
        if ($_GET['f_gubun'] != "modify") {
            ?>
            <form name="tx_editor_form" id="tx_editor_form" action="/lecture_board/regist.php" method="post" enctype="multipart/form-data" accept-charset="utf-8">
            <?php
        } else {
            ?>
            <form name="tx_editor_form" id="tx_editor_form" action="/lecture_board/modify.php" method="post" enctype="multipart/form-data" accept-charset="utf-8">
        <?php
        }
        ?>
            <input type="hidden" class="input-text" style="width:611px" name="f_name" id="f_name" value="<?php echo $f_name ?>"/>
            <input type="hidden" class="input-text" style="width:611px" name="f_id" id="f_id" value="<?php echo $f_id ?>"/>
            <input type="hidden" class="input-text" style="width:611px" name="f_num" id="f_num" value="<?php echo @$f_num ?>"/>
            <input type="hidden" class="input-text" style="width:611px" name="f_gubun" id="f_gubun" value="<?php echo $_GET['f_gubun']; ?>"/>
            <table border="0" cellpadding="0" cellspacing="0" class="tbl-col">
                <caption class="hidden">강의정보</caption>
                <colgroup>
                    <col style="width:15%"/>
                    <col style="*"/>
                </colgroup>

                <tbody>
                <?php
                if ($_GET['f_gubun'] != "modify") { // 등록
                ?>
                    <tr>
                        <th scope="col">강의</th>
                        <td>
                            <select class="input-sel" style="width:160px" name="f_category_id" id="f_category_id" >
                                <option value="">분류</option>
                                <?php
                                $sql = "SELECT * FROM CATEGORY ORDER BY F_CATEGORY_ID";
                                $result_normal = $conn->query($sql);
                                while ($row = $result_normal->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['F_CATEGORY_ID']; ?>"><?php echo $row['F_CATEGORY']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <select class="input-sel ml5" style="width:454px" name="f_lecture" id="f_lecture" >
                                <option value="">강의명</option>
                            </select>
                        </td>
                    </tr>
                <?php
                } else { // 수정
                ?>
                    <tr>
                        <th scope="col">강의</th>
                        <td>
                            <input type="hidden" class="input-text" style="width:140px" name="f_category_id" id="f_category_id" value="<?php echo $row['F_CATEGORY_ID']; ?>" readonly/>
                            <input type="text" class="input-text" style="width:140px" name="f_category" id="f_category" value="<?php echo $row['F_CATEGORY']; ?>" readonly/>
                            <input type="text" class="input-text" style="width:454px" name="f_lecture" id="f_lecture" value="<?php echo $row['F_LECTURE']; ?>" readonly/>
<!--                            <select class="input-sel" style="width:160px" name="f_category" id="f_category" >-->
<!--                                <option value="--><?php //echo $row['F_CATEGORY']; ?><!--">--><?php //echo $row['F_CATEGORY']; ?><!--</option>-->
<!--                            </select>-->
<!--                            <select class="input-sel ml5" style="width:454px" name="f_lecture" id="f_lecture">-->
<!--                                <option value="--><?php //echo $row['F_LECTURE']; ?><!--">--><?php //echo $row['F_LECTURE']; ?><!--</option>-->
<!--                            </select>-->
                        </td>
                    </tr>
                <?php
                }
                ?>
                    <tr>
                        <th scope="col">제목</th>
                        <td><input type="text" class="input-text" style="width:611px" name="f_title" id="f_title" value="<?php echo @$row['F_TITLE'] ?>"/></td>
                    </tr>
                    <tr>
                        <th scope="col">강의만족도</th>
                        <td>
                            <ul class="list-rating-choice">
                                <?php
                                for ($i = 5; $i > 0; $i--) {
                                ?>
                                <li>
                                    <label class="input-sp ico">
                                        <input type="radio" name="radio" id="f_grade_<?php echo $i; ?>" value="<?php echo $i; ?>" <?php if($row['F_GRADE'] == $i) echo 'checked'?> />
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
                </tbody>
            </table>
            <!-- 글 수정을 위한 글 내용 데이터 가져오기 -->
            <textarea id="sample_contents_source" style="display:none;">
                <?php echo stripslashes(@$row['F_CONTENTS']);?>
            </textarea>
            <div class="editor-wrap">
                <!-- 에디터 컨테이너 시작 -->
                <div id="tx_trex_container" class="tx-editor-container">
                    <!-- 사이드바 -->
                    <div id="tx_sidebar" class="tx-sidebar">
                        <div class="tx-sidebar-boundary">
                            <!-- 사이드바 / 첨부 -->
                            <ul class="tx-bar tx-bar-left tx-nav-attach">
                                <!-- 이미지 첨부 버튼 시작 -->
                                <!--
                                    @decsription
                                    <li></li> 단위로 위치를 이동할 수 있다.
                                -->
<!--                                <li class="tx-list">-->
<!--                                    <div unselectable="on" id="tx_image" class="tx-image tx-btn-trans">-->
<!--                                        <a href="javascript:;" title="사진" class="tx-text">사진</a>-->
<!--                                    </div>-->
<!--                                </li>-->
                                <!-- 이미지 첨부 버튼 끝 -->
                                <li class="tx-list">
                                    <div unselectable="on" id="tx_file" class="tx-file tx-btn-trans">
                                        <a href="javascript:;" title="파일" class="tx-text">파일</a>
                                    </div>
                                </li>
<!--                                <li class="tx-list">-->
<!--                                    <div unselectable="on" id="tx_media" class="tx-media tx-btn-trans">-->
<!--                                        <a href="javascript:;" title="외부컨텐츠" class="tx-text">외부컨텐츠</a>-->
<!--                                    </div>-->
<!--                                </li>-->
                                <li class="tx-list tx-list-extra">
                                    <div unselectable="on" class="tx-btn-nlrbg tx-extra">
                                        <a href="javascript:;" class="tx-icon" title="버튼 더보기">버튼 더보기</a>
                                    </div>
                                    <ul class="tx-extra-menu tx-menu" style="left:-48px;" unselectable="on">
                                        <!--
                                            @decsription
                                            일부 버튼들을 빼서 레이어로 숨기는 기능을 원할 경우 이 곳으로 이동시킬 수 있다.
                                        -->
                                    </ul>
                                </li>
                            </ul>
                            <!-- 사이드바 / 우측영역 -->
                            <ul class="tx-bar tx-bar-right">
                                <li class="tx-list">
                                    <div unselectable="on" class="tx-btn-lrbg tx-fullscreen" id="tx_fullscreen">
                                        <a href="javascript:;" class="tx-icon" title="넓게쓰기 (Ctrl+M)">넓게쓰기</a>
                                    </div>
                                </li>
                            </ul>
                            <ul class="tx-bar tx-bar-right tx-nav-opt">
                                <li class="tx-list">
                                    <div unselectable="on" class="tx-switchtoggle" id="tx_switchertoggle">
                                        <a href="javascript:;" title="에디터 타입">에디터</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- 툴바 - 기본 시작 -->
                    <!--
                        @decsription
                        툴바 버튼의 그룹핑의 변경이 필요할 때는 위치(왼쪽, 가운데, 오른쪽) 에 따라 <li> 아래의 <div>의 클래스명을 변경하면 된다.
                        tx-btn-lbg: 왼쪽, tx-btn-bg: 가운데, tx-btn-rbg: 오른쪽, tx-btn-lrbg: 독립적인 그룹

                        드롭다운 버튼의 크기를 변경하고자 할 경우에는 넓이에 따라 <li> 아래의 <div>의 클래스명을 변경하면 된다.
                        tx-slt-70bg, tx-slt-59bg, tx-slt-42bg, tx-btn-43lrbg, tx-btn-52lrbg, tx-btn-57lrbg, tx-btn-71lrbg
                        tx-btn-48lbg, tx-btn-48rbg, tx-btn-30lrbg, tx-btn-46lrbg, tx-btn-67lrbg, tx-btn-49lbg, tx-btn-58bg, tx-btn-46bg, tx-btn-49rbg
                    -->
                    <div id="tx_toolbar_basic" class="tx-toolbar tx-toolbar-basic"><div class="tx-toolbar-boundary">
                            <ul class="tx-bar tx-bar-left">
                                <li class="tx-list">
                                    <div id="tx_fontfamily" unselectable="on" class="tx-slt-70bg tx-fontfamily">
                                        <a href="javascript:;" title="글꼴">굴림</a>
                                    </div>
                                    <div id="tx_fontfamily_menu" class="tx-fontfamily-menu tx-menu" unselectable="on"></div>
                                </li>
                            </ul>
                            <ul class="tx-bar tx-bar-left">
                                <li class="tx-list">
                                    <div unselectable="on" class="tx-slt-42bg tx-fontsize" id="tx_fontsize">
                                        <a href="javascript:;" title="글자크기">9pt</a>
                                    </div>
                                    <div id="tx_fontsize_menu" class="tx-fontsize-menu tx-menu" unselectable="on"></div>
                                </li>
                            </ul>
                            <ul class="tx-bar tx-bar-left tx-group-font">

                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-lbg 	tx-bold" id="tx_bold">
                                        <a href="javascript:;" class="tx-icon" title="굵게 (Ctrl+B)">굵게</a>
                                    </div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-bg 	tx-underline" id="tx_underline">
                                        <a href="javascript:;" class="tx-icon" title="밑줄 (Ctrl+U)">밑줄</a>
                                    </div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-bg 	tx-italic" id="tx_italic">
                                        <a href="javascript:;" class="tx-icon" title="기울임 (Ctrl+I)">기울임</a>
                                    </div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-bg 	tx-strike" id="tx_strike">
                                        <a href="javascript:;" class="tx-icon" title="취소선 (Ctrl+D)">취소선</a>
                                    </div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-slt-tbg 	tx-forecolor" id="tx_forecolor">
                                        <a href="javascript:;" class="tx-icon" title="글자색">글자색</a>
                                        <a href="javascript:;" class="tx-arrow" title="글자색 선택">글자색 선택</a>
                                    </div>
                                    <div id="tx_forecolor_menu" class="tx-menu tx-forecolor-menu tx-colorpallete"
                                         unselectable="on"></div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-slt-brbg 	tx-backcolor" id="tx_backcolor">
                                        <a href="javascript:;" class="tx-icon" title="글자 배경색">글자 배경색</a>
                                        <a href="javascript:;" class="tx-arrow" title="글자 배경색 선택">글자 배경색 선택</a>
                                    </div>
                                    <div id="tx_backcolor_menu" class="tx-menu tx-backcolor-menu tx-colorpallete"
                                         unselectable="on"></div>
                                </li>
                            </ul>
                            <ul class="tx-bar tx-bar-left tx-group-align">
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-lbg 	tx-alignleft" id="tx_alignleft">
                                        <a href="javascript:;" class="tx-icon" title="왼쪽정렬 (Ctrl+,)">왼쪽정렬</a>
                                    </div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-bg 	tx-aligncenter" id="tx_aligncenter">
                                        <a href="javascript:;" class="tx-icon" title="가운데정렬 (Ctrl+.)">가운데정렬</a>
                                    </div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-bg 	tx-alignright" id="tx_alignright">
                                        <a href="javascript:;" class="tx-icon" title="오른쪽정렬 (Ctrl+/)">오른쪽정렬</a>
                                    </div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-rbg 	tx-alignfull" id="tx_alignfull">
                                        <a href="javascript:;" class="tx-icon" title="양쪽정렬">양쪽정렬</a>
                                    </div>
                                </li>
                            </ul>
                            <ul class="tx-bar tx-bar-left tx-group-tab">
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-lbg 	tx-indent" id="tx_indent">
                                        <a href="javascript:;" title="들여쓰기 (Tab)" class="tx-icon">들여쓰기</a>
                                    </div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-rbg 	tx-outdent" id="tx_outdent">
                                        <a href="javascript:;" title="내어쓰기 (Shift+Tab)" class="tx-icon">내어쓰기</a>
                                    </div>
                                </li>
                            </ul>
                            <ul class="tx-bar tx-bar-left tx-group-list">
                                <li class="tx-list">
                                    <div unselectable="on" class="tx-slt-31lbg tx-lineheight" id="tx_lineheight">
                                        <a href="javascript:;" class="tx-icon" title="줄간격">줄간격</a>
                                        <a href="javascript:;" class="tx-arrow" title="줄간격">줄간격 선택</a>
                                    </div>
                                    <div id="tx_lineheight_menu" class="tx-lineheight-menu tx-menu" unselectable="on"></div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="tx-slt-31rbg tx-styledlist" id="tx_styledlist">
                                        <a href="javascript:;" class="tx-icon" title="리스트">리스트</a>
                                        <a href="javascript:;" class="tx-arrow" title="리스트">리스트 선택</a>
                                    </div>
                                    <div id="tx_styledlist_menu" class="tx-styledlist-menu tx-menu" unselectable="on"></div>
                                </li>
                            </ul>
                            <ul class="tx-bar tx-bar-left tx-group-etc">
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-lbg 	tx-emoticon" id="tx_emoticon">
                                        <a href="javascript:;" class="tx-icon" title="이모티콘">이모티콘</a>
                                    </div>
                                    <div id="tx_emoticon_menu" class="tx-emoticon-menu tx-menu" unselectable="on"></div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-bg 	tx-link" id="tx_link">
                                        <a href="javascript:;" class="tx-icon" title="링크 (Ctrl+K)">링크</a>
                                    </div>
                                    <div id="tx_link_menu" class="tx-link-menu tx-menu"></div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-bg 	tx-specialchar" id="tx_specialchar">
                                        <a href="javascript:;" class="tx-icon" title="특수문자">특수문자</a>
                                    </div>
                                    <div id="tx_specialchar_menu" class="tx-specialchar-menu tx-menu"></div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-bg 	tx-table" id="tx_table">
                                        <a href="javascript:;" class="tx-icon" title="표만들기">표만들기</a>
                                    </div>
                                    <div id="tx_table_menu" class="tx-table-menu tx-menu" unselectable="on">
                                        <div class="tx-menu-inner">
                                            <div class="tx-menu-preview"></div>
                                            <div class="tx-menu-rowcol"></div>
                                            <div class="tx-menu-deco"></div>
                                            <div class="tx-menu-enter"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-rbg 	tx-horizontalrule" id="tx_horizontalrule">
                                        <a href="javascript:;" class="tx-icon" title="구분선">구분선</a>
                                    </div>
                                    <div id="tx_horizontalrule_menu" class="tx-horizontalrule-menu tx-menu" unselectable="on"></div>
                                </li>
                            </ul>
                            <ul class="tx-bar tx-bar-left">
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-lbg 	tx-richtextbox" id="tx_richtextbox">
                                        <a href="javascript:;" class="tx-icon" title="글상자">글상자</a>
                                    </div>
                                    <div id="tx_richtextbox_menu" class="tx-richtextbox-menu tx-menu">
                                        <div class="tx-menu-header">
                                            <div class="tx-menu-preview-area">
                                                <div class="tx-menu-preview"></div>
                                            </div>
                                            <div class="tx-menu-switch">
                                                <div class="tx-menu-simple tx-selected"><a><span>간단 선택</span></a></div>
                                                <div class="tx-menu-advanced"><a><span>직접 선택</span></a></div>
                                            </div>
                                        </div>
                                        <div class="tx-menu-inner">
                                        </div>
                                        <div class="tx-menu-footer">
                                            <img class="tx-menu-confirm"
                                                 src="./daumeditor/images/icon/editor/btn_confirm.gif?rv=1.0.1" alt=""/>
                                            <img class="tx-menu-cancel" hspace="3"
                                                 src="./daumeditor/images/icon/editor/btn_cancel.gif?rv=1.0.1" alt=""/>
                                        </div>
                                    </div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-bg 	tx-quote" id="tx_quote">
                                        <a href="javascript:;" class="tx-icon" title="인용구 (Ctrl+Q)">인용구</a>
                                    </div>
                                    <div id="tx_quote_menu" class="tx-quote-menu tx-menu" unselectable="on"></div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-bg 	tx-background" id="tx_background">
                                        <a href="javascript:;" class="tx-icon" title="배경색">배경색</a>
                                    </div>
                                    <div id="tx_background_menu" class="tx-menu tx-background-menu tx-colorpallete"
                                         unselectable="on"></div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-rbg 	tx-dictionary" id="tx_dictionary">
                                        <a href="javascript:;" class="tx-icon" title="사전">사전</a>
                                    </div>
                                </li>
                            </ul>
                            <ul class="tx-bar tx-bar-left tx-group-undo">
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-lbg 	tx-undo" id="tx_undo">
                                        <a href="javascript:;" class="tx-icon" title="실행취소 (Ctrl+Z)">실행취소</a>
                                    </div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="		 tx-btn-rbg 	tx-redo" id="tx_redo">
                                        <a href="javascript:;" class="tx-icon" title="다시실행 (Ctrl+Y)">다시실행</a>
                                    </div>
                                </li>
                            </ul>
                            <ul class="tx-bar tx-bar-right">
                                <li class="tx-list">
                                    <div unselectable="on" class="tx-btn-nlrbg tx-advanced" id="tx_advanced">
                                        <a href="javascript:;" class="tx-icon" title="툴바 더보기">툴바 더보기</a>
                                    </div>
                                </li>
                            </ul>
                        </div></div>
                    <!-- 툴바 - 기본 끝 -->
                    <!-- 툴바 - 더보기 시작 -->
                    <div id="tx_toolbar_advanced" class="tx-toolbar tx-toolbar-advanced"><div class="tx-toolbar-boundary">
                            <ul class="tx-bar tx-bar-left">
                                <li class="tx-list">
                                    <div class="tx-tableedit-title"></div>
                                </li>
                            </ul>

                            <ul class="tx-bar tx-bar-left tx-group-align">
                                <li class="tx-list">
                                    <div unselectable="on" class="tx-btn-lbg tx-mergecells" id="tx_mergecells">
                                        <a href="javascript:;" class="tx-icon2" title="병합">병합</a>
                                    </div>
                                    <div id="tx_mergecells_menu" class="tx-mergecells-menu tx-menu" unselectable="on"></div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="tx-btn-bg tx-insertcells" id="tx_insertcells">
                                        <a href="javascript:;" class="tx-icon2" title="삽입">삽입</a>
                                    </div>
                                    <div id="tx_insertcells_menu" class="tx-insertcells-menu tx-menu" unselectable="on"></div>
                                </li>
                                <li class="tx-list">
                                    <div unselectable="on" class="tx-btn-rbg tx-deletecells" id="tx_deletecells">
                                        <a href="javascript:;" class="tx-icon2" title="삭제">삭제</a>
                                    </div>
                                    <div id="tx_deletecells_menu" class="tx-deletecells-menu tx-menu" unselectable="on"></div>
                                </li>
                            </ul>

                            <ul class="tx-bar tx-bar-left tx-group-align">
                                <li class="tx-list">
                                    <div id="tx_cellslinepreview" unselectable="on" class="tx-slt-70lbg tx-cellslinepreview">
                                        <a href="javascript:;" title="선 미리보기"></a>
                                    </div>
                                    <div id="tx_cellslinepreview_menu" class="tx-cellslinepreview-menu tx-menu"
                                         unselectable="on"></div>
                                </li>
                                <li class="tx-list">
                                    <div id="tx_cellslinecolor" unselectable="on" class="tx-slt-tbg tx-cellslinecolor">
                                        <a href="javascript:;" class="tx-icon2" title="선색">선색</a>

                                        <div class="tx-colorpallete" unselectable="on"></div>
                                    </div>
                                    <div id="tx_cellslinecolor_menu" class="tx-cellslinecolor-menu tx-menu tx-colorpallete"
                                         unselectable="on"></div>
                                </li>
                                <li class="tx-list">
                                    <div id="tx_cellslineheight" unselectable="on" class="tx-btn-bg tx-cellslineheight">
                                        <a href="javascript:;" class="tx-icon2" title="두께">두께</a>

                                    </div>
                                    <div id="tx_cellslineheight_menu" class="tx-cellslineheight-menu tx-menu"
                                         unselectable="on"></div>
                                </li>
                                <li class="tx-list">
                                    <div id="tx_cellslinestyle" unselectable="on" class="tx-btn-bg tx-cellslinestyle">
                                        <a href="javascript:;" class="tx-icon2" title="스타일">스타일</a>
                                    </div>
                                    <div id="tx_cellslinestyle_menu" class="tx-cellslinestyle-menu tx-menu" unselectable="on"></div>
                                </li>
                                <li class="tx-list">
                                    <div id="tx_cellsoutline" unselectable="on" class="tx-btn-rbg tx-cellsoutline">
                                        <a href="javascript:;" class="tx-icon2" title="테두리">테두리</a>

                                    </div>
                                    <div id="tx_cellsoutline_menu" class="tx-cellsoutline-menu tx-menu" unselectable="on"></div>
                                </li>
                            </ul>
                            <ul class="tx-bar tx-bar-left">
                                <li class="tx-list">
                                    <div id="tx_tablebackcolor" unselectable="on" class="tx-btn-lrbg tx-tablebackcolor"
                                         style="background-color:#9aa5ea;">
                                        <a href="javascript:;" class="tx-icon2" title="테이블 배경색">테이블 배경색</a>
                                    </div>
                                    <div id="tx_tablebackcolor_menu" class="tx-tablebackcolor-menu tx-menu tx-colorpallete"
                                         unselectable="on"></div>
                                </li>
                            </ul>
                            <ul class="tx-bar tx-bar-left">
                                <li class="tx-list">
                                    <div id="tx_tabletemplate" unselectable="on" class="tx-btn-lrbg tx-tabletemplate">
                                        <a href="javascript:;" class="tx-icon2" title="테이블 서식">테이블 서식</a>
                                    </div>
                                    <div id="tx_tabletemplate_menu" class="tx-tabletemplate-menu tx-menu tx-colorpallete"
                                         unselectable="on"></div>
                                </li>
                            </ul>

                        </div></div>
                    <!-- 툴바 - 더보기 끝 -->
                    <!-- 편집영역 시작 -->
                    <!-- 에디터 Start -->
                    <div id="tx_canvas" class="tx-canvas">
                        <div id="tx_loading" class="tx-loading"><div><img src="./daumeditor/images/icon/editor/loading2.png" width="113" height="21" align="absmiddle"/></div></div>
                        <div id="tx_canvas_wysiwyg_holder" class="tx-holder" style="display:block;">
                            <iframe id="tx_canvas_wysiwyg" name="tx_canvas_wysiwyg" allowtransparency="true" frameborder="0">

                            </iframe>
                        </div>
                        <div class="tx-source-deco">
                            <div id="tx_canvas_source_holder" class="tx-holder">
                                <textarea id="tx_canvas_source" rows="30" cols="30"></textarea>
                            </div>
                        </div>
                        <div id="tx_canvas_text_holder" class="tx-holder">
                            <textarea id="tx_canvas_text" rows="30" cols="30"></textarea>
                        </div>
                    </div>
                    <!-- 높이조절 Start -->
                    <div id="tx_resizer" class="tx-resize-bar">
                        <div class="tx-resize-bar-bg"></div>
                        <img id="tx_resize_holder" src="./daumeditor/images/icon/editor/skin/01/btn_drag01.gif" width="58" height="12" unselectable="on" alt="" />
                    </div>
                    <!-- 편집영역 끝 -->
                    <!-- 첨부박스 시작 -->
                    <!-- 파일첨부박스 Start -->
                    <div id="tx_attach_div" class="tx-attach-div">
                        <div id="tx_attach_txt" class="tx-attach-txt">파일 첨부</div>
                        <div id="tx_attach_box" class="tx-attach-box">
                            <div class="tx-attach-box-inner">
                                <div id="tx_attach_preview" class="tx-attach-preview"><p></p><img src="./daumeditor/images/icon/editor/pn_preview.gif" width="147" height="108" unselectable="on"/></div>
                                <div class="tx-attach-main">
                                    <div id="tx_upload_progress" class="tx-upload-progress"><div>0%</div><p>파일을 업로드하는 중입니다.</p></div>
                                    <ul class="tx-attach-top">
                                        <li id="tx_attach_delete" class="tx-attach-delete"><a>전체삭제</a></li>
                                        <li id="tx_attach_size" class="tx-attach-size">
                                            파일: <span id="tx_attach_up_size" class="tx-attach-size-up"></span>/<span id="tx_attach_max_size"></span>
                                        </li>
                                        <li id="tx_attach_tools" class="tx-attach-tools">
                                        </li>
                                    </ul>
                                    <ul id="tx_attach_list" class="tx-attach-list"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 첨부박스 끝 -->
                </div>
                <!-- 에디터 컨테이너 끝 -->
<!--                    <div align="right"><input type="button" value="등록" onClick="saveContent();"/></div>-->
                </div>
                <div class="box-btn t-r">
                    <a href="/lecture_board/index.php?mode=list" class="btn-m-gray">목록</a>
                    <?php
                    if ($_GET['f_gubun'] != "modify") {
                    ?>
                        <a href="javascript:void(0);" class="btn-m ml5" onClick="saveContent();">저장</a>
                    <?php
                    } else {
                    ?>
                        <a href="javascript:void(0);" class="btn-m ml5" onClick="editContent();">수정</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </form>
        </div>
    </div>
    <?php include '../include/footer.php'; ?>
</div>
<script type="text/javascript">
    var config = {
        txHost: '', /* 런타임 시 리소스들을 로딩할 때 필요한 부분으로, 경로가 변경되면 이 부분 수정이 필요. ex) http://xxx.xxx.com */
        txPath: '', /* 런타임 시 리소스들을 로딩할 때 필요한 부분으로, 경로가 변경되면 이 부분 수정이 필요. ex) /xxx/xxx/ */
        txService: 'sample', /* 수정필요없음. */
        txProject: 'sample', /* 수정필요없음. 프로젝트가 여러개일 경우만 수정한다. */
        initializedId: "", /* 대부분의 경우에 빈문자열 */
        wrapper: "tx_trex_container", /* 에디터를 둘러싸고 있는 레이어 이름(에디터 컨테이너) */
        form: 'tx_editor_form'+"", /* 등록하기 위한 Form 이름 */
        txIconPath: "./daumeditor/images/icon/editor/", /*에디터에 사용되는 이미지 디렉터리, 필요에 따라 수정한다. */
        txDecoPath: "./daumeditor/images/deco/contents/", /*본문에 사용되는 이미지 디렉터리, 서비스에서 사용할 때는 완성된 컨텐츠로 배포되기 위해 절대경로로 수정한다. */
        canvas: {
            exitEditor:{
                /*
                desc:'빠져 나오시려면 shift+b를 누르세요.',
                hotKey: {
                    shiftKey:true,
                    keyCode:66
                },
                nextElement: document.getElementsByTagName('button')[0]
                */
            },
            styles: {
                color: "#123456", /* 기본 글자색 */
                fontFamily: "굴림", /* 기본 글자체 */
                fontSize: "10pt", /* 기본 글자크기 */
                backgroundColor: "#fff", /*기본 배경색 */
                lineHeight: "1.5", /*기본 줄간격 */
                padding: "8px" /* 위지윅 영역의 여백 */
            },
            showGuideArea: false
        },
        events: {
            preventUnload: false
        },
        sidebar: {
            attachbox: {
                show: true,
                confirmForDeleteAll: true
            },
            attacher: {
                file: {
                    boxonly: true,
                    features:{
                        width:450, height:180
                    }
                }
            }
        },
        size: {
            contentWidth: 700 /* 지정된 본문영역의 넓이가 있을 경우에 설정 */
        }
    };

    EditorJSLoader.ready(function(Editor) {
        var editor = new Editor(config);
    });

</script>

<!-- Sample: Saving Contents -->
<script type="text/javascript">
    /* 예제용 함수 */
    // function saveContent() {
    // 	Editor.save(); // 이 함수를 호출하여 글을 등록하면 된다.
    // }

    /**
     * Editor.save()를 호출한 경우 데이터가 유효한지 검사하기 위해 부르는 콜백함수로
     * 상황에 맞게 수정하여 사용한다.
     * 모든 데이터가 유효할 경우에 true를 리턴한다.
     * @function
     * @param {Object} editor - 에디터에서 넘겨주는 editor 객체
     * @returns {Boolean} 모든 데이터가 유효할 경우에 true
     */
    function validForm(editor) {
        // Place your validation logic here

        // sample : validate that content exists
        var validator = new Trex.Validator();
        var content = editor.getContent();
        if (!validator.exists(content)) {
            alert('내용을 입력하세요');
            return false;
        }

        return true;
    }

    /**
     * Editor.save()를 호출한 경우 validForm callback 이 수행된 이후
     * 실제 form submit을 위해 form 필드를 생성, 변경하기 위해 부르는 콜백함수로
     * 각자 상황에 맞게 적절히 응용하여 사용한다.
     * @function
     * @param {Object} editor - 에디터에서 넘겨주는 editor 객체
     * @returns {Boolean} 정상적인 경우에 true
     */
    function setForm(editor) {
        var i, input;
        var form = editor.getForm();
        var content = editor.getContent();

        var files = editor.getAttachments('file', true);

        if (files.length != 1) {
            alert("첨부파일은 1개만 업로드 가능합니다.");
            return false;
        }

        // 본문 내용을 필드를 생성하여 값을 할당하는 부분
        var textarea = document.createElement('textarea');
        textarea.name = 'content';
        textarea.value = content;
        form.createField(textarea);


        /* 아래의 코드는 첨부된 데이터를 필드를 생성하여 값을 할당하는 부분으로 상황에 맞게 수정하여 사용한다.
         첨부된 데이터 중에 주어진 종류(image,file..)에 해당하는 것만 배열로 넘겨준다. */
        var images = editor.getAttachments('image');
        for (i = 0; i < images.length; i++) {
            // existStage는 현재 본문에 존재하는지 여부
            if (images[i].existStage) {
                // data는 팝업에서 execAttach 등을 통해 넘긴 데이터
                // alert('attachment information - image[' + i + '] \r\n' + JSON.stringify(images[i].data));
                input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'attach_image';
                input.value = images[i].data.imageurl;  // 예에서는 이미지경로만 받아서 사용
                form.createField(input);
            }
        }



        for (i = 0; i < files.length; i++) {
            input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'attach_file';
            input.value = files[i].data.attachurl;
            form.createField(input);
        }
        return true;
    }
</script>
</body>
</html>
