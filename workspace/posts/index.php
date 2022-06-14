<?php
$root_dir = "../../";
include $root_dir . "assets/code/setup.php";
setup($root_dir);


if (!isset($_SESSION["logged"]) || !$_SESSION["logged"]) {
    header("Location: ../../");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Իմ Հայտարարությունները</title>
    <link rel="stylesheet" href="../../Neon(c)/require.css">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/workspace.css">
    <link rel="stylesheet" href="../../assets/css/search-bar.css">
    <link rel="stylesheet" href="../../assets/css/post_block.css">
    <script src="../../assets/js/color_scheme.js"></script>
    <script src="../../assets/js/menu.js"></script>
    <script src="../../assets/js/controller.js"></script>

</head>

<body class="">
    <?php light_header_part($root_dir); ?>
    <main>
        <div class="posts">
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
                            <a class="t-s flex row">
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
                                                <?php echo $post[14][1] ?>
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
                        </div>
                    </div>
            <?php
                }
            }


            ?>
        </div>
    </main>
</body>

</html>