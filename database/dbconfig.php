<?php
//$db = new mysqli('192.168.56.108', 'root', '', 'hackers');
$conn = new mysqli('localhost:3307', 'root', 'root', 'hackers');
if ($conn->connect_error) {
    die('DATABASE ERROR!');
}
$conn->set_charset("utf-8");
