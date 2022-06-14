<?php
$root_dir = "../../";
include $root_dir . "assets/code/setup.php";
setup($root_dir);

$user;
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
    <title>Իմ Հայտարարությունները</title>
    <link rel="stylesheet" href="../../Neon(c)/require.css">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/workspace.css">
    <link rel="stylesheet" href="../../assets/css/search-bar.css">
    <link rel="stylesheet" href="../../assets/css/post_block.css">
    <script>
        let root_dir = "<?php echo $root_dir ?>";
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="../../assets/js/favorite_page.js"></script>
    <script src="../../assets/js/color_scheme.js"></script>
    <script src="../../assets/js/menu.js"></script>
    <script src="../../assets/js/controller.js"></script>
</head>

<body class="">
    <?php light_header_part($root_dir); ?>
    <main>
        <div class="posts">
            
            <?php
            if (count($user["favorite_posts"]) <= 1) {
                ?>
                <h2 id="title">Դուք Չունեք Նախընտրած Հայտարարություններ</h2>
                <?php
            } else {
                ?>
                <h2 id="title">Նախընտրած Հայտարարություններ ( <?php echo count($user["favorite_posts"]) - 1 ?> / 100 )</h2>
                <?php
            }
            for ($i = 1; $i < count($user["favorite_posts"]); $i++) {
                $post = $posts_obj[$user["favorite_posts"][$i]];
                if ($post["deleted"] != "deleted") {
            ?>
                    <div class="post">
                        <div class="visitors">
                            <p><?php echo count($post["visitors"]) ?></p>
                            <span class="icon eye-icon"></span>
                        </div>
                        <div class="container">

                            <a href="single?id=<?php echo $user["favorite_posts"][$i] ?>" class="t-s flex row">
                                <img src="<?php echo $root_dir . $post["images_dir"][0] ?>" alt="">
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
                                            <p class="price_now"><?php echo $post["price"] ?></p>
                                            <sup><?php echo $filters[1][3][1][$post["price_type"]] ?></sup>
                                        </div>
                                        <div class="price-container flex row">
                                            <p class="old_price"><?php echo $post["first_price"] ?></p>
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
                                                <?php echo $post["room_count"] ?>
                                            </p>
                                        </div>
                                        <div class="filter flex column aic">
                                            <p class="title small">
                                                <?php echo $filters[3][1][1] ?>
                                            </p>
                                            <span class="icon surface-icon"></span>
                                            <p>
                                                <?php echo $post["q.m"] ?> մ²
                                            </p>
                                        </div>
                                        <div class="filter flex column aic">
                                            <p class="title small">
                                                <?php echo $filters[4][1][1] ?>
                                            </p>
                                            <span class="icon floor-icon"></span>
                                            <p>
                                                <?php echo $post["floor"] ?> / <?php echo $post["floor_count"] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <button class="heart" id="<?php echo $user["favorite_posts"][$i] ?>">
                                <span class="icon heart-icon 
                            <?php
                            for ($j = 1; $j < count($user["favorite_posts"]); $j++) {
                                if ($user["favorite_posts"][$j] == $user["favorite_posts"][$i]) {
                                    echo "heart-active";
                                }
                            } ?> "></span>
                            </button>
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