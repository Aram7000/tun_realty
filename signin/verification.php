<?php
include "../edb/functions.php";
$db = new EDB("../edb/databases/userinfo.edb", "none", "User Info");
if (isset($_GET["userID"]) && isset($_GET["code"])) {
    for ($i = 0; $i < count($db->content); $i++) {
        $table = $db->content[$i];
        if ($table[0] == $_GET["userID"]) {
            if($table[19][1] == $_GET["code"]) {
                $table[6][1] = "user";
                $db->addinDB($table);
                header("Location: ../login");
            }
            break;
        }
    }
} else {
    header("Location: ../");
}