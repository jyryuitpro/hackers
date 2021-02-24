<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

session_start();
$f_id = $_SESSION['f_id'];

$sql = "SELECT * FROM MEMBER WHERE F_ID='$f_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

//var_dump($row);

// array(14) {
// ["F_NUM"]=> string(1) "1"
// ["F_NAME"]=> string(9) "류지영" -- 이름
// ["F_ID"]=> string(12) "jyryujiyoung" -- 아이디
// ["F_PASSWORD"]=> string(44) "ickxvlUf3OS5dndtY1SOl5H5j0Xp/VMRqVYu9AIsI2s=" -- 비밀번호
// ["F_EMAIL"]=> string(24) "jy.ryu.jiyoung@gmail.com" -- 이메일
// ["F_MOBILE"]=> string(11) "01093789025" -- 휴대폰번호
// ["F_TEL"]=> string(10) "0312613227" -- 일반번호
// ["F_ZIPCODE"]=> string(5) "16873" -- 우편번호
// ["F_ADDRESS"]=> string(67) "경기 용인시 수지구 대지로 64 (도담마을 롯데캐슬)" -- 주소1
// ["F_ADDRESS_DETAIL"]=> string(14) "304동 1001호" -- 주소2
// ["F_MOBILE_AGREE"]=> string(1) "Y" -- SMS수신
// ["F_EMAIL_AGREE"]=> string(1) "Y" -- 이메일수신
// ["F_BIRTHDAY"]=> string(8) "19891107" -- 생년월일
// ["F_AUTHORITY"]=> string(1) "0" -- 권한
// }

// 이메일
$f_email = explode('@', $row['F_EMAIL']);
$f_email_0 = $f_email[0];
$f_email_1 = $f_email[1];

// 생년월일
$f_year = substr($row['F_BIRTHDAY'], 0, 4);
$f_month = substr($row['F_BIRTHDAY'], 4, 2);
$f_day = substr($row['F_BIRTHDAY'], 6);

// 휴대폰번호
$f_mobile = $row['F_MOBILE'];
$f_mobile_0 = preg_replace("/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/","$1", $row['F_MOBILE']);
$f_mobile_1 = preg_replace("/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/","$2", $row['F_MOBILE']);
$f_mobile_2 = preg_replace("/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/","$3", $row['F_MOBILE']);

// 일반번호
$f_tel_0 = preg_replace("/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/","$1", $row['F_TEL']);
$f_tel_1 = preg_replace("/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/","$2", $row['F_TEL']);
$f_tel_2 = preg_replace("/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/","$3", $row['F_TEL']);

?>
<?php include '../include/header.php'; ?>
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

    function modify_submit() {
        // 이름 유효성 검사
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

        // 아이디 유효성 검사
        if ($("#f_id_new").val() == "") {
            alert("아이디를 입력해주세요.");
            $("#f_id_new").focus();
            return false;
        }

        if ($("#f_id_old").val() != $("#f_id_new").val()) {
            alert("아이디 중복체크를 해주세요.");
            return false;
        }

        // 비밀번호 유효성 검사
        if ($("#f_password_0").val() != "") {
            var passwordCheck = /^[a-zA-Z0-9]{8,15}$/;
            if(!passwordCheck.test($('#f_password_0').val())){
                alert("비밀번호는 8-15자의 영문자/숫자 혼합만 가능합니다.");
                return false;
            }
        }

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

        // 상세주소 유효성 검사
        if ($("#f_zipcode").val() == "" || $("#f_address").val() == "" || $("#f_address_detail").val() == "") {
            alert("상세주소를 입력해주세요.");
            $("#f_address_detail").focus();
            return false;
        }

        $("#f_mobile").val($("#f_mobile_0").val() + $("#f_mobile_1").val() + $("#f_mobile_2").val());
        $("#f_tel").val($("#f_tel_0").val() + $("#f_tel_1").val() + $("#f_tel_2").val());

        modify.submit();
    }
