<?php
$root_dir = "../../";
session_start();
if (!isset($_SESSION["logged"]) || !$_SESSION["logged"]) {
    header("Location: ../../login");
} else {
    include "../../edb/functions.php";
    $users = new EDB("../../edb/databases/userinfo.edb");
    $table;
    for ($i = 0; $i < count($users->content); $i++) {
        $table = $users->content[$i];
        $log = true;
        if ($table[0] == $_SESSION["user"]) {
            if (count($table[17][1]) < 100 || $table[6][1] == "superuser") {
                for ($j = 1; $j < count($table[17][1]); $j++) {
                    if ($table[17][1][$j] == $_POST["id"]) {
                        array_splice($table[17][1], $j, 1);
                        echo "deleted, " . count($table[17][1]) - 1;
                        $log = false;
                        break;
                    }
                }
            }
            
            if ($log) {
                array_push($table[17][1], $_POST["id"]);
                echo "added, " . count($table[17][1]) - 1;
            }
            $users->addinDB($table);
            break;
        }
    }
}
