<?php
session_start();
$_SESSION['f_mobile'] = $_POST['f_mobile'];

if ($_SESSION['verification_number'] == $_POST['verification_number']) {
    echo json_encode(array('res'=>'success'));
} else {
    echo json_encode(array('res'=>'fail'));
}