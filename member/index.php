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

if ($_GET['mode'] == "regist") {
    Header("Location: /member/regist.php");
}

if ($_GET['mode'] == "complete") {
    Header("Location: /member/step_04.php");
}

if ($_GET['mode'] == "login") {
    Header("Location: /member/login.php");
}

if ($_GET['mode'] == "logout") {
    Header("Location: ../login/logout.php");
}

if ($_GET['mode'] == "find_id") {
    Header("Location: ../login/find_id.php");
}

if ($_GET['mode'] == "find_id_completed") {
    Header("Location: ../login/find_id_completed.php");
}

if ($_GET['mode'] == "find_pass") {
    Header("Location: ../login/find_password.php");
}

if ($_GET['mode'] == "find_pass_completed") {
    Header("Location: ../login/find_password_completed.php");
}

if ($_GET['mode'] == "modify") {
    Header("Location: /member/modify_myinfo.php");
}


