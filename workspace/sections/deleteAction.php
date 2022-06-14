<?php
include "../../edb/functions.php";
session_start();
if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {

    $users = (new EDB("../../edb/databases/userinfo.edb"))->formatAsObj()["content"];
    $user = $users[$_SESSION["user"]];
    if ($user["verification"] == "superuser" && isset($_GET["id"])) {
        $db = new EDB("../../edb/databases/hidden_sections.edb", "none", "Not Confirmed Sections");
        for ($i = 0; $i < count($db->content); $i++) {
            $table = $db->content[$i];
            if ($_GET["id"] == $table[0]) {
                $table[4][1] = "true";
                $db->addinDB($table);
                break;
            }
        }
        header("Location: ../../workspace");
    } else {
        header("Location: ../../workspace");
    }
} else {
    header("Location: ../../login");
}
