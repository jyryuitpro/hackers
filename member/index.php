<?php

if ($_GET['mode'] == "step_01") {
    Header("Location: /member/step_01.php");
}

if ($_GET['mode'] == "step_02") {
    Header("Location: /member/step_02.php");
}

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


