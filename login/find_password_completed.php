<?php
session_start();
//var_dump($_SESSION['find_name']);
//var_dump($_SESSION['find_id']);
?>
<?php include '../include/header.php'; ?>
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
    });
    function edit_password() {
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

        const f_password = document.getElementById("f_password_0").value

        $.ajax({
            url: "/login/modify_password.php",
            dataType: "json",
            data: 'f_password='+f_password,
            type: "POST",
            success:function(data){
                if (data.res == "success") {
                    alert("비밀번호가 재설정되었습니다. 메인 페이지로 이동합니다.");
                    window.location.href='../index.php';
                }
            },
            error:function () {

            },
        });
    }
</script>
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
				<h3 class="tit-h4">비밀번호 재설정</h3>
			</div>

			<div class="section-content mt30">
                <table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
                    <caption class="hidden">비밀번호 재설정</caption>
                    <colgroup>
                        <col style="width:17%"/>
                        <col style="*"/>
                    </colgroup>

                    <tbody>
                        <tr>
                            <th scope="col">신규 비밀번호 입력</th>
                            <td><input type="password" class="input-text password" name="f_password_0" id="f_password_0" placeholder="8-15자의 영문자/숫자 혼합" style="width:302px" /></td>
                        </tr>
                        <tr>
                            <th scope="col">신규 비밀번호 재확인</th>
                            <td><input type="password" class="input-text password" style="width:302px" name="f_password_1" id="f_password_1" /><p id="password_match">* 비밀번호가 일치하지 않습니다.</p></td>
                        </tr>
                    </tbody>
                </table>
				<div class="box-btn">
                    <a href="#" class="btn-l" onclick="edit_password();">확인</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include '../include/footer.php'; ?>
