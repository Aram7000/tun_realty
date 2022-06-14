<?php

include "../edb/functions.php";
session_start();
if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
    $users = (new EDB("../edb/databases/userinfo.edb"))->formatAsObj()["content"];
    $user = $users[$_SESSION["user"]];
    if ($user["verification"] == "superuser") {
        //============================================================================================================
        $hidden_sections = new EDB("../edb/databases/hidden_sections.edb", "none", "Not Confirmed Sections");
        $hidden_categories = new EDB("../edb/databases/hidden_categories.edb", "none", "Not Confirmed Categories");
        $hidden_subsections = new EDB("../edb/databases/hidden_subsections.edb", "none", "Not Confirmed Subsections");
        include "../assets/code/remake.php";
        remake_db("../edb/databases/hidden_filters.edb", "none", "Not Confirmed Filters");
        $hidden_filters = new EDB("../edb/databases/hidden_filters.edb", "none", "Not Confirmed Filters");
        $hidden_styles = new EDB("../edb/databases/hidden_styles.edb", "none", "Not Confirmed Styles");
        //============================================================================================================
        $sections = new EDB("../edb/databases/sections.edb", "none", "Sections");
        $categories = new EDB("../edb/databases/categories.edb", "none", "Categories");
        $subsections = new EDB("../edb/databases/subsections.edb", "none", "Subsections");
        $filters = new EDB("../edb/databases/filters.edb", "none", "Filters");
        $styles = new EDB("../edb/databases/styles.edb", "none", "Styles");
        //============================================================================================================
        for ($i = 0; $i < count($hidden_categories->content); $i++) {
            $table = $hidden_categories->content[$i];
            if (isset($_POST[$table[0] . "-name"])) {
                $table[1][1] = $_POST[$table[0] . "-name"];
                $table[3][1] = $_POST[$table[0] . "-order"];
                $hidden_categories->addinDB($table);
            }
            $categories->addinDB($table);
        }
        
        for ($i = 0; $i < count($hidden_sections->content); $i++) {
            $table = $hidden_sections->content[$i];
            if (isset($_POST[$table[0] . "-name"])) {
                $table[1][1] = $_POST[$table[0] . "-name"];
                $table[3][1] = $_POST[$table[0] . "-order"];
                $hidden_sections->addinDB($table);
            }
            $sections->addinDB($table);
        }
        for ($i = 0; $i < count($hidden_subsections->content); $i++) {
            $table = $hidden_subsections->content[$i];
            if (isset($_POST[$table[0] . "-name"])) {
                $table[1][1] = $_POST[$table[0] . "-name"];
                $table[3][1] = $_POST[$table[0] . "-order"];
                $hidden_subsections->addinDB($table);
            }
            $subsections->addinDB($table);
        }
        $filters->reset();
        for ($i = 0; $i < count($hidden_filters->content); $i++) {
            $table = $hidden_filters->content[$i];
            if (isset($_POST[$table[0] . "-name"])) {
                $table[1][1] = $_POST[$table[0] . "-name"];
                $table[7][1] = $_POST[$table[0] . "-order"];
                $hidden_filters->addinDB($table);
            }
            $filters->addinDB($table);
        }

        for ($i = 0; $i < count($hidden_styles->content); $i++) {
            $table = $hidden_styles->content[$i];
            $name = $table[0];
            if (isset($_POST[$name . "-name"])) {
                $table[1][1] = $_POST[$name . "-background-color"];
                $table[2][1] = $_POST[$name . "-color"];
                $table[3][1] = $_POST[$name . "-font-size"];
                
                $hidden_styles->addinDB($table);
            }
            $styles->addinDB($table);
        }



        header("Location: ../workspace");
    } else {
        header("Location: ../workspace");
    }
} else {
    header("Location: ../login");
}