<?php
include "./functions.php";
$db = new EDB($_POST["path"], $_POST["password"]);
if($db) {
    $db->addinDB($_POST["table"]);
    echo true;
} else {
    echo false;
}
