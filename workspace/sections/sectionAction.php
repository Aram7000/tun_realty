<?php
include "../../edb/functions.php";
session_start();
if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {

    $users = (new EDB("../../edb/databases/userinfo.edb"))->formatAsObj()["content"];
    $user = $users[$_SESSION["user"]];
    if ($user["verification"] == "superuser") {
        $db = new EDB("../../edb/databases/hidden_sections.edb", "none", "Not Confirmed Sections");
        $table = [
            "Section" . count($db->content),
            ["name", $_POST["s-name"]],
            ["order", count($db->content)],
            ["hidden", "false"],
            ["deleted", "false"],
        ];
        $db->addinDB($table);
        $styles = new EDB("../../edb/databases/hidden_styles.edb", "none", "Not Confirmed Styles");
        $table = [
            "Section" . count($db->content),
            ["background-color", "#1c6c82"],
            ["color", "#ffffff"],
            ["font-size", "100"],
        ];
        $styles->addinDB($table);
        header("Location: ../../workspace");
    } else {
        header("Location: ../../workspace");
    }
} else {
    header("Location: ../../login");
}