</script>
<div id="container" class="container-full">
	<div id="content" class="content">
		<div class="inner">
			<div class="tit-box-h3">
				<h3 class="tit-h3">내정보수정</h3>
				<div class="sub-depth">
					<span><i class="icon-home"><span>홈</span></i></span>
					<strong>내정보수정</strong>
				</div>
			</div>

            <div class="section-content">
                <form name="modify" id="modify" method="post" action="/member/modify.php">
                    <table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
                        <caption class="hidden">강의정보</caption>
                        <colgroup>
                            <col style="width:15%"/>
                            <col style="*"/>
                        </colgroup>

                        <tbody>
                        <tr>
                            <th scope="col"><span class="icons">*</span>이름</th>
                            <td><?php echo $row['F_NAME']; ?></td>
                        </tr>
                        <tr>
                            <th scope="col"><span class="icons">*</span>아이디</th>
                            <td>
                                <input type="hidden" class="input-text" style="width:302px" name="f_id_old" id="f_id_old" value="<?php echo $row['F_ID']; ?>"/>
                                <input type="text" class="input-text" style="width:302px" name="f_id_new" id="f_id_new" value="<?php echo $row['F_ID']; ?>" placeholder="영문자로 시작하는 4~15자의 영문소문자, 숫자"/>
                                <a href="javascript:void(0);" onclick="idDuplicationCheck();" class="btn-s-tin ml10">중복확인</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col"><span class="icons">*</span>비밀번호</th>
                            <td><input type="password" class="input-text password" style="width:302px" name="f_password_0" id="f_password_0" placeholder="8-15자의 영문자/숫자 혼합"/> 비밀번호를 변경하실 경우만 새로 입력해주세요.</td>
                        </tr>
                        <tr>
                            <th scope="col"><span class="icons">*</span>비밀번호 확인</th>
                            <td><input type="password" class="input-text password" style="width:302px" name="f_password_1" id="f_password_1"/><p id="password_match">* 비밀번호가 일치하지 않습니다.</p></td>
                        </tr>
                        <tr>
                            <th scope="col"><span class="icons">*</span>이메일주소</th>
                            <td>
                                <input type="hidden" class="input-text" style="width:302px" name="f_email" id="f_email"/>
                                <input type="text" class="input-text" style="width:138px" name="f_email_0" id="f_email_0" value="<?php echo $f_email_0 ?>"/> @ <input type="text" class="input-text" style="width:138px" name="f_email_1" id="f_email_1" value="<?php echo $f_email_1 ?>"/>
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
                                <input type="hidden" class="input-text" style="width:50px" name="f_mobile" id="f_mobile" value="<?php echo $f_mobile ?>" readonly />
                                <input type="text" class="input-text" style="width:50px" name="f_mobile_0" id="f_mobile_0" value="<?php echo $f_mobile_0 ?>" readonly /> -
                                <input type="text" class="input-text" style="width:50px" name="f_mobile_1" id="f_mobile_1" value="<?php echo $f_mobile_1 ?>" readonly /> -
                                <input type="text" class="input-text" style="width:50px" name="f_mobile_2" id="f_mobile_2" value="<?php echo $f_mobile_2 ?>" readonly />
                            </td>
                        </tr>
                        <tr>
                            <th scope="col"><span class="icons"></span>일반전화 번호</th>
                            <td>
                                <input type="hidden" class="input-text" style="width:88px" name="f_tel" id="f_tel" />
                                <input type="text" class="input-text" style="width:88px" name="f_tel_0" id="f_tel_0" value="<?php echo $f_tel_0 ?>" /> -
                                <input type="text" class="input-text" style="width:88px" name="f_tel_1" id="f_tel_1" value="<?php echo $f_tel_1 ?>" /> -
                                <input type="text" class="input-text" style="width:88px" name="f_tel_2" id="f_tel_2" value="<?php echo $f_tel_2 ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="col"><span class="icons">*</span>주소</th>
                            <td>
                                <p >
                                    <label>우편번호 <input type="text" class="input-text ml5" style="width:242px" name="f_zipcode" id="f_zipcode" value="<?php echo $row['F_ZIPCODE']; ?>" readonly /></label><a href="#" onclick="open_zipcode_popup();" class="btn-s-tin ml10">주소찾기</a>
                                </p>
                                <p class="mt10">
                                    <label>기본주소 <input type="text" class="input-text ml5" style="width:719px" name="f_address" id="f_address" value="<?php echo $row['F_ADDRESS']; ?>" readonly /></label>
                                </p>
                                <p class="mt10">
                                    <label>상세주소 <input type="text" class="input-text ml5" style="width:719px" name="f_address_detail" id="f_address_detail" value="<?php echo $row['F_ADDRESS_DETAIL']; ?>"/></label>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col"><span class="icons">*</span>SMS수신</th>
                            <td>
                                <div class="box-input">
                                    <label class="input-sp">
                                        <input type="radio" name="radio" value="Y" id="f_mobile_agree_y" <?php if ($row['F_MOBILE_AGREE'] == 'Y') echo "checked"?>/>
                                        <span class="input-txt">수신함</span>
                                    </label>
                                    <label class="input-sp">
                                        <input type="radio" name="radio" value="N" id="f_mobile_agree_n" <?php if ($row['F_MOBILE_AGREE'] == 'N') echo "checked"?>/>
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
                                        <input type="radio" name="radio2" id="f_email_agree_y" value="Y" <?php if ($row['F_EMAIL_AGREE'] == 'Y') echo "checked"?>/>
                                        <span class="input-txt">수신함</span>
                                    </label>
                                    <label class="input-sp">
                                        <input type="radio" name="radio2" id="f_email_agree_n" value="N" <?php if ($row['F_EMAIL_AGREE'] == 'N') echo "checked"?>/>
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
                    <a href="javascript:void(0);" class="btn-l" onclick="modify_submit();">정보수정</a>
                    <a href="http://test.hackers.com/" class="btn-l" >메인 페이지</a>
                </div>
			</div>
		</div>
	</div>
</div>
    <?php include '../include/footer.php'; ?>
</div>
</body>
</html>
