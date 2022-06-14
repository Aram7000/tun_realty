<?php
include "../../edb/functions.php";
session_start();
$table;
if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
    $users = new EDB("../../edb/databases/userinfo.edb");
    $logged = false;
    for ($i = 0; $i < count($users->content); $i++) {
        $table = $users->content[$i];
        if ($table[0] == $_SESSION["user"] && $_SESSION["password"] == $table[5][1] && $_SESSION["email"] == $table[3][1]) {
            $logged = true;
            array_push($table[4][1], $_POST["phone_num"]);
            array_push($table[10][1], "false");
            $users->addinDB($table);
            header("Location: ../");
            break;
        }
    }
    if (!$logged) {
        header("Location: ../../");
    }
} else {
    header("Location: ../../login");
}