<?php
// 수강후기 리스트 페이지
if ($_GET['mode'] == "list" && isset($_GET['f_category_id'])) {
    $data = array();
    if (isset($_GET['f_category_id'])) {
        $data["f_category_id"] = $_GET['f_category_id'];
    }
    $query_string = http_build_query($data);
    Header("Location: /lecture_board/step_01.php?".$query_string);
} else if ($_GET['mode'] == "list") {
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

if ($_GET['mode'] == "view" && (isset($_GET['f_num']) || isset($_GET['f_category_id']) || isset($_GET['f_lecture']) || isset($_GET['f_name']) || isset($_GET['page']))) {
    $data = array();

    if (isset($_GET['f_num'])) {
        $data["f_num"] = $_GET['f_num'];
    }

    if (isset($_GET['f_category_id'])) {
        $data["f_category_id"] = $_GET['f_category_id'];
    }

    if (isset($_GET['f_lecture'])) {
        $data["f_lecture"] = $_GET['f_lecture'];
    }

    if (isset($_GET['f_name'])) {
        $data["f_name"] = $_GET['f_name'];
    }

    if (isset($_GET['page'])) {
        $data["page"] = $_GET['page'];
    }

    $query_string = '?'.http_build_query($data);

    Header("Location: /lecture_board/step_03.php".$query_string);
}