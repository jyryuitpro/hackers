
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
    function formSubmit(f) {
        // 업로드 할 수 있는 파일 확장자를 제한합니다.
        var extArray = new Array('hwp','xls','doc','xlsx','docx','pdf','jpg','gif','png','txt','ppt','pptx');
        var path = document.getElementById("upfile").value;

        if(path == "") {
            alert("파일을 선택해 주세요.");
            return false;
        }

        var pos = path.indexOf(".");

        if(pos < 0) {
            alert("확장자가 없는파일 입니다.");
            return false;
        }

        var ext = path.slice(path.indexOf(".") + 1).toLowerCase();
        var checkExt = false;

        for(var i = 0; i < extArray.length; i++) {
            if(ext == extArray[i]) {
                checkExt = true;
                break;
            }
        }

        if(checkExt == false) {
            alert("업로드 할 수 없는 파일 확장자 입니다.");
            return false;
        }

        return true;
    }

    function upfile() {
        $("#upfile").click();
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
        <ul class="nav-left-lst">
            <li class="on"><a href="#">전체</a></li>
            <li><a href="#">어학 및 자격증</a></li>
            <li><a href="#">공통역량</a></li>
            <li><a href="#">일반직무</a></li>
            <li><a href="#">산업직무</a></li>
            <li><a href="#">수강후기</a></li>
        </ul>
    </div>

    <div id="content" class="content">
        <div class="tit-box-h3">
            <h3 class="tit-h3">관리자</h3>
            <div class="sub-depth">
                <span><i class="icon-home"><span>홈</span></i></span>
                <span>관리자</span>
                <strong>전체</strong>
            </div>
        </div>

        <ul class="tab-list tab5" style="display: table">
            <li class="on" style="width:129px;"><a href="#">전체</a></li>
            <li style="width:129px;"><a href="#">어학 및 자격증</a></li>
            <li style="width:129px;"><a href="#">공통역량</a></li>
            <li style="width:129px;"><a href="#">일반직무</a></li>
            <li style="width:129px;"><a href="#">산업직무</a></li>
            <li style="width:129px;"><a href="#">수강후기</a></li>
        </ul>



		<p class="mb15"><strong class="tc-brand fs16">강의 등록 정보</strong></p>
        <form name="uploadForm" id="uploadForm" method="post" action="/admin/upload_thumbnail.php" enctype="multipart/form-data" onsubmit="return formSubmit(this);">
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
                        <select class="input-sel" style="width:160px">
                            <option value="">선택</option>
                            <option value="">어학 및 자격증</option>
                            <option value="">공통역량</option>
                            <option value="">일반직무</option>
                            <option value="">산업직무</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="col">강의명</th>
                    <td><input type="text" class="input-text" style="width:580px"/></td>
                </tr>
                <tr>
                    <th scope="col">강사</th>
                    <td><input type="text" class="input-text" style="width:580px"/></td>
                </tr>
                <tr>
                    <th scope="col">학습시간</th>
                    <td><input type="text" class="input-text" style="width:580px"/> 시간</td>
                </tr>
                <tr>
                    <th scope="col">강의수</th>
                    <td><input type="text" class="input-text" style="width:580px"/> 강</td>
                </tr>
                <tr>
                    <th scope="col">학습난이도</th>
                    <td>
                        <ul class="list-rating-choice">
                            <li>
                                <label class="input-sp ico">
                                    <input type="radio" name="radio" id="" checked="checked"/>
                                    <span class="input-txt">만점</span>
                                </label>
                                <span class="star-rating">
                                        <span class="star-inner" style="width:100%"></span>
                                    </span>
                            </li>
                            <li>
                                <label class="input-sp ico">
                                    <input type="radio" name="radio" id=""/>
                                    <span class="input-txt">만점</span>
                                </label>
                                <span class="star-rating">
                                        <span class="star-inner" style="width:80%"></span>
                                    </span>
                            </li>
                            <li>
                                <label class="input-sp ico">
                                    <input type="radio" name="radio" id=""/>
                                    <span class="input-txt">만점</span>
                                </label>
                                <span class="star-rating">
                                        <span class="star-inner" style="width:60%"></span>
                                    </span>
                            </li>
                            <li>
                                <label class="input-sp ico">
                                    <input type="radio" name="radio" id=""/>
                                    <span class="input-txt">만점</span>
                                </label>
                                <span class="star-rating">
                                        <span class="star-inner" style="width:40%"></span>
                                    </span>
                            </li>
                            <li>
                                <label class="input-sp ico">
                                    <input type="radio" name="radio" id=""/>
                                    <span class="input-txt">만점</span>
                                </label>
                                <span class="star-rating">
                                        <span class="star-inner" style="width:20%"></span>
                                    </span>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th scope="col">
                        썸네일
                    </th>
                    <td>
                        <a href="#" class="sample-lecture">
                            <img src="/admin/thumbnail/f86a46018c2c5633727b604663df4aa6.jpg" alt="" width="144" height="101" />
                            <input type="file" name="upfile" id="upfile" style="display: none"/>
                            <span href="#" class="tc-brand" onclick="upfile();">썸네일 업로드</span>
                        </a>

                    </td>
                </tr>
                </tbody>
            </table>
        </form>
		<div class="box-btn t-r">
			<a href="#" class="btn-m-gray">목록</a>
			<a href="#" class="btn-m ml5">등록</a>
			<a href="#" class="btn-m ml5">수정</a>
			<a href="#" class="btn-m-dark">삭제</a>
		</div>
	</div>
</div>
    <?php include '../include/footer.php'; ?>
</div>
</body>
</html>
