<?php

// 약관동의
if ($_GET['mode'] == "step_01") {
    Header("Location: /member/step_01.php");
}
// 본인확인
if ($_GET['mode'] == "step_02") {
    Header("Location: /member/step_02.php");
}
// 정보입력
if ($_GET['mode'] == "step_03") {
    Header("Location: /member/step_03.php");
}
// 정보입력 완료 후, 회원가입
if ($_GET['mode'] == "regist") {
    Header("Location: /member/regist.php");
}
// 회원가입 완료
if ($_GET['mode'] == "complete") {
    Header("Location: /member/step_04.php");
}
// 로그인
if ($_GET['mode'] == "login") {
    Header("Location: /member/login.php");
}
// 로그아웃
if ($_GET['mode'] == "logout") {
    Header("Location: ../login/logout.php");
}
// 아이디 찾기
if ($_GET['mode'] == "find_id") {
    Header("Location: ../login/find_id.php");
}
// 아이디 찾기 완료 후, 아이디 조회결과
if ($_GET['mode'] == "find_id_completed") {
    Header("Location: ../login/find_id_completed.php");
}
// 비밀번호 찾기
if ($_GET['mode'] == "find_pass") {
    Header("Location: ../login/find_password.php");
}
// 비밀번호 찾기 완료 후, 비밀번호 재설정
if ($_GET['mode'] == "find_pass_completed") {
    Header("Location: ../login/find_password_completed.php");
}
// 내정보수정
if ($_GET['mode'] == "modify") {
    Header("Location: /member/modify_myinfo.php");
}


