<?php
include "./functions.php";
if(new EDB($_POST["path"], $_POST["password"])) {
    $file = fopen($_POST["path"], "r");
    $file = file_get_contents($_POST["path"]);
    echo deCode($file, "none");
} else {
    echo false;
}
