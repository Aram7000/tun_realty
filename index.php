<?php
$root_dir = "";
include "assets/code/codes.php";
include "edb/functions.php";
$db = (new EDB("edb/databases/userinfo.edb"));
session_start();
includeAll();
$categories = (new EDB("edb/databases/categories.edb"))->content;
$sections = (new EDB("edb/databases/sections.edb"))->content;
$styles = (new EDB("edb/databases/styles.edb"))->content;
$subsections = (new EDB("edb/databases/subsections.edb"))->content;
$filters = (new EDB("edb/databases/filters.edb"))->content;
$posts = (new EDB("edb/databases/posts.edb", "LFr3wYr9THJz9C4h"))->content;

$categories_obj = (new EDB("edb/databases/categories.edb"))->formatAsObj()["content"];
$sections_obj = (new EDB("edb/databases/sections.edb"))->formatAsObj()["content"];
$styles_obj = (new EDB("edb/databases/styles.edb"))->formatAsObj()["content"];
$subsections_obj = (new EDB("edb/databases/subsections.edb"))->formatAsObj()["content"];
$filters_obj = (new EDB("edb/databases/filters.edb"))->formatAsObj()["content"];
$posts_obj = (new EDB("edb/databases/posts.edb", "LFr3wYr9THJz9C4h"))->formatAsObj()["content"];

$user;
$favorite = 0;
if (isset($_SESSION["logged"]) && $_SESSION["logged"]) {
    $user = $db->formatAsObj()["content"][$_SESSION["user"]];
    $favorite = count($user["favorite_posts"]) - 1;
}

$isDetails = false;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Գլխավոր Էջ</title>
    <link rel="stylesheet" href="./Neon(c)/require.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/search-bar.css">
    <link rel="stylesheet" href="assets/css/post_block.css">
    <script>
        let root_dir = "<?php echo $root_dir ?>";
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/color_scheme.js"></script>
    <script src="assets/js/menu.js"></script>
    <script src="assets/js/search-bar.js"></script>
    <script src="assets/js/loading.js"></script>
    <script src="assets/js/favorite.js"></script>
    <script src="assets/js/controller.js"></script>
</head>

