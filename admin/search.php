<?php
//var_dump($_POST);

//array(3) {
//    ["f_category_id"]=> string(3) "all"
//    ["f_search_detatil"]=> string(12) "f_admin_name"
//    ["f_search_content"]=> string(0) "" }

$data = array();

//$data = array(
//    'f_category_id' => $_POST['f_category_id'],
//    $_POST['f_search_detatil'] => $_POST['f_search_content']
//);

if (isset($_POST['f_category_id'])) {
    $data["f_category_id"] = $_POST['f_category_id'];
}

if (isset($_POST['f_search_detatil']) && $_POST['f_search_content'] != "") {
    if ($_POST['f_search_detatil'] == "f_lecture") {
        $data["f_lecture"] = $_POST['f_search_content'];
    } else {
        $data["f_admin_name"] = $_POST['f_search_content'];
    }
}

//$query_string = urldecode(http_build_query($data));
$query_string = http_build_query($data);
//exit;

Header("Location: /admin/step_01.php?$query_string");

//http://local.pass.com/admin/step_01.php?f_category_id=&=
//http://local.pass.com/admin/step_01.php?f_category_id=1&=
//http://local.pass.com/admin/step_01.php?f_category_id=1&f_lecture=
//http://local.pass.com/admin/step_01.php?f_category_id=1&f_admin_name=




