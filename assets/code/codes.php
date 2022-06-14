<?php

function includeAll() {
    $dirs = [
        "header.php",
        "messages.php",
        "login.php",
    ];
    for ($i=0; $i < count($dirs); $i++) { 
        include $dirs[$i];
    }
}