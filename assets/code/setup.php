<?php


function setup($root_dir) {
    include $root_dir . "assets/code/codes.php";
    include $root_dir . "edb/functions.php";
    $GLOBALS["db"] = (new EDB($root_dir . "edb/databases/userinfo.edb"))->formatAsObj()["content"];
    session_start();
    includeAll();
    $GLOBALS["categories"] = (new EDB($root_dir . "edb/databases/categories.edb"))->content;
    $GLOBALS["sections"] = (new EDB($root_dir . "edb/databases/sections.edb"))->content;
    $GLOBALS["styles"] = (new EDB($root_dir . "edb/databases/styles.edb"))->content;
    $GLOBALS["subsections"] = (new EDB($root_dir . "edb/databases/subsections.edb"))->content;
    $GLOBALS["filters"] = (new EDB($root_dir . "edb/databases/filters.edb"))->content;
    $GLOBALS["posts"] = (new EDB($root_dir . "edb/databases/posts.edb", "LFr3wYr9THJz9C4h"))->content;
    
    $GLOBALS["categories_obj"] = (new EDB($root_dir . "edb/databases/categories.edb"))->formatAsObj()["content"];
    $GLOBALS["sections_obj"] = (new EDB($root_dir . "edb/databases/sections.edb"))->formatAsObj()["content"];
    $GLOBALS["styles_obj"] = (new EDB($root_dir . "edb/databases/styles.edb"))->formatAsObj()["content"];
    $GLOBALS["subsections_obj"] = (new EDB($root_dir . "edb/databases/subsections.edb"))->formatAsObj()["content"];
    $GLOBALS["filters_obj"] = (new EDB($root_dir . "edb/databases/filters.edb"))->formatAsObj()["content"];
    $GLOBALS["posts_obj"] = (new EDB($root_dir . "edb/databases/posts.edb", "LFr3wYr9THJz9C4h"))->formatAsObj()["content"];
    
    $GLOBALS["isDetails"] = false;
}
