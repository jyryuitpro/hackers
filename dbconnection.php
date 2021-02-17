<?php

$conn = mysqli_connect('192.168.56.108', 'root', '', 'hackers');
//$conn = mysqli_connect('localhost', 'root', '123456', 'hackers');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";



