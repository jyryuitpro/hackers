<?php

var_dump($_POST);


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




