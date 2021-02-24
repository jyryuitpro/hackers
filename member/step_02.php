<?php
    session_start();
    // SESSION 에 인증번호 고정[123456] 지정하여 매칭후 본인확인 패스
    $_SESSION['verification_number'] = 123456;
?>
<?php include '../include/header.php'; ?>
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

