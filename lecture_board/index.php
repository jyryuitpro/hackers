<?php

// 수강후기 리스트 페이지
if ($_GET['mode'] == "list") {
    Header("Location: /lecture_board/step_01.php");
}

// 수강후기 등록/수정 페이지
if ($_GET['mode'] == "write") {
    Header("Location: /lecture_board/step_02.php");
}

// 수강후기 뷰(상세) 페이지 
if ($_GET['mode'] == "view") {
    Header("Location: /lecture_board/step_03.php");
}