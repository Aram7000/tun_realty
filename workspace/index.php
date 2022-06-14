<?php
$root_dir = "../";
session_start();
if (!isset($_SESSION["logged"]) || !$_SESSION["logged"]) {
    header("Location: ../");
}
include "../edb/functions.php";
include "../assets/code/codes.php";
$db = (new EDB("../edb/databases/userinfo.edb"))->formatAsObj()["content"];
$user = $db[$_SESSION["user"]];
$filters = (new EDB("../edb/databases/hidden_filters.edb", "none", "Not Confirmed Filters"))->content;
$sections = (new EDB("../edb/databases/hidden_sections.edb", "none", "Not Confirmed Sections"))->content;
$categories_db = new EDB("../edb/databases/hidden_categories.edb", "none", "Not Confirmed Categories");
$styles = (new EDB("../edb/databases/hidden_styles.edb", "none", "Not Confirmed Styles"))->content;
$subsections = (new EDB("../edb/databases/hidden_subsections.edb", "none", "Not Confirmed Subsections"))->content;
$categories = $categories_db->content;

includeAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Workspace</title>
    <link rel="stylesheet" href="../Neon(c)/require.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/workspace.css">
    <link rel="stylesheet" href="../assets/css/search-bar.css">
    <?php if ($user["verification"] == "superuser") { ?>
        <script>
            <?php if (isset($_GET["section"])) { ?>
                let sectionID = "<?php echo $_GET["section"] ?>";
                let getSection = true;
            <?php } else { ?>
                let getSection = false;
            <?php } ?>
            <?php if (isset($_GET["category"])) { ?>
                let sectionID = "<?php echo $_GET["category"] ?>";
                let getCategory = true;
            <?php } else { ?>
                let getCategory = false;
            <?php } ?>
        </script>
        <script src="../assets/js/search-bar-admin.js"></script>
        <script>
            document.title = "Իմ Տունս";
        </script>
        <script src="../assets/js/filter_select_add.js"></script>
    <?php } ?>
    <script src="../assets/js/color_scheme.js"></script>
    <script src="../assets/js/menu.js"></script>
    <script src="../assets/js/controller.js"></script>
</head>