<body class="">
    <div id="loading-screen">
        <span class="fr"></span>
    </div>
    <?php
    checked_header_part($root_dir, $favorite);
    ?>
    <div class="max-width">
        <div class="search-bar">
            <h2>Որոնում</h2>
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
                        <button style="<?php for ($j = 1; $j < count($style); $j++) {
                                            echo $style[$j][0] . ": " . $style[$j][1] . "; ";
                                        } ?>order: <?php echo $table[2][1] ?>" class="category-btn section-row-btn" id="<?php echo $table[0] ?>">
                            <p><?php echo $table[1][1] ?></p>
                        </button>
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
                        <button style="<?php for ($j = 1; $j < count($style); $j++) {
                                            echo $style[$j][0] . ": " . $style[$j][1] . "; ";
                                        } ?>order: <?php echo $table[3][1] ?>" class="<?php echo $table[2][1] ?> category-btn category-row-btn" id="<?php echo $table[0] ?>">
                            <p><?php echo $table[1][1] ?></p>
                        </button>
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
                        <button style="<?php for ($j = 1; $j < count($style); $j++) {
                                            echo $style[$j][0] . ": " . $style[$j][1] . "; ";
                                        } ?>order: <?php echo $table[3][1] ?>" class="<?php echo $table[2][1] ?> category-btn subsection-row-btn" id="<?php echo $table[0] ?>">
                            <p><?php echo $table[1][1] ?></p>
                        </button>
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
                    if ($filter[2][1] == "number" && $filter[9][1] == "false" && $filter[8][1] == "false" && $filter[6][1] == "false") {
                ?>
                        <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container">
                            <p class="filter-name"><?php echo $filter[1][1] ?></p>
                            <div class="number-name">
                                <div class="inputs" id="<?php echo $filter[0] ?>">
                                    <input type="number" class="lowtab" placeholder="Նվազագույն">
                                    <p>-</p>
                                    <input type="number" class="hightab" placeholder="Առավելագույն">
                                </div>
                            </div>
                        </div>
                    <?php
                    } else if ($filter[2][1] == "text" && $filter[9][1] == "false" && $filter[8][1] == "false" && $filter[6][1] == "false") {
                    ?>
                        <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container">
                            <p class="filter-name"><?php echo $filter[1][1] ?></p>
                            <div class="text-filter">
                                <input type="text">
                            </div>
                        </div>
                    <?php
                    } else if ($filter[2][1] == "select" && $filter[9][1] == "false" && $filter[8][1] == "false" && $filter[6][1] == "false") {
                    ?>
                        <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container">
                            <p class="filter-name"><?php echo $filter[1][1] ?></p>
                            <select>
                                <option value="All" selected>Ամբողջը</option>
                                <?php
                                for ($o = 0; $o < count($filter[3][1]); $o++) {
                                    $optionName = $filter[3][1][$o];
                                ?>
                                    <option value="<?php echo $optionName ?>"><?php echo $optionName ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    <?php
                    } else if (($filter[2][1] == "radio" || $filter[2][1] == "checkbox") && $filter[9][1] == "false" && $filter[8][1] == "false" && $filter[6][1] == "false") { ?>
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
                                                <input type="checkbox" id="<?php echo $filter[0] . $o ?>">
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
                    } else if ($filter[2][1] == "double-select" && $filter[9][1] == "false" && $filter[8][1] == "false" && $filter[6][1] == "false") { ?>
                        <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container">
                            <p class="filter-name"><?php echo $filter[1][1] ?></p>
                            <div class="number-name">
                                <div class="inputs">
                                    <select>
                                        <option selected>Նվազագույն</option>
                                        <?php for ($j = 0; $j < count($filter[3][1]); $j++) { ?>
                                            <option value="<?php echo $filter[3][1][$j] ?>"><?php echo $filter[3][1][$j] ?></option>
                                        <?php } ?>
                                    </select>
                                    <p>-</p>
                                    <select>
                                        <option selected>Առավելագույն</option>
                                        <?php for ($j = 0; $j < count($filter[3][1]); $j++) { ?>
                                            <option value="<?php echo $filter[3][1][$j] ?>"><?php echo $filter[3][1][$j] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <?php if ($isDetails) { ?>
                <div id="show-more-btn" class="relative w100">
                    <p>Մանրամասն Որոնում</p>
                </div>
                <div class="filters hidden_details" id="details">
                    <?php
                    for ($i = 0; $i < count($filters); $i++) {
                        $filter = $filters[$i];
                        if ($filter[2][1] == "number" && $filter[9][1] == "false" && $filter[8][1] == "false" && $filter[6][1] == "true") {
                    ?>
                            <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container">
                                <p class="filter-name"><?php echo $filter[1][1] ?></p>
                                <div class="number-name">
                                    <div class="inputs" id="<?php echo $filter[0] ?>">
                                        <input type="number" class="lowtab" placeholder="Նվազագույն">
                                        <p>-</p>
                                        <input type="number" class="hightab" placeholder="Առավելագույն">
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else if ($filter[2][1] == "text" && $filter[9][1] == "false" && $filter[8][1] == "false" && $filter[6][1] == "true") {
                        ?>
                            <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container">
                                <p class="filter-name"><?php echo $filter[1][1] ?></p>
                                <div class="text-filter">
                                    <input type="text">
                                </div>
                            </div>
                        <?php
                        } else if ($filter[2][1] == "select" && $filter[9][1] == "false" && $filter[8][1] == "false" && $filter[6][1] == "true") {
                        ?>
                            <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container">
                                <p class="filter-name"><?php echo $filter[1][1] ?></p>
                                <select>
                                    <option value="All" selected>Ամբողջը</option>
                                    <?php
                                    for ($o = 0; $o < count($filter[3][1]); $o++) {
                                        $optionName = $filter[3][1][$o];
                                    ?>
                                        <option value="<?php echo $optionName ?>"><?php echo $optionName ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        <?php
                        } else if (($filter[2][1] == "radio" || $filter[2][1] == "checkbox") && $filter[9][1] == "false" && $filter[8][1] == "false" && $filter[6][1] == "true") { ?>
                            <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container radio-checkbox">
                                <p class="filter-name"><?php echo $filter[1][1] ?></p>
                                <div class="radio">
                                    <?php
                                    for ($o = 0; $o < count($filter[3][1]); $o++) {
                                        $optionName = $filter[3][1][$o];
                                    ?>
                                        <div class="checkbox-container">
                                            <label class="label-container" for="<?php echo $filter[0] . $o ?>">
                                                <label class="checkbox" for="<?php echo $filter[0] . $o ?>">
                                                    <input type="checkbox" id="<?php echo $filter[0] . $o ?>">
                                                </label>
                                                <p class="checkbox-name"><?php echo $optionName ?></p>
                                            </label>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        } else if ($filter[2][1] == "double-select" && $filter[9][1] == "false" && $filter[8][1] == "false" && $filter[6][1] == "true") { ?>
                            <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container">
                                <p class="filter-name"><?php echo $filter[1][1] ?></p>
                                <div class="number-name">
                                    <div class="inputs">
                                        <select>
                                            <option selected>Նվազագույն</option>
                                            <?php for ($j = 0; $j < count($filter[3][1]); $j++) { ?>
                                                <option value="<?php echo $filter[3][1][$j] ?>"><?php echo $filter[3][1][$j] ?></option>
                                            <?php } ?>
                                        </select>
                                        <p>-</p>
                                        <select>
                                            <option selected>Առավելագույն</option>
                                            <?php for ($j = 0; $j < count($filter[3][1]); $j++) { ?>
                                                <option value="<?php echo $filter[3][1][$j] ?>"><?php echo $filter[3][1][$j] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            <?php } ?>

            <button class="search">Որոնել</button>
        </div>

    </div>
    <h2>Բնակարան</h2>
    <section id="posts" class="posts">
        <?php
        for ($i = 0; $i < count($posts); $i++) {
            $post = $posts[$i];
            if ($post[24][1] != "deleted") {
        ?>
                <div class="post">
                    <div class="visitors">
                        <p><?php echo count($post[7][1]) ?></p>
                        <span class="icon eye-icon"></span>
                    </div>
                    <div class="container">

                        <a href="single?id=<?php echo $post[0] ?>" class="t-s flex row">
                            <img src="<?php echo $root_dir . $post[3][1][0] ?>" alt="">
                            <div class="infos flex column ais">
                                <div class="location flex row aic">
                                    <span class="icon location-icon"></span>
                                    <div class="address flex column">
                                        <p>Արաբկիր</p>
                                        <p>Մամիկոնյանց</p>
                                    </div>
                                </div>
                                <div class="price">
                                    <div class="price-container flex row">
                                        <p class="price_now"><?php echo $post[12][1] ?></p>
                                        <sup><?php echo $filters[1][3][1][$post[18][1]] ?></sup>
                                    </div>
                                    <div class="price-container flex row">
                                        <p class="old_price"><?php echo $post[11][1] ?></p>
                                        <p class="title small">Հին Գին</p>
                                    </div>
                                </div>
                                <div class="info3 flex row jcb">
                                    <div class="filter flex column aic">
                                        <p class="title small">
                                            <?php echo $filters[2][1][1] ?>
                                        </p>
                                        <span class="icon room-icon"></span>
                                        <p>
                                            <?php echo $post[15][1] ?>
                                        </p>
                                    </div>
                                    <div class="filter flex column aic">
                                        <p class="title small">
                                            <?php echo $filters[3][1][1] ?>
                                        </p>
                                        <span class="icon surface-icon"></span>
                                        <p>
                                            <?php echo $post[14][1] ?> մ²
                                        </p>
                                    </div>
                                    <div class="filter flex column aic">
                                        <p class="title small">
                                            <?php echo $filters[4][1][1] ?>
                                        </p>
                                        <span class="icon floor-icon"></span>
                                        <p>
                                            <?php echo $post[17][1] ?> / <?php echo $post[16][1] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <button class="heart" id="<?php echo $post[0] ?>">
                            <span class="icon heart-icon 
                            <?php
                            for ($j = 1; $j < count($user["favorite_posts"]); $j++) {
                                if ($user["favorite_posts"][$j] == $post[0]) {
                                    echo "heart-active";
                                    break;
                                }
                            } ?> "></span>
                        </button>
                    </div>
                </div>
        <?php
            }
        }


        ?>
    </section>
</body>

</html>