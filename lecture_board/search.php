<?php
require_once("../database/dbconfig.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);

//var_dump($_POST);
//exit;

if (isset($_GET['f_category_id'])) {
    $f_category_id = $_GET['f_category_id'];
    $data = array();
    $sql = "SELECT F_LECTURE FROM LECTURE WHERE F_CATEGORY_ID = '$f_category_id' ORDER BY F_NUM";

    $result_normal = $conn->query($sql);
    while ($row = $result_normal->fetch_assoc()) {
        array_push($data, $row['F_LECTURE']);
    }

    echo json_encode($data);
} else if (isset($_POST['mode'])) {
    $data = array();

//    if (isset($_POST['page'])) {
//        $data["page"] = $_POST['page'];
//    }

    if (isset($_POST['f_num'])) {
        $data["f_num"] = $_POST['f_num'];
    }

    if (isset($_POST['f_category_id'])) {
        $data["f_category_id"] = $_POST['f_category_id'];
    }

    if ($_POST['f_search_detatil'] == "f_lecture") {
        $data["f_lecture"] = $_POST['f_search_content'];
        $data["f_search_content"] = $_POST['f_search_content'];
    }

    if ($_POST['f_search_detatil'] == "f_name") {
        $data["f_name"] = $_POST['f_search_content'];
        $data["f_search_content"] = $_POST['f_search_content'];
    }

    $query_string = http_build_query($data);
//var_dump($query_string);
//exit;
    Header("Location: /lecture_board/step_03.php?$query_string");

} else{

    echo '검색조건';
    exit;
    //array(3) {
    // ["f_category_id"]=> string(1) "1"
    // ["f_search_detatil"]=> string(9) "f_lecture"
    // ["f_search_content"]=> string(6) "토익" }

    $data = array( 'f_category_id' => $_POST['f_category_id'],
        $_POST['f_search_detatil'] => $_POST['f_search_content']
    );

    //$query_string = urldecode(http_build_query($data));
    $query_string = http_build_query($data);

    Header("Location: /lecture_board/step_01.php?$query_string");
}


















