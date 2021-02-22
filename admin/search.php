<?php
// 검색조건 URI 세팅

// 검색조건 1) 강의 분류 : f_category_id

// [f_search_detatil]
// 검색조건 2) 강의명 (f_lecture)
// 검색조건 3) 강사명 (f_instructor)
// 검색조건 4) 관리자 이름 (f_admin_name)
// 검색조건 2), 3) 4) 내용 : f_search_content

//var_dump($_POST);
//exit;

// 예시
//array(3) {
//    ["f_category_id"]=> string(1) "1"
//    ["f_search_detatil"]=> string(12) "f_admin_name"
//    ["f_search_content"]=> string(9) "류지영"
//}

$data = array();

// 검색조건 1) 강의 분류 query string 만들기
if (isset($_POST['f_category_id']) && $_POST['f_category_id'] != "all") {
    $data["f_category_id"] = $_POST['f_category_id'];
}

// 검색조건 2) 강의명, 검색조건 3) 관리자 이름 query string 만들기
if (isset($_POST['f_search_detatil']) && $_POST['f_search_content'] != "") {
    if ($_POST['f_search_detatil'] == "f_lecture") {
        $data["f_lecture"] = $_POST['f_search_content'];
    } else if ($_POST['f_search_detatil'] == "f_instructor") {
        $data["f_instructor"] = $_POST['f_search_content'];
    } else if ($_POST['f_search_detatil'] == "f_admin_name") {
        $data["f_admin_name"] = $_POST['f_search_content'];
    }
}

//$query_string = urldecode(http_build_query($data));
$query_string = http_build_query($data);
//var_dump($query_string);
//exit;

Header("Location: /admin/step_01.php?$query_string");




