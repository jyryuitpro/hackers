<?php

if ($_GET['mode'] == "list") {
    Header("Location: /admin/step_01.php");
}

if ($_GET['mode'] == "write") {
    Header("Location: /admin/step_02.php");
}
