<?php
// 관리자 페이지 index

if ($_GET['mode'] == "list" && isset($_GET['f_category_id'])) { // 카테고리탭(어학 및 자격증, 공통역량, 일반직무, 산업직무) 클릭 시, 검색 기능
    $f_category_id = $_GET['f_category_id'];
    Header("Location: /admin/step_01.php?f_category_id=".$f_category_id);
} else if ($_GET['mode'] == "list") {
    // 강의 Admin 리스트 첫 페이지
    Header("Location: /admin/step_01.php");
}


if ($_GET['mode'] == "write") {
    if (isset($_GET['f_num']) && $_GET['f_gubun'] == "modify") { // 강의 수정
        $f_num = $_GET['f_num'];
        Header("Location: /admin/step_02.php?f_gubun=modify&f_num=".$f_num);
    } else { // 강의 등록
        Header("Location: /admin/step_02.php");
    }
}

if ($_GET['mode'] == "view") {
    $f_category_id = $_GET['f_category_id'];
    $f_num = $_GET['f_num'];
    Header("Location: /admin/step_02.php?f_gubun=modify&f_category_id=".$f_category_id."&f_num=".$f_num);
}

// 관리자2 step_03 / step_04
if ($_GET['mode'] == "member") {
    Header("Location: /admin/step_03.php");
}


