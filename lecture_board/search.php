<?php
require_once("../database/dbconfig.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

if (isset($_GET['f_category_id'])) {
    $f_category_id = $_GET['f_category_id'];
    $data = array();
    $sql = "SELECT F_LECTURE FROM LECTURE WHERE F_CATEGORY_ID = '$f_category_id' ORDER BY F_NUM";

    $result_normal = $conn->query($sql);
    while ($row = $result_normal->fetch_assoc()) {
        array_push($data, $row['F_LECTURE']);
    }

//    var_dump($data);
    echo json_encode($data);
} else {
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


















