<?php
$root_dir = "../../";
include $root_dir . "assets/code/setup.php";
setup($root_dir);
if (!isset($_SESSION["logged"]) || !$_SESSION["logged"]) {
    header("Location: ../../");
} else {
    $user = $db[$_SESSION["user"]];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ավելացնել Հայտարարություն</title>
    <link rel="stylesheet" href="../../Neon(c)/require.css">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/workspace.css">
    <link rel="stylesheet" href="../../assets/css/search-bar.css">
    <script src="../../assets/js/add_photo.js"></script>
    <script src="../../assets/js/color_scheme.js"></script>
    <script src="../../assets/js/menu.js"></script>
    <script src="../../assets/js/search-bar.js"></script>
    <script src="../../assets/js/controller.js"></script>

</head>

<body class="">
    <?php light_header_part($root_dir); ?>
    <main>
        <div class="max-width">
            <form class="add-post-bar" method="post" action="addAction.php" enctype="multipart/form-data">
                <h2>Ավելացնել Բնակարան</h2>
                <div class="categories">
                    <?php
                    for ($i = 0; $i < count($sections); $i++) {
                        $table = $sections[$i];
                        $style;
                        for ($j = 0; $j < count($styles); $j++) {
                            if ($styles[$j][0] == $table[0]) {
                                $style = $styles[$j];
                                break;
                            }
                        }
                        if ($table[4][1] == "false" && $table[4][1] == "false") {
                    ?>
                            <label for="<?php echo $table[0] ?>-lb" style="<?php for ($j = 1; $j < count($style); $j++) {
                                                                                echo $style[$j][0] . ": " . $style[$j][1] . "; ";
                                                                            } ?>order: <?php echo $table[2][1] ?>" class="category-btn section-row-btn" id="<?php echo $table[0] ?>">
                                <input value="<?php echo $table[0] ?>" type="radio" name="section" id="<?php echo $table[0] ?>-lb">
                                <p><?php echo $table[1][1] ?></p>
                            </label>
                    <?php
                        }
                    }
                    ?>
                </div>
                <div class="categories">
                    <?php
                    for ($i = 0; $i < count($categories); $i++) {
                        $table = $categories[$i];
                        $style;
                        for ($j = 0; $j < count($styles); $j++) {
                            if ($styles[$j][0] == $table[0]) {
                                $style = $styles[$j];
                                break;
                            }
                        }
                        if ($table[5][1] == "false" && $table[4][1] == "false") {
                    ?>
                            <label for="<?php echo $table[0] ?>-lb" style="<?php for ($j = 1; $j < count($style); $j++) {
                                                                                echo $style[$j][0] . ": " . $style[$j][1] . "; ";
                                                                            } ?>order: <?php echo $table[3][1] ?>" class="<?php echo $table[2][1] ?> category-btn category-row-btn" id="<?php echo $table[0] ?>">
                                <input value="<?php echo $table[0] ?>" type="radio" name="category" id="<?php echo $table[0] ?>-lb">
                                <p><?php echo $table[1][1] ?></p>
                            </label>
                    <?php
                        }
                    }
                    ?>
                </div>
                <div class="categories">
                    <?php
                    for ($i = 0; $i < count($subsections); $i++) {
                        $table = $subsections[$i];
                        $style;
                        for ($j = 0; $j < count($styles); $j++) {
                            if ($styles[$j][0] == $table[0]) {
                                $style = $styles[$j];
                                break;
                            }
                        }
                        if ($table[5][1] == "false" && $table[4][1] == "false") {
                    ?>
                            <label for="<?php echo $table[0] ?>-lb" style="<?php for ($j = 1; $j < count($style); $j++) {
                                                                                echo $style[$j][0] . ": " . $style[$j][1] . "; ";
                                                                            } ?>order: <?php echo $table[3][1] ?>" class="<?php echo $table[2][1] ?> category-btn subsection-row-btn" id="<?php echo $table[0] ?>">
                                <input value="<?php echo $table[0] ?>" type="radio" name="subsection" id="<?php echo $table[0] ?>-lb">
                                <p><?php echo $table[1][1] ?></p>
                            </label>
                    <?php
                        }
                    }
                    ?>
                </div>
                <div class="filters">
                    <?php

                    for ($i = 0; $i < count($filters); $i++) {
                        $filter = $filters[$i];
                        if ($filter[6][1] == "true") {
                            $isDetails = true;
                        }
                        if ($filter[2][1] == "number" && $filter[9][1] == "false" && $filter[8][1] != "true" && $filter[6][1] == "false") {
                    ?>
                            <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container">
                                <p class="filter-name"><?php echo $filter[1][1] ?></p>
                                <div class="number-name">
                                    <input type="number" name="<?php echo $filter[0] ?>">
                                </div>
                            </div>
                        <?php
                        } else if ($filter[2][1] == "text" && $filter[9][1] == "false" && $filter[8][1] != "true" && $filter[6][1] == "false") {
                        ?>
                            <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container">
                                <p class="filter-name"><?php echo $filter[1][1] ?></p>
                                <div class="text-filter">
                                    <input type="text" name="<?php echo $filter[0] ?>">
                                </div>
                            </div>
                        <?php
                        } else if (($filter[2][1] == "double-select" || $filter[2][1] == "select") && $filter[9][1] == "false" && $filter[8][1] != "true" && $filter[6][1] == "false") {
                        ?>
                            <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container">
                                <p class="filter-name"><?php echo $filter[1][1] ?></p>
                                <select name="<?php echo $filter[0] ?>">
                                    <option value="none" disabled selected>Նշված չէ</option>
                                    <?php
                                    for ($o = 0; $o < count($filter[3][1]); $o++) {
                                        $optionName = $filter[3][1][$o];
                                    ?>
                                        <option value="<?php echo $o ?>"><?php echo $optionName ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        <?php
                        } else if ($filter[2][1] == "radio" && $filter[9][1] == "false" && $filter[8][1] != "true" && $filter[6][1] == "false") { ?>
                            <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container radio-checkbox">
                                <p class="filter-name"><?php echo $filter[1][1] ?></p>
                                <div class="radio">
                                    <?php
                                    for ($o = 0; $o < count($filter[3][1]); $o++) {
                                        $optionName = $filter[3][1][$o];
                                    ?>
                                        <div class="checkbox-container">
                                            <label class="label-container" for="<?php echo $filter[0] . $o ?>">
                                                <div class="checkbox">
                                                    <input type="radio" id="<?php echo $filter[0] . $o ?>" name="<?php echo $filter[0] ?>" value="<?php echo $o ?>">
                                                </div>
                                                <p class="checkbox-name"><?php echo $optionName ?></p>
                                            </label>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        } else if ($filter[2][1] == "checkbox" && $filter[9][1] == "false" && $filter[8][1] != "true" && $filter[6][1] == "false") { ?>
                            <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container radio-checkbox">
                                <p class="filter-name"><?php echo $filter[1][1] ?></p>
                                <div class="radio">
                                    <?php
                                    for ($o = 0; $o < count($filter[3][1]); $o++) {
                                        $optionName = $filter[3][1][$o];
                                    ?>
                                        <div class="checkbox-container">
                                            <label class="label-container" for="<?php echo $filter[0] . $o ?>">
                                                <div class="checkbox">
                                                    <input type="checkbox" id="<?php echo $filter[0] . $o ?>" name="<?php echo $filter[0] ?>" value="<?php echo $o ?>">
                                                </div>
                                                <p class="checkbox-name"><?php echo $optionName ?></p>
                                            </label>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <?php if ($isDetails) { ?>
                    <div id="show-more-btn" class="relative w100">
                        <p>Մանրամասն Ինֆորմացիա</p>
                    </div>
                    <div class="filters" id="details">
                        <?php

                        for ($i = 0; $i < count($filters); $i++) {
                            $filter = $filters[$i];
                            if ($filter[6][1] == "true") {
                                $isDetails = true;
                            }
                            if ($filter[2][1] == "number" && $filter[9][1] == "false" && $filter[8][1] != "true" && $filter[6][1] == "true") {
                        ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container">
                                    <p class="filter-name"><?php echo $filter[1][1] ?></p>
                                    <div class="number-name">
                                        <input type="number" name="<?php echo $filter[0] ?>">
                                    </div>
                                </div>
                            <?php
                            } else if ($filter[2][1] == "text" && $filter[9][1] == "false" && $filter[8][1] != "true" && $filter[6][1] == "true") {
                            ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container">
                                    <p class="filter-name"><?php echo $filter[1][1] ?></p>
                                    <div class="text-filter">
                                        <input type="text" name="<?php echo $filter[0] ?>">
                                    </div>
                                </div>
                            <?php
                            } else if (($filter[2][1] == "double-select" || $filter[2][1] == "select") && $filter[9][1] == "false" && $filter[8][1] != "true" && $filter[6][1] == "true") {
                            ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container">
                                    <p class="filter-name"><?php echo $filter[1][1] ?></p>
                                    <select name="<?php echo $filter[0] ?>">
                                        <option value="none" disabled selected>Նշված չէ</option>
                                        <?php
                                        for ($o = 0; $o < count($filter[3][1]); $o++) {
                                            $optionName = $filter[3][1][$o];
                                        ?>
                                            <option value="<?php echo $o ?>"><?php echo $optionName ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            <?php
                            } else if ($filter[2][1] == "radio" && $filter[9][1] == "false" && $filter[8][1] != "true" && $filter[6][1] == "true") { ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container radio-checkbox">
                                    <p class="filter-name"><?php echo $filter[1][1] ?></p>
                                    <div class="radio">
                                        <?php
                                        for ($o = 0; $o < count($filter[3][1]); $o++) {
                                            $optionName = $filter[3][1][$o];
                                        ?>
                                            <div class="checkbox-container">
                                                <label class="label-container" for="<?php echo $filter[0] . $o ?>">
                                                    <div class="checkbox">
                                                        <input type="radio" id="<?php echo $filter[0] . $o ?>" name="<?php echo $filter[0] ?>" value="<?php echo $o ?>">
                                                    </div>
                                                    <p class="checkbox-name"><?php echo $optionName ?></p>
                                                </label>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php
                            } else if ($filter[2][1] == "checkbox" && $filter[9][1] == "false" && $filter[8][1] != "true" && $filter[6][1] == "true") { ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container radio-checkbox">
                                    <p class="filter-name"><?php echo $filter[1][1] ?></p>
                                    <div class="radio">
                                        <?php
                                        for ($o = 0; $o < count($filter[3][1]); $o++) {
                                            $optionName = $filter[3][1][$o];
                                        ?>
                                            <div class="checkbox-container">
                                                <label class="label-container" for="<?php echo $filter[0] . $o ?>">
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="<?php echo $filter[0] . $o ?>" name="<?php echo $filter[0] ?>" value="<?php echo $o ?>">
                                                    </div>
                                                    <p class="checkbox-name"><?php echo $optionName ?></p>
                                                </label>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                <?php } ?>
                <p class="description-title">
                    Նկարագիր
                </p>
                <textarea name="description" cols="30" rows="10" placeholder="Մանրամասն նկարագրեք ձեր Անշարժ Գույքը, բոլոր առավելությունները, թերությունները, կատարված աշխատանքները, ենթակառուցվածքը և ցանկացած այլ օգտակար տեղեկություն՝ այցելուների շրջանակում մեծ հետաքրքրություն առաջացնելու համար։"></textarea>
                <label for="post_images" class="label_file">
                    <input type="file" name="post_images[]" id="post_images" multiple>
                    <p id="post_image_dir">Ավելացնել Անշարժ Գույքի Լուսանկարներ</p>
                </label>
                <div>
                    <input type="number" name="main_image" id="main_image_input">
                </div>
                <div class="images_cont">
                    <div>
                        <img src="" alt="" id="main_image_cont">
                    </div>
                    <div class="min-width">
                        <div id="images_cont">

                        </div>
                    </div>
                </div>
                <div class="phone-checkboxes">
                    <?php for ($i = 0; $i < count($user["phone"]); $i++) {
                        if ($user["phone_deleted"][$i] == "false") { ?>
                            <div class="checkbox-container">
                                <label class="label-container" for="phone-<?php echo $i ?>">
                                    <input name="phone-<?php echo $i ?>" type="checkbox" id="phone-<?php echo $i ?>">
                                    <p class="checkbox-name"><?php echo $user["phone"][$i] ?></p>
                                </label>
                            </div>
                    <?php }
                    } ?>
                </div>
                <input type="submit" value="Հաստատել">
            </form>
        </div>
    </main>
</body>

</html>