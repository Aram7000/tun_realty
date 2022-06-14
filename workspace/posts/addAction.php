<?php
include "../../edb/functions.php";

session_start();
$users_db = new EDB("../../edb/databases/userinfo.edb", "none");
$filter;
$user;
if (isset($_SESSION["user"])) {
    for ($i = 0; $i < count($users_db->content); $i++) {
        $user = $users_db->content[$i];
        if ($user[0] == $_SESSION["user"]) {
            if ($user[5][1] == $_SESSION["password"] && $user[3][1] == $_SESSION["email"]) {
                $filters_db = new EDB("../../edb/databases/filters.edb", "none", "Filters");
                $posts_db = new EDB("../../edb/databases/posts.edb", "LFr3wYr9THJz9C4h", "Posts");
                $category = $_POST["category"];
                $section = $_POST["section"];
                $subsection = $_POST["subsection"];
                $table = [
                    "Post" . count($posts_db->content),
                    ["filter_names", []],
                    ["filter_values", []],
                    ["images_dir", []],
                    ["section", $section],
                    ["category", $category],
                    ["subsection", $subsection],
                    ["visitors", [$user[0]]],
                    ["upload_dmy", date("d-m-Y")],
                    ["update_dmy", date("d-m-Y")],
                    ["account", $user[0]],
                    ["first_price", ""],
                    ["price", ""],
                    ["code", ""],
                    ["q.m", ""],
                    ["room_count", ""],
                    ["floor_count", ""],
                    ["floor", ""],
                    ["price_type", ""],
                    ["phone_numbers", []],
                    ["tags", [""]],
                    ["address", ""],
                    ["fake_address", ""],
                    ["deleted_dmy", ""],
                    ["deleted", "active"]
                ];
                for ($j = 0; $j < count($filters_db->content); $j++) {
                    $filter = $filters_db->content[$j];
                    if ($filter[5][1] == $subsection && $filter[9][1] == "false") {
                        if ($filters_db->content[0][1][1] == $filter[1][1]) {
                            $table[11][1] = $_POST[$filter[0]];
                            $table[12][1] = $_POST[$filter[0]];
                        } else if ($filters_db->content[2][1][1] == $filter[1][1]) {
                            $table[15][1] = $_POST[$filter[0]];
                        } else if ($filters_db->content[3][1][1] == $filter[1][1]) {
                            $table[14][1] = $_POST[$filter[0]];
                        } else if ($filters_db->content[4][1][1] == $filter[1][1]) {
                            $table[17][1] = $_POST[$filter[0]];
                        } else if ($filters_db->content[5][1][1] == $filter[1][1]) {
                            $table[16][1] = $_POST[$filter[0]];
                        } else if ($filters_db->content[10][1][1] == $filter[1][1]) {
                            $table[13][1] = $_POST[$filter[0]];
                        } else if ($filters_db->content[1][1][1] == $filter[1][1]) {
                            $table[18][1] = $_POST[$filter[0]];
                        }

                        array_push($table[1][1], $filter[0]);
                        array_push($table[2][1], $_POST[$filter[0]]);
                    }
                }
                $i = 0;
                while (isset($_POST["phone-" . $i])) {
                    array_push($table[19][1], $_POST["phone-" . $i]);
                    $i++;
                }

                $main_image_id = $_POST["main_image"];
                $countfiles = count($_FILES['post_images']['name']);
                $fileName;
                move_uploaded_file($_FILES['post_images']['tmp_name'][$main_image_id], '../../assets/posts/' . "Post" . count($posts_db->content) . "-main.png");
                array_push($table[3][1], 'assets/posts/' . "Post" . count($posts_db->content) . "-main.png");
                $x = 0;
                for ($i = 0; $i < $countfiles; $i++) {
                    if ($i != $main_image_id) {
                        $fileName = "Post" . count($posts_db->content) . "-" . $x . ".png";
                        $x++;
                        array_push($table[3][1], 'assets/posts/' . $fileName);
                        move_uploaded_file($_FILES['post_images']['tmp_name'][$i], '../../assets/posts/' . $fileName);
                    }
                }
                // $posts_db->addinDB($table);
                // header("Location: ../posts");
                break;
            }
        }
    }
}
