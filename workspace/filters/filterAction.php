<?php
include "../../edb/functions.php";
session_start();
if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
    $users = (new EDB("../../edb/databases/userinfo.edb"))->formatAsObj()["content"];
    $user = $users[$_SESSION["user"]];
    if ($user["verification"] == "superuser") {
        $name = $_POST["f-name"];
        $type = $_POST["f-type"];
        $category = $_POST["f-category"];
        $after = $_POST["f-after"];
        $array = [];
        $index = 0;
        while (isset($_POST[$type . $index])) {
            if ($_POST[$type . $index] != "") {
                array_push($array, $_POST[$type . $index]);
            }
            $index ++;
        }
        $db = new EDB("../../edb/databases/hidden_filters.edb");
        $id;
        if (count($db->content) > 0) {
            $id = str_replace("Filter", "", $db->content[count($db->content) - 1][0]);
            $id = intval($id) + 1;
        } else {
            $id = 0;
        }
        $table = [
            "Filter" . $id,
            ["name", $name],
            ["type", $type],
            ["options", $array],
            ["requires", "true"],
            ["category", $category],
            ["details", "false"],
            ["order", "100"],
            ["hidden", "false"],
            ["deleted", "false"],
        ];
        $db->addinDB($table);
        header("Location: ../../workspace");
    } else {
        header("Location: ../../workspace");
    }
} else {
    header("Location: ../../login");
}
