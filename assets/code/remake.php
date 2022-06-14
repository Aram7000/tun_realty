<?php


function remake_db($path, $password = "none", $name) {
    $hidden_filters = new EDB($path, $password, $name);
    unlink($path);
    $new_db = new EDB($path, $password, $name);
    for ($i = 0; $i < count($hidden_filters->content); $i++) {
        $table = $hidden_filters->content[$i];
        if ($table[count($table) - 1][1] != "true") {
            $new_db->addinDB($table);
        }
    }
}
