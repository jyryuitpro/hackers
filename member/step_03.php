<?php
    session_start();
    $f_mobile = $_SESSION['f_mobile'];
    $f_mobile_0 = preg_replace("/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/","$1", $f_mobile);
    $f_mobile_1 = preg_replace("/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/","$2", $f_mobile);
    $f_mobile_2 = preg_replace("/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/","$3", $f_mobile);
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
<script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        setDateBox();
        $("#password_match").css("color", "red").hide();
        $(".password").focusout(function () {
            const f_password_0 = $("#f_password_0").val();
            const f_password_1 = $("#f_password_1").val();

            if ((f_password_0 != '' && f_password_1 == '')) {
                null;
            } else if (f_password_0 != "" || f_password_1 != "") {
                if (f_password_0 != f_password_1) {
                    $("#password_match").css("color", "red").show();
                } else {
                    $("#password_match").css("color", "red").hide();
                }
            } else {
                $("#password_match").css("color", "red").hide();
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

        $('.birthday_sel').change(function () {
            const f_year = document.getElementById('f_year').value;
            const f_month = document.getElementById('f_month').value;
            const f_day = document.getElementById('f_day').value;

            document.getElementById('f_birthday').value = f_year + f_month + f_day;
        });
    });



    // 아이디 유효성 검사 및 중복체크
    function idDuplicationCheck() {
        var idCheck = /^[a-z]+[a-z0-9]{3,14}$/g;
        if(!idCheck.test($('#f_id_new').val())){
            alert("아이디는 영문자로 시작하는 4~15자의 영문소문자,숫자만 가능합니다.");
            $("#f_id_old").val('');
            return false;
        } else {
            $("#f_id_old").val($("#f_id_new").val());
        }

        $.ajax({
            url: "/member/duplication_check.php",
            dataType: "json",
            data:'f_id='+$("#f_id_new").val(),
            type: "POST",
            success:function(data){
                if (data.res != "duplication") {
                    alert("사용 가능한 아이디입니다");
                } else {
                    alert("이미 사용중인 아이디입니다");
                }
            },
            error:function (){

            },
            complete:function () {

            }
        });
    }

    function open_zipcode_popup() {
        new daum.Postcode({
            oncomplete: function(data) {
                $("#f_zipcode").val(data.zonecode); // 우편번호 (5자리)
                $("#f_address").val(data.address + " (" + data.buildingName + ")");
            }
        }).open();
    }

    function regist_submit() {
        // 이름
        if ($("#f_name").val() == "") {
            alert("이름을 입력해주세요.");
            $("#f_name").focus();
            return false;
        } else {
            var nameCheck = /^[가-힣a-zA-Z]+$/;
            if(!nameCheck.test($('#f_name').val())){
                alert("이름은 한글 영문자만 가능합니다.");
                return false;
            }
        }

        // 생년월일
        if ($("#f_birthday").val().length != 8) {
            alert("생년월일을 입력해주세요.");
            $("#f_birthday").focus();
            return false;
        }

        // 아이디
        if ($("#f_id_new").val() == "") {
            alert("아이디를 입력해주세요.");
            $("#f_id_new").focus();
            return false;
        }

        if ($("#f_id_old").val() != $("#f_id_new").val()) {
            alert("아이디 중복체크를 해주세요.");
            return false;
        }

        // 비밀번호
        if ($("#f_password_0").val() == "" || $("#f_password_1").val() == "") {
            alert("비밀번호를 입력해주세요.");
            return false;
        } else if ($("#f_password_0").val() != "" || $("#f_password_0").val() != "") {
            if ($("#f_password_0").val() != $("#f_password_1").val()) {
                alert("비밀번호가 일치하지 않습니다.");
                return false;
            }
        }

        if ($("#f_password_0").val() != "") {
            var passwordCheck = /^[a-zA-Z0-9]{8,15}$/;
            if(!passwordCheck.test($('#f_password_0').val())){
                alert("비밀번호는 8-15자의 영문자/숫자 혼합만 가능합니다.");
                return false;
            }
        }

        // 이메일
        if ($("#f_email_0").val() == "" || $("#f_email_1").val() == "") {
            alert("이메일 주소를 입력해주세요.");
            return false;
        }

        if ($("#f_email_0").val() != "" && $("#f_email_1").val() != "") {
            $("#f_email").val($("#f_email_0").val() + '@' + $("#f_email_1").val());
            var emailCheck = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

            if(!emailCheck.test($("#f_email").val())) {
                alert("이메일 주소가 유효하지 않습니다.");
                $("#f_email_0").focus();
                return false;
            }
        }

        // 주소
        if ($("#f_zipcode").val() == "" || $("#f_address").val() == "" || $("#f_address_detail").val() == "") {
            alert("주소를 입력해주세요.");
            $("#f_address_detail").focus();
            return false;
        }

        $("#f_tel").val($("#f_tel_0").val() + $("#f_tel_1").val() + $("#f_tel_2").val());

        regist.submit();
    }

    // 생년월일 셀렉트박스 옵션 생성
    function setDateBox(){
        var dt = new Date();
        var year = "";
        var com_year = dt.getFullYear();

        $("#f_year").append("<option value=''>선택</option>");

        for(var y = 1950; y <= com_year; y++){
            $("#f_year").append("<option value='"+ y +"'>"+ y +"</option>");
        }

        var month;
        $("#f_month").append("<option value=''>선택</option>");
        for(var m = 1; m <= 12; m++){
            if (m < 10) {
                $("#f_month").append("<option value='0"+ m +"'>"+ "0" + m +"</option>");
            } else {
                $("#f_month").append("<option value='"+ m +"'>"+ m +"</option>");
            }
        }

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
				<h3 class="tit-h3">회원가입</h3>
				<div class="sub-depth">
					<span><i class="icon-home"><span>홈</span></i></span>
					<strong>회원가입</strong>
				</div>
			</div>

			<div class="join-step-bar">
				<ul>
					<li><i class="icon-join-agree"></i> 약관동의</li>
					<li><i class="icon-join-chk"></i> 본인확인</li>
					<li class="last on"><i class="icon-join-inp"></i> 정보입력</li>
				</ul>
			</div>

			<div class="section-content">
                <form name="regist" id="regist" method="post" action="/member/regist.php">
                    <!-- 회원가입 기본권한 1-->
                    <input type="hidden" class="input-text" style="width:302px" name="f_authority" id="f_authority" value="1"/>
                    <table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
                        <caption class="hidden">강의정보</caption>
                        <colgroup>
                            <col style="width:15%"/>
                            <col style="*"/>
                        </colgroup>

                        <tbody>
                            <tr>
                                <th scope="col"><span class="icons">*</span>이름</th>
                                <td><input type="text" class="input-text" style="width:302px" name="f_name" id="f_name"/></td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>생년월일</th>
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
                            <tr>
                                <th scope="col"><span class="icons">*</span>아이디</th>
                                <td>
                                    <input type="hidden" class="input-text" style="width:302px" name="f_id_old" id="f_id_old"/>
                                    <input type="text" class="input-text" style="width:302px" name="f_id_new" id="f_id_new" placeholder="영문자로 시작하는 4~15자의 영문소문자, 숫자"/>
                                    <a href="javascript:void(0);" onclick="idDuplicationCheck();" class="btn-s-tin ml10">중복확인</a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>비밀번호</th>
                                <td><input type="password" class="input-text password" style="width:302px" name="f_password_0" id="f_password_0" placeholder="8-15자의 영문자/숫자 혼합"/></td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>비밀번호 확인</th>
                                <td><input type="password" class="input-text password" style="width:302px" name="f_password_1" id="f_password_1"/><p id="password_match">* 비밀번호가 일치하지 않습니다.</p></td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>이메일주소</th>
                                <td>
                                    <input type="hidden" class="input-text" style="width:302px" name="f_email" id="f_email"/>
                                    <input type="text" class="input-text" style="width:138px" name="f_email_0" id="f_email_0"/> @ <input type="text" class="input-text" style="width:138px" name="f_email_1" id="f_email_1"/>
                                    <select class="input-sel email_sel" style="width:160px" name="email_sel" id="email_sel">
                                        <option value="1">직접입력</option>
                                        <option value="gmail.com">hackers.com</option>
                                        <option value="gmail.com">gmail.com</option>
                                        <option value="naver.com">naver.com</option>
                                        <option value="daum.net">daum.net</option>
                                        <option value="hanmail.net">hanmail.net</option>
                                        <option value="nate.com">nate.com</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>휴대폰 번호</th>
                                <td>
                                    <input type="hidden" class="input-text" style="width:50px" name="f_mobile" id="f_mobile" value="<?php echo $f_mobile ?>" readonly />
                                    <input type="text" class="input-text" style="width:50px" name="f_mobile_0" id="f_mobile_0" value="<?php echo $f_mobile_0 ?>" readonly /> -
                                    <input type="text" class="input-text" style="width:50px" name="f_mobile_1" id="f_mobile_1" value="<?php echo $f_mobile_1 ?>" readonly /> -
                                    <input type="text" class="input-text" style="width:50px" name="f_mobile_2" id="f_mobile_2" value="<?php echo $f_mobile_2 ?>" readonly />
                                </td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons"></span>일반전화 번호</th>
                                <td><input type="hidden" class="input-text" style="width:88px" name="f_tel" id="f_tel" /><input type="text" class="input-text" style="width:88px" name="f_tel_0" id="f_tel_0" /> - <input type="text" class="input-text" style="width:88px" name="f_tel_1" id="f_tel_1" /> - <input type="text" class="input-text" style="width:88px" name="f_tel_2" id="f_tel_2" /></td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>주소</th>
                                <td>
                                    <p >
                                        <label>우편번호 <input type="text" class="input-text ml5" style="width:242px" name="f_zipcode" id="f_zipcode" readonly /></label><a href="javascript:void(0);" onclick="open_zipcode_popup();" class="btn-s-tin ml10">주소찾기</a>
                                    </p>
                                    <p class="mt10">
                                        <label>기본주소 <input type="text" class="input-text ml5" style="width:719px" name="f_address" id="f_address" readonly /></label>
                                    </p>
                                    <p class="mt10">
                                        <label>상세주소 <input type="text" class="input-text ml5" style="width:719px" name="f_address_detail" id="f_address_detail" /></label>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>SMS수신</th>
                                <td>
                                    <div class="box-input">
                                        <label class="input-sp">
                                            <input type="radio" name="radio" value="Y" id="f_mobile_agree_y" checked="checked"/>
                                            <span class="input-txt">수신함</span>
                                        </label>
                                        <label class="input-sp">
                                            <input type="radio" name="radio" value="N" id="f_mobile_agree_n" />
                                            <span class="input-txt">미수신</span>
                                        </label>
                                    </div>
                                    <p>SMS수신 시, 해커스의 혜택 및 이벤트 정보를 받아보실 수 있습니다.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>메일수신</th>
                                <td>
                                    <div class="box-input">
                                        <label class="input-sp">
                                            <input type="radio" name="radio2" id="f_email_agree_y" value="Y" checked="checked"/>
                                            <span class="input-txt">수신함</span>
                                        </label>
                                        <label class="input-sp">
                                            <input type="radio" name="radio2" id="f_email_agree_n" value="N" />
                                            <span class="input-txt">미수신</span>
                                        </label>
                                    </div>
                                    <p>메일수신 시, 해커스의 혜택 및 이벤트 정보를 받아보실 수 있습니다.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
				<div class="box-btn">
					<a href="javascript:void(0);" class="btn-l" onclick="regist_submit();">회원가입</a>
                    <a href="#" class="btn-l-line ml5">취소</a>
				</div>
			</div>
		</div>
	</div>
</div>
    <?php include '../include/footer.php'; ?>
</div>
</body>
</html>