<body>
    <?php light_header_part($root_dir); ?>
    <main>
        <div class="max-width">
            <div class="settings">
                <form class="phone-num" action="phone/addPhone.php" method="post">
                    <h2>Իմ Հեռախոսահամարները</h2>
                    <div class="drop-down-parent-more info">
                        <div class="drop-down-button-more">
                            <span class="icon info-icon"></span>
                        </div>
                        <div class="drop-down-container-more">
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                Quis nemo animi delectus corporis praesentium.
                                Eaque obcaecati quibusdam sit non ullam excepturi quasi neque,
                                mollitia doloremque, ratione repudiandae accusamus. Tenetur, id!
                            </p>
                        </div>
                    </div>
                    <?php for ($i = 0; $i < count($user["phone"]); $i++) {  ?>
                        <div class="row-phone">
                            <div class="row">
                                <span class="icon phone-icon"></span>
                                <p><?php echo $user["phone"][$i] ?></p>
                            </div>
                            <div class="row">
                                <p class="small-info">55 Հայտարարություն</p>
                                <div class="drop-down-parent-more">
                                    <div class="drop-down-button-more">
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                    </div>
                                    <div class="drop-down-container-more">
                                        <a href="delpost">
                                            <span class="icon remove-phone-icon"></span>
                                            <p>Հեռացնել բոլոր հայտարարություններից</p>
                                        </a>
                                        <a href="delNum">
                                            <span class="icon delete-icon"></span>
                                            <p>Հեռացնել Հեռախոսահամարը</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row-add-num">
                        <label for="phone-num-input">
                            <p>Ավելացնել Հեռախոսահամար</p>
                            <input type="tel" name="phone_num" id="phone-num-input">
                        </label>
                        <input type="submit" value="Ավելացնել">
                    </div>
                </form>
                <form class="phone-num no-padding" action="phone/addViber.php" method="post">
                    <div class="row-add-num">
                        <label for="viber-num-input">
                            <p>Նշել Viber</p>
                            <div class="row">
                                <span class="icon viber-filled-icon"></span>
                                <select name="viber" id="viber-num-input">
                                    <?php if ($user["viber"] == "false") { ?>
                                        <option value="false" selected disabled></option>
                                    <?php } ?>
                                    <?php for ($i = 0; $i < count($user["phone"]); $i++) { ?>
                                        <option <?php if ($user["viber"] == $i) echo "selected" ?> value="<?php echo $i ?>"><?php echo $user["phone"][$i] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </label>
                        <?php if ($user["viber"] == "false") { ?>
                            <input type="submit" value="Հաստատել">
                        <?php } else { ?>
                            <input type="submit" value="Փոփոխել">
                            <a href="phone/removeViber.php?id=<?php echo $i ?>"><span class="icon delete-icon large"></span></a>
                        <?php } ?>
                    </div>
                </form>
                <form class="phone-num no-padding" action="phone/addWhatsapp.php" method="post">
                    <div class="row-add-num">
                        <label for="viber-num-input">
                            <p>Նշել Whatsapp</p>
                            <div class="row">
                                <span class="icon whatsapp-filled-icon"></span>
                                <select name="whatsapp" id="viber-num-input">
                                    <?php if ($user["whatsapp"] == "false") { ?>
                                        <option value="false" selected disabled></option>
                                    <?php } ?>
                                    <?php for ($i = 0; $i < count($user["phone"]); $i++) { ?>
                                        <option <?php if ($user["whatsapp"] == $i) echo "selected" ?> value="<?php echo $i ?>"><?php echo $user["phone"][$i] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </label>
                        <?php if ($user["whatsapp"] == "false") { ?>
                            <input type="submit" value="Հաստատել">
                        <?php } else { ?>
                            <input type="submit" value="Փոփոխել">
                            <a href="phone/removeWhatsapp.php?id=<?php echo $i ?>"><span class="icon delete-icon large"></span></a>
                        <?php } ?>
                    </div>
                </form>
            </div>
            <?php if ($user["verification"] == "superuser") { ?>
                <h2>Filters</h2>
                <div class="tools-btns">
                    <button id="show-hide-btn"></button>
                </div>
                <form class="search-bar" action="confirm.php" method="post">
                    <div class="categories">
                        <?php for ($i = 0; $i < count($sections); $i++) {
                            if ($sections[$i][4][1] == "false") {
                                $table = $sections[$i];
                                $style;
                                for ($j = 0; $j < count($styles); $j++) {
                                    $element = $styles[$j];
                                    if ($element[0] == $table[0]) {
                                        $style = $element;
                                        break;
                                    }
                                }
                        ?>
                                <div style="order: <?php echo $table[2][1] ?>;" class="drop-down-parent section <?php if ($table[3][1] == "true") echo "hidden" ?>" id="<?php echo $table[0] ?>">
                                    <input style="
                                <?php for ($j = 1; $j < count($style); $j++) {
                                    echo $style[$j][0] . ":" . $style[$j][1] . "; ";
                                } ?>order: <?php echo $table[2][1] ?>; " type="text" value="<?php echo $table[1][1] ?>" name="<?php echo $table[0] ?>-name">
                                    <div class="drop-down-container">
                                        <div class="l-s">
                                            <input class="background-color" type="color" value="<?php echo $style[1][1] ?>" name="<?php echo $table[0] ?>-background-color">
                                            <input class="color" type="color" value="<?php echo $style[2][1] ?>" name="<?php echo $table[0] ?>-color">
                                            <input class="order" type="number" value="<?php echo $table[2][1] ?>" name="<?php echo $table[0] ?>-order">
                                            <input class="font-size" type="number" value="<?php echo $style[3][1] ?>" name="<?php echo $table[0] ?>-font-size">
                                        </div>
                                        <div class="r-s">
                                            <input type="button" class="close-btn">
                                            <p class="element-id">ID: <?php echo $table[0] ?></p>
                                            <a href="sections/deleteAction.php?id=<?php echo $table[0] ?>" class="deleteBtn" title="Ջնջել Աշխարհի երեսից"></a>
                                            <?php if ($table[3][1] == "false") { ?>
                                                <a href="sections/hideAction.php?id=<?php echo $table[0] ?>" title="Կորցնել սաղի մոտ" class="hide-show hide"></a>
                                            <?php } else { ?>
                                                <a href="sections/showAction.php?id=<?php echo $table[0] ?>" title="Ցուցադրել Բոլորին" class="hide-show show"></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                    <div class="categories">
                        <?php for ($i = 0; $i < count($categories); $i++) {
                            if ($categories[$i][5][1] == "false") {
                                $table = $categories[$i];
                                $style;
                                for ($j = 0; $j < count($styles); $j++) {
                                    $element = $styles[$j];
                                    if ($element[0] == $table[0]) {
                                        $style = $element;
                                        break;
                                    }
                                }
                        ?>
                                <div style="order: <?php echo $table[3][1] ?>;" class="<?php echo $table[2][1] ?> drop-down-parent category <?php if ($table[4][1] == "true") echo "hidden" ?>" id="<?php echo $table[0] ?>">
                                    <input style="
                                <?php for ($j = 1; $j < count($style); $j++) {
                                    echo $style[$j][0] . ":" . $style[$j][1] . "; ";
                                } ?>" type="text" value="<?php echo $table[1][1] ?>" name="<?php echo $table[0] ?>-name">
                                    <div class="drop-down-container">
                                        <div class="l-s">
                                            <input class="background-color" type="color" value="<?php echo $style[1][1] ?>" name="<?php echo $table[0] ?>-background-color">
                                            <input class="color" type="color" value="<?php echo $style[2][1] ?>" name="<?php echo $table[0] ?>-color">
                                            <input class="order" type="number" value="<?php echo $table[3][1] ?>" name="<?php echo $table[0] ?>-order">
                                            <input class="font-size" type="number" value="<?php echo $style[3][1] ?>" name="<?php echo $table[0] ?>-font-size">
                                        </div>
                                        <div class="r-s">
                                            <input type="button" class="close-btn">
                                            <p class="element-id">ID: <?php echo $table[0] ?></p>
                                            <a href="categories/deleteAction.php?id=<?php echo $table[0] ?>" class="deleteBtn" title="Ջնջել Աշխարհի երեսից"></a>
                                            <?php if ($table[4][1] == "false") { ?>
                                                <a href="categories/hideAction.php?id=<?php echo $table[0] ?>" title="Կորցնել սաղի մոտ" class="hide-show hide"></a>
                                            <?php } else { ?>
                                                <a href="categories/showAction.php?id=<?php echo $table[0] ?>" title="Ցուցադրել Բոլորին" class="hide-show show"></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                    <div class="categories">
                        <?php for ($i = 0; $i < count($subsections); $i++) {
                            if ($subsections[$i][5][1] == "false") {
                                $subsection = $subsections[$i];
                                $style;
                                for ($j = 0; $j < count($styles); $j++) {
                                    $element = $styles[$j];
                                    if ($element[0] == $subsection[0]) {
                                        $style = $element;
                                        break;
                                    }
                                }
                        ?>
                                <div style="order: <?php echo $subsection[3][1] ?>;" class="<?php echo $subsection[2][1] ?> drop-down-parent subsection <?php if ($subsection[4][1] == "true") echo "hidden" ?>" id="<?php echo $subsection[0] ?>">
                                    <input style="
                                <?php for ($j = 1; $j < count($style); $j++) {
                                    echo $style[$j][0] . ":" . $style[$j][1] . "; ";
                                } ?>" type="text" value="<?php echo $subsection[1][1] ?>" name="<?php echo $subsection[0] ?>-name">
                                    <div class="drop-down-container">
                                        <div class="l-s">
                                            <input class="background-color" type="color" value="<?php echo $style[1][1] ?>" name="<?php echo $subsection[0] ?>-background-color">
                                            <input class="color" type="color" value="<?php echo $style[2][1] ?>" name="<?php echo $subsection[0] ?>-color">
                                            <input class="order" type="number" value="<?php echo $subsection[3][1] ?>" name="<?php echo $subsection[0] ?>-order">
                                            <input class="font-size" type="number" value="<?php echo $style[3][1] ?>" name="<?php echo $subsection[0] ?>-font-size">
                                        </div>
                                        <div class="r-s">
                                            <input type="button" class="close-btn">
                                            <p class="element-id">ID: <?php echo $subsection[0] ?></p>
                                            <a href="subsections/deleteAction.php?id=<?php echo $subsection[0] ?>" class="deleteBtn" title="Ջնջել Աշխարհի երեսից"></a>
                                            <?php if ($subsection[4][1] == "false") { ?>
                                                <a href="subsections/hideAction.php?id=<?php echo $subsection[0] ?>" title="Կորցնել սաղի մոտ" class="hide-show hide"></a>
                                            <?php } else { ?>
                                                <a href="subsections/showAction.php?id=<?php echo $subsection[0] ?>" title="Ցուցադրել Բոլորին" class="hide-show show"></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                    <div class="filters">
                        <?php
                        for ($i = 0; $i < count($filters); $i++) {
                            $filter = $filters[$i];
                            if ($filter[2][1] == "number" && $filter[9][1] == "false" && $filter[6][1] == "false") {
                        ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container <?php if ($filter[8][1] == "true") echo "hidden" ?> <?php echo $filter[4][1] ?>">
                                    <input type="text" class="filter-name" name="<?php echo $filter[0] ?>-name" value="<?php echo $filter[1][1] ?>">
                                    <div class="number">
                                        <div class="inputs">
                                            <input type="number" disabled class="disabled" placeholder="Նվազագույն">
                                            <p>-</p>
                                            <input type="number" disabled class="disabled" placeholder="Առավելագույն">
                                        </div>
                                    </div>
                                    <div class="drop-down-container">
                                        <div class="l-s">
                                            <input class="order" type="number" value="<?php echo $filter[7][1] ?>" name="<?php echo $filter[0] ?>-order">
                                        </div>
                                        <div class="r-s">
                                            <input type="button" class="close-btn">
                                            <p class="element-id">ID: <?php echo $filter[0] ?></p>
                                            <a href="filters/deleteAction.php?id=<?php echo $filter[0] ?>" class="deleteBtn" title="Ջնջել Աշխարհի երեսից"></a>
                                            <?php if ($filter[8][1] == "false") { ?>
                                                <a href="filters/hideAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել սաղի մոտ" class="hide-show hide"></a>
                                                <a href="filters/hideSearchAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել Որոնման Մեջ" class="hide-show search-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/showAction.php?id=<?php echo $filter[0] ?>" title="Ցուցադրել Բոլորին" class="hide-show show"></a>
                                            <?php }
                                            if ($filter[6][1] == "true") { ?>
                                                <a href="filters/detailsOffAction.php?id=<?php echo $filter[0] ?>" title="Հանել Մանրամասների Բաժնից" class="hide-show details-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/detailsOnAction.php?id=<?php echo $filter[0] ?>" title="Տեղափոխել Մանրամասների Բաժին" class="hide-show details-on"></a>
                                            <?php }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($filter[2][1] == "text" && $filter[9][1] == "false" && $filter[6][1] == "false") {
                            ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container <?php if ($filter[8][1] == "true") echo "hidden" ?>">
                                    <input type="text" class="filter-name" name="<?php echo $filter[0] ?>-name" value="<?php echo $filter[1][1] ?>">
                                    <div class="text">
                                        <input type="text" disabled class="disabled">
                                    </div>
                                    <div class="drop-down-container">
                                        <div class="l-s">
                                            <input class="order" type="number" value="<?php echo $filter[7][1] ?>" name="<?php echo $filter[0] ?>-order">
                                        </div>
                                        <div class="r-s">
                                            <input type="button" class="close-btn">
                                            <p class="element-id">ID: <?php echo $filter[0] ?></p>
                                            <a href="filters/deleteAction.php?id=<?php echo $filter[0] ?>" class="deleteBtn" title="Ջնջել Աշխարհի երեսից"></a>
                                            <?php if ($filter[8][1] == "false") { ?>
                                                <a href="filters/hideAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել սաղի մոտ" class="hide-show hide"></a>
                                                <a href="filters/hideSearchAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել Որոնման Մեջ" class="hide-show search-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/showAction.php?id=<?php echo $filter[0] ?>" title="Ցուցադրել Բոլորին" class="hide-show show"></a>
                                            <?php }
                                            if ($filter[6][1] == "true") { ?>
                                                <a href="filters/detailsOffAction.php?id=<?php echo $filter[0] ?>" title="Հանել Մանրամասների Բաժնից" class="hide-show details-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/detailsOnAction.php?id=<?php echo $filter[0] ?>" title="Տեղափոխել Մանրամասների Բաժին" class="hide-show details-on"></a>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($filter[2][1] == "select" && $filter[9][1] == "false" && $filter[6][1] == "false") {
                            ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container <?php if ($filter[8][1] == "true") echo "hidden" ?>">
                                    <input type="text" class="filter-name" name="<?php echo $filter[0] ?>-name" value="<?php echo $filter[1][1] ?>">
                                    <select>
                                        <option value="" selected>Ամբողջը</option>
                                        <?php
                                        for ($o = 0; $o < count($filter[3][1]); $o++) {
                                            $optionName = $filter[3][1][$o];
                                        ?>
                                            <option value="<?php echo $optionName ?>"><?php echo $optionName ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="drop-down-container">
                                        <div class="l-s">
                                            <input class="order" type="number" value="<?php echo $filter[7][1] ?>" name="<?php echo $filter[0] ?>-order">
                                        </div>
                                        <div class="r-s">
                                            <input type="button" class="close-btn">
                                            <p class="element-id">ID: <?php echo $filter[0] ?></p>
                                            <a href="filters/deleteAction.php?id=<?php echo $filter[0] ?>" class="deleteBtn" title="Ջնջել Աշխարհի երեսից"></a>
                                            <?php if ($filter[8][1] == "false") { ?>
                                                <a href="filters/hideAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել սաղի մոտ" class="hide-show hide"></a>
                                                <a href="filters/hideSearchAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել Որոնման Մեջ" class="hide-show search-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/showAction.php?id=<?php echo $filter[0] ?>" title="Ցուցադրել Բոլորին" class="hide-show show"></a>
                                            <?php }
                                            if ($filter[6][1] == "true") { ?>
                                                <a href="filters/detailsOffAction.php?id=<?php echo $filter[0] ?>" title="Հանել Մանրամասների Բաժնից" class="hide-show details-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/detailsOnAction.php?id=<?php echo $filter[0] ?>" title="Տեղափոխել Մանրամասների Բաժին" class="hide-show details-on"></a>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($filter[2][1] == "radio" && $filter[9][1] == "false" && $filter[6][1] == "false") { ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container <?php if ($filter[8][1] == "true") echo "hidden" ?> radio-checkbox">
                                    <input type="text" class="filter-name" name="<?php echo $filter[0] ?>-name" value="<?php echo $filter[1][1] ?>">
                                    <div class="radio">
                                        <?php
                                        for ($o = 0; $o < count($filter[3][1]); $o++) {
                                            $optionName = $filter[3][1][$o];
                                        ?>
                                            <div class="checkbox-container">
                                                <input disabled selected type="checkbox">
                                                <input type="text" class="filter-option" value="<?php echo $optionName ?>">
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="drop-down-container">
                                        <div class="l-s">
                                            <input class="order" type="number" value="<?php echo $filter[7][1] ?>" name="<?php echo $filter[0] ?>-order">
                                        </div>
                                        <div class="r-s">
                                            <input type="button" class="close-btn">
                                            <p class="element-id">ID: <?php echo $filter[0] ?></p>
                                            <a href="filters/deleteAction.php?id=<?php echo $filter[0] ?>" class="deleteBtn" title="Ջնջել Աշխարհի երեսից"></a>
                                            <?php if ($filter[8][1] == "false") { ?>
                                                <a href="filters/hideAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել սաղի մոտ" class="hide-show hide"></a>
                                                <a href="filters/hideSearchAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել Որոնման Մեջ" class="hide-show search-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/showAction.php?id=<?php echo $filter[0] ?>" title="Ցուցադրել Բոլորին" class="hide-show show"></a>
                                            <?php }
                                            if ($filter[6][1] == "true") { ?>
                                                <a href="filters/detailsOffAction.php?id=<?php echo $filter[0] ?>" title="Հանել Մանրամասների Բաժնից" class="hide-show details-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/detailsOnAction.php?id=<?php echo $filter[0] ?>" title="Տեղափոխել Մանրամասների Բաժին" class="hide-show details-on"></a>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($filter[2][1] == "checkbox" && $filter[9][1] == "false" && $filter[6][1] == "false") { ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container <?php if ($filter[8][1] == "true") echo "hidden" ?> radio-checkbox">
                                    <input type="text" class="filter-name" name="<?php echo $filter[0] ?>-name" value="<?php echo $filter[1][1] ?>">
                                    <div class="radio">
                                        <?php
                                        for ($o = 0; $o < count($filter[3][1]); $o++) {
                                            $optionName = $filter[3][1][$o];
                                        ?>
                                            <div class="checkbox-container">
                                                <input disabled selected type="checkbox">
                                                <input type="text" class="filter-option" value="<?php echo $optionName ?>">
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="drop-down-container">
                                        <div class="l-s">
                                            <input class="order" type="number" value="<?php echo $filter[7][1] ?>" name="<?php echo $filter[0] ?>-order">
                                        </div>
                                        <div class="r-s">
                                            <input type="button" class="close-btn">
                                            <p class="element-id">ID: <?php echo $filter[0] ?></p>
                                            <a href="filters/deleteAction.php?id=<?php echo $filter[0] ?>" class="deleteBtn" title="Ջնջել Աշխարհի երեսից"></a>
                                            <?php if ($filter[8][1] == "false") { ?>
                                                <a href="filters/hideAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել սաղի մոտ" class="hide-show hide"></a>
                                                <a href="filters/hideSearchAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել Որոնման Մեջ" class="hide-show search-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/showAction.php?id=<?php echo $filter[0] ?>" title="Ցուցադրել Բոլորին" class="hide-show show"></a>
                                            <?php }
                                            if ($filter[6][1] == "true") { ?>
                                                <a href="filters/detailsOffAction.php?id=<?php echo $filter[0] ?>" title="Հանել Մանրամասների Բաժնից" class="hide-show details-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/detailsOnAction.php?id=<?php echo $filter[0] ?>" title="Տեղափոխել Մանրամասների Բաժին" class="hide-show details-on"></a>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($filter[2][1] == "double-select" && $filter[9][1] == "false" && $filter[6][1] == "false") { ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container <?php if ($filter[8][1] == "true") echo "hidden" ?>">
                                    <input type="text" class="filter-name" name="<?php echo $filter[0] ?>-name" value="<?php echo $filter[1][1] ?>">
                                    <div class="double-select">
                                        <div class="double-select-container">
                                            <select>
                                                <option selected>Նվազագույն</option>
                                                <?php for ($j = 0; $j < count($filter[3][1]); $j++) { ?>
                                                    <option value=""><?php echo $filter[3][1][$j] ?></option>
                                                <?php } ?>
                                            </select>
                                            <p>-</p>
                                            <select>
                                                <option selected>Առավելագույն</option>
                                                <?php for ($j = 0; $j < count($filter[3][1]); $j++) { ?>
                                                    <option value=""><?php echo $filter[3][1][$j] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="drop-down-container">
                                        <div class="l-s">
                                            <input class="order" type="number" value="<?php echo $filter[7][1] ?>" name="<?php echo $filter[0] ?>-order">
                                        </div>
                                        <div class="r-s">
                                            <input type="button" class="close-btn">
                                            <p class="element-id">ID: <?php echo $filter[0] ?></p>
                                            <a href="filters/deleteAction.php?id=<?php echo $filter[0] ?>" class="deleteBtn" title="Ջնջել Աշխարհի երեսից"></a>
                                            <?php if ($filter[8][1] == "false") { ?>
                                                <a href="filters/hideAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել սաղի մոտ" class="hide-show hide"></a>
                                                <a href="filters/hideSearchAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել Որոնման Մեջ" class="hide-show search-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/showAction.php?id=<?php echo $filter[0] ?>" title="Ցուցադրել Բոլորին" class="hide-show show"></a>
                                            <?php }
                                            if ($filter[6][1] == "true") { ?>
                                                <a href="filters/detailsOffAction.php?id=<?php echo $filter[0] ?>" title="Հանել Մանրամասների Բաժնից" class="hide-show details-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/detailsOnAction.php?id=<?php echo $filter[0] ?>" title="Տեղափոխել Մանրամասների Բաժին" class="hide-show details-on"></a>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div id="show-more-btn" class="relative w100">
                        <p>Մանրամասն Որոնում</p>
                    </div>
                    <div id="details" class="filters">
                        <?php
                        for ($i = 0; $i < count($filters); $i++) {
                            $filter = $filters[$i];
                            if ($filter[2][1] == "number" && $filter[9][1] == "false" && $filter[6][1] == "true") {
                        ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container <?php if ($filter[8][1] == "true") echo "hidden" ?> <?php echo $filter[4][1] ?>">
                                    <input type="text" class="filter-name" name="<?php echo $filter[0] ?>-name" value="<?php echo $filter[1][1] ?>">
                                    <div class="number">
                                        <div class="inputs">
                                            <input type="number" disabled class="disabled" placeholder="Նվազագույն">
                                            <p>-</p>
                                            <input type="number" disabled class="disabled" placeholder="Առավելագույն">
                                        </div>
                                    </div>
                                    <div class="drop-down-container">
                                        <div class="l-s">
                                            <input class="order" type="number" value="<?php echo $filter[7][1] ?>" name="<?php echo $filter[0] ?>-order">
                                        </div>
                                        <div class="r-s">
                                            <input type="button" class="close-btn">
                                            <p class="element-id">ID: <?php echo $filter[0] ?></p>
                                            <a href="filters/deleteAction.php?id=<?php echo $filter[0] ?>" class="deleteBtn" title="Ջնջել Աշխարհի երեսից"></a>
                                            <?php if ($filter[8][1] == "false") { ?>
                                                <a href="filters/hideAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել սաղի մոտ" class="hide-show hide"></a>
                                                <a href="filters/hideSearchAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել Որոնման Մեջ" class="hide-show search-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/showAction.php?id=<?php echo $filter[0] ?>" title="Ցուցադրել Բոլորին" class="hide-show show"></a>
                                            <?php }
                                            if ($filter[6][1] == "true") { ?>
                                                <a href="filters/detailsOffAction.php?id=<?php echo $filter[0] ?>" title="Հանել Մանրամասների Բաժնից" class="hide-show details-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/detailsOnAction.php?id=<?php echo $filter[0] ?>" title="Տեղափոխել Մանրամասների Բաժին" class="hide-show details-on"></a>
                                            <?php }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($filter[2][1] == "text" && $filter[9][1] == "false" && $filter[6][1] == "true") {
                            ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container <?php if ($filter[8][1] == "true") echo "hidden" ?>">
                                    <input type="text" class="filter-name" name="<?php echo $filter[0] ?>-name" value="<?php echo $filter[1][1] ?>">
                                    <div class="text">
                                        <input type="text" disabled class="disabled">
                                    </div>
                                    <div class="drop-down-container">
                                        <div class="l-s">
                                            <input class="order" type="number" value="<?php echo $filter[7][1] ?>" name="<?php echo $filter[0] ?>-order">
                                        </div>
                                        <div class="r-s">
                                            <input type="button" class="close-btn">
                                            <p class="element-id">ID: <?php echo $filter[0] ?></p>
                                            <a href="filters/deleteAction.php?id=<?php echo $filter[0] ?>" class="deleteBtn" title="Ջնջել Աշխարհի երեսից"></a>
                                            <?php if ($filter[8][1] == "false") { ?>
                                                <a href="filters/hideAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել սաղի մոտ" class="hide-show hide"></a>
                                                <a href="filters/hideSearchAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել Որոնման Մեջ" class="hide-show search-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/showAction.php?id=<?php echo $filter[0] ?>" title="Ցուցադրել Բոլորին" class="hide-show show"></a>
                                            <?php }
                                            if ($filter[6][1] == "true") { ?>
                                                <a href="filters/detailsOffAction.php?id=<?php echo $filter[0] ?>" title="Հանել Մանրամասների Բաժնից" class="hide-show details-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/detailsOnAction.php?id=<?php echo $filter[0] ?>" title="Տեղափոխել Մանրամասների Բաժին" class="hide-show details-on"></a>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($filter[2][1] == "select" && $filter[9][1] == "false" && $filter[6][1] == "true") {
                            ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container <?php if ($filter[8][1] == "true") echo "hidden" ?>">
                                    <input type="text" class="filter-name" name="<?php echo $filter[0] ?>-name" value="<?php echo $filter[1][1] ?>">
                                    <select>
                                        <option value="" selected>Ամբողջը</option>
                                        <?php
                                        for ($o = 0; $o < count($filter[3][1]); $o++) {
                                            $optionName = $filter[3][1][$o];
                                        ?>
                                            <option value="<?php echo $optionName ?>"><?php echo $optionName ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="drop-down-container">
                                        <div class="l-s">
                                            <input class="order" type="number" value="<?php echo $filter[7][1] ?>" name="<?php echo $filter[0] ?>-order">
                                        </div>
                                        <div class="r-s">
                                            <input type="button" class="close-btn">
                                            <p class="element-id">ID: <?php echo $filter[0] ?></p>
                                            <a href="filters/deleteAction.php?id=<?php echo $filter[0] ?>" class="deleteBtn" title="Ջնջել Աշխարհի երեսից"></a>
                                            <?php if ($filter[8][1] == "false") { ?>
                                                <a href="filters/hideAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել սաղի մոտ" class="hide-show hide"></a>
                                                <a href="filters/hideSearchAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել Որոնման Մեջ" class="hide-show search-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/showAction.php?id=<?php echo $filter[0] ?>" title="Ցուցադրել Բոլորին" class="hide-show show"></a>
                                            <?php }
                                            if ($filter[6][1] == "true") { ?>
                                                <a href="filters/detailsOffAction.php?id=<?php echo $filter[0] ?>" title="Հանել Մանրամասների Բաժնից" class="hide-show details-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/detailsOnAction.php?id=<?php echo $filter[0] ?>" title="Տեղափոխել Մանրամասների Բաժին" class="hide-show details-on"></a>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($filter[2][1] == "radio" && $filter[9][1] == "false" && $filter[6][1] == "true") { ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container <?php if ($filter[8][1] == "true") echo "hidden" ?> radio-checkbox">
                                    <input type="text" class="filter-name" name="<?php echo $filter[0] ?>-name" value="<?php echo $filter[1][1] ?>">
                                    <div class="radio">
                                        <?php
                                        for ($o = 0; $o < count($filter[3][1]); $o++) {
                                            $optionName = $filter[3][1][$o];
                                        ?>
                                            <div class="checkbox-container">
                                                <input disabled selected type="checkbox">
                                                <input type="text" class="filter-option" value="<?php echo $optionName ?>">
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="drop-down-container">
                                        <div class="l-s">
                                            <input class="order" type="number" value="<?php echo $filter[7][1] ?>" name="<?php echo $filter[0] ?>-order">
                                        </div>
                                        <div class="r-s">
                                            <input type="button" class="close-btn">
                                            <p class="element-id">ID: <?php echo $filter[0] ?></p>
                                            <a href="filters/deleteAction.php?id=<?php echo $filter[0] ?>" class="deleteBtn" title="Ջնջել Աշխարհի երեսից"></a>
                                            <?php if ($filter[8][1] == "false") { ?>
                                                <a href="filters/hideAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել սաղի մոտ" class="hide-show hide"></a>
                                                <a href="filters/hideSearchAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել Որոնման Մեջ" class="hide-show search-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/showAction.php?id=<?php echo $filter[0] ?>" title="Ցուցադրել Բոլորին" class="hide-show show"></a>
                                            <?php }
                                            if ($filter[6][1] == "true") { ?>
                                                <a href="filters/detailsOffAction.php?id=<?php echo $filter[0] ?>" title="Հանել Մանրամասների Բաժնից" class="hide-show details-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/detailsOnAction.php?id=<?php echo $filter[0] ?>" title="Տեղափոխել Մանրամասների Բաժին" class="hide-show details-on"></a>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($filter[2][1] == "checkbox" && $filter[9][1] == "false" && $filter[6][1] == "true") { ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container <?php if ($filter[8][1] == "true") echo "hidden" ?> radio-checkbox">
                                    <input type="text" class="filter-name" name="<?php echo $filter[0] ?>-name" value="<?php echo $filter[1][1] ?>">
                                    <div class="radio">
                                        <?php
                                        for ($o = 0; $o < count($filter[3][1]); $o++) {
                                            $optionName = $filter[3][1][$o];
                                        ?>
                                            <div class="checkbox-container">
                                                <input disabled selected type="checkbox">
                                                <input type="text" class="filter-option" value="<?php echo $optionName ?>">
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="drop-down-container">
                                        <div class="l-s">
                                            <input class="order" type="number" value="<?php echo $filter[7][1] ?>" name="<?php echo $filter[0] ?>-order">
                                        </div>
                                        <div class="r-s">
                                            <input type="button" class="close-btn">
                                            <p class="element-id">ID: <?php echo $filter[0] ?></p>
                                            <a href="filters/deleteAction.php?id=<?php echo $filter[0] ?>" class="deleteBtn" title="Ջնջել Աշխարհի երեսից"></a>
                                            <?php if ($filter[8][1] == "false") { ?>
                                                <a href="filters/hideAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել սաղի մոտ" class="hide-show hide"></a>
                                                <a href="filters/hideSearchAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել Որոնման Մեջ" class="hide-show search-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/showAction.php?id=<?php echo $filter[0] ?>" title="Ցուցադրել Բոլորին" class="hide-show show"></a>
                                            <?php }
                                            if ($filter[6][1] == "true") { ?>
                                                <a href="filters/detailsOffAction.php?id=<?php echo $filter[0] ?>" title="Հանել Մանրամասների Բաժնից" class="hide-show details-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/detailsOnAction.php?id=<?php echo $filter[0] ?>" title="Տեղափոխել Մանրամասների Բաժին" class="hide-show details-on"></a>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($filter[2][1] == "double-select" && $filter[9][1] == "false" && $filter[6][1] == "true") { ?>
                                <div style="order: <?php echo $filter[7][1] ?>;" class="<?php echo $filter[5][1] ?> filter-container <?php if ($filter[8][1] == "true") echo "hidden" ?>">
                                    <input type="text" class="filter-name" name="<?php echo $filter[0] ?>-name" value="<?php echo $filter[1][1] ?>">
                                    <div class="double-select">
                                        <div class="double-select-container">
                                            <select>
                                                <option selected>Նվազագույն</option>
                                                <?php for ($j = 0; $j < count($filter[3][1]); $j++) { ?>
                                                    <option value=""><?php echo $filter[3][1][$j] ?></option>
                                                <?php } ?>
                                            </select>
                                            <p>-</p>
                                            <select>
                                                <option selected>Առավելագույն</option>
                                                <?php for ($j = 0; $j < count($filter[3][1]); $j++) { ?>
                                                    <option value=""><?php echo $filter[3][1][$j] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="drop-down-container">
                                        <div class="l-s">
                                            <input class="order" type="number" value="<?php echo $filter[7][1] ?>" name="<?php echo $filter[0] ?>-order">
                                        </div>
                                        <div class="r-s">
                                            <input type="button" class="close-btn">
                                            <p class="element-id">ID: <?php echo $filter[0] ?></p>
                                            <a href="filters/deleteAction.php?id=<?php echo $filter[0] ?>" class="deleteBtn" title="Ջնջել Աշխարհի երեսից"></a>
                                            <?php if ($filter[8][1] == "false") { ?>
                                                <a href="filters/hideAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել սաղի մոտ" class="hide-show hide"></a>
                                                <a href="filters/hideSearchAction.php?id=<?php echo $filter[0] ?>" title="Կորցնել Որոնման Մեջ" class="hide-show search-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/showAction.php?id=<?php echo $filter[0] ?>" title="Ցուցադրել Բոլորին" class="hide-show show"></a>
                                            <?php }
                                            if ($filter[6][1] == "true") { ?>
                                                <a href="filters/detailsOffAction.php?id=<?php echo $filter[0] ?>" title="Հանել Մանրամասների Բաժնից" class="hide-show details-off"></a>
                                            <?php } else { ?>
                                                <a href="filters/detailsOnAction.php?id=<?php echo $filter[0] ?>" title="Տեղափոխել Մանրամասների Բաժին" class="hide-show details-on"></a>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <input type="submit" value="✔" title="Հաստատել">
                </form>
                <div class="one-row">
                    <form class="addComponent" action="sections/sectionAction.php" method="post">
                        <h2>Բաժին 1-ին</h2>
                        <input type="text" name="s-name" placeholder="Բաժնի Անուն">
                        <input type="submit" value="Հաստատել">
                    </form>

                    <form class="addComponent" action="categories/categoryAction.php" method="post">
                        <h2>Բաժին 2-րդ</h2>
                        <input type="text" name="c-name" placeholder="Բաժնի Անուն">
                        <select name="c-section">
                            <?php
                            for ($i = 0; $i < count($sections); $i++) {
                                $table = $sections[$i];
                                if ($table[4][1] == "false") {
                            ?>
                                    <option value="<?php echo $table[0] ?>"><?php echo $table[1][1] ?></option>
                            <?php
                                }
                            }

                            ?>
                        </select>
                        <input type="submit" value="Հաստատել">
                    </form>
                    <form class="addComponent" action="subsections/action.php" method="post">
                        <h2>Բաժին 3-րդ</h2>
                        <input type="text" name="ss-name" placeholder="Բաժնի Անուն">
                        <select name="ss-category">
                            <?php
                            for ($i = 0; $i < count($categories); $i++) {
                                $table = $categories[$i];
                                if ($table[5][1] == "false") {
                            ?>
                                    <option value="<?php echo $table[0] ?>"><?php echo $table[1][1] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <input type="submit" value="Հաստատել">
                    </form>
                    <form class="addComponent" action="filters/filterAction.php" method="post">
                        <h2>Ավելացնել Ֆիլտր</h2>
                        <select name="f-category">
                            <?php
                            for ($i = 0; $i < count($categories); $i++) {
                                $category = $categories[$i];
                                if ($category[5][1] == "false") {
                            ?>
                                    <optgroup label="<?php echo $category[1][1] ?>">
                                        <?php
                                        for ($j = 0; $j < count($subsections); $j++) {
                                            $subsection = $subsections[$j];
                                            if ($subsection[2][1] == $category[0] && $subsection[5][1] == "false") {
                                        ?>
                                                <option value="<?php echo $subsection[0] ?>"><?php echo $subsection[1][1] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </optgroup>
                            <?php
                                }
                            }


                            ?>
                        </select>
                        <input type="text" placeholder="Ֆիլտրի Անուն" name="f-name">
                        <select name="f-type" id="f-type">
                            <optgroup label="Filther's Type">
                                <option selected value="checkbox">Checkbox</option>
                                <option value="radio">Radio</option>
                                <option value="select">Select</option>
                                <option value="double-select">Double-Select</option>
                                <option value="text">Text</option>
                                <option value="number">Number</option>
                            </optgroup>
                        </select>
                        <div id="select" class="filter_type_options column">
                            <div id="select_options">
                                <input type="text" name="select0" placeholder="Չնշվող դաշտ">
                            </div>
                            <input type="button" id="new_option" value="New Option">
                        </div>
                        <div id="checkbox" class="filter_type_options column show">
                            <div id="checkbox_options">
                                <input type="text" name="checkbox0" placeholder="Checkbox 1">
                            </div>
                            <input type="button" id="new_checkbox" value="New Checkbox">
                        </div>
                        <div id="radio" class="filter_type_options column">
                            <div id="radio_options">
                                <input type="text" name="radio0" placeholder="Radio 1">
                            </div>
                            <input type="button" id="new_radio" value="New Radio">
                        </div>
                        <div id="double_select" class="filter_type_options column">
                            <div id="double_select_options">
                                <input type="text" name="double-select0" placeholder="Double Select 1">
                            </div>
                            <input type="button" id="new_double_select" value="New Double Option">
                        </div>
                        <input type="text" name="f-after" placeholder="After">
                        <input type="submit" value="Հաստատել">
                    </form>
                </div>
            <?php } ?>

    </main>
    <footer>

    </footer>
</body>

</html>