<?php
include "../edb/functions.php";
$db = (new EDB("../edb/databases/userinfo.edb"))->content;

$email = $_POST["email"];
$password = $_POST["password"];

for ($i=0; $i < count($db); $i++) { 
    $table = $db[$i];
    if ($table[3][1] == $email && $table[5][1] == $password) {
        if ($table[6][1] != "none") {
            session_start();
            $_SESSION["email"] = $email;
            $_SESSION["password"] = $password;
            $_SESSION["user"] = $table[0];
            $_SESSION["logged"] = true;
            header("Location: ../");
        } else {
            header("Location: ../login?msg=1");
        }
        break;
    } else {
        header("Location: ../login?msg=2");
    }
}