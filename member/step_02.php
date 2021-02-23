<?php
    session_start();
    // SESSION 에 인증번호 고정[123456] 지정하여 매칭후 본인확인 패스
    $_SESSION['verification_number'] = 123456;
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
    $(document).ready(function(){
        $(".f_moblie").keyup (function () {
            var charLimit = $(this).attr("maxlength");
            if (this.value.length >= charLimit) {
                $(this).next('.f_moblie').focus();
                return false;
            }
        });
    });

    function get_verification_number() {
        const f_mobile_0 = document.getElementById('f_mobile_0').value;
        const f_mobile_1 = document.getElementById('f_mobile_1').value;
        const f_mobile_2 = document.getElementById('f_mobile_2').value;

        if (!f_mobile_0 || !f_mobile_1 || !f_mobile_2) {
            alert("휴대폰 번호를 입력해주세요");
            return false;
        }

        document.getElementById("f_mobile").value = f_mobile_0 + f_mobile_1 + f_mobile_2;
        document.getElementById("verification_number").value = 123456;

        alert("인증번호가 전송되었습니다.");
    }

    // 인증번호 확인
    function confirm_verification_number() {
        const verification_number = document.getElementById("verification_number").value
        const f_mobile = document.getElementById("f_mobile").value

        $.ajax({
            url: "/member/certification.php",
            dataType: "json",
            data: {"verification_number": verification_number, "f_mobile": f_mobile},
            type: "POST",
            success:function(data){
                if (data.res == "success") {
                    alert("인증번호가 확인되었습니다.");
                    window.location.href='/member/index.php?mode=step_03';
                }
            },
            error:function () {

            }
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
<div id="container" class="container-full">
	<div id="content" class="content">
		<div class="inner">
			<div class="tit-box-h3">
				<h3 class="tit-h3">회원가입</h3>
				<div class="sub-depth">
					<span><i class="icon-home"><span>홈</span></i></span>
					<strong>회원가입 완료</strong>
				</div>
			</div>

			<div class="join-step-bar">
				<ul>
					<li><i class="icon-join-agree"></i> 약관동의</li>
					<li class="on"><i class="icon-join-chk"></i> 본인확인</li>
					<li class="last"><i class="icon-join-inp"></i> 정보입력</li>
				</ul>
			</div>

			<div class="tit-box-h4">
				<h3 class="tit-h4">본인인증</h3>
			</div>
			<div class="section-content after">
				<div class="identify-box" style="width:100%;height:190px;">
					<div class="identify-inner">
						<strong>휴대폰 인증</strong>
						<p id="parent">주민번호 없이 메시지 수신가능한 휴대폰으로 1개 아이디만 회원가입이 가능합니다. </p>

						<br />
                        <input type="hidden" class="input-text" style="width:50px" name="f_mobile" id="f_mobile"/>
						<input type="text" class="input-text f_moblie" style="width:50px" name="f_mobile_0" id="f_mobile_0" maxlength='3' /> -
						<input type="text" class="input-text f_moblie" style="width:50px" name="f_mobile_1" id="f_mobile_1" maxlength='4' /> -
						<input type="text" class="input-text f_moblie" style="width:50px" name="f_mobile_2" id="f_mobile_2" maxlength='4' />
						<a href="#" class="btn-s-line" onclick="get_verification_number();" name="get_verification_number" id="get_verification_number">인증번호 받기</a>

						<br /><br />
						<input type="text" class="input-text" style="width:200px" name="verification_number" id="verification_number"/>
						<a href="javascript:void(0);" class="btn-s-line" onclick="confirm_verification_number();">인증번호 확인</a>
					</div>
					<i class="graphic-phon"><span>휴대폰 인증</span></i>
				</div>
			</div>

		</div>
	</div>
</div>
    <?php include '../include/footer.php'; ?>
</div>
</body>
</html>
