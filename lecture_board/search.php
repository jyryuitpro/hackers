<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

// 수강후기 등록 페이지에서 강의 분류 선택 시, 분류/강의명 CATEGORY 테이블에서 추출 및 검색조건 URI 세팅 및

// 검색조건 1) 강의 분류 : f_category_id

// [f_search_detatil]
// 검색조건 2) 강의명 (f_lecture)
// 검색조건 3) 작성자 이름 (f_name)
// 검색조건 2), 3) 내용 : f_search_content

// 수강후기 등록 페이지에서 강의 분류 선택 시, 분류/강의명 CATEGORY 테이블에서 추출
if (isset($_GET['f_category_id'])) {
    $f_category_id = $_GET['f_category_id'];
    $data = array();
    $sql = "SELECT F_LECTURE FROM LECTURE WHERE F_CATEGORY_ID = '$f_category_id' ORDER BY F_NUM";

    $result_normal = $conn->query($sql);
    while ($row = $result_normal->fetch_assoc()) {
        array_push($data, $row['F_LECTURE']);
    }
    echo json_encode($data);
} else if (isset($_POST['mode'])) { // 뷰 페이지에서 검색조건 URI 세팅 및
    // 예시
    // array(5) {
    // ["mode"]=> string(4) "view"
    // ["f_num"]=> string(2) "43"
    // ["f_category_id"]=> string(1) "3"
    // ["f_search_detatil"]=> string(6) "f_name"
    // ["f_search_content"]=> string(9) "류지영"
    // }

    $data = array();

    if (isset($_POST['f_num'])) {
        $data["f_num"] = $_POST['f_num'];
    }

    if (isset($_POST['f_category_id']) && $_POST['f_category_id'] != "all") {
        $data["f_category_id"] = $_POST['f_category_id'];
    }

    if (isset($_POST['f_search_detatil']) && $_POST['f_search_content'] != "") {
        if ($_POST['f_search_detatil'] == "f_lecture") {
            $data["f_lecture"] = $_POST['f_search_content'];
        } else {
            $data["f_name"] = $_POST['f_search_content'];
        }
    }

    $query_string = http_build_query($data);

    Header("Location: /lecture_board/step_03.php?$query_string");
} else{ // 리스트 페이지에서 검색조건 URI 세팅 및
    // 예시
    // array(3) {
    // ["f_category_id"]=> string(1) "1"
    // ["f_search_detatil"]=> string(6) "f_name"
    // ["f_search_content"]=> string(9) "류지영"
    // }

    $data = array();

    if (isset($_POST['f_category_id']) && $_POST['f_category_id'] != "all") {
        $data["f_category_id"] = $_POST['f_category_id'];
    }

    if (isset($_POST['f_search_detatil']) && $_POST['f_search_content'] != "") {
        if ($_POST['f_search_detatil'] == "f_lecture") {
            $data["f_lecture"] = $_POST['f_search_content'];
        } else {
            $data["f_name"] = $_POST['f_search_content'];
        }
    }

    //$query_string = urldecode(http_build_query($data));
    $query_string = http_build_query($data);

    Header("Location: /lecture_board/step_01.php?$query_string");
}


















