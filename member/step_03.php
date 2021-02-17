<?php
    session_start();
    $f_mobile = $_SESSION['f_mobile'];
    // 01012345678
    $f_mobile_0 = substr($f_mobile, 0, 3);
    $f_mobile_1 = substr($f_mobile, 3, 4);
    $f_mobile_2 = substr($f_mobile, 7);
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
    });

    function idDuplicationCheck() {
        $("#f_id_old").val($("#f_id_new").val());

        var idCheck = /^[a-z]+[a-z0-9]{3,14}$/g;
        if(!idCheck.test($('#f_id_new').val())){
            alert("아이디는 영문자로 시작하는 4~15자의 영문소문자,숫자만 가능합니다.");
            return false;
        }

        $.ajax({
            url: "/member/duplication_check.php",
            dataType: "json",
            data:'f_id='+$("#f_id_new").val(),
            type: "POST",
            success:function(data){
                alert(data.res);
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
        // 이메일 유효성 검사
        if ($("#f_email_0").val() != "" && $("#f_email_1").val() != "") {
            $("#f_email").val($("#f_email_0").val() + '@' + $("#f_email_1").val());
            var emailCheck = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

            if(!emailCheck.test($("#f_email").val())) {
                alert("이메일 주소가 유효하지 않습니다");
                $("#f_email_0").focus();
                return false;
            }
        }

        $("#f_tel").val($("#f_tel_0").val() + $("#f_tel_1").val() + $("#f_tel_2").val());


        regist.submit();
    }
</script>
</head><body>
<!-- skip nav -->
<div id="skip-nav">
<a href="#content">본문 바로가기</a>
</div>
<!-- //skip nav -->

<div id="wrap">
    <?php include 'header.php'; ?>
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
                                <th scope="col"><span class="icons">*</span>아이디</th>
                                <td><input type="text" class="input-text" style="width:302px" name="f_id_old" id="f_id_old"/><input type="text" class="input-text" style="width:302px" name="f_id_new" id="f_id_new" placeholder="영문자로 시작하는 4~15자의 영문소문자, 숫자"/><a href="javascript:void(0);" onclick="idDuplicationCheck();" class="btn-s-tin ml10">중복확인</a></td>
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
                                    <input type="text" class="input-text" style="width:302px" name="f_email" id="f_email"/>
                                    <input type="text" class="input-text" style="width:138px" name="f_email_0" id="f_email_0"/> @ <input type="text" class="input-text" style="width:138px" name="f_email_1" id="f_email_1"/>
                                    <select class="input-sel email_sel" style="width:160px" name="email_sel" id="email_sel">
                                        <option value="1">직접입력</option>
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
                                    <input type="text" class="input-text" style="width:50px" name="f_mobile" id="f_mobile" value="<?php echo $f_mobile ?>" readonly />
                                    <input type="text" class="input-text" style="width:50px" name="f_mobile_0" id="f_mobile_0" value="<?php echo $f_mobile_0 ?>" readonly /> -
                                    <input type="text" class="input-text" style="width:50px" name="f_mobile_1" id="f_mobile_1" value="<?php echo $f_mobile_1 ?>" readonly /> -
                                    <input type="text" class="input-text" style="width:50px" name="f_mobile_2" id="f_mobile_2" value="<?php echo $f_mobile_2 ?>" readonly />
                                </td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons"></span>일반전화 번호</th>
                                <td><input type="text" class="input-text" style="width:88px" name="f_tel" id="f_tel" /><input type="text" class="input-text" style="width:88px" name="f_tel_0" id="f_tel_0" /> - <input type="text" class="input-text" style="width:88px" name="f_tel_1" id="f_tel_1" /> - <input type="text" class="input-text" style="width:88px" name="f_tel_2" id="f_tel_2" /></td>
                            </tr>
                            <tr>
                                <th scope="col"><span class="icons">*</span>주소</th>
                                <td>
                                    <p >
                                        <label>우편번호 <input type="text" class="input-text ml5" style="width:242px" name="f_zipcode" id="f_zipcode" readonly /></label><a href="#" onclick="open_zipcode_popup();" class="btn-s-tin ml10">주소찾기</a>
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
				</div>
			</div>
		</div>
	</div>
</div>
    <?php include 'footer.php'; ?>
</div>
</body>
</html>
