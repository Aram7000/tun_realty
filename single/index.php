<?php
$root_dir = "../";
include $root_dir . "assets/code/setup.php";
setup($root_dir);
if (!isset($_GET["id"]) || !isset($posts_obj[$_GET["id"]])) {
    header($root_dir);
}
$favorite = 0;
$user_found = false;
if (isset($_SESSION["logged"]) && $_SESSION["logged"]) {
    $user = $db[$_SESSION["user"]];
    $user_found = true;
    $favorite = count($user["favorite_posts"]) - 1;
}
$post = $posts_obj[$_GET["id"]];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../Neon(c)/require.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/search-bar.css">
    <link rel="stylesheet" href="../assets/css/post_block.css">
    <link rel="stylesheet" href="../assets/css/single.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let root_dir = "<?php echo $root_dir ?>";
        let post_id = "<?php echo $_GET["id"] ?>";
    </script>
    <script src="../assets/js/color_scheme.js"></script>
    <script src="../assets/js/single_functions.js"></script>
    <script src="../assets/js/menu.js"></script>
    <script src="../assets/js/loading.js"></script>
    <script src="../assets/js/controller.js"></script>
</head>

<body class="">
    <div id="loading-screen">
        <span class="fr"></span>
    </div>
    <?php
    checked_header_part($root_dir, $favorite);
    ?>
    <div class="max-width">
        <h2>Մանրամասն Տեղեկություն</h2>
        <div class="w100 flex row aic jcb">
            <button id="favorite_btn" class="favorite_btn">
                <span id="favorite_icon" class="icon heart-icon icon-large <?php
                                                                            if ($user_found) {
                                                                                for ($j = 1; $j < count($user["favorite_posts"]); $j++) {
                                                                                    if ($user["favorite_posts"][$j] == $_GET["id"]) {
                                                                                        echo "heart-active";
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            } ?> "></span>
            </button>
            <div class="visitors flex row aic jcc">
                <p>
                    <?php echo count($post["visitors"]) ?>
                </p>
                <span class="icon eye-icon icon-medium"></span>
            </div>
        </div>
        <div class="images_container">
            <div class="img">
                <img id="large-img" src="<?php echo $root_dir . $post["images_dir"][0] ?>" alt="">
                <div class="buttons">
                    <button id="arrowLeft">
                        <span class="icon arrow-left-icon"></span>
                    </button>
                    <button id="arrowRight">
                        <span class="icon arrow-right-icon"></span>
                    </button>
                </div>
            </div>
            <div class="scroll_container">
                <div class="img-row">
                    <?php
                    for ($i = 0; $i < count($post["images_dir"]); $i++) {
                    ?>
                        <img class="small-imgs" src="<?php echo $root_dir . $post["images_dir"][$i] ?>" alt="">
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <h3>Հասցե</h3>
        <div class="info">
            <p>Երևան</p>
            <p>Արաբկիր</p>
            <p>Մամիկոնյանց փ.</p>
            <p>Շենք - 17/6</p>
            <p>Բնակարան - 1/8</p>
        </div>
        <?php
        for ($i = 0; $i < count($post["filter_names"]); $i++) {
        ?>
        <div class="filter">
            <p class="filter-name"><?php echo $filters_obj[$post["filter_names"][$i]]["name"] ?></p>
            <p class="filter-value"><?php echo $post["filter_values"][$i] ?></p>
        </div>

        <?php
        }

        ?>
    </div>
</body>

</html>