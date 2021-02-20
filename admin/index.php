<?php

// 강의 Admin 리스트 페이지
if ($_GET['mode'] == "list" && isset($_GET['f_category_id'])) {
    $f_category_id = $_GET['f_category_id'];
    Header("Location: /admin/step_01.php?f_category_id=".$f_category_id);
} else {
    Header("Location: /admin/step_01.php");
}

if ($_GET['mode'] == "write") {
    if (isset($_GET['f_num']) && $_GET['f_gubun'] == "modify") {
        $f_num = $_GET['f_num'];
        Header("Location: /admin/step_02.php?f_gubun=modify&f_num=".$f_num);
    } else {
        Header("Location: /admin/step_02.php");
    }
}

if ($_GET['mode'] == "view") {
    $f_num = $_GET['f_num'];
    Header("Location: /admin/step_02.php?f_gubun=modify&f_num=".$f_num);
}


