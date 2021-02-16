<?php
var_dump($_GET['mode']);
if ($_GET['mode'] == "step_01") {
    Header("Location: /member/step_01.php");
}

if ($_GET['mode'] == "step_02") {
    Header("Location: /member/step_02.php");
}

if ($_GET['mode'] == "step_03") {
    Header("Location: /member/step_03.php");
}


