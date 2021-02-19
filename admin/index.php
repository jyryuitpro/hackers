<?php

if ($_GET['mode'] == "list") {
    Header("Location: /admin/step_01.php");
}

if ($_GET['mode'] == "write") {
    Header("Location: /admin/step_02.php");
}

if ($_GET['mode'] == "write") {
    if (isset($_GET['f_num']) && isset($_GET['f_gubun'])) {
        $f_num = $_GET['f_num'];
        Header("Location: /lecture_board/step_02.php?f_gubun=modify&f_num=".$f_num);
    } else {
        Header("Location: /lecture_board/step_02.php");
    }
}

if ($_GET['mode'] == "view") {
    $f_num = $_GET['f_num'];
    Header("Location: /admin/step_02.php?f_gubun=modify&f_num=".$f_num);
}



//if ($_GET['mode'] == "view" && isset($_GET['f_num']) && !isset($_GET['f_category_id'])) {
//
//    $f_num = $_GET['f_num'];
//    Header("Location: /admin/step_02.php?f_num=".$f_num);
//
//
//} else if ($_GET['mode'] == "view" && isset($_GET['f_num']) && isset($_GET['f_category_id'])) {
//    $f_num = $_GET['f_num'];
//    $f_category_id = $_GET['f_category_id'];
//    Header("Location: /lecture_board/step_03.php?f_num=".$f_num."&f_category_id=".$f_category_id);
//}
