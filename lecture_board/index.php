<?php

// 수강후기 리스트 페이지
if ($_GET['mode'] == "list") {
    Header("Location: /lecture_board/step_01.php");
}

// 수강후기 등록/수정 페이지
if ($_GET['mode'] == "write") {
    if (isset($_GET['f_num']) && isset($_GET['f_gubun'])) {
        $f_num = $_GET['f_num'];
        Header("Location: /lecture_board/step_02.php?f_gubun=modify&f_num=".$f_num);
    } else {
        Header("Location: /lecture_board/step_02.php");
    }
}

// 수강후기 뷰(상세) 페이지
if ($_GET['mode'] == "view" && isset($_GET['f_num'])) {
    $f_num = $_GET['f_num'];
    Header("Location: /lecture_board/step_03.php?f_num=".$f_num);
}