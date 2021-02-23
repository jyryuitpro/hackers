<?php
session_start();
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
            setDateBox();
            $(".f_moblie").keyup (function () {
                var charLimit = $(this).attr("maxlength");
                if (this.value.length >= charLimit) {
                    $(this).next('.f_moblie').focus();
                    return false;
                }
            });

            $('#email_sel').change(function(){
                $("#email_sel option:selected").each(function () {
                    if($(this).val()== '1'){ //직접입력일 경우
                        $("#f_email_1").val('');                        //값 초기화
                        $("#f_email_1").attr("disabled",false); //활성화
                    }else{ //직접입력이 아닐경우
                        $("#f_email_1").val($(this).text());      //선택값 입력
                        $("#f_email_1").attr("disabled",true); //비활성화
                    }
                });
            });

            $('#E').attr('style', "display:none;");
            $('input[type=radio]').change(function() {
                if (this.value == 'M') {
                    $('#M').attr('style', "display:'';");
                    $('#E').attr('style', "display:none;");
                    $("#verification_number_button").attr("onclick", "confirm_verification_number('M');");
                }
                else if (this.value == 'E') {
                    $('#E').attr('style', "display:'';");
                    $('#M').attr('style', "display:none;");
                    $("#verification_number_button").attr("onclick", "confirm_verification_number('E');");
                }
            });

            $('.birthday_sel').change(function () {
                const f_year = document.getElementById('f_year').value;
                const f_month = document.getElementById('f_month').value;
                const f_day = document.getElementById('f_day').value;

                document.getElementById('f_birthday').value = f_year + f_month + f_day;
            });
        });

        function get_verification_number(f_gubun) {
            if (f_gubun == 'M') {
                const f_name = document.getElementById('f_name').value;
                const f_birthday = document.getElementById('f_birthday').value;
                const f_mobile_0 = document.getElementById('f_mobile_0').value;
                const f_mobile_1 = document.getElementById('f_mobile_1').value;
                const f_mobile_2 = document.getElementById('f_mobile_2').value;


                if (!f_name) {
                    alert("이름을 입력해주세요.");
                    return false;
                } else if (!f_mobile_0 || !f_mobile_1 || !f_mobile_2) {
                    alert("휴대폰 번호를 입력해주세요.");
                    return false;
                } else if (f_birthday.length != 8) {
                    alert("생년월일을 확인해주세요.");
                    return false;
                }

                document.getElementById("f_mobile").value = f_mobile_0 + f_mobile_1 + f_mobile_2;

                document.getElementById("verification_number").value = 123456;

                alert("인증번호가 전송되었습니다.");
            } else {
                const f_name = document.getElementById('f_name').value;
                const f_birthday = document.getElementById('f_birthday').value;

                if (!f_name) {
                    alert("이름을 입력해주세요.");
                    return false;
                }

                if ($("#f_email_0").val() != "" && $("#f_email_1").val() != "") {
                    $("#f_email").val($("#f_email_0").val() + '@' + $("#f_email_1").val());
                    var emailCheck = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

                    if(!emailCheck.test($("#f_email").val())) {
                        alert("이메일 주소가 유효하지 않습니다");
                        $("#f_email_0").focus();
                        return false;
                    }
                } else {
                    alert("이메일 주소를 입력해주세요.");
                    return false;
                }

                if (f_birthday.length != 8) {
                    alert("생년월일을 확인해주세요.");
                    return false;
                }

                document.getElementById("verification_number").value = 123456;

                alert("인증번호가 전송되었습니다.");
            }
        }

        function confirm_verification_number(f_gubun) {
            if (f_gubun == 'M') {
                const verification_number = document.getElementById("verification_number").value;
                const f_name = document.getElementById('f_name').value;
                const f_birthday = document.getElementById('f_birthday').value;
                const f_mobile = document.getElementById("f_mobile").value
                $.ajax({
                    url: "/member/certification.php",
                    dataType: "json",
                    data: {'verification_number': verification_number, 'f_mobile': f_mobile, 'f_gubun': f_gubun, 'f_name': f_name, 'f_birthday': f_birthday},
                    type: "POST",
                    success:function(data){
                        if (data.res == "success") {
                            alert("인증번호가 확인되었습니다.");
                            window.location.href='/member/index.php?mode=find_pass_completed';
                        } else {
                            alert("등록된 가입정보가 없습니다.");
                        }
                    },
                    error:function () {

                    },
                });
            } else {
                const verification_number = document.getElementById("verification_number").value;
                const f_name = document.getElementById('f_name').value;
                const f_birthday = document.getElementById('f_birthday').value;
                const f_email = document.getElementById("f_email").value
                $.ajax({
                    url: "/member/certification.php",
                    dataType: "json",
                    data: {'verification_number': verification_number, 'f_email': f_email, 'f_gubun': f_gubun, 'f_name': f_name, 'f_birthday': f_birthday},
                    type: "POST",
                    success:function(data){
                        if (data.res == "success") {
                            alert("인증번호가 확인되었습니다.");
                            window.location.href='/member/index.php?mode=find_pass_completed';
                        } else {
                            alert("등록된 가입정보가 없습니다.");
                        }
                    },
                    error:function () {

                    },
                });
            }
        }

        function setDateBox(){
            var dt = new Date();
            var year = "";
            var com_year = dt.getFullYear();
            // 발행 뿌려주기
            $("#f_year").append("<option value=''>선택</option>");
            // 올해 기준으로 -1년부터 +5년을 보여준다.
            for(var y = 1950; y <= com_year; y++){
                $("#f_year").append("<option value='"+ y +"'>"+ y +"</option>");
            }
            // 월 뿌려주기
            var month;
            $("#f_month").append("<option value=''>선택</option>");
            for(var m = 1; m <= 12; m++){
                if (m < 10) {
                    $("#f_month").append("<option value='0"+ m +"'>"+ "0" + m +"</option>");
                } else {
                    $("#f_month").append("<option value='"+ m +"'>"+ m +"</option>");
                }
            }
            // 일 뿌려주기
            var day;
            $("#f_day").append("<option value=''>선택</option>");
            for(var d = 1; d <= 31; d++){
                if (d < 10) {
                    $("#f_day").append("<option value='0"+ d +"'>"+ "0" + d +"</option>");
                } else {
                    $("#f_day").append("<option value='"+ d +"'>"+ d +"</option>");
                }
            }
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
				<h3 class="tit-h3">아이디/비밀번호 찾기</h3>
				<div class="sub-depth">
					<span><i class="icon-home"><span>홈</span></i></span>
					<strong>아이디/비밀번호 찾기</strong>
				</div>
			</div>

			<ul class="tab-list">
				<li><a href="/member/index.php?mode=find_id">아이디 찾기</a></li>
				<li class="on"><a href="/member/index.php?mode=find_pass">비밀번호 찾기</a></li>
			</ul>

			<div class="tit-box-h4">
				<h3 class="tit-h4">비밀번호 찾기 방법 선택</h3>
			</div>

            <dl class="find-box">
                <dt>휴대폰 인증</dt>
                <dd>
                    고객님이 회원 가입 시 등록한 휴대폰 번호와 입력하신 휴대폰 번호가 동일해야 합니다.
                    <label class="input-sp big">
                        <input type="radio" name="radio" value="M" checked="checked"/>
                        <span class="input-txt"></span>
                    </label>
                </dd>
            </dl>

            <dl class="find-box">
                <dt>이메일 인증</dt>
                <dd>
                    고객님이 회원 가입 시 등록한 이메일 주소와 입력하신 이메일 주소가 동일해야 합니다.
                    <label class="input-sp big">
                        <input type="radio" name="radio" value="E"/>
                        <span class="input-txt"></span>
                    </label>
                </dd>
            </dl>

            <div class="section-content mt30">
                <table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
                    <caption class="hidden">아이디 찾기 개인정보 입력</caption>
                    <colgroup>
                        <col style="width:15%"/>
                        <col style="*"/>
                    </colgroup>

                    <tbody>
                    <tr>
                        <th scope="col">성명</th>
                        <td><input type="text" class="input-text" style="width:302px" name="f_name" id="f_name" /></td>
                    </tr>
                    <tr>
                        <th scope="col">생년월일</th>
                        <td>
                            <input type="hidden" class="input-text" style="width:100px" name="f_birthday" id="f_birthday"/>
                            <select class="input-sel birthday_sel" style="width:100px" name="f_year" id="f_year">
                                <!--									<option value="">선택</option>-->
                            </select>
                            년
                            <select class="input-sel birthday_sel" style="width:100px" name="f_month" id="f_month">
                                <!--									<option value="">선택</option>-->
                            </select>
                            월
                            <select class="input-sel birthday_sel" style="width:100px" name="f_day" id="f_day">
                                <!--									<option value="">선택</option>-->
                            </select>
                            일
                        </td>
                    </tr>
                    <tr id="M">
                        <th scope="col">휴대폰번호</th>
                        <td>
                            <input type="hidden" class="input-text f_moblie" style="width:50px" name="f_mobile" id="f_mobile" value=""  />
                            <input type="text" class="input-text f_moblie" style="width:50px" name="f_mobile_0" id="f_mobile_0" maxlength='3' value=""  /> -
                            <input type="text" class="input-text f_moblie" style="width:50px" name="f_mobile_1" id="f_mobile_1" maxlength='4' value=""  /> -
                            <input type="text" class="input-text f_moblie" style="width:50px" name="f_mobile_2" id="f_mobile_2" maxlength='4' value=""  />
                            <a href="#" class="btn-s-tin ml10" onclick="get_verification_number('M');" name="get_verification_number_m" id="get_verification_number_m">인증번호 받기</a>
                        </td>
                    </tr>
                    <tr id="E">
                        <th scope="col">이메일주소</th>
                        <td>
                            <input type="hidden" class="input-text" style="width:100px" name="f_email" id="f_email"/>
                            <input type="text" class="input-text" style="width:138px" name="f_email_0" id="f_email_0"/> @ <input type="text" class="input-text" style="width:138px" name="f_email_1" id="f_email_1"/>
                            <select class="input-sel email_sel" style="width:160px" name="email_sel" id="email_sel">
                                <option value="1">직접입력</option>
                                <option value="gmail.com">gmail.com</option>
                                <option value="naver.com">naver.com</option>
                                <option value="daum.net">daum.net</option>
                                <option value="hanmail.net">hanmail.net</option>
                                <option value="nate.com">nate.com</option>
                            </select>
                            <a href="#" class="btn-s-tin ml10" onclick="get_verification_number('E');" name="get_verification_number_e" id="get_verification_number_e">인증번호 받기</a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">인증번호</th>
                        <td>
                            <input type="text" class="input-text" style="width:200px" name="verification_number" id="verification_number"/>
                            <a href="#" class="btn-s-tin ml10" name="verification_number_button" id="verification_number_button" onclick="confirm_verification_number('M');">인증번호 확인</a>
                        </td>
                    </tr>
                    </tbody>
                </table>

			</div>
		</div>
	</div>
</div>
    <?php include '../include/footer.php'; ?>
</div>
</body>
</html>
